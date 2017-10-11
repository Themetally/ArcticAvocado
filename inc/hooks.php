<?php

function unstyled_is_blog_archive() {

	return (
		'post' == get_post_type()
		&&
		( is_home() || is_author() || is_category() || is_tag() || is_date() )
	);
}

function unstyled_has_sidebar() {

	return (
		is_active_sidebar( 'sidebar' )
		&& ! is_singular()
	);

}


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
// Quite likely you'll want to uncomment this:
function unstyled_body_classes( $classes ) {

	if ( unstyled_has_sidebar() ) {
		$classes[] = 'has-sidebar';
	}

	if ( unstyled_is_blog_archive() ) {
		$classes[] = 'full-width';
	}

	if ( is_singular() ) {
		$classes[] = 'singular';
	}

	return $classes;
}

add_filter( 'body_class', 'unstyled_body_classes' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function unstyled_pingback_header() {

	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}

add_action( 'wp_head', 'unstyled_pingback_header' );


/**
 * Customize ellipsis at end of excerpts.
 */
function unstyled_excerpt_more( $more ) {

	return "...";
}

add_filter( 'excerpt_more', 'unstyled_excerpt_more' );


/* Change Excerpt length */
function unstyled_adjust_excerpt_length( $length ) {

	return 21;
}

add_filter( 'excerpt_length', 'unstyled_adjust_excerpt_length' );