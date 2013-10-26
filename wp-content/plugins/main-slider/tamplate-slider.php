<?php wp_enqueue_script('main-slider', "/wp-content/plugins/main-slider/js/jquery.jcarousel.js"); ?> 
<?php wp_enqueue_style('main-slider', "/wp-content/plugins/main-slider/css/style.css") ?>

<div class="d-carousel sites-galary">
    <ul class="carousel">
        <?php for ($i = 0; $i < 8; $i++): ?>
            <li> 
                <a href="#">
                    <span class="img_holder">
                        <img alt="082_crimea_ua" class="attachment-post-thumbnail wp-post-image" src="wp-content/uploads/2013/10/082_crimea_ua-300x300.png">
                        <span class="imgTitle">Каталог предприятий Крыма </span>

                    </span>
                </a> 
                <div class="slider-site-info">
                    <ul class="post-categories">
                        <li>
                            <a rel="category" title="Просмотреть все записи в рубрике «Каталоги компаний»" href="http://localhost/ga_crimea_ua/?cat=6">Каталоги компаний</a>
                        </li>
                    </ul>
                    <p>A helper can be initialized in several different ways, based on your needs as well as the functionality of that helper</p>
                </div>
            </li>
        <?php endfor; ?>       

    </ul>
</div>

<script type="text/javascript">
    window.onload = function() {
        jQuery( '.d-carousel .carousel' ).jcarousel( {
            scroll: 1
        } );
    }
</script>