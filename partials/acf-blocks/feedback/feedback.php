<?php


$comment_title           = get_field( 'count' );
//$comment_title_language  = $comment_title ?? Translate::get( 'comments' );
global $post;

acf_block_before( 'Отзывы', $is_preview );
	?>
	<footer class="feedback-container" id="comments">
		<section class="container">
			<div class="feedback-form">
				<h2 class="feedback-form__title"><?= Translate::get( 'comments' ) ?> Feedback</h2>
				<form class="feedback-form__form">
					<input class="feedback-form__input feedback-form__field" name="name" type="text"
					       aria-label="<?= Translate::get( 'placeholder_name' ) ?>"
					       placeholder="<?= Translate::get( 'placeholder_name' ) ?>">
					<input class="feedback-form__input feedback-form__field" name="email" type="email"
					       aria-label="<?= Translate::get( 'placeholder_email' ) ?>"
					       placeholder="<?= Translate::get( 'placeholder_email' ) ?>">
					<textarea class="feedback-form__textarea feedback-form__field" name="comment"
					          placeholder="<?= Translate::get( 'placeholder_comment' ) ?>"
					          aria-label="<?= Translate::get( 'placeholder_comment' ) ?>"></textarea>
					<input type="hidden" name="post_ID" value="<?= $post->ID ?>">
					<?php

					$buttons_main_setting = [
						"add_buttons"     =>
							[
								0 => [
									"image"           => false,
									"button"          => [
										"title" => Translate::get( 'comment_button' ),
										"url"   => 'no-click'
									],
									"button_icon_use" => 'comment'
								]
							],
						"buttons_setting" => [ "button_width" => '100%', "buttons_item_class" => "feedback-form__button", "position_buttons" => "center" ]

					];
					echo get_component( 'buttons/buttons-main', $buttons_main_setting );

					?>
					<span class="feedback-form__alert"></span>
				</form>
			</div>
		</section>
		<div class="container">
		<?php
//            $is_enabled_comments_json = get_field( 'is_enabled_comments_json', 'options' );


	$comments_list = get_comments( [
		"status"       => 'approve',
		'parent'       => 0,
		'post_id'      => $post->ID,
		'hierarchical' => 'threaded',
        'type' => 'feedback_block',
		'number'       => '10'
	] );

	if ( $comments_list ): ?>
        <div class="feedback container">
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

			if ( true ):
				?>
			<?php endif; ?>
                <article class="comment" id="<?= $comment_id ?>">
                    <div class="comment__avatar"><!--<i class="icon-user"></i>--></div>
                    <div class="comment__content">
                        <h3 class="comment__author"><?= $comment_author ?></h3>
                        <p class="comment__content"><?= $comment_content ?></p>
                        <span class="comment__date">
                                <time datetime="<?= $comment_date ?>"
                                      data-val="<?= $comment_ref_date ?>"><?= $comment_date ?></time>
                            </span>
                    </div>
                </article>
			<?php
			if ( $child_comments ):
			$author_info = get_field( 'user_setup', 'user_' . $post->post_author );
			if ( true ): // $is_enabled_comments_json
			?>
			<?php endif; ?>
                <article class="comment comment_child" id="<?= $child_comments[0]->comment_ID ?>">
                    <div class="comment__avatar">
						<?= app_get_image( [ 'id' => $author_info['avatar'] ] ) ?>
                    </div>
                    <div class="comment__content">
                        <h3 class="comment__author"><?= "{$author_info["name"]} {$author_info['last_name']}" ?> <span class="comment__user">Admin</span></h3>
                        <p class="comment__content"><?= $child_comments[0]->comment_content ?></p>
                        <span class="comment__date">
                                <time datetime="<?= $child_comments[0]->comment_date ?>"
                                      data-val="<?= $comment_ref_date ?>"><?= $child_comments[0]->comment_date ?></time>
                            </span>
                    </div>
                </article>
			<?php endif; ?>
			<?php endforeach; ?>
        </div>
	<?php endif;

            ?>
        </div>
	</footer>
<?php acf_block_after( $is_preview );
