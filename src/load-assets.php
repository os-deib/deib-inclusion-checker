<?php
/**
 * Loads the assets.
 *
 * @package deibic
 */

// Check, if WordPress is loaded.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Register the assets.
 *
 * @wp-hook init
 *
 * @return void
 */
function deibic_register_scripts() {
	$block_editor_assets_path  = 'build/index.asset.php';
	$block_editor_scripts_path = 'build/index.js';
	$block_editor_style_path   = 'build/index.css';

	if ( file_exists( DEIBIC_PATH . $block_editor_assets_path ) ) {
		$block_editor_asset = require DEIBIC_PATH . $block_editor_assets_path;
	} else {
		$block_editor_asset = array(
			'dependencies' => array(
				'react',
				'wp-plugins',
				'wp-edit-post',
				'wp-components',
			),
			'version'      => time(),
		);
	}

	if ( file_exists( DEIBIC_PATH . $block_editor_style_path ) ) {
		wp_register_style(
			'deibic-editor',
			DEIBIC_URL . $block_editor_style_path,
			array(),
			$block_editor_asset['version']
		);
	}

	if ( file_exists( DEIBIC_PATH . $block_editor_scripts_path ) ) {
		wp_register_script(
			'deibic-editor',
			DEIBIC_URL . $block_editor_scripts_path,
			$block_editor_asset['dependencies'],
			$block_editor_asset['version'],
			true
		);
	}
}

/**
 * Enqueue the assets.
 *
 * @wp-hook enqueue_block_editor_assets
 *
 * @return void
 */
function deibic_script_enqueue() {
	wp_enqueue_script( 'deibic-editor' );
	wp_enqueue_style( 'deibic-editor' );
}
