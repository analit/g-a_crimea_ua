<?php

require_once 'Post.php';
require_once 'Category.php';
require_once 'Node.php';
require_once 'Root.php';

class Container {

    /**
     *
     * @var wpdb
     */
    private $_db;

    function __construct()
    {
        global $wpdb;
        $this->_db = $wpdb;
//        $this->init();
    }

    private function init()
    {
        $posts = $this->_getPosts();
        $categories = $this->_getTreeCategories();
        $relationships = $this->_getRelationships();
//        var_dump(count($categories));
    }

    private function _getRelationships()
    {
        return $this->_db->get_results("select * from {$this->_db->term_relationships}");
    }

    private function _getPosts()
    {
        $rows = $this->_db->get_results(
                "select * from {$this->_db->posts}"
                . " where post_type in ('post', 'page')"
        );

        $posts = array();

        foreach ($rows as $row) {
            $posts[$row->ID] = new Post($row);
        }
        return $posts;
    }

    public function createTree(array $objects)
    {
        $issetParent = function($id) use ($objects) {
            $result = array_filter($objects, function(Node $object) {
                return $object->getId() == $id;
            });
            return count($result);
        };

        $appendInTree = function(Root $root, Node $children ) {
//            foreach ($tree as $objectInTree) {
//                if ($objectInTree->getId() == $children->getParentId()) {
//                    $objectInTree->appendPage($children);
//                    return true;
//                }
//                $iterator = new RecursiveIteratorIterator($categoryInTree);
//                foreach ($iterator as $objectIterator) {
//                    if ($objectIterator->getId() == $children->getParentId()) {
//                        $objectIterator->appendPage($children);
//                        return true;
//                    }
//                }
//            }
            
            $iterator = new RecursiveIteratorIterator($root);
            foreach ($iterator as $node) {
                if ($node->getId() == $children->getParentId()) {
                    $node->appendPage($children);
                    return true;
                }
            }
            return false;
        };

        $root = new Root();
        $createTree = function(Root $root) use ($objects, &$createTree, $issetParent) {

            foreach ($objects as $object) {
                if (!$issetParent($object->getParentId())) {
                    continue;
                }

                if ($object->getParentId() != 0 ) {
                    if ($root->isExistPage($page)){
                        continue;
                    }
                    
                    $flagAdded = $appendInTree($tree, $object);

                    if (!$flagAdded) {
                        $createTree($root);
                    }
                } else {
                    $root->appendPage($object);
                }
            }
        };

        $createTree($root);

        return $root;
    }

    private function _getTreeCategories()
    {
        $sql = "select * from {$this->_db->terms}"
                . " join {$this->_db->term_taxonomy} on {$this->_db->terms}.term_id = {$this->_db->term_taxonomy}.term_id"
                . " where taxonomy='category'";

        $rows = $this->_db->get_results($sql);
        
        $categories = array_map(function($row) {
            return new Category($row);
        }, $rows);
        
        return $categories;
    }

}
