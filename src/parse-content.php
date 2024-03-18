<?php
/**
 * Parses the content
 *
 * @package deibic
 */

// check if WordPress is loaded.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Register the new REST API endpoint to enable
 * Gutenberg to use the block parser
 *
 * @wp-hook	rest_api_init
 *
 * @return	void
 */
function deibic_register_rest_route() {
	register_rest_route(
		'deibic/v1',
		'parseblocks',
		array(
			'methods'             => 'POST',
			'callback'            => 'deibic_parse_content',
			'permission_callback' => '__return_true',
		)
	);
}

/**
 * Iterates through each block from the gutenberg editor and
 * flattens the n-dimensional array with a recoursive function.
 *
 * @callback	deibic_register_rest_route
 *
 * @param	WP_REST_Request $request
 *
 * @return	WP_REST_Response
 */
function deibic_parse_content( WP_REST_Request $request ) {

	$locale = get_locale();
	$locale_lib = get_site_option( 'deibic_library_' . $locale, '' );
	$locale_lib = json_decode( $locale_lib );
	if ( empty( $locale_lib ) ) {
		return new WP_REST_Response( [], 200 );
	}

	$content = $request->get_json_params();
	$blocks = deibic_get_blocks_from_content( $content['blocks'] );

	$issues = [];
	foreach ( $blocks as $block ) {
		foreach ( $locale_lib as $term ) {
			$content = strip_tags($block['content']);
			if ( $term->phrase !== '' && str_contains( strtolower( $content ), strtolower( $term->phrase ) ) ) {
				$issues[$term->phrase]['item'] = $term;
				$issues[$term->phrase]['blocks'][] = $block['clientId'];
			}
		}
	}

	// 4 U. Let's Get This Party Started.
	return new WP_REST_Response( array_values( $issues ), 200 );
}

/**
 * Recoursive function to flatten the array
 * to single blocks
 *
 * @param	array $content the current block to analyze
 * @param	array $blocks the stack for the flatten blocks
 *
 * @return	array $blocks
 */
function deibic_get_blocks_from_content( $content, $blocks = [] ) {

	foreach ( $content as $block ) {

		if ( ! empty( $block['innerBlocks'] ) ) {
			$blocks = deibic_get_blocks_from_content( $block['innerBlocks'], $blocks );
		} else {
			$new_block = array(
				'clientId' => $block['clientId'],
				'content' => $block['attributes']['content'],
			);
			$blocks[] = $new_block;
		}
	}

	return $blocks;
}
