<?php
/**
 * 2010 Translucence plugin functions 
 *
 * Add here any functions from plugins
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since 2010 Translucence 1.0
 */
 

 /**
 * default twentyten_posted_on() overridden here to support use of
 * co-author plugin
 *
 * @since 2010 Translucence 1.0
 * @return string link to parent page
 */

function twentyten_posted_on() {
	printf( __( '<span class="%1$s"></span> %2$s <span class="meta-sep">by </span>', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		)
	);
	
	if (function_exists('coauthors_posts_links')) {
		coauthors_posts_links();
	} else {
		the_author_posts_link();
	}
}

 /**
 * default translucence_get_author() overridden here to support use of
 * co-author plugin
 *
 * @since 2010 Translucence 1.0
 * @return string link to parent page
 */

function translucence_get_author() {
	if ( function_exists('coauthors_posts_links') ) {
		$i = new CoAuthorsIterator();
		while ($i->iterate()) {
			translucence_get_author_info();
		}
	} else {
		translucence_get_author_info();
	}
}


function translucence_display_privacy($blog_id) {
	
	if ( is_multisite() ) {
		$blog_public = get_blog_option($blog_id,'blog_public');
	} else {
  		$blog_public = get_option('blog_public');
	}
	
	if ( '1' == $blog_public || '0' == $blog_public) {
		return '';
	}
	if ( '-1' == $blog_public ) {
		return 'Network Users Only ';
	}
	if ( '-2' == $blog_public ) {
		return 'Site Members Only ';
	}
	if ( '-3' == $blog_public ) {
		return 'Site Admins Only ';
	}
}



function translucence_slider_header()
{
	if( function_exists('boom_header_image') ) {
		boom_header_image();
	}
}
add_filter( 'translucence_behind_header_title', 'translucence_slider_header' );


?>
