<?php

$style_array = [
	'heading_color' => $args['heading-color'] ? "--text-color:{$args['heading-color']}" : '',
	'background' => $args['background'] ? "--background:{$args['background']}" : '',
	'bg_icon' => $args['background'] ? "--bg-icon:{$args['bg_icon']}" : ''
];


$style_array = app_array_filter_recursive($style_array);
$style_str = implode(';', $style_array);

?>

<div class = "version-page-app" style="<?=$style_str?>">
	<div class="version-page-app__content">
		<p class="version-page-app__title"><?= $args['heading'] ?></p>
		<p class="version-page-app__subtitle"><?= $args['subtitle'] ?></p>
	</div>
	<?=
    app_get_button( $args['button'],
		"site-button version-page-app__button {$args['button_style']}",
	    $args['relations'],
	    $args['custom_colors'])
	?>
</div>
