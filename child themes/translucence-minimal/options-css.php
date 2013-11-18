<?php 

/*********************************************************
 * Translucence Child options css
 * embeds theme options in css used in Parent template files
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since 2010 Translucence 1.0
 *********************************************************/

if ( ! function_exists( 'translucence_options_css' ) ) :

/*********************************************************
 * Translucence options css
 * embeds theme options in css
 *********************************************************/

function translucence_options_css() {
	global $translucence_options, $translucence_config;
	global $translucence_options_id;

	$site_width = $translucence_options['site-width'];
	$header_width = $translucence_options['site-width'] - ($translucence_options['header-border-width'] * 2);
	$menu_width =$translucence_options['site-width'] - ($translucence_options['menu-border-width'] * 2);
	
	// add # to theme option for site-title and description
	if (!preg_match("/\#/", $translucence_options['site-title-color'])) {
		$translucence_options['site-title-color'] = "#".$translucence_options['site-title-color'];
	}

	if (!preg_match("/\#/", $translucence_options['site-description-color'])) {
		$translucence_options['site-description-color'] = "#".$translucence_options['site-description-color'];
	}

	// calculate the width of the content div based on widths of sidebars
	// sidebar width = sidebar width + 50
	// if sidebar width = 0 then width = 0
	$left01_width = 0;
	if ($translucence_options['left01-width'] != 0) {
		$left01_width = $translucence_options['left01-width'] + 50;
	}

	$right01_width = 0;
	if ($translucence_options['right01-width'] != 0) {
		$right01_width = $translucence_options['right01-width'] + 50;
	}

	$right02_width = 0;
	if ($translucence_options['right02-width'] != 0) {
		$right02_width = $translucence_options['right02-width'] + 50;
	}
			
	$content_width = $translucence_options['site-width'] - ($left01_width + $right01_width + $right02_width + 70);
	$total = ($translucence_options['left01-width'] + $translucence_options['right01-width'] + $translucence_options['right02-width']+$content_width);

	ob_start();
	
	/******************************************************************************
	 * CSS definitions for all classes in this theme that have been modified by theme options
	 * See: template-options.php for this theme's html
	 ******************************************************************************/

?>

/* =css translucence theme options update
* add all of this css to the style.css of the Translucence child theme
* NOTE: change background-image url from absolute to relative
-------------------------------------------------------------- */

/* The main theme structure */	

body {
	font-family:'Helvetica Neue',Arial,Helvetica,sans-serif;
	color: <?php print $translucence_options['textcolor']?>;
	background-color: <?php print $translucence_options['background_color']?>;
	background-image: <?php print $translucence_options['background_image']?>;
	background-repeat: <?php print $translucence_options['background_repeat']?>;
	background-position: <?php print $translucence_options['background_position']?>;
	background-attachment: <?php print $translucence_options['background_attachment']?>;
	margin-top: 10px;
}

#access .menu-header,
div.menu,
#branding,
#main,
#wrapper {
	margin: 0 auto;
	width: <?php print $site_width?>px;
}

#wrapper {
	background-color: <?php print $translucence_options['site-color-rgb']?>;
	
	box-shadow: 0px 0px <?php print $translucence_options['site-border-shadow'] ?>px rgba(0,0,0,0.2);
	-moz-box-shadow: 0px 0px <?php print $translucence_options['site-border-shadow'] ?>px rgba(0,0,0,0.2);
	-webkit-box-shadow: 0px 0px <?php print $translucence_options['site-border-shadow'] ?>px rgba(0,0,0,0.2);
	
	border-top: 1px <?php print $translucence_options['site-border-style'] ?> <?php print $translucence_options['site-border-top']?>;
	border-bottom: 1px <?php print $translucence_options['site-border-style'] ?> <?php print $translucence_options['site-border-bottom']?>;
	border-left: 1px <?php print $translucence_options['site-border-style'] ?> <?php print $translucence_options['site-border-left']?>;
	border-right: 1px <?php print $translucence_options['site-border-style'] ?> <?php print $translucence_options['site-border-right']?>;
	margin-top: 1px;
	margin-bottom: 10px;
	padding: <?php print $translucence_options['site-padding-top'] ?>px <?php print $translucence_options['site-padding-bottom'] ?>px;
}

.sitewrapper {
	width: <?php print $site_width?>px;
	margin-left: auto;
	margin-right: auto;
	margin-top: <?php print $translucence_options['site-margin-top']?>px;
}


/* The theme meta areas */

.headermeta_left {
	font-size: 12px;
	width: 50%;	
	text-align: left;
	margin-left: <?php print $translucence_options['header-meta-left-margin']?>;
}

.headermeta_right {
	font-size: 12px;
	width: 45%;
	text-align: right;
	float: right;
	clear: left;
	margin-right: <?php print $translucence_options['header-meta-right-margin']?>;
}

.footermeta_left {
	font-size: 12px;
	width: 50%;	
	text-align: left;
	margin-left: <?php print $translucence_options['footer-meta-left-margin']?>;
	padding-top: 5px;
	padding-bottom: 10px;
}

