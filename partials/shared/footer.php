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
				?>
            </div>
        </div>
        <button type="button" class="top-button">&#8593;</button>
		<?php $is_enable_footer_copyright = get_field( 'is_enable_footer_copyright', 'options' ) ?? false;
		if ( $is_enable_footer_copyright ): ?>
            <div class="footer-copyright">
                <p class="footer-copyright__text"><?= get_field( 'footer_copyright_text', 'options' ) ?></p>
            </div>
		<?php endif; ?>
        <svg class="button__icon-sprite sprite" display="none">
            <symbol id="button__icon-item-arrow" viewBox="0 0 12 11">
                <path d="M1.83526 9.22628L10.1649 0.890646M10.1649 0.890646L1.83154 0.892944M10.1649 0.890646L10.1686 9.22398" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
            </symbol>
            <symbol id="button__icon-item-comment" viewBox="0 0 17 18">
                <path d="M16 11.2666C16 11.7086 15.8244 12.1326 15.5118 12.4451C15.1993 12.7577 14.7754 12.9333 14.3333 12.9333H4.33333L1 16.2666V2.93327C1 2.49124 1.17559 2.06732 1.48816 1.75476C1.80072 1.4422 2.22464 1.2666 2.66667 1.2666H14.3333C14.7754 1.2666 15.1993 1.4422 15.5118 1.75476C15.8244 2.06732 16 2.49124 16 2.93327V11.2666Z" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
            </symbol>

            <symbol id="nav-socials__item-facebook" viewBox="0 0 20 20">
                <path d="M20 10.019C20 4.49619 15.5229 0.019043 10 0.019043C4.47715 0.019043 0 4.49619 0 10.019C0 15.0103 3.65684 19.1474 8.4375 19.8976V12.9097H5.89844V10.019H8.4375V7.81592C8.4375 5.30967 9.93047 3.92529 12.2146 3.92529C13.3084 3.92529 14.4531 4.12061 14.4531 4.12061V6.58154H13.1922C11.95 6.58154 11.5625 7.35244 11.5625 8.14404V10.019H14.3359L13.8926 12.9097H11.5625V19.8976C16.3432 19.1474 20 15.0103 20 10.019Z"/>
            </symbol>
            <symbol id="nav-socials__item-twitter" viewBox="0 0 20 18">
                <path d="M6.2918 17.1442C13.8371 17.1442 17.9652 10.8914 17.9652 5.47072C17.9652 5.29493 17.9613 5.11525 17.9535 4.93947C18.7566 4.35872 19.4496 3.63938 20 2.81525C19.2521 3.148 18.458 3.36532 17.6449 3.45978C18.5011 2.94659 19.1421 2.14039 19.4492 1.19064C18.6438 1.66796 17.763 2.00467 16.8445 2.18634C16.2257 1.5288 15.4075 1.09343 14.5164 0.947541C13.6253 0.801653 12.711 0.953374 11.9148 1.37925C11.1186 1.80512 10.4848 2.48142 10.1115 3.30359C9.73825 4.12576 9.64619 5.04801 9.84961 5.92775C8.21874 5.84591 6.62328 5.42225 5.16665 4.68425C3.71002 3.94624 2.42474 2.91036 1.39414 1.64376C0.870333 2.54687 0.710047 3.61554 0.945859 4.63257C1.18167 5.64961 1.79589 6.5387 2.66367 7.11915C2.01219 7.09847 1.37498 6.92307 0.804688 6.60743V6.65822C0.804104 7.60596 1.13175 8.52465 1.73192 9.25814C2.3321 9.99163 3.16777 10.4946 4.09687 10.6817C3.49338 10.8468 2.85999 10.8708 2.2457 10.752C2.50788 11.567 3.01798 12.2799 3.70481 12.7911C4.39164 13.3023 5.22093 13.5863 6.07695 13.6035C4.62369 14.7451 2.82848 15.3643 0.980469 15.3613C0.652739 15.3608 0.325333 15.3408 0 15.3012C1.87738 16.5056 4.06128 17.1453 6.2918 17.1442Z"/>
            </symbol>
            <symbol id="badge__icon" viewBox="0 0 9 13">
                <path d="M2.605 7.445L2 12L4.5 10.5L7 12L6.395 7.44M8 4.5C8 6.433 6.433 8 4.5 8C2.567 8 1 6.433 1 4.5C1 2.567 2.567 1 4.5 1C6.433 1 8 2.567 8 4.5Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </symbol>
        </svg>
    </footer>
<?php
wp_footer();
