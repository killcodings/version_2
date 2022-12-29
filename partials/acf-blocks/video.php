<?php
$video = [
	'thumbnail_id'      => get_field( 'thumbnail_id' ),
	'youtube_site'      => get_field( 'youtube_site' ),
	'name'              => get_field( 'name' ),
	'description'       => get_field( 'description' ),
	'upload_date'       => get_field( 'upload_date' ),
	'youtube_video_url' => get_field( 'youtube_video_url' ),
	'site_video_url'    => get_field( 'site_video_url' )
];

acf_block_before( 'Видео', $is_preview );
echo app_get_video( $video );
acf_block_after( $is_preview );
