<?php
/*
Theme Name: Translucence
Variation Name: Blue Translucence
Variation id: translucence-blue
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/

if ($options['background'] == "translucence-blue") {

	$options['background_image_file'] = "bg-blue01.png";
	$options['background_image_directory'] = "translucence-blue";
	$options['background_image'] = "url('".get_bloginfo("template_directory");
	$options['background_image'] .= "/variations/".$options['background_image_directory'];
	$options['background_image'] .= "/".$options['background_image_file']."')";
	$options['background_repeat'] = "no-repeat";
	$options['background_position'] = "center top";
	$options['background_attachment'] = "fixed";
	
	$options['background-source-url'] = "";
 	$options['background-source-credit'] = "Blue";	
	
	$options['background_color'] = "#051E3C";
	$options['bgtextcolor'] = "#CCCCCC";
	$options['bglinkcolor'] = "#FFFFFF";
	$options['bgbordercolor'] = "#000000";
	
	$options['transparent-heading-color'] = "#CCCC99";
	$options['transparent-link-color']  = "#FFFFFF";
	$options['transparent-text-color']  = "#FFFFFF";
	
	$options['left01-heading-color'] = "#354253";
	$options['right01-heading-color'] = "#354253";
	$options['right02-heading-color'] = "#354253";
	
	$options_values['sidebar-color'] = array(
		'White' => '#FFFFFF',
		'Yellow' => '#FFF8C6',
		'Muted Yellow' => '#e9e9c9',
		'Gray Blue'	=> '#364559',	
	);
	
	if (!in_array($options['top-color'], array_values($options_values['sidebar-color']))) $options['top-color'] = "#364559";
	if (!in_array($options['header-color'], array_values($options_values['sidebar-color']))) $options['header-color'] = "#364559";
	if (!in_array($options['content-color'], array_values($options_values['sidebar-color']))) $options['content-color'] = "#FFFFFF";
	if (!in_array($options['bottom-color'], array_values($options_values['sidebar-color']))) $options['bottom-color'] = "#364559";
	if (!in_array($options['left01-color'], array_values($options_values['sidebar-color']))) $options['left01-color'] = "#364559";
	if (!in_array($options['right01-color'], array_values($options_values['sidebar-color']))) $options['right01-color'] = "#364559";
	if (!in_array($options['right02-color'], array_values($options_values['sidebar-color']))) $options['right02-color'] = "#364559";
	if (!in_array($options['cat-links-color'], array_values($options_values['sidebar-color']))) $options['cat-links-color'] = "#e9e9c9";
	if (!in_array($options['tag-links-color'], array_values($options_values['sidebar-color']))) $options['tag-links-color'] = "#FFF8C6";

}	
	
?>