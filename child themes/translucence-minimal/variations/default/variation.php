<?php
/*
Theme Name: Translucence
Variation Name: Default
Variation ID: default
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 2.1
Author: Alex Chapin
Author URI: 

*/

// Theme name and url (Variations can override with their own name and url)
$translucence_options['theme-name'] = "2010 Translucence Dark";
$translucence_options['theme-url'] = "http://segueproject.org/wordpress/themes-dark";


$translucence_options['background_color'] = "#000000";
$translucence_options['background_image'] = "";
$translucence_options['background_position'] = "top center";
$translucence_options['background_repeat'] = "repeat-x";
$translucence_options['background_attachment'] = "scroll";

$translucence_options['background-source-url'] = "";
$translucence_options['background-source-credit'] = "";


$translucence_options['site-margin-top'] = "0";	
//$translucence_options['page-image-width'] = $translucence_options['site-width']-50;
$translucence_options['custom-header-width-offset'] = 7;

$translucence_options['header-text-padding-left'] = "10";
//$translucence_options['site-title-size'] = "30";

// define border widths
$translucence_options['content-border-width'] = "1px";

$translucence_options['header-outer-border-style'] = "none";
$translucence_options['header-border02-height'] = 0;

// define text shadow options for site-title and post-title
$translucence_options['header-text-shadow-color'] = "#444444";
//$translucence_options['header-text-shadow-offset'] = "1px 1px";
//$translucence_options['header-text-shadow-blur'] = "2px";
$translucence_options['post-text-shadow-color'] = "#CCCCCC";
$translucence_options['post-text-shadow-offset'] = "1px 1px";
$translucence_options['post-text-shadow-blur'] = "0.05em";

// define default link colors
if (isset($translucence_options['linkcolor'])) {
	$translucence_options['header-blogtitle-color'] = $translucence_options['linkcolor']; 
	$translucence_options['content-link-color'] = $translucence_options['linkcolor'];
	$translucence_options['top-link-color'] = $translucence_options['linkcolor'];
	$translucence_options['bottom-link-color'] = $translucence_options['linkcolor'];
	$translucence_options['left01-link-color'] = $translucence_options['linkcolor'];
	$translucence_options['right01-link-color'] = $translucence_options['linkcolor'];
	$translucence_options['right02-link-color'] = $translucence_options['linkcolor'];
	$translucence_options['transparent-heading-color'] = $translucence_options['linkcolor'];
	$translucence_options['transparent-link-color'] = $translucence_options['linkcolor'];
	$translucence_options['transparent-text-color'] = $translucence_options['linkcolor'];
} else {
	$translucence_options['header-blogtitle-color'] = "#003366";
	$translucence_options['content-link-color'] = "#003366";
	$translucence_options['top-link-color'] = "#003366";
	$translucence_options['bottom-link-color'] = "#003366";
	$translucence_options['left01-link-color'] = "#003366";
	$translucence_options['right01-link-color'] = "#003366";
	$translucence_options['right02-link-color'] = "#003366";
	$translucence_options['linkcolor'] = "#003366";
	$translucence_options['transparent-heading-color'] = "#003366";
	$translucence_options['transparent-link-color'] = "#003366";
	$translucence_options['transparent-text-color'] = "#003366";
}

// define default background link and text colors
$translucence_options['bgtextcolor'] = "#999999";
$translucence_options['bglinkcolor'] = "#666666";

// define default widget heading colors
$translucence_options['left01-heading-color'] = "#999999";
$translucence_options['right01-heading-color'] = "#999999";
$translucence_options['right02-heading-color'] = "#999999";

// define default tagline text color
if (isset($translucence_options['textcolor'])) {
	$translucence_options['header-blogdescription-color'] = $translucence_options['textcolor']; 
} else {
	$translucence_options['header-blogdescription-color'] = "#333333";
	$translucence_options['textcolor'] = "#333333";
}

/******************************************************************************
 * Define margins
 ******************************************************************************/

$translucence_options['header-meta-left-margin'] = "0px";
$translucence_options['header-meta-right-margin'] = "0px";
$translucence_options['footer-meta-left-margin'] = "10px";
$translucence_options['footer-meta-right-margin'] = "10px";

$translucence_options['left01-margin-right'] = "1";
$translucence_options['content-margin-right'] = "1";
$translucence_options['right01-margin-right'] = "1";
$translucence_options['right02-margin-right'] = "0";

$translucence_options['left01-margin-top'] = "5";
$translucence_options['content-margin-top'] = "0";
$translucence_options['right01-margin-top'] = "5";
$translucence_options['right02-margin-top'] = "10";


/******************************************************************************
 * Miscellaneous options
 ******************************************************************************/

