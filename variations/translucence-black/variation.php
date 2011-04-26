<?php
/*
Theme Name: Translucence
Variation Name: Black Translucence
VAriation id: translucence-black
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/


if ($options['background'] == "translucence-black") {

	$options['background_image_directory'] = "translucence-black";
	$options['background_image_file'] = "none";
	$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
	$options['background_image'] .= "/variations/".$options['background_image_directory'];
	$options['background_image'] .= "/".$options['background_image_file']."')";
	$options['background_repeat'] = "no-repeat";
	$options['background_position'] = "center top";	

	$options['transparent-heading-color'] = "#CCCC99";
	$options['transparent-link-color']  = "#FFFFFF";
	$options['transparent-text-color']  = "#F2F2F2";
		
	$options['bgtextcolor'] = "#CCCCCC";
	$options['bglinkcolor'] = "#FFFFFF";
	$options['bgbordercolor'] = "#FFFFFF";
	
// 	$options['site-title-color'] = "#CCCC99";
// 	$options['site-description-color'] = "#FFFFFF";
		

	$options['background_color'] = "#0F0F0F";
	$options['foreground_color'] = "#000000";	
	
 	$options['header-text-shadow-color'] = "#000000";
//	$options['header-text-shadow-offset'] = "1px 1px";
//	$options['header-text-shadow-blur'] = "2px";
// 	$options['post-text-shadow-color'] = "#333333";
	$options['post-text-shadow-offset'] = "0px 0px";
	$options['post-text-shadow-blur'] = "0px";
								
	$options['thread-even-bgcolor'] = "#333333";
	$options['thread-alt-bgcolor'] = "#000000";
	$options['commentfield'] = "#FFFFFF";
	
	$options['searchbox-color'] = "#262626";

	/******************************************************************************
	 * theme option value lists
	 ******************************************************************************/

	$translucence_options_values['header-color'] = array(
		'Dark Gray' => '#262626',
		'Black' 	=> '#000000'
		);

	$translucence_options_values['sidebar-color'] = array(
		'Dark Gray' => '#262626',
		'Black' => '#000000'
	);
	
	$translucence_options_values['linkcolor'] = array(
		'Pale Yellow' => '#FFFFCC', 
		'Yellow' => '#EEDD82',
		'Light Gray' => '#CCCCCC',
		'White' => '#FFFFFF'	
	);
	
	$translucence_options_values['textcolor'] = array(
		'White' => '#FFFFFF',
		'10% Gray' => '#EEEEEE',
		'20% Gray' => '#DDDDDD',
		'30% Gray' => '#CCCCCC',
	);

	$translucence_options_values['category-link-style'] = array(
			'Right Sidebar Box' => 'right-sidebar-box',
			'Left Sidebar Box' => 'left-sidebar-box'
	);

	$translucence_options_values['tag-link-style'] = array(
			'Right Sidebar Box' => 'right-sidebar-box',
			'Left Sidebar Box' => 'left-sidebar-box'
	);
	
	
	// if current value is one of this variation's option values, then use it 
	// otherwise use default for this variation
	if (!in_array($options['linkcolor'], array_values($translucence_options_values['linkcolor']))) $options['linkcolor'] = "#FFFFCC";
	if (!in_array($options['textcolor'], array_values($translucence_options_values['textcolor']))) $options['textcolor'] = "#EEEEEE";
	if (!in_array($options['header-color'], array_values($translucence_options_values['header-color']))) $options['header-color'] = "#262626";
		
	if (!in_array($options['left01-link-color'], array_values($translucence_options_values['linkcolor']))) $options['left01-link-color'] = "#FFFFCC";
	if (!in_array($options['right01-link-color'], array_values($translucence_options_values['linkcolor']))) $options['right01-link-color'] = "#FFFFCC";
	if (!in_array($options['right02-link-color'], array_values($translucence_options_values['linkcolor']))) $options['right02-link-color'] = "#FFFFCC";
	
	if (!in_array($options['top-color'], array_values($translucence_options_values['sidebar-color']))) $options['top-color'] = "#000000";
	if (!in_array($options['content-color'], array_values($translucence_options_values['sidebar-color']))) $options['content-color'] = "#000000";
	if (!in_array($options['bottom-color'], array_values($translucence_options_values['sidebar-color']))) $options['bottom-color'] = "#000000";
	if (!in_array($options['left01-color'], array_values($translucence_options_values['sidebar-color']))) $options['left01-color'] = "#262626";
	if (!in_array($options['right01-color'], array_values($translucence_options_values['sidebar-color']))) $options['right01-color'] = "#262626";
	if (!in_array($options['right02-color'], array_values($translucence_options_values['sidebar-color']))) $options['right02-color'] = "#262626";
	
	if (!in_array($options['cat-links-color'], array_values($translucence_options_values['sidebar-color']))) $options['cat-links-color'] = "#262626";
	if (!in_array($options['tag-links-color'], array_values($translucence_options_values['sidebar-color']))) $options['tag-links-color'] = "#262626";		

}
	
	
?>