<?php

require_once 'Page.php';

class Post extends Page {

    public function getId()
    {
        return 0;
    }

    public function getParentId()
    {
        return 0;
    }

    public function getLabel()
    {
        return "";
    }

}
