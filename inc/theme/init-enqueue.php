<?php


/**
 * Enqueue scripts and styles.
 */
function gridly_scripts() {

	$version = wp_get_theme()->get( 'Version' );

	/**
	 * === Style ===
	 */

	// Enqueue Google Fonts:
	$google_fonts = array( 'Open Sans:300,400,400i,700,700i', 'Montserrat:400,500,600,700' );
	wp_enqueue_style( 'gridly-fonts', gridly_fonts_url( $google_fonts ) );

	// Theme Styles
	wp_enqueue_style( 'gridly-style', get_template_directory_uri() . '/build/theme-style.css', $version );


	/**
	 * === Script ===
	 */
	// Main theme javascript file
	wp_enqueue_script( 'gridly-script', get_template_directory_uri() . '/build/theme-script.js', array( 'jquery' ), $version, true );


	wp_enqueue_script(
		'gridly-skip-link-focus-fix',
		get_template_directory_uri() . '/build/skip-link-focus-fix.js',
		array(),
		'20151215',
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


	/**
	 * === Localization ===
	 */
	//	wp_localize_script(
	//		'gridly-script',
	//		'__gridly',
	//		array(
	//			// do things
	//		)
	//
	//	);
}

add_action( 'wp_enqueue_scripts', 'gridly_scripts' );