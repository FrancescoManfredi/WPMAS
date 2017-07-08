<?php

/* 
 * Callback functions for tracked events
 * Each function must have a name in the form: wpmas_(hook_name)_callback()
 */

/**
 * Send generic message via http POST
 */
function wpmas_send_message($message) {
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL,"http://localhost:5000");
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
	
	wpmas_send_message("(inform
  :sender (agent-identifier :name i)
  :receiver (set (agent-identifier :name j))
  :content
    \"newPost(" . $post_id . ", " . $p->post_type . ", ". $p->post_author .")\"
  :language Prolog)");
}