.footermeta_right {
	font-size: 12px;
	width: 40%;
	text-align: right;
	float: right;
	margin-right: <?php print $translucence_options['footer-meta-right-margin']?>;
	padding-top: 5px;
	padding-bottom: 10px;
}			

/* The theme header area */

#header {
	padding: 0 0 0 0px;
}
	
#branding {
	margin: 0 auto;
	width: <?php print $site_width?>px;		
}

.headerblock {
	color: <?php print $translucence_options['header-text-color']?>;
	background-color: <?php print $translucence_options['header-color-rgb']?>;
	border-top: 1px <?php print $translucence_options['header-hover-border-style']?> #FFFFFF;
	border-bottom: 1px <?php print $translucence_options['header-border-style']?> <?php print $translucence_options['header-border-bottom']?>;
	padding-top: 0px;
	width: <?php print $header_width?>px;
	height: <?php print $translucence_options['header-block-height']?>px;
}

.headerblock:hover {
	background-color: <?php print $translucence_options['header-color-hover-rgb']?>;
	border-top: 1px <?php print $translucence_options['header-hover-border-style']?> <?php print $translucence_options['header-border-top']?>;
	border-bottom: 1px <?php print $translucence_options['header-border-style']?> <?php print $translucence_options['header-border-bottom']?>;
}


.title-box {
	margin-top: <?php print $translucence_options['header-text-padding-top']?>px;
	margin-left: 10px;
}

#site-title {
	margin-bottom: 5px;
}

#site-title a {
	display: <?php print $translucence_options['show-header-text']?>;
	background: <?php print $translucence_options['title-box-color-rgb']?>;
	color: <?php print $translucence_options['site-title-color']?>;
	font-size: <?php print $translucence_options['site-title-size']?>px;
	line-height: <?php print $translucence_options['site-title-size']?>px;
	padding: 3px 3px 3px 3px;
	text-shadow: <?php print $translucence_options['header-text-shadow-color']?> <?php print $translucence_options['header-text-shadow-offset']?> <?php print $translucence_options['header-text-shadow-blur']?>;
}

#ie-site-title a {
	margin-top: -10px;
	margin-bottom: -10px;
}

#ie8-site-title a {
	background: <?php print $translucence_options['title-box-color'] ?>;
}

#site-title a:hover {
	display: <?php print $translucence_options['show-header-text']?>;
	color: <?php print $translucence_options['site-title-color']?>;
	border-bottom: none;
}

#site-description {
	display: <?php print $translucence_options['show-header-text']?>;
	color: <?php print $translucence_options['site-description-color']?>;
	background-color: <?php print $translucence_options['description-box-color-rgb']?>;
	font-size: <?php print $translucence_options['site-description-size']?>px;
	margin-left: 5px;
}

#ie8-site-description {
	background: <?php print $translucence_options['description-box-color'] ?>;
}

/* Misc full width area settings */

#footer {
	clear: both;
	width: <?php print $site_width?>px;
}

/* Full width content with no sidebar; used for attachment pages */
.single-attachment #content {
	margin: 0 auto;
	width: 95%;
}

/* =Content and Container
-------------------------------------------------------------- */	

#container {
	overflow: hidden;
	margin: 0 0px 0 0;
	padding: 0px 0px 0px 0px;
	width: 100%;			
}

#content {
	float: left;
	margin-top: <?php print $translucence_options['content-margin-top']?>px;
	margin-right: <?php print $translucence_options['content-margin-right']?>px;
	margin-left: <?php print $translucence_options['content-margin-left']?>px;
	
	width: <?php print $content_width?>px;
	color: <?php print $translucence_options['textcolor']?>;
	background-color: <?php print $translucence_options['content-color-rgb']?>;
	padding: 20px;
	border-top: <?php print $translucence_options['content-border-width'] ?> <?php print $translucence_options['content-border-style'] ?> <?php print $translucence_options['content-border-top']?>;
	border-bottom: <?php print $translucence_options['content-border-width'] ?> <?php print $translucence_options['content-border-style'] ?> <?php print $translucence_options['content-border-bottom']?>;
	border-left: <?php print $translucence_options['content-border-width'] ?> <?php print $translucence_options['content-border-style'] ?> <?php print $translucence_options['content-border-left']?>;
	border-right: <?php print $translucence_options['content-border-width'] ?> <?php print $translucence_options['content-border-style'] ?> <?php print $translucence_options['content-border-right']?>;
	
	font-size: <?php print $translucence_options['entry-text-size']?>px;
	line-height: <?php print $translucence_options['entry-line-height']?>px;
}



/* =Widget Areas (primary, secondary, tertiary, footer-widget-area)
-------------------------------------------------------------- */	

