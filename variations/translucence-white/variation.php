<?php
/*
Theme Name: Translucence
Variation Name: White Translucence
Variation id: translucence-white
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/

if ($translucence_options['background'] == "translucence-white") {

	if ($translucence_options['variation-type'] == "default") {	

		$translucence_options['header-text-shadow-offset'] = "1px 1px";
		$translucence_options['header-text-shadow-blur'] = "2px";
		
		$translucence_options['site-title-color'] = "#003366";
		$translucence_options['site-description-color'] = "#999999";
		
		$translucence_options['tag-links-color'] = "#262626";
		$translucence_options['cat-links-color'] = "#262626";
		
		$translucence_options['site-color'] = "#F3F3F3";
		$translucence_options['title-box-color'] = "#FFFFFF";
		$translucence_options['description-box-color'] = "#FFFFFF";
		
		$translucence_options['header-color'] = "#FFFFFF";
		$translucence_options['top-color'] = "#FFFFFF";
		$translucence_options['left01-color'] = "#FFFFFF";
		$translucence_options['content-color'] = "#FFFFFF";
		$translucence_options['right01-color'] = "#FFFFFF";
		$translucence_options['right02-color'] = "#FFFFFF";
		$translucence_options['bottom-color'] = "#FFFFFF";
		
		$translucence_options['site-opacity'] = "0";
		
		$translucence_options['header-opacity'] = ".3";
		$translucence_options['top-opacity'] = ".0";
		$translucence_options['left01-opacity'] = ".6";
		$translucence_options['content-opacity'] = ".9";
		$translucence_options['right01-opacity'] = ".3";
		$translucence_options['right02-opacity'] = "0";
		$translucence_options['bottom-opacity'] = ".3";
		
		$translucence_options['site-border-style'] = "none";
		$translucence_options['header-border-style'] = "none";
		$translucence_options['top-border-style'] = "none";
		$translucence_options['content-border-style'] = "solid";
		$translucence_options['left01-border-style'] = "none";
		$translucence_options['right01-border-style'] = "none";
		$translucence_options['right02-border-style'] = "none";
		$translucence_options['bottom-border-style'] = "dotted";
		
	}


}	
	
?>