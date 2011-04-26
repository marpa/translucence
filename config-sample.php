<?php
/*********************************************************
 * 
 * Configuration otions for Translucence theme
 * To create your own configuration options save this file
 * as config.php in this parent theme or in a child theme
 *
 *********************************************************/
$translucence_config = array();

$translucence_config['theme-url'] = "http://segueproject.org/wordpress/themes/";
$translucence_config['theme-name'] = "2010 Translucence";

/******************************************************************************
 * Child Themes
 * specify the name of the parent theme
 ******************************************************************************/

//$translucence_config['theme-parent'] = "2010-translucence";

/******************************************************************************
 * Default Variation
 * Specify which variation to use as the default
 * (see variations folder names for possible variations to include here)
 ******************************************************************************/

$translucence_config['background'] = "translucence-gray-white";

/******************************************************************************
 * Default Variation Configuration
 * Specify what theme options to use as the default
 ******************************************************************************/

$translucence_config['site-title-color'] = "#003366";
$translucence_config['site-description-color'] = "#999999";
$translucence_config['headermeta'] = "off";
$translucence_config['options-mode'] = "basic";
$translucence_config['revert'] = 1;

$translucence_config['site-width'] = "950";

$translucence_config['header-block-height'] = "100";
$translucence_config['site-title-size'] = "30";
$translucence_config['site-description-size'] = "14";
$translucence_config['header-text-shadow-offset'] = "1px 1px";
$translucence_config['header-text-shadow-blur'] = "2px";

$translucence_config['entry-text-size'] = "14";
$translucence_config['entry-line-height'] = "20";

$translucence_config['footer-meta-left'] = "custom";
$translucence_config['header-meta-left'] = "custom";
$translucence_config['headerleftcustom'] = "";
$translucence_config['footerleftcustom'] = "";

$translucence_config['header-image-options'] = "none";

$translucence_config['header-text-display'] = "middle";
$translucence_config['entry-link-style'] = "ww";
$translucence_config['entry-text-align'] = "left";
$translucence_config['tag-links-color'] = "#FFF8C6";
$translucence_config['cat-links-color'] = "#e9e9c9";

$translucence_config['site-padding-top'] = "20";
$translucence_config['site-padding-bottom'] = "20";

$translucence_config['site-color'] = "#FFFFFF";
$translucence_config['title-box-color'] = "#FFFFFF";
$translucence_config['description-box-color'] = "#FFFFFF";
$translucence_config['header-color'] = "#F9F9F9";
$translucence_config['top-color'] = "#F9F9F9";
$translucence_config['left01-color'] = "#F9F9F9";
$translucence_config['content-color'] = "#FFFFFF";
$translucence_config['right01-color'] = "#F9F9F9";
$translucence_config['right02-color'] = "#F9F9F9";
$translucence_config['bottom-color'] = "#F9F9F9";

$translucence_config['site-opacity'] = "0";
$translucence_config['title-box-opacity'] = ".0";
$translucence_config['description-box-opacity'] = ".0";

$translucence_config['header-opacity'] = ".6";
$translucence_config['top-opacity'] = ".8";
$translucence_config['left01-opacity'] = ".6";
$translucence_config['content-opacity'] = "1";
$translucence_config['right01-opacity'] = ".3";
$translucence_config['right02-opacity'] = "0";
$translucence_config['bottom-opacity'] = "0";

$translucence_config['site-border-style'] = "none";
$translucence_config['header-border-style'] = "dotted";
$translucence_config['top-border-style'] = "none";
$translucence_config['content-border-style'] = "solid";
$translucence_config['left01-border-style'] = "dotted";
$translucence_config['right01-border-style'] = "dotted";
$translucence_config['right02-border-style'] = "dotted";
$translucence_config['bottom-border-style'] = "dotted";

$translucence_config['header-width'] = $translucence_config['site-width'];
$translucence_config['left01-width'] = "0";
$translucence_config['right01-width'] = "200";
$translucence_config['right02-width'] = "0";

$translucence_config['post-single-sidebar'] = "right01";
$translucence_config['category-single-sidebar'] = "right01";
$translucence_config['tag-single-sidebar'] = "right01";
$translucence_config['author-single-sidebar'] = "right01";
$translucence_config['search-single-sidebar'] = "right01";
$translucence_config['archives-single-sidebar'] = "right01";

/******************************************************************************
 * Preset Widgets
 * Specify what widgets to include when Translucence is initially activated
 ******************************************************************************/

$translucence_config['preset_widgets']['primary-widget-area'][] = "pages-2";
$translucence_config['preset_widgets']['primary-widget-area'][] = "recent-posts-2";
$translucence_config['preset_widgets']['primary-widget-area'][] = "categories-2";

