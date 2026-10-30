<?php

/**
 * Enqueue JS and CSS
 */
function cre8_scripts() {
	if ( !is_admin() ) {
		wp_enqueue_style( 'styles', vite_asset_busted( 'src/styles/styles.scss' ), array(), null );

		wp_register_script( 'scripts', vite_asset_busted( 'src/js/scripts.js' ), array(), null, true );
		wp_enqueue_script( 'scripts' );

		foreach ( vite_asset_css( 'src/js/scripts.js' ) as $i => $url ) {
			wp_enqueue_style( 'scripts-css-' . $i, $url, array(), null );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'cre8_scripts', 100 );



/**
 * Preload the main font so text renders in it sooner.
 * Only upright Inter is preloaded: it covers all body text and headings. The italic loads on demand.
 * Skipped if the file is missing (for example before the first build).
 */
function cre8_preload_fonts() {
	$fonts = array( 'Inter-Normal.woff2' );

	foreach ( $fonts as $font ) {
		if ( ! file_exists( get_theme_file_path( 'assets/fonts/' . $font ) ) ) {
			continue;
		}

		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( get_theme_file_uri( 'assets/fonts/' . $font ) )
		);
	}
}
add_action( 'wp_head', 'cre8_preload_fonts', 1 );



/**
 * Remove wp-embed.js
 */
function cre8_deregister_scripts() {
	if ( !is_admin() ) {
		wp_deregister_script( 'wp-embed' );
	}
}
add_action( 'wp_print_scripts', 'cre8_deregister_scripts', 100);



/**
 * Remove jquery-migrate.js
 */
function cre8_deregister_jquery_migrate( $scripts ) {
	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		$jquery_dependencies = $scripts->registered['jquery']->deps;
		$scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array( 'jquery-migrate' ) );
	}
}
add_action( 'wp_default_scripts', 'cre8_deregister_jquery_migrate' );



function vite_get_manifest( $manifest_directory = 'assets' ) {
	static $manifests = [];

	if ( ! isset( $manifests[ $manifest_directory ] ) ) {
		$manifest_path = get_theme_file_path( $manifest_directory . '/.vite/manifest.json' );
		if ( ! file_exists( $manifest_path ) ) {
			$manifests[ $manifest_directory ] = null;
		} else {
			// @codingStandardsIgnoreLine
			$manifests[ $manifest_directory ] = json_decode( file_get_contents( $manifest_path ), true );
		}
	}

	return $manifests[ $manifest_directory ];
}



function vite_asset( $path, $manifest_directory = 'assets' ) {
	$manifest = vite_get_manifest( $manifest_directory );

	if ( ! $manifest || ! array_key_exists( $path, $manifest ) ) {
		return get_theme_file_uri( $path );
	}

	return get_theme_file_uri( trailingslashit( $manifest_directory ) . $manifest[ $path ]['file'] );
}



/**
 * vite_asset() plus a cache-buster for development builds.
 * Production files have a content hash in their name, so they need none. Development builds keep the
 * same name every time, so add ?v=<modified time> to stop browsers using a stale copy.
 * (Not for add_editor_style(), which reads the file from disk and cannot take a query string.)
 */
function vite_asset_busted( $path, $manifest_directory = 'assets' ) {
	$url  = vite_asset( $path, $manifest_directory );
	$file = get_theme_file_path( str_replace( trailingslashit( get_template_directory_uri() ), '', $url ) );

	if ( preg_match( '/-[A-Za-z0-9_-]{8}\.(css|js)$/', $url ) || ! file_exists( $file ) ) {
		return $url;
	}
	return add_query_arg( 'v', filemtime( $file ), $url );
}



function vite_asset_css( $path, $manifest_directory = 'assets' ) {
	$manifest = vite_get_manifest( $manifest_directory );

	if ( ! $manifest ) {
		return [];
	}

	$css_files = $manifest[ $path ]['css'] ?? [];
	return array_map( function( $css ) use ( $manifest_directory ) {
		return get_theme_file_uri( trailingslashit( $manifest_directory ) . $css );
	}, $css_files );
}
