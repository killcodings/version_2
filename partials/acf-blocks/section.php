<?php
$tag            = get_field( 'section_tag' ) ?? 'section';
$section_anchor = get_field( 'section_anchor' );
$section_class  = 'section-tag';
$opacity        = get_field('opacity') ?? '0';
$background_image = get_field('background_image');
$bg_url_img   = wp_get_attachment_image_url( $background_image );
$bg_url_img   = app_get_image_url( $bg_url_img );
$style_array    = [];

if ( get_field( 'background_color' ) ) {
	$style_array['background_color'] = "--background-color:" . get_field( 'background_color' );
}

if ( $background_image ) {
	$style_array['background_image'] = "--background-image: url({$bg_url_img});--opacity-bg:$opacity";
}

if ( get_field('padding_bottom') ) {
	$section_class .= ' section-tag_pb';
}

if ( ! isset( $GLOBALS['breadcrumbs_showed'] ) ) {
	$style_array['color']       = "--breadcrumbs-color:" . ( get_field( 'breadcrumbs_color' ) ?: '#fff' );
	$style_array['color_hover'] = "--breadcrumbs-color-hover:" . ( get_field( 'breadcrumbs_color_hover' ) ?: '#fff' );
}

$style_string = implode( ';', $style_array ) ? 'style="' . implode( ';', $style_array ) . '"' : '';
$id_string    = $section_anchor ? "id='$section_anchor'" : '';

acf_block_before( 'Секция', $is_preview );
?>
<?= "<$tag class='$section_class' $id_string $style_string>" ?>
    <div class="container">
		<?php if ( ( ! isset( $GLOBALS['breadcrumbs_showed'] ) ) && function_exists( 'kama_breadcrumbs' ) ) {
			$GLOBALS['breadcrumbs_showed'] = false;
			$breadcrumbs_separator         = get_option( 'options_breadcrumbs_settings_separator' );
			kama_breadcrumbs( $breadcrumbs_separator );
		} ?>
        <InnerBlocks/>
    </div>
<?= "</$tag>" ?>
<?php
acf_block_after( $is_preview );
