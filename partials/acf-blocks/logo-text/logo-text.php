<?php

$args_setting = get_field('block_icon_group');

acf_block_before( 'Блок с иконкой', $is_preview );

echo get_component( 'icon-block/icon-block', $args_setting );

acf_block_after( $is_preview );
