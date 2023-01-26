<?php

$is_checked                 = $args['is_logo_text'] ?? false;
$settings                   = $args['block_icon_group_settings'];
$logo_text_size             = $settings['logo_text_size'] ?? '50';
$background_color_logo_text = $settings['background_color_logo_text'] ?? '#000';
$logo_text_image            = $settings['logo_text_image'];
$logo_text_text             = $settings['logo_text_text'];
$logo_text_class            = $settings['class'] ?? false;
$tag                        = $settings['tag'] ?? 'h3';


if ( $is_checked ) :
	?>
<div class="logo-text <?= $logo_text_class ?>">
    <div class="logo-text__logo"
         style="--logo-text-size: <?= $logo_text_size . 'px' ?>;--background-color-logo-text: <?= $background_color_logo_text ?: 'transparent' ?>">
		<?= app_get_image( [ 'id' => $logo_text_image, 'classes' => '' ] ) ?>
    </div>
    <<?= $tag ?> class="logo-text__text"><?= $logo_text_text ?></<?= $tag ?>>
    </div>
<?php endif;