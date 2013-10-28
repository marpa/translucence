<?php 


if ( ! function_exists( 'translucence_options_css' ) ) :

/*********************************************************
 * Translucence options css
 * embeds theme options in css
 *
 * @since 2010 Translucence 1.0
 * @return string css
 *********************************************************/

function translucence_options_css() {
	global $translucence_options, $translucence_config;
	global $translucence_options_id;
	
	// add # to theme option for site-title and description
	if (!preg_match("/\#/", $translucence_options['site-title-color'])) {
		$translucence_options['site-title-color'] = "#".$translucence_options['site-title-color'];
	}

	if (!preg_match("/\#/", $translucence_options['site-description-color'])) {
		$translucence_options['site-description-color'] = "#".$translucence_options['site-description-color'];
	}
	
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
}

#access .menu-header,
div.menu,
#branding,
#main,
#wrapper {
	width: <?php print $translucence_options['site-width']?>px;
}

#wrapper {
	background-color: <?php print $translucence_options['site-color-rgb']?>;
	-moz-box-shadow: 0px 0px <?php print $translucence_options['site-border-shadow'] ?>px rgba(0,0,0,0.2);
	-webkit-box-shadow: 0px 0px <?php print $translucence_options['site-border-shadow'] ?>px rgba(0,0,0,0.2);
	box-shadow: 0px 0px <?php print $translucence_options['site-border-shadow'] ?>px rgba(0,0,0,0.2);	
	border: 1px <?php print $translucence_options['site-border-style'] ?> <?php print $translucence_options['site-border-color']?>;	
	padding: <?php print $translucence_options['site-padding-top'] ?>px <?php print $translucence_options['site-padding-bottom'] ?>px;
}

.sitewrapper {
	width: <?php print $translucence_options['site-width']?>px;
	margin-top: <?php print $translucence_options['site-margin-top']?>px;
}


/* The theme meta areas */

.headermeta_left {
	margin-left: <?php print $translucence_options['header-meta-left-margin']?>;
}

.headermeta_right {
	margin-right: <?php print $translucence_options['header-meta-right-margin']?>;
}

.footermeta_left {
	margin-left: <?php print $translucence_options['footer-meta-left-margin']?>;
}

.footermeta_right {
	margin-right: <?php print $translucence_options['footer-meta-right-margin']?>;
}			

/* The theme header area */

#header {
	margin-top: <?php print $translucence_options['header-top-margin']?>px;
}
	
#branding {
	width: <?php print ($translucence_options['site-width'] - 2)?>px;
	height: <?php print $translucence_options['header-block-height']?>px;
	color: <?php print $translucence_options['header-text-color']?>;
	border: 1px <?php print $translucence_options['headerblock-border-style']?> <?php print $translucence_options['header-border-color']?>; 
	background-color: <?php print $translucence_options['header-color-rgb']?>;
}

#branding:hover {
	background-color: <?php print $translucence_options['header-color-hover-rgb']?>;
	border: 1px <?php print $translucence_options['headerblock-hover-border-style']?> <?php print $translucence_options['header-border-color']?>; 
}


#branding .headerblock {
	width: <?php print ($translucence_options['site-width'] - 2)?>px;
	height: <?php print $translucence_options['header-block-height']?>px;
}

#branding #title-box {
	display: <?php print $translucence_options['show-header-text']?>;
	height: <?php print $translucence_options['title-box-height']?>px;
	top: <?php print $translucence_options['title-box-top']?>px;
	left: <?php print $translucence_options['title-box-left']?>px;
	margin-top: <?php print $translucence_options['title-box-top-margin']?>px;
}

#branding #site-title {
	color: <?php print $translucence_options['site-title-color']?>;
	background-color: <?php print $translucence_options['title-box-color-rgb']?>;
	height: <?php print ($translucence_options['site-title-size'] + 6)?>px;
	font-size: <?php print $translucence_options['site-title-size']?>px;
	line-height: <?php print ($translucence_options['site-title-size'] + 6)?>px;
	text-shadow: <?php print $translucence_options['header-text-shadow-color']?> <?php print $translucence_options['header-text-shadow-offset']?> <?php print $translucence_options['header-text-shadow-blur']?>;
}

