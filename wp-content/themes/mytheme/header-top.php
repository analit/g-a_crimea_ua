<?php ?>
<!-- top bar -->

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <div class="pull-right top-search">                
                <?php get_search_form(); ?> 
            </div>

            <?php
            $options = array(
                'container_class' => 'pull-left',
                'container_id' => 'fade-menu'
            );
            wp_nav_menu($options);
            ?> 
            
        </div>
    </div>
</div>

<!-- header -->
<header>
    <div class="container head-background">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <div class="main-logo">
                        <a href="<?php bloginfo('url'); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/logo_IT_v11.png" alt="G-Algorithm">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<div class="container" style="height: 60px">
    <!-- breadcrumbs -->
    <?php echo breadcrumbs() ?>
</div>
