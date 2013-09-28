<?php

function mytheme_wp_title($title, $sep)
{
    $title .= get_bloginfo('name') . ' ' . $sep . ' ' . get_bloginfo('description');
    return $title;
}

add_filter('wp_title', 'mytheme_wp_title', 10, 2);


add_filter('wp_head', function() {
            if (!is_admin_bar_showing()) {
                return;
            }
            require_once __DIR__ . '/templates/helpers/move-main-menu.php';
        }, 100);
        
add_theme_support('menus');

register_nav_menus(array(  
    'main' => 'Main menu',            
    'sidebar_category' => 'Category menu'   
)); 