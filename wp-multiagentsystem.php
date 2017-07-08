<?php
/*
Plugin Name: WP-Multi Agent System Communication
Plugin URI:  https://github.com/FrancescoManfredi/WPMAS
Description: Send events notifications to a Multi Agent System in FIPA ACL
Version:     20160911
Author:      Francesco Manfredi
Author URI:  http://www.francescomanfredi.it
*/

// Avoid standalone execution
defined( 'ABSPATH' ) or die( 'This is a worpdress plugin. You should not execute it.' );

require_once(plugin_dir_path(__FILE__) . "wpmas-db.php");
require_once(plugin_dir_path(__FILE__) . "wpmas-ui.php");

/**
 * Set default options
 */
function wpmas_set_default() {
	
	$wpmas_default_options = [
		'masHost' => '',
		'sender' => '',
		'events' => [
			'save_post' => [
				'track' => false,
				'receiver' => '',
			],
			'comment_post' => [
				'track' => false,
				'receiver' => '',
			],
			'user_register' => [
				'track' => false,
				'receiver' => '',
			],
			'wp_login' => [
				'track' => false,
				'receiver' => '',
			],
			'wp_loaded' => [
				'track' => false,
				'receiver' => '',
			]
		]
	];
	
	wpmas_set_options($wpmas_default_options);
}

if (!wpmas_get_options()) {
	wpmas_set_default();
}

add_action( 'admin_menu', 'wpmas_build_admin_ui' );

/**
 * Bind the reaction of sending the appropriate message to the events the
 * admin wants to track.
 */
function wpmas_bind_events() {
	
	foreach ($array as $key => $value) {
		
	}
	
}

wpmas_bind_events();