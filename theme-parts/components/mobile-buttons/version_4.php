<?php
$style_array = [
    'bg_blocks' => $args['bg_blocks'] ? "--bg-blocks:{$args['bg_blocks']}" : '',
    'color_text_bonus' => $args['color_text_bonus'] ? "--color_text_bonus:{$args['color_text_bonus']}" : '',
    'background' => $args['background'] ? "--background:{$args['background']}" : ''
];

$style_array = app_array_filter_recursive($style_array);
$style_str = implode(';', $style_array);

?>

<div class = "version-horizontal-blocks version-4" style="<?=$style_str?>">
    <div class="horizontal-blocks">
        <div class="block">
            <div class="block__icon">
	            <?= app_get_image( [ 'id' => $args['icon_1'] ] ) ?>
            </div>
            <div class="block__content">
                <div class="block__title"><?= $args['horizontal_blocks']['title_1'] ?></div>
                <div class="block__value"><?= $args['horizontal_blocks']['bonus_1'] ?></div>
            </div>
        </div>
        <div class="block">
            <div class="block__icon">
	            <?= app_get_image( [ 'id' => $args['icon_2'] ] ) ?>
            </div>
            <div class="block__content">
                <div class="block__title"><?= $args['horizontal_blocks']['title_2'] ?></div>
                <div class="block__value"><?= $args['horizontal_blocks']['bonus_2'] ?></div>
            </div>
        </div>
        <div class="block">
            <div class="block__icon">
                ★
            </div>
            <div class="block__content">
                <div class="block__title"></div>
                <div class="block__value"><?= $args['rating'] ?></div>
            </div>
        </div>
    </div>
    <?= app_get_button( $args['button'],
        "site-button version-horizontal-blocks__button {$args['button_style']}",
        $args['relations'],
        $args['custom_colors']);
    ?>
</div>
