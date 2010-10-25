<?php 


/*********************************************************
 * ShadowBox options css
 * embeds theme options in css
 *********************************************************/

function options_css() {
	global $_POST, $options, $variation_css, $variation_config;
	global $theme_settings, $theme_css;

	$site_width = $options['site-width'];
	$header_width = $options['site-width']-7;
	$menu_width =$options['site-width']-7;
	
	// add # to theme option for site-title and description
	if (!preg_match("/\#/", $options['site-title-color'])) {
		$options['site-title-color'] = "#".$options['site-title-color'];
	}

	if (!preg_match("/\#/", $options['site-description-color'])) {
		$options['site-description-color'] = "#".$options['site-description-color'];
	}

	// calculate the width of the content div based on widths of sidebars
	// sidebar width = sidebar width + 50
	// if sidebar width = 0 then width = 0
	$left01_width = 0;
	if ($options['left01-width'] != 0) {
		$left01_width = $options['left01-width'] + 50;
	}

	$right01_width = 0;
	if ($options['right01-width'] != 0) {
		$right01_width = $options['right01-width'] + 50;
	}

	$right02_width = 0;
	if ($options['right02-width'] != 0) {
		$right02_width = $options['right02-width'] + 50;
	}
			
	$content_width = $options['site-width'] - ($left01_width + $right01_width + $right02_width + 70);
	$total = ($options['left01-width'] + $options['right01-width'] + $options['right02-width']+$content_width);
		
$variation_css = "	
/* =css translucence theme options update
* add all of this css to the style.css of the Translucence child theme
* NOTE: change background-image url from absolute to relative
-------------------------------------------------------------- */

/* The main theme structure */	

body {
	font-family:'Helvetica Neue',Arial,Helvetica,sans-serif;
	color: ".$options['textcolor'].";
	background-color: ".$options['background_color'].";
	background-image: ".$options['background_image'].";
	background-repeat: ".$options['background_repeat'].";
	background-position: ".$options['background_position'].";
	background-attachment: ".$options['background_attachment'].";
	margin-top: 10px;
}

#access .menu-header,
div.menu,
#branding,
#main,
#wrapper {
	margin: 0 auto;
	width: ".$site_width."px;
}

#wrapper {
	background-color: ".$options['site-color-rgb'].";
	border-top: 1px ".$options['site-border-style'] ." ".$options['site-border-top'].";
	border-bottom: 1px ".$options['site-border-style'] ." ".$options['site-border-bottom'].";
	border-left: 1px ".$options['site-border-style'] ." ".$options['site-border-left'].";
	border-right: 1px ".$options['site-border-style'] ." ".$options['site-border-right'].";
	margin-top: 1px;
	margin-bottom: 10px;
	padding: ".$options['site-padding-top'] ."px ".$options['site-padding-bottom'] ."px;
}

.sitewrapper {
	width: ".$site_width."px;
	margin-left: auto;
	margin-right: auto;
	margin-top: ".$options['site-margin-top']."px;
}


/* The theme meta areas */

.headermeta_left {
	font-size: 12px;
	width: 50%;	
	text-align: left;
	margin-left: ".$options['header-meta-left-margin'].";
}

.headermeta_right {
	font-size: 12px;
	width: 45%;
	text-align: right;
	float: right;
	clear: left;
	margin-right: ".$options['header-meta-right-margin'].";
}

.footermeta_left {
	font-size: 12px;
	width: 50%;	
	text-align: left;
	margin-left: ".$options['footer-meta-left-margin'].";
	padding-top: 5px;
	padding-bottom: 10px;
}

.footermeta_right {
	font-size: 12px;
	width: 40%;
	text-align: right;
	float: right;
	margin-right: ".$options['footer-meta-right-margin'].";
	padding-top: 5px;
	padding-bottom: 10px;
}			

/* The theme header area */

#header {
	padding: 0 0 0 4px;
}
	
#branding {
	margin: 0 auto;
	width: ".$site_width."px;		
}

