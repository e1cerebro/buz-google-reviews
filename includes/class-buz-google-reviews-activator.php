<?php

/**
 * Fired during plugin activation
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Buz_Google_Reviews
 * @subpackage Buz_Google_Reviews/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Buz_Google_Reviews
 * @subpackage Buz_Google_Reviews/includes
 * @author     Uchenna Nwachukwu <nwachukwu16@gmail.com>
 */
class Buz_Google_Reviews_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		
		global $wpdb;

		$createSQL = "CREATE TABLE `".$wpdb->prefix."buz_google_reviews` (
								`ID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
								`author_id` VARCHAR(250) NULL DEFAULT NULL,
								`author_name` VARCHAR(250) NULL DEFAULT NULL,
								`author_url` VARCHAR(250) NULL DEFAULT NULL,
								`profile_photo_url` VARCHAR(250) NULL DEFAULT NULL,
								`rating` BIGINT(20) UNSIGNED NOT NULL,
								`relative_time` VARCHAR(50) NULL DEFAULT NULL,
								`text` LONGTEXT NULL DEFAULT NULL,
								`status` VARCHAR(250) NOT NULL DEFAULT 'show',
								PRIMARY KEY (`ID`)
 							) ".$wpdb->get_charset_collate()." ;";
		
		require(ABSPATH.'/wp-admin/includes/upgrade.php');

		dbDelta($createSQL);

		//set up the settings options
		if(strlen(get_option('buz_show_min_review_el')) <= 0){
			update_option('buz_show_min_review_el', 3);
		}
		
		if(strlen(get_option('buz_google_logo_el')) <= 0){
			update_option('buz_google_logo_el', 1);
		}

		if(strlen(get_option('buz_company_review_star_el')) <= 0){
			update_option('buz_company_review_star_el', 1);
		}
		

		if(strlen(get_option('buz_toggle_company_name_el')) <= 0){
			update_option('buz_toggle_company_name_el', 1);
		}
		

		if(strlen(get_option('buz_toggle_see_all_el')) <= 0){
			update_option('buz_toggle_see_all_el', 0);
		}

		if(strlen(get_option('buz_reviews_per_row_el')) <= 0){
			update_option('buz_reviews_per_row_el', 1);
		}

		if(strlen(get_option('buz_show_pagination_el')) <= 0){
			update_option('buz_show_pagination_el', 'true');
		}
		

		if(strlen(get_option('buz_show_navigation_el')) <= 0){
			update_option('buz_show_navigation_el', 'false');
		}
		

		if(strlen(get_option('buz_next_nav_text_el')) <= 0){
			update_option('buz_next_nav_text_el', 'Next');
		}
		

		if(strlen(get_option('buz_prev_nav_text_el')) <= 0){
			update_option('buz_prev_nav_text_el', 'Prev');
		}

		if(strlen(get_option('buz_slider_speed_el')) <= 0){
			update_option('buz_slider_speed_el', '1000');
		}
		
	

	}

}
