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
$translucence_config['activated-theme'] = "0";
$translucence_config['activated-widgets'] = "default";
$translucence_config['widgets'] = "default";
$translucence_config['added-content'] = "default";
$translucence_config['content'] = "default";
$translucence_config['variation-type'] = "default";
$translucence_config['headermeta'] = "off";

$translucence_config['site-title-color'] = "#003366";
$translucence_config['site-description-color'] = "#999999";
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
$translucence_config['header-meta-right'] = "custom";
$translucence_config['headerleftcustom'] = "";
$translucence_config['footerleftcustom'] = "";

$translucence_config['header-image-options'] = "none";

$translucence_config['header-text-display'] = "middle";
$translucence_config['header-text-padding-top'] = 0;
$translucence_config['entry-link-style'] = "ww";
$translucence_config['entry-text-align'] = "left";
$translucence_config['tag-links-color'] = "#FFF8C6";
$translucence_config['cat-links-color'] = "#e9e9c9";

$translucence_config['site-padding-top'] = 20;
$translucence_config['site-padding-bottom'] = 20;
$translucence_config['content-padding'] = 20;

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

$translucence_config['content-margin-left'] = 0;
$translucence_config['content-margin-right'] = 0;
$translucence_config['left01-margin-left'] = 0;
$translucence_config['left01-margin-right'] = 1;
$translucence_config['right01-margin-left'] = 1;
$translucence_config['right01-margin-right'] = 0;
$translucence_config['right02-margin-left'] = 1;
$translucence_config['right02-margin-right'] = 0;

$translucence_config['header-width'] = $translucence_config['site-width'];
$translucence_config['left01-width'] = 0;
$translucence_config['right01-width'] = 200;
$translucence_config['right02-width'] = 0;

$translucence_config['post-single-sidebar'] = "right01";
$translucence_config['category-single-sidebar'] = "right01";
$translucence_config['tag-single-sidebar'] = "right01";
$translucence_config['author-single-sidebar'] = "right01";
$translucence_config['search-single-sidebar'] = "right01";
$translucence_config['archives-single-sidebar'] = "right01";

$translucence_config['default-post-display'] = "title-full";
$translucence_config['page-links-display'] = "true";

/******************************************************************************
 * Preset Widgets
 * Specify what widgets to include when Translucence is initially activated
 * or when a widget set is loaded
 * possible values are: 
 *
 * pages-2&title=&sortby=&exclude=
 * page sortby can be: post_date, post_modified, menu_order, 
 * recent-posts-2&title=&number=5
 * recent-comments-2&title=&number=5
 * links-2&title=&category= 
 * archives-2&title=&dropdown=0&count=1 
 * categories-2&title=&hierarchical=1&dropdown=1&count=1
 * tagcloud-2&title=&taxonomy=post_tags or tagcloud-2&title=&taxonomy=category
 * text-2&title=Text&text=&filter=
 * calendar-2&title=
 *
 ******************************************************************************/
// these are widgets that are preset when the site is created.
// NOTE: these widgets do NOT appear in Appearance > Widget and disappear
// when widgets are manually added
$translucence_config['preset_widgets']['default']['primary-widget-area'][] = "pages-2&title=&sortby=menu_order&exclude=";
$translucence_config['preset_widgets']['default']['primary-widget-area'][] = "recent-posts-2&title=&number=5";
$translucence_config['preset_widgets']['default']['primary-widget-area'][] = "recent-comments-2&title=&number=5";
$translucence_config['preset_widgets']['default']['primary-widget-area'][] = "links-2&title=&category=";
$translucence_config['preset_widgets']['default']['primary-widget-area'][] = "archives-2&title=&dropdown=1&count=1";

// these widgets do appear in the Appearance > Widget and can be selected by users in Appearance > Theme Options
// When these widget sets are selected, they replace all existing widgets
// NOTE: widgets that have been customized (i.e. RSS widget) will be moved to inactive widgets
$translucence_config['preset_widgets']['projects']['description'][] = 
"includes widgets for pages, recent posts, recent comments, categories, calendar, tag cloud.
";

$translucence_config['preset_widgets']['projects']['primary-widget-area'][] = "pages-2&title=&sortby=post_modified&exclude=";
$translucence_config['preset_widgets']['projects']['primary-widget-area'][] = "recent-posts-2&title=&number=5";
$translucence_config['preset_widgets']['projects']['primary-widget-area'][] = "recent-comments-2&title=&number=5";
$translucence_config['preset_widgets']['projects']['primary-widget-area'][] = "categories-2&title=&hierarchical=1&dropdown=1&count=1";
$translucence_config['preset_widgets']['projects']['secondary-widget-area'][] = "calendar-2&title=";
$translucence_config['preset_widgets']['projects']['secondary-widget-area'][] = "tag_cloud-2&title=&taxonomy=post_tags";