#branding #site-description {
	color: <?php print $translucence_options['site-description-color']?>;
	background-color: <?php print $translucence_options['description-box-color-rgb']?>;
	font-size: <?php print $translucence_options['site-description-size']?>px;
	line-height: <?php print ($translucence_options['site-description-size'] + 2)?>px;
}


/* Misc full width area settings */

#footer {
	width: <?php print $translucence_options['site-width']?>px;
}

/* =Content and Container
-------------------------------------------------------------- */	

#content {
	margin-top: <?php print $translucence_options['content-margin-top']?>px;
	margin-right: <?php print $translucence_options['content-margin-right']?>px;
	width: <?php print $translucence_options['content-width']?>px;
	color: <?php print $translucence_options['textcolor']?>;
	background-color: <?php print $translucence_options['content-color-rgb']?>;
	padding: <?php print $translucence_options['content-padding'] ?>px;	
	border: <?php print $translucence_options['content-border-width'] ?> <?php print $translucence_options['content-border-style'] ?> <?php print $translucence_options['content-border-color']?>;		
	font-size: <?php print $translucence_options['entry-text-size']?>px;
	line-height: <?php print $translucence_options['entry-line-height']?>px;
}



/* =Widget Areas (primary, secondary, tertiary, footer-widget-area)
-------------------------------------------------------------- */	
#tertiary {
	display: <?php print $translucence_options['left01-visibility']?>;
}
#primary {
	display: <?php print $translucence_options['right01-visibility']?>;
}
#secondary {
	display: <?php print $translucence_options['right02-visibility']?>;
}

<?php 
$variation_css = ob_get_clean();
ob_start(); 
?>
#tertiary {
	margin-top: <?php print $translucence_options['left01-margin-top']?>px;
	margin-right: <?php print $translucence_options['left01-margin-right']?>px;	
	color: <?php print $translucence_options['left01-text-color']?>;
	background-color: <?php print $translucence_options['left01-color-rgb']?>;	
	border: 1px <?php print $translucence_options['left01-border-style']?> <?php print $translucence_options['left01-border-color']?>;	
	width: <?php print $translucence_options['left01-width']?>px;
	display: <?php print $translucence_options['left01-visibility']?>;
	padding-top: 15px;
	padding-left: <?php print $translucence_options['left01-padding']?>px;
	padding-right: <?php print $translucence_options['left01-padding']?>px;	
}

#tertiary:hover {
	background-color: <?php print $translucence_options['left01-color-hover-rgb']?>;
	border: 1px <?php print $translucence_options['left01-hover-border-style']?> <?php print $translucence_options['left01-border-color']?>;
}

#tertiary a {
	color: <?php print $translucence_options['left01-link-color']?>;
}
		
#tertiary a:hover {
	color: <?php print $translucence_options['left01-link-color']?>;
	border-bottom: 1px solid <?php print $translucence_options['left01-link-color']?>;
}

#tertiary .page_item a:hover {
	color: <?php print $translucence_options['left01-link-color']?>;
	border: 1px dotted <?php print $translucence_options['left01-border-color']?>;
}

#tertiary h2, #tertiary h3 {
	color: <?php print $translucence_options['left01-heading-color']?>;
	border-bottom: 1px none #CCCCCC;
}

#tertiary ul ul li, #tertiary ul ol li {
	color: <?php print $translucence_options['left01-text-color']?>;
}

#tertiary  #searchform #s {
	background: url(<?php print get_template_directory_uri() ?>/images/search.png) no-repeat 5px 6px;
	background-color: <?php print $translucence_options['searchbox-color']?>;
	color: <?php print $translucence_options['linkcolor']?>;
}

#tertiary #wp-calendar tbody {
	color: <?php print $translucence_options['left01-text-color']?>;
}

#tertiary #wp-calendar a {
	border-bottom: 1px dotted <?php print $translucence_options['left01-link-color']?>;
	padding: 2px;
}

#tertiary #wp-calendar a:hover {
	border-bottom: 1px solid <?php print $translucence_options['left01-link-color']?>;
}

