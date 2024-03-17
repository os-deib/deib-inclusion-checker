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
function deibci_register_rest_route() {
	register_rest_route(
		'deibci/v1',
		'parseblocks',
		array(
			'methods'  => 'POST',
			'callback' => 'deibci_parse_content'
		)
	);
}

/**
 * Iterates through each block from the gutenberg editor and
 * flattens the n-dimensional array with a recoursive function.
 * 
 * @callback	deibci_register_rest_route
 * 
 * @param	WP_REST_Request $request
 * 
 * @return	string
 */
function deibci_parse_content( WP_REST_Request $request ) {

	$locale = get_locale();
	$locale_lib = get_site_option( 'deibic_library_' . $locale, [] );
	$locale_lib = json_decode( $locale_lib );
	if ( empty( $locale_lib ) ) {
		return new WP_REST_Response( [], 200 );
	}

	$content = $request->get_body();
	$content = json_decode( $content );
	$blocks = deibci_get_blocks_from_content( $content );

	$issues = [];
	foreach ( $blocks as $block ) {
		foreach ( $locale_lib as $term ) {
			if ( $term->phrase !== '' && str_contains( strtolower( $block['originalContent'] ), strtolower( $term->phrase ) ) ) {
				$issues[$term->phrase]['item'] = $term;
				$issues[$term->phrase]['blocks'][] = $block['clientId'];
			}
		}
	}

	// 4 U. Let's Get This Party Started.
	return new WP_REST_Response( $issues, 200 );
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
function deibci_get_blocks_from_content( $content, $blocks = [] ) {

	foreach ( $content as $block ) {

		if ( ! empty( $block->innerBlocks ) ) {
			$blocks = deibci_get_blocks_from_content( $block->innerBlocks, $blocks );
		} else {
			$new_block = array(
				'clientId' => $block->clientId,
				'originalContent' => $block->originalContent
			);
			$blocks[] = $new_block;
		}
	}

	return $blocks;
}