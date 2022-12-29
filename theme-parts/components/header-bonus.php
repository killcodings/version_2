<?php

$button = $args['link'];
$heading = $args['title'];
$style_array = [
	'background' => $args['background'] ? "--background:{$args['background']}" : '',
	'color_heading' => $args['color-heading'] ? "--color-heading:{$args['color-heading']}" : '',
	'color_link' => $args['color-link'] ?  "--color-link:{$args['color-link']}" : ''
];
$style_array = app_array_filter_recursive($style_array);
$style_str = implode(';', $style_array);

if ($button) : ?>
<aside class="header-bonus" style="<?=$style_str?>">
    <div class="container">
        <div class="header-bonus__block">
            <div class="header-bonus__logo">
	            <?php echo app_get_image( [ 'id' => $args['image'] ] ) ?>
            </div>
            <div class="header-bonus__content">
                <h2 class="header-bonus__title"><?= $heading ?></h2>
	            <?php echo app_get_button($button, 'header-bonus__button', null, null, $button_icon = '<span class="arrow"></span>') ?>
            </div>
        </div>
    </div>
</aside>
<?php endif; ?>