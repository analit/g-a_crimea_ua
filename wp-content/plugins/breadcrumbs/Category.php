<?php

require_once 'Page.php';

class Category extends Page {

    public function getId()
    {
        return $this->getData()->term_id;
    }

    public function getParentId()
    {
        return $this->getData()->parent;
    }

    public function getLabel()
    {
        return $this->getData()->name;
    }

}
