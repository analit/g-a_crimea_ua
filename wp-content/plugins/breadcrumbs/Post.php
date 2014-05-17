<?php

require_once 'Page.php';

class Post extends Page
{

    public function getUrl()
    {
        return get_permalink($this->getId());
    }

}
