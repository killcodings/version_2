<?php
$author_id    = $post->post_author;
$currentLang  = Translate::getLang();
$author_setup = get_field( 'user_setup', "user_$author_id" );
if ( $currentLang === 'en' ) {
	$currentLang = '';
} else {
	$currentLang = "_$currentLang";
}
?>
<div class="container">
    <section class="author-badge">
        <h2 class="author-badge__title"><?= Translate::get( 'post_author' ) ?></h2>
        <div class="author-badge__block">
            <div class="author-badge__avatar">
				<?= app_get_image( [ 'id' => $author_setup["avatar"] ] ) ?>
            </div>
            <article class="author-badge__content">
                <h3 class="author-badge__name"><?= "{$author_setup["name$currentLang"]} {$author_setup["last_name$currentLang"]}" ?></h3>
                <div class="author-badge__description"><?= $author_setup["description$currentLang"] ?></div>
            </article>
            <a href="<?= get_author_posts_url( $author_id ) ?>" class="author-badge__link"></a>
        </div>
    </section>
	<?php $user_setup = get_field('user_setup', 'user_' . $post->post_author);
    $social_links = $user_setup['socials'];
	if ( $social_links ): ?>
        <div class="nav-socials">
            <div class="nav-socials__items">
				<?php foreach ( $social_links as $link ):
                    $dashicons_wp = match($link['social']) {
	                    'facebook' => ' dashicons-before dashicons-facebook',
	                    'linkedin' => ' dashicons-before dashicons-linkedin',
                        'instagram' => ' dashicons-before dashicons-instagram',
	                    'pinterest' => ' dashicons-before dashicons-pinterest',
	                    'twitter' => ' dashicons-before dashicons-twitter',
                        null => 'author-badge'
                    };
                    ?>
                    <div class="nav-socials__item<?=$dashicons_wp?>">
                        <a class="nav-socials__item-link" href="<?= $link['link'] ?>" rel="nofollow"></a>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>
	<?php endif; ?>
</div>
