<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.0.0
 * @package           Buz_Google_Reviews
 *
 * @wordpress-plugin
 * Plugin Name:       My Buz Google Reviews
 * Plugin URI:        #
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Uchenna Nwachukwu
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       buz-google-reviews
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BUZ_GOOGLE_REVIEWS_VERSION', '1.0.0' );

 
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-buz-google-reviews-activator.php
 */
function activate_buz_google_reviews() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-buz-google-reviews-activator.php';
	Buz_Google_Reviews_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-buz-google-reviews-deactivator.php
 */
function deactivate_buz_google_reviews() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-buz-google-reviews-deactivator.php';
	Buz_Google_Reviews_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_buz_google_reviews' );
register_deactivation_hook( __FILE__, 'deactivate_buz_google_reviews' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-buz-google-reviews.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_buz_google_reviews() {

	$plugin = new Buz_Google_Reviews();
	$plugin->run();

}
run_buz_google_reviews();

if(!is_admin()){
	require_once plugin_dir_path( __FILE__ ) . 'public/shortcodes/code.php';
}

define( 'LOADING_IMAGE_PATH', plugin_dir_url( __FILE__ ).'includes/images/loading.gif'  );
define( 'GOOGLE_IMAGE_PATH', plugin_dir_url( __FILE__ ).'includes/images/powered_by_google_on_white.png'  );
 