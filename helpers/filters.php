<?php

// Disable gutenberg in widgets area
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );
add_filter( 'use_widgets_block_editor', '__return_false' );

// Remove figure's tags
function filter_figure( $content ) {
	$pattern     = "/<figure(.*?)<\/figure>/i";
	$replacement = '<div$1</div>';

	return preg_replace( $pattern, $replacement, $content );
}

function filter_figure_caption( $content ) {
	$pattern     = "/<figcaption(.*?)<\/figcaption>/i";
	$replacement = '<div$1</div>';

	return preg_replace( $pattern, $replacement, $content );
}

add_filter( 'the_content', 'filter_figure' );
add_filter( 'the_content', 'filter_figure_caption' );

// Remove title's anchors
function filter_h_anchors( $content ) {
	$pattern     = "/<h([\d])(.*?)id=\"(.*?)\">(.*?)<\/h([\d])>/i";
	$replacement = '<h$1$2>$4</h$5>';

	return preg_replace( $pattern, $replacement, $content );
}

add_filter( 'the_content', 'filter_h_anchors' );
add_filter( 'the_content', 'filter_h_anchors' );

// Filter: change <sub></sub> for <b></b>
function filter_sub( $content ) {
	$pattern     = "/<sub(.*?)<\/sub>/i";
	$replacement = '<b$1</b>';

	return preg_replace( $pattern, $replacement, $content );
}

add_filter( 'the_content', 'filter_sub' );
add_filter( 'the_content', 'filter_sub' );

// Remove canonical
if ( function_exists( 'gglstmp_canonical_tag' ) ) {
	remove_action( 'wp_head', 'gglstmp_canonical_tag' );
	add_action( 'wp_head', 'rel_canonical' );
}

// Revisions to keep
add_filter( 'wp_revisions_to_keep', function () {
	return 3;
} );

// Nofollow for outlinks
$is_nofollow_outlinks = get_field( 'nofollow_for_outlinks', 'options' );
if ( $is_nofollow_outlinks ) {
	add_filter( 'the_content', 'my_nofollow' );
	add_filter( 'the_excerpt', 'my_nofollow' );

	function my_nofollow( $content ) {
		return preg_replace_callback( '/<a[^>]+/', 'my_nofollow_callback', $content );
	}

	function my_nofollow_callback( $matches ) {
		$link      = $matches[0];
		$site_link = get_bloginfo( 'url' );
		if ( strpos( $link, 'rel' ) === false ) {
			$link = preg_replace( "%(href=\S(?!$site_link))%i", 'rel="nofollow" $1', $link );
		} elseif ( preg_match( "%href=\S(?!$site_link)%i", $link ) ) {
			$link = preg_replace( '/rel=\S(?!nofollow)\S*/i', 'rel="nofollow"', $link );
		}

		return $link;
	}
}

remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );

add_filter( 'after_setup_theme', 'remove_redundant_shortlink' );

function remove_redundant_shortlink() {
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
	remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
}

remove_filter( 'render_block', 'wp_render_layout_support_flag', 10, 2 );

add_filter( 'render_block', function ( $block_content, $block ) {
	if ( $block['blockName'] === 'core/columns' ) {
		return $block_content;
	}
	if ( $block['blockName'] === 'core/column' ) {
		return $block_content;
	}
	if ( $block['blockName'] === 'core/group' ) {
		return $block_content;
	}

	return wp_render_layout_support_flag( $block_content, $block );
}, 10, 2 );

// Self closing tags

if ( ! is_admin() && ( ! defined( 'DOING_AJAX' ) || ( defined( 'DOING_AJAX' ) && ! DOING_AJAX ) ) ) {
	ob_start( 'html5_slash_fixer' );
	add_action( 'shutdown', 'html5_slash_fixer_flush' );
}

function html5_slash_fixer( $buffer ) {
	return str_replace( ' />', '>', $buffer );
}

function html5_slash_fixer_flush() {
	ob_end_flush();
}
