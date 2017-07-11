<?php

/**
 * build the administration menu for this plugin
 */
function wpmas_build_admin_ui() {

	add_menu_page( "WPMAS Settings", "WPMAS Settings", "activate_plugins", "wpms-settings", wpmas_settings_page, null, null );
	
}

/**
 * Build the actual settings page
 */
function wpmas_settings_page() {
	
	if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	/* if data was posted, build $wpmas_options and update the db */
	if (isset($_POST['posted']) && $_POST['posted']=='y') {
		$wpmas_options['masHost'] = $_POST['masHost'];
		$wpmas_options['masPort'] = $_POST['masPort'];
		$wpmas_options['sender'] = $_POST['sender'];
		if ($_POST['save_post_track']) {
			$wpmas_options['events']['save_post']['track'] = true;
		} else {
			$wpmas_options['events']['save_post']['track'] = false;
		}
		$wpmas_options['events']['save_post']['receiver'] = $_POST['save_post_receiver'];
		
		if ($_POST['comment_post_track']) {
			$wpmas_options['events']['comment_post']['track'] = true;
		} else {
			$wpmas_options['events']['comment_post']['track'] = false;
		}
		$wpmas_options['events']['comment_post']['receiver'] = $_POST['comment_post_receiver'];
		
		if ($_POST['user_register_track']) {
			$wpmas_options['events']['user_register']['track'] = true;
		} else {
			$wpmas_options['events']['user_register']['track'] = false;
		}
		$wpmas_options['events']['user_register']['receiver'] = $_POST['user_register_receiver'];
		
		if ($_POST['login_track']) {
			$wpmas_options['events']['wp_login']['track'] = true;
		} else {
			$wpmas_options['events']['wp_login']['track'] = false;
		}
		$wpmas_options['events']['wp_login']['receiver'] = $_POST['wp_login_receiver'];
		
		if ($_POST['visit_track']) {
			$wpmas_options['events']['wp_loaded']['track'] = true;
		} else {
			$wpmas_options['events']['wp_loaded']['track'] = false;
		}
		$wpmas_options['events']['wp_loaded']['receiver'] = $_POST['wp_loaded_receiver'];
		
		wpmas_set_options($wpmas_options);
	} else {
		/* get $wpmas_options from the db */
		$wpmas_options = wpmas_get_options();
	}
	?>
<div class="wrap">
	
	<h2>WPMAS Settings</h2>
	<?php
	if (isset($_POST['posted']) && $_POST['posted']=='y') {
	?>
	<div id="message" class="updated notice notice-success is-dismissible"><p><?php _e('Updated'); ?></p><button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php _e('Dismiss'); ?></span></button></div>
	<?php
	}
	?>
	<p>Here you can choose which events should trigger messages to your multiagent system
		and where it can be found. The source code of this plugin is available at <a href="https://github.com/FrancescoManfredi/WPMAS" target="_blank">github</a>.</p>
	<form action="" method="post">
		<input type="hidden" name="posted" value="y"/>
	<table class="form-table">
		<tr>
			<th scope="row"><label for="masHost">MAS host and port</label></th>
			<td><input name="masHost" placeholder="es: localhost" type="text" id="masHost" value="<?php echo $wpmas_options['masHost']; ?>" class="regular-text" />
			<input name="masPort" placeholder="es: 5000" type="text" id="masPort" value="<?php echo $wpmas_options['masPort']; ?>" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="sender">Sender Name</label></th>
			<td><input name="sender" placeholder="es: wpWebsite" type="text" id="sender" value="<?php echo $wpmas_options['sender']; ?>" class="regular-text" /></td>
		</tr>
		<tr>
			<th>
				<h3>Event tracking</h3>
			</th>
		</tr>
		<tr>
			<th scope="row"><label>New content published</label></th>
			<td>
				<label for="save_post_track">Track event: 
					<input type="checkbox" id="save_post_track" name="save_post_track" value="save_post_track" <?php if($wpmas_options['events']['save_post']['track']) echo 'checked' ?>>
				</label>
				<label for="save_post_receiver">
					<input name="save_post_receiver" placeholder="es: agentSmith agentJohn" type="text" id="save_post_receiver" value="<?php echo $wpmas_options['events']['save_post']['receiver']; ?>" class="regular-text" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row"><label>New comment</label></th>
			<td>
				<label for="comment_post_track">Track event: 
					<input type="checkbox" id="comment_post_track" name="comment_post_track" value="comment_post_track" <?php if($wpmas_options['events']['comment_post']['track']) echo 'checked' ?>>
				</label>
				<label for="comment_post_receiver">
					<input name="comment_post_receiver" placeholder="es: agentSmith agentJohn" type="text" id="comment_post_receiver" value="<?php echo $wpmas_options['events']['comment_post']['receiver']; ?>" class="regular-text" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row"><label>New user</label></th>
			<td>
				<label for="user_register_track">Track event: 
					<input type="checkbox" id="user_register_track" name="user_register_track" value="user_register_track" <?php if($wpmas_options['events']['user_register']['track']) echo 'checked' ?>>
				</label>
				<label for="user_register_receiver">
					<input name="user_register_receiver" placeholder="es: agentSmith agentJohn" type="text" id="user_register_receiver" value="<?php echo $wpmas_options['events']['user_register']['receiver']; ?>" class="regular-text" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row"><label>User login</label></th>
			<td>
				<label for="login_track">Track event: 
					<input type="checkbox" id="login_track" name="login_track" value="login_track" <?php if($wpmas_options['events']['login']['track']) echo 'checked' ?>>
				</label>
				<label for="login_receiver">
					<input name="login_receiver" placeholder="es: agentSmith agentJohn" type="text" id="login_receiver" value="<?php echo $wpmas_options['events']['login']['receiver']; ?>" class="regular-text" />
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row"><label>Page visit</label></th>
			<td>
				<label for="visit_track">Track event: 
					<input type="checkbox" id="visit_track" name="visit_track" value="visit_track" <?php if($wpmas_options['events']['visit']['track']) echo 'checked' ?>>
				</label>
				<label for="visit_receiver">
					<input name="visit_receiver" placeholder="es: agentSmith agentJohn" type="text" id="visit_receiver" value="<?php echo $wpmas_options['events']['visit']['receiver']; ?>" class="regular-text" />
				</label>
			</td>
		</tr>
	</table>
		<p><input type="submit" class="button-primary" value="Update"/></p>
	</form>
	
</div>
	<?php
	
}