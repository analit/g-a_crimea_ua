<?php

/*
  Plugin Name: G-A Breadcrumbs
  Plugin URI: http://g-a.crimea.ua
  Description: Breadcrumbs.
  Version: 0.1
  Author: Sergey Garyaga
  Author URI: http://g-a.crimea.ua
  License: GPLv2 or later
 */

require_once 'Container.php';

function breadcrumbs()
{
    $container = new Container();
    return $container->getBreadcrumbs();
}
