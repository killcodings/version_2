<?php
$background_color = get_field( 'background_color' ) ?: '#000';
$content_width    = get_field( 'content_width' ) ?: 60;
$media_width      = 100 - $content_width;
$main_class       = "media-text";
$style_string     = "--background:$background_color;--content-width:$content_width%;--media-width:$media_width%";

$is_gradient = get_field( 'is_gradient' ) ?? false;
if ( $is_gradient ) {
	$main_class      .= ' media-text_gradient';
	$gradient_colors = get_field( 'gradient_colors' );
	$start_color     = $gradient_colors['start_color'] ?: '#000';
	$end_color       = $gradient_colors['end_color'] ?: '#000';
	$style_string    .= "--start-color:$start_color;--end-color:$end_color;";
}

$image_position_mobile = get_field( 'image_position_mobile' ) ?? true;
$block_class           = 'media-text__block';
if ( $image_position_mobile ) {
	$block_class .= ' media-text__block_mobile-image-first';
}

$is_enable_media = get_field( 'is_enable_media' ) ?? true;
if ( ! $is_enable_media ) {
	$block_class .= ' media-text__block_content-only';
}

$reverse = get_field( 'reverse' ) ?? false;
if ( $reverse ) {
	$block_class .= ' media-text__block_reverse';
}

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
}

acf_block_before( 'Изображение и текст', $is_preview );
?>
    <div class="<?= $main_class ?>" style="<?= $style_string ?>">
        <div class="<?= $block_class ?>">
            <div class="media-text__content">
                <div>
                    <InnerBlocks/>
                </div>
				<?php if ( $is_add_buttons ): ?>
                    <div class="media-text__buttons">
						<?php
						foreach ( $buttons as $button ):
							$button_style = $button['button_style'] ? 'button_' . $button['button_style'] : 'button_outline';

                            // Откуда берется URL для кнопки: из глобальных настроек (choose_link) или ввести в инпуте (input_link)
							$choose_link = $button['choose'];
							if ( $choose_link === 'input_link' ) {
								$button['url'] = $button['input_link'];
							} elseif ( $choose_link === 'chose_link' ) {
								$button['url'] = $button['text_image_choose_link'];
							}

							$is_link_button = !$button['is_enable_bonus'];
                            $custom_colors = ($button['button_style'] === 'custom_color') ? $button['colors'] : '';

							$button_icon       = false;
							$button_icon_class = '';
							if ( $button['is_add_icon'] ) {
								$button_icon_class = 'media-text__button_icon';
                                $button_icon       = '';
                                $icon_url          = wp_get_attachment_image_url($button['button_icon']);
                                $icon_url          = app_get_image_url( $icon_url );
                                $button_icon       = "<span class = 'button__icon' style = 'background-image: url($icon_url);'></span>";
                                // $button_icon       = app_get_image( [ 'id' => $button['button_icon'] ] );
                            }

							if ( $is_link_button ):
								echo app_get_button( $button,
									"$button_class button $button_icon_class {$button_style}",
									$button['relations'],
									$custom_colors, $button_icon );
							else:
								$wrapper_style_string = ( $button['button_style'] === 'custom_color' ) ? "style='--bonus-button-wrapper-background-color:{$custom_colors['bonus_background']};--bonus-button-wrapper-border:{$custom_colors['border']};--bonus-button-wrapper-border-style:{$custom_colors['border_style']};--bonus-text-color:{$custom_colors['bonus_color']}'" : '';
								$bonus_button_class = $button['is_enable_link'] ? 'bonus-button' : 'bonus-button bonus-button_single';
								?>
                                <div class='<?= $bonus_button_class ?>' <?= $wrapper_style_string ?>>
                                    <div class='bonus-button__value'>
                                        <span class="bonus-button__value-icon icon-docs"
                                              title="Click here to copy"></span>
                                        <span class="bonus-button__value-text"><?= $button['bonus_text'] ?></span>
                                    </div>
									<?php if ( $button['is_enable_link'] ) {
										echo app_get_button( $button,
											"$button_class button {$button_style}",
											$button['relations'],
											$custom_colors );
									} ?>
                                </div>
							<?php endif;
						endforeach;
						?>
                    </div>
				<?php endif; ?>
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
					else:
						$video = get_field( 'video' );
						echo app_get_video( $video );
					endif;
					?>
                </div>
			<?php endif; ?>
        </div>
    </div>
<?php
acf_block_after( $is_preview );
