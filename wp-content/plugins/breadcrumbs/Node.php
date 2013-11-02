<?php

require_once 'Node.php';

interface Node
{

    public function getId();

    public function getParentId();

    public function getLabel();

    public function getUrl();

    public function isActive();

    public function setActive($active);

    public function getParent();

    public function setParent(Node $node);

    public function render();
}