#tertiary {
	float: left;
	margin-top: <?php print $translucence_options['left01-margin-top']?>px;
	margin-right: <?php print $translucence_options['left01-margin-right']?>px;
	
	color: <?php print $translucence_options['left01-text-color']?>;
	background-color: <?php print $translucence_options['left01-color-rgb']?>;
	border-left: 1px <?php print $translucence_options['left01-border-style']?> #FFFFFF;
	border-right: 1px <?php print $translucence_options['left01-border-style']?> <?php print $translucence_options['left01-border-right']?>;
	
	width: <?php print $translucence_options['left01-width']?>px;
	display: <?php print $translucence_options['left01-visibility']?>;
	padding-top: 10px;
	padding-left: <?php print $translucence_options['left01-padding']?>px;
	padding-right: <?php print $translucence_options['left01-padding']?>px;
	
}

#tertiary:hover {
	background-color: <?php print $translucence_options['left01-color-hover-rgb']?>;
	border-left: 1px <?php print $translucence_options['left01-hover-border-style']?> #FFFFFF;
	border-right: 1px <?php print $translucence_options['left01-hover-border-style']?> <?php print $translucence_options['left01-border-right']?>;
}
		
#primary {
	float: left;
	margin-top: <?php print $translucence_options['right01-margin-top']?>px;
	margin-left: <?php print $translucence_options['right01-margin-left']?>px;
	margin-bottom: auto;
	
	color: <?php print $translucence_options['right01-text-color']?>;
	background-color: <?php print $translucence_options['right01-color-rgb']?>;
	border-left: 1px <?php print $translucence_options['right01-border-style']?> <?php print $translucence_options['right01-border-left']?>;
	border-right: 1px <?php print $translucence_options['right01-border-style']?> #FFFFFF;

	width: <?php print $translucence_options['right01-width']?>px;
	display: <?php print $translucence_options['right01-visibility']?>;
	padding-top: 10px;
	padding-left: <?php print $translucence_options['right01-padding']?>px;
	padding-right: <?php print $translucence_options['right01-padding']?>px;
	
}

#primary:hover {
	background-color: <?php print $translucence_options['right01-color-hover-rgb']?>;
	border-left: 1px <?php print $translucence_options['right01-hover-border-style']?> <?php print $translucence_options['right01-border-left']?>;
}

#secondary {
	float: left;
	margin-top: <?php print $translucence_options['right02-margin-top']?>px;
	margin-left: <?php print $translucence_options['right02-margin-left']?>px;

	color: <?php print $translucence_options['right02-text-color']?>;
	background-color: <?php print $translucence_options['right02-color-rgb']?>;
	border-left: 1px <?php print $translucence_options['right02-border-style']?> <?php print $translucence_options['right02-border-left']?>;
	border-right: 1px <?php print $translucence_options['right02-border-style']?> #FFFFFF;

	width: <?php print $translucence_options['right02-width']?>px;
	display: <?php print $translucence_options['right02-visibility']?>;
	padding-top: 10px;
	padding-left: <?php print $translucence_options['right02-padding']?>px;
	padding-right: <?php print $translucence_options['right02-padding']?>px;

}

#secondary:hover {
	background-color: <?php print $translucence_options['right02-color-hover-rgb']?>;
	border-left: 1px <?php print $translucence_options['right02-hover-border-style']?> <?php print $translucence_options['right02-border-left']?>;
	border-right: 1px <?php print $translucence_options['right02-hover-border-style']?> #FFFFFF;
}

#footer-widget-area {
	border-top: 1px <?php print $translucence_options['bottom-border-style']?> <?php print $translucence_options['bottom-border-top']?>;
	border-bottom: 1px <?php print $translucence_options['bottom-border-style']?> transparent;
	<!-- border-left: 1px <?php print $translucence_options['bottom-border-style']?> <?php print $translucence_options['bottom-border-left']?>; -->
	<!-- border-right: 1px <?php print $translucence_options['bottom-border-style']?> <?php print $translucence_options['bottom-border-right']?>; -->	
	
	color:  <?php print $translucence_options['bottom-text-color']?>;
	background-color: <?php print $translucence_options['bottom-color-rgb']?>;
	
	overflow: hidden;
	width: <?php print $header_width?>px;
	padding: 20px 0px 0px 4px;
}

#footer-widget-area:hover {
	background-color: <?php print $translucence_options['bottom-color-hover-rgb']?>;
	border-top: 1px <?php print $translucence_options['bottom-hover-border-style']?> <?php print $translucence_options['bottom-border-top']?>;
	border-bottom: 1px <?php print $translucence_options['bottom-hover-border-style']?> <?php print $translucence_options['bottom-border-bottom']?>;
	<!-- border-left: 1px <?php print $translucence_options['bottom-hover-border-style']?> <?php print $translucence_options['bottom-border-left']?>; -->
	<!-- border-right: 1px <?php print $translucence_options['bottom-hover-border-style']?> <?php print $translucence_options['bottom-border-right']?>;		 -->
}	

#footer-widget-area .widget-area {
	float: left;
	background-color: transparent;
	margin-right: 1px;
	width: <?php print $translucence_options['footer-widget-width']?>px;
}

#footer-widget-area #fourth {
	margin-right: 0;
}


/* Begin widget links */
#tertiary a {
	color: <?php print $translucence_options['left01-link-color']?>;
	border-bottom:1px none <?php print $translucence_options['left01-link-color']?>;
}
		
