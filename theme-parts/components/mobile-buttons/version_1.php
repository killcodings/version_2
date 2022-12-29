<?php
$style_array = [
    'color_1' => $args['gradient']['color_1'] ? "--buttons-gradiend-start:{$args['gradient']['color_1']}" : '',
    'color_2' => $args['gradient']['color_2'] ? "--buttons-gradiend-end:{$args['gradient']['color_2']}" : '',
    'heading_color' => $args['heading-color'] ? "--heading-color:{$args['heading-color']}" : '',
    'subtitle_color' => $args['subtitle-color'] ? "--subtitle-color:{$args['subtitle-color']}" : ''
];

$style_array = app_array_filter_recursive($style_array);
$style_str = implode(';', $style_array);
?>

<div class = "version-deposit version-1" style="<?=$style_str?>">
    <div class="version-deposit__content">
        <h2 class="version-deposit__title"><?= $args['heading'] ?></h2>
        <a class="version-deposit__subtitle" href=<?= $args['button']['url']?>>
            <?= $args['subtitle'] ?>
        </a>
    </div>
    <?= app_get_button( $args['button'],
        "site-button version-deposit__button {$args['button_style']}",
        $args['relations'],
        $args['custom_colors']);
    ?>
</div>
