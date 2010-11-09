<?php
/*********************************************************
 * 
 * Configuration otions for Translucence theme
 * To create your own configuration options save this file
 * as config.php
 *
 *********************************************************/
$variation_config = array();

$variation_config['theme-url'] = "http://segueproject.org/wordpress/themes/";
$variation_config['theme-name'] = "2010 Translucence";

/******************************************************************************
 * Header meta left options
 * (this is the html content options for the upper left corner of the blog
 * Include "custom" if you want blog admins to be able to put whatever html they want
 ******************************************************************************/

$variation_config['header_meta_left_options']['blogs'] = array (
		'option_name' =>	'blogs',
		'option_label' =>	'Blog Sign Up',
		'option_value' => ''
	);
	
$variation_config['header_meta_left_options']['custom'] = array (
		'option_name' =>	'custom',
		'option_label' =>	'Custom',
		'option_value' => ''
	);

/******************************************************************************
 * Header meta right options
 * (this is the html content options for the upper right corner of the blog)
 ******************************************************************************/

$variation_config['header_meta_right_options'] = array (
		'option_name' =>	'',
		'option_label' =>	'',
		'option_value' => ''
	);

$variation_config['header_meta_right_options'] = array (
		'option_name' =>	'show',
		'option_label' =>	'Show',
		'option_value' => "on"
	);

$variation_config['header_meta_right_options'] = array (
		'option_name' =>	'hide',
		'option_label' =>	'Hide',
		'option_value' => "off"
	);

	
/******************************************************************************
 * Header Image Options
 * (put all header images in images directory
 ******************************************************************************/
$variation_config['header_image_options']['transparent'] = array (
		'option_name' =>	'transparent',
		'option_label' =>	'None',
		'option_value' => 'header-transparent.png'
	);


$variation_config['header_image_options']['custom'] = array (
		'option_name' =>	'custom',
		'option_label' =>	'Custom',
		'option_value' => 'header-trans-white-1200x100.png'
	);


/******************************************************************************
 * Footer meta left options
 * (this is the html content options for the lower left corner of the blog
 * Include "custom" if you want blog admins to be able to put whatever html they want
 ******************************************************************************/
	
$variation_config['footer_meta_left_options']['custom'] = array (
		'option_name' =>	'custom',
		'option_label' =>	'Custom',
		'option_value' => ''
	);
	
/******************************************************************************
 * Preset Widgets:
 * specify widgets to include when theme is 1st activated
 * sidebar-1 = left sidebar
 * sidebar-2 = right sidebar
 * sidebar-3 = 2nd right sidebar 
 ******************************************************************************/

// Update the sidebars with those widgets



/******************************************************************************
 * Miscellaneous Config
 * When set to "on" always shows log in link in upper right corner
 ******************************************************************************/
//$variation_config['headermeta'] = "off";

/******************************************************************************
 * Custom headers
 ******************************************************************************/

$variation_config['custom_header'] = array(
		'none' => array(
			'url' => '%s/images/headers/trans-1200x300.png',
			'thumbnail_url' => '%s/images/headers/trans-1200x300-thumbnail.png',
			/* translators: header image description */
			'description' => __( 'None', 'twentyten' )
		),
		'whitegradient' => array(
			'url' => '%s/images/headers/whitegradient-1200x200.png',
			'thumbnail_url' => '%s/images/headers/whitegradient-1200x200-thumbnail.png',
			/* translators: header image description */
			'description' => __( 'White Gradient', 'twentyten' )
		),
		'lines' => array(
			'url' => '%s/images/headers/header-lines-1500x100',
			'thumbnail_url' => '%s/images/headers/header-lines-1500x100-thumbnail.png',
			/* translators: header image description */
			'description' => __( 'Lines', 'twentyten' )
		)

);


/******************************************************************************
 * Model UI Options
 * This is a list of all the theme options that will be displayed in the 
 * theme options UI
 ******************************************************************************/

