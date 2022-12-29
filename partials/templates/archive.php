<?php
$paged        = get_query_var( 'paged' ) ?: 1;
$author_posts = new WP_Query( [
	'posts_per_page' => - 1,
	'orderby'        => 'date',
	'post_type'      => 'post',
] );

if ( $author_posts->have_posts() ):
	if ( function_exists( 'kama_breadcrumbs' ) ) {
		$breadcrumbs_separator = get_option( 'options_breadcrumbs_settings_separator' );
		kama_breadcrumbs( $breadcrumbs_separator );
	}
	?>
    <div class="container">
        <section class="posts">
            <h2 class="posts__title">Posts</h2>
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
