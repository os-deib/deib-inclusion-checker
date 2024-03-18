<?php
/**
 * Loads the library.
 *
 * @package deibic
 */

// check if WordPress is loaded.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Gives the list of currently refined languages.
 *
 * @return array
 */
function deibic_get_refined_languages() {
	return array(
		'en_US',
	);
}

/**
 * This function checks if WordPress needs to request the language. If the language is not loaded yet, the request
 * functions will be triggered.
 *
 * @wp-hook current_screen
 *
 * @return void
 */
function deibic_maybe_load_library() {
	$current_screen = get_current_screen();

	// check if we are on the block editor because we only need to load the library there.
	if ( true !== $current_screen->is_block_editor ) {
		return;
	}

	// get the locale of the current blog to determine if the language is already refined.
	$locale = get_locale();
	if ( ! in_array( $locale, deibic_get_refined_languages(), true ) ) {
		return;
	}

	// the timeout of fetching the library is set to 24h.
	$timeout      = apply_filters( 'deibic_library_fetch_timeout', 86400 );
	$last_fetches = get_site_option( 'deibic_last_fetches', array() );

	// fetch the language if there hasn't been a fetch yet.
	if ( ! in_array( $locale, array_keys( $last_fetches ), true ) ) {
		deibic_fetch_language( $locale, $last_fetches );

		return;
	}

	// check if the last check is before the current time minus the timeout.
	$time_difference = time() - $last_fetches[ $locale ];
	if ( $time_difference >= $timeout ) {
		deibic_fetch_language( $locale, $last_fetches );

		return;
	}

	// check if the library is actually in the site options.
	$library = get_site_option( 'deibic_library_' . $locale, array() );
	if ( empty( $library ) ) {
		deibic_fetch_language( $locale, $last_fetches );

		return;
	}
}

/**
 * Fetches the language.
 *
 * @param string $locale       The current locale of this instance.
 * @param array  $last_fetches The site option.
 *
 * @return void
 */
function deibic_fetch_language( $locale, $last_fetches ) {

	$deibic_base_url = 'https://raw.githubusercontent.com/os-deib/deib-inclusion-checker-library/main/';
	$library_url     = $deibic_base_url . $locale . '.json';

	$response = wp_remote_get( $library_url );
	if ( is_array( $response ) && ! is_wp_error( $response ) ) {
		$data = $response['body'];
		update_site_option( 'deibic_library_' . $locale, $data );
		$last_fetches[ $locale ] = time();
		update_site_option( 'deibic_last_fetches', $last_fetches );
	}
}
