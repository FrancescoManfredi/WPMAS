<?php

/* 
 * Callback functions for tracked events
 * Each function must have a name in the form: wpmas_(hook_name)_callback()
 */

/**
 * Send generic message
 */
function wpmas_send_message($message) {
	
	$wpmas_options = wpmas_get_options();
	
	$port = $wpmas_options['masPort'];
	$host = $wpmas_options['masHost'];

	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

	$jsonMessage = json_encode($message);
	
	socket_connect($socket, $host, $port);
	socket_write($socket, $jsonMessage . "\n");
	socket_close($socket);
	
}

/**
 * Handle creation or update of new page or post
 * @param type $post_id
 */
function wpmas_save_post_callback( $post_id ) {
	
	$wpmas_options = wpmas_get_options();
	$p = get_post($post_id);
	
	/*
	 * newPost(postId, postType, author)
	 */
	$msg = new stdClass();
	$msg->receiver = $wpmas_options['events']['save_post']['receiver'];
	$msg->sender = $wpmas_options['sender'];
	$msg->msg = "newPost(" . $post_id . ", " . $p->post_type . ", ". $p->post_author .")";
	$msg->lang = "Prolog";
	
	wpmas_send_message($msg);
}

/**
 * Handle new wordpress comments
 */
function wpmas_comment_post_callback($comment_id) {
	$wpmas_options = wpmas_get_options();
	$c = get_comment($comment_id);
	
	/*
	 * newComment(commentId, commentPostId, author)
	 */
	$msg = new stdClass();
	$msg->receiver = $wpmas_options['events']['comment_post']['receiver'];
	$msg->sender = $wpmas_options['sender'];
	$msg->msg = "newComment(" . $comment_id . ", " . $c->comment_post_ID . ", ". $c->comment_author .")";
	$msg->lang = "Prolog";
	
	wpmas_send_message($msg);
}

/**
 * Handle new wordpress user creation
 */
function wpmas_user_register_callback($user_id) {
	$wpmas_options = wpmas_get_options();
	$u = get_userdata($user_id);
	
	/*
	 * newUser(userId, userName, roles)
	 */
	$msg = new stdClass();
	$msg->receiver = $wpmas_options['events']['user_register']['receiver'];
	$msg->sender = $wpmas_options['sender'];
	$msg->msg = "newUser(" . $user_id . ", " . $u->user_login . ", ". implode(', ', $u->roles) .")";
	$msg->lang = "Prolog";
	
	wpmas_send_message($msg);
}

/**
 * Handle user login event
 */
function wpmas_wp_login_callback($user_login) {
	$wpmas_options = wpmas_get_options();
	
	/*
	 * userLoggedIn(userName)
	 */
	$msg = new stdClass();
	$msg->receiver = $wpmas_options['events']['wp_login']['receiver'];
	$msg->sender = $wpmas_options['sender'];
	$msg->msg = "userLoggedIn(" . $user_login . ")";
	$msg->lang = "Prolog";
	
	wpmas_send_message($msg);
}