.headerblock {
	color: ".$options['header-text-color'].";
	background-color: ".$options['header-color-rgb'].";
	border-top: 1px ".$options['header-border-style']." ".$options['header-border-top'].";
	border-bottom: 1px ".$options['header-border-style']." ".$options['header-border-bottom'].";
	border-left: 1px ".$options['header-border-style']." ".$options['header-border-left'].";
	border-right: 1px ".$options['header-border-style']." ".$options['header-border-right'].";				
	padding-top: 0px;
	width: ".$header_width."px;
	height: ".$options['header-block-height']."px;
}

.headerblock:hover {
	background-color: ".$options['header-color-hover-rgb'].";
	border-top: 1px ".$options['header-hover-border-style']." ".$options['header-border-top'].";
	border-bottom: 1px ".$options['header-hover-border-style']." ".$options['header-border-bottom'].";
	border-left: 1px ".$options['header-hover-border-style']." ".$options['header-border-left'].";
	border-right: 1px ".$options['header-hover-border-style']." ".$options['header-border-right'].";	 
}

#branding #site-title {
	color: ".$options['site-title-color'].";
	font-size: ".$options['site-title-size']."px;
	font-weight: normal;
	border-bottom: none;
	text-shadow: ".$options['header-text-shadow-color']." ".$options['header-text-shadow-offset']." ".$options['header-text-shadow-blur'].";
}

.title-box {
	position: relative;
	top: ".$options['header-text-padding-top']."px;
	background-color: ".$options['title-box-color-rgb'].";
	border-top: 1px none #CCCCCC;
	border-bottom: 1px none #CCCCCC;
	border-left: 1px none #CCCCCC;
	border-right: 1px none #CCCCCC;
	padding: 3px 10px 3px 1px;
	margin-left: 10px;
}

.description-box {
	position: relative;
	top: ".$options['header-text-padding-top']."px;
	background-color: ".$options['description-box-color-rgb'].";
	border-top: 1px none #CCCCCC;
	border-bottom: 1px none #CCCCCC;
	border-left: 1px none #CCCCCC;
	border-right: 1px none #CCCCCC;
	padding: 3px 10px 3px 1px;
	margin-left: 10px;
}


#site-title a {
	font-size: ".$options['site-title-size']."px;
	color: ".$options['site-title-color'].";
	display: ".$options['show-header-text'].";
	text-shadow: ".$options['header-text-shadow-color']." ".$options['header-text-shadow-offset']." ".$options['header-text-shadow-blur'].";
}

#site-title a:hover {
	display: ".$options['show-header-text'].";
	color: ".$options['site-title-color'].";
	border-bottom: none;
}

.headerblock #site-description {
	position: relative;
	top: ".$options['description-text-padding-top']."px;
	display: ".$options['show-header-text'].";
	padding-left: 15px;
	color: ".$options['site-description-color'].";
	font-size: ".$options['site-description-size']."px;
}

/* Misc full width area settings */

#footer {
	clear: both;
	width: ".$site_width."px;
}

/* Full width content with no sidebar; used for attachment pages */
.single-attachment #content {
	margin: 0 auto;
	width: ".$site_width."px;
}

/* =Content and Container
-------------------------------------------------------------- */	

#container {
	overflow: hidden;
	margin: 0 0px 0 0;
	padding: 0px 0px 0px 4px;
	width: 100%;			
}

#content {
	float: left;
	margin-top: ".$options['content-margin-top']."px;
	margin-right: ".$options['content-margin-right']."px;
	
	width: ".$content_width."px;
	color: ".$options['content-text-color'].";
	background-color: ".$options['content-color-rgb'].";
	padding: 20px;
	border-top: ".$options['content-border-width'] ." ".$options['content-border-style'] ." ".$options['content-border-top'].";
	border-bottom: ".$options['content-border-width'] ." ".$options['content-border-style'] ." ".$options['content-border-bottom'].";
	border-left: ".$options['content-border-width'] ." ".$options['content-border-style'] ." ".$options['content-border-left'].";
	border-right: ".$options['content-border-width'] ." ".$options['content-border-style'] ." ".$options['content-border-right'].";
	
	font-size: ".$options['entry-text-size']."px;
	line-height: ".$options['entry-line-height']."px;
}


/* =Widget Areas (primary, secondary, tertiary, footer-widget-area)
-------------------------------------------------------------- */	

