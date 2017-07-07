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

add_action( 'admin_menu', 'build_admin_ui' );