$translucence_options['thread-even-bgcolor'] = "#FFFFFF";
$translucence_options['thread-alt-bgcolor'] = "#f8f8f8";
$translucence_options['commentfield'] = "#000000";
$translucence_options['searchbox-color'] = "#FFFFFF";


/******************************************************************************
 * Initialization
 * Set these only if not in the initial options array
 ******************************************************************************/

if (!isset($translucence_options['headermeta'])) $translucence_options['headermeta'] = "off";
if (!isset($translucence_options['options-mode'])) $translucence_options['options-mode'] = "basic";
if (!isset($translucence_options['revert'])) $translucence_options['revert'] = 1;

if (!isset($translucence_options['site-width'])) $translucence_options['site-width'] = "950";

if (!isset($translucence_options['header-block-height'])) $translucence_options['header-block-height'] = "100";
if (!isset($translucence_options['site-title-size'])) $translucence_options['site-title-size'] = "30";
if (!isset($translucence_options['site-title-color'])) $translucence_options['site-title-color'] = "#D9D323";
if (!isset($translucence_options['site-description-color'])) $translucence_options['site-description-color'] = "#F7F7F7";
if (!isset($translucence_options['site-description-size'])) $translucence_options['site-description-size'] = "14";
if (!isset($translucence_options['header-text-shadow-offset'])) $translucence_options['header-text-shadow-offset'] = "1px 1px";
if (!isset($translucence_options['header-text-shadow-blur'])) $translucence_options['header-text-shadow-blur'] = "2px";

if (!isset($translucence_options['entry-text-size'])) $translucence_options['entry-text-size'] = "14";
if (!isset($translucence_options['entry-text-size'])) $translucence_options['entry-line-height'] = "20";

if (!isset($translucence_options['footer-meta-left'])) $translucence_options['footer-meta-left'] = "custom";
if (!isset($translucence_options['header-meta-left'])) $translucence_options['header-meta-left'] = "custom";
if (!isset($translucence_options['headerleftcustom'])) $translucence_options['headerleftcustom'] = "";
if (!isset($translucence_options['footerleftcustom'])) $translucence_options['footerleftcustom'] = "";

if (!isset($translucence_options['header-image-options'])) $translucence_options['header-image-options'] = "none";

if (!isset($translucence_options['header-text-display'])) $translucence_options['header-text-display'] = "middle";
if (!isset($translucence_options['entry-link-style'])) $translucence_options['entry-link-style'] = "ww";
if (!isset($translucence_options['entry-text-align'])) $translucence_options['entry-text-align'] = "left";
if (!isset($translucence_options['tag-links-color'])) $translucence_options['tag-links-color'] = "#FFF8C6";
if (!isset($translucence_options['cat-links-color'])) $translucence_options['cat-links-color'] = "#e9e9c9";

if (!isset($translucence_options['site-padding-top'])) $translucence_options['site-padding-top'] = "20";
if (!isset($translucence_options['site-padding-bottom'])) $translucence_options['site-padding-bottom'] = "20";

if (!isset($translucence_options['site-color'])) $translucence_options['site-color'] = "#FFFFFF";
if (!isset($translucence_options['title-box-color'])) $translucence_options['title-box-color'] = "#FFFFFF";
if (!isset($translucence_options['description-box-color'])) $translucence_options['description-box-color'] = "#FFFFFF";
if (!isset($translucence_options['header-color'])) $translucence_options['header-color'] = "#F9F9F9";
if (!isset($translucence_options['top-color'])) $translucence_options['top-color'] = "#F9F9F9";
if (!isset($translucence_options['left01-color'])) $translucence_options['left01-color'] = "#F9F9F9";
if (!isset($translucence_options['content-color'])) $translucence_options['content-color'] = "#FFFFFF";
if (!isset($translucence_options['right01-color'])) $translucence_options['right01-color'] = "#F9F9F9";
if (!isset($translucence_options['right02-color'])) $translucence_options['right02-color'] = "#F9F9F9";
if (!isset($translucence_options['bottom-color'])) $translucence_options['bottom-color'] = "#F9F9F9";

if (!isset($translucence_options['site-opacity'])) $translucence_options['site-opacity'] = "0";
if (!isset($translucence_options['title-box-opacity'])) $translucence_options['title-box-opacity'] = ".3";
if (!isset($translucence_options['description-box-opacity'])) $translucence_options['description-box-opacity'] = ".2";

