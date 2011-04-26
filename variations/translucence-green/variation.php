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
	$translucence_options['transparent-text-color']  = "#555555";

		
}
	
	
?>