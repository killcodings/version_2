<?php
$style_array = [
    'background' => $args['background'] ? "--background:{$args['background']}" : ''
];

$style_array = app_array_filter_recursive($style_array);
$style_str = implode(';', $style_array);

?>

<div class = "version-logo version-3" style="<?=$style_str?>">
    <div class="version-logo__logo">
        <?= app_get_image( [ 'id' => $args['logo'] ] ) ?>
    </div>
    <?= app_get_button( $args['button'],
        "site-button version-logo__button {$args['button_style']}",
        $args['relations'],
        $args['custom_colors']);
    ?>
</div>
