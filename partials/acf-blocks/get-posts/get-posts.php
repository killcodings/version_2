<?php

$posts_count = get_field('count');
$currentLang  = Translate::getLang();

$posts = get_posts([
	'numberposts' => $posts_count,
//	'category' => $posts_category,
	'orderby' => 'date',
	'order' => 'DESC'
]);

acf_block_before( 'Вывод постов', $is_preview );
?>
    <h2 class="has-text-align-center">News</h2>
    <div class="posts">
        <?php foreach ($posts as $post): setup_postdata($post);
	        $post_id = $post->ID;
	        $page_setup = get_field( 'meta_fields', $post_id );
	        $author_id    = $post->post_author;
	        	        $author_id    = get_the_author_meta( 'ID' );
	        $author_setup = get_field( 'user_setup', "user_$author_id" );
	        if ( $currentLang === 'en' ) {
		        $currentLang = '';
	        } else {
		        $currentLang = "_$currentLang";
	        }
        ?>
        <article class="post">
            <div class="post__image">
	            <?= app_get_image( [ 'id' => $page_setup['image'] ] ) ?>
            </div>
            <div class="post__content">
                <h3 class="post__title"><?= get_the_title( $post_id ) ?></h3>
                <p class="post__description"><?= $page_setup['description'] ?></p>
                <div class="post__bottom">
                    <p class="post__author"><?= "{$author_setup["name$currentLang"]} {$author_setup["last_name$currentLang"]}" ?></p>
                    <time class="post__date" datetime="<?= get_the_date('Y-m-d\TH:i:s', $post_id) ?>"><?= get_the_date('Y M d, H:i', $post_id) ?></time>
                </div>
            </div>
            <a href="<?= get_permalink( $post_id ) ?>" class="post__link" title="Read the post"></a>
        </article>
        <?php endforeach;
        wp_reset_postdata(); ?>
    </div>
<?php
acf_block_after( $is_preview );
