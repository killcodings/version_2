<?php
$author_id       = get_the_author_meta( 'ID' );
$currentLang  = Translate::getLang();
$author_settings = get_field( 'user_setup', "user_$author_id" );
if ( $currentLang === 'en' ) {
	$currentLang = '';
} else {
	$currentLang = "_$currentLang";
}

if ( function_exists( 'kama_breadcrumbs' ) ) {
	$breadcrumbs_separator = get_option( 'options_breadcrumbs_settings_separator' );
	kama_breadcrumbs( $breadcrumbs_separator );
}
?>
<div class="author-section">
    <div class="container">
        <div class="author-section__block">
            <div class="author-section__avatar">
				<?= app_get_image( [ 'id' => $author_settings['avatar'] ] ) ?>
            </div>
            <div class="author-section__content">
                <h1 class="author-section__name"><?= $author_settings["name$currentLang"] . ' ' . $author_settings["last_name$currentLang"] ?></h1>
                <div class="author-section__description"><?= $author_settings["description_author_page$currentLang"] ?></div>
				<?php if ( $author_settings['socials'] ): ?>
                    <div class="author-section__socials">
                        <ul class="author-section__social-list">
							<?php foreach ( $author_settings['socials'] as $link ): ?>
                                <li class="author-section__social-item">
                                    <a href="<?= $link['link'] ?>"><i class="icon-<?= $link['social'] ?>"></i></a>
                                </li>
							<?php endforeach; ?>
                        </ul>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
$paged        = get_query_var( 'paged' ) ?: 1;
$author_posts = new WP_Query( [
	'posts_per_page' => - 1,
	'orderby'        => 'date',
	'author'         => $author_id,
	'post_type'      => [ 'post', 'page' ],
] );

if ( $author_posts->have_posts() ): ?>
    <div class="container">
        <section class="posts">
            <h2 class="posts__title"><?= Translate::get('posts') ?></h2>
            <div class="posts__block">
				<?php while ( $author_posts->have_posts() ):
					$author_posts->the_post();
					$post_id   = $post->ID;
					$post_meta = get_field( 'meta_fields', $post_id );
					?>
                    <article class="posts__item">
                        <div class="posts__preview">
							<?= @app_get_image( [ 'id' => $post_meta['image'] ] ) ?>
                        </div>
                        <h3 class="posts__name"><?= @$post_meta['title'] ?></h3>
                        <p class="posts__excerpt"><?= @$post_meta['description'] ?></p>
                        <a href="<?= get_permalink( $post_id ) ?>" class="posts__link-absolute"></a>
                        <span class="posts__link"><i class="icon-right"></i></span>
                    </article>
				<?php endwhile; ?>
            </div>
        </section>
    </div>
<?php endif; ?>
