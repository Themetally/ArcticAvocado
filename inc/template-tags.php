<?php

if ( ! function_exists( 'gridly_the_tags' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function gridly_the_tags() {

		// Hide tag text for pages.
		if ( 'post' !== get_post_type() ) {
			return;
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ' ', 'gridly' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'gridly' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}


	}
}

/**
 * Display category list
 */
if ( ! function_exists( 'gridly_the_category_list' ) ) {
	function gridly_the_category_list() {

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'gridly' ) );
		if ( $categories_list && gridly_categorized_blog() ) {
			printf( '<div class="category-links">' . esc_html__( '%1$s', 'gridly' ) . '</div>', $categories_list ); // WPCS: XSS OK.
		}
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'gridly_categorized_blog' ) ) {
	function gridly_categorized_blog() {

		if ( false === ( $all_the_cool_cats = get_transient( 'gridly_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields'     => 'ids',
					'hide_empty' => 1,
					// We only need to know if there is more than one category.
					'number'     => 2,
				)
			);

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'gridly_categories', $all_the_cool_cats );
		}

		// This blog has more than 1 category so gridly_categorized_blog should return true.
		if ( $all_the_cool_cats > 1 ) {
			return true;
		}

		// This blog has only 1 category so gridly_categorized_blog should return false.
		return false;

	}
}

/**
 * Flush out the transients used in gridly_categorized_blog.
 */
function gridly_category_transient_flusher() {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'gridly_categories' );
}

add_action( 'edit_category', 'gridly_category_transient_flusher' );
add_action( 'save_post', 'gridly_category_transient_flusher' );


if ( ! function_exists( 'gridly_search_results_title' ) ) {
	function gridly_search_results_title() {

		printf(
			esc_html__( 'Search Results for: %s', 'gridly' ),
			'<span>' . get_search_query() . '</span>'
		);
	}
}

if ( ! function_exists( 'gridly_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function gridly_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		$posted_on = sprintf(
			esc_html_x( 'Published %s', 'post date', 'gridly' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'gridly' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			' <span class="edit-link"><span class="extra">Admin </span>',
			'</span>'
		);

	}
}

if ( ! function_exists( "gridly_post_navigation" ) ) {
	function gridly_post_navigation() {

		// Check if whe have posts to navigate to.
		$previous = get_previous_post_link( '<div class="nav-previous"><span>' . esc_html__( 'Previous', 'gridly' ) . ' </span>%link</div>' );
		$next     = get_next_post_link( '<div class="nav-next"><span>' . esc_html__( 'Next', 'gridly' ) . ' </span>%link</div>' );

		// Return if there are none.
		if ( ! $previous && ! $next ) {
			return;
		}

		// Create the markup for the links.
		$html = _navigation_markup( $previous . $next, 'post-navigation' );

		// Filter and echo the navigation.
		echo apply_filters( 'gridly_post_navigation', $html ); // wpcs: xss ok.
	}
}