if (!isset($translucence_options['header-opacity'])) $translucence_options['header-opacity'] = ".6";
if (!isset($translucence_options['top-opacity'])) $translucence_options['top-opacity'] = ".8";
if (!isset($translucence_options['left01-opacity'])) $translucence_options['left01-opacity'] = ".6";
if (!isset($translucence_options['content-opacity'])) $translucence_options['content-opacity'] = "1";
if (!isset($translucence_options['right01-opacity'])) $translucence_options['right01-opacity'] = ".3";
if (!isset($translucence_options['right02-opacity'])) $translucence_options['right02-opacity'] = "0";
if (!isset($translucence_options['bottom-opacity'])) $translucence_options['bottom-opacity'] = "0";

if (!isset($translucence_options['site-border-style'])) $translucence_options['site-border-style'] = "none";
if (!isset($translucence_options['header-border-style'])) $translucence_options['header-border-style'] = "dotted";
if (!isset($translucence_options['top-border-style'])) $translucence_options['top-border-style'] = "solid";
if (!isset($translucence_options['content-border-style'])) $translucence_options['content-border-style'] = "solid";
if (!isset($translucence_options['left01-border-style'])) $translucence_options['left01-border-style'] = "dotted";
if (!isset($translucence_options['right01-border-style'])) $translucence_options['right01-border-style'] = "dotted";
if (!isset($translucence_options['right02-border-style'])) $translucence_options['right02-border-style'] = "dotted";
if (!isset($translucence_options['bottom-border-style'])) $translucence_options['bottom-border-style'] = "dotted";

if (!isset($translucence_options['header-width'])) $translucence_options['header-width'] = $translucence_options['site-width'];
if (!isset($translucence_options['left01-width'])) $translucence_options['left01-width'] = "0";
if (!isset($translucence_options['right01-width'])) $translucence_options['right01-width'] = "200";
if (!isset($translucence_options['right02-width'])) $translucence_options['right02-width'] = "0";

if (!isset($translucence_options['post-single-sidebar'])) $translucence_options['post-single-sidebar'] = "right01";
if (!isset($translucence_options['category-single-sidebar'])) $translucence_options['category-single-sidebar'] = "right01";
if (!isset($translucence_options['tag-single-sidebar'])) $translucence_options['tag-single-sidebar'] = "right01";
if (!isset($translucence_options['author-single-sidebar'])) $translucence_options['author-single-sidebar'] = "right01";
if (!isset($translucence_options['search-single-sidebar'])) $translucence_options['search-single-sidebar'] = "right01";
if (!isset($translucence_options['archives-single-sidebar'])) $translucence_options['archives-single-sidebar'] = "right01";


/*********************************************************
 * options value defaults
 * actual px values need to be adjusted for padding
 *********************************************************/	
$translucence_options_values['mode'] = array(
	'Basic' => 'basic',
	'Advanced' => 'advanced'
	);

$translucence_options_values['site-width'] = array(
	'1000px' => '1000',
	'950px' => '950',
	'900px' => '900',
	'850px' => '850',
	'800px' => '800',
	'750px' => '750'
	);

$translucence_options_values['header-width'] = array(
	'1000px' => '1000',
	'975px' => '975',
	'950px' => '950',
	'925px' => '925',
	'900px' => '900',
	'975px' => '975',
	'850px' => '850',
	'800px' => '800',
	'750px' => '750'
	);

$translucence_options_values['header-text-size'] = array(
	'14px' => '14',
	'15px' => '15',
	'16px' => '16',
	'17px' => '17',
	'18px' => '18',
	'19px' => '19',
	'20px' => '20',
	'25px' => '25',
	'30px' => '30',
	'35px' => '35',
	'40px' => '40',
	'50px' => '50',
	'60px' => '60',
	);

$translucence_options_values['header-text-offset'] = array(
	'5px' => '5px',
	'10px' => '10px',
	'15px' => '15px',
	'20px' => '20px',
	'25px' => '25px',
	'30px' => '30px',
	'35px' => '35px'
	);



$translucence_options_values['header-opacity'] = array(
	'100%' => '1',
	'90%' => '.9',
	'80%' => '.8',
	'70%' => '.7',
	'60%' => '.6',
	'50%' => '.5',
	'40%' => '.4',
	'30%'=> '.3',
	'20%'=> '.2',
	'0%'=> '0'
	);
	
$translucence_options_values['header-text-display'] = array(
	'Hide' => 'hide',
	'Top' => 'top',
	'Middle' => 'middle',
	'Bottom' => 'bottom'
	);

$translucence_options_values['text-shadow-offset'] = array(
	'0px' => '0px 0px',
	'1px' => '1px 1px',
	'2px' => '2px 2px',
	'3px' => '3px 3px',
	'4px' => '4px 4px',
	'5px' => '5px 5px'
	);

