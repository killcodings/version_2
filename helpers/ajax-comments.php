<?php
function ajax_comment() {
	global $wpdb;
	$post_ID = isset( $_POST['post_ID'] ) ? (int) $_POST['post_ID'] : 0;

	$comment_author       = ( isset( $_POST['name'] ) ) ? trim( strip_tags( $_POST['name'] ) ) : null;
	$comment_author_email = ( isset( $_POST['email'] ) ) ? trim( $_POST['email'] ) : null;
	$comment_content      = ( isset( $_POST['comment'] ) ) ? trim( $_POST['comment'] ) : null;
	wp_new_comment( [
		'comment_post_ID'      => $post_ID,
		'comment_author'       => $comment_author,
		'comment_author_email' => $comment_author_email,
		'comment_content'      => $comment_content,
		'comment_type'         => 'comment'
	] );
	die();
}

add_action( 'wp_ajax_ajaxcomments', 'ajax_comment' );
add_action( 'wp_ajax_nopriv_ajaxcomments', 'ajax_comment' );
