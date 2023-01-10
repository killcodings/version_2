<?php

function app_get_partial( $partial_name ) {
	$partials_dir_path = 'partials';
	get_template_part( $partials_dir_path . '/' . $partial_name );
}

require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$is_enabled_webp = false;
if ( is_plugin_active( 'webp-express/webp-express.php' ) ) {
	$is_enabled_webp = true;
}

function app_get_image_url( $url ) {
	global $is_enabled_webp;

	if ( $is_enabled_webp ) {
		return str_replace( [ '.png', '.jpg', '.jpeg' ], '.webp', $url );
	}

	return $url;
}


$is_enabled_image_json = get_field( 'is_enabled_image_json', 'options' );
function app_get_image( $params, $is_lazy = true ): string {
	global $is_enabled_webp, $is_enabled_image_json;

	$img = wp_get_attachment_image_src( $params['id'], 'full' );

	$full_size_url       = wp_get_attachment_image_url( $params['id'], 'full' );
	$full_size_image_url = app_get_image_url( $full_size_url );

	$thumbnails_meta_array = [];

	$get_all_sizes = get_intermediate_image_sizes();
	foreach ( $get_all_sizes as $item ) {
		$attachment_item = wp_get_attachment_image_url( $params['id'], $item );

		$image_url = app_get_image_url( $attachment_item );

		if ( $image_url !== $full_size_image_url ) {
			$thumbnail_meta_item     = "<meta itemprop='thumbnail' content='$image_url'>";
			$thumbnails_meta_array[] = $thumbnail_meta_item;
		}
	}

	$thumbnails_string = implode( '', $thumbnails_meta_array );

	if ( ! $is_lazy ) {
		$image_str = wp_get_attachment_image( $params['id'], 'large', false, [
			'loading' => 'eager'
		] );
	} else {
		$image_str = wp_get_attachment_image( $params['id'], 'full' );
	}
    $image_str = str_replace(' />', '>', $image_str);
	if ( $is_enabled_webp ) {
		$image_types = [ 'jpg', 'jpeg', 'png' ];
		$image_str   = str_replace( $image_types, 'webp', $image_str );
	}

	$image_classes = $params['classes'] ?? '';

	if ( $img ) {
		if ( $is_enabled_image_json ) {
			return <<<HTML
<div itemscope itemtype='https://schema.org/ImageObject' class='image-func {$image_classes}'>
    $image_str
	<meta itemprop="contentUrl" content="$full_size_image_url">
    <meta itemprop="width" content="$img[1]">
    <meta itemprop="height" content="$img[2]">
    $thumbnails_string
</div>
HTML;
		}

		return <<<HTML
<div class='image-func {$image_classes}'>
    $image_str
</div>
HTML;
	}

	return "";
}

function app_get_button( $button, $class = '', $relations = null, $custom_colors = null, $button_icon = false ): string {
	$partner_links_type = get_field( 'out_links_type', 'options' ) ?? 'link';
	if ( $button['url'] === '' ) {
		return false;
	}
	$button_url_parse = parse_url( $button['url'] );
	$style_string = '';
	if ( $custom_colors ) {
		$background       = $custom_colors['background'] ?: '#fff';
		$background_hover = $custom_colors['background_hover'] ?: '#000';
		$color            = $custom_colors['color'] ?: '#000';
		$color_hover      = $custom_colors['color_hover'] ?: '#fff';
		$border           = $custom_colors['border'] ?: '#000';
		$border_hover     = $custom_colors['border_hover'] ?: '#fff';
		$border_style     = $custom_colors['border_style'] ?: 'solid';
		$border_radius    = $custom_colors['border_radius'] ?? '5';
		$style_string     = "style='--background-color:{$background};--background-color-hover:{$background_hover};--color:{$color};--color-hover:{$color_hover};--border:{$border};--border-hover:{$border_hover};--border-style:{$border_style};--border-radius:{$border_radius}px;'";
	}

	$relations_string = '';
	if ( $relations ) {
		$relations_string .= 'rel="' . implode( ', ', $relations ) . '"';
	}

	if ( $button_url_parse['host'] === parse_url( home_url() )['host'] ) {
		return "<a class='button $class' href='{$button['url']}' $style_string>$button_icon{$button['title']}</a>";
	}
	if ( $partner_links_type === 'link' ) {
		return "<a class='button $class' href='{$button['url']}' $style_string rel='nofollow'>$button_icon{$button['title']}</a>";
	}

	return "<button class='button click-button $class' $style_string type='button' data-link='{$button['url']}'>$button_icon{$button['title']}</button>";
}

