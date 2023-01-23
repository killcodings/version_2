<?php the_content(); ?>
    <section class='section-tag'>
        <div class="container">
            <svg display="none">
                <symbol id="nav-socials__item-facebook" viewBox="0 0 20 20">
                    <path d="M20 10.019C20 4.49619 15.5229 0.019043 10 0.019043C4.47715 0.019043 0 4.49619 0 10.019C0 15.0103 3.65684 19.1474 8.4375 19.8976V12.9097H5.89844V10.019H8.4375V7.81592C8.4375 5.30967 9.93047 3.92529 12.2146 3.92529C13.3084 3.92529 14.4531 4.12061 14.4531 4.12061V6.58154H13.1922C11.95 6.58154 11.5625 7.35244 11.5625 8.14404V10.019H14.3359L13.8926 12.9097H11.5625V19.8976C16.3432 19.1474 20 15.0103 20 10.019Z"/>
                </symbol>
                <symbol id="nav-socials__item-twitter" viewBox="0 0 20 18">
                    <path d="M6.2918 17.1442C13.8371 17.1442 17.9652 10.8914 17.9652 5.47072C17.9652 5.29493 17.9613 5.11525 17.9535 4.93947C18.7566 4.35872 19.4496 3.63938 20 2.81525C19.2521 3.148 18.458 3.36532 17.6449 3.45978C18.5011 2.94659 19.1421 2.14039 19.4492 1.19064C18.6438 1.66796 17.763 2.00467 16.8445 2.18634C16.2257 1.5288 15.4075 1.09343 14.5164 0.947541C13.6253 0.801653 12.711 0.953374 11.9148 1.37925C11.1186 1.80512 10.4848 2.48142 10.1115 3.30359C9.73825 4.12576 9.64619 5.04801 9.84961 5.92775C8.21874 5.84591 6.62328 5.42225 5.16665 4.68425C3.71002 3.94624 2.42474 2.91036 1.39414 1.64376C0.870333 2.54687 0.710047 3.61554 0.945859 4.63257C1.18167 5.64961 1.79589 6.5387 2.66367 7.11915C2.01219 7.09847 1.37498 6.92307 0.804688 6.60743V6.65822C0.804104 7.60596 1.13175 8.52465 1.73192 9.25814C2.3321 9.99163 3.16777 10.4946 4.09687 10.6817C3.49338 10.8468 2.85999 10.8708 2.2457 10.752C2.50788 11.567 3.01798 12.2799 3.70481 12.7911C4.39164 13.3023 5.22093 13.5863 6.07695 13.6035C4.62369 14.7451 2.82848 15.3643 0.980469 15.3613C0.652739 15.3608 0.325333 15.3408 0 15.3012C1.87738 16.5056 4.06128 17.1453 6.2918 17.1442Z"/>
                </symbol>
            </svg>

            <div class="page-update">
			    <?php
			    $update_date     = get_the_modified_date( 'Y.m.d' );
			    $update_time     = get_the_modified_time( 'h:i A' );
			    $update_date_str = $update_date . ' ' . $update_time;
			    ?>
			    <?= Translate::get('post_updated') ?>: <time datetime="<?= $update_date ?>"><?= $update_date_str ?></time>

	            <?php
                $social_links = get_field( 'social_footer', 'options' );
                if ( $social_links ): ?>
            </div>
            <div class="container">
                <div class="nav-socials nav-socials_divider">
                    <div class="nav-socials__heading">
                        <h2 class="nav-socials__heading-title">Share</h2>
                    </div>

                    <div class="nav-socials__items">
		                <?php foreach ( $social_links as $link ): ?>
                            <div class="nav-socials__item">
                                <a class="nav-socials__item-link" href="<?= $link['link'] ?>" rel="nofollow">
	                                <?php if ($link['social'] === 'facebook') : ?>
                                        <svg class="facebook" width="20" height="20"  fill="none">
                                            <use xlink:href="#nav-socials__item-facebook"></use>
                                        </svg>
	                                <?php endif;
	                                if ($link['social'] === 'twitter') : ?>
                                        <svg class="twitter" width="20" height="18"  fill="none" ">
                                            <use xlink:href="#nav-socials__item-twitter"></use>
                                        </svg>
	                                <?php endif;
                                    if ($link['social'] === 'pinterest') : ?>
                                        <svg class="twitter" width="20" height="18"  fill="none" ">
                                            <use xlink:href="#nav-socials__item-twitter"></use>
                                        </svg>
                                    <?php endif;
                                    if ($link['social'] === 'instagram') : ?>
                                        <svg class="twitter" width="20" height="18"  fill="none" ">
                                            <use xlink:href="#nav-socials__item-twitter"></use>
                                        </svg>
                                    <?php endif;
                                    if ($link['social'] === 'linkedin') : ?>
                                        <svg class="twitter" width="20" height="18"  fill="none" ">
                                            <use xlink:href="#nav-socials__item-twitter"></use>
                                        </svg>
                                    <?php endif; ?>
                                </a>
                            </div>
		                <?php endforeach; ?>
                    </div>
	                <?php endif; ?>
                </div>
            </div>

        </div>
    </section>
<?php
$is_enabled_author             = get_field( 'is_enabled_author', 'options' ) ?? false;
$is_disabled_author_page_setup = get_field( 'is_disabled_author' ) ?? false;
if ( $is_enabled_author && ! $is_disabled_author_page_setup ) {
	app_get_partial( 'shared/author-badge' );
}

$is_enable_app_links = get_field( 'enable_apps_links', 'options' ) ?? false;
if ( $is_enable_app_links ):
	$apps_links = app_get_page_by_template( 'app-page.php' );
	$apps_links_title = get_field('relative_apps_title', 'options');
	$priopity_app = get_field( 'apps_links_priority', 'options' );
	app_links($apps_links, $apps_links_title, $priopity_app);
endif;

$is_enable_review_links = get_field( 'enable_review_links', 'options' ) ?? false;
if ( $is_enable_review_links ):
	$apps_links = app_get_page_by_template( 'review-page.php' );
	$apps_links_title = get_field('review_links_title', 'options');
	$priopity_app = get_field( 'review_links_priority', 'options' );
	app_links($apps_links, $apps_links_title, $priopity_app);
endif;
