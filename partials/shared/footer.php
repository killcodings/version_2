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
        <svg class="button__icon-sprite" display="none">
            <symbol id="button__icon-item-arrow" viewBox="0 0 12 11">
                <path d="M1.83526 9.22628L10.1649 0.890646M10.1649 0.890646L1.83154 0.892944M10.1649 0.890646L10.1686 9.22398" stroke="white" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
            </symbol>
            <symbol id="button__icon-item-comment" viewBox="0 0 17 18">
                <path d="M16 11.2666C16 11.7086 15.8244 12.1326 15.5118 12.4451C15.1993 12.7577 14.7754 12.9333 14.3333 12.9333H4.33333L1 16.2666V2.93327C1 2.49124 1.17559 2.06732 1.48816 1.75476C1.80072 1.4422 2.22464 1.2666 2.66667 1.2666H14.3333C14.7754 1.2666 15.1993 1.4422 15.5118 1.75476C15.8244 2.06732 16 2.49124 16 2.93327V11.2666Z" stroke="white" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
            </symbol>
        </svg>
    </footer>
<?php
wp_footer();
