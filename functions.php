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
 * The first function, translucene_setup(), sets up the theme by registering support
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
 * @subpackage 2010 Translucence
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
	return $variation_config;
	}
}
 
// this theme may have child themes that override this config.
$variation_config = translucence_add_config();

$current_widgets = get_option ('sidebars_widgets');
//printpre($current_widgets);

require_once( get_template_directory() . '/template-options.php');
require_once( get_template_directory() . '/options-css.php');


/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
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
	global $variation_config;
	global $_POST, $options, $options_values, $variations;
	global $theme_options;

	
	/*********************************************************
	 * Register theme javascript
	 *********************************************************/ 
	 
	// front end javascript
	if ( !is_admin() ) { 
	 //  wp_enqueue_script('jquery');      
	}
	
	wp_register_script('display.control', get_bloginfo('template_directory') . '/js/display.control.js');
	wp_enqueue_script('display.control');
	
	// include theme options
	require_once ( get_template_directory() . '/functions/theme-options.php' );
	
	//define name of theme options and css
	$theme_id = strtolower($variation_config['theme-name']);
	$theme_id = str_replace(" ", "_", $theme_id);
 	$theme_options = $theme_id."_options";

	// initialize or get theme options
	if (!is_array(get_option($theme_options))) {
		add_option($theme_options, array('init' => 1));
	} else {	
		$options = get_option($theme_options);
	}

	// initialize or get theme css	
	if (!isset($options['css'])) {
		translucence_get_variation_options();
	} else if (isset($options['options-version']) && ($options['options-version'] != $options['variation-version'])) {
		$options['options-version'] = $options['variation-version'];
	}
	
	translucence_theme_options_save();
	
	//printpre($options);

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'twentyten' ),
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
	
	//$header_image = "%s/variations/".$variation_config['header_image_options'][$options['header-image-options']]['option_value'];
	
	$header_image_width = $options['site-width'] - $options['custom-header-width-offset'];
	$header_image_height = $options['header-block-height'];
	//$header_image = $options['header-block-height'];	
	
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyten_header_image_width', $header_image_width ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyten_header_image_height', $header_image_height ) );
	//define( 'HEADER_TEXTCOLOR', $options['site-title-color']);
	define( 'HEADER_BGCOLOR', $options['header-color-rgb']);
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
	register_default_headers( $variation_config['custom_header'] );
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
	global $options, $theme_options; 
	
	print "<style type='text/css'>";
	print $options['css'];

	// IE hack opacity options
	print $options['header-color-ie']."\n"; 
	print $options['title-box-color-ie']."\n"; 
	print $options['description-box-color-ie']."\n"; 
	print $options['right02-color-ie']."\n"; 
	print $options['top-color-ie']."\n"; 
	print $options['submenu-color-ie']."\n"; 
	print $options['content-color-ie']."\n"; 
	print $options['bottom-color-ie']."\n"; 
	print $options['left01-color-ie']."\n"; 
	print $options['right01-color-ie']."\n"; 
	print $options['right02-color-ie']."\n"; 
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
	global $post, $options, $variation_config;
	
	if ( is_singular() &&
	has_post_thumbnail( $post->ID ) &&
	( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) )  ) {
		$custom_header = $image[0];
	} else {
		$custom_header = get_header_image();
	}
	
	if ($custom_header == "" && $options['header-image-options'] != "none") {
		$header_image = $variation_config['custom_header'][$options['header-image-options']]['url'];
		$custom_header = str_replace('%s', '', $header_image);
		$custom_header = get_bloginfo('template_directory').$custom_header;
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
	}

	return $breadcrumbs;
}


/******************************************************************************
 * Get Content Width
 * gets the width of the content column depending on what template is being used
 * template values: page, archives, search, author, category, tag, post
 ******************************************************************************/

function translucence_get_content_width ($template) {
	global $options;

	if ($template == "page") {
		$width_adjust = 50;
		if ($options['left01-width'] == 0) {
			$left01_width = 0;
		} else {
			$left01_width = $options['left01-width']+$width_adjust;
		}
		
		if ($options['right01-width'] == 0) {
			$right01_width = 0;
		} else {
			$right01_width = $options['right01-width']+$width_adjust;
		}

		if ($options['right02-width'] == 0) {
			$right02_width = 0;
		} else {
			$right02_width = $options['right02-width']+$width_adjust;
		}
		
		$content_width = $options['site-width'] -  ($left01_width + $right01_width + $right02_width + 70);
		
	} else {
	
		if ($options[$template.'-sidebar-left-display'] != "show" ) {
			$left01_width = 0;
		} else {
			$left01_width = $options['left01-width']+50;
		}
		
		if ($options[$template.'-sidebar-right-display'] != "show" ) {
			$right01_width = 0;
		} else {
			$right01_width = $options['right01-width']+50;
		}
		
		if ($options[$template.'-sidebar-right02-display'] != "show" ) {
			$right02_width = 0;
		} else {
			$right02_width = $options['right02-width']+50;
		}
		
		$content_width = $options['site-width'] -  $left01_width - $right01_width - $right02_width - 70;
	}
	
	//$content_width = $options['site-width'] -  $left01_width - $right01_width - $right02_width - 70;
	return $content_width;
}

