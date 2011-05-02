<?php
/*
Theme Name: Translucence
Variation Name: Dark Gray Translucence
Variation id: translucence-dark-gray
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/

if ($translucence_options['background'] == "translucence-dark-gray") {

	$translucence_options['background_image_file'] = "bg_topdark.png";
	$translucence_options['background_image_directory'] = "translucence-dark-gray";	
	$translucence_options['background_image'] = "url('".get_bloginfo("template_directory");
	$translucence_options['background_image'] .= "/variations/".$translucence_options['background_image_directory'];
	$translucence_options['background_image'] .= "/".$translucence_options['background_image_file']."')";
	$translucence_options['background_attachment'] = "fixed";
	
	$translucence_options['background_color'] = "#666666";

	$translucence_options['transparent-heading-color'] = "#CCCC99";
	$translucence_options['transparent-link-color']  = "#FFFFFF";
	$translucence_options['transparent-text-color']  = "#F2F2F2";
		
	$translucence_options['bgtextcolor'] = "#CCCCCC";
	$translucence_options['bglinkcolor'] = "#FFFFFF";
	$translucence_options['bgbordercolor'] = "#FFFFFF";
	
// 	$translucence_options['site-title-color'] = "#CCCC99";
// 	$translucence_options['site-description-color'] = "#FFFFFF";
			
	
 	$translucence_options['header-text-shadow-color'] = "#000000";
//	$translucence_options['header-text-shadow-offset'] = "1px 1px";
//	$translucence_options['header-text-shadow-blur'] = "2px";
// 	$translucence_options['post-text-shadow-color'] = "#333333";
	$translucence_options['post-text-shadow-offset'] = "0px 0px";
	$translucence_options['post-text-shadow-blur'] = "0px";
								
	$translucence_options['thread-even-bgcolor'] = "#333333";
	$translucence_options['thread-alt-bgcolor'] = "#000000";
	$translucence_options['commentfield'] = "#FFFFFF";
	
	$translucence_options['searchbox-color'] = "#262626";

	/******************************************************************************
	 * Default options for this variation
	 ******************************************************************************/
	
	if ($translucence_options['variation-type'] == "default") {	

		$translucence_options['header-text-shadow-offset'] = "1px 1px";
		$translucence_options['header-text-shadow-blur'] = "2px";
		
		$translucence_options['site-title-color'] = "#D9D323";
		$translucence_options['site-description-color'] = "#FFFFFF";
		
		$translucence_options['tag-links-color'] = "#262626";
		$translucence_options['cat-links-color'] = "#262626";
		
		$translucence_options['site-color'] = "#262626";
		$translucence_options['title-box-color'] = "#262626";
		$translucence_options['description-box-color'] = "#262626";
		
		$translucence_options['header-color'] = "#262626";
		$translucence_options['top-color'] = "#262626";
		$translucence_options['left01-color'] = "#262626";
		$translucence_options['content-color'] = "#262626";
		$translucence_options['right01-color'] = "#262626";
		$translucence_options['right02-color'] = "#262626";
		$translucence_options['bottom-color'] = "#262626";
		
		$translucence_options['site-opacity'] = "0";
		
		$translucence_options['header-opacity'] = ".6";
		$translucence_options['top-opacity'] = ".0";
		$translucence_options['left01-opacity'] = ".6";
		$translucence_options['content-opacity'] = ".9";
		$translucence_options['right01-opacity'] = ".3";
		$translucence_options['right02-opacity'] = "0";
		$translucence_options['bottom-opacity'] = ".3";
		
		$translucence_options['site-border-style'] = "none";
		$translucence_options['header-border-style'] = "dotted";
		$translucence_options['top-border-style'] = "none";
		$translucence_options['content-border-style'] = "solid";
		$translucence_options['left01-border-style'] = "dotted";
		$translucence_options['right01-border-style'] = "dotted";
		$translucence_options['right02-border-style'] = "none";
		$translucence_options['bottom-border-style'] = "dotted";
		
	}


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
	if (!in_array($translucence_options['linkcolor'], array_values($translucence_options_values['linkcolor']))) $translucence_options['linkcolor'] = "#FFFFCC";
	if (!in_array($translucence_options['textcolor'], array_values($translucence_options_values['textcolor']))) $translucence_options['textcolor'] = "#EEEEEE";
	if (!in_array($translucence_options['header-color'], array_values($translucence_options_values['header-color']))) $translucence_options['header-color'] = "#262626";
		
	if (!in_array($translucence_options['left01-link-color'], array_values($translucence_options_values['linkcolor']))) $translucence_options['left01-link-color'] = "#FFFFCC";
	if (!in_array($translucence_options['right01-link-color'], array_values($translucence_options_values['linkcolor']))) $translucence_options['right01-link-color'] = "#FFFFCC";
	if (!in_array($translucence_options['right02-link-color'], array_values($translucence_options_values['linkcolor']))) $translucence_options['right02-link-color'] = "#FFFFCC";
	
	if (!in_array($translucence_options['top-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['top-color'] = "#262626";
	if (!in_array($translucence_options['content-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['content-color'] = "#262626";
	if (!in_array($translucence_options['bottom-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['bottom-color'] = "#262626";
	if (!in_array($translucence_options['left01-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['left01-color'] = "#262626";
	if (!in_array($translucence_options['right01-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['right01-color'] = "#262626";
	if (!in_array($translucence_options['right02-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['right02-color'] = "#262626";
	
	if (!in_array($translucence_options['cat-links-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['cat-links-color'] = "#262626";
	if (!in_array($translucence_options['tag-links-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['tag-links-color'] = "#262626";

}	
	
?>