$translucence_config['preset_widgets']['courses']['description'][] = 
"includes widgets for course information, announcements and assignments.";
$translucence_config['preset_widgets']['courses']['primary-widget-area'][] = "pages-2&title=Course Information&sortby=post_date&exclude=";
$translucence_config['preset_widgets']['courses']['primary-widget-area'][] = "recent-posts-2&title=Announcements&number=5";
$translucence_config['preset_widgets']['courses']['primary-widget-area'][] = "categories-2&title=Assignments&hierarchical=1&dropdown=0&count=1";
$translucence_config['preset_widgets']['courses']['secondary-widget-area'][] = "calendar-2&title=Test Calendar";

$translucence_config['preset_widgets']['blogs']['description'][] = 
"includes widgets for recent posts, recent comments, categories and tags";
$translucence_config['preset_widgets']['blogs']['primary-widget-area'][] = "recent-posts-2&title=&number=5";
$translucence_config['preset_widgets']['blogs']['primary-widget-area'][] = "recent-comments-2&title=&number=5";
$translucence_config['preset_widgets']['blogs']['primary-widget-area'][] = "categories-2&title=&hierarchical=1&dropdown=0&count=1";
$translucence_config['preset_widgets']['blogs']['primary-widget-area'][] = "tag_cloud-2&title=&taxonomy=post_tags";
$translucence_config['preset_widgets']['blogs']['first-footer-widget-area'][] = "links-2&title=&category=";
$translucence_config['preset_widgets']['blogs']['second-footer-widget-area'][] = "links-2&title=&category=";
$translucence_config['preset_widgets']['blogs']['third-footer-widget-area'][] = "links-2&title=&category=";

/******************************************************************************
 * Preset Content
 * Specify what content to include when Translucence is initially activated
 * or when a content set is loaded
 * possible values are: 
 *
 * post_title= post_content= post_status= post_date= post_author=
 * post_type= post_category tags_input= post_parent=
 *
 * term= description= slug= parent=
 *
 ******************************************************************************/
 // this is content that are preset when the site is created.
// NOTE: this content can be edited or deleted in posts, pages, categories or post tages

//first specify categories
$translucence_config['preset_content']['default']['category'][] = 
"term=Test Category&description=This is a test category&slug=test-category&parent=";

//then specify parent posts
$translucence_config['preset_content']['default']['post'][] = 
"post_title=Parent Page&post_content=This is a parent page&post_status=publish&post_date=&post_author=&post_type=page&post_category=&post_parent=";

//then specify child posts (requires looking up post ID of parent..
 $translucence_config['preset_content']['default']['post'][] = 
 "post_title=Child Page&post_content=This is a child page&post_status=publish&post_date=&post_author=&post_type=page&post_category=&post_parent=Parent Page";

// Course Content Set - posts, pages, categories and tags useful for teaching, learning and research
// description of content set
$translucence_config['preset_content']['course']['description'][] = 
"pages for course information and pages, posts and categories for assignments. 
";

//first specify categories, tags
$translucence_config['preset_content']['course']['category'][] = 
"term=Assignments&description=This is an assignment category&slug=assignments&parent=";
$translucence_config['preset_content']['course']['category'][] = 
"term=Assignment 01&description=This is an assignment category&slug=assignments&parent=";
$translucence_config['preset_content']['course']['category'][] = 
"term=Assignment 01&description=This is an assignment category&slug=assignments&parent=";


$translucence_config['preset_content']['course']['tag'][] = 
"term=cool&description=This a cool tag&slug=cool&parent=";

//first specify parent posts
$post_content = "This page should contain general information about the course.";
$translucence_config['preset_content']['course']['post'][] = 
"post_type=page&post_title=01 Overview&post_content=".$post_content."&post_status=publish&post_date=&post_author=&post_category=&post_parent=";

$post_content = "This page describes the assignments for this class.";
$translucence_config['preset_content']['course']['post'][] = 
"post_type=page&post_title=02 Assignments&post_content=".$post_content."&post_status=publish&post_date=&post_author=&post_category=&post_parent=";


