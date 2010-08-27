<?php
/*
Theme Name: Translucence
Variation Name: Gray White Gradient Translucence
Variation id: translucence-gray-white
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/

if ($options['background'] == "translucence-gray-white") {

	$options['background_image_file'] = "bg_topdark.jpg";
	$options['background_image_directory'] = "translucence-gray-white";	
	$options['background_image'] = "url('".get_bloginfo("template_directory");
	$options['background_image'] .= "/variations/".$options['background_image_directory'];
	$options['background_image'] .= "/".$options['background_image_file']."')";
	$options['background_attachment'] = "fixed";

	$options['background_color'] = "#FFFFFF";
	$options['bgtextcolor'] = "#999999";
	$options['bglinkcolor'] = "#666666";
	$options['bgbordercolor'] = "#999999";

	$options['transparent-blogtitle-color'] = $options['linkcolor']; 
	$options['transparent-blogdescription-color'] = $options['textcolor'];
	$options['transparent-heading-color'] = "#222222";
	$options['transparent-link-color']  = $options['linkcolor'];
	$options['transparent-text-color']  = $options['textcolor'];


}	
	
?>