#tertiary {
	float: left;
	margin-top: ".$options['left01-margin-top']."px;
	margin-right: ".$options['left01-margin-right']."px;
	
	color: ".$options['left01-text-color'].";
	background-color: ".$options['left01-color-rgb'].";
	border-top: 1px ".$options['left01-border-style']." ".$options['left01-border-top'].";
	border-bottom: 1px ".$options['left01-border-style']." ".$options['left01-border-bottom'].";
	border-left: 1px ".$options['left01-border-style']." ".$options['left01-border-left'].";
	border-right: 1px ".$options['left01-border-style']." ".$options['left01-border-right'].";
	
	width: ".$options['left01-width']."px;
	visibility: ".$options['left01-visibility'].";
	padding-top: 10px;
	padding-left: ".$options['left01-padding']."px;
	padding-right: ".$options['left01-padding']."px;
	
}

#tertiary:hover {
	background-color: ".$options['left01-color-hover-rgb'].";
	border-top: 1px ".$options['left01-hover-border-style']." ".$options['left01-border-top'].";
	border-bottom: 1px ".$options['left01-hover-border-style']." ".$options['left01-border-left'].";
	border-left: 1px ".$options['left01-hover-border-style']." ".$options['left01-border-left'].";
	border-right: 1px ".$options['left01-hover-border-style']." ".$options['left01-border-right'].";
}
		
#primary {
	float: left;
	margin-top: ".$options['right01-margin-top']."px;
	margin-right: ".$options['right01-margin-right']."px;
	margin-bottom: auto;
	
	color: ".$options['right01-text-color'].";
	background-color: ".$options['right01-color-rgb'].";
	border-top: 1px ".$options['right01-border-style']." ".$options['right01-border-top'].";
	border-bottom: 1px ".$options['right01-border-style']." ".$options['right01-border-bottom'].";
	border-left: 1px ".$options['right01-border-style']." ".$options['right01-border-left'].";
	border-right: 1px ".$options['right01-border-style']." ".$options['right01-border-right'].";

	width: ".$options['right01-width']."px;
	visibility: ".$options['right01-visibility'].";
	padding-top: 10px;
	padding-left: ".$options['right01-padding']."px;
	padding-right: ".$options['right01-padding']."px;
	
}

#primary:hover {
	background-color: ".$options['right01-color-hover-rgb'].";
	border-top: 1px ".$options['right01-hover-border-style']." ".$options['right01-border-top'].";
	border-bottom: 1px ".$options['right01-hover-border-style']." ".$options['right01-border-right'].";
	border-left: 1px ".$options['right01-hover-border-style']." ".$options['right01-border-left'].";
	border-right: 1px ".$options['right01-hover-border-style']." ".$options['right01-border-right'].";
}

#secondary {
	float: left;
	margin-top: ".$options['right02-margin-top']."px;
	margin-right: ".$options['right02-margin-right']."px;

	color: ".$options['right02-text-color'].";
	background-color: ".$options['right02-color-rgb'].";
	border-top: 1px ".$options['right02-border-style']." ".$options['right02-border-top'].";
	border-bottom: 1px ".$options['right02-border-style']." ".$options['right02-border-bottom'].";
	border-left: 1px ".$options['right02-border-style']." ".$options['right02-border-left'].";
	border-right: 1px ".$options['right02-border-style']." ".$options['right02-border-right'].";

	width: ".$options['right02-width']."px;
	visibility: ".$options['right02-visibility'].";
	padding-top: 10px;
	padding-left: ".$options['right02-padding']."px;
	padding-right: ".$options['right02-padding']."px;

}

#secondary:hover {
	background-color: ".$options['right02-color-hover-rgb'].";
	border-top: 1px ".$options['right02-hover-border-style']." ".$options['right02-border-top'].";
	border-bottom: 1px ".$options['right02-hover-border-style']." ".$options['right02-border-right'].";
	border-left: 1px ".$options['right02-hover-border-style']." ".$options['right02-border-left'].";
	border-right: 1px ".$options['right02-hover-border-style']." ".$options['right02-border-right'].";
}

