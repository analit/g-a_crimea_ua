<?php

require_once 'Page.php';

class Root extends Page {

    function __construct()
    {
        parent::__construct(array('label' => 'Главная'));
    }

    public function getId()
    {
        return 0;
    }

    public function getParentId()
    {
        return 0;
    }

    public function isExistPage(Page $page)
    {
        return true;
    }

    public function getLabel()
    {
        return $this->getData()->label;
    }

}
