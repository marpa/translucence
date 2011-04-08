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
$options['theme-name'] = "2010 Translucence";
$options['theme-url'] = "http://segueproject.org/wordpress/themes/";

// set the default background variation 
// now done by translucence_get_variation_default_background() 
//if (!isset($options['background'])) $options['background'] = "translucence-gray-white";

$options['background_color'] = "#FFFFFF";
$options['background_image'] = "";
$options['background_position'] = "top center";
$options['background_repeat'] = "repeat-x";
$options['background_attachment'] = "scroll";

$options['background-source-url'] = "";
$options['background-source-credit'] = "";


$options['site-margin-top'] = "0";	
//$options['page-image-width'] = $options['site-width']-50;
$options['custom-header-width-offset'] = 7;

$options['header-text-padding-left'] = "10";
//$options['site-title-size'] = "30";

// define border widths
$options['content-border-width'] = "1px";

$options['header-outer-border-style'] = "none";
$options['header-border02-height'] = 0;

// define text shadow options for site-title and post-title
$options['header-text-shadow-color'] = "#444444";
//$options['header-text-shadow-offset'] = "1px 1px";
//$options['header-text-shadow-blur'] = "2px";
$options['post-text-shadow-color'] = "#CCCCCC";
$options['post-text-shadow-offset'] = "1px 1px";
$options['post-text-shadow-blur'] = "0.05em";

// define default link colors
if (isset($options['linkcolor'])) {
	$options['header-blogtitle-color'] = $options['linkcolor']; 
	$options['content-link-color'] = $options['linkcolor'];
	$options['top-link-color'] = $options['linkcolor'];
	$options['bottom-link-color'] = $options['linkcolor'];
	$options['left01-link-color'] = $options['linkcolor'];
	$options['right01-link-color'] = $options['linkcolor'];
	$options['right02-link-color'] = $options['linkcolor'];
	$options['transparent-heading-color'] = $options['linkcolor'];
	$options['transparent-link-color'] = $options['linkcolor'];
	$options['transparent-text-color'] = $options['linkcolor'];
} else {
	$options['header-blogtitle-color'] = "#003366";
	$options['content-link-color'] = "#003366";
	$options['top-link-color'] = "#003366";
	$options['bottom-link-color'] = "#003366";
	$options['left01-link-color'] = "#003366";
	$options['right01-link-color'] = "#003366";
	$options['right02-link-color'] = "#003366";
	$options['linkcolor'] = "#003366";
	$options['transparent-heading-color'] = "#003366";
	$options['transparent-link-color'] = "#003366";
	$options['transparent-text-color'] = "#003366";
}

// define default background link and text colors
$options['bgtextcolor'] = "#999999";
$options['bglinkcolor'] = "#666666";

// define default widget heading colors
$options['left01-heading-color'] = "#999999";
$options['right01-heading-color'] = "#999999";
$options['right02-heading-color'] = "#999999";

// define default tagline text color
if (isset($options['textcolor'])) {
	$options['header-blogdescription-color'] = $options['textcolor']; 
} else {
	$options['header-blogdescription-color'] = "#333333";
	$options['textcolor'] = "#333333";
}

/******************************************************************************
 * Define margins
 ******************************************************************************/

$options['header-meta-left-margin'] = "0px";
$options['header-meta-right-margin'] = "0px";
$options['footer-meta-left-margin'] = "10px";
$options['footer-meta-right-margin'] = "10px";

$options['left01-margin-right'] = "1";
$options['content-margin-right'] = "1";
$options['right01-margin-right'] = "1";
$options['right02-margin-right'] = "0";

$options['left01-margin-top'] = "5";
$options['content-margin-top'] = "0";
$options['right01-margin-top'] = "5";
$options['right02-margin-top'] = "10";


/******************************************************************************
 * Miscellaneous options
 ******************************************************************************/

$options['thread-even-bgcolor'] = "#FFFFFF";
$options['thread-alt-bgcolor'] = "#f8f8f8";
$options['commentfield'] = "#000000";
$options['searchbox-color'] = "#FFFFFF";



/*********************************************************
 * options value defaults
 * actual px values need to be adjusted for padding
 *********************************************************/	
$options_values['mode'] = array(
	'Basic' => 'basic',
	'Advanced' => 'advanced'
	);

$options_values['site-width'] = array(
	'1000px' => '1000',
	'950px' => '950',
	'900px' => '900',
	'850px' => '850',
	'800px' => '800',
	'750px' => '750'
	);

