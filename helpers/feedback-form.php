<?php

function render_feedback_form( $global_title, $global_brand, $is_comments = false, $postID = null ) {
	if ( $global_brand && $global_title ) {
		$title = $global_title;
		$brand = $global_brand;
	} else {
		$title = get_field( 'title' ) ?: 'Contact Us';
		$brand = get_field( 'brand_select' );
	}
	?>
    <div class="container">
        <form class="feedback-form" data-brand="<?= $brand ?>" data-comments="<?= $is_comments ? 'true' : 'false' ?>">
            <fieldset class="feedback-form__fieldset">
                <legend class="feedback-form__legend"><?= $title ?></legend>
                <label class="feedback-form__item">
                    <span class="feedback-form__item-title">Issue:</span>
                    <span class="feedback-form__item-select-alert">Please choose an issue</span>
                    <select class="feedback-form__item-input" name="issue">
                        <option value="default">Issue</option>
                        <option value="Deposit problem">Deposit problem</option>
                        <option value="Withdrawal problem">Withdrawal problem</option>
                        <option value="Account problem">Account problem</option>
                        <option value="Mobile app problem">Mobile app problem</option>
                        <option value="Other problem">Other problem</option>
                    </select>
                </label>
                <label class="feedback-form__item">
                    <span class="feedback-form__item-title">Email:</span>
                    <input class="feedback-form__item-input" type="email" name="email" placeholder="Email" required>
                </label>
				<?php if ( $is_comments ): ?>
                    <label class="feedback-form__item">
                        <span class="feedback-form__item-title">Name:</span>
                        <input class="feedback-form__item-input" type="text" name="name" placeholder="Name" required>
                    </label>
				<?php endif; ?>
                <label class="feedback-form__item">
                    <span class="feedback-form__item-title">Comment:</span>
                    <textarea class="feedback-form__item-input feedback-form__item-textarea" name="comment"
                              placeholder="Comment" required rows="5"></textarea>
                </label>
                <input type="hidden" name="post_ID" value="<?= $postID ?>">
                <button type="submit" class="feedback-form__submit-button">Send request</button>
            </fieldset>
            <div class="feedback-form__result">
                <span>Request has been passed to the manager</span>
            </div>
        </form>
    </div>
	<?php
}

if ( function_exists( 'acf_register_block_type' ) ) {
	acf_register_block_type( [
		'name'            => 'feedback-form',
		'title'           => 'Форма обратной связи (сбор емейлов)',
		'description'     => 'Форма обратной связи (сбор емейлов)',
		'render_callback' => 'render_feedback_form',
		'mode'            => 'edit'
	] );

	acf_add_local_field_group( [
		'key'      => 'feedback-form-fields',
		'title'    => 'Настройки',
		'fields'   => [
			[
				'key'           => 'title_field',
				'label'         => 'Заголовок формы',
				'name'          => 'title',
				'type'          => 'text',
				'default_value' => 'Contact Us'
			],
			[
				'key'               => 'brand_field',
				'label'             => 'Выберите бренд',
				'name'              => 'mailcollector_brand_select',
				'type'              => 'select',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'choices'           => array(),
				'default_value'     => false,
				'allow_null'        => 0,
				'multiple'          => 0,
				'ui'                => 0,
				'return_format'     => 'value',
				'ajax'              => 0,
				'placeholder'       => '',
			]
		],
		'location' => [
			[
				[
					'param'    => 'block',
					'operator' => '==',
					'value'    => 'acf/feedback-form'
				]
			]
		]
	] );
}

if ( wp_doing_ajax() ) {
	add_action( 'wp_ajax_feedback_form', 'send_form_data' );
	add_action( 'wp_ajax_nopriv_feedback_form', 'send_form_data' );
}

function test_input( $data ) {
	$data = trim( $data );
	$data = stripslashes( $data );

	return htmlspecialchars( $data );
}

function get_user_ip() {
	if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	return apply_filters( 'wpb_get_ip', $ip );
}

function send_form_data() {
	$form_data = [
		'issue'    => test_input( $_POST['issue'] ),
		'email'    => test_input( $_POST['email'] ),
		'comment'  => test_input( $_POST['comment'] ),
		'ip'       => get_user_ip(),
		'site_url' => get_home_url(),
		'brand'    => test_input( $_POST['brand'] )
	];

	$mail_collector_url = 'https://mails.workpanel.site/add-email.php';

	$headers = [];
	$curl    = curl_init();
	curl_setopt( $curl, CURLOPT_HTTPHEADER, $headers );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $curl, CURLOPT_VERBOSE, 1 );
	curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query( $form_data ) );
	curl_setopt( $curl, CURLOPT_URL, $mail_collector_url );
	curl_setopt( $curl, CURLOPT_POST, true );

	$result = curl_exec( $curl );
	echo $result;
}
