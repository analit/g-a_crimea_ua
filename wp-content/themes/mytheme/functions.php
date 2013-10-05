<?php

add_theme_support('post-thumbnails'); // поддержка миниатюр
set_post_thumbnail_size(225, 225, true);
add_image_size('page-preview', 530, 530);

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

function getContainerPreviews()
{
    global $post;

    $result = "<ul class='container-preview'>";
    $attachments = get_posts(array(
        'post_type' => 'attachment',
        'post_parent' => $post->ID,
    ));
    
    if ($attachments) {
        foreach ($attachments as $attachment) {
            $class = "post-attachment mime-" . sanitize_title($attachment->post_mime_type);
            $thumbimg = "<a href='javascript:void(0)'>";
            $thumbimg .= wp_get_attachment_image($attachment->ID, 'thumbnail', true);
            $thumbimg .= "</a>";
            $result .= '<li class="' . $class . ' data-design-thumbnail">' . $thumbimg . '</li>';            
        }
    }
    $result .= "</ul>";
    return $result;
}
