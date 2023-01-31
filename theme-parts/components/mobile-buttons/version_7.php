<?php

$style_array = [
	'heading_color' => $args['heading-color'] ? "--text-color:{$args['heading-color']}" : '',
	'background' => $args['background'] ? "--background:{$args['background']}" : '',
	'subtitle_color' => $args['subtitle-color'] ? "--subtitle-color:{$args['subtitle-color']}" : '',
	'bg_icon' => $args['bg_icon'] ? "--bg-icon:{$args['bg_icon']}" : 'transparent'
];



$logo = app_get_image( [ 'id' => $args['logo'] ] );
$heading = $args['heading'];
$rating = $args['rating'];
$link = $args['button'];

var_dump($link);

$settings_brand_setup = $args['brand_setup'];

if ($settings_brand_setup) {
	$style_array = [
		'heading_color' => $args['heading-color'] ? "--text-color:{$args['heading-color']}" : '',
		'background' => $args['background'] ? "--background:{$args['background']}" : '',
		'subtitle_color' => $args['subtitle-color'] ? "--subtitle-color:{$args['subtitle-color']}" : '',
		'bg_icon' => $settings_brand_setup['icon_background'] ? "--bg-icon:{$settings_brand_setup['icon_background']}" : 'transparent'
	];

//	var_dump($settings_brand_setup);
	$logo = app_get_image( [ 'id' => $settings_brand_setup['icon'] ] );
	$heading = $settings_brand_setup['name'];
	$rating = $settings_brand_setup['rating'];

	$link_type = $settings_brand_setup['choose_link'];
	$link = $settings_brand_setup[$link_type];

	var_dump($link_type);
    var_dump($link);
}



$style_array = app_array_filter_recursive($style_array);
$style_str = implode(';', $style_array);

?>

<div class="version_7" style="<?=$style_str?>">

    <div class="version_7__logo">
		<?= $logo ?>
    </div>
    <div class="version_7__content">
        <div class="version_7__title"><?= $heading ?></div>
        <div class="version_7__rating">
            <div class="version_7__rating-stars">★</div>
            <div class="version_7__rating-value"><?= $rating ?></div>
        </div>
    </div>
	<?=
	app_get_button($link,
		"button version-page-app__button {$args['button_style']}",
		$args['relations'],
		$args['custom_colors'])
	?>
</div>