#tertiary a:hover {
	color: <?php print $translucence_options['left01-link-color']?>;
	border-bottom:1px solid <?php print $translucence_options['left01-link-color']?>;
}

#tertiary .toggle a:hover {
	text-decoration: none;	
	border: 1px dotted <?php print $translucence_options['left01-link-color']?>;
}

#primary a {
	color: <?php print $translucence_options['right01-link-color']?>;
	border-bottom:1px none <?php print $translucence_options['right01-link-color']?>;
}
		
#primary a:hover {
	color: <?php print $translucence_options['right01-link-color']?>;
	border-bottom:1px solid <?php print $translucence_options['right01-link-color']?>;
}

#primary .toggle a:hover {
	text-decoration: none;	
	border: 1px dotted <?php print $translucence_options['right01-link-color']?>;
}


#secondary a {
	color: <?php print $translucence_options['right02-link-color']?>;
	border-bottom:1px none <?php print $translucence_options['right02-link-color']?>;
}

#secondary a:hover {
	color: <?php print $translucence_options['right02-link-color']?>;
	border-bottom:1px solid <?php print $translucence_options['right02-link-color']?>;
}

#secondary .toggle a:hover {
	text-decoration: none;	
	border: 1px dotted <?php print $translucence_options['right02-link-color']?>;
}

#content .toggle a {
	color: <?php print $translucence_options['entry-link-color']?>;
}

#content .toggle a:hover {
	text-decoration: none;	
	border: 1px dotted <?php print $translucence_options['entry-link-color']?>;
}

#toc .toggle a:hover {
	text-decoration: underline;	
	border: 1px dotted transparent;
}



#footer-widget-area a {
	color: <?php print $translucence_options['bottom-link-color']?>;		
}

#footer-widget-area a:hover {
	color: <?php print $translucence_options['bottom-link-color']?>;	
	border-bottom: 1px solid <?php print $translucence_options['bottom-link-color']?>;	
}
/* End widget links */

/* Begin widget headings */
.topblock h2 {
	color: <?php print $translucence_options['top-link-color']?>;
	padding-left: 0px;
	border-bottom: 1px none #CCCCCC;
}

.bottomblock h2 {
	color: <?php print $translucence_options['bottom-link-color']?>;
	padding-left: 0px;
	border-bottom: 1px none #CCCCCC;
}

		
#primary h2, #primary h3 {
	color: <?php print $translucence_options['right01-heading-color']?>;
	padding-left: 2px;
	border-bottom: 1px none #CCCCCC;
}

#secondary h2, #secondary h3 {
	color: <?php print $translucence_options['right02-heading-color']?>;
	padding-left: 2px;
	border-bottom: 1px none #CCCCCC;
}

#tertiary h2, #tertiary h3 {
	color: <?php print $translucence_options['left01-heading-color']?>;
	padding-left: 2px;
	border-bottom: 1px none #CCCCCC;
}

#footer-widget-area h2, #footer-widget-area h3 {
	color: <?php print $translucence_options['bottom-heading-color']?>;
	padding-left: 2px;
	border-bottom: 1px solid <?php print $translucence_options['bottom-heading-color']?>;
}
/* End widget headings */

/* Begin widget list css */
#tertiary ul ul li, .tertiary ul ol li {
	color: <?php print $translucence_options['left01-text-color']?>;
	list-style-type:none;
	margin: 5px 0px 0px -10px;
}

#primary ul ul li, #primary ul ol li {
	color: <?php print $translucence_options['right01-text-color']?>;
	list-style-type:none;
	margin: 5px 0px 0px -10px;
}

#secondary ul ul li, .secondary ul ol li {
	color: <?php print $translucence_options['right02-text-color']?>;
	list-style-type:none;
	margin: 3px 0 0px -10px;
}

#footer-widget-area ul ul li, .footer-widget-area ul ol li {
	color: <?php print $translucence_options['bottom-text-color']?>;
	list-style-type:none;
	margin: 3px 0 0px -10px;
}
/* End widget list css */

/* Begin sidebar search form */
#tertiary  #searchform #s {
	background-color: <?php print $translucence_options['searchbox-color']?>;
	color: <?php print $translucence_options['linkcolor']?>;
	border: 1px solid #999999;
	width: 108px;
	padding: 2px;			
}

#primary  #searchform #s {
	background-color: <?php print $translucence_options['searchbox-color']?>;
	color: <?php print $translucence_options['linkcolor']?>;
	border: 1px solid #999999;
	width: 108px;
	padding: 2px;				
}

#secondary  #searchform #s {
	background-color: <?php print $translucence_options['searchbox-color']?>;
	color: <?php print $translucence_options['linkcolor']?>;
	border: 1px solid #999999;
	width: 108px;
	padding: 2px;			
}
/* End widget search form */

/* Begin widget area separators */
#colophon {
	border-top: 1px <?php print $translucence_options['colophon-border-type']?> #000;
	margin-top: -4px;
	overflow: hidden;
	padding: 0px 0;
}
						
/* End widget area separators */

