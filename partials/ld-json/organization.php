<?php

$is_enabled_organization_json = get_field( 'is_enabled_organization_json', 'options' );
if ( $is_enabled_organization_json ) {
	$site_name          = get_field( 'site_name', 'options' );
	$logo_url           = app_get_image_url( wp_get_attachment_image_url( get_field( 'header_logotype', 'options' ), 'full' ) );
	$site_url           = get_home_url();
	$organization_setup = get_field( 'organization_setup', 'options' );
	$author_setup       = get_field( 'user_setup', 'user_' . $post->post_author );
	$social_links       = get_field( 'social_footer', 'options' );
	foreach ( $social_links as $social_link ) {
		$social_links_arr[] = $social_link['link'];
	}

	$json_arr = [
		'@context'     => 'https://schema.org/',
		'@type'        => 'Organization',
		'name'         => $site_name,
		'legalName'    => $site_name,
		'url'          => $site_url,
		'logo'         => $logo_url,
		'foundingDate' => $organization_setup['founding_date'],
		'founders'     => [
			'@type' => 'Person',
			'name'  => "{$author_setup['name']} {$author_setup['last_name']}"
		],
		'address'      => [
			'@type'           => 'PostalAddress',
			'streetAddress'   => $organization_setup['address']['street'],
			'addressLocality' => $organization_setup['address']['city'],
			'addressRegion'   => $organization_setup['address']['region'],
			'postalCode'      => $organization_setup['address']['postal_code'],
			'addressCountry'  => $organization_setup['address']['country']
		],
		'contactPoint' => [
			'@type'       => 'ContactPoint',
			'contactType' => 'customer support',
			'telephone'   => $organization_setup['telephone'],
			'email'       => $organization_setup['email']
		],
		'sameAs'       => [
			implode( ',', $social_links_arr )
		]
	];

	$json_arr = json_encode( app_array_filter_recursive( $json_arr ), JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

	echo "<script type='application/ld+json'>" . $json_arr . "</script>";

}
