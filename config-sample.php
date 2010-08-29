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

$preset_widgets = array (
	 'primary-widget-area' => array(
			'search-2',		
			'recent-posts-2',
			'recent-comments-2',
		),
		'secondary-widget-area' => array(
			'categories-2',
			'tag_cloud-2',
		),
		'wp_inactive_widgets' => array(),
	);


/******************************************************************************
 * Miscellaneous Config
 * When set to "on" always shows log in link in upper right corner
 ******************************************************************************/
//$variation_config['headermeta'] = "off";


/******************************************************************************
 * Model UI Options
 * This is a list of all the theme options that will be displayed in the 
 * theme options UI
 ******************************************************************************/

$variation_config['model'][1]  = 'site-width';
$variation_config['model'][2]  = 'background_image_url';
$variation_config['model'][3]  = 'background_color';
$variation_config['model'][4]  = 'background_repeat';
$variation_config['model'][5]  = 'background_position';
$variation_config['model'][6]  = 'bglinkcolor';
$variation_config['model'][7]  = 'bgtextcolor';
$variation_config['model'][8]  = 'header-width';
$variation_config['model'][9]  = 'headerleftcustom';
$variation_config['model'][10]  = 'header-meta-left';
$variation_config['model'][11]  = 'header-image-options';
$variation_config['model'][12]  = 'headermeta';
$variation_config['model'][13]  = 'header-text-display';
$variation_config['model'][14]  = 'header-block-height';
$variation_config['model'][15]  = 'topbar-bg-color';
$variation_config['model'][16]  = 'bottombar-bg-color';
$variation_config['model'][17]  = 'background';
$variation_config['model'][18]  = 'headercolor';
$variation_config['model'][19]  = 'textcolor';
$variation_config['model'][20]  = 'linkcolor';
$variation_config['model'][21]  = 'entry-link-style';
$variation_config['model'][22]  = 'tag-link-style';
$variation_config['model'][23]  = 'category-link-style';
$variation_config['model'][24]  = 'left01-width';
$variation_config['model'][25]  = 'right01-width';
$variation_config['model'][26]  = 'right02-width';
$variation_config['model'][27]  = 'top-color';
$variation_config['model'][28]  = 'bottom-color';
$variation_config['model'][29]  = 'content-color';
$variation_config['model'][30]  = 'content-opacity';
$variation_config['model'][31]  = 'header-color';
$variation_config['model'][32]  = 'header-opacity';
$variation_config['model'][33]  = 'left01-color';
$variation_config['model'][34]  = 'right01-color';
$variation_config['model'][35]  = 'right02-color';
$variation_config['model'][36]  = 'top-opacity';
$variation_config['model'][37]  = 'bottom-opacity';
$variation_config['model'][38]  = 'left01-opacity';
$variation_config['model'][39]  = 'right01-opacity';
$variation_config['model'][40]  = 'right02-opacity';
$variation_config['model'][41]  = 'post-single-sidebar';
$variation_config['model'][42]  = 'footer-meta-left';
$variation_config['model'][43]  = 'footerleftcustom';
$variation_config['model'][44]  = 'model-instructions';
$variation_config['model'][45]  = 'custom_background_color';
$variation_config['model'][46]  = 'custom_background_repeat';
$variation_config['model'][47]  = 'custom_background_position';
$variation_config['model'][48]  = 'custom_bgtextcolor';
$variation_config['model'][49]  = 'custom_bglinkcolor';
$variation_config['model'][50]  = 'custom_header_color';
$variation_config['model'][51]  = 'custom_background-source-url';
$variation_config['model'][52]  = 'custom_background-source-credit';
$variation_config['model'][53]  = 'revert';
$variation_config['model'][54]  = 'header-blogtitle-size';
$variation_config['model'][55]  = 'header-border-style';
$variation_config['model'][56]  = 'top-border-style';
$variation_config['model'][57]  = 'content-border-style';
$variation_config['model'][58]  = 'left01-border-style';
$variation_config['model'][59]  = 'right01-border-style';
$variation_config['model'][60]  = 'right02-border-style';
$variation_config['model'][61]  = 'bottom-border-style';
$variation_config['model'][62]  = 'category-single-sidebar';
$variation_config['model'][63]  = 'tag-single-sidebar';
$variation_config['model'][64]  = 'author-single-sidebar';
$variation_config['model'][65]  = 'search-single-sidebar';
$variation_config['model'][66]  = 'archives-single-sidebar';
$variation_config['model'][67]  = 'entry-text-align';
$variation_config['model'][68]  = 'header-text-shadow-offset';
$variation_config['model'][69]  = 'header-text-shadow-blur';
$variation_config['model'][70]  = 'header-text-shadow-color';
$variation_config['model'][71]  = 'colophon-border-type';
$variation_config['model'][72]  = 'background_attachment';
$variation_config['model'][73]  = 'footer-widget-width';
$variation_config['model'][74]  = 'site-title-size';
$variation_config['model'][75]  = 'site-title-color';
$variation_config['model'][76]  = 'site-color';
$variation_config['model'][77]  = 'site-opacity';
$variation_config['model'][78]  = 'site-border-style';
$variation_config['model'][79]  = 'site-border-top';
$variation_config['model'][80]  = 'site-border-bottom';
$variation_config['model'][81]  = 'site-border-left';
$variation_config['model'][82]  = 'site-border-right';
$variation_config['model'][83]  = 'site-padding-top';
$variation_config['model'][84]  = 'site-padding-bottom';
$variation_config['model'][85]  = 'header-text-shadow-offset';
$variation_config['model'][86]  = 'header-text-shadow-blur';
$variation_config['model'][87]  = 'site-description-color';
$variation_config['model'][88]  = 'site-description-size';

//  primary options not exposed in theme model
$variation_config['model'][89]  = 'left01-margin-right';
$variation_config['model'][90]  = 'right01-margin-right';
$variation_config['model'][91]  = 'right02-margin-right';
$variation_config['model'][92]  = 'content-margin-right';

$variation_config['model'][93]  = 'left01-margin-top';
$variation_config['model'][94]  = 'right01-margin-top';
$variation_config['model'][95]  = 'right02-margin-top';
$variation_config['model'][96]  = 'content-margin-top';

$variation_config['model'][97]  = 'category-link-border';
$variation_config['model'][98]  = 'tag-link-border';


/******************************************************************************
 * Disabled Variations 
 * Variation names should match name of variation folder
 * Comment out all variations that are NOT disabled
 ******************************************************************************/

$variation_config['variations_disabled'] = array();

// $variation_config['variations_disabled'][0] = 'custom';
// $variation_config['variations_disabled'][11] = 'translucence-white';
// $variation_config['variations_disabled'][12] = 'translucence-black';
// $variation_config['variations_disabled'][13] = 'translucence-blue';
// $variation_config['variations_disabled'][14] = 'translucence-green';	
// $variation_config['variations_disabled'][15] = 'translucence-yellow';
// $variation_config['variations_disabled'][16] = 'translucence-yellow-white';
// $variation_config['variations_disabled'][17] = 'translucence-white-yellow';
// $variation_config['variations_disabled'][18] = 'translucence-gray';
// $variation_config['variations_disabled'][19] = 'translucence-gray-white';
// $variation_config['variations_disabled'][20] = 'translucence-white-gray';
// $variation_config['variations_disabled'][22] = 'translucence-classics';
// $variation_config['variations_disabled'][23] = 'translucence-middscape';
// $variation_config['variations_disabled'][24] = 'translucence-middscape-blue';
