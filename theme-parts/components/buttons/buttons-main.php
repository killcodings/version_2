<?php
$buttons       = $args['add_buttons'];
$buttons_class = '';
$buttons_class = "buttons_columns-{$args['columns']}";

echo "<pre>";
var_dump($args);
echo "</pre>";

$buttons_setting = $args['buttons_setting'];

$button_width     = $buttons_setting['button_width'] ?? false;
$position_buttons = $buttons_setting['position_buttons'] ?? 'start';
$button_style     = $buttons_setting['button_style'] ?? 'outline';
$buttons_border   = $buttons_setting['buttons_border'] ?? false;



if ( $buttons_border ) {
	$buttons_class .= " buttons_border";
}

$position_image = match ( $args['position_image_buttons'] ) {
	'top' => 'button_column',
	'left' => '',
	false => '',
	null => '',
	'' => '',
};

if ( $button_width ) {
	$button_width = "--button-width:{$button_width}px";
}

$style = "style = '--position-buttons:$position_buttons;$button_width'";

?>

<div class="buttons <?= $buttons_class ?>" <?= $style ?> >
	<?php foreach ( $buttons as $key => $button ) {

		$button_image = '';
		$icon_url     = wp_get_attachment_image_url( $button['image'] );
		if ( $icon_url ) {
			$icon_url     = app_get_image_url( $icon_url );
			$button_image = "<span class = 'button__image' style = 'background-image: url($icon_url);'></span>";
		}

		$is_button_icon = $button['button_icon_use'] ?? false;

		?>
        <div>

			<?php echo app_get_button( $button['button'], "buttons__item button_{$button_style} $position_image", null, $buttons_setting, $button_image, $is_button_icon ); ?>

        </div>
		<?php } ?>
</div>

