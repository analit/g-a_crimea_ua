<div class="blog_content blog_page">
    <div class="sites-galary" >
        <ul>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <li>
                        <a href="">
                            <span class="img_holder">
                                <img alt="" src="wp-content/themes/mytheme/182.jpg" style="height: 232px; width: 232px">
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
</div>