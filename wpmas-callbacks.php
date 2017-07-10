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
	
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $wpmas_options['masHost']);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('msg' => $message)));
	curl_exec($ch);
	curl_close ($ch);
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
	$msg["receiver"] = $wpmas_options['events']['save_post']['receiver'];
	$msg["sender"] = $wpmas_options['sender'];
	$msg["msg"] = "newPost(" . $post_id . ", " . $p->post_type . ", ". $p->post_author .")";
	$msg["lang"] = "Prolog";
	
	wpmas_send_message($msg);
}