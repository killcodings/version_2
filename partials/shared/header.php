<?php
$header_panel_colors = get_field( 'header_panel_colors', 'options' );

?>


<header class="header">
    <div class="container">
        <div class="header__block">
            <div class="header__logo logo">
                <?php
                $header_logotype = get_field( 'header_logotype', 'options' );
                if ( $header_logotype ): ?>
                <a class="logo__link" href="<?= home_url() ?>">
                    <?= app_get_image( [ 'id' => $header_logotype, 'classes' => 'logo__image' ] ) ?>
                </a>
                <?php endif; ?>
            </div>

            <div class="header__primary-nav">
		        <?php
		        wp_nav_menu( [
			        'theme_location'  => 'primary',
			        'fallback_cb'     => false,
			        'container'       => 'nav',
			        'container_class' => 'primary-nav',
			        'container_id'    => '',
			        'menu_class'      => 'primary-nav__list',
			        'menu_id'         => '',
			        'walker'          => new My_Walker_Nav_Menu()
		        ] ); ?>
            </div>

            <?php dynamic_sidebar( 'language-flags' ); ?>
            <div class="header__burger burger">
                <span></span><span></span><span></span>
            </div>
        </div>
    </div>
	<?php
	$is_header_bonus = get_field( 'is_header_bonus', 'options' );
	$is_header_bonus_page = get_field( 'is_header_bonus', $post->ID );
	if ( $is_header_bonus || $is_header_bonus_page ):
		$settings = $is_header_bonus_page ?
			get_field( 'settings', $post->ID ) :
			get_field( 'settings', 'options' );

		if ($settings['link']) {
			get_template_part( "theme-parts/components/header-bonus", null, $settings );
		}
	endif; ?>
</header>
