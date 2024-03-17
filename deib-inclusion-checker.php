<?php
/**
 * Plugin Name: DEIB Inclusion Checker
 * Plugin URI:  https://github.com/orgs/os-deib/deib-inclusion-checker
 * Description: The project aims to develop an "Inclusion Checker" plugin for WordPress, designed to assist contributors in creating content that is accessible, inclusive, and clear, particularly for a global audience with diverse linguistic and cultural backgrounds.
 * Version:     0.1
 * Author:      #CFHack24
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

	// load assets
	require_once __DIR__ . '/src/load-assets.php';
	add_action( 'init', 'deibic_register_scripts' );
	add_action( 'enqueue_block_editor_assets', 'deibic_script_enqueue' );

	require_once __DIR__ . '/src/load-library.php';
	add_action( 'current_screen', 'deibic_maybe_load_library' );

	require_once __DIR__ . '/src/parse-content.php';
	add_action( 'rest_api_init', 'deibic_register_rest_route' );
}
add_action( 'plugins_loaded', 'deibic_init' );
