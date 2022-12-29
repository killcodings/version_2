<?php
$is_enabled_article_json = get_field( 'is_enabled_article_json', 'options' ) ?? false;
if ( $is_enabled_article_json && is_singular() ) {
	$page_setup = get_field( 'meta_fields', $post->ID );

	$post_published_date = get_the_date( 'Y-m-d', $post->ID );
	$post_modified_date  = get_the_modified_date( 'Y-m-d', $post->ID );
	$post_keywords       = $page_setup['keywords'];
	$page_image_ID       = $page_setup['image'];
	$post_image_url      = app_get_image_url( wp_get_attachment_image_url( $page_image_ID, 'full' ) );
	$site_logo_url       = app_get_image_url( wp_get_attachment_image_url( get_field( 'header_logotype', 'options' ), 'full' ) );
	$page_url            = get_the_permalink( $post->ID );
	$page_title          = $page_setup['title'];
	$page_description    = $page_setup['description'];
	$site_name           = get_field( 'site_name', 'options' );

	$author_setup = get_field( 'user_setup', 'user_' . $post->post_author );

	$json_arr = [
		"@context"         => "https://schema.org",
		"@type"            => 'Article',
		'headline'         => $page_title,
		'image'            => $post_image_url,
		'author'           => [
			'@type' => 'Person',
			'name'  => "{$author_setup['name']} {$author_setup['last_name']}",
			'url'   => get_author_posts_url( $post->post_author )
		],
		'keywords'         => $post_keywords,
		'publisher'        => [
			'@type' => 'Organization',
			'name'  => $site_name,
			'logo'  => [
				'@type' => 'ImageObject',
				'url'   => $site_logo_url
			]
		],
		'url'              => $page_url,
		'mainEntityOfPage' => [
			'@type' => 'WebPage',
			'@id'   => 'https://google.com/article'
		],
		'datePublished'    => $post_published_date,
		'dateCreated'      => $post_published_date,
		'dateModified'     => $post_modified_date,
		'description'      => $page_description
	];

	$json_arr = json_encode( app_array_filter_recursive( $json_arr ), JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

	echo "<script type='application/ld+json'>" . $json_arr . "</script>";
}
