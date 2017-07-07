<?php

/* 
 * Functionalities related to the database
 */

/**
 * Get plugin options
 * Returns all options as a dictionary
 */
function wpmas_get_options() {
	return get_option("wpmas_options");
}

/**
 * Set plugin $option with value $value
 */
function wpmas_set_options($wpmas_options) {
	update_option("wpmas_options", $wpmas_options);
}