$options_values['header-width'] = array(
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

$options_values['header-text-size'] = array(
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

$options_values['header-text-offset'] = array(
	'5px' => '5px',
	'10px' => '10px',
	'15px' => '15px',
	'20px' => '20px',
	'25px' => '25px',
	'30px' => '30px',
	'35px' => '35px'
	);



$options_values['header-opacity'] = array(
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
	
$options_values['header-text-display'] = array(
	'Hide' => 'hide',
	'Top' => 'top',
	'Middle' => 'middle',
	'Bottom' => 'bottom'
	);

$options_values['text-shadow-offset'] = array(
	'0px' => '0px 0px',
	'1px' => '1px 1px',
	'2px' => '2px 2px',
	'3px' => '3px 3px',
	'4px' => '4px 4px',
	'5px' => '5px 5px'
	);

$options_values['text-shadow-blur'] = array(
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

	
$options_values['border-style'] = array(
	'No Border' => 'none',
	'Dotted Border' => 'dotted',
	'Solid Border' => 'solid'
	);

$options_values['content-border'] = array(
	'None' => 'none',
	'Solid' => 'solid',
	);


$options_values['background_repeat'] = array(
	'No Repeat' => 'no-repeat',
	'Repeat Horizontally' => 'repeat-y',
	'Repeat Vertically' => 'repeat-x',
	'Repeat Both' => 'repeat'
	);

$options_values['background_position'] = array(
	'Center Top' => 'center top',
	'Center Bottom' => 'center bottom'
	);


$options_values['sidebar-width'] = array(
	'175px' => '125',
	'200px' => '150',
	'225px' => '175',
	'250px' => '200',
	'275px' => '225',
	'350px' => '300',
	'400px' => '350',
	'hidden'	=> '0'
	);

$options_values['sidebar-opacity'] = array(
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

$options_values['header-color'] = array(
	'White' => '#FFFFFF',
	'Silver' => '#F9F9F9',
	'Gray' => '#F3F3F3',
	'Yellow' => '#FFF8C6',
	'Muted Yellow' => '#e9e9c9',
	'Green' 	=> '#4a6339',
	'Gray Blue'	=> '#364559',
	'Black' 	=> '#000000'
	);


$options_values['sidebar-color'] = array(
	'White' => '#FFFFFF',
	'Silver' => '#F9F9F9',
	'Gray' => '#F3F3F3',
	'Yellow' => '#FFF8C6',
	'Muted Yellow' => '#e9e9c9',
	'Green' 	=> '#4a6339',
	);


$options_values['header-block-height'] = array(
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
	
$options_values['linkcolor'] = array(
	'Dark Blue' => '#003366',
	'Light Blue' => '#0066cc',
	'Red' => '#990000',
	'Green' => '#146C3A',
	'Black' => '#222222',
	'Gold'	=>	'#625B1D'
	);

$options_values['entry-text-align'] = array(
	'Justify' => 'justify',
	'Left' => 'left'
);
	
$options_values['entry-link-style'] = array(
	'No Underline' => 'none',
	'Underline' => 'underline',
	'Underline &amp; Highlight' => 'ww'
);

$options_values['textcolor'] = array(
	'20% Gray' => '#CCCCCC',
	'30% Gray' => '#888888',
	'40% Gray' => '#777777',
	'50% Gray' => '#666666',
	'60% Gray' => '#555555',
	'70% Gray' => '#444444',
	'80% Gray' => '#333333',
	'Black' => '#222222'
);

$options_values['text-size'] = array(
	'12px' => '12',
	'13px' => '13',
	'14px' => '14',
	'15px' => '15',
	'16px' => '16',
	'18px' => '18'
);


$options_values['category-link-style'] = array(
		'Left Sidebar Box' => 'left-sidebar-box',
		'Right Sidebar Box' => 'right-sidebar-box',
		'2nd Right Sidebar Box' => 'right02-sidebar-box',
		'Yellow Box' => 'yellow-box'
);

$options_values['tag-link-style'] = array(
		'Left Sidebar Box' => 'left-sidebar-box',
		'Right Sidebar Box' => 'right-sidebar-box',
		'2nd Right Sidebar Box' => 'right02-sidebar-box',
		'Yellow Box' => 'yellow-box'
);


$options_values['sidebar-display'] = array(
	'Left Sidebar' => 'left01',
	'1st Right Sidebar' => 'right01',
	'2nd Right Sidebar' => 'right02',
	'Both Right Sidebars' => 'right01right02',
	'Left &amp; 1st Right' => 'left01right01',
	'Left &amp; 2nd Right' => 'left01right02',
	'No Sidebars' => 'none',
);

?>