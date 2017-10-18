<?php

/*
 * This function is going to return true only once
 */
function gridly_is_first_post() {

	global $wp_query;
	global $paged;

	return ( 0 == $wp_query->current_post && 0 == $paged );
}


function gridly_get_dynamic_thumbnail_size() {

	if ( gridly_is_first_post() ) {
		return 'gridly-blog-large';
	}

	return 'gridly-blog-small';

}