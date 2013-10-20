<?php

/*
  Plugin Name: G-A Slider
  Plugin URI: http://akismet.com/?return=true
  Description: Slider
  Version: 0.1
  Author: Sergey Garyaga
  Author URI: http://automattic.com/wordpress-plugins/
  License: GPLv2 or later
 */

add_shortcode('main-slider', function () {
    require_once 'tamplate-slider.php';
});