$translucence_config['preset_widgets']['secondary-widget-area'][] = "links-2";
$translucence_config['preset_widgets']['secondary-widget-area'][] = "rss-links-2";


/******************************************************************************
 * Header meta left options
 * (this is the html content options for the upper left corner of the blog
 * Include "custom" if you want blog admins to be able to put whatever html they want
 ******************************************************************************/

$translucence_config['header_meta_left_options']['blogs']['option_name'] = "blogs";
$translucence_config['header_meta_left_options']['blogs']['option_label'] = "Blog Sign Up";
$translucence_config['header_meta_left_options']['blogs']['option_value'] = "<a href='".get_bloginfo('url')."/wp-signup.php' title='View your Blogs'>WordPress</a>";

$translucence_config['header_meta_left_options']['custom']['option_name'] = "custom";
$translucence_config['header_meta_left_options']['custom']['option_label'] = "Custom";
$translucence_config['header_meta_left_options']['custom']['option_value'] = "";


/******************************************************************************
 * Header meta right options
 * (this is the html content options for the upper right corner of the blog)
 ******************************************************************************/

$translucence_config['header_meta_right_options']['option_name'] = "";
$translucence_config['header_meta_right_options']['option_label'] = "";
$translucence_config['header_meta_right_options']['option_value'] = "";

$translucence_config['header_meta_right_options']['option_name'] = "show";
$translucence_config['header_meta_right_options']['option_label'] = "Show";
$translucence_config['header_meta_right_options']['option_value'] = "on";

$translucence_config['header_meta_right_options']['option_name'] = "hide";
$translucence_config['header_meta_right_options']['option_label'] = "Hide";
$translucence_config['header_meta_right_options']['option_value'] = "off";
	

/******************************************************************************
 * Footer meta left options
 * (this is the html content options for the lower left corner of the blog
 * Include "custom" if you want blog admins to be able to put whatever html they want
 ******************************************************************************/

$translucence_config['footer_meta_left_options']['custom']['option_name'] = "custom";
$translucence_config['footer_meta_left_options']['custom']['option_label'] = "Custom";
$translucence_config['footer_meta_left_options']['custom']['option_value'] = "";
	

/******************************************************************************
 * Custom headers
 ******************************************************************************/

$translucence_config['custom_header']['none']['url'] = "%s/images/headers/transparent.png";
$translucence_config['custom_header']['none']['thumbnail_url'] = "%s/images/headers/transparent-thumbnail.png";
$translucence_config['custom_header']['none']['description'] = __( 'None', '2010-translucence' );

$translucence_config['custom_header']['whitegradient']['url'] = "%s/images/headers/whitegradient-1200x200.png";
$translucence_config['custom_header']['whitegradient']['thumbnail_url'] = "%s/images/headers/whitegradient-1200x200-thumbnail.png";
$translucence_config['custom_header']['whitegradient']['description'] = __( 'White Gradient', '2010-translucence' );

/******************************************************************************
 * Model UI Options
 * This is a list of all the theme options that will be displayed in the 
 * theme options UI
 ******************************************************************************/

