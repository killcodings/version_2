<?php
$is_enable_mobile_button           = get_field( 'is_enable_mobile_button', 'options' ) ?? false;
$is_enable_mobile_button_from_page = get_field( 'is_enable_mobile_button_page', $post->ID ) ?? false;

if ( $is_enable_mobile_button || $is_enable_mobile_button_from_page ):
	$mobile_button = $is_enable_mobile_button_from_page ?
		get_field( 'mobile_button_page', $post->ID ) :
		get_field( 'mobile_button', 'options' );
	?>
    <aside class="mobile-button showed">
		<?php
		if ( ! $is_enable_mobile_button_from_page ) {
            $choises_version = get_field( 'mobile_button_type', 'options' ) ?? 'main';
            get_template_part( "mobile-button", null, array(
                'version'  => $choises_version,
                'settings' => $mobile_button
            ) );
		} else {
			$choises_version = get_field( 'mobile_button_type', $post->ID ) ?? 'main';
			$option_page = [
				'version'  => $choises_version,
				'settings' => $mobile_button
			];
			get_template_part( "mobile-button", null, $option_page );
		}
		?>
    </aside>
<?php endif; ?>
    <footer class="page-footer">
        <div class="container">
            <div class="page-footer__block">
				<?php
				dynamic_sidebar( 'footer-menu' );
				dynamic_sidebar( 'footer-menu-2' );
				dynamic_sidebar( 'footer-menu-3' );

				$social_links = get_field( 'social_footer', 'options' );
				if ( $social_links ): ?>
                    <div class="social-list page-footer__item">
						<?php foreach ( $social_links as $link ): ?>
                            <div class="social-list__item">
                                <a href="<?= $link['link'] ?>" rel="nofollow"><span
                                            class="icon-<?= $link['social'] ?>"></span></a>
                            </div>
						<?php endforeach; ?>
                    </div>
				<?php endif; ?>
            </div>
        </div>
        <button type="button" class="top-button">&#8593;</button>
		<?php $is_enable_footer_copyright = get_field( 'is_enable_footer_copyright', 'options' ) ?? false;
		if ( $is_enable_footer_copyright ): ?>
            <div class="footer-copyright">
                <p class="footer-copyright__text"><?= get_field( 'footer_copyright_text', 'options' ) ?></p>
            </div>
		<?php endif; ?>
    </footer>
<?php
wp_footer();