function app_get_video( $args ) {
	$preview          = app_get_image( [ 'id' => $args['thumbnail_id'] ] );
	$preview_url      = str_replace( [
		'.jpg',
		'jpeg',
		'.png'
	], '.webp', wp_get_attachment_image_url( $args['thumbnail_id'], 'full' ) );
	$youtube_or_site  = $args['youtube_site'] ?? 'youtube';
	$local_video_type = get_field( 'local_video_type', 'options' ) ?? 'instant';

	if ( $youtube_or_site === 'youtube' ):
		return <<<HTML
<script type="application/ld+json">
{
	"@context": "https://schema.org",
	"@type": "VideoObject",
	"name": "{$args['name']}",
	"description": "{$args['description']}",
	"thumbnailUrl": "{$preview_url}",
	"contentUrl": "{$args['site_video_url']['url']}",
	"uploadDate": "{$args['upload_date']}T08:00:00+08:00",
	"isFamilyFriendly": "false"
}
</script>
<div class="video video_youtube" data-url="{$args['youtube_video_url']}">
    <div class="video__container">
        <div class="video__preview">$preview</div>
        <button class="video__button" aria-label="Play">
            <svg width="68" height="48" viewBox="0 0 68 48">
                <path class="video__button-shape"
                      d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"></path>
                <path class="video__button-icon" d="M 45,24 27,14 27,34"></path>
            </svg>
        </button>
    </div>
</div>
HTML;
    elseif ( $youtube_or_site === 'site' ):
		$thumbnail_url = wp_get_attachment_image_url( $args['thumbnail_id'], 'full' );

		if ( $local_video_type === 'instant' ):
			return <<<HTML
<script type="application/ld+json">
{
	"@context": "https://schema.org",
	"@type": "VideoObject",
	"name": "{$args['name']}",
	"description": "{$args['description']}",
	"thumbnailUrl": "{$preview_url}",
	"contentUrl": "{$args['site_video_url']['url']}",
	"uploadDate": "{$args['upload_date']}T08:00:00+08:00",
	"isFamilyFriendly": "false"
}
</script>
<video class="video_site" controls poster="$thumbnail_url" preload="none" width="{$args['site_video_url']['width']}" height="{$args['site_video_url']['height']}">
    <source src="{$args['site_video_url']['url']}">
</video>
HTML;
        elseif ( $local_video_type === 'button' ):
			return <<<HTML
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "VideoObject",
        "name": "{$args['name']}",
        "description": "{$args['description']}",
        "thumbnailUrl": "{$preview_url}",
        "contentUrl": "{$args['site_video_url']['url']}",
        "uploadDate": "{$args['upload_date']}T08:00:00+08:00",
        "isFamilyFriendly": "false"
    }
</script>
<div class="video video_local" data-url="{$args['site_video_url']['url']}">
    <div class="video__container">
        <div class="video__preview">$preview</div>
        <button class="video__button" aria-label="Play">
            <svg width="68" height="48" viewBox="0 0 68 48">
                <path class="video__button-shape"
                      d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"></path>
                <path class="video__button-icon" d="M 45,24 27,14 27,34"></path>
            </svg>
        </button>
    </div>
</div>
HTML;
		endif;
	endif;
}

function app_get_page_by_template( $template ) {
	$args = array(
		'post_type'   => 'page',
		'post_status' => 'publish',
		'fields'      => 'ids',
		'numberposts' => - 1,
		'meta_key'    => '_wp_page_template',
		'meta_value'  => $template,
	);

	return get_posts( $args );
}

function app_array_filter_recursive( $array ): array {

	$array = array_filter( $array );
	foreach ( $array as &$value ) {
		if ( is_array( $value ) ) {
			$value = call_user_func( __FUNCTION__, $value );
		}
	}

	return $array;
}

function app_get_excerpt( $post_id, $excerpt_length = 70 ): string {
	$excerpt = get_the_excerpt( $post_id );
	$excerpt_length ++;

	if ( mb_strlen( $excerpt ) > $excerpt_length ) {
		$subex   = mb_substr( $excerpt, 0, $excerpt_length - 5 );
		$exwords = explode( ' ', $subex );
		$excut   = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}

		return "...";
	}

	return $excerpt . '...';
}

