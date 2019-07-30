<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Buz_Google_Reviews
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

	global $wpdb;
	$wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."buz_google_reviews` ");


	//Delete options
 	delete_option('buz_show_min_review_el');
 
 	delete_option('buz_google_logo_el');

 	delete_option('buz_company_review_star_el');
 
 	delete_option('buz_toggle_company_name_el');
 
 	delete_option('buz_toggle_see_all_el');
 
 	delete_option('buz_google_api_el');
 
 	delete_option('buz_company_name_el');
 
	 delete_option('buz_reviews_per_row_el');
	 
	 delete_option('buz_next_nav_text_el');
	 
 	 delete_option('buz_prev_nav_text_el');
	 
 	 delete_option('buz_slider_speed_el');
