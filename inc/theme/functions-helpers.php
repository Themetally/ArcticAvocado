<?php

/*
 * This function is going to return true only once
 */
function unstyled_is_first_post() {

	global $wp_query;

	return ( 0 == $wp_query->current_post );
}


function unstyled_get_dynamic_thumbnail_size() {

	if ( unstyled_is_first_post() ) {
		return 'unstyled-blog-large';
	}

	return 'unstyled-blog-small';

}