//then specify child posts (requires looking up post ID of parent..
 $post_content = "This page describes the requirements for this class.";
 $translucence_config['preset_content']['course']['post'][] = 
 "post_type=page&post_title=Requirements&post_content=".$post_content."&post_status=publish&post_parent=01 Overview";

 $post_content = "This page describes the readings for this class.";
 $translucence_config['preset_content']['course']['post'][] = 
 "post_type=page&post_title=Readings&post_content=".$post_content."&post_status=publish&post_parent=01 Overview";


 $post_content = "This page describes the 1st assignment for this class.";
 $translucence_config['preset_content']['course']['post'][] = 
 "post_type=page&post_title=Assignment 01&post_content=".$post_content."&post_status=publish&post_parent=02 Assignments";

 $post_content = "This page describes the 2nd assignment for this class.";
 $translucence_config['preset_content']['course']['post'][] = 
 "post_type=page&post_title=Assignment 02&post_content=".$post_content."&post_status=publish&post_parent=02 Assignments";

 $post_content = "This is a sample assignment submission post that has been assigned the category of assignment 01";
 $translucence_config['preset_content']['course']['post'][] = 
 "post_type=post&post_title=Assignment Post&post_content=".$post_content."&post_status=publish&post_date=&post_author=&post_category=Assignment 01&post_parent=";

 

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

$translucence_config['header_meta_right_options']['blogs']['option_name'] = "blogs";
$translucence_config['header_meta_right_options']['blogs']['option_label'] = "Blog Sign Up";
$translucence_config['header_meta_right_options']['blogs']['option_value'] = "<a href='".get_bloginfo('url')."/wp-signup.php' title='View your Blogs'>WordPress</a>";

$translucence_config['header_meta_right_options']['custom']['option_name'] = "custom";
$translucence_config['header_meta_right_options']['custom']['option_label'] = "Custom";
$translucence_config['header_meta_right_options']['custom']['option_value'] = "";

	

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

$translucence_config['custom_header']['none']['url'] = get_template_directory_uri()."/images/headers/transparent.png";
$translucence_config['custom_header']['none']['thumbnail_url'] = get_template_directory_uri()."/images/headers/transparent-thumbnail.png";
$translucence_config['custom_header']['none']['description'] = __( 'None', '2010-translucence' );

$translucence_config['custom_header']['whitegradient']['url'] = get_template_directory_uri()."/images/headers/whitegradient-1200x200.png";
$translucence_config['custom_header']['whitegradient']['thumbnail_url'] = get_template_directory_uri()."/images/headers/whitegradient-1200x200-thumbnail.png";
$translucence_config['custom_header']['whitegradient']['description'] = __( 'White Gradient', '2010-translucence' );

/******************************************************************************
 * Model UI Options
 * This is a list of all the theme options that will be displayed in the 
 * theme options UI
 * comment out any options you don't what to include in the theme options UI
 * see: theme-options.php
 ******************************************************************************/
$translucence_config['model'][]  = 'activated-theme';
$translucence_config['model'][]  = 'widgets';
$translucence_config['model'][]  = 'activated-widgets';
$translucence_config['model'][]  = 'content';
$translucence_config['model'][]  = 'added-content';
$translucence_config['model'][]  = 'variation-type';

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
$translucence_config['model'][]  = 'headerrightcustom';
$translucence_config['model'][]  = 'header-meta-right';
$translucence_config['model'][]  = 'header-image-options';
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
$translucence_config['model'][]  = 'default-post-display';
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

$translucence_config['model'][]  = 'page-links-display';

//  primary options not exposed in theme model
$translucence_config['model'][]  = 'left01-margin-left';
$translucence_config['model'][]  = 'left01-margin-right';
$translucence_config['model'][]  = 'right01-margin-left';
$translucence_config['model'][]  = 'right01-margin-right';
$translucence_config['model'][]  = 'right02-margin-left';
$translucence_config['model'][]  = 'right02-margin-right';
$translucence_config['model'][]  = 'content-margin-left';
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
// $translucence_config['variations_disabled'][] = 'translucence-dark-gray';
// $translucence_config['variations_disabled'][] = 'translucence-green';	
// $translucence_config['variations_disabled'][] = 'translucence-yellow';
// $translucence_config['variations_disabled'][] = 'translucence-yellow-white';
// $translucence_config['variations_disabled'][] = 'translucence-white-yellow';
// $translucence_config['variations_disabled'][] = 'translucence-gray';
// $translucence_config['variations_disabled'][] = 'translucence-gray-white';
// $translucence_config['variations_disabled'][] = 'translucence-white-gray';

