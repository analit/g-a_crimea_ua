<div class="sites-galary" >
    <ul>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <li>
                    <a href=" <?php echo get_permalink(); ?>  ">
                        <span class="img_holder">
                            <!--<img alt="" src="wp-content/themes/mytheme/182.jpg" style="height: 225px; width: 225px">-->
                            <?php //set_post_thumbnail_size( 235, 235, true ); ?>
                            <?php the_post_thumbnail(); ?>
                            <span class="imgTitle"><?php echo get_the_title(); ?> </span>
                        </span>
                    </a>
                    <?php the_category() ?>
                </li>
            <?php endwhile; ?>
        <?php endif ?>
    </ul>
    <div class="clear"></div>
</div>