<?php
ob_start(); 
 
//change this to your path 
$path = '/var/www/wordpress_test/trunk/includes/bootstrap.php'; 
 
if (file_exists($path)) {         
    $GLOBALS['wp_tests_options'] = array(
        'active_plugins' => array('breadcrumbs/index.php')
    );
    require_once $path;
} else {
    exit("Couldn't find $path");
}