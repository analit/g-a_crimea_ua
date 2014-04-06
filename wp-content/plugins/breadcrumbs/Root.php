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

    public function getBreadcrumbs($url, $delimiter = "")
    {
        $currentPage = null;
        $iterator = new RecursiveIteratorIterator($this, RecursiveIteratorIterator::CHILD_FIRST);
        /* @var $node Node */
        foreach ($iterator as $node) {
            $postUrl = $node->getUrl();
            $position = strpos($url, $postUrl);
            if ($position === 0) {
                $node->setActive(true);
                $currentPage = $node;
                break;
            }
        }

        if (!$currentPage) {
            return null;
        }

        $breadcrumbs = array();
        $renderBreadcrumbs = function (Node $currentPage) use (&$renderBreadcrumbs, &$breadcrumbs, $delimiter) {
            $breadcrumbs [] = $currentPage->render();
            $parentPage = $currentPage->getParent();
            if ($parentPage) {
                $renderBreadcrumbs($parentPage);
            }
        };

        $renderBreadcrumbs($currentPage);

        // main page
        $breadcrumbs[] = $this->render();

        $htmlBreadcrumbs = implode($delimiter, array_reverse($breadcrumbs));
        $htmlBreadcrumbs = sprintf('<ul id="breadcrumbs">%s</a>', $htmlBreadcrumbs);
        return $htmlBreadcrumbs;
    }

    public function render()
    {
        return sprintf('<li><a href="%s"><i class="icon-home"></i></a></li>', get_bloginfo('url'));
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
