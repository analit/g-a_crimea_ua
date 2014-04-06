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
            $thumbimgLarge = wp_get_attachment_image_src($attachment->ID, 'page-preview', true);
            $thumbimg = "<a href='javascript:void(0)' data-url-large='$thumbimgLarge[0]'>";            
            $thumbimg .= wp_get_attachment_image($attachment->ID, 'thumbnail', true);
            $thumbimg .= "</a>";
            $result .= '<li class="' . $class . ' data-design-thumbnail">' . $thumbimg . '</li>';            
        }
    }
    $result .= "</ul>";
    return $result;
}

function twentythirteen_paging_nav() {
    global $wp_query;

    // Don't print empty markup if there's only one page.
    if ( $wp_query->max_num_pages < 2 ){
        return;
    }
    ?>
    <div class="pagination" role="navigation">
        <ul>
            <?php if ( get_previous_posts_link() ) : ?>
                <li class="nav-next"><?php previous_posts_link('<span class="meta-nav">&larr;</span> Предыдущая страница ' ); ?></li>
            <?php endif; ?>

            <?php if (get_next_posts_link()) : ?>
                <li class="nav-previous"><?php next_posts_link('Следующая страница <span class="meta-nav">&rarr;</span>'); ?></li>
            <?php endif; ?>	
        </ul>
    </div>
    <?php
}
