<?php

add_action( 'after_setup_theme', function () {
	register_nav_menus( [
		'primary'   => 'Main header menu',
		'secondary' => 'Secondary header menu'
	] );
} );

add_action( 'widgets_init', function () {
	register_sidebars( 3, [
		'name'          => 'Колонка в футере %d',
		'id'            => 'footer-menu',
		'before_title'  => '<span class="footer-column__title">',
		'after_title'   => '</span>',
		'before_widget' => '<nav id="%1$s" class="footer__item footer-column %2$s">',
		'after_widget'  => '</nav>'
	] );
} );
function register_my_widgets() {
	register_sidebar( array(
		'name'          => "Виджет для флажков языков",
		'id'            => 'language-flags',
		'before_widget' => '<div class="header__widget widget">',
		'after_widget'  => '</div>',
	) );
}

add_action( 'widgets_init', 'register_my_widgets' );
