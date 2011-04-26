<?php
/**
 * 2010 Translucence functions and definitions
 *
 * 2010 Translucence loosely extends the TwentyTen theme.  Most of the original TwentyTen
 * functions are used and then augmented with Translucence functions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, translucence_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyten_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since 2010 Translucence 1.0
 */
 
/**
* Set the content width based on the theme's design and stylesheet.
*
* Used to set the width of images and content. Should be equal to the width the theme
* is designed for, generally via the style.css stylesheet.
*/
if ( ! isset( $content_width ) )
	$content_width = 373;

/**
 * Get the translucence config.
*/

 if (!function_exists('translucence_add_config')) {
	function translucence_add_config() {
	   if (file_exists(dirname(__FILE__).'/config.php')) {
			require_once('config.php');
		} else if (file_exists(dirname(__FILE__).'/config-sample.php')) {
			require_once('config-sample.php');
		}
	return $translucence_config;
	}
}
 
// this theme may have child themes that override this config.
$translucence_config = translucence_add_config();

$current_widgets = get_option ('sidebars_widgets');
//printpre($current_widgets);
//printpre($_COOKIE);

require_once( get_template_directory() . '/template-options.php');
require_once( get_template_directory() . '/options-css.php');


/** Tell WordPress to run translucence_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'translucence_setup' );

/** Tell WordPress to add theme options css when the 'wp-head' hook is run in header.php */
add_action('wp_head', 'translucence_add_options_css');


