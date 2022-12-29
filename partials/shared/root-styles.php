<?php
$buttons_setup         = get_field( 'buttons_setup', 'options' );
$primary_nav_colors    = get_field( 'primary_nav_colors', 'options' );
$footer_colors         = get_field( 'footer_colors', 'options' );
$accent_color          = get_field( 'accent_color', 'options' );
$accent_color_text     = get_field( 'accent_color_text', 'options' );
$logo_max_width        = get_field( 'logo_max_width', 'options' );
$is_change_body_colors = get_field( 'is_change_body_colors', 'options' ) ?? false;
$font                  = get_field( 'font', 'options' ) ?: 'Montserrat';
?>
<style>
    :root {
        --body-font: <?= $font ?>;
        --logo-max-width: <?= $logo_max_width - 20 ?: '140' ?>px;
        --accent-color: <?= $accent_color ?: '#000' ?>;
        --accent-color-text: <?= $accent_color_text ?: '#fff' ?>;
        --buttons-background: <?= $buttons_setup['background'] ?: '#FFF' ?>;
        --buttons-background-hover: <?= $buttons_setup['background_hover'] ?: '#000' ?>;
        --buttons-color: <?= $buttons_setup['color'] ?: '#000' ?>;
        --buttons-color-hover: <?= $buttons_setup['color_hover'] ?: '#FFF' ?>;
        --burger-color: <?= $primary_nav_colors['color_burger'] ?: ($accent_color_text ?: '#000' )?>;
        --buttons-border: <?= $buttons_setup['border'] ?: '#000' ?>;
        --buttons-border-hover: <?= $buttons_setup['border_hover'] ?: '#FFF' ?>;
        --buttons-border-radius: <?= $buttons_setup['border_radius'] . 'px' ?: '50px' ?>;
        --buttons-border-style: <?= $buttons_setup['border_style'] ?: 'dashed' ?>;
        --buttons-gradiend-start: <?= $buttons_setup['gradient_colors']['start_color'] ?: '#EEE' ?>;
        --buttons-gradiend-end: <?= $buttons_setup['gradient_colors']['end_color'] ?: '#CCC' ?>;
        --buttons-gradiend-color: <?= $buttons_setup['gradient_colors']['color'] ?: '#FFF' ?>;
        --buttons-gradiend-color-hover: <?= $buttons_setup['gradient_colors']['color_hover'] ?: '#FFF' ?>;
        --primary-nav-background: <?= $primary_nav_colors['background'] ?: '#000' ?>;
        --primary-nav-background-mobile: <?= $primary_nav_colors['background_mobile'] ?: '#000' ?>;
        --primary-nav-color: <?= $primary_nav_colors['color'] ?: '#FFF' ?>;
        --primary-nav-color-mobile: <?= $primary_nav_colors['color_mobile'] ?: '#FFF' ?>;
        --primary-nav-color-hover: <?= $primary_nav_colors['color_hover'] ?: '#EEE' ?>;
        --primary-nav-submenu-background: <?= $primary_nav_colors['submenu_background'] ?: '#FFF' ?>;
        --primary-nav-submenu-shadow: <?= $primary_nav_colors['submenu_shadow'] ?: 'rgba(0, 0, 0, 0.1)' ?>;
        --primary-nav-submenu-color: <?= $primary_nav_colors['submenu_color'] ?: '#000' ?>;
        --primary-nav-submenu-color-hover: <?= $primary_nav_colors['submenu_color_hover'] ?: '#000' ?>;
        --primary-nav-submenu-border: <?= $primary_nav_colors['submenu_border'] ?: '#000' ?>;
        --primary-nav-submenu-border-style: <?= $primary_nav_colors['submenu_border_style'] ?: 'dashed' ?>;
        --primary-nav-submenu-arrow: <?= $primary_nav_colors['submenu_arrow'] ?: '#000' ?>;
        --footer-background: <?= $footer_colors['background_color'] ?: '#000' ?>;
        --footer-title-color: <?= $footer_colors['title_color'] ?: '#FFF' ?>;
        --footer-item-color: <?=  $footer_colors['item_color'] ?: '#FFF' ?>;
        --footer-item-color-hover: <?=  $footer_colors['item_color_hover'] ?: '#FFF' ?>;
        --footer-social-background: <?= $footer_colors['social_background'] ?: '#FFF' ?>;
        --footer-social-color: <?= $footer_colors['social_color'] ?: '#000' ?>;
    <?php if ($is_change_body_colors):
     $body_colors = get_field('body_colors', 'options'); ?> --body-background: <?= $body_colors['background'] ?: '#000' ?>;
        --body-color: <?= $body_colors['color'] ?: '#fff' ?>;
    <?php endif; ?>
    }
</style>
