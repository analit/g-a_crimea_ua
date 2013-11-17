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
    $parameters = array(
        'post_type' => 'post', /* Отбираем только записи. */
        'post_status' => 'publish', /* И только опубликованные. */
        'posts_per_page' => -1, /* Снимаем ограничение на количество показываемых записей на одну страничку. */
        'category_name' => 'portfolio'
    );
    $query = new WP_Query($parameters);
    $posts = $query->get_posts();

    shuffle($posts);
    $posts = array_slice($posts, 0, 6);

    require_once 'tamplate-slider.php';
});
