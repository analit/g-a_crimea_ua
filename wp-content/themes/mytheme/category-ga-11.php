<ul class="notes-list">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <li>
                <a href=" <?php echo get_permalink(); ?>  ">
                    <?php echo get_the_title(); ?>
                </a>                
            </li>
        <?php endwhile; ?>
    <?php endif; ?>
</ul>