#footer-widget-area {
	border-top: 1px ".$options['bottom-border-style']." ".$options['bottom-border-top'].";
	border-bottom: 1px ".$options['bottom-border-style']." ".$options['bottom-border-bottom'].";
	border-left: 1px ".$options['bottom-border-style']." ".$options['bottom-border-left'].";
	border-right: 1px ".$options['bottom-border-style']." ".$options['bottom-border-right'].";	
	
	color:  ".$options['bottom-text-color'].";
	background-color: ".$options['bottom-color-rgb'].";
	
	overflow: hidden;
	width: ".$header_width."px;
	padding: 20px 0px 0px 4px;
}

#footer-widget-area:hover {
	background-color: ".$options['bottom-color-hover-rgb'].";
	border-top: 1px ".$options['bottom-hover-border-style']." ".$options['bottom-border-top'].";
	border-bottom: 1px ".$options['bottom-hover-border-style']." ".$options['bottom-border-bottom'].";
	border-left: 1px ".$options['bottom-hover-border-style']." ".$options['bottom-border-left'].";
	border-right: 1px ".$options['bottom-hover-border-style']." ".$options['bottom-border-right'].";		
}	

#footer-widget-area .widget-area {
	float: left;
	background-color: transparent;
	margin-right: 1px;
	width: ".$options['footer-widget-width']."px;
}

#footer-widget-area #fourth {
	margin-right: 0;
}


/* Begin widget links */
#tertiary a {
	color: ".$options['left01-link-color'].";
	border-bottom:1px none ".$options['left01-link-color'].";
}
		
#tertiary a:hover {
	color: ".$options['left01-link-color'].";
	border-bottom:1px solid ".$options['left01-link-color'].";
}

#primary a {
	color: ".$options['right01-link-color'].";
	border-bottom:1px none ".$options['right01-link-color'].";
}
		
#primary a:hover {
	color: ".$options['right01-link-color'].";
	border-bottom:1px solid ".$options['right01-link-color'].";
}

#secondary a {
	color: ".$options['right02-link-color'].";
	border-bottom:1px none ".$options['right02-link-color'].";
}

#secondary a:hover {
	color: ".$options['right02-link-color'].";
	border-bottom:1px solid ".$options['right02-link-color'].";
}

#footer-widget-area a {
	color: ".$options['bottom-link-color'].";		
}

#footer-widget-area a:hover {
	color: ".$options['bottom-link-color'].";	
	border-bottom: 1px solid ".$options['bottom-link-color'].";	
}
/* End widget links */

/* Begin widget headings */
.topblock h2 {
	color: ".$options['top-link-color'].";
	padding-left: 0px;
	border-bottom: 1px none #CCCCCC;
}

.bottomblock h2 {
	color: ".$options['bottom-link-color'].";
	padding-left: 0px;
	border-bottom: 1px none #CCCCCC;
}

		
#primary h2, #primary h3 {
	color: ".$options['right01-heading-color'].";
	padding-left: 2px;
	border-bottom: 1px none #CCCCCC;
}

#secondary h2, #secondary h3 {
	color: ".$options['right02-heading-color'].";
	padding-left: 2px;
	border-bottom: 1px none #CCCCCC;
}

#tertiary h2, #tertiary h3 {
	color: ".$options['left01-heading-color'].";
	padding-left: 2px;
	border-bottom: 1px none #CCCCCC;
}

#footer-widget-area h2, #footer-widget-area h3 {
	color: ".$options['bottom-heading-color'].";
	padding-left: 2px;
	border-bottom: 1px solid ".$options['bottom-heading-color'].";
}
/* End widget headings */

/* Begin widget list css */
#tertiary ul ul li, .tertiary ul ol li {
	color: ".$options['left01-text-color'].";
	list-style-type:none;
	margin: 5px 0px 0px -10px;
}

#primary ul ul li, #primary ul ol li {
	color: ".$options['right01-text-color'].";
	list-style-type:none;
	margin: 5px 0px 0px -10px;
}

#secondary ul ul li, .secondary ul ol li {
	color: ".$options['right02-text-color'].";
	list-style-type:none;
	margin: 3px 0 0px -10px;
}

