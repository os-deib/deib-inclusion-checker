<?php
/**
 * Loads the assets
 *
 * @package deibic
 */

// check if WordPress is loaded.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Register the assets
 *
 * @wp-hook init
 *
 * @return  void
 */
function deibic_register_scripts() {
	wp_register_script(
		'deibic-editor',
		plugins_url( 'build/index.js', DEIBIC_PLUGIN_BASENAME ),
		[
			'react',
			'wp-plugins',
			'wp-edit-post',
			'wp-components'
		]
	);
	wp_register_style(
		'deibic-editor',
		plugins_url( 'build/index.css', DEIBIC_PLUGIN_BASENAME )
	);
}

/**
 * Enqueue the assets
 *
 * @wp-hook enqueue_block_editor_assets
 *
 * @return  void
 */
function deibic_script_enqueue() {
	wp_enqueue_script( 'deibic-editor' );
	wp_enqueue_style( 'deibic-editor' );
}
