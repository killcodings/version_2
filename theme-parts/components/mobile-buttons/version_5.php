<?php
$style_array = [
    'heading_color' => $args['heading-color'] ? "--heading-color:{$args['heading-color']}" : '',
    'bg_arrow' => $args['bg_arrow'] ? "--dg-arrow:{$args['bg_arrow']}" : '',
    'background' => $args['background'] ? "--background:{$args['background']}" : '',
    'bg_icon' => $args['background'] ? "--bg-icon:{$args['bg_icon']}" : ''
];

$style_array = app_array_filter_recursive($style_array);
$style_str = implode(';', $style_array);

?>

<div class = "version-content-button version-5" style="<?=$style_str?>">
    <div class="version-content-button__content">
        <h3 class="version-content-button__content-title"><?= $args['heading'] ?></h3>
    </div>
    <?= app_get_button( $args['button'],
        "site-button version-content-button__button {$args['button_style']}",
        $args['relations'],
        $args['custom_colors'], app_get_image( [ 'id' => $args['logo']] ));
    ?>
</div>