$translucence_options_values['text-shadow-blur'] = array(
	'0px' => '0px',
	'1px' => '1px',
	'2px' => '2px',
	'3px' => '3px',
	'4px' => '4px',
	'5px' => '5px',
	'10px' => '10px',
	'15px' => '15px',
	'20px' => '20px'
	);

	
$translucence_options_values['border-style'] = array(
	'No Border' => 'none',
	'Dotted Border' => 'dotted',
	'Solid Border' => 'solid'
	);

$translucence_options_values['content-border'] = array(
	'None' => 'none',
	'Solid' => 'solid',
	);


$translucence_options_values['background_repeat'] = array(
	'No Repeat' => 'no-repeat',
	'Repeat Horizontally' => 'repeat-y',
	'Repeat Vertically' => 'repeat-x',
	'Repeat Both' => 'repeat'
	);

$translucence_options_values['background_position'] = array(
	'Center Top' => 'center top',
	'Center Bottom' => 'center bottom'
	);


$translucence_options_values['sidebar-width'] = array(
	'175px' => '125',
	'200px' => '150',
	'225px' => '175',
	'250px' => '200',
	'275px' => '225',
	'350px' => '300',
	'400px' => '350',
	'hidden'	=> '0'
	);

$translucence_options_values['sidebar-opacity'] = array(
	'100%' => '1',
	'90%' => '.9',
	'80%' => '.8',
	'70%' => '.7',
	'60%' => '.6',
	'50%' => '.5',
	'40%' => '.4',
	'30%'=> '.3',
	'20%'=> '.2',
	'0%'=> '0'
	);

$translucence_options_values['header-color'] = array(
	'White' => '#FFFFFF',
	'Silver' => '#F9F9F9',
	'Gray' => '#F3F3F3',
	'Yellow' => '#FFF8C6',
	'Muted Yellow' => '#e9e9c9',
	'Green' 	=> '#4a6339',
	'Gray Blue'	=> '#364559',
	'Black' 	=> '#000000'
	);


$translucence_options_values['sidebar-color'] = array(
	'White' => '#FFFFFF',
	'Silver' => '#F9F9F9',
	'Gray' => '#F3F3F3',
	'Yellow' => '#FFF8C6',
	'Muted Yellow' => '#e9e9c9',
	'Green' 	=> '#4a6339',
	);


$translucence_options_values['header-block-height'] = array(
	'50px' => '50',
	'70px' => '70',
	'100px' => '100',
	'125px' => '125',
	'150px' => '150',
	'175px' => '175',
	'200px' => '200',
	'225px' => '225',
	'250px' => '250',
	'300px' => '300'
	);
	
$translucence_options_values['linkcolor'] = array(
	'Dark Blue' => '#003366',
	'Light Blue' => '#0066cc',
	'Red' => '#990000',
	'Green' => '#146C3A',
	'Black' => '#222222',
	'Gold'	=>	'#625B1D'
	);

$translucence_options_values['entry-text-align'] = array(
	'Justify' => 'justify',
	'Left' => 'left'
);
	
$translucence_options_values['entry-link-style'] = array(
	'No Underline' => 'none',
	'Underline' => 'underline',
	'Underline &amp; Highlight' => 'ww'
);

$translucence_options_values['textcolor'] = array(
	'20% Gray' => '#CCCCCC',
	'30% Gray' => '#888888',
	'40% Gray' => '#777777',
	'50% Gray' => '#666666',
	'60% Gray' => '#555555',
	'70% Gray' => '#444444',
	'80% Gray' => '#333333',
	'Black' => '#222222'
);

$translucence_options_values['text-size'] = array(
	'12px' => '12',
	'13px' => '13',
	'14px' => '14',
	'15px' => '15',
	'16px' => '16',
	'18px' => '18'
);


$translucence_options_values['category-link-style'] = array(
		'Left Sidebar Box' => 'left-sidebar-box',
		'Right Sidebar Box' => 'right-sidebar-box',
		'2nd Right Sidebar Box' => 'right02-sidebar-box',
		'Yellow Box' => 'yellow-box'
);

$translucence_options_values['tag-link-style'] = array(
		'Left Sidebar Box' => 'left-sidebar-box',
		'Right Sidebar Box' => 'right-sidebar-box',
		'2nd Right Sidebar Box' => 'right02-sidebar-box',
		'Yellow Box' => 'yellow-box'
);


$translucence_options_values['sidebar-display'] = array(
	'Left Sidebar' => 'left01',
	'1st Right Sidebar' => 'right01',
	'2nd Right Sidebar' => 'right02',
	'Both Right Sidebars' => 'right01right02',
	'Left &amp; 1st Right' => 'left01right01',
	'Left &amp; 2nd Right' => 'left01right02',
	'No Sidebars' => 'none',
);

?>