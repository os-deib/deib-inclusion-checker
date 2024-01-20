<?php
/**
 * Plugin Name: DEIB Inclusion Checker
 * Plugin URI:  https://github.com/orgs/os-deib/deib-inclusion-checker
 * Description: The project aims to develop an "Inclusion Checker" plugin for WordPress, designed to assist contributors in creating content that is accessible, inclusive, and clear, particularly for a global audience with diverse linguistic and cultural backgrounds.
 * Version:     0.1
 * Author:      Birgit Olzem, Laura Herzog, Maja Benke
 * Text Domain: deib-inclusion-checker
 * Domain Path: /languages
 * License:     GPL v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Network:     true
 *
 * @package     deibic
 */

// check if WordPress is loaded.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

// we only need the following stuff in the admin area.
if ( ! is_admin() ) {
	return;
}

// set needed constant.
define( 'DEIBIC_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * Initialize the plugin.
 *
 * @wp-hook plugins_loaded
 *
 * @return void
 */
function deibic_init() {

	// load the textdomain.
	require_once __DIR__ . '/src/load-plugin-textdomain.php';
	add_action( 'init', 'deibic_load_plugin_textdomain' );

} add_action( 'plugins_loaded', 'anmfm_init' );