/* End Widget Areas (primary, secondary, tertiary, footer-widget-area)
-------------------------------------------------------------- */	

/* =Access (top navigation bar)
-------------------------------------------------------------- */
			
.topblock {
	color:  <?php print $translucence_options['top-text-color']?>;
	background-color: <?php print $translucence_options['top-color-rgb']?>;
	border-top: 1px none <?php print $translucence_options['top-border-top']?>;
	border-bottom: 1px <?php print $translucence_options['top-border-style']?> <?php print $translucence_options['top-border-bottom']?>;	
	border-left: 1px none <?php print $translucence_options['top-border-left']?>;
	border-right: 1px none <?php print $translucence_options['top-border-right']?>;
	padding-top: 3px;
	padding-bottom: 1px;
	padding-left: 10px;
}

.topblock a {
	color: <?php print $translucence_options['top-link-color']?>;		
}

.topblock a:hover {
	color: <?php print $translucence_options['top-link-color']?>;	
	border-bottom: 1px solid <?php print $translucence_options['top-link-color']?>;	
}

#access {
	color: <?php print $translucence_options['top-text-color']?>;
	background-color: <?php print $translucence_options['top-color-rgb']?>;
	display: block;
	float: left;
	border-top: 1px <?php print $translucence_options['top-border-style']?> <?php print $translucence_options['top-border-top']?>;
	border-bottom: 1px <?php print $translucence_options['top-border-style']?> <?php print $translucence_options['top-border-bottom']?>;	
	border-left: 1px <?php print $translucence_options['top-border-style']?> <?php print $translucence_options['top-border-left']?>;
	border-right: 1px <?php print $translucence_options['top-border-style']?> <?php print $translucence_options['top-border-right']?>;
	width: <?php print $menu_width?>px;
	margin-top: <?php print $translucence_options['top-margin-top']?>px;
	margin-bottom: 20px; 
}

#access .menu-header,
div.menu {
	font-size: 13px;
	margin-left: 12px;
	width: <?php print $menu_width?>px;
}

#access .menu-header,
div.menu,
#main {
	margin: 0 auto;
	width: <?php print $header_width?>px;
}

#access .menu-header ul,
div.menu ul {
	list-style: none;
	margin: 0;
}

#access .menu-header li,
div.menu li {
	float: left;
	position: relative;
}

#access a {
	color:  <?php print $translucence_options['top-link-color']?>;
	display: block;
	line-height: 38px;
	padding: 0 10px;
	text-decoration: none;
	border: 1px solid transparent;

}
			
#access ul ul {
	background: <?php print $translucence_options['top-color-hover02-rgb']?>;
	background: <?php print $translucence_options['top-color-hover02-rgba']?>;

	box-shadow: 0px 0px 1px <?php print $translucence_options['header-text-shadow-color']?>;
	-moz-box-shadow: 0px 0px 1px <?php print $translucence_options['header-text-shadow-color']?>;
	-webkit-box-shadow: 0px 0px 1px <?php print $translucence_options['header-text-shadow-color']?>;	

	display: none;
	position: absolute;
	top: 38px;
	left: 0;
	float: left;
	width: 180px;
	z-index: 99999;
	border-top: 1px none transparent;
	border-bottom: 1px none transparent;
	border-left: 1px solid <?php print $translucence_options['top-border-left']?>;
	border-right: 1px solid <?php print $translucence_options['top-border-right']?>;
}


#access ul ul li {
	min-width: 180px;
}

#access ul ul ul {
	left: 100%;
	top: 0;
}

#access ul ul a {
	color:  <?php print $translucence_options['top-child-link-color']?>;
	line-height: 1em;
	border-top: 1px solid transparent;
	border-bottom: 1px solid transparent;
	border-left: 1px solid transparent;
	border-right: 1px solid transparent;
	padding: 10px;
	width: 158px;
	height: auto;
}


#access li:hover > a,
#access ul ul:hover > a {
	color:  <?php print $translucence_options['top-child-link-color']?>;
	background-color: <?php print $translucence_options['top-color-hover03']?>;

	box-shadow: 0px 0px 1px <?php print $translucence_options['header-text-shadow-color']?>;
	-moz-box-shadow: 0px 0px 1px <?php print $translucence_options['header-text-shadow-color']?>;
	-webkit-box-shadow: 0px 0px 1px <?php print $translucence_options['header-text-shadow-color']?>;	
				
	border-top: 1px solid transparent;
	border-bottom: 1px solid transparent;		
	border-left: 1px solid transparent;
	border-right: 1px solid transparent;
	text-decoration: none;	

}

#access ul li:hover > ul {
	display: block;
	border-bottom: 1px solid transparent;	
}


#access .sub-menu ul,
#access .children ul {
	color:  <?php print $translucence_options['top-child-link-color']?>;
}

#access .sub-menu ul li {
	border-bottom: 1px none transparent;	
}	