#tertiary .widget_pages li.current_page_item,
#tertiary .widget_pages li.current-cat,
#tertiary .widget_nav_menu li.current-menu-item {
	background-color: <?php print $translucence_options['left01-highlight-color-rgb']?>;
	padding: 3px;
	border: 1px solid <?php print $translucence_options['left01-border-color']?>;
}

<?php 
if ($translucence_options['left01-visibility'] == "none") {
	ob_end_clean();
	ob_start(); 
}

$variation_css .= ob_get_clean();
ob_start(); 
?>
		
#primary {
	margin-top: <?php print $translucence_options['right01-margin-top']?>px;
	margin-right: <?php print $translucence_options['right01-margin-right']?>px;
	margin-bottom: auto;	
	color: <?php print $translucence_options['right01-text-color']?>;
	background-color: <?php print $translucence_options['right01-color-rgb']?>;	
	border: 1px <?php print $translucence_options['right01-border-style']?> <?php print $translucence_options['right01-border-color']?>;
	width: <?php print $translucence_options['right01-width']?>px;
	display: <?php print $translucence_options['right01-visibility']?>;
	padding-top: 15px;
	padding-left: <?php print $translucence_options['right01-padding']?>px;
	padding-right: <?php print $translucence_options['right01-padding']?>px;	
}

#primary:hover {
	background-color: <?php print $translucence_options['right01-color-hover-rgb']?>;
	border: 1px <?php print $translucence_options['right01-hover-border-style']?> <?php print $translucence_options['right01-border-color']?>;
}

#primary a {
	color: <?php print $translucence_options['right01-link-color']?>;
}
		
#primary a:hover {
	color: <?php print $translucence_options['right01-link-color']?>;
	border-bottom: 1px solid <?php print $translucence_options['right01-link-color']?>;
}

#primary .page_item a:hover {
	color: <?php print $translucence_options['right01-link-color']?>;
	border: 1px dotted <?php print $translucence_options['right01-border-color']?>;
}

#primary h2, #primary h3 {
	color: <?php print $translucence_options['right01-heading-color']?>;
	border-bottom: 1px none #CCCCCC;
}

#primary ul ul li, #primary ul ol li {
	color: <?php print $translucence_options['right01-text-color']?>;
}

#primary  #searchform #s {
	background: url(<?php print get_template_directory_uri() ?>/images/search.png) no-repeat 5px 6px;
	background-color: <?php print $translucence_options['searchbox-color']?>;
	color: <?php print $translucence_options['linkcolor']?>;
}

#primary #wp-calendar tbody {
	color: <?php print $translucence_options['right01-text-color']?>;
}

#primary #wp-calendar a {
	border-bottom: 1px dotted <?php print $translucence_options['right01-link-color']?>;
	padding: 2px;
}

#primary #wp-calendar a:hover {
	border-bottom: 1px solid <?php print $translucence_options['right01-link-color']?>;
}

#primary .widget_pages li.current_page_item,  
#primary .widget_categories li.current-cat,
#primary .widget_nav_menu li.current-menu-item {
	background-color: <?php print $translucence_options['right01-highlight-color-rgb']?>;
	padding: 3px;
	border: 1px solid <?php print $translucence_options['right01-border-color']?>;
}

<?php 
if ($translucence_options['right01-visibility'] == "none") {
	ob_end_clean();
	ob_start(); 
}

$variation_css .= ob_get_clean();
ob_start(); 
?>

#secondary {
	margin-top: <?php print $translucence_options['right02-margin-top']?>px;
	margin-right: <?php print $translucence_options['right02-margin-right']?>px;
	color: <?php print $translucence_options['right02-text-color']?>;
	background-color: <?php print $translucence_options['right02-color-rgb']?>;	
	border: 1px <?php print $translucence_options['right02-border-style']?> <?php print $translucence_options['right02-border-color']?>;
	width: <?php print $translucence_options['right02-width']?>px;
	display: <?php print $translucence_options['right02-visibility']?>;
	padding-top: 15px;
	padding-left: <?php print $translucence_options['right02-padding']?>px;
	padding-right: <?php print $translucence_options['right02-padding']?>px;
}

