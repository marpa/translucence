<?php
/*
Theme Name: Translucence
Variation Name: Gray Translucence
Variation id: translucence-gray
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/

if ($translucence_options['background'] == "translucence-gray") {

	$translucence_options['background_image'] = "none";
	$translucence_options['background_color'] = "#F5F5F5";
	$translucence_options['bgtextcolor'] = "#999999";
	$translucence_options['bglinkcolor'] = "#666666";
	$translucence_options['bgbordercolor'] = "#999999";

	$translucence_options['transparent-heading-color'] = "#222222";
	$translucence_options['transparent-link-color']  = $translucence_options['linkcolor'];
	$translucence_options['transparent-text-color']  = $translucence_options['textcolor'];

}	
	
?>