#access ul li.current_page_item.page_item > a,
#access ul li.current_page_ancestor > a,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a {
	color:  <?php print $translucence_options['top-child-link-color']?>;
	background-color: <?php print $translucence_options['top-color-hover03']?>;

	box-shadow: 0px 0px 1px <?php print $translucence_options['header-text-shadow-color']?>;
	-moz-box-shadow: 0px 0px 1px <?php print $translucence_options['header-text-shadow-color']?>;
	-webkit-box-shadow: 0px 0px 1px <?php print $translucence_options['header-text-shadow-color']?>;

}

* html #access ul li.current_page_item.page_item a,
* html #access ul li.current_page_ancestor > a,
* html #access ul li.current-menu-ancestor a,
* html #access ul li.current-menu-item a,
* html #access ul li.current-menu-parent a,
* html #access ul li a:hover {
	color:  <?php print $translucence_options['top-child-link-color']?>;
	background-color: <?php print $translucence_options['top-color-hover03']?>;
	border-bottom: 1px transparent;	
}

/* End Access (top navigation bar)
-------------------------------------------------------------- */	

/* =widget navigation
-------------------------------------------------------------- */	

#primary .widget_pages li.current_page_item,  
#primary .widget_categories li.current-cat,
#primary .widget_nav_menu li.current-menu-item {
	background-color: <?php print $translucence_options['right01-highlight-color-rgb']?>;
	padding: 3px;
	border: 1px solid <?php print $translucence_options['right01-border-top']?>;
}

#secondary .widget_pages li.current_page_item,
#secondary .widget_pages li.current-cat,
#secondary .widget_nav_menu li.current-menu-item {
	background-color: <?php print $translucence_options['right02-highlight-color-rgb']?>;
	padding: 3px;
	border: 1px solid <?php print $translucence_options['right02-border-top']?>;
}

#tertiary .widget_pages li.current_page_item,
#tertiary .widget_pages li.current-cat,
#tertiary .widget_nav_menu li.current-menu-item {
	background-color: <?php print $translucence_options['left01-highlight-color-rgb']?>;
	padding: 3px;
	border: 1px solid <?php print $translucence_options['left01-border-top']?>;
}

.breadcrumbs a {
	color: <?php print $translucence_options['linkcolor']?>;
}

.pagenav {
	background-color: <?php print $translucence_options['content-highlight-color-rgb']?>;
	color: <?php print $translucence_options['content-text-color']?>;
	font-size: 12px;
	list-style: none;
	border: 1px solid #CCCCCC;
	padding: 10px;
}

.pagenav:hover {
	background-color: <?php print $translucence_options['content-highlight-color-hover-rgb']?>;
}

/* End widget navigation
-------------------------------------------------------------- */	

/* =page navigation
-------------------------------------------------------------- */

.pagenav a, .pagenav a:visited {
	color: <?php print $translucence_options['entry-link-color']?>;

}

.pagenav .current_page_item a {
	color: <?php print $translucence_options['content-text-color']?>;
}

.pagenav .current_page_item > ul.children a {
	font-style: normal;
	color: <?php print $translucence_options['entry-link-color']?>;
}
	
/* =calendar and table css
-------------------------------------------------------------- */	

#wp-calendar tbody td {
	background-color: <?php print $translucence_options['content-highlight-color-rgb']?>;
	border: 1px solid #fff;

}

/* Begin post/page entry css
-------------------------------------------------------------- */						

/* Entry titles */
#content .entry-title {
	color: <?php print $translucence_options['linkcolor']?>;
	font-weight: normal;
	line-height: 1.3em;
	margin-bottom: 0;				
	display: block;
	text-align: left;
	text-shadow: <?php print $translucence_options['post-text-shadow-color']?> <?php print $translucence_options['post-text-shadow-offset']?> <?php print $translucence_options['post-text-shadow-blur']?>;
	border-bottom: 1px solid #CCCCCC;
}

#content .entry-title:hover {
	border-bottom: 1px solid <?php print $translucence_options['linkcolor']?>;
}

#content .entry-title a {
	display: block;
	border-bottom: none;
}

.entry-title a:link,
.entry-title a:visited {
	color: <?php print $translucence_options['linkcolor']?>;
}

/* Entry Headers */
h1, h2, h3 {
	color: <?php print $translucence_options['content-text-color']?>;
	border-bottom: 1px solid #CCCCCC;
}

#entry-author-info #author-description { 
	color: <?php print $translucence_options['content-text-color']?>;
}

#entry-author-info a,
#author-description a { 
	color: <?php print $translucence_options['linkcolor']?>;
}

a, h2 a:hover, h3 a:hover {
	color: <?php print $translucence_options['linkcolor']?>;
	text-decoration: none;
}

a:hover {
	color: <?php print $translucence_options['linkcolor']?>;
	border-bottom:1px solid <?php print $translucence_options['linkcolor']?>;
	text-decoration: none;
}

/* Entry-content links */
.entry-content {
	text-align: <?php print $translucence_options['entry-text-align']?>;
}

.entry-content a {
	color: <?php print $translucence_options['linkcolor']?>;	
	text-decoration:none;
	border-bottom: 1px <?php print $translucence_options['entry-link-border']?>;
	padding:0.07em;
}

