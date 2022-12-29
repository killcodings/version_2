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
</div>
