<?php
//$buttons       = $args['add_buttons'];

$buttons_group = $args['buttons_group'];
$buttons       = $buttons_group['button_repeater'];

$buttons_class    = '';
$buttons_width    = $buttons_group['buttons_width'] ?? false;
$buttons_position = $buttons_group['buttons_position'] ?? 'start';
$buttons_setup    = false;
$button_style     = $buttons_group['button_style'] ?? 'outline';
$buttons_item_class = $buttons_group['buttons_item_class'] ?? '';
$buttons_class    = "buttons_columns-{$buttons_group['columns']}";
$buttons_border   = $buttons_group['buttons_border'] ?? false;
$buttons_setup    = $buttons_group['buttons_setup'];

$buttons_item_class .= " button_{$button_style}";

if ( $buttons_border ) {
	$buttons_class .= " buttons_border";
}

$style_array = [
	'width'            => $buttons_width ? "--button-width:{$buttons_width}" : '',
	'buttons_position' => "--position-buttons:{$buttons_position}",
];
$style_array = app_array_filter_recursive( $style_array );
$style_str   = implode( ';', $style_array );
?>

<div class="buttons <?= $buttons_class ?>" style="<?= $style_str ?>">
	<?php foreach ( $buttons as $key => $button ) {

		$button_image = '';
		$icon_url     = wp_get_attachment_image_url( $button['image'] );
		if ( $icon_url ) {
			$icon_url     = app_get_image_url( $icon_url );
			$button_image = "<span class = 'button__image' style = 'background-image: url($icon_url);'></span>";
		}

		$button_icon = $button['button_icon_use'] ?? false;
		echo app_get_button( $button['button'], "buttons__item $buttons_item_class", null, $buttons_setup, $button_image, $button_icon );

	} ?>
</div>

