<?php

require_once 'Post.php';
require_once 'Category.php';
require_once 'Node.php';
require_once 'Root.php';

class Container
{

    /**
     *
     * @var wpdb
     */
    private $_db;
    /*
     * Root
     */
    private $_root;

    function __construct()
    {
        global $wpdb;
        $this->_db = $wpdb;
        $this->init();
    }

    public function getRoot()
    {
        return $this->_root;
    }

    public function getBreadcrumbs($url = null)
    {
        if (!$url){
            $url = $this->getCurrentUrl();
        }
        return $this->_root->getBreadcrumbs($url);
    }

    public function getCurrentUrl()
    {
        return "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    private function init()
    {
        $this->_createTreeObjects();
    }

    private function _createTreeObjects()
    {

        $categories = $this->_getCategories();
        $treeCategories = $this->createTree($categories);

        $posts = $this->_getPosts();
        $treePosts = $this->createTree($posts);

        $this->addPostsParentCategory($treePosts);

        // create tree ...
        foreach ($treePosts->getPages() as $post){
            $treeCategories->appendPage($post);
        }

        $this->_root = $treeCategories;

    }

    private function addPostsParentCategory(Root $treePosts)
    {
        $relationships = $this->_db->get_results("select * from {$this->_db->term_relationships}");
        $mapRelationships = array();

        foreach ($relationships as $relationship) {
            $mapRelationships[$relationship->object_id] = $relationship->term_taxonomy_id;
        }

        foreach ($treePosts->getPages() as $post){
            if (isset($mapRelationships[$post->getId()])){
                $post->setParentId($mapRelationships[$post->getId()]);
            }
        }
    }

    private function _getPosts()
    {
        $rows = $this->_db->get_results(
            "select * from {$this->_db->posts}"
            . " where post_type in ('post', 'page')"
        );

        $posts = array_map(function ($row) {
            return $row->post_type === 'post' ? new Post($row) : new Page($row);
        }, $rows);
        return $posts;
    }

    /**
     * @param array $objects
     * @return Root
     */
    public function createTree(array $objects)
    {
        $issetParent = function ($id) use ($objects) {
            $result = array_filter($objects, function (Node $object) use ($id) {
                return $object->getId() == $id;
            });
            return count($result);
        };

        $root = new Root();

        $createTree = function (Root $root, array $objects) use (&$createTree, $issetParent) {

            $noAdded = array();

            foreach ($objects as $object) {

                if ($object->getParentId() != 0 && !$issetParent($object->getParentId())) {
                    continue;
                }

                if (!$root->appendPage($object)) {
                    $noAdded[] = $object;
                }
            }

            if (count($noAdded)) {
                $createTree($root, $noAdded);
            }
        };

        $createTree($root, $objects);

        return $root;
    }

    private function _getCategories()
    {
        $sql = "select * from {$this->_db->terms}"
            . " join {$this->_db->term_taxonomy} on {$this->_db->terms}.term_id = {$this->_db->term_taxonomy}.term_id"
            . " where taxonomy='category'";

        $rows = $this->_db->get_results($sql);

        $categories = array_map(function ($row) {
            return new Category($row);
        }, $rows);

        return $categories;
    }

}
