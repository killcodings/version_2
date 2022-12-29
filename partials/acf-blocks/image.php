<?php
$image_id = get_field( 'image_id' );

acf_block_before('Изображение', $is_preview);

echo app_get_image( [
	'id' => $image_id,
	'classes' => 'image test'
] );

acf_block_after($is_preview);
