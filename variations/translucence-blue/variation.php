<?php
/*
Theme Name: Translucence
Variation Name: Blue Translucence
Variation id: translucence-blue
Description: Easy to use highly flexible theme with translucence_options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-translucence_options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/

if ($translucence_options['background'] == "translucence-blue") {

	$translucence_options['background_image_file'] = "bg-blue01.png";
	$translucence_options['background_image_directory'] = "translucence-blue";
	$translucence_options['background_image'] = "url('".get_bloginfo("template_directory");
	$translucence_options['background_image'] .= "/variations/".$translucence_options['background_image_directory'];
	$translucence_options['background_image'] .= "/".$translucence_options['background_image_file']."')";
	$translucence_options['background_repeat'] = "no-repeat";
	$translucence_options['background_position'] = "center top";
	// 	$translucence_options['background-source-url'] = "";
 	$translucence_options['background-source-credit'] = "";
	
	
	$translucence_options['background_color'] = "#051E3C";
	$translucence_options['bgtextcolor'] = "#CCCCCC";
	$translucence_options['bglinkcolor'] = "#FFFFFF";
	$translucence_options['bgbordercolor'] = "#000000";
	
	$translucence_options['transparent-blogtitle-color'] = "#CCCC99"; 
	$translucence_options['transparent-blogdescription-color'] = "#FFFFFF"; 
	$translucence_options['transparent-heading-color'] = "#CCCC99";
	$translucence_options['transparent-link-color']  = "#FFFFFF";
	$translucence_options['transparent-text-color']  = "#FFFFFF";
	
	$translucence_options['left01-heading-color'] = "#354253";
	$translucence_options['right01-heading-color'] = "#354253";
	$translucence_options['right02-heading-color'] = "#354253";
	
	if ($translucence_options['variation-type'] == "default") {	

		$translucence_options['header-text-shadow-offset'] = "0px 0px";
		$translucence_options['header-text-shadow-blur'] = "0px";
		
		$translucence_options['site-title-color'] = "#fff";
		$translucence_options['site-description-color'] = "#CC9";
		
		$translucence_options['tag-links-color'] = "#FFF8C6";
		$translucence_options['cat-links-color'] = "#CC9";
		
		$translucence_options['site-color'] = "#FFFFFF";
		$translucence_options['title-box-color'] = "#364559";
		$translucence_options['description-box-color'] = "#364559";
		
		$translucence_options['header-color'] = "#364559";
		$translucence_options['top-color'] = "#364559";
		$translucence_options['left01-color'] = "#364559";
		$translucence_options['content-color'] = "#FFFFFF";
		$translucence_options['right01-color'] = "#364559";
		$translucence_options['right02-color'] = "#364559";
		$translucence_options['bottom-color'] = "#364559";
		
		$translucence_options['site-opacity'] = "0";
		$translucence_options['title-box-opacity'] = ".0";
		$translucence_options['description-box-opacity'] = ".0";
		
		$translucence_options['header-opacity'] = ".0";
		$translucence_options['top-opacity'] = ".0";
		$translucence_options['left01-opacity'] = ".3";
		$translucence_options['content-opacity'] = "1";
		$translucence_options['right01-opacity'] = ".3";
		$translucence_options['right02-opacity'] = "0";
		$translucence_options['bottom-opacity'] = ".3";
		
		$translucence_options['site-border-style'] = "none";
		$translucence_options['header-border-style'] = "none";
		$translucence_options['top-border-style'] = "none";
		$translucence_options['content-border-style'] = "solid";
		$translucence_options['left01-border-style'] = "dotted";
		$translucence_options['right01-border-style'] = "dotted";
		$translucence_options['right02-border-style'] = "dotted";
		$translucence_options['bottom-border-style'] = "dotted";
		
	}

}	
	
?>