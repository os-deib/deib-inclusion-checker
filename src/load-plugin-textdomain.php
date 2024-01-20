<?php
/**
 * Loads the textdomain
 *
 * @package deibic
 */

// check if WordPress is loaded.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Loads the plugins textdomain
 *
 * @wp-hook init
 *
 * @return  void
 */
function deibic_load_plugin_textdomain() {

	load_plugin_textdomain( 'deib-inclusion-checker', false, dirname( DEIBIC_PLUGIN_BASENAME ) . '/languages' );
}
