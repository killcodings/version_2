<?php
acf_block_before( 'Блок для перелинковки', $is_preview );
$chosen_posts = get_field( 'choose_posts' );
//$template     = get_field( 'template' ) ?? 'title-image-text';
?>
	<div class="links-block">
		<?php
		foreach ( $chosen_posts as $post ):
			$link_type = $post['link_type'];
        ?>
            <div class="link-block">
                <?= app_get_image(['id' => $post['image']]) ?>
                <div class="link-block__content">
                    <h3 class="link-block__title"><?= $post['title'] ?></h3>
                    <div class="link-block__text"><?= $post['text'] ?></div>
	                <?php
	                $icon_block_args = $post['block_icon_group'];
	                echo get_component( 'icon-block/icon-block', $icon_block_args ); ?>
                </div>

                <a href="<?= $post[$link_type] ?>" class="link-block__link" title="Read the post"></a>
            </div>
        <?php endforeach; ?>
	</div>
<?php
acf_block_after( $is_preview );