$is_enabled_comments_json = get_field( 'is_enabled_comments_json', 'options' );
function app_get_comment_list( $post ) {
	global $is_enabled_comments_json;
	$comments_list = get_comments( [
		"status"       => 'approve',
		'parent'       => 0,
		'post_id'      => $post->ID,
		'hierarchical' => 'threaded'
	] );

	if ( $comments_list ): ?>
        <div class="comments container">
			<?php foreach ( $comments_list as $comment ):
				$comment_approved     = $comment->comment_approved;
				$comment_this_post    = $comment->comment_post_ID === $post->ID;
				$comment_author       = $comment->comment_author;
				$comment_author_email = $comment->comment_author_email;
				$comment_content      = $comment->comment_content;
				$comment_date         = $comment->comment_date;
				$comment_id           = $comment->comment_ID;
				$comment_ref_date     = get_comment_date( 'd.m.Y', $comment_id ) . ' at ' . get_comment_date( 'H:i',
						$comment_id );

				$child_comments = get_comments( [
					'post_id' => $post->ID,
					'status'  => 'approve',
					'parent'  => $comment_id
				] );

			if ( $is_enabled_comments_json ):
				?>
                <script type="application/ld+json">
                        {
                            "@context": "https://schema.org",
                            "@type": "Comment",
                            "creator": {
                                "@type": "Person",
                                "name": "<?= $comment_author ?>"
                            },
                            "dateCreated": "<?= $comment_ref_date ?>",
                            "text": "<?= $comment_content ?>"
                        }


                </script>
			<?php endif; ?>
                <article class="comment" id="<?= $comment_id ?>">
                    <div class="comment__avatar"><i class="icon-user"></i></div>
                    <h3 class="comment__author"><?= $comment_author ?></h3>
                    <span class="comment__date">
                                <time datetime="<?= $comment_date ?>"
                                      data-val="<?= $comment_ref_date ?>"><?= $comment_date ?></time>
                            </span>
                    <p class="comment__content"><?= $comment_content ?></p>
                </article>
			<?php
			if ( $child_comments ):
			$author_info = get_field( 'user_setup', 'user_' . $post->post_author );
			if ( $is_enabled_comments_json ):
			?>
                <script type="application/ld+json">
                        {
                            "@context": "https://schema.org",
                            "@type": "Comment",
                            "creator": {
                                "@type": "Person",
                                "name": "<?= $comment_author ?>"
                            },
                            "dateCreated": "<?= $comment_ref_date ?>",
                            "text": "<?= $comment_content ?>"
                        }

                </script>
			<?php endif; ?>
                <article class="comment comment_child" id="<?= $child_comments[0]->comment_ID ?>">
                    <div class="comment__avatar">
						<?= app_get_image( [ 'id' => $author_info['avatar'] ] ) ?>
                    </div>
                    <h3 class="comment__author"><?= "{$author_info["name"]} {$author_info['last_name']}" ?></h3>
                    <span class="comment__date">
                                <time datetime="<?= $child_comments[0]->comment_date ?>"
                                      data-val="<?= $comment_ref_date ?>"><?= $child_comments[0]->comment_date ?></time>
                            </span>
                    <p class="comment__content"><?= $child_comments[0]->comment_content ?></p>
                </article>
			<?php endif; ?>
			<?php endforeach; ?>
        </div>
	<?php endif;
}

function app_get_body_attrs() {
	$body_data_attr        = '';
	$is_change_body_colors = get_field( 'is_change_body_colors', 'options' ) ?? false;
	$body_data_attr        .= $is_change_body_colors ? " data-change-theme" : '';

	$tables_type_mobile = get_field( 'tables_type_mobile', 'options' ) ?: 'columns';
	$body_data_attr     .= " data-table-type-mobile='$tables_type_mobile'";

	return $body_data_attr;
}

