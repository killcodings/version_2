<?php
$background_color = get_field( 'background_color' ) ?: '#000';
//$content_width    = get_field( 'content_width' ) ?: 60;
//$media_width      = 100 - $content_width;
$main_class      = "media-text";
$class_name      = $block['className'] ?? '';
$main_class     .= ' '.$class_name;
$style_string    = "--background:$background_color";
$is_enable_media = get_field( 'is_enable_media' ) ?? true;
$reverse         = get_field( 'reverse' ) ?? false;
$is_horizontally = get_field( 'horizontally' ) ?? false;
$is_logo_text    = get_field( 'is_logo_text') ?? false;
$swiper = get_field('swiper') ?? false;

if ( $is_horizontally ) {
	$main_class .= ' media-text_horizontal';
}

/*$image_position_mobile = get_field( 'image_position_mobile' ) ?? true;
$block_class           = 'media-text__block';
if ( $image_position_mobile ) {
	$block_class .= ' media-text__block_mobile-image-first';
}*/

if ( $reverse ) {
	$main_class .= ' media-text_reverse';
}

if ($block['data']['is_logo_text']) {
	$main_class .= ' media-text_no-logo-text';
}

/*
$is_add_buttons = get_field( 'is_add_buttons' ) ?? false;
$button_class   = 'media-text__button';

// TODO: Refactor this
if ( $is_add_buttons ) {
	$buttons = get_field( 'buttons' );
	if ( $buttons ) {
		$buttons_count = count( $buttons );

		if ( $buttons_count === 1 ) {
			$button_class .= ' media-text__button_single';
		}
	}
}*/


acf_block_before( 'Изображение и текст', $is_preview );
?>

    <div class="<?= $main_class ?>" style="<?= $style_string ?>">

        <?php
            $icon_block_args = get_field('block_icon_group');
            echo get_component( 'icon-block/icon-block', $icon_block_args ); ?>
        <div class="media-text__content">
            <InnerBlocks/>
        </div>
		<?php
		if ( $is_enable_media ):
			$is_add_image_video = get_field( 'is_add_image_video' ) ?: 'image';
			?>
            <div class="media-text__media media-text__media_<?= $is_add_image_video ?>">
				<?php
				if ( $is_add_image_video === 'image' ):
					$image = get_field( 'image' );
					if ( ! isset( $GLOBALS['is_first_text_image'] ) ) {
						echo app_get_image( [ 'id' => $image ], false );
						$GLOBALS['is_first_text_image'] = false;
					} else {
						echo app_get_image( [ 'id' => $image ] );
					}
                elseif ( $is_add_image_video ==='swiper') : ?>
                    <div class="swiper">
                        <div class="swiper-wrapper">
			                <?php foreach ($swiper as $swiper_slide) : ?>
                                <div class="swiper-slide">
					                <?= app_get_image( [ 'id' => $swiper_slide['swiper-slide'] ] ); ?>
                                </div>
			                <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                <?php
				else:
					$video = get_field( 'video' );
					echo app_get_video( $video );
				endif;
				?>
            </div>
		<?php endif; ?>
    </div>
<?php
acf_block_after( $is_preview );
