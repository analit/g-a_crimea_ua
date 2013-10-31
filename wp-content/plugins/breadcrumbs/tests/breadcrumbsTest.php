<?php

require_once 'Container.php';
require_once 'Category.php';
require_once 'Root.php';

class Tests_Actions extends WP_UnitTestCase
{

    public function testBreadcrumbs()
    {
        $container = new Container();
        var_dump($container->getRoot());
        $this->assertTrue(true);
    }

    public function testCreateTree()
    {

        $this->markTestSkipped('Extension is not loaded.');

        $container = new Container();
        $data = array(
            new Category((object)array('term_id' => 7, 'parent' => 6, 'name' => 'parent 7_6')),
            new Category((object)array('term_id' => 2, 'parent' => 1, 'name' => 'parent 2_1')),
            new Category((object)array('term_id' => 3, 'parent' => 2, 'name' => 'parent 3_2')),
            new Category((object)array('term_id' => 4, 'parent' => 2, 'name' => 'parent 4_2')),
            new Category((object)array('term_id' => 5, 'parent' => 3, 'name' => 'parent 5_3')),
            new Category((object)array('term_id' => 1, 'parent' => 0, 'name' => 'parent 1_0')),
            new Category((object)array('term_id' => 6, 'parent' => 0, 'name' => 'parent 6_0')),
            new Category((object)array('term_id' => 6, 'parent' => 8, 'name' => 'parent 6_0')),

        );

        $res = $container->createTree($data);
        var_dump($res->__toString());

        $this->assertTrue(true);
    }

    public function test_in_net()
    {
        $this->markTestSkipped('Skipped...');

        $o1 = new Obj('Root');

        $i1 = new Obj('Item 1');
        $i12 = new Obj('Subitem 2');
        $i1->children[] = new Obj('Subitem 1');
        $i1->children[] = $i12;

        $i12->children[] = new Obj('Subsubitem 1');
        $i12->children[] = new Obj('Enough....');

        $o1->children[] = $i1;
        $o1->children[] = new Obj('Item 2');
        $o1->children[] = new Obj('Item 3');


        foreach (new RecursiveIteratorIterator($o1, RecursiveIteratorIterator::CHILD_FIRST) as $o) {
            echo "<br>" . $o;
        }
    }

}

class Obj implements RecursiveIterator
{
    public $children = array();

    private $position;

    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function valid()
    {
        return isset($this->children[$this->position]);
    }

    public function next()
    {
        $this->position++;
    }

    public function current()
    {
        return $this->children[$this->position];
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function key()
    {
        return $this->position;
    }

    public function hasChildren()
    {
//        return !empty($this->children[$this->position]);
        return !empty($this->current()->children);
    }

    public function getChildren()
    {
        return $this->children[$this->position];
    }

    public function __toString()
    {
        return $this->name;
    }
}
