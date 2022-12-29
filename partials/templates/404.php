<?php
if ( function_exists( 'kama_breadcrumbs' ) ) {
	$breadcrumbs_separator = get_option( 'options_breadcrumbs_settings_separator' );
	kama_breadcrumbs( $breadcrumbs_separator );
}
?>
<div class="container page-not-found">
    <div class="page-not-found__value">404</div>
    <h2 class="page-not-found__title">Page Not Found</h2>
    <a href="/" class="page-not-found__link">Home</a>
</div>
