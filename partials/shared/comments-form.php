<?php
$is_enable_mailcollector = get_field( 'is_enable_mailcollector', 'options' ) ?? false;
$comment_title           = get_field( 'comment_title' );
$comment_title_language  = $comment_title ?? Translate::get( 'comments' );


if ( $is_enable_mailcollector ):
	$title = get_field( 'mailcollector_title', 'options' ) ?: 'Contact Us';
	$brand = get_field( 'mailcollector_brand', 'options' );
	render_feedback_form( $title, $brand, true, $post->ID );
	app_get_comment_list( $post );

else:
	?>
    <footer class="comments-container" id="comments">
        <section class="container">
            <div class="comment-form">
                <h2 class="comment-form__title"><?= $comment_title_language ?></h2>
                <form class="comment-form__form">
                    <input class="comment-form__input comment-form__field" name="name" type="text"
                           aria-label="<?= Translate::get( 'placeholder_name' ) ?>"
                           placeholder="<?= Translate::get( 'placeholder_name' ) ?>">
                    <input class="comment-form__input comment-form__field" name="email" type="email"
                           aria-label="<?= Translate::get( 'placeholder_email' ) ?>"
                           placeholder="<?= Translate::get( 'placeholder_email' ) ?>">
                    <textarea class="comment-form__textarea comment-form__field" name="comment"
                              placeholder="<?= Translate::get( 'placeholder_comment' ) ?>"
                              aria-label="<?= Translate::get( 'placeholder_comment' ) ?>"></textarea>
                    <input type="hidden" name="post_ID" value="<?= $post->ID ?>">
					<?php

                    $buttons_main_setting = [
                      "buttons_group"=>
                      [
                        ""=> NULL,
                        "button_repeater"=>
                        [
                          0 =>
                          [
                            "button"=>
                            ["title"=>"Register", "url"=>"http://bettingonlinebd2410.loc/"],
                            "button_icon_use"=> "comment"
                          ]
                        ],
                        "buttons_width"=>"100%",
                        "button_style"=> "outline",
                        "buttons_item_class"=> "comment-form__button"
                      ]
                    ];

					echo get_component( 'buttons/buttons', $buttons_main_setting );

					?>
                    <span class="comment-form__alert"></span>
                </form>
            </div>
        </section>
        <div class="container"><?php
            app_get_comment_list( $post ); ?></div>
    </footer>
<?php endif;
