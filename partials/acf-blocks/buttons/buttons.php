<?php
$add_buttons     = get_field( 'add_buttons' );
$buttons_setting = get_field( 'buttons_setting' );
$columns         = get_field( 'columns' );

$buttons_main_setting = [
	'add_buttons'     => $add_buttons,
	'buttons_setting' => $buttons_setting,
	'columns'         => $columns
];

acf_block_before( 'Кнопки', $is_preview );

echo get_component( 'buttons/buttons-main', $buttons_main_setting );

acf_block_after( $is_preview );



