<?php

require_once 'Node.php';

abstract class Page implements RecursiveIterator, Node{

    private $_pages = array();
    private $_position = 0;
    private $_data;

    function __construct($data)
    {
        $this->_data = $data;
    }
    
    public function getData()
    {
        return $this->_data;
    }

    public function current()
    {
        return $this->_pages[$this->_position];
    }

    public function getChildren()
    {
        return $this->_pages[$this->_position];
    }
    
    public function getPages()
    {
        return $this->_pages;
    }

    public function hasChildren()
    {
//        return count($this->_pages[$this->_position]);
//        return !empty($this->current()->pages);
        return count($this->_pages[$this->_position]->getPages());
    }

    public function key()
    {
        return $this->_position;
    }

    public function next()
    {
        $this->_position++;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function valid()
    {
        return isset($this->_pages[$this->_position]);
    }

    public function appendPage(Page $page)
    {
        $this->_pages[] = $page;
    }

}
