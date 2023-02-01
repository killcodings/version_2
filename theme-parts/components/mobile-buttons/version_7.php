<?php

$style_array = [
	'heading_color' => $args['heading-color'] ? "--text-color:{$args['heading-color']}" : '',
	'background' => $args['background'] ? "--background:{$args['background']}" : '',
	'subtitle_color' => $args['subtitle-color'] ? "--subtitle-color:{$args['subtitle-color']}" : '',
	'bg_icon' => $args['bg_icon'] ? "--bg-icon:{$args['bg_icon']}" : 'transparent',
	'rating' => $args['rating'] ? "--rating:{$args['rating']}" : '5'
];

$logo = app_get_image( [ 'id' => $args['logo'] ] );
$heading = $args['heading'];
$rating = $args['rating'];
$link = $args['button'];


$settings_brand_setup = $args['brand_setup'];
if ($settings_brand_setup) {
	$style_array = [
		'heading_color' => $args['heading-color'] ? "--text-color:{$args['heading-color']}" : '',
		'background' => $args['background'] ? "--background:{$args['background']}" : '',
		'bg_icon' => $settings_brand_setup['icon_background'] ? "--bg-icon:{$settings_brand_setup['icon_background']}" : 'transparent',
	    'rating' => $settings_brand_setup['rating'] ? "--rating:{$settings_brand_setup['rating']}" : '5'
    ];

    $class = ' version_7-brand-setup';
	$logo = app_get_image( [ 'id' => $settings_brand_setup['icon'] ] );
	$heading = $settings_brand_setup['name'];
	$rating = $settings_brand_setup['rating'];

	$link_type = $settings_brand_setup['choose_link'];
	$link = $settings_brand_setup[$link_type] ?: $settings_brand_setup['brand_setup_choose_link'];

    if ($settings_brand_setup['choose_link'] === 'brand_setup_choose_link') {
	    $link = $settings_brand_setup['brand_setup_choose_link'];
    }
	$link = ['url' => $link, 'title' => $args['button']['title']];
}

$style_array = app_array_filter_recursive($style_array);
$style_str = implode(';', $style_array);

?>

<div class="version_7<?=$class?>" style="<?=$style_str?>">
    <div class="version_7__logo">
		<?= $logo ?>
    </div>
    <div class="version_7__content">
        <div class="version_7__logo-content">
            <div class="version_7__title"><?= $heading ?></div>
            <div class="version_7__rating">
                <div class="version_7__rating-stars">★</div>
                <div class="version_7__rating-stars">★★★★★</div>
                <div class="version_7__rating-value"><?= $rating ?></div>
            </div>
        </div>
        <div class="brands-bonus">
            <h3 class="brands-bonus-title"><?= $settings_brand_setup['brands-bonus-title'] ?></h3>
            <div class="brands-bonus-value">
                <div class="brands-bonus-icon">
                    <svg class="brands__bonus-resize" fill="none">
                        <use xlink:href="#bonus__icon-item-present"></use>
                    </svg>
                </div>
			    <?= $settings_brand_setup['bonus'] ?>
            </div>
        </div>
    </div>
	<?=
	app_get_button($link,
		"button version_7__button {$args['button_style']}",
		$args['relations'],
		$args['custom_colors'])
	?>
</div>
