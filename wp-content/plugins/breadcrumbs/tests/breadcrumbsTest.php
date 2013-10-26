<?php

require_once 'Container.php';
require_once 'Category.php';

class Tests_Actions extends WP_UnitTestCase {

    public function test_breadcrumbs()
    {
        $container = new Container();
        $data = array(
            
            new Category((object) array('term_id' => 2, 'parent' => 1, 'name' => 'parent 2_1')),
            new Category((object) array('term_id' => 3, 'parent' => 2, 'name' => 'parent 3_2')),
            new Category((object) array('term_id' => 4, 'parent' => 2, 'name' => 'parent 4_2')),
            new Category((object) array('term_id' => 5, 'parent' => 3, 'name' => 'parent 5_3')),
            new Category((object) array('term_id' => 1, 'parent' => 0, 'name' => 'parent 1_0')),
            new Category((object) array('term_id' => 6, 'parent' => 0, 'name' => 'parent 6_0')),
            
        );
        $res = $container->createTree($data);
        var_dump($res);
        
        $this->assertTrue(true);
    }

}
