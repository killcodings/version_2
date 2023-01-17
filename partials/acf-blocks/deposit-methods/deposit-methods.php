<?php

$settings = get_field('settings');

acf_block_before( 'Депозитные методы', $is_preview );

$deposit_methods_setting = [
	'settings' => $settings
];

echo get_component( 'deposit-methods/deposit-methods', $deposit_methods_setting );

acf_block_after( $is_preview );