function app_links( $apps_array, $title, $priopity_app ) {
	$apps_links               = $apps_array;
	$relative_apps_main_title = $title;
	global $post;
	if ( in_array( $post->ID, $apps_links, true ) ): ?>
        <section class="section-tag">
            <div class="container">
				<?php if ( ! empty( $relative_apps_main_title ) ): ?>
                    <h2 class="relative-items__main-title"><?= $relative_apps_main_title ?></h2>
				<?php endif; ?>
                <div class="title_image_text links-block">

					<?php

					$current_app_id = array_search( $post->ID, $apps_links, true );

					$arrayDouble = function ( $value, $apps_links, $relative_apps ) {
						foreach ( $apps_links as $app ) {
							if ( in_array( $value, $relative_apps ) ) {
								$value = $app;
							} else {
								return $value;
							}
						}

						return $value;
					};
					if ( $priopity_app ) {
						if ( array_search( $priopity_app[0], $apps_links ) !== false ) {
							unset( $apps_links[ array_search( $priopity_app[0], $apps_links ) ] );
						}
						if ( array_search( $priopity_app[1], $apps_links ) !== false ) {
							unset( $apps_links[ array_search( $priopity_app[1], $apps_links ) ] );
						}
						if ( array_search( $post->ID, $apps_links ) !== false ) {
							unset( $apps_links[ array_search( $post->ID, $apps_links ) ] );
						}
						if ( $priopity_app ) {
							if ( array_search( $post->ID, $priopity_app ) !== false ) {
								unset( $priopity_app[ array_search( $post->ID, $priopity_app ) ] );
							}
						}
						$arrayDefaultKeyApps = [];
						foreach ( $apps_links as $link ) {
							$arrayDefaultKeyApps[] = $link;
						}
						$apps_links                  = $arrayDefaultKeyApps;
						$arrayDefaultKeyAppsPrioryty = [];
						if ( $priopity_app ) {
							foreach ( $priopity_app as $link ) {
								$arrayDefaultKeyAppsPrioryty[] = $link;
							}
						}
						$priopity_app = $arrayDefaultKeyAppsPrioryty;
						if ( isset( $priopity_app[0] ) ) {
							$relative_apps['first'] = $priopity_app[0];

						} else {
							$relative_apps['first'] = $apps_links[ $current_app_id - 2 ] ?? $apps_links[ count( $apps_links ) - 2 ];
						}

						if ( isset( $priopity_app[1] ) ) {
							$second = $priopity_app[1];
						} else {
							$second = $apps_links[ $current_app_id - 1 ] ?? $apps_links[ count( $apps_links ) - 1 ];
							if ( in_array( $second, $relative_apps ) ) {
								$second = $arrayDouble( $second, $apps_links, $relative_apps );
							}
						}
						$relative_apps['second'] = $second;

						$third = $apps_links[ $current_app_id + 1 ] ?? $apps_links[0];
						if ( in_array( $third, $relative_apps ) ) {
							$third = $arrayDouble( $third, $apps_links, $relative_apps );
						}
						$relative_apps['third'] = $third;

						$fourth = $apps_links[ $current_app_id + 2 ] ?? $apps_links[1];
						if ( in_array( $fourth, $relative_apps, true ) ) {
							$fourth = $arrayDouble( $fourth, $apps_links, $relative_apps );
						}
						$relative_apps['fourth'] = $fourth;
					} else {
						$relative_apps = [
							'first'  => $apps_links[ $current_app_id - 2 ] ?? $apps_links[ count( $apps_links ) - 2 ],
							'second' => $apps_links[ $current_app_id - 1 ] ?? $apps_links[ count( $apps_links ) - 1 ],
							'third'  => $apps_links[ $current_app_id + 1 ] ?? $apps_links[0],
							'fourth' => $apps_links[ $current_app_id + 2 ] ?? $apps_links[1],
						];
					}

					foreach ( $relative_apps as $relative_app ):
						$page_setup = get_field( 'meta_fields', $relative_app );
						?>
                        <article class="link-block">
                            <div class="link-block__image"><?= app_get_image( [ 'id' => $page_setup['image'] ] ) ?></div>
                            <h3 class="link-block__title"><?= get_the_title( $relative_app ) ?></h3>
                            <div class="link-block__text"><?= $page_setup['description'] ?></div>
                            <a href="<?= get_permalink( $relative_app ) ?>" class="link-block__link"
                               title="Read the post"></a>
                        </article>
					<?php endforeach; ?>
                </div>
            </div>
        </section>
	<?php endif;
}

function the_component($name, $args) {
	return get_template_part("theme-parts/components/$name", null, $args);
}

function get_component($name, $args) {
	ob_start();
	the_component($name, $args);
	return ob_get_clean();
}