#footer-widget-area ul ul li, .footer-widget-area ul ol li {
	color: ".$options['bottom-text-color'].";
	list-style-type:none;
	margin: 3px 0 0px -10px;
}
/* End widget list css */

/* Begin sidebar search form */
#tertiary  #searchform #s {
	background-color: ".$options['searchbox-color'].";
	color: ".$options['linkcolor'].";
	border: 1px solid #999999;
	width: 108px;
	padding: 2px;			
}

#primary  #searchform #s {
	background-color: ".$options['searchbox-color'].";
	color: ".$options['linkcolor'].";
	border: 1px solid #999999;
	width: 108px;
	padding: 2px;				
}

#secondary  #searchform #s {
	background-color: ".$options['searchbox-color'].";
	color: ".$options['linkcolor'].";
	border: 1px solid #999999;
	width: 108px;
	padding: 2px;			
}
/* End widget search form */

/* Begin widget area separators */
#colophon {
	border-top: 1px ".$options['colophon-border-type']." #000;
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
	color:  ".$options['top-text-color'].";
	background-color: ".$options['top-color-rgb'].";
	border-top: 1px none ".$options['top-border-top'].";
	border-bottom: 1px ".$options['top-border-style']." ".$options['top-border-bottom'].";	
	border-left: 1px none ".$options['top-border-left'].";
	border-right: 1px none ".$options['top-border-right'].";
	padding-top: 3px;
	padding-bottom: 1px;
	padding-left: 10px;
}

.topblock a {
	color: ".$options['top-link-color'].";		
}

.topblock a:hover {
	color: ".$options['top-link-color'].";	
	border-bottom: 1px solid ".$options['topbar-link-color'].";	
}

#access {
	color: ".$options['top-text-color'].";
	background-color: ".$options['top-color-rgb'].";
	display: block;
	float: left;
	border-top: 1px ".$options['top-border-style']." ".$options['top-border-top'].";
	border-bottom: 1px ".$options['top-border-style']." ".$options['top-border-bottom'].";	
	border-left: 1px ".$options['top-border-style']." ".$options['top-border-left'].";
	border-right: 1px ".$options['top-border-style']." ".$options['top-border-right'].";
	width: ".$menu_width."px;
	margin-top: ".$options['top-margin-top']."px;
	margin-bottom: 20px; 
}

#access .menu-header,
div.menu {
	font-size: 13px;
	margin-left: 12px;
	width: ".$menu_width."px;
}

#access .menu-header,
div.menu,
#main {
	margin: 0 auto;
	width: ".$header_width."px;
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
	color: ".$options['top-link-color'].";	
	display: block;
	line-height: 38px;
	padding: 0 10px;
	text-decoration: none;
}
			
#access ul ul {
	box-shadow: 0px 0px 2px rgba(0,0,0,0.2);
	-moz-box-shadow: 0px 0px 3px rgba(0,0,0,0.2);
	-webkit-box-shadow: 0px 0px 3px rgba(0,0,0,0.2);
	display: none;
	position: absolute;
	top: 38px;
	left: 0;
	float: left;
	width: 180px;
	z-index: 99999;
}

#access ul ul li {
	min-width: 180px;
}

#access ul ul ul {
	left: 100%;
	top: 0;
}

#access ul ul a {
	background-color: ".$options['top-color-rgb'].";
	line-height: 1em;
	padding: 10px;
	width: 160px;
	height: auto;
}	

#access li:hover > a,
#access ul ul :hover > a {
	color:  ".$options['top-link-color'].";
	background-color: ".$options['top-color-rgb'].";
	text-decoration: underline;	
	border-bottom: none;
}

#access ul li:hover > ul {
	display: block;
	border-bottom: none;
}

#access .sub-menu,
#access .children {
	background-color: ".$options['top-color-rgb'].";
	box-shadow: 0px 3px 3px ".$options['header-text-shadow-color'].";
	-moz-box-shadow: 0px 3px 3px ".$options['header-text-shadow-color'].";
	-webkit-box-shadow: 0px 3px 3px ".$options['header-text-shadow-color'].";
	border-top: 1px none ".$options['top-border-top'].";
	border-bottom: 1px ".$options['top-border-style']." ".$options['top-border-bottom'].";	
	border-left: 1px ".$options['top-border-style']." ".$options['top-border-left'].";
	border-right: 1px ".$options['top-border-style']." ".$options['top-border-right'].";
}