#secondary:hover {
	background-color: <?php print $translucence_options['right02-color-hover-rgb']?>;
	border: 1px <?php print $translucence_options['right02-hover-border-style']?> <?php print $translucence_options['right02-border-color']?>;
}

#secondary a {
	color: <?php print $translucence_options['right02-link-color']?>;
}

#secondary a:hover {
	color: <?php print $translucence_options['right02-link-color']?>;
	border-bottom: 1px solid <?php print $translucence_options['right02-link-color']?>;
}

#secondary .page_item a:hover {
	color: <?php print $translucence_options['right02-link-color']?>;
	border: 1px dotted <?php print $translucence_options['right02-border-color']?>;
}

#secondary h2, #secondary h3 {
	color: <?php print $translucence_options['right02-heading-color']?>;
	border-bottom: 1px none #CCCCCC;
}

#secondary ul ul li, #secondary ul ol li {
	color: <?php print $translucence_options['right02-text-color']?>;
}

#secondary  #searchform #s {
	background: url(<?php print get_template_directory_uri() ?>/images/search.png) no-repeat 5px 6px;
	background-color: <?php print $translucence_options['searchbox-color']?>;
	color: <?php print $translucence_options['linkcolor']?>;
}

#secondary #wp-calendar tbody {
	color: <?php print $translucence_options['right02-text-color']?>;
}

#secondary #wp-calendar a {
	border-bottom: 1px dotted <?php print $translucence_options['right02-link-color']?>;
	padding: 2px;
}

#secondary #wp-calendar a:hover {
	border-bottom: 1px solid <?php print $translucence_options['right02-link-color']?>;
}

#secondary .widget_pages li.current_page_item,
#secondary .widget_pages li.current-cat,
#secondary .widget_nav_menu li.current-menu-item {
	background-color: <?php print $translucence_options['right02-highlight-color-rgb']?>;
	padding: 3px;
	border: 1px solid <?php print $translucence_options['right02-border-color']?>;
}

<?php 
if ($translucence_options['right02-visibility'] == "none") {
	ob_end_clean();
	ob_start(); 
}

$variation_css .= ob_get_clean();
ob_start(); 
?>


#footer-widget-area {
	border: 1px <?php print $translucence_options['bottom-border-style']?> <?php print $translucence_options['bottom-border-color']?>;		
	color:  <?php print $translucence_options['bottom-text-color']?>;
	background-color: <?php print $translucence_options['bottom-color-rgb']?>;	
	width: <?php print $translucence_options['site-width']?>px;
}

#footer-widget-area:hover {
	background-color: <?php print $translucence_options['bottom-color-hover-rgb']?>;
	border: 1px <?php print $translucence_options['bottom-hover-border-style']?> <?php print $translucence_options['bottom-border-color']?>;		
}	

#footer-widget-area .widget-area {
	background-color: transparent;
	width: <?php print $translucence_options['footer-widget-width']?>px;
}


/* Begin widget links */


/* Begin toggle links */

#content .togglelink {
	background-color: <?php print $translucence_options['content-color-rgb']?>;
	color: <?php print $translucence_options['textcolor']?>;
}

#primary .togglelink,
#secondary .togglelink,
#tertiary .togglelink {
	color: <?php print $translucence_options['textcolor']?>;
}

#content .togglelink:hover, 
#primary .togglelink:hover,
#secondary .togglelink:hover, 
#tertiary .togglelink:hover {
	color: <?php print $translucence_options['linkcolor']?>;
}


/* Begin footer widget area */

#footer-widget-area a {
	color: <?php print $translucence_options['bottom-link-color']?>;		
}

#footer-widget-area a:hover {
	color: <?php print $translucence_options['bottom-link-color']?>;	
	border-bottom: 1px solid <?php print $translucence_options['bottom-link-color']?>;	
}


/* End widget links */

/* Begin widget headings */

#footer-widget-area h2, #footer-widget-area h3 {
	color: <?php print $translucence_options['bottom-heading-color']?>;
	border-bottom: 1px solid <?php print $translucence_options['bottom-heading-color']?>;
}
/* End widget headings */

/* Begin widget list css */

