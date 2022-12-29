<?php

$isBrandPage  = is_page_template( 'brand-page.php' );
$isAppPage    = is_page_template( 'app-page.php' );
$isReviewPage = is_page_template( 'review-page.php' );
$site_name    = get_field( 'site_name', 'options' );
$meta_fields  = get_field( 'meta_fields', $post->ID );

if ( $isBrandPage || $isAppPage || $isReviewPage ) {
	$review_setup = get_field( 'brand_setup' );
	$author_setup = get_field( 'user_setup', 'user_' . $post->post_author );

	if ( $review_setup['microdata_type'] === 'game' ) {
		$json_arr = [
			'@context'     => 'https://schema.org/',
			'@type'        => 'Review',
			'dateModified' => get_the_modified_date( 'Y-m-d', $post->ID ),
			'name'         => $review_setup['name'],
			'author'       => [
				'@type' => 'Person',
				'name'  => "{$author_setup['name']} {$author_setup['last_name']}",
				'url'   => get_author_posts_url( $post->post_author )
			],
			'itemReviewed' => [
				'@type'       => 'Organization',
				'image'       => app_get_image_url( wp_get_attachment_image_url( $review_setup['icon'], 'full' ) ),
				'name'        => $review_setup['name'],
				'description' => $meta_fields['description']
			],
			'publisher'    => [
				'@type' => 'Organization',
				'name'  => $site_name,
				'url'   => home_url()
			],
			'reviewRating' => [
				'@type'       => 'Rating',
				'bestRating'  => '5',
				'ratingValue' => $review_setup['rating'],
				'worstRating' => '1'
			]
		];
	} elseif ( $review_setup['microdata_type'] === 'app' ) {
		$json_arr = [
			'@context'            => 'https://schema.org/',
			'@type'               => 'SoftwareApplication',
			'name'                => $review_setup['name'],
			'operatingSystem'     => implode( ',', $review_setup['operation_systems'] ),
			'applicationCategory' => 'GameApplication',
			'aggregateRating'     => [
				'@type'       => 'AggregateRating',
				'ratingValue' => $review_setup['rating'],
				'ratingCount' => round( ( time() / 100 ) / $post->ID )
			],
			'offers'              => [
				'@type'         => 'Offer',
				'price'         => $review_setup['price_and_currency']['price'],
				'priceCurrency' => $review_setup['price_and_currency']['currency']
			]
		];
	} else {
		$json_arr = false;
	}

	if ( $json_arr ) {
		$json_arr = json_encode( app_array_filter_recursive( $json_arr ), JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

		echo "<script type='application/ld+json'>" . $json_arr . "</script>";
	}

}
