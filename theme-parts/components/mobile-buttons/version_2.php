<?php
$style_array = [
    'heading_color' => $args['heading-color'] ? "--heading-color:{$args['heading-color']}" : '',
    'subtitle_color' => $args['subtitle-color'] ? "--subtitle-color:{$args['subtitle-color']}" : '',
    'background' => $args['background'] ? "--background:{$args['background']}" : ''
];

$style_array = app_array_filter_recursive($style_array);
$style_str = implode(';', $style_array);
?>

<div class = "version-logo-content version-2" style="<?=$style_str?>">
    <div class="version-logo-content__logo">
        <?= app_get_image( [ 'id' => $args['logo'] ] ) ?>
    </div>
    <div class="version-logo-content__content">
        <h2 class="version-logo-content__title"><?= $args['heading'] ?></h2>
        <div class="version-logo-content__bottom">
            <div class="version-logo-content__bonus">
                <div class="version-logo-content__bonus-icon"><?= app_get_image( [ 'id' => $args['icon'] ] ) ?></div>
                <h3 class="version-logo-content__bonus-title"><?= $args['subtitle'] ?></h3>
            </div>
            <div class="version-logo-content__rating">
                <div class="version-logo-content__rating-stars">★</div>
                <div class="version-logo-content__rating-value"><?= $args['rating'] ?></div>
            </div>
        </div>
    </div>
    <?= app_get_button( $args['button'],
        "site-button version-logo-content__button {$args['button_style']}",
        $args['relations'],
        $args['custom_colors']);
    ?>
</div>