#access .sub-menu ul,
#access .children ul {
	border-bottom: 1px ".$options['top-border-style']." ".$options['top-border-bottom'].";
}

#access .sub-menu ul li {
	border-bottom: none;
}	

#access ul li.current_page_item > a,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a {
	color:  ".$options['top-text-color'].";		
}

* html #access ul li.current_page_item a,
* html #access ul li.current-menu-ancestor a,
* html #access ul li.current-menu-item a,
* html #access ul li.current-menu-parent a,
* html #access ul li a:hover {
	color:  ".$options['top-text-color'].";
	border-bottom: none;
}

/* End Access (top navigation bar)
-------------------------------------------------------------- */	

/* Begin post/page entry css
-------------------------------------------------------------- */						

/* Entry titles */
#content .entry-title {
	color: ".$options['linkcolor'].";
	font-weight: normal;
	line-height: 1.3em;
	margin-bottom: 0;				
	display: block;
	text-align: left;
	text-shadow: ".$options['post-text-shadow-color']." ".$options['post-text-shadow-offset']." ".$options['post-text-shadow-blur'].";
	border-bottom: 1px solid #CCCCCC;
}

#content .entry-title:hover {
	border-bottom: 1px solid ".$options['linkcolor'].";
}

#content .entry-title a {
	display: block;
	border-bottom: none;
}

.entry-title a:link,
.entry-title a:visited {
	color: ".$options['linkcolor'].";
}

/* Entry Headers */
h1, h2, h3 {
	color: ".$options['content-text-color'].";
	border-bottom: 1px solid #CCCCCC;
}

a, h2 a:hover, h3 a:hover {
	color: ".$options['linkcolor'].";
	text-decoration: none;
}

a:hover {
	color: ".$options['linkcolor'].";
	border-bottom:1px solid ".$options['linkcolor'].";
	text-decoration: none;
}

/* Entry-content links */
.entry-content {
	text-align: ".$options['entry-text-align'].";
}

.entry-content a {
	color: ".$options['linkcolor'].";	
	text-decoration:none;
	border-bottom: 1px ".$options['entry-link-border'].";
	padding:0.07em;
}

.entry-content a:hover {
	border-bottom: 1px ".$options['entry-link-hover-border']."; 
	background-color: ".$options['entry-link-hover-background_color'].";
}

.entry-content a:visited {
	color: ".$options['linkcolor_visited'].";		
	border-bottom: 1px ".$options['entry-link-border'].";
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
	color: ".$options['linkcolor'].";
	border-top: 1px solid ".$options['content-link-color'].";
	border-bottom: 1px dotted ".$options['content-link-color'].";
}

/* Entry-content headers */

.entry-content h2, .entry-content h3, .entry-content h1 {
	color: ".$options['textcolor'].";
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
	color: ".$options['textcolor'].";
	font-size: 12px;
}

.entry-meta a,
.entry-utility a {
	color: ".$options['linkcolor'].";
}
.entry-meta a:hover,
.entry-utility a:hover {
	color: ".$options['linkcolor'].";
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
	border-top: 1px solid ".$options['content-link-color'].";
}

.postmetadata.alt a {
	display: block;
	color: ".$options['content-link-color'].";
	padding-bottom: 2px;
	border-bottom: 1px dotted #CCCCCC;
	text-decoration: none;
}

.postmetadata.alt a:hover {
	background-color: transparent;
	color: ".$options['content-link-color'].";
	border-bottom: 1px dotted ".$options['content-link-color'].";
}

/* Begin tag links */
.tag-links a {	
	color: ".$options['tag-links-link-color'].";	
	background-color: ".$options['tag-links-color'].";
	border-top: 1px ".$options['tag-links-border-style']." ".$options['tag-links-border-top'].";
	border-bottom: 1px ".$options['tag-links-border-style']." ".$options['tag-links-border-bottom'].";
	border-left: 1px ".$options['tag-links-border-style']." ".$options['tag-links-border-left'].";
	border-right: 1px ".$options['tag-links-border-style']." ".$options['tag-links-border-right'].";
	
	cursor:pointer; 
	display:inline-block; 
	margin:2px 0.2em; padding:0.1em 0.2em;	
}

