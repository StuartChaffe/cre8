<?php

/**
 * 301 redirects from the old site's .aspx addresses to the new pages.
 * The map (old path => page ID) is saved by the content importer in the cre8_redirects option.
 */
add_action( 'template_redirect', function () {
	if ( ! is_404() ) {
		return;
	}
	$redirects = get_option( 'cre8_redirects' );
	if ( ! $redirects ) {
		return;
	}
	$path = strtolower( rawurldecode( wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ) ?: '' ) );
	if ( isset( $redirects[ $path ] ) && get_post_status( $redirects[ $path ] ) === 'publish' ) {
		wp_safe_redirect( get_permalink( $redirects[ $path ] ), 301 );
		exit;
	}
} );
