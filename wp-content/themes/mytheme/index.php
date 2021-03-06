<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <?php get_header(); ?> 
    </head>
    <body class="bg_e">
        <!-- main wrapper (without footer) -->    
        <div class="main-wrapper">

            <?php get_header('top') ?>
            <!-- main content -->
            <div class="container">
                <div class="row-fluid">
                    <!-- main content -->
                    <?php if (is_front_page()): ?>
                        <?php require_once 'front-page-ga.php'; ?> 
                    <?php else: ?>
                        <div class="span9">
                            <?php if (is_category()): ?>
                                <?php require_once 'category-ga.php'; ?>                        
                            <?php elseif (is_page()): ?>
                                <?php require_once 'page-ga.php'; ?>
                            <?php elseif (is_search()): ?>
                                <?php require_once 'search-ga.php'; ?>
                            <?php elseif (is_single()): ?>
                                <?php require_once 'single-ga.php'; ?>
                            <?php elseif (is_404()): ?>
                                <?php require_once '404-ga.php'; ?>
                            <?php endif; ?>                            
                        </div>
                        <!-- sidebar -->
                        <div class="span3">
                            <?php require_once 'sidebar-ga.php'; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="footer_space"></div>

        </div> 

        <?php get_footer() ?>

    </body>
</html>

