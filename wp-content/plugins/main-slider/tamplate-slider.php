<?php wp_enqueue_script('main-slider', "/wp-content/plugins/main-slider/js/jquery.jcarousel.js"); ?> 
<?php wp_enqueue_style('main-slider', "/wp-content/plugins/main-slider/css/style.css") ?>

<div class="d-carousel sites-galary">
    <ul class="carousel">
        <?php foreach ($posts as $post): ?>
            <li> 
                <a href="<?php echo post_permalink( $post->ID )?>">
                    <span class="img_holder">
                        <?php echo get_the_post_thumbnail($post->ID, array(300, 300), array('class'	=> "attachment-post-thumbnail wp-post-image",)); ?>
                        <!--                        <img alt="082_crimea_ua" class="attachment-post-thumbnail wp-post-image" src="wp-content/uploads/2013/10/082_crimea_ua-300x300.png">-->
                        <span class="imgTitle"><?php echo $post->post_title ?></span>

                    </span>
                </a> 
                <div class="slider-site-info">

                    <ul class="post-categories">
                        <li>
                            <?php $categories = get_the_category( $post->ID )?>
                            <?php $category = $categories[0]?>
                            <a rel="category" href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name ?></a>
                        </li>
                    </ul>
                    <p><?php echo wp_trim_words( $post->post_content, $num_words = 20 )?></p>
                </div>
            </li>
        <?php endforeach; ?>

    </ul>
</div>

<script type="text/javascript">
    window.onload = function() {
        jQuery( '.d-carousel .carousel' ).jcarousel( {
            scroll: 1
        } );
    }
</script>