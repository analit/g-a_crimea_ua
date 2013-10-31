<?php

require_once 'Page.php';
require_once 'Node.php';

class Root extends Page
{

    function __construct()
    {
        $data = array('label' => 'Главная');
        parent::__construct((object)$data);
    }

    public function getId()
    {
        return 0;
    }

    public function getParentId()
    {
        return 0;
    }

    public function appendPage(Page $page)
    {
        if ($page->getParentId() == 0) {
            $this->_pages[] = $page;
            return true;
        }

        $iterator = new RecursiveIteratorIterator($this, RecursiveIteratorIterator::CHILD_FIRST);
        $parent = null;
        foreach ($iterator as $node) {
            if ($node->getId() == $page->getParentId()) {
                $parent = $node;
                break;
            }
        }

        if ($parent) {
            $parent->appendPage($page);
            return true;
        }
        return false;
    }

    public function __toString()
    {
        $res = "";
        $iterator = new RecursiveIteratorIterator($this, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($iterator as $node) {
            $res .= $node->getLabel() . " | ";
        }
        return $res;
    }

    public function getLabel()
    {
        return $this->getData()->label;
    }

}
