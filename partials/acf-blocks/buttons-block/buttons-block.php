<?php
$buttons_group = get_field('buttons_group', $post->ID);

//$add_buttons     = get_field( 'add_buttons' );
//$buttons_setting = get_field( 'buttons_setting' );
//$columns         = get_field( 'columns' );
//
//$buttons_main_setting = [
//	'add_buttons'     => $add_buttons,
//	'buttons_setting' => $buttons_setting,
//	'columns'         => $columns
//];

$args = [
	'buttons_group' => $buttons_group,
//	'buttons_group'          => $add_buttons,
//	'buttons_color'          => $buttons_color,
//	'columns'                => $columns,
//	'position_image_buttons' => $position_image_buttons
];

acf_block_before( 'Кнопки', $is_preview );

echo get_component( 'buttons/buttons', $args );

acf_block_after( $is_preview );



