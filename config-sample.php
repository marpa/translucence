<?php
/*********************************************************
 * 
 * Configuration otions for Translucence theme
 * To create your own configuration options save this file
 * as config.php in this parent theme or in a child theme
 *
 *********************************************************/
$variation_config = array();

$variation_config['theme-url'] = "http://segueproject.org/wordpress/themes/";
$variation_config['theme-name'] = "2010 Translucence";

/******************************************************************************
 * Child Themes
 * specify the name of the parent theme
 ******************************************************************************/

//$variation_config['theme-parent'] = "2010-translucence";

/******************************************************************************
 * Default Variation
 * Specify which variation to use as the default
 * (see variations folder names for possible variations to include here)
 ******************************************************************************/

$variation_config['background'] = "translucence-gray-white";

/******************************************************************************
 * Default Variation Configuration
 * Specify what theme options to use as the default
 ******************************************************************************/

$variation_config['site-title-color'] = "#003366";
$variation_config['site-description-color'] = "#999999";
$variation_config['headermeta'] = "off";
$variation_config['options-mode'] = "basic";
$variation_config['revert'] = 1;

$variation_config['site-width'] = "950";

$variation_config['header-block-height'] = "100";
$variation_config['site-title-size'] = "30";
$variation_config['site-description-size'] = "14";
$variation_config['header-text-shadow-offset'] = "1px 1px";
$variation_config['header-text-shadow-blur'] = "2px";

$variation_config['entry-text-size'] = "14";
$variation_config['entry-line-height'] = "20";

$variation_config['footer-meta-left'] = "custom";
$variation_config['header-meta-left'] = "custom";
$variation_config['headerleftcustom'] = "";
$variation_config['footerleftcustom'] = "";

$variation_config['header-image-options'] = "none";

$variation_config['header-text-display'] = "middle";
$variation_config['entry-link-style'] = "ww";
$variation_config['entry-text-align'] = "left";
$variation_config['tag-links-color'] = "#FFF8C6";
$variation_config['cat-links-color'] = "#e9e9c9";

$variation_config['site-padding-top'] = "20";
$variation_config['site-padding-bottom'] = "20";

$variation_config['site-color'] = "#FFFFFF";
$variation_config['title-box-color'] = "#FFFFFF";
$variation_config['description-box-color'] = "#FFFFFF";
$variation_config['header-color'] = "#F9F9F9";
$variation_config['top-color'] = "#F9F9F9";
$variation_config['left01-color'] = "#F9F9F9";
$variation_config['content-color'] = "#FFFFFF";
$variation_config['right01-color'] = "#F9F9F9";
$variation_config['right02-color'] = "#F9F9F9";
$variation_config['bottom-color'] = "#F9F9F9";

$variation_config['site-opacity'] = "0";
$variation_config['title-box-opacity'] = ".0";
$variation_config['description-box-opacity'] = ".0";

$variation_config['header-opacity'] = ".6";
$variation_config['top-opacity'] = ".8";
$variation_config['left01-opacity'] = ".6";
$variation_config['content-opacity'] = "1";
$variation_config['right01-opacity'] = ".3";
$variation_config['right02-opacity'] = "0";
$variation_config['bottom-opacity'] = "0";

$variation_config['site-border-style'] = "none";
$variation_config['header-border-style'] = "dotted";
$variation_config['top-border-style'] = "solid";
$variation_config['content-border-style'] = "solid";
$variation_config['left01-border-style'] = "dotted";
$variation_config['right01-border-style'] = "dotted";
$variation_config['right02-border-style'] = "dotted";
$variation_config['bottom-border-style'] = "dotted";

$variation_config['header-width'] = $variation_config['site-width'];
$variation_config['left01-width'] = "0";
$variation_config['right01-width'] = "200";
$variation_config['right02-width'] = "0";

