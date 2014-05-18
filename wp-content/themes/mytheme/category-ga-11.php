<ul class="list_a">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <li>
                <a href=" <?php echo get_permalink(); ?>  ">
                    <h5><?php echo get_the_title(); ?></h5>
                </a>                
            </li>
        <?php endwhile; ?>
    <?php endif; ?>
</ul>
