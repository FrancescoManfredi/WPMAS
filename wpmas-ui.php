<?php

/**
 * build the administration menu for this plugin
 */
function build_admin_ui() {

	add_menu_page( "WPMAS Settings", "WPMAS Settings", "activate_plugins", "wpms-settings", wpmas_settings_page, null, null );
}

function wpmas_settings_page() {
	
	if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>Does this work? I hope it does...</p>';
	echo '</div>';
	
}