$translucence_config['model'][]  = 'site-width';
$translucence_config['model'][]  = 'background_image_url';
$translucence_config['model'][]  = 'background_color';
$translucence_config['model'][]  = 'background_repeat';
$translucence_config['model'][]  = 'background_position';
$translucence_config['model'][]  = 'bglinkcolor';
$translucence_config['model'][]  = 'bgtextcolor';
$translucence_config['model'][]  = 'header-width';
$translucence_config['model'][]  = 'headerleftcustom';
$translucence_config['model'][]  = 'header-meta-left';
$translucence_config['model'][]  = 'header-image-options';
$translucence_config['model'][]  = 'headermeta';
$translucence_config['model'][]  = 'header-text-display';
$translucence_config['model'][]  = 'header-block-height';
$translucence_config['model'][]  = 'topbar-bg-color';
$translucence_config['model'][]  = 'bottombar-bg-color';
$translucence_config['model'][]  = 'background';
$translucence_config['model'][]  = 'headercolor';
$translucence_config['model'][]  = 'textcolor';
$translucence_config['model'][]  = 'linkcolor';
$translucence_config['model'][]  = 'entry-link-style';
$translucence_config['model'][]  = 'cat-links-color';
$translucence_config['model'][]  = 'tag-links-color';
$translucence_config['model'][]  = 'left01-width';
$translucence_config['model'][]  = 'right01-width';
$translucence_config['model'][]  = 'right02-width';
$translucence_config['model'][]  = 'top-color';
$translucence_config['model'][]  = 'bottom-color';
$translucence_config['model'][]  = 'content-color';
$translucence_config['model'][]  = 'content-opacity';
$translucence_config['model'][]  = 'header-color';
$translucence_config['model'][]  = 'header-opacity';
$translucence_config['model'][]  = 'left01-color';
$translucence_config['model'][]  = 'right01-color';
$translucence_config['model'][]  = 'right02-color';
$translucence_config['model'][]  = 'top-opacity';
$translucence_config['model'][]  = 'bottom-opacity';
$translucence_config['model'][]  = 'left01-opacity';
$translucence_config['model'][]  = 'right01-opacity';
$translucence_config['model'][]  = 'right02-opacity';
$translucence_config['model'][]  = 'post-single-sidebar';
$translucence_config['model'][]  = 'footer-meta-left';
$translucence_config['model'][]  = 'footerleftcustom';
$translucence_config['model'][]  = 'model-instructions';
$translucence_config['model'][]  = 'revert';
$translucence_config['model'][]  = 'header-blogtitle-size';
$translucence_config['model'][]  = 'header-border-style';
$translucence_config['model'][]  = 'top-border-style';
$translucence_config['model'][]  = 'content-border-style';
$translucence_config['model'][]  = 'left01-border-style';
$translucence_config['model'][]  = 'right01-border-style';
$translucence_config['model'][]  = 'right02-border-style';
$translucence_config['model'][]  = 'bottom-border-style';
$translucence_config['model'][]  = 'category-single-sidebar';
$translucence_config['model'][]  = 'tag-single-sidebar';
$translucence_config['model'][]  = 'author-single-sidebar';
$translucence_config['model'][]  = 'search-single-sidebar';
$translucence_config['model'][]  = 'archives-single-sidebar';
$translucence_config['model'][]  = 'entry-text-align';
$translucence_config['model'][]  = 'header-text-shadow-offset';
$translucence_config['model'][]  = 'header-text-shadow-blur';
$translucence_config['model'][]  = 'header-text-shadow-color';
$translucence_config['model'][]  = 'colophon-border-type';
$translucence_config['model'][]  = 'background_attachment';
$translucence_config['model'][]  = 'footer-widget-width';
$translucence_config['model'][]  = 'site-title-size';
$translucence_config['model'][]  = 'site-title-color';
$translucence_config['model'][]  = 'site-color';
$translucence_config['model'][]  = 'site-opacity';
$translucence_config['model'][]  = 'site-border-style';
$translucence_config['model'][]  = 'site-border-top';
$translucence_config['model'][]  = 'site-border-bottom';
$translucence_config['model'][]  = 'site-border-left';
$translucence_config['model'][]  = 'site-border-right';
$translucence_config['model'][]  = 'site-padding-top';
$translucence_config['model'][]  = 'site-padding-bottom';
$translucence_config['model'][]  = 'header-text-shadow-offset';
$translucence_config['model'][]  = 'header-text-shadow-blur';
$translucence_config['model'][]  = 'site-description-color';
$translucence_config['model'][]  = 'site-description-size';

//  primary options not exposed in theme model
$translucence_config['model'][]  = 'left01-margin-right';
$translucence_config['model'][]  = 'right01-margin-right';
$translucence_config['model'][]  = 'right02-margin-right';
$translucence_config['model'][]  = 'content-margin-right';

$translucence_config['model'][]  = 'left01-margin-top';
$translucence_config['model'][]  = 'right01-margin-top';
$translucence_config['model'][]  = 'right02-margin-top';
$translucence_config['model'][]  = 'content-margin-top';

// more primary options
$translucence_config['model'][]  = 'entry-text-size';
$translucence_config['model'][]  = 'entry-line-height';
$translucence_config['model'][]  = 'title-box-color';
$translucence_config['model'][]  = 'title-box-opacity';

$translucence_config['model'][]  = 'description-box-color';
$translucence_config['model'][]  = 'description-box-opacity';
$translucence_config['model'][]  = 'options-mode';
$translucence_config['model'][]  = 'theme-name';
$translucence_config['model'][]  = 'theme-url';



/******************************************************************************
 * Disabled Variations 
 * Variation names should match name of variation folder
 * Comment out all variations that are NOT disabled
 ******************************************************************************/

$translucence_config['variations_disabled'] = array();

// $translucence_config['variations_disabled'][] = 'translucence-white';
// $translucence_config['variations_disabled'][] = 'translucence-black';
// $translucence_config['variations_disabled'][] = 'translucence-green';	
// $translucence_config['variations_disabled'][] = 'translucence-yellow';
// $translucence_config['variations_disabled'][] = 'translucence-yellow-white';
// $translucence_config['variations_disabled'][] = 'translucence-white-yellow';
// $translucence_config['variations_disabled'][] = 'translucence-gray';
// $translucence_config['variations_disabled'][] = 'translucence-gray-white';
// $translucence_config['variations_disabled'][] = 'translucence-white-gray';

