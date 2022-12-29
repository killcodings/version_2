<?php

	$settings = $args['settings'];

	$button_style  = $settings['button_style'] ? 'site-button_' . $settings['button_style'] : 'site-button_outline';

	$choose_link = $settings['choose'];
	if ( $choose_link === 'input_link' ) {
		$button['url'] = $settings['input_link'];
	} else {
		$button['url'] = $settings['text_image_choose_link'];
	}
	$button['title'] = $settings['title'];
	$custom_colors   = '';
	if ( $settings['button_style'] === 'custom_color' ) {
		$custom_colors = $settings['colors'];
	}

	$version = $args['version'];
	$args_version = [
		'button' => $button,
		'button_style' => $button_style,
		'relations' => $settings['relations'],
		'custom_colors' => $custom_colors,
		'gradient' => $settings['linear-gradient'],
		'background' => $settings['background'],
		'heading-color' => $settings['heading_color'],
		'heading' => $settings['heading'],
		'subtitle' => $settings['subtitle'],
		'subtitle-color' => $settings['subtitle_color'],
		'rating' => $settings['rating'],
		'logo' => $settings['logo'],
		'icon' => $settings['icon'],
		'bg_blocks' => $settings['bg-blocks'],
		'horizontal_blocks' => $settings['horizontal_blocks'],
		'color_text_bonus' => $settings['color_text_bonus'],
		'bg_arrow' => $settings['bg_arrow'],
		'icon_1' => $settings['icon_1'],
		'icon_2' => $settings['icon_2'],
		'bg_icon' => $settings['bg_icon']
	];

	get_template_part("theme-parts/components/mobile-buttons/$version", null, $args_version);
