<?php

acf_block_before( 'Блок для перелинковки', $is_preview );
$chosen_posts = get_field( 'choose_posts' );
$template     = get_field( 'template' ) ?? 'title-image-text';
?>
    <div class="<?= $template ?> links-block">
		<?php
		foreach ( $chosen_posts as $post ):
            $link_type = $post['link_type'];

			if ( $template === 'title_image_text' ): ?>
                <div class="link-block">
                    <h3 class="link-block__title"><?= $post['title'] ?></h3>
                    <div class="link-block__image"><?= app_get_image(['id' => $post['image']]) ?></div>
                    <div class="link-block__text"><?= $post['text'] ?></div>
                    <a href="<?= $post[$link_type] ?>" class="link-block__link" title="Read the post"></a>
                </div>
            <?php elseif ($template === 'image_title_text_arrow'): ?>
                <div class="link-block">
                    <div class="link-block__image"><?= app_get_image(['id' => $post['image']]) ?></div>
                    <h3 class="link-block__title"><?= $post['title'] ?></h3>
                    <div class="link-block__text"><?= $post['text'] ?></div>
                    <a href="<?= $post[$link_type] ?>" class="link-block__link" title="Read the post"><i class="icon-right"></i></a>
                </div>
            <?php elseif ($template === 'image_title_text_read_more'): ?>
                <div class="link-block">
                    <div class="link-block__image"><?= app_get_image(['id' => $post['image']]) ?></div>
                    <h3 class="link-block__title"><?= $post['title'] ?></h3>
                    <div class="link-block__text"><?= $post['text'] ?></div>
                    <a href="<?= $post[$link_type] ?>" class="link-block__link">Read more</a>
                </div>
			<?php endif;
		endforeach; ?>
    </div>
<?php
acf_block_after( $is_preview );
