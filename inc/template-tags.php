<?php

if ( ! function_exists( 'unstyled_the_tags' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function unstyled_the_tags() {

		// Hide tag text for pages.
		if ( 'post' !== get_post_type() ) {
			return;
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'unstyled' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'unstyled' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}


	}
}

/**
 * Display category list
 */
if ( ! function_exists( 'unstyled_the_category_list' ) ) {
	function unstyled_the_category_list() {

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'unstyled' ) );
		if ( $categories_list && unstyled_categorized_blog() ) {
			printf( '<div class="category-links">' . esc_html__( '%1$s', 'unstyled' ) . '</div>', $categories_list ); // WPCS: XSS OK.
		}
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'unstyled_categorized_blog' ) ) {
	function unstyled_categorized_blog() {

		if ( false === ( $all_the_cool_cats = get_transient( 'unstyled_categories' ) ) ) {
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

			set_transient( 'unstyled_categories', $all_the_cool_cats );
		}

		// This blog has more than 1 category so unstyled_categorized_blog should return true.
		if ( $all_the_cool_cats > 1 ) {
			return true;
		}

		// This blog has only 1 category so unstyled_categorized_blog should return false.
		return false;

	}
}

/**
 * Flush out the transients used in unstyled_categorized_blog.
 */
function unstyled_category_transient_flusher() {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'unstyled_categories' );
}

add_action( 'edit_category', 'unstyled_category_transient_flusher' );
add_action( 'save_post', 'unstyled_category_transient_flusher' );


if ( ! function_exists( 'unstyled_search_results_title' ) ) {
	function unstyled_search_results_title() {

		printf(
			esc_html__( 'Search Results for: %s', 'unstyled' ),
			'<span>' . get_search_query() . '</span>'
		);
	}
}

if ( ! function_exists( 'unstyled_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function unstyled_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( 'Published %s', 'post date', 'unstyled' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'unstyled' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			' <span class="edit-link"><span class="extra">Admin </span>',
			'</span>'
		);

	}
}