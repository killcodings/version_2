<?php

$logo_text_group = $args;
$logo_text_size = $logo_text_group['logo_text_size'] ?? '50';
$background_color_logo_text = $logo_text_group['background_color_logo_text'] ?? '#000';
$logo_text_image = $logo_text_group['logo_text_image'];
$logo_text_text  = $logo_text_group['logo_text_text'];
?>

<div class="logo-text">
    <div class="logo-text__logo" style="--logo-text-size: <?=$logo_text_size.'px'?>;--background-color-logo-text: <?=$background_color_logo_text?>">
        <?= app_get_image( [ 'id' => $logo_text_image, 'classes' => '' ] ) ?>
    </div>
    <div class="logo-text__text"><?= $logo_text_text ?></div>
</div>