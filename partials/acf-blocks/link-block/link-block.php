<?php
acf_block_before( 'Блок для перелинковки', $is_preview );
$chosen_posts = get_field( 'choose_posts' );
//$template     = get_field( 'template' ) ?? 'title-image-text';
?>
	<div class="links-block">
		<?php
		foreach ( $chosen_posts as $post ):
        ?>
            <div class="link-block">
                <?= app_get_image(['id' => $post['image']]) ?>
                <div class="link-block__content">
                    <h3 class="link-block__title"><?= $post['title'] ?></h3>
                    <div class="link-block__text"><?= $post['text'] ?></div>
                    <!--                    <div class="link-block__logo logo-text">-->
                    <!--                        <div class="link-block__image logo-text__logo">-->
                    <!--                            <div class="image-func" style="--background-color: #000000">-->
                    <!--                                <img src="./images/content/brand2.png">-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="relative__text logo-text__text">Parimatch</div>-->
                    <!--                    </div>-->
                </div>

                <a href="<?= $post[$link_type] ?>" class="link-block__link" title="Read the post"></a>
            </div>
        <?php endforeach; ?>
	</div>
<?php
acf_block_after( $is_preview );
