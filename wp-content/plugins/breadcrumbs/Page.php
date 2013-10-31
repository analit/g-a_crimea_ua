<?php

require_once 'Node.php';

class Page implements RecursiveIterator, Node{

    protected $_pages = array();
    private $_position = 0;
    /**
     * @var stdClass
     */
    private $_data;

    function __construct(stdClass $data)
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
        $this->_position = 0;
    }

    public function valid()
    {
        return isset($this->_pages[$this->_position]);
    }

    public function appendPage(Page $page)
    {
        $this->_pages[] = $page;
    }

    function getId()
    {
        return $this->_data->ID;
    }

    function getParentId()
    {
        return $this->_data->post_parent;
    }

    public function setParentId($id)
    {
        $this->_data->post_parent = $id;
    }

    function getLabel()
    {
        return $this->_data->post_title;
    }
}