.tag-links a:hover {
	color: ".$options['tag-links-link-color'].";
	background-color: ".$options['tag-links-color'].";
	border-top: 1px ".$options['tag-links-hover-border-style']." ".$options['tag-links-hover-border-top'].";
	border-bottom: 1px ".$options['tag-links-hover-border-style']." ".$options['tag-links-hover-border-right'].";
	border-left: 1px ".$options['tag-links-hover-border-style']." ".$options['tag-links-hover-border-left'].";
	border-right: 1px ".$options['tag-links-hover-border-style']." ".$options['tag-links-hover-border-right'].";
}

/* Begin category links */

.cat-links a {	
	color: ".$options['cat-links-link-color'].";
	
	background-color: ".$options['cat-links-color'].";
	border-top: 1px ".$options['cat-links-border-style']." ".$options['cat-links-border-top'].";
	border-bottom: 1px ".$options['cat-links-border-style']." ".$options['cat-links-border-bottom'].";
	border-left: 1px ".$options['cat-links-border-style']." ".$options['cat-links-border-left'].";
	border-right: 1px ".$options['cat-links-border-style']." ".$options['cat-links-border-right'].";
	
	cursor:pointer; 
	display:inline-block; 
	margin:2px 0.2em; padding:0.1em 0.2em;	
}

.cat-links a:hover {
	background-color: ".$options['cat-links-color'].";
	
	border-top: 1px ".$options['cat-links-hover-border-style']." ".$options['cat-links-hover-border-top'].";
	border-bottom: 1px ".$options['cat-links-hover-border-style']." ".$options['cat-links-hover-border-right'].";
	border-left: 1px ".$options['cat-links-hover-border-style']." ".$options['cat-links-hover-border-left'].";
	border-right: 1px ".$options['cat-links-hover-border-style']." ".$options['cat-links-hover-border-right'].";
}	


/* Begin editing UI links */

.edit-link {
	clear: both;
	display: block;
}

.post-link a {
	color: ".$options['linkcolor'].";
	display: block;
	border: 1px dotted ".$options['linkcolor'].";
	text-align: center;
	padding: 5px;
	margin-bottom: 10px;
}

.post-link a:hover {
	display: block;
	border: 1px solid ".$options['linkcolor'].";

}

.edit-link a {
	display: block;
	border: 1px dotted ".$options['linkcolor'].";
	text-align: center;
	text-decoration: none;
	padding: 1px;
	margin-top: 10px;
	margin-bottom: 10px;
}

.edit-link a:hover {
	background-color: transparent;
	text-decoration: none;
	border: 1px solid ".$options['linkcolor'].";
}	

		
/* Begin comments */

.reply a,
a.comment-edit-link {
	color: ".$options['linkcolor'].";
}

.comment-meta a:link,
.comment-meta a:visited {
	color: ".$options['linkcolor'].";
	text-decoration: none;
}

#commentform textarea {
	background-color: ".$options['thread-even-bgcolor'].";
	color: ".$options['commentfield'].";
}

.thread-alt {
	background-color: ".$options['thread-alt-bgcolor'].";
}
.thread-even {
	background-color: ".$options['thread-even-bgcolor'].";
}

/* Begin navigation */
.navigation a:link,
.navigation a:visited {
	color: ".$options['linkcolor'].";
	text-decoration: none;
}

/* Begin syndication */
#syndication a {
	color: ".$options['linkcolor'].";
}

#syndication a:visited {
	color: ".$options['linkcolor'].";
}


/* Begin background text and link color */
.bgtextcolor {
	color: ".$options['bgtextcolor'].";
}

.bgtextcolor a {
	color: ".$options['bglinkcolor'].";
}

.bgtextcolor a:hover {
	color: ".$options['bglinkcolor'].";
	border-bottom: 1px solid ".$options['bglinkcolor'].";
}

small, .nocomments, .postmetadata, blockquote, strike {		
	color: ".$options['textcolor'].";
}	

";
	return $variation_css;
}