.entry-content a:hover {
	border-bottom: 1px <?php print $translucence_options['entry-link-hover-border']?>; 
	background-color: <?php print $translucence_options['entry-link-hover-background_color']?>;
}

.entry-content a:visited {
	color: <?php print $translucence_options['linkcolor_visited']?>;		
	border-bottom: 1px <?php print $translucence_options['entry-link-border']?>;
}

/* Entry-more links */
.more-link {
	display: block;			
	text-align: center;
	border-top: 1px solid #CCCCCC;
	border-bottom: 1px dotted #CCCCCC;
	text-decoration: none;
}

.more-link:hover {
	background-color: transparent;
	color: <?php print $translucence_options['linkcolor']?>;
	border-top: 1px solid <?php print $translucence_options['content-link-color']?>;
	border-bottom: 1px dotted <?php print $translucence_options['content-link-color']?>;
}

/* Entry-content headers */

.entry-content h2, .entry-content h3, .entry-content h1 {
	color: <?php print $translucence_options['content-text-color']?>;
	border-bottom: 1px solid #CCCCCC;
}

.entry-content h2:hover, .entry-content h3:hover, .entry-content h1:hover {
	border-bottom: 1px solid #CCCCCC;
}

.entry-content h2 a, .entry-content h3 a, .entry-content h1 a {
	display: block;
	text-decoration: none;
	border-bottom: none;
}

.entry-content h2 a:hover, .entry-content h3 a:hover, .entry-content h1 a:hover {
	display: block;
	border-bottom: none;
	text-decoration: none;
}

.entry-content h2 a:visited, .entry-content h3 a:visited, .entry-content h1 a:visited {
	display: block;
	text-decoration: none;
	border-bottom: none;
}

/* Entry-meta  */
.entry-meta {
	color: <?php print $translucence_options['content-text-color']?>;
	font-size: 12px;
}

.entry-meta a,
.entry-utility a {
	color: <?php print $translucence_options['linkcolor']?>;
}
.entry-meta a:hover,
.entry-utility a:hover {
	color: <?php print $translucence_options['linkcolor']?>;
}

.page-link a:link,
.page-link a:visited {
	background: <?php print $translucence_options['content-highlight-color-rgb']?>;
	color: <?php print $translucence_options['content-text-color']?>;
	font-weight: normal;
	padding: 0.2em 0.4em;
	text-decoration: none;
	border: 1px solid #CCCCCC;
}
.home .sticky .page-link a {
	background: <?php print $translucence_options['content-highlight-color-rgb']?>;
}

.page-link {
	color: <?php print $translucence_options['content-text-color']?>;
}

.page-link a:active,
.page-link a:hover {
	border: 1px solid <?php print $translucence_options['entry-link-color']?>;
}


ins {
	background-color: <?php print $translucence_options['content-highlight-color-rgb']?>;	
}


/* Post metadata */
.postmetadata.alt {
	clear: both;
	text-align: center;
	margin-top: 10px;
	border-top: 1px solid #CCCCCC;
	border-left: 1px none #CCCCCC;
}
			
.postmetadata.alt:hover {
	border-top: 1px solid <?php print $translucence_options['content-link-color']?>;
}

.postmetadata.alt a {
	display: block;
	color: <?php print $translucence_options['content-link-color']?>;
	padding-bottom: 2px;
	border-bottom: 1px dotted #CCCCCC;
	text-decoration: none;
}

.postmetadata.alt a:hover {
	background-color: transparent;
	color: <?php print $translucence_options['content-link-color']?>;
	border-bottom: 1px dotted <?php print $translucence_options['content-link-color']?>;
}

/* Begin tag links */

.tagcloud a {
	padding: 2px;
	border: 1px <?php print $translucence_options['tag-links-border-style']?> transparent;
}

.tagcloud a:hover {
	border: 1px <?php print $translucence_options['tag-links-border-style']?> <?php print $translucence_options['tag-links-link-color']?>;
}

.taglinks a {	
	color: <?php print $translucence_options['tag-links-link-color']?>;	
	background-color: <?php print $translucence_options['tag-links-color-rgb']?>;
	border-top: 1px <?php print $translucence_options['tag-links-border-style']?> <?php print $translucence_options['tag-links-border-top']?>;
	border-bottom: 1px <?php print $translucence_options['tag-links-border-style']?> <?php print $translucence_options['tag-links-border-bottom']?>;
	border-left: 1px <?php print $translucence_options['tag-links-border-style']?> <?php print $translucence_options['tag-links-border-left']?>;
	border-right: 1px <?php print $translucence_options['tag-links-border-style']?> <?php print $translucence_options['tag-links-border-right']?>;
	
	cursor:pointer; 
	display:inline-block; 
	margin:2px 0.2em; padding:0.1em 0.2em;	
}