if ( ! function_exists( 'translucence_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override translucence_setup() in a child theme, add your own translucence_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since 2010 Translucence 1.0
 */
function translucence_setup() {
	global $translucence_config;
	global $translucence_options, $translucence_options_values, $translucence_variations;
	global $translucence_options_id;

	/*********************************************************
	 * set options version
	 *********************************************************/ 
	$translucence_options_version = "2.3.1";
	
	/*********************************************************
	 * Register theme javascript
	 *********************************************************/ 
	 
	// front end javascript
	if ( !is_admin() ) { 
	   wp_enqueue_script('jquery');      
	}
	
	if ( !is_admin() ) { 
		wp_register_script('display.control', get_template_directory_uri() . '/js/display.control.js');
		wp_enqueue_script('display.control');
	} else {
		wp_register_script('admin.control', get_template_directory_uri(). '/js/admin.control.js');
		wp_enqueue_script('admin.control');	
	}
	
	// include theme options
	require_once ( get_template_directory() . '/functions/theme-options.php' );
	
	//define name of theme options and css
	$theme_id = strtolower($translucence_config['theme-name']);
	$theme_id = str_replace(" ", "_", $theme_id);
 	$translucence_options_id = $theme_id."_options";

	// initialize or get theme options	
	if (is_array(get_option($theme_id."_settings"))) {
		$translucence_options = get_option($theme_id."_settings");
		delete_option($theme_id."_settings"); 
		
	} else if (!is_array(get_option($translucence_options_id))) {
		add_option($translucence_options_id, array('init' => 1));
	} else {	
		$translucence_options = get_option($translucence_options_id);
	}
	
	if ( is_admin() ) {
		translucence_theme_options_update();
	}

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( '2010-translucence', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', '2010-translucence' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	//define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	//define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
	//define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyten_header_image_width', 940 ) );
	//define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyten_header_image_height', 198 ) );
	
	//$header_image = "%s/variations/".$translucence_config['header_image_options'][$translucence_options['header-image-options']]['option_value'];
	
	$header_image_width = $translucence_options['site-width'] - $translucence_options['custom-header-width-offset'];
	$header_image_height = $translucence_options['header-block-height'];
	//$header_image = $translucence_options['header-block-height'];	
	
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'translucence_header_image_width', $header_image_width ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'translucence_header_image_height', $header_image_height ) );
	define( 'HEADER_TEXTCOLOR', $translucence_options['site-title-color']);
	define( 'HEADER_BGCOLOR', $translucence_options['header-color-rgb']);
	//define( 'NO_HEADER_TEXT', true );
	define( 'NO_HEADER_DESCRIPTION', true );	
	

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See translucence_admin_header_style(), below.
	add_custom_image_header( 'translucence_header_style', 'translucence_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( $translucence_config['custom_header'] );
}
endif;

 /**
 * Adds custom CSS generated in options-css.php
 *
 * Referenced via wp_head() function in header.php
 *
 * @since 2010 Translucence 1.0
 */

function translucence_add_options_css() {
	global $translucence_options, $translucence_options_id; 
	
	print "<style type='text/css'>";
	print $translucence_options['css'];

	// IE hack opacity options
	print $translucence_options['header-color-ie']."\n"; 
	print $translucence_options['title-box-color-ie']."\n"; 
	print $translucence_options['description-box-color-ie']."\n"; 
	print $translucence_options['right02-color-ie']."\n"; 
	print $translucence_options['top-color-ie']."\n"; 
	print $translucence_options['submenu-color-ie']."\n"; 
	print $translucence_options['content-color-ie']."\n"; 
	print $translucence_options['bottom-color-ie']."\n"; 
	print $translucence_options['left01-color-ie']."\n"; 
	print $translucence_options['right01-color-ie']."\n"; 
	print $translucence_options['right02-color-ie']."\n"; 
	print "</style>";
}

 /**
 * Styles the header image displayed in blog
 *
 * Referenced via wp_head() function in header.php
 *
 * @since 2010 Translucence 1.0
 */

function translucence_header_style() {
	global $post, $translucence_options, $translucence_config;
	
	if ( is_singular() &&
	has_post_thumbnail( $post->ID ) &&
	( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) )  ) {
		$custom_header = $image[0];
	} else {
		$custom_header = get_header_image();
	}
	
	if ($custom_header == "" && $translucence_options['header-image-options'] != "none") {
		$header_image = $translucence_config['custom_header'][$translucence_options['header-image-options']]['url'];
		$custom_header = str_replace('%s', '', $header_image);
		$custom_header = get_template_directory_uri().$custom_header;
	}

	?>	
	<style type="text/css">
	.headerblock {
		background-color: <?php echo HEADER_BGCOLOR; ?>;
		<?php if ($custom_header != "") print "background-image: url('".$custom_header."');\n"; ?>
		background-position: right;
		background-repeat: no-repeat;
	}
	</style>	
	<?php	
}

/**
 * Register widgetized areas, including three sidebars and four widget-ready columns in the footer.
 *
 * To override translucence_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since 2010 Translucence
 * @uses register_sidebar
 */

function translucence_widgets_init() {
	global $translucence_config, $current_widgets;
	
	// Area 1, located at the 1st right sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', '2010-translucence' ),
		'id' => 'primary-widget-area',
		'description' => __( '1st Right Sidebar', '2010-translucence' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located in the 2nd right sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', '2010-translucence' ),
		'id' => 'secondary-widget-area',
		'description' => __( '2nd Right Sidebar', '2010-translucence' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the left sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Tertiary Widget Area', '2010-translucence' ),
		'id' => 'tertiary-widget-area',
		'description' => __( 'Left Sidebar', '2010-translucence' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', '2010-translucence' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', '2010-translucence' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', '2010-translucence' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', '2010-translucence' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', '2010-translucence' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', '2010-translucence' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 7, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', '2010-translucence' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', '2010-translucence' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	// Pre-set Widgets
	if (isset($translucence_config['preset_widgets']) && is_array($translucence_config['preset_widgets'])) {
		$preset_widgets = $translucence_config['preset_widgets'];
	} else {	
		$preset_widgets = array (
			'primary-widget-area'  => array( 'pages-2', 'recent-posts-2', 'categories-2' ),
			'secondary-widget-area'  => array( 'links-2', 'rss-links-2' )
			);
	}
	

	// set default widgets only if no widgets have been set for the site
    if ( isset( $_GET['activated'] )) {
		$widgets_state = 1;
		$primary_widgets = 1;
		$secondary_widgets = 1;
		$tertiary_widgets = 1;
		
		if (!isset($current_widgets['primary-widget-area']) || count($current_widgets['primary-widget-area']) == 0) $primary_widgets = 0;
		if (!isset($current_widgets['secondary-widget-area']) || count($current_widgets['secondary-widget-area']) == 0) $secondary_widgets = 0;
		if (!isset($current_widgets['tertiary-widget-area']) || count($current_widgets['tertiary-widget-area']) == 0) $tertiary_widgets = 0;
		
		if ($primary_widgets == 0 && $secondary_widgets == 0 && $tertiary_widgets == 0) $widgets_state = 0;
    
    	if ($widgets_state == 0) {    
			update_option( 'widget_search', array( 2 => array( 'title' => '' ), '_multiwidget' => 1 ) );
			update_option( 'widget_pages', array( 2 => array( 'title' => ''), '_multiwidget' => 1 ) );
			update_option( 'widget_recent-posts', array( 2 => array( 'title' => '', 'number' => 5 ), '_multiwidget' => 1 ) );
			update_option( 'widget_recent-comments', array( 2 => array( 'title' => '', 'number' => 5 ), '_multiwidget' => 1 ) );
			update_option( 'widget_categories', array( 2 => array( 'title' => '', 'count' => 0, 'hierarchical' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
			update_option( 'widget_archives', array( 2 => array( 'title' => '', 'count' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
			update_option( 'widget_links', array( 2 => array( 'title' => ''), '_multiwidget' => 1 ) );
			update_option( 'widget_rss-links', array( 2 => array( 'title' => ''), '_multiwidget' => 1 ) );
	
			update_option( 'sidebars_widgets', apply_filters('translucence_preset_widgets',$preset_widgets ));
  		}
  	}
  	
}

// Runs our code at the end to check that everything needed has loaded
add_action( 'widgets_init', 'translucence_widgets_init' );

 /**
 * Adds breadcrumbs to child pages
 *
 * Referenced on all page templates
 *
 * @since 2010 Translucence 1.0
 * @return string link to parent page
 */

function translucence_get_breadcrumbs($post) {

	$parent_title = get_the_title($post->post_parent);
	$parent_url = get_permalink($post->post_parent);
	$post_title = get_the_title($post);

	if ($parent_title != $post_title) { 
		$breadcrumbs = "<div class='breadcrumbs'>";
		$breadcrumbs .= "<a href='".$parent_url."'";
		$breadcrumbs .= " title='".$parent_title ."'>".$parent_title."</a> &raquo; ";
		$breadcrumbs .= get_the_title($post);
		$breadcrumbs .= "</div>";
	} else {
		$breadcrumbs = null;
	}

	return $breadcrumbs;
}


/******************************************************************************
 * Get Content Width
 * gets the width of the content column depending on what template is being used
 * template values: page, archives, search, author, category, tag, post
 *
 * @since 2010 Translucence 1.0
 * @return int width of content box in pixels
 ******************************************************************************/

function translucence_get_content_width ($template) {
	global $translucence_options;

	if ($template == "page") {
		$width_adjust = 50;
		if ($translucence_options['left01-width'] == 0) {
			$left01_width = 0;
		} else {
			$left01_width = $translucence_options['left01-width']+$width_adjust;
		}
		
		if ($translucence_options['right01-width'] == 0) {
			$right01_width = 0;
		} else {
			$right01_width = $translucence_options['right01-width']+$width_adjust;
		}

		if ($translucence_options['right02-width'] == 0) {
			$right02_width = 0;
		} else {
			$right02_width = $translucence_options['right02-width']+$width_adjust;
		}
		
		$content_width = $translucence_options['site-width'] -  ($left01_width + $right01_width + $right02_width + 70);
		
	} else {
	
		if ($translucence_options[$template.'-sidebar-left-display'] != "show" ) {
			$left01_width = 0;
		} else {
			$left01_width = $translucence_options['left01-width']+50;
		}
		
		if ($translucence_options[$template.'-sidebar-right-display'] != "show" ) {
			$right01_width = 0;
		} else {
			$right01_width = $translucence_options['right01-width']+50;
		}
		
		if ($translucence_options[$template.'-sidebar-right02-display'] != "show" ) {
			$right02_width = 0;
		} else {
			$right02_width = $translucence_options['right02-width']+50;
		}
		
		$content_width = $translucence_options['site-width'] -  $left01_width - $right01_width - $right02_width - 70;
	}
	
	//$content_width = $translucence_options['site-width'] -  $left01_width - $right01_width - $right02_width - 70;
	return $content_width;
}

 /**
 * Gets the width of various areas of layout
 * depending on which sidebars are displayed
 * and what type of template is loaded
 *
 * @since 2010 Translucence 1.0
 * @return int comma-separated list of box widths
 */

function translucence_get_box_widths ($box = 'all') {
	global $translucence_options;
	
	if (is_single()) {
		$content_width = translucence_get_content_width ("post");
	} else if (is_category()){
		$content_width = translucence_get_content_width ("category");
	} else if (is_tag()){
		$content_width = translucence_get_content_width ("tag");
	} else if (is_author()){
		$content_width = translucence_get_content_width ("author");
	} else if (is_search()){
		$content_width = translucence_get_content_width ("search");
	} else if (is_archive()){
		$content_width = translucence_get_content_width ("archives");
	} else {
		if (is_page_template('page-right01-sidebar.php')) {
			$content_width = $translucence_options['site-width'] - $translucence_options['right01-width'] - 125;
		} else if (is_page_template('page-right02-sidebar.php')) {
			$content_width = $translucence_options['site-width'] - $translucence_options['right02-width'] - 125;
		} else if (is_page_template('page-right-both-sidebar.php')) {
			$content_width = $translucence_options['site-width'] - $translucence_options['right01-width']  - $translucence_options['right02-width'] - 175;
		} else if (is_page_template('page-left-sidebar.php')) {
			$content_width = $translucence_options['site-width'] - $translucence_options['left01-width'] - 125;
		} else if (is_page_template('page-left-right01-sidebar.php')) {
			$content_width = $translucence_options['site-width'] - $translucence_options['left01-width'] - $translucence_options['right01-width'] - 175;
		} else if (is_page_template('page-left-right02-sidebar.php')) {
			$content_width = $translucence_options['site-width'] - $translucence_options['left01-width'] - $translucence_options['right02-width'] - 175;
		} else {
			$content_width = translucence_get_content_width ("page");
		}
	}
	
	$box_widths = $translucence_options['right01-width'].",";
	$box_widths .= $translucence_options['right02-width'].",";
	$box_widths .= $translucence_options['left01-width'].",";
	$box_widths .= $content_width;
	
	if ($box == "content") {
		return $content_width;
	} else {
		return $box_widths;
	}
	//return $content_width;

}

if ( ! function_exists( 'translucence_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in translucence_setup().
 *
 * @since Translucence 1.0
 */
function translucence_admin_header_style() {
global $translucence_options;
?>
	<style type='text/css'>

		#headimg {
			background-color: <?php echo HEADER_BGCOLOR; ?> 
			background-image: url(<?php header_image(); ?>) 0 0;
			background-position: right;
			background-repeat: no-repeat;
			width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
			height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
		}

		#headimg #name a { 
			color: <?php print $translucence_options['site-title-color'] ?>;
		}
		#headimg #desc { 
			color: <?php print $translucence_options['site-description-color'] ?>;
		}
	
	</style>

<?php
}
endif;

/**
 * Get links to sub or related pages
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Tranlucence 2.3.1
 */
function translucence_page_links($post, $order) {

	if ($post->post_parent) {
		$children = wp_list_pages("title_li=<h3>Related Pages </h3>&child_of=".$post->post_parent."&echo=0");
		$num_children = get_pages("child_of=".$post->post_parent);
	} else {
		$children = wp_list_pages("title_li=<h3>Sub Pages</h2>&child_of=".$post->ID."&echo=0");
		$num_children = get_pages("child_of=".$post->ID);
	}
	
	if ($_COOKIE['hidetoc'] == 1) {
		$page_links_label = "[".__( 'show page links', '2010-translucence' )."]";
	} else {
		$page_links_label = "[".__( 'hide page links', '2010-translucence' )."]";
	}
							
	if (count($num_children) > 1 && $order == "before") { 
		print "<div id='toc' class='toc'>";
		print "<div class='toggle'>";
		print "<a id='togglelink' href='javascript:toggleToc()'>".$page_links_label."</a>";
		print "</div>";
		print "<ul style='".translucence_page_links_display()."'>";
		print $children;
		print "</ul>";						
		print "</div>"; 
	} else if (count($num_children) > 1 && $order == "after") {
		print $children;
	}
	

}

 /**
 * Sets display of page links
 * based on document cookie
 *
 * @since 2010 Translucence 1.0
 * @return css display: none; or display: block;
 */

function translucence_page_links_display() {	

	if ($_COOKIE['hidetoc'] == 1 && !is_admin()) {
		$display = "display: none;";
	} else {
		$display = "display: block;";
	}
	
	return $display;
}

 /**
 * Adds links to toggle display of sidebars
 *
 *
 * @since 2010 Translucence 1.0
 */

function translucence_toggle_links() {	
	?>
	<div class="toggle" style="float: left;">
	<a id="togglecontenttertiary" href="javascript:toggle('tertiary','content',<?php print translucence_get_box_widths(); ?>)">&nbsp;</a>
	</div>
	<div class="toggle" style="float: right;">
	<a id="togglecontentsecondary" href="javascript:toggle('secondary','content',<?php print translucence_get_box_widths(); ?>)">&nbsp;</a>
	</div>
	<div class="toggle">
	<a id="togglecontentprimary" href="javascript:toggle('primary','content',<?php print translucence_get_box_widths(); ?>)">&nbsp;</a>
	</div>
	<?php
}

 /**
 * Sets display of specified box
 * based on document cookie
 *
 * @since 2010 Translucence 1.0
 */

function translucence_box_display ($box) {
	global $translucence_options;
	
	$cookie_name = "hide".$box;
				
	if ($_COOKIE[$cookie_name] == 1 && !is_admin()) {		
		print "display: none; width: 0px;";
	} else {
		if ($box == "primary") {			
			$box_width = $translucence_options['right01-width'];
		} else if ($box == "secondary") {
			$box_width = $translucence_options['right02-width'];
		} else if ($box == "tertiary") {
			$box_width = $translucence_options['left01-width'];
		}
		print "display: block; width: ".$box_width."px;";
	}		

}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function twentyten_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function twentyten_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', '2010-translucence' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function twentyten_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyten_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyten_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyten_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

if ( ! function_exists( 'twentyten_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', '2010-translucence' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', '2010-translucence' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', '2010-translucence' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', '2010-translucence' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', '2010-translucence' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', '2010-translucence'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {
	printf( __( '<span class="%1$s"></span> %2$s <span class="meta-sep">by</span> %3$s', '2010-translucence' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', '2010-translucence' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', '2010-translucence' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', '2010-translucence' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', '2010-translucence' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


/*********************************************************
 * debugging
 *********************************************************/


function printpre($array, $return=FALSE) {
	ob_start();
	print "\n<pre>";
	print_r($array);
	print "\n</pre>";
	
	if ($return)
		return ob_get_clean();
	else
		ob_end_flush();
}

?>
