<?php

//$brand_screen_logo = get_field('brand-screen-logo');
//$brand_screen_top_title = get_field('brand-screen-top-title');
//$background_brand_screen_logo = get_field('background-brand-screen-logo') ?: 'transparent';
//$opacity_bg = get_field('opacity-bg') ?? 0.2;
//$list_title = get_field('list_title');

$lists = get_field( 'lists' );


acf_block_before( 'Список', $is_preview );

$list_setting = [
	'list' => $lists['list']
];

echo get_component( 'lists/lists', $list_setting );

acf_block_after( $is_preview );
