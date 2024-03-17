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

// Just a debug function to print out stuff in a pretty way.
if ( ! function_exists( 'debug' ) ) {
	function debug( $a, $b = false ) {
		echo '<pre>';
		! $b ? print_r( $a ) : var_dump( $a );
		echo '</pre>';
	}
}

// This function is used to filter out empty blocks.
function is_non_empty_block( $block ) {
	return ! ( $block['blockName'] === null && empty( trim( $block['innerHTML'] ) ) );
}

// This function is used to parse the blocks and filter out empty blocks.
function parse_blocks_ignore_empty_blocks( $input ) {
	return array_filter( parse_blocks( $input ), 'is_non_empty_block' );
}

// Get the post content, temporary for testing.
$post = get_post(2);

// Parse the blocks.
$blocks = parse_blocks_ignore_empty_blocks( $post->post_content );

// Get the library, will be fetched from options later.
$file = file_get_contents( '/Users/jessicalyschik/Sites/cloudfest.hack/wp-content/plugins/test.json' );
$library = json_decode( $file );

// debug($blocks);

// Variable to collect issues.
$issues = array();
$blocks_with_issues = array();

function deibic_check_block_for_inner( $block ) {

}

// Loop through the blocks and check for issues.
foreach ( $blocks as $block_id => $block ) {
	foreach ( $library as $item ) {
		if ( ! empty( $block['innerBlocks'] ) ) {
			foreach ( $block['innerBlocks'] as $innerBlock ) {
				if ( $item->phrase !== '' && str_contains( strtolower( $innerBlock['innerHTML'] ), strtolower( $item->phrase ) ) ) {
					$issues[$item->phrase]['item'] = $item;
					$issues[$item->phrase]['blocks'][] = $block_id;
				}
			}
		} else {
			if ( $item->phrase !== '' && str_contains( strtolower( $block['innerHTML'] ), strtolower( $item->phrase ) ) ) {
				$issues[$item->phrase]['item'] = $item;
				$issues[$item->phrase]['blocks'][] = $block_id;
			}
		}
	}
}

// debug($issues);



// Return the issues and the blocks with issues.
$return =  wp_json_encode( $issues );

// debug($issues);