$variation_config['model'][]  = 'site-width';
$variation_config['model'][]  = 'background_image_url';
$variation_config['model'][]  = 'background_color';
$variation_config['model'][]  = 'background_repeat';
$variation_config['model'][]  = 'background_position';
$variation_config['model'][]  = 'bglinkcolor';
$variation_config['model'][]  = 'bgtextcolor';
$variation_config['model'][]  = 'header-width';
$variation_config['model'][]  = 'headerleftcustom';
$variation_config['model'][]  = 'header-meta-left';
$variation_config['model'][]  = 'header-image-options';
$variation_config['model'][]  = 'headermeta';
$variation_config['model'][]  = 'header-text-display';
$variation_config['model'][]  = 'header-block-height';
$variation_config['model'][]  = 'topbar-bg-color';
$variation_config['model'][]  = 'bottombar-bg-color';
$variation_config['model'][]  = 'background';
$variation_config['model'][]  = 'headercolor';
$variation_config['model'][]  = 'textcolor';
$variation_config['model'][]  = 'linkcolor';
$variation_config['model'][]  = 'entry-link-style';
$variation_config['model'][]  = 'cat-links-color';
$variation_config['model'][]  = 'tag-links-color';
$variation_config['model'][]  = 'left01-width';
$variation_config['model'][]  = 'right01-width';
$variation_config['model'][]  = 'right02-width';
$variation_config['model'][]  = 'top-color';
$variation_config['model'][]  = 'bottom-color';
$variation_config['model'][]  = 'content-color';
$variation_config['model'][]  = 'content-opacity';
$variation_config['model'][]  = 'header-color';
$variation_config['model'][]  = 'header-opacity';
$variation_config['model'][]  = 'left01-color';
$variation_config['model'][]  = 'right01-color';
$variation_config['model'][]  = 'right02-color';
$variation_config['model'][]  = 'top-opacity';
$variation_config['model'][]  = 'bottom-opacity';
$variation_config['model'][]  = 'left01-opacity';
$variation_config['model'][]  = 'right01-opacity';
$variation_config['model'][]  = 'right02-opacity';
$variation_config['model'][]  = 'post-single-sidebar';
$variation_config['model'][]  = 'footer-meta-left';
$variation_config['model'][]  = 'footerleftcustom';
$variation_config['model'][]  = 'model-instructions';
$variation_config['model'][]  = 'custom_background_color';
$variation_config['model'][]  = 'custom_background_repeat';
$variation_config['model'][]  = 'custom_background_position';
$variation_config['model'][]  = 'custom_bgtextcolor';
$variation_config['model'][]  = 'custom_bglinkcolor';
$variation_config['model'][]  = 'custom_header_color';
$variation_config['model'][]  = 'custom_background-source-url';
$variation_config['model'][]  = 'custom_background-source-credit';
$variation_config['model'][]  = 'revert';
$variation_config['model'][]  = 'header-blogtitle-size';
$variation_config['model'][]  = 'header-border-style';
$variation_config['model'][]  = 'top-border-style';
$variation_config['model'][]  = 'content-border-style';
$variation_config['model'][]  = 'left01-border-style';
$variation_config['model'][]  = 'right01-border-style';
$variation_config['model'][]  = 'right02-border-style';
$variation_config['model'][]  = 'bottom-border-style';
$variation_config['model'][]  = 'category-single-sidebar';
$variation_config['model'][]  = 'tag-single-sidebar';
$variation_config['model'][]  = 'author-single-sidebar';
$variation_config['model'][]  = 'search-single-sidebar';
$variation_config['model'][]  = 'archives-single-sidebar';
$variation_config['model'][]  = 'entry-text-align';
$variation_config['model'][]  = 'header-text-shadow-offset';
$variation_config['model'][]  = 'header-text-shadow-blur';
$variation_config['model'][]  = 'header-text-shadow-color';
$variation_config['model'][]  = 'colophon-border-type';
$variation_config['model'][]  = 'background_attachment';
$variation_config['model'][]  = 'footer-widget-width';
$variation_config['model'][]  = 'site-title-size';
$variation_config['model'][]  = 'site-title-color';
$variation_config['model'][]  = 'site-color';
$variation_config['model'][]  = 'site-opacity';
$variation_config['model'][]  = 'site-border-style';
$variation_config['model'][]  = 'site-border-top';
$variation_config['model'][]  = 'site-border-bottom';
$variation_config['model'][]  = 'site-border-left';
$variation_config['model'][]  = 'site-border-right';
$variation_config['model'][]  = 'site-padding-top';
$variation_config['model'][]  = 'site-padding-bottom';
$variation_config['model'][]  = 'header-text-shadow-offset';
$variation_config['model'][]  = 'header-text-shadow-blur';
$variation_config['model'][]  = 'site-description-color';
$variation_config['model'][]  = 'site-description-size';

//  primary options not exposed in theme model
$variation_config['model'][]  = 'left01-margin-right';
$variation_config['model'][]  = 'right01-margin-right';
$variation_config['model'][]  = 'right02-margin-right';
$variation_config['model'][]  = 'content-margin-right';

$variation_config['model'][]  = 'left01-margin-top';
$variation_config['model'][]  = 'right01-margin-top';
$variation_config['model'][]  = 'right02-margin-top';
$variation_config['model'][]  = 'content-margin-top';

// more primary options
$variation_config['model'][]  = 'entry-text-size';
$variation_config['model'][]  = 'entry-line-height';
$variation_config['model'][]  = 'title-box-color';
$variation_config['model'][]  = 'title-box-opacity';

$variation_config['model'][]  = 'description-box-color';
$variation_config['model'][]  = 'description-box-opacity';
$variation_config['model'][]  = 'options-mode';
$variation_config['model'][]  = 'theme-name';
$variation_config['model'][]  = 'theme-url';



/******************************************************************************
 * Disabled Variations 
 * Variation names should match name of variation folder
 * Comment out all variations that are NOT disabled
 ******************************************************************************/

$variation_config['variations_disabled'] = array();

// $variation_config['variations_disabled'][] = 'custom';
// $variation_config['variations_disabled'][] = 'translucence-white';
// $variation_config['variations_disabled'][] = 'translucence-black';
// $variation_config['variations_disabled'][] = 'translucence-blue';
// $variation_config['variations_disabled'][] = 'translucence-green';	
// $variation_config['variations_disabled'][] = 'translucence-yellow';
// $variation_config['variations_disabled'][] = 'translucence-yellow-white';
// $variation_config['variations_disabled'][] = 'translucence-white-yellow';
// $variation_config['variations_disabled'][] = 'translucence-gray';
// $variation_config['variations_disabled'][] = 'translucence-gray-white';
// $variation_config['variations_disabled'][] = 'translucence-white-gray';
// $variation_config['variations_disabled'][] = 'translucence-classics';
// $variation_config['variations_disabled'][] = 'translucence-middscape';
// $variation_config['variations_disabled'][] = 'translucence-middscape-blue';
