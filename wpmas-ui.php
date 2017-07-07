<?php

/**
 * build the administration menu for this plugin
 */
function build_admin_ui() {

	add_menu_page( "WPMAS Settings", "WPMAS Settings", "activate_plugins", "wpms-settings", wpmas_settings_page, null, null );
	
}

/**
 * Build the actual settings page
 */
function wpmas_settings_page() {
	
	if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	?>
<div class="wrap">
	
	<h2>Testing</h2>
	<p>Here you can choose which events should trigger messages to your multiagent system
		and where it can be found</p>
	<form action="/printrequests.php" method="post">
	<table class="form-table">
		<tr>
			<th scope="row"><label for="masHost">MAS host</label></th>
			<td><input name="masHost" type="text" id="masHost" value="" class="regular-text" /></td>
		</tr>
	</table>
		<p><input type="submit" class="button-primary" value="Update"/></p>
	</form>
	
</div>
	<?php
	
}