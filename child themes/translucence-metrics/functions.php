<?php
/**
 * 2010 Translucence Child functions and definitions
 *
 * 2010 Translucence loosely extends the TwentyTen theme.  Most of the original TwentyTen
 * functions are used and then augmented with Translucence functions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, translucence_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyten_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since 2010 Translucence 1.0
 */

/******************************************************************************
 * Include child theme options-css.php if exists 
 * (rename options-css-sample.php to options-css.php to create child version)
 ******************************************************************************/

if (file_exists(dirname(__FILE__).'/options-css.php')) {
	require_once( get_stylesheet_directory() . '/options-css.php');
}

function translucence_add_config() {
   if (file_exists(dirname(__FILE__).'/config.php')) {
		require_once('config.php');
	}
return $translucence_config;
}

/******************************************************************************
 * remove comment markers (//) for child themes that use their own default variation
 *
 * alternatively, specify default variation and default theme options
 * in the config.php 
 ******************************************************************************/

// function translucence_get_variation_default() {
// 	if (file_exists(dirname(__FILE__) .'/variations/default/variation.php')) {
// 		$variation_default = dirname(__FILE__) .'/variations/default/variation.php';
// 	}
// 	return $variation_default;		
// }


/******************************************************************************
 * remove comment markers (//) for child themes that use their own variations 
 *
 * copy variations from 2010-translucence for use in this child theme
 * alternatively, specify which variations to not include in this child theme
 * in the config.php $translucence_config['variations_disabled']
 ******************************************************************************/

function translucence_get_variations_source() {

	if (file_exists(dirname(__FILE__) .'/variations/')) {
		$translucence_variations_path = dirname(__FILE__) .'/variations';
	}
	return $translucence_variations_path;
}


?>
