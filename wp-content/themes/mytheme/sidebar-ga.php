
<?php

wp_nav_menu(array(
    'menu_class'=>'nav nav-list', 
    'theme_location'=>'sidebar_category', 
    'items_wrap' => '<ul id="%1$s" class="%2$s"><li class="nav-header">Категории сайтов</li>%3$s</ul>'
    ));
?>