function translucence_get_box_widths () {
	global $options;
	
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
			$content_width = $options['site-width'] - $options['right01-width'] - 125;
		} else if (is_page_template('page-right02-sidebar.php')) {
			$content_width = $options['site-width'] - $options['right02-width'] - 125;
		} else if (is_page_template('page-right-both-sidebar.php')) {
			$content_width = $options['site-width'] - $options['right01-width']  - $options['right02-width'] - 175;
		} else if (is_page_template('page-left-sidebar.php')) {
			$content_width = $options['site-width'] - $options['left01-width'] - 125;
		} else if (is_page_template('page-left-right01-sidebar.php')) {
			$content_width = $options['site-width'] - $options['left01-width'] - $options['right01-width'] - 175;
		} else if (is_page_template('page-left-right02-sidebar.php')) {
			$content_width = $options['site-width'] - $options['left01-width'] - $options['right02-width'] - 175;
		} else {
			$content_width = translucence_get_content_width ("page");
		}
	}
	
	$box_widths = $options['right01-width'].",";
	$box_widths .= $options['right02-width'].",";
	$box_widths .= $options['left01-width'].",";
	$box_widths .= $content_width;
	
	return $box_widths;

}

/**
 * Preset widgets, including three sidebars and four widget-ready columns in the footer.
 *
 * preset widgets defined in the theme config.php
 *
 * @since 2010 Translucence
 * @uses register_sidebar
 */


 $current_theme = get_option( 'template' ); // variable stores the current theme
 $target_theme = $variation_config['theme-name']; // variable stores the theme we want to target

// add preset widgets only if theme is 1st activated and has not been activated previously
if (isset($_POST['default_widgets']) || (isset( $_GET['activated'] ) && $current_theme == $target_theme && !get_option($options['css']))) {
	update_option( 'widget_search', array( 2 => array( 'title' => '' ), '_multiwidget' => 1 ) );
	update_option( 'widget_recent-posts', array( 2 => array( 'title' => '', 'number' => 5 ), '_multiwidget' => 1 ) );
	update_option( 'widget_recent-comments', array( 2 => array( 'title' => '', 'number' => 5 ), '_multiwidget' => 1 ) );
	update_option( 'widget_archives', array( 2 => array( 'title' => '', 'count' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
	update_option( 'widget_categories', array( 2 => array( 'title' => '', 'count' => 0, 'hierarchical' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
	update_option( 'widget_tag_cloud', array( 2 => array( 'title' => ''), '_multiwidget' => 1 ) );
	update_option( 'widget_pages', array( 2 => array( 'title' => ''), '_multiwidget' => 1 ) );

	update_option( 'sidebars_widgets', $preset_widgets);		
}

if ( ! function_exists( 'translucence_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyten_setup().
 *
 * @since Translucence 1.0
 */
function translucence_admin_header_style() {
global $options;
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
			color: <?php print $options['site-title-color'] ?>;
		}
		#headimg #desc { 
			color: <?php print $options['site-description-color'] ?>;
		}
	
	</style>

<?php
}
endif;

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
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a>';
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
			<?php printf( __( '%s <span class="says">says:</span>', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );
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
		<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'twentyten'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


/**
 * Register widgetized areas, including three sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since 2010 Translucence
 * @uses register_sidebar
 */
function twentyten_widgets_init() {
	// Area 1, located at the 1st right sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( '1st Right Sidebar', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located in the 2nd right sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'twentyten' ),
		'id' => 'secondary-widget-area',
		'description' => __( '2nd Right Sidebar', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the left sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Tertiary Widget Area', 'twentyten' ),
		'id' => 'tertiary-widget-area',
		'description' => __( 'Left Sidebar', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'twentyten' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'twentyten' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'twentyten' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 7, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'twentyten' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );

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
	printf( __( '<span class="%1$s"></span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
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
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
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
