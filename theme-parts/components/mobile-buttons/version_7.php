<?php

$style_array = [
	'heading_color' => $args['heading-color'] ? "--text-color:{$args['heading-color']}" : '',
	'background' => $args['background'] ? "--background:{$args['background']}" : '',
	'subtitle_color' => $args['subtitle-color'] ? "--subtitle-color:{$args['subtitle-color']}" : '',
	'bg_icon' => $args['background'] ? "--bg-icon:{$args['bg_icon']}" : ''
];

$style_array = app_array_filter_recursive($style_array);
$style_str = implode(';', $style_array);

?>

<div class="version_7" style="<?=$style_str?>">

    <div class="version_7__logo">
		<?= app_get_image( [ 'id' => $args['logo'] ] ) ?>
    </div>
    <div class="version_7__content">
        <div class="version_7__title"><?= $args['heading'] ?></div>
        <div class="version_7__rating">
            <div class="version_7__rating-stars">★</div>
            <div class="version_7__rating-value"><?= $args['rating'] ?></div>
        </div>
    </div>
	<?=
	app_get_button( $args['button'],
		"button version-page-app__button {$args['button_style']}",
		$args['relations'],
		$args['custom_colors'])
	?>
</div>