$variation_config['post-single-sidebar'] = "right01";
$variation_config['category-single-sidebar'] = "right01";
$variation_config['tag-single-sidebar'] = "right01";
$variation_config['author-single-sidebar'] = "right01";
$variation_config['search-single-sidebar'] = "right01";
$variation_config['archives-single-sidebar'] = "right01";

/******************************************************************************
 * Preset Widgets
 * Specify what widgets to include when Translucence is initially activated
 ******************************************************************************/

$variation_config['preset_widgets']['primary-widget-area'][] = "pages-2";
$variation_config['preset_widgets']['primary-widget-area'][] = "recent-posts-2";
$variation_config['preset_widgets']['primary-widget-area'][] = "categories-2";

$variation_config['preset_widgets']['secondary-widget-area'][] = "links-2";
$variation_config['preset_widgets']['secondary-widget-area'][] = "rss-links-2";


/******************************************************************************
 * Header meta left options
 * (this is the html content options for the upper left corner of the blog
 * Include "custom" if you want blog admins to be able to put whatever html they want
 ******************************************************************************/

$variation_config['header_meta_left_options']['blogs']['option_name'] = "blogs";
$variation_config['header_meta_left_options']['blogs']['option_label'] = "Blog Sign Up";
$variation_config['header_meta_left_options']['blogs']['option_value'] = "";

$variation_config['header_meta_left_options']['custom']['option_name'] = "custom";
$variation_config['header_meta_left_options']['custom']['option_label'] = "Custom";
$variation_config['header_meta_left_options']['custom']['option_value'] = "";


/******************************************************************************
 * Header meta right options
 * (this is the html content options for the upper right corner of the blog)
 ******************************************************************************/

$variation_config['header_meta_right_options']['option_name'] = "";
$variation_config['header_meta_right_options']['option_label'] = "";
$variation_config['header_meta_right_options']['option_value'] = "";

$variation_config['header_meta_right_options']['option_name'] = "show";
$variation_config['header_meta_right_options']['option_label'] = "Show";
$variation_config['header_meta_right_options']['option_value'] = "on";

$variation_config['header_meta_right_options']['option_name'] = "hide";
$variation_config['header_meta_right_options']['option_label'] = "Hide";
$variation_config['header_meta_right_options']['option_value'] = "off";
	

/******************************************************************************
 * Footer meta left options
 * (this is the html content options for the lower left corner of the blog
 * Include "custom" if you want blog admins to be able to put whatever html they want
 ******************************************************************************/

$variation_config['footer_meta_left_options']['custom']['option_name'] = "custom";
$variation_config['footer_meta_left_options']['custom']['option_label'] = "Custom";
$variation_config['footer_meta_left_options']['custom']['option_value'] = "";
	

/******************************************************************************
 * Custom headers
 ******************************************************************************/

$variation_config['custom_header']['none']['url'] = "%s/images/headers/transparent.png";
$variation_config['custom_header']['none']['thumbnail_url'] = "%s/images/headers/transparent-thumbnail.png";
$variation_config['custom_header']['none']['description'] = __( 'None', 'translucence' );

$variation_config['custom_header']['whitegradient']['url'] = "%s/images/headers/whitegradient-1200x200.png";
$variation_config['custom_header']['whitegradient']['thumbnail_url'] = "%s/images/headers/whitegradient-1200x200-thumbnail.png";
$variation_config['custom_header']['whitegradient']['description'] = __( 'White Gradient', 'translucence' );

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

// $variation_config['variations_disabled'][] = 'translucence-white';
// $variation_config['variations_disabled'][] = 'translucence-black';
// $variation_config['variations_disabled'][] = 'translucence-green';	
// $variation_config['variations_disabled'][] = 'translucence-yellow';
// $variation_config['variations_disabled'][] = 'translucence-yellow-white';
// $variation_config['variations_disabled'][] = 'translucence-white-yellow';
// $variation_config['variations_disabled'][] = 'translucence-gray';
// $variation_config['variations_disabled'][] = 'translucence-gray-white';
// $variation_config['variations_disabled'][] = 'translucence-white-gray';

