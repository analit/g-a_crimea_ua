<?php the_post() ?>

<?php // if notes ... ?>
<?php $categories = get_the_category()?>
<?php if($categories[0]->term_id == 11):?>
    <?php require_once 'single-ga-note.php';?>
    <?php return; ?>
<?php endif; ?>

<?php wp_enqueue_script('load-large-image', "/wp-content/themes/mytheme/js/my/loadLargeImage.js"); ?> 

<div class="span9">    
    <div class="w-box-content cnt_a" style="border-top: solid 1px #CCCCCC">
        <!--<img src="wp-content/uploads/2013/09/082_crimea_ua.png"/>-->
        <?php the_post_thumbnail('page-preview'); ?>
    </div>
    <div class="navigation">
        <?php ?>
        <span class="previous-entries"><?php next_posts_link('Вперед') ?></span>
        <span class="next-entries"><?php previous_posts_link('Назад') ?></span>
    </div>
</div>
<div class="span3">
    <?php echo getContainerPreviews() ?>
</div>

<div class="clear"></div>

<div class="w-box" style="margin-top: 30px">
    <div class="w-box-header">
        <h4>Информация</h4>
    </div>
    <div class="w-box-content cnt_a">
        <table id="smpl_tbl" class="table table-striped">
            <tbody>
                <tr>
                    <th>Описание</th>
                    <td><?php the_content() ?></td>                    
                </tr>
                <tr>
                    <th>Технологии</th>
                    <td><?php echo get_post_meta(get_the_ID(), 'technology', true) ?></td>                    
                </tr>
                <tr>
                    <th>Ссылка</th>
                    <td>
                        <?php $link = get_post_meta(get_the_ID(), 'link', true) ?>
                        <a href="<?php echo $link ?>" target="_blank">
                            <?php echo $link ?>
                        </a>
                        &nbsp; &rarr;
                    </td>                    
                </tr>                
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    window.onload = function() {
        $( ".container-preview" ).loadLargeImage( $( ".attachment-page-preview" ) );
    };
</script>