#footer-widget-area ul ul li, .footer-widget-area ul ol li {
	color: <?php print $translucence_options['bottom-text-color']?>;
}
/* End widget list css */

/* Begin sidebar search form */
/* End widget search form */

/* Begin sidebar calendar */

#footer-widget-area #wp-calendar tbody {
	color: <?php print $translucence_options['bottom-text-color']?>;
}

#footer-widget-area #wp-calendar a {
	border-bottom: 1px dotted <?php print $translucence_options['bottom-link-color']?>;
	padding: 2px;
}

#footer-widget-area #wp-calendar a:hover {
	border-bottom: 1px solid <?php print $translucence_options['bottom-link-color']?>;
}


/* End sidebar calendar */

/* Begin widget area separators */
#colophon {
	border-top: 1px <?php print $translucence_options['colophon-border-type']?> #000;
}
						
/* End widget area separators */

/* End Widget Areas (primary, secondary, tertiary, footer-widget-area)

-------------------------------------------------------------- */	
/* =Access (top navigation bar)
-------------------------------------------------------------- */
			
#access {
	color: <?php print $translucence_options['top-text-color']?>;
	background-color: <?php print $translucence_options['top-color-rgb']?>;
	border: 1px <?php print $translucence_options['top-border-style']?> <?php print $translucence_options['top-border-color']?>;	
	width: <?php print $transluncence_options['site-width']?>px;
	margin-top: <?php print $translucence_options['top-margin-top']?>px;
}

#access .menu-header,
div.menu {
	width: <?php print $transluncence_options['site-width']?>px;
}

#access .menu-header,
div.menu,
#main {
	width: <?php print $translucence_options['site-width']?>px;
}

#access a {
	color:  <?php print $translucence_options['top-link-color']?>;
}
			
#access ul ul {
	background: <?php print $translucence_options['top-color-hover02-rgb']?>;
	background: <?php print $translucence_options['top-color-hover02-rgba']?>;
	-moz-box-shadow: 0px 0px 2px <?php print $translucence_options['header-text-shadow-color']?>;
	-webkit-box-shadow: 0px 0px 2px <?php print $translucence_options['header-text-shadow-color']?>;
	box-shadow: 0px 0px 2px <?php print $translucence_options['header-text-shadow-color']?>;	
	border-left: 1px solid <?php print $translucence_options['top-border-left']?>;
	border-right: 1px solid <?php print $translucence_options['top-border-right']?>;
}

#access ul ul a {
	color:  <?php print $translucence_options['top-child-link-color']?>;
}

#access li:hover > a,
#access ul ul:hover > a {
	color:  <?php print $translucence_options['top-child-link-color']?>;
	background-color: <?php print $translucence_options['top-color-hover03']?>;
	-moz-box-shadow: 0px 0px 1px <?php print $translucence_options['header-text-shadow-color']?>;
	-webkit-box-shadow: 0px 0px 1px <?php print $translucence_options['header-text-shadow-color']?>;
	box-shadow: 0px 0px 1px <?php print $translucence_options['header-text-shadow-color']?>;					
	border: 1px solid transparent;
	text-decoration: none;	
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
	-moz-box-shadow: 0px 0px 1px <?php print $translucence_options['header-text-shadow-color']?>;
	-webkit-box-shadow: 0px 0px 1px <?php print $translucence_options['header-text-shadow-color']?>;
	box-shadow: 0px 0px 1px <?php print $translucence_options['header-text-shadow-color']?>;

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



/* End widget navigation
-------------------------------------------------------------- */	

/* =page navigation
-------------------------------------------------------------- */
.breadcrumbs a {
	color: <?php print $translucence_options['linkcolor']?>;
}

.pagenav {
	background-color: <?php print $translucence_options['content-highlight-color-rgb']?>;
	color: <?php print $translucence_options['content-text-color']?>;
}

.pagenav ul .page_item a:hover {
	color: <?php print $translucence_options['linkcolor']?>;
	border: 1px dotted <?php print $translucence_options['linkcolor']?>;
	background-color: transparent;
}

.pagenav a, .pagenav a:visited {
	color: <?php print $translucence_options['entry-link-color']?>;
}

