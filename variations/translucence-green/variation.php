<?php
/*
Theme Name: Translucence
Variation Name: Green Translucence
VAriation id: translucence-green
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/


if ($translucence_options['background'] == "translucence-green") {

	// option values
	$translucence_options['background_image_file'] = "green01.png";
	$translucence_options['background_image_directory'] = "translucence-green";
	$translucence_options['background_image'] = "url('".get_bloginfo("template_directory");
	$translucence_options['background_image'] .= "/variations/".$translucence_options['background_image_directory'];
	$translucence_options['background_image'] .= "/".$translucence_options['background_image_file']."')";
	$translucence_options['background_repeat'] = "repeat";
	$translucence_options['background_position'] = "center top";		
	$translucence_options['background_color'] = "#83A776";
	$translucence_options['bgtextcolor'] = "#444444";
	$translucence_options['bglinkcolor'] = "#333333";
	$translucence_options['bgbordercolor'] = "#666666";	
	
	$translucence_options['transparent-heading-color'] = "#333333";
	$translucence_options['transparent-link-color']  = "#FFFFFF";
	$translucence_options['transparent-text-color']  = "#BBBBBB";

	if ($translucence_options['variation-type'] == "default") {	

		$translucence_options['header-text-shadow-offset'] = "1px 1px";
		$translucence_options['header-text-shadow-blur'] = "2px";
		
		$translucence_options['site-title-color'] = "#E3D729";
		$translucence_options['site-description-color'] = "#D9D9D9";
		
		$translucence_options['tag-links-color'] = "#FFF8C6";
		$translucence_options['cat-links-color'] = "#CC9";
		
		$translucence_options['site-color'] = "#F3F3F3";
		$translucence_options['title-box-color'] = "#FFFFFF";
		$translucence_options['description-box-color'] = "#FFFFFF";
		
		$translucence_options['header-color'] = "#4a6339";
		$translucence_options['top-color'] = "#F9F9F9";
		$translucence_options['left01-color'] = "#4a6339";
		$translucence_options['content-color'] = "#FFFFFF";
		$translucence_options['right01-color'] = "#4a6339";
		$translucence_options['right02-color'] = "#4a6339";
		$translucence_options['bottom-color'] = "#4a6339";
		
		$translucence_options['site-opacity'] = "0";
		
		$translucence_options['header-opacity'] = ".3";
		$translucence_options['top-opacity'] = ".0";
		$translucence_options['left01-opacity'] = ".2";
		$translucence_options['content-opacity'] = "1";
		$translucence_options['right01-opacity'] = "0";
		$translucence_options['right02-opacity'] = "0";
		$translucence_options['bottom-opacity'] = ".3";
		
		$translucence_options['site-border-style'] = "none";
		$translucence_options['header-border-style'] = "none";
		$translucence_options['top-border-style'] = "none";
		$translucence_options['content-border-style'] = "solid";
		$translucence_options['left01-border-style'] = "none";
		$translucence_options['right01-border-style'] = "none";
		$translucence_options['right02-border-style'] = "none";
		$translucence_options['bottom-border-style'] = "none";
		
	}

		
}
	
	
?>