<?php

$assets_ver = filemtime( get_template_directory() . '/dist/css/app.css' );

add_action( 'wp_enqueue_scripts', function () {
	global $assets_ver;
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'global-styles' );
	/*$font = get_field( 'font', 'options' ) ?? 'Montserrat';
	if ( $font === 'Montserrat' ) {
		wp_enqueue_style( 'fonts', get_template_directory_uri() . '/dist/css/montserrat.css', null, $assets_ver );
	} elseif ( $font === 'Roboto' ) {
		wp_enqueue_style( 'fonts', get_template_directory_uri() . '/dist/css/roboto.css', null, $assets_ver );
	}*/
	wp_enqueue_style( 'index', get_template_directory_uri() . '/dist/css/app.css', null, $assets_ver );
	wp_enqueue_script( 'index', get_template_directory_uri() . '/dist/js/app.js', null, $assets_ver, true );
	wp_localize_script( 'index', 'jsVars', [ 'ajaxurl' => admin_url( 'admin-ajax.php' ) ] );
} );

/*add_action( 'wp_footer', function () {
	global $assets_ver;
	wp_enqueue_style( 'index', get_template_directory_uri() . '/dist/css/app.css', null, $assets_ver );
} );*/

// Dequeue assets
add_action( 'init', function () {
	remove_action( 'wp_head', 'wp_resource_hints', 2 );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
} );

remove_action( 'wp_head', 'feed_links_extra', 3 );

remove_action( 'wp_head', 'feed_links', 2 );

add_action( 'after_setup_theme', function () {
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
} );

remove_action( 'wp_head', 'rsd_link' );

remove_action( 'wp_head', 'wlwmanifest_link' );

remove_action( 'wp_head', 'wp_generator' );

remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );

add_action( 'wp_footer', function () {
	wp_dequeue_script( 'wp-embed' );
} );

add_theme_support( 'html5', array(
	'comment-list',
	'comment-form',
	'search-form',
	'gallery',
	'caption',
	'style',
	'script'
) );