.pagenav ul .current_page_item a {
	color: <?php print $translucence_options['content-text-color']?>;
	border: 1px dotted <?php print $translucence_options['linkcolor']?>;
}

.pagenav .current_page_item > ul.children a {
	font-style: normal;
	color: <?php print $translucence_options['entry-link-color']?>;
}
	
/* =calendar and table css
-------------------------------------------------------------- */	

#wp-calendar tbody td {
	background-color: transparent;
	border: 1px solid transparent;

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

.entry-title a:link,
.entry-title a:visited {
	color: <?php print $translucence_options['linkcolor']?>;
}

/* Entry Headers */
h1, h2, h3, h4 {
	color: <?php print $translucence_options['content-text-color']?>;
}

#entry-author-info #author-description { 
	color: <?php print $translucence_options['content-text-color']?>;
}

#entry-author-info a,
#author-description a { 
	color: <?php print $translucence_options['linkcolor']?>;
}

a:link, a:hover, a:visited, a:active, h2 a:hover, h3 a:hover {
	color: <?php print $translucence_options['linkcolor']?>;
}

a:hover {
	border-bottom:1px solid <?php print $translucence_options['linkcolor']?>;
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

.entry-content a:link,
.entry-content a:visited {
	color: <?php print $translucence_options['linkcolor_visited']?>;		
	border-bottom: 1px <?php print $translucence_options['entry-link-border']?>;
}

.entry-summary a:link {
	color: <?php print $translucence_options['linkcolor']?>;
}

.more-link:hover {
	background-color: transparent;
	color: <?php print $translucence_options['linkcolor']?>;
	border-top: 1px solid <?php print $translucence_options['content-link-color']?>;
	border-bottom: 1px dotted <?php print $translucence_options['content-link-color']?>;
}

.continue-reading:hover {
	color: <?php print $translucence_options['linkcolor']?>;
	border-top: 1px solid <?php print $translucence_options['content-link-color']?>;
	border-bottom: 1px dotted <?php print $translucence_options['content-link-color']?>;
}

/* Entry-content headers */

.entry-content h2, .entry-content h3, .entry-content h1 {
	color: <?php print $translucence_options['content-text-color']?>;
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
			
.postmetadata.alt:hover {
	border-top: 1px solid <?php print $translucence_options['content-link-color']?>;
}

.postmetadata.alt a {
	color: <?php print $translucence_options['content-link-color']?>;
}

.postmetadata.alt a:hover {
	color: <?php print $translucence_options['content-link-color']?>;
	border-bottom: 1px dotted <?php print $translucence_options['content-link-color']?>;
}

/* Begin tag links */

.tagcloud a {
	border: 1px <?php print $translucence_options['tag-links-border-style']?> transparent;
}

.tagcloud a:hover {
	border: 1px <?php print $translucence_options['tag-links-border-style']?> <?php print $translucence_options['tag-links-link-color']?>;
}


.taglinks a {	
	color: <?php print $translucence_options['tag-links-link-color']?>;	
	background-color: <?php print $translucence_options['tag-links-color-rgb']?>;
	border: 1px <?php print $translucence_options['tag-links-border-style']?> <?php print $translucence_options['tag-links-border-color']?>;	
}

.taglinks a:hover {
	color: <?php print $translucence_options['tag-links-link-color']?>;
	background-color: <?php print $translucence_options['tag-links-color']?>;
	border: 1px <?php print $translucence_options['tag-links-hover-border-style']?> <?php print $translucence_options['tag-links-hover-border-color']?>;
}


/* Begin category links */

.catlinks a {	
	color: <?php print $translucence_options['cat-links-link-color']?>;	
	background-color: <?php print $translucence_options['cat-links-color-rgb']?>;
	border: 1px <?php print $translucence_options['cat-links-border-style']?> <?php print $translucence_options['cat-links-border-color']?>;	
}

.catlinks a:hover {
	background-color: <?php print $translucence_options['cat-links-color']?>;
	border: 1px <?php print $translucence_options['cat-links-hover-border-style']?> <?php print $translucence_options['cat-links-hover-border-color']?>;
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

	$variation_css .= ob_get_contents();
	ob_end_clean();
	return $variation_css;

}
endif;