.taglinks a:hover {
	color: <?php print $translucence_options['tag-links-link-color']?>;
	background-color: <?php print $translucence_options['tag-links-color']?>;
	border-top: 1px <?php print $translucence_options['tag-links-hover-border-style']?> <?php print $translucence_options['tag-links-hover-border-top']?>;
	border-bottom: 1px <?php print $translucence_options['tag-links-hover-border-style']?> <?php print $translucence_options['tag-links-hover-border-right']?>;
	border-left: 1px <?php print $translucence_options['tag-links-hover-border-style']?> <?php print $translucence_options['tag-links-hover-border-left']?>;
	border-right: 1px <?php print $translucence_options['tag-links-hover-border-style']?> <?php print $translucence_options['tag-links-hover-border-right']?>;
}

/* Begin category links */

.catlinks a {	
	color: <?php print $translucence_options['cat-links-link-color']?>;
	
	background-color: <?php print $translucence_options['cat-links-color-rgb']?>;
	border-top: 1px <?php print $translucence_options['cat-links-border-style']?> <?php print $translucence_options['cat-links-border-top']?>;
	border-bottom: 1px <?php print $translucence_options['cat-links-border-style']?> <?php print $translucence_options['cat-links-border-bottom']?>;
	border-left: 1px <?php print $translucence_options['cat-links-border-style']?> <?php print $translucence_options['cat-links-border-left']?>;
	border-right: 1px <?php print $translucence_options['cat-links-border-style']?> <?php print $translucence_options['cat-links-border-right']?>;
	
	cursor:pointer; 
	display:inline-block; 
	margin:2px 0.2em; padding:0.1em 0.2em;	
}

.catlinks a:hover {
	background-color: <?php print $translucence_options['cat-links-color']?>;
	
	border-top: 1px <?php print $translucence_options['cat-links-hover-border-style']?> <?php print $translucence_options['cat-links-hover-border-top']?>;
	border-bottom: 1px <?php print $translucence_options['cat-links-hover-border-style']?> <?php print $translucence_options['cat-links-hover-border-right']?>;
	border-left: 1px <?php print $translucence_options['cat-links-hover-border-style']?> <?php print $translucence_options['cat-links-hover-border-left']?>;
	border-right: 1px <?php print $translucence_options['cat-links-hover-border-style']?> <?php print $translucence_options['cat-links-hover-border-right']?>;
}	


/* Begin editing UI links */

.edit-link {
	clear: both;
	display: block;
}

.post-link a {
	color: <?php print $translucence_options['linkcolor']?>;
	display: block;
	border: 1px dotted <?php print $translucence_options['linkcolor']?>;
	text-align: center;
	padding: 5px;
	margin-bottom: 10px;
}

.post-link a:hover {
	display: block;
	border: 1px solid <?php print $translucence_options['linkcolor']?>;

}

.edit-link a {
	display: block;
	border: 1px dotted <?php print $translucence_options['linkcolor']?>;
	text-align: center;
	text-decoration: none;
	padding: 1px;
	margin-top: 10px;
	margin-bottom: 10px;
}

.edit-link a:hover {
	background-color: transparent;
	text-decoration: none;
	border: 1px solid <?php print $translucence_options['linkcolor']?>;
}	

		
/* Begin comments */

.comment-author a {
	color: <?php print $translucence_options['linkcolor']?>;
}

.reply a,
a.comment-edit-link {
	color: <?php print $translucence_options['linkcolor']?>;
}

.comment-meta a:link,
.comment-meta a:visited {
	color: <?php print $translucence_options['linkcolor']?>;
	text-decoration: none;
}

#commentform textarea {
	background-color: <?php print $translucence_options['thread-even-bgcolor']?>;
	color: <?php print $translucence_options['commentfield']?>;
}

.logged-in-as a {
	color: <?php print $translucence_options['linkcolor']?>;
}

#comments .pingback a {
	color: <?php print $translucence_options['linkcolor']?>;
}

.comment-body a {
	color: <?php print $translucence_options['linkcolor']?>;
}

.thread-alt {
	background-color: <?php print $translucence_options['thread-alt-bgcolor']?>;
}
.thread-even {
	background-color: <?php print $translucence_options['thread-even-bgcolor']?>;
}

/* Begin navigation */
.navigation a:link,
.navigation a:visited {
	color: <?php print $translucence_options['linkcolor']?>;
	text-decoration: none;
}

/* Begin syndication */
#syndication a {
	color: <?php print $translucence_options['linkcolor']?>;
}

#syndication a:visited {
	color: <?php print $translucence_options['linkcolor']?>;
}


/* Begin background text and link color */
.bgtextcolor {
	color: <?php print $translucence_options['bgtextcolor']?>;
}

.bgtextcolor a {
	color: <?php print $translucence_options['bglinkcolor']?>;
}

.bgtextcolor a:hover {
	color: <?php print $translucence_options['bglinkcolor']?>;
	border-bottom: 1px solid <?php print $translucence_options['bglinkcolor']?>;
}

small, .nocomments, .postmetadata, blockquote, strike {		
	color: <?php print $translucence_options['content-text-color']?>;
}	

	<?php
	
	/******************************************************************************
	 * Get above css and return to  translucence_theme_options_init() in theme-options.php
	 ******************************************************************************/

	$variation_css = ob_get_contents();
	ob_end_clean();
	return $variation_css;

}
endif;