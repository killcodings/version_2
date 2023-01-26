<?php the_content(); ?>
    <div class='section-tag'>
        <div class="container">
            <div class="page-update">
			    <?php
			    $update_date     = get_the_modified_date( 'Y-m-d' );
			    $update_time     = get_the_modified_time( 'h:i A' );
			    $update_date_str = $update_date . ' ' . $update_time;
			    ?>
			    <?= Translate::get('post_updated') ?>: <time datetime="<?= $update_date ?>"><?= $update_date_str ?></time>
            </div>
        </div>
	    <?php
	    $social_links = get_field( 'social_footer', 'options' );
        if ( $social_links ): ?>
        <div class="container">
            <div class="nav-socials nav-socials_divider">
                <div class="nav-socials__heading">
                    <h2 class="nav-socials__heading-title"><?= Translate::get('share_social_link_title') ?></h2>
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
                                if ($link['social'] === 'linkedin') : ?>
                                    <svg class="linkedin" width="18" height="18"  fill="none">
                                        <use xlink:href="#nav-socials__item-linkedin"></use>
                                    </svg>
                                <?php endif;
                                if ($link['social'] === 'instagram') : ?>
                                    <svg class="instagram" width="18" height="19"  fill="none">
                                        <use xlink:href="#nav-socials__item-instagram"></use>
                                    </svg>
                                <?php endif;
                                if ($link['social'] === 'pinterest') : ?>
                                    <svg class="pinterest" width="18" height="19"  fill="none">
                                        <use xlink:href="#nav-socials__item-pinterest"></use>
                                    </svg>
                                <?php endif;
                                if ($link['social'] === 'twitter') : ?>
                                    <svg class="twitter" width="20" height="18"  fill="none">
                                    <use xlink:href="#nav-socials__item-twitter"></use>
                                    </svg>
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
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
