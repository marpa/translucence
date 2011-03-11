<?php
/**
 * TwentyTen functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyten_setup(), sets up the theme by registering support
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
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
 
 //error_reporting(E_ALL);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once("template-options.php");
require_once("options-css.php");

/**
 * Sets up theme defaults and registers support for various WordPress features.
*/

/*********************************************************
 * Define theme id, settings, css and options
 *********************************************************/
 if (!function_exists('add_translucence_config')) {
	function add_translucence_config() {
	   if (file_exists(dirname(__FILE__).'/config.php')) {
			require_once('config.php');
		} else if (file_exists(dirname(__FILE__).'/config-sample.php')) {
			require_once('config-sample.php');
		}
	return $variation_config;
	}
}
 
// this theme may have child themes that override this config.
$variation_config = add_translucence_config();
$theme_options = $variation_config['theme-name']." Options";

$current_widgets = get_option ('sidebars_widgets');
//printpre($current_widgets);

/*********************************************************
 * Setup admin menu
 *********************************************************/ 

add_action('admin_menu', 'variation_admin_menu');

function variation_admin_menu() {
	global $theme_options, $variation_config;
	
    add_theme_page($theme_options, $theme_options, 'edit_theme_options', 'Variations', 'variation_options');
}

function add_menu_admin_bar() {
    global $wp_admin_bar;
    
    if ( !current_user_can( 'switch_themes' ) || !is_admin_bar_showing() )
        return; 
        
    $wp_admin_bar->add_menu( array( 'parent' => 'appearance', 'title' =>__( 'Design', 'design' ), 'href' => admin_url('admin.php')."/themes.php?page=Variations" ) );
}
add_action( 'admin_bar_menu', 'add_menu_admin_bar' ,  70);


/*********************************************************
 * Register theme javascript
 *********************************************************/ 
 
// front end javascript
if ( !is_admin() ) { 
 //  wp_enqueue_script('jquery');      
}

wp_register_script('display.control', get_bloginfo('template_directory') . '/js/display.control.js');
wp_enqueue_script('display.control');

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 373;

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'translucence_setup' );

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
	global $options, $variation_config, $variation_css;
	global $_POST, $options, $options_values, $variations;
	global $theme_settings, $theme_css;
	
	// this theme may have child themes that override this config.
	//$variation_config = add_translucence_config();
	
	// include theme options
	require_once ( get_template_directory() . '/functions/theme-options.php' );

	//create theme id
	$theme_id = strtolower($variation_config['theme-name']);
	$theme_id = str_replace(" ", "_", $theme_id);
	
	//define name of theme options and css
	$theme_settings = $theme_id."_settings";
	$theme_css = $theme_id."_css";
	$theme_options = $variation_config['theme-name']." Options";
	
	// initialize or get theme options
	if (!is_array(get_option($theme_settings))) {
		add_option($theme_settings, array('init' => 1));    
	} else {	
		$options = get_option($theme_settings);
	}
	
	// initialize or get theme css
	if (!get_option($theme_css)) {
		add_option($theme_css, "");	
		// define theme url and name
		
		set_variation_options();
		save_options();
		
		update_option($theme_settings, $options);
		update_option($theme_css, $variation_css);	

	} else if ($options['options-version'] != $options['variation-version']) {
		$options['options-version'] = $options['variation-version'];
		set_variation_options();
		save_options();
		update_option($theme_settings, $options);
		update_option($theme_css, $variation_css);		
	}
	
	$variation_css = get_option($theme_css);
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
	// custom headers. See twentyten_admin_header_style(), below.
	add_custom_image_header( 'header_style', 'twentyten_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( $variation_config['custom_header'] );
}
endif;

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
if (isset($_POST['default_widgets']) || (isset( $_GET['activated'] ) && $current_theme == $target_theme && !get_option($theme_css))) {
	update_option( 'widget_search', array( 2 => array( 'title' => '' ), '_multiwidget' => 1 ) );
	update_option( 'widget_recent-posts', array( 2 => array( 'title' => '', 'number' => 5 ), '_multiwidget' => 1 ) );
	update_option( 'widget_recent-comments', array( 2 => array( 'title' => '', 'number' => 5 ), '_multiwidget' => 1 ) );
	update_option( 'widget_archives', array( 2 => array( 'title' => '', 'count' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
	update_option( 'widget_categories', array( 2 => array( 'title' => '', 'count' => 0, 'hierarchical' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
	update_option( 'widget_tag_cloud', array( 2 => array( 'title' => ''), '_multiwidget' => 1 ) );
	update_option( 'widget_pages', array( 2 => array( 'title' => ''), '_multiwidget' => 1 ) );

	update_option( 'sidebars_widgets', $preset_widgets);		
}

if ( ! function_exists( 'twentyten_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyten_setup().
 *
 * @since Twenty Ten 1.0
 */
function twentyten_admin_header_style() {
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
 * Styles the header image displayed in blog
 *
 * Referenced via wp_head() function in header.php
 *
 * @since 2010 Translucence 1.0
 */

function header_style() {
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

function get_breadcrumbs($post) {

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

/*********************************************************
 * ShadowBox theme options
 * renders UI and theme model for chosing and previewing options
 *********************************************************/

function variation_options() {	
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;
    	
	if (isset($_POST['reset']) || $options['revert'] == 1) {
		delete_options();
		save_options(); 
		$options['revert'] = 0;
		
    } else if (isset($_POST['action']) && $_POST['action'] == 'save') {
		save_options();        
	}
	
	//read_css_file("style.css");
	
	set_variation_options();	
			
	update_option($theme_settings, $options);
	update_option($theme_css, $variation_css);

	$options = get_option($theme_settings);
	$variation_css = get_option($theme_css);
	
	$current_widgets = get_option ('sidebars_widgets');	
	
	theme_model();


}	
 if (!function_exists('save_options')) {
	function save_options() {
		global $_POST, $options, $variation_css, $variation_config;
		global $theme_settings, $theme_css;

		// options are those exposed in the UI
		set_primary_options();
	
		// options specific to a particular variation
		set_variation_options();
		
		/******************************************************************************
		 * add theme options to theme CSS
		 ******************************************************************************/

		$variation_css = options_css();	
		update_option($theme_settings, $options);
		update_option($theme_css, $variation_css);
		
		print_option_feedback();
		
	}
}

/*********************************************************
 * set primary options (options exposed to user in model)
 *********************************************************/
 
function set_primary_options() {
	global $_POST, $options, $allowedposttags, $variation_config;
	//printpre($_POST);

	foreach ($variation_config['model'] as $option => $value) {

		//sanitize options that contain HTML
		if ($value == "headerleftcustom") {
			$options['headerleftcustom'] = wp_kses($_POST['headerleftcustom'], $allowedposttags);
		} else if ($value == "footerleftcustom") {
			$options['footerleftcustom'] = wp_kses($_POST['footerleftcustom'], $allowedposttags);
		
		// replaces any characters that are not allowed with null
		} else if (isset($_POST[$value]))  {
			$options[$value] = preg_replace('/[^0-9a-z%#,\.\s-+_\/:~]/i','', stripslashes($_POST[$value]));
		}	
	}
	

	if (isset($_POST['model-instructions'])) {
		$options['model-instructions'] = "on";
	} else if (!isset($_POST['model-instructions']) || $options['model-instructions'] == "off") {
		$options['model-instructions'] = "off";
	} else {
		$options['model-instructions'] = "on";
	}
}

/******************************************************************************
 * get default variation (note: child themes may override this)
 * 
 ******************************************************************************/
if (!function_exists('get_variation_default')) {
	function get_variation_default() {
		if (file_exists(dirname(__FILE__).'/variations/default/variation.php')) {
			$variation_default = dirname(__FILE__).'/variations/default/variation.php';
		}
		return $variation_default;		
	}
}

/******************************************************************************
 * get path to variations source files (note: child themes may override this)
 * 
 ******************************************************************************/

if (!function_exists('get_variations_source')) {
	function get_variations_source() {
	
		if (file_exists(dirname(__FILE__).'/variations/')) {
			$variations_path = dirname(__FILE__).'/variations';
		}
		return $variations_path;
	}
}

/******************************************************************************
 * set options for variations (set with options['background'])
 * 
 ******************************************************************************/

function set_variation_options() {
	global $_POST, $options, $options_values, $variations;

	/******************************************************************************
	 * Default options and option value lists
	 ******************************************************************************/

	if (file_exists(get_variation_default())) {
		$variation_default = get_variation_default();
		include($variation_default);
	} 
	
	/******************************************************************************
	 * Defaults for variations
	 * variations use defaults unless otherwise specified
	 * variations can have default option values and default option value lists
	 * option value lists are the option values users can select in the theme model UI
	 * (variation info in extracted from variation.php file using same functions
	 * used to extract theme info rom theme style.php
	 ******************************************************************************/
	
	$variations = array();
	$themes_allowed_tags = "";
	
	//$variation_path = get_variations_source();
	
	if (file_exists(get_variations_source())) {
		$variation_path = get_variations_source();
		
		if ($handle = opendir($variation_path)) {
			while (false !== ($file = readdir($handle))) {
				
				if (is_dir($variation_path.'/'.$file) && $file !="default") {
					
					if (file_exists($variation_path.'/'.$file.'/variation.php')) {
						include($variation_path.'/'.$file.'/variation.php');
						
						$variation_data = implode( '', file( $variation_path.'/'.$file.'/variation.php' ) );
						$variation_data = str_replace ( '\r', '\n', $variation_data );
						
						// get variation name
						if ( preg_match( '|Variation Name:(.*)$|mi', $variation_data, $variation_name ) )
							$name = $variation = wp_kses( _cleanup_header_comment($variation_name[1]), $themes_allowed_tags );
						else
							$name = $variation = '';
						
						// get variation id
						if ( preg_match( '|Variation ID:(.*)$|mi', $variation_data, $variation_id ) )
							$id = $variation = wp_kses( _cleanup_header_comment($variation_id[1]), $themes_allowed_tags );
						else
							$id = $variation = '';						
						$variations[$name] = $id;
					}
				}
			}			
		}
		closedir($handle);
		
		/******************************************************************************
		 * Override variation background color and image if customs background color
		 * and image have been set
		 ******************************************************************************/
	
		$custom_background_color = get_background_color();
		$custom_background_image = get_background_image();
				
		if ($custom_background_color !="") $options['background_color'] = "#".$custom_background_color;
		if ($custom_background_image !="") $options['background_image'] = $custom_background_image;		

		ksort($variations);
		
	}
		
	// if no variation has been selected then use theme defaults
	if (isset($_POST)) {
		if (!in_array($options['header-color'], array_values($options_values['sidebar-color']))) $options['header-color'] = "#F9F9F9";
		if (!in_array($options['top-color'], array_values($options_values['sidebar-color']))) $options['top-color'] = "#FFFFFF";
		if (!in_array($options['left01-color'], array_values($options_values['sidebar-color']))) $options['left01-color'] = "#F3F3F3";
		if (!in_array($options['content-color'], array_values($options_values['sidebar-color']))) $options['content-color'] = "#FFFFFF";
		if (!in_array($options['right01-color'], array_values($options_values['sidebar-color']))) $options['right01-color'] = "#F3F3F3";
		if (!in_array($options['right02-color'], array_values($options_values['sidebar-color']))) $options['right02-color'] = "#F3F3F3";
		if (!in_array($options['bottom-color'], array_values($options_values['sidebar-color']))) $options['bottom-color'] = "#FFFFFF";
		if (!in_array($options['linkcolor'], array_values($options_values['linkcolor']))) $options['linkcolor'] = "#003366";
		if (!in_array($options['textcolor'], array_values($options_values['textcolor']))) $options['textcolor'] = "#444444";
		if (!in_array($options['entry-link-style'], array_values($options_values['entry-link-style']))) $options['entry-link-style'] = "underline";
		if (!in_array($options['cat-links-color'], array_values($options_values['sidebar-color']))) $options['cat-links-color'] = "#e9e9c9";
		if (!in_array($options['tag-links-color'], array_values($options_values['sidebar-color']))) $options['tag-links-color'] = "#FFF8C6";
	}
	
	set_derivative_options();	
}

/*********************************************************
 * Set derivative options uses primary options (i.e. those exposed in UI)
 * to set derivative options
 *********************************************************/

function set_derivative_options() {
	global $variation_config, $_POST, $options, $options_values, $custom_background_image;

	/******************************************************************************
	 * Site top padding (derived from  site-border-style)
	 ******************************************************************************/
	
	if ($options['site-border-style'] != 'none') {
		$options['site-padding-top'] = "20";
		$options['site-padding-bottom'] = "20";
	} else {
		$options['site-padding-top'] = "10";
		$options['site-padding-bottom'] = "10";
	}
	
	if ($options['site-border-style'] == 'solid') {
		$options['site-border-shadow'] = 5;
	} else {
		$options['site-border-shadow'] = 0;
	}


	/******************************************************************************
	 * Header left links (derived from  header_meta_left_options
	 ******************************************************************************/

	if ($options['header-meta-left'] == 'blogs' && $variation_config['header_meta_left_options']['blog'] == "") {
		$options['headerleft'] = "<a href='".get_bloginfo('url')."/wp-signup.php' title='View your Blogs'>WordPress</a>";
	} else if ($options['header-meta-left'] == 'custom') {
		$options['headerleft'] = stripslashes($options['headerleftcustom']);
	} else {
		$options['headerleft'] = $variation_config['header_meta_left_options'][$options['header-meta-left']]['option_value'];					
	}

	/******************************************************************************
	 * Header right links (derived from header_meta_right_options)
	 ******************************************************************************/

	if (isset($variation_config['header_meta_right_options'])) {
	
		if (isset($headermeta) && $headermeta == 'on') {
			$options['headerright'] = "Menus | Widgets | Design";
						
		} else {
			$options['headerright'] = "";
		}
	}
	
	/******************************************************************************
	 * Top Navigation area margins
	 * if no border on top nav, then no space between header image and nav
	 ******************************************************************************/
	if ($options['top-border-style'] == "solid" || $options['top-border-style'] == "dotted") {
		$options['top-margin-top'] = "1";
	} else {
		$options['top-margin-top'] = "0";
	}

	/******************************************************************************
	 * Footer left links (derived from meta_right_options
	 ******************************************************************************/

	if ($options['footer-meta-left'] == 'custom') {
		$options['footerleft'] = stripslashes($options['footerleftcustom']);
	} else {
		$options['footerleft'] = $variation_config['footer_meta_left_options'][$options['footer-meta-left']]['option_value'];					
	}

	/******************************************************************************
	 * Blog title and description display option 
	 * (derived from header-text-display and header-block-height options)
	 ******************************************************************************/
	
	
	if ($options['header-text-display'] != "hide") {
		$options['show-header-text'] = "inline";
	} else {
		$options['show-header-text'] = "none";
	}
	
	if ($options['header-text-display'] == "top") {
		$options['header-text-padding-top'] = 10;
		
	} else if ($options['header-text-display'] == "middle") {
		if ($options['header-block-height'] == 50) {
			$options['header-text-padding-top'] = 5;
		} else if ($options['header-block-height'] == 70) {
			$options['header-text-padding-top'] = 10;
		} else if ($options['header-block-height'] == 100) {
			$options['header-text-padding-top'] = 25;		
		} else if ($options['header-block-height'] == 125) {
			$options['header-text-padding-top'] = 45;		
		} else if ($options['header-block-height'] == 150) {
			$options['header-text-padding-top'] = 55;		
		} else if ($options['header-block-height'] == 175) {
			$options['header-text-padding-top'] = 65;		
		} else if ($options['header-block-height'] == 200) {
			$options['header-text-padding-top'] = 80;
		} else if ($options['header-block-height'] == 225) {
			$options['header-text-padding-top'] = 90;
		} else if ($options['header-block-height'] == 250) {
			$options['header-text-padding-top'] = 110;
		} else if ($options['header-block-height'] == 300) {
			$options['header-text-padding-top'] = 145;
		}
		
	} else if ($options['header-text-display'] == "bottom") {
		$options['header-text-padding-top'] = $options['header-block-height'] - 50;
		
	} else {
		$options['header-text-padding-top'] = 15;
	}
	
	$options['description-text-padding-top'] = $options['header-text-padding-top'] + 12;
	
	// IE hack for title-box padding
	if ($options['site-title-size'] < 20) {
		$options['ie-site-title-padding'] = 8;
	} else if ($options['site-title-size'] < 30) {
		$options['ie-site-title-padding'] = 10;
	} else if ($options['site-title-size'] < 40) {
		$options['ie-site-title-padding'] = 15;
	} else if ($options['site-title-size'] < 61) {
		$options['ie-site-title-padding'] = 22;
	}
	

	/******************************************************************************
	 * visited link color options (derived from link and text colors
	 ******************************************************************************/
	
	// dark blue or gold
	if ($options['linkcolor'] == '#003366' || $options['linkcolor'] == '#625b1d') {	
		// black
		if ($options['textcolor'] == '#222222') {
			$options['linkcolor_visited'] = "#000000";
		// 80% gray
		} else if ($options['textcolor'] == '#333333') {
			$options['linkcolor_visited'] = "#000000";
		// 70% gray
		} else if ($options['textcolor'] == '#444444') {
			$options['linkcolor_visited'] = "#000000";
		// 60% gray
		} else if ($options['textcolor'] == '#555555') {
			$options['linkcolor_visited'] = "#000000";
		// 50% gray
		} else if ($options['textcolor'] == '#666666') {
			$options['linkcolor_visited'] = "#000000";
		// 40% gray
		} else if ($options['textcolor'] == '#777777') {
			$options['linkcolor_visited'] = "#000000";
		// 30% gray
		} else if ($options['textcolor'] == '#888888') {
			$options['linkcolor_visited'] = "#333333";
		// 20% gray
		} else if ($options['textcolor'] == '#CCCCCC') {
			$options['linkcolor_visited'] = "#333333";
		// 10% gray	
		} else if ($options['textcolor'] == '#EEEEEE') {
			$options['linkcolor_visited'] = "#CCCCCC";
		}
		
		
	//  light blue
	} else if ($options['linkcolor'] == '#0066cc') {	
		$options['linkcolor_visited'] = "#003366";
	// red
	} else if ($options['linkcolor'] == '#990000') {	
		$options['linkcolor_visited'] = "#996666";
	// green
	}  else if ($options['linkcolor'] == '#265e15') {	
		$options['linkcolor_visited'] = "#6D9C54";
		
	// pale yellow
	}  else if ($options['linkcolor'] == '#FFFFCC') {	
		// 40% gray
		if ($options['textcolor'] == '#777777') {
			$options['linkcolor_visited'] = "#FFFFFF";
		// 30% gray
		} else if ($options['textcolor'] == '#888888') {
			$options['linkcolor_visited'] = "#FFFFFF";
		// 20% gray
		} else if ($options['textcolor'] == '#CCCCCC') {
			$options['linkcolor_visited'] = "#FFFFFF";
		// 10% gray	
		} else if ($options['textcolor'] == '#EEEEEE') {
			$options['linkcolor_visited'] = "#FFFFFF";
		} else {
			$options['linkcolor_visited'] = "#FFFFFF";
		}	
	// yellow
	}  else if ($options['linkcolor'] == '#FFCC33') {
	
		// 40% gray
		if ($options['textcolor'] == '#777777') {
			$options['linkcolor_visited'] = "#FFFFFF";
		// 30% gray
		} else if ($options['textcolor'] == '#888888') {
			$options['linkcolor_visited'] = "#FFFFFF";
		// 20% gray
		} else if ($options['textcolor'] == '#CCCCCC') {
			$options['linkcolor_visited'] = "#FFFFFF";
		// 10% gray	
		} else if ($options['textcolor'] == '#EEEEEE') {
			$options['linkcolor_visited'] = "#FFFFFF";
		} else {
			$options['linkcolor_visited'] = "#FFFFFF";
		}	
	
	// black
	}  else if ($options['linkcolor'] == '#222222') {	
		$options['linkcolor_visited'] = "#333333";	
	
	}

	/******************************************************************************
	 * Translucent box options
	 * translucent boxes have primary options for:
	 * background-color
	 * opacity
	 * border-style
	 *
	 * translucent boxes have derivative options for
	 * color
	 * border color
	 * heading-color
	 * link color
	 * text color
	 * 
	 ******************************************************************************/	
	
	$translucent_boxes = array('site', 'top', 'bottom', 'left01', 'right01', 'right02', 'header', 'content', 'cat-links', 'tag-links', 'title-box', 'description-box');
	
	foreach($translucent_boxes as $box) {
		
		// white
		if ($options[$box.'-color'] == '#FFFFFF') {
			$options[$box.'-border-top'] = "#CCCCCC";
			$options[$box.'-border-left'] = "#CCCCCC";
			$options[$box.'-border-bottom'] = "#CCCCCC";
			$options[$box.'-border-right'] = "#CCCCCC";
			$options[$box.'-heading-color'] = "#666666";
			$options[$box.'-link-color'] = $options['linkcolor'];
			$options[$box.'-text-color'] = $options['textcolor'];
			$options[$box.'-highlight-color'] = "#F9F9F9";

		// gray blue
		} else if ($options[$box.'-color'] == '#364559') {
			$options[$box.'-border-top'] = "#666666";
			$options[$box.'-border-left'] = "#666666";
			$options[$box.'-border-bottom'] = "#666666";
			$options[$box.'-border-right'] = "#666666";
			$options[$box.'-heading-color'] = "#CCCC99";
			$options[$box.'-link-color'] = "#EEEEEE";
			$options[$box.'-text-color'] = "#CCCCCC";
			$options[$box.'-highlight-color'] = "#364559";
			
			
		// black
		} else if ($options[$box.'-color'] == '#000000' || $options[$box.'-color'] == '#262626') {
			$options[$box.'-border-top'] = "#666666";
			$options[$box.'-border-left'] = "#666666";
			$options[$box.'-border-bottom'] = "#666666";
			$options[$box.'-border-right'] = "#666666";
			$options[$box.'-heading-color'] = "#FFFFFF";
			$options[$box.'-link-color'] = $options['linkcolor'];
			$options[$box.'-text-color'] = $options['textcolor'];
			$options[$box.'-highlight-color'] = "#262626";
			
		// green	
		} else if ($options[$box.'-color'] == '#83A776') {
			$options[$box.'-border-top'] = "#666666";
			$options[$box.'-border-left'] = "#666666";
			$options[$box.'-border-bottom'] = "#666666";
			$options[$box.'-border-right'] = "#666666";
			$options[$box.'-heading-color'] = "#FFFFFF";
			$options[$box.'-link-color'] = $options['linkcolor'];
			$options[$box.'-text-color'] = $options['textcolor'];
			$options[$box.'-highlight-color'] = "#83A776";

			
		// muted yellow
		}  else if ($options[$box.'-color'] == '#e9e9c9') {
			$options[$box.'-border-top'] = "#999999";
			$options[$box.'-border-left'] = "#999999";
			$options[$box.'-border-bottom'] = "#999999";
			$options[$box.'-border-right'] = "#999999";
			$options[$box.'-heading-color'] = "#AAA448";
			$options[$box.'-link-color'] = $options['linkcolor'];
			$options[$box.'-text-color'] = $options['textcolor'];
			$options[$box.'-highlight-color'] = "#e9e9c9";

			
		// green
		}  else if ($options[$box.'-color'] == '#4a6339') {
			$options[$box.'-border-top'] = "#585858";
			$options[$box.'-border-left'] = "#585858";
			$options[$box.'-border-bottom'] = "#585858";
			$options[$box.'-border-right'] = "#585858";
			$options[$box.'-heading-color'] = "#c7c6a7";
			$options[$box.'-link-color'] = "#FFFFFF";
			$options[$box.'-link-color'] = "#EEEEEE";
			$options[$box.'-text-color'] = "#CCCCCC";
			$options[$box.'-highlight-color'] = "#4a6339";

			
		// all other colors
		}  else {
			$options[$box.'-border-top'] = "#CCCCCC";
			$options[$box.'-border-left'] = "#CCCCCC";
			$options[$box.'-border-bottom'] = "#CCCCCC";
			$options[$box.'-border-right'] = "#CCCCCC";
			$options[$box.'-heading-color'] = "#333333";
			$options[$box.'-link-color'] = $options['linkcolor'];
			$options[$box.'-text-color'] = $options['textcolor'];
			$options[$box.'-highlight-color'] = "#F9F9F9";
			
		} 
		
		/******************************************************************************
		 * Bar borders 
		 ******************************************************************************/
		$options['cat-links-border-style'] = "solid";
		$options['tag-links-border-style'] = "solid";
		
		if (isset($options[$box.'-border-style']) && $options[$box.'-border-style'] == "none") {
			$options[$box.'-hover-border-style'] = "none";
		} else {
			$options[$box.'-hover-border-style'] = "solid";
		}
				
		/******************************************************************************
		 * Opacity Settings
		 * Only variations with dark background colors or images have 
		 * different colors for low opacity settings see: 
		 * variations/<<variation-name>>/variation.php
		 ******************************************************************************/
		$options['cat-links-opacity'] = 1;
		$options['tag-links-opacity'] = 1;
		
		// top bar child/sub-menu opacity never below transparent text and link color 
		if ($box == "top") {
			$options['top-child-link-color'] = $options['top-link-color'];
			$options['top-child-text-color'] = $options['top-text-color'];		
		}

		// convert hex color and opacity settings to rgba values
		$options[$box.'-color-rgb'] = "rgba(".hex2rgb($options[$box.'-color']).", ".$options[$box.'-opacity'].")";	
		$options[$box.'-highlight-color-rgb'] = "rgba(".hex2rgb($options[$box.'-highlight-color']).", ".($options[$box.'-opacity']+.1).")";	
		
		
		// text, link and highlight color adjustment for low opacity settings
		if ($options[$box.'-opacity'] < .7) {
			//$options[$box.'-blogtitle-color'] = $options['transparent-blogtitle-color'];
			//$options[$box.'-blogdescription-color'] = $options['transparent-blogdescription-color'];
			$options[$box.'-heading-color'] = $options['transparent-heading-color'];
			$options[$box.'-link-color'] = $options['transparent-link-color'];
			$options[$box.'-text-color'] = $options['transparent-text-color'];		
			
			if ($custom_background_image != "") {
				$options[$box.'-color-hover-rgb'] = "rgba(".hex2rgb($options[$box.'-color']).", ".($options[$box.'-opacity']-.2).")";
				$options[$box.'-highlight-hover-color-rgb'] = "rgba(".hex2rgb($options[$box.'-color']).", ".($options[$box.'-opacity']).")";
			} else {
				$options[$box.'-color-hover-rgb'] = "rgba(".hex2rgb($options[$box.'-color']).", ".($options[$box.'-opacity']+.2).")";
				$options[$box.'-highlight-hover-color-rgb'] = "rgba(".hex2rgb($options[$box.'-color']).", ".($options[$box.'-opacity']+.1).")";			
			}
			
		} else {
			$options[$box.'-color-hover-rgb'] = "rgba(".hex2rgb($options[$box.'-color']).", ".($options[$box.'-opacity']+.2).")";
			$options[$box.'-highlight-color-hover-rgb'] = "rgba(".hex2rgb($options[$box.'-highlight-color']).", ".($options[$box.'-opacity']+.1).")";					
		}
		
		

		
		// need to refine top bar opacity settings....
		if ($box == "top") {
			$options['top-color-hover02-rgb'] = "rgba(".hex2rgb($options['top-color']).", .9)";
			$options['top-color-hover03-rgb'] = "rgba(".hex2rgb($options['top-color']).", 1)";
		}
		
		/******************************************************************************
		 * category and tag links use linkcolor as their hover border color
		 ******************************************************************************/
		
		$options['cat-links-hover-border-top'] = $options['cat-links-link-color'];
		$options['cat-links-hover-border-bottom'] = $options['cat-links-link-color'];
		$options['cat-links-hover-border-left'] = $options['cat-links-link-color'];
		$options['cat-links-hover-border-right'] = $options['cat-links-link-color'];
		
		$options['tag-links-hover-border-top'] = $options['tag-links-link-color'];
		$options['tag-links-hover-border-bottom'] = $options['tag-links-link-color'];
		$options['tag-links-hover-border-left'] = $options['tag-links-link-color'];
		$options['tag-links-hover-border-right'] = $options['tag-links-link-color'];

		
		if ($box == "left01") {
			$area = "#tertiary";
		} else if ($box == "right01") {
			$area = "#primary";
		} else if ($box == "right02") {
			$area = "#secondary";
		} else if ($box == "top") {
			$area = "#access";
		} else if ($box == "bottom") {
			$area = "#footer-widget-area";
		} else if ($box == "content") {
			$area = "#content";
		} else if ($box == "header") {
			$area = ".headerblock";
		} else {
			$area = ".".$box;
		}
		

	   $options[$box.'-color-ie'] = $area." {".ie_opacity_css($options[$box.'-color'], $options[$box.'-opacity'])."}";

		// set the IE submenu-color opacity for top bar
		if ($box == "top") {
			$options['submenu-color-ie'] = "#access ul ul a, #access li:hover > a, #access ul ul :hover > a ";
			$options['submenu-color-ie'] .= "{background: ".$options[$box.'-color'].";}";
		}
		
		if ($box == "description-box") {
			$options[$box.'-color-ie'] = "#ie-description-box .description-box {".ie_opacity_css($options[$box.'-color'], $options[$box.'-opacity'])."}";
		}		
		
		// visibility and padding of bars
		if (isset($options[$box.'-width']) && $options[$box.'-width'] == '0') {
			$options[$box.'-visibility'] = "none";
			$options[$box.'-padding'] = "25";
		
		// if visible bar padding
		} else {
			$options[$box.'-visibility'] = "block";
			$options[$box.'-padding'] = "25";
		}
		
	}

	/******************************************************************************
	 * Display colophon with border only if footer-widget-area has no border
	 ******************************************************************************/

	if ($options['bottom-border-style'] == 'none') {
		$options['colophon-border-type'] = "dotted";
	} else {
		$options['colophon-border-type'] = "none";
	}
	
	/******************************************************************************
	 * calculate width of footer widget areas based on site width
	 ******************************************************************************/
	$active_widgets = 0;
	if ( is_active_sidebar( 'first-footer-widget-area' ) ) $active_widgets ++;
	if ( is_active_sidebar( 'second-footer-widget-area' ) ) $active_widgets ++;
	if ( is_active_sidebar( 'third-footer-widget-area' ) ) $active_widgets ++;
	if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) $active_widgets ++;
	
	if ($active_widgets > 0)
		$options['footer-widget-width'] = round($options['site-width']/$active_widgets)-10;
	
	//printpre($options['footer-widget-width']);

	/******************************************************************************
	 * Entry text line height
	 ******************************************************************************/
	$options['entry-line-height'] = $options['entry-text-size'] + round($options['entry-text-size']/2);
	
	/******************************************************************************
	 * Entry link style options
	 ******************************************************************************/

	$link_types = array('entry');
	
	foreach($link_types as $link_type) {
	
		if ($options[$link_type.'-link-style'] == "none") {
			$options[$link_type.'-link-border'] = "none";
			$options[$link_type.'-link-decoration'] = "none";
			$options[$link_type.'-link-hover-border'] = "solid";
			$options[$link_type.'-link-hover-background_color'] = $options['content-color'];
			$options[$link_type.'-link-hover-decoration'] = "underline";
			$options[$link_type.'-link-background'] = "transparent";
			$options[$link_type.'-link-color'] = $options['linkcolor'];
			
		} else if ($options[$link_type.'-link-style'] == "underline") {
			$options[$link_type.'-link-border'] = "dotted";
			$options[$link_type.'-link-decoration'] = "none";
			$options[$link_type.'-link-hover-border'] = "solid"; 
			$options[$link_type.'-link-hover-background_color'] = $options['content-color'];
			$options[$link_type.'-link-hover-decoration'] = "underline";
			$options[$link_type.'-link-background'] = "none";
			$options[$link_type.'-link-color'] = $options['linkcolor'];

		} else if ($options[$link_type.'-link-style'] == "ww") {
			$options[$link_type.'-link-border'] = "dotted ";
			$options[$link_type.'-link-hover-border'] = "solid";
			$options[$link_type.'-link-decoration'] = "none";
			$options[$link_type.'-link-hover-decoration'] = "none";
			$options[$link_type.'-link-color'] = $options['linkcolor'];
			if ($options['content-color'] == '#000000') {
				$options[$link_type.'-link-hover-background_color'] = "#262626";
			} else if ($options['content-color'] == '#262626') {
				$options[$link_type.'-link-hover-background_color'] = "#000000";
			} else {
				$options[$link_type.'-link-hover-background_color'] = "#efc";
			}
		} 
	}	

	/******************************************************************************
	 * Sidebar display options
	 * Options for which sidebars to display on various pages
	 ******************************************************************************/
	$pages = array('post', 'category', 'tag', 'author', 'search', 'archives');

	foreach($pages as $page) {
		if ($options[$page.'-single-sidebar'] == 'right01') {
			$options[$page.'-sidebar-left-display'] = "hide";
			$options[$page.'-sidebar-right-display'] = "show";
			$options[$page.'-sidebar-right02-display'] = "hide";
			
		} else if ($options[$page.'-single-sidebar'] == 'left01') {
			$options[$page.'-sidebar-left-display'] = "show";
			$options[$page.'-sidebar-right-display'] = "hide";
			$options[$page.'-sidebar-right02-display'] = "hide";
	
		} else if ($options[$page.'-single-sidebar'] == 'right02') {
			$options[$page.'-sidebar-left-display'] = "hide";
			$options[$page.'-sidebar-right-display'] = "hide";
			$options[$page.'-sidebar-right02-display'] = "show";
			
		} else if ($options[$page.'-single-sidebar'] == 'left01right01') {
			$options[$page.'-sidebar-left-display'] = "show";
			$options[$page.'-sidebar-right-display'] = "show";
			$options[$page.'-sidebar-right02-display'] = "hide";
	
		} else if ($options[$page.'-single-sidebar'] == 'left01right02') {
			$options[$page.'-sidebar-left-display'] = "show";
			$options[$page.'-sidebar-right-display'] = "hide";
			$options[$page.'-sidebar-right02-display'] = "show";
			
		} else if ($options[$page.'-single-sidebar'] == 'right01right02') {
			$options[$page.'-sidebar-left-display'] = "hide";
			$options[$page.'-sidebar-right-display'] = "show";
			$options[$page.'-sidebar-right02-display'] = "show";
			
		} else if ($options[$page.'-single-sidebar'] == 'none') {
			$options[$page.'-sidebar-left-display'] = "hide";
			$options[$page.'-sidebar-right-display'] = "hide";
			$options[$page.'-sidebar-right02-display'] = "hide";
		}	
	}
	
			
	$options['page-image-width'] = $options['site-width']-50;

}

/******************************************************************************
 * Delete options deletes the theme options and resets to defaults for the
 * currently selected variation
 * (This is needed only when updating Variations themes and cleaning out
 * old options...)
 ******************************************************************************/

function delete_options() {
    global $variation_config, $options, $variation_css, $theme_settings, $theme_css;
	
	$options = array();
	$variation_css = "";
	$_POST = array();
	
	delete_option($theme_settings); 	
	delete_option($theme_css);
	
	add_option($theme_settings, array('init' => 1));  	
 	add_option($theme_css, "");
	
	set_variation_options();

	//$options['revert'] = 0; 
	
	update_option($theme_settings, $options);

 	$options = get_option($theme_settings);

}

/******************************************************************************
 * Provides feedback to user about theme option choses
 ******************************************************************************/

function print_option_feedback() {
	global $_POST, $options, $variation_config;
	
	$main_column_width = $options['site-width'] - ($options['left01-width'] + $options['right01-width'] + 174);
	$message = "<strong>Your changes have been saved.</strong>";
	$error = "false";
		
	if ($options['revert'] == 1) {
		$message = "These are the default settings for the ".$variation_config['theme-name']." theme.";
		$error = "true";

	} else if (isset($_POST['reset'])) {
		$message .= " <br/><br/>The ".$options['theme-name']." theme options have been reverted to their default settings.";
		$error = "true";

	} else {

		if ($options['background_color'] == '#0F0F0F') {
			$message .= " Black is a good choice for blogs that focus on images, particularly photos.";
						
			if ($options['header-image-options'] == "whitegradient") {
				$message .= " <br/><br/>The white gradient image really doesn't look good here.  Best to upload your own custom image or use none.";
				$error = "true";
			} 

		} 		
		
		if (is_active_sidebar("tertiary-widget-area") && $options['left01-width'] == 0) {
			$message .= " <br/><br/>Your left sidebar is hidden but contains widgets.";
			$error = "true";
		}

		if (is_active_sidebar("primary-widget-area") && $options['right01-width'] == 0) {
			$message .= " <br/><br/>Your right sidebar is hidden but contains widgets.";
			$error = "true";
		}

		if (is_active_sidebar("secondary-widget-area") && $options['right02-width'] == 0) {
			$message .= " <br/><br/>Your 2nd right sidebar is hidden but contains widgets.";
			$error = "true";
		}
				
		if ($options['left01-width'] == "125") {
			$message .= "<br/>Your left sidebar is only 175px.  This may be too narrow for some widgets (e.g. calendar widget)";
			$error = "true";
		} 

		if ($options['right01-width'] == "125") {
			$message .= "<br/>Your right sidebar is only 175px.  This may be too narrow for some widgets (e.g. calendar widget)";
			$error = "true";
		} 

		if ($options['right02-width'] == "125") {
			$message .= "<br/>Your 2nd right sidebar is only 175px.  This may be too narrow for some widgets (e.g. calendar widget)";
			$error = "true";
		} 		
			
		$pages = array('post', 'category', 'tag', 'author', 'search');
		
		foreach($pages as $page) {
		
			if ($options[$page.'-sidebar-right-display'] == "show" && $options['right01-width'] == 0) {
				$message .= " <br/>You wanted to show your right sidebar on ".$page." pages but you have hidden it...";
				$error = "true";
			} 
	
			if ($options[$page.'-sidebar-right02-display'] == "show" && $options['right02-width'] == 0) {
				$message .= " <br/>You wanted to show your 2nd right sidebar on ".$page." pages but you have hidden it...";
				$error = "true";
			} 
		
			if ($options[$page.'-sidebar-left-display'] == "show" && $options['left01-visibility'] == "hidden") {
				$message .= " <br/>You wanted to show your left sidebar on ".$page." pages but you have hidden it...";
				$error = "true";
			} 			
		}
		
		if ($error == "false") {
			$message .= " Visit the site";
		}

	}
	
    print
    "
        <div class='updated fade' id='message'
            style='background-color: #fff3cc;
                    margin-right: 50px;
                    margin-top: 30px;
                    margin-left: 20px'>
            <p><em>".$message.".</em></p>
        </div>
    ";

}

/******************************************************************************
 * Get Content Width
 * gets the width of the content column depending on what template is being used
 * template values: page, archives, search, author, category, tag, post
 ******************************************************************************/

function get_content_width ($template) {
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

function get_box_widths () {
	global $options;
	
	if (is_single()) {
		$content_width = get_content_width ("post");
	} else if (is_category()){
		$content_width = get_content_width ("category");
	} else if (is_tag()){
		$content_width = get_content_width ("tag");
	} else if (is_author()){
		$content_width = get_content_width ("author");
	} else if (is_search()){
		$content_width = get_content_width ("search");
	} else if (is_archive()){
		$content_width = get_content_width ("archives");
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
			$content_width = get_content_width ("page");
		}
	}
	
	$box_widths = $options['right01-width'].",";
	$box_widths .= $options['right02-width'].",";
	$box_widths .= $options['left01-width'].",";
	$box_widths .= $content_width;
	
	return $box_widths;

}

/*********************************************************
 * Hext to RGB converter for setting transparency using RGBa
 * $c can be either hex or rgb
 *********************************************************/
 
 function hex2rgb($color) {
	if (!$color) return false;
	$color = trim($color);
	$rgb_color = false;
   
	if (eregi("^[0-9ABCDEFabcdef\#]+$", $color)) {
		$color = str_replace('#','', $color);
		$l = strlen($color) == 3 ? 1 : (strlen($color) == 6 ? 2 : false);
	}

	if ($l) {
		unset($rgb_color);
		//$out = "rgba(";
		$rgb_color = hexdec(substr($color, 0,1*$l)).", ";
		$rgb_color .= hexdec(substr($color, 1*$l,1*$l)).", ";
		$rgb_color .= hexdec(substr($color, 2*$l,1*$l));
	} else $rgb_color = false;
	return $rgb_color;
}

/******************************************************************************
 * Generates IE proprietary CSS for opacity 
 ******************************************************************************/

function ie_opacity_css ($color, $opacity) {
	if (!$color) return false;
	$color = trim($color);
	$out = false;
	
	if (eregi("^[0-9]+(,| |.)+[0-9]+(,| |.)+[0-9]+$", $color)) {
		$color = hex2rgb($color);
	}
	
	$color = ereg_replace("#", "", $color);
	$hex_opacity = strtoupper(dechex($opacity*255));
	if ($opacity == "0") $hex_opacity = "00";
	$hex_rgba = "#".$hex_opacity.$color;
	
	$out = "*background:transparent;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=";
	$out .= $hex_rgba;
	$out .= ",endColorstr=";
	$out .= $hex_rgba;
	$out .= ");zoom: 1;";
	return $out;
}

/*********************************************************
 * Compile CSS for current variation with defaults
 * for theme style.css
 *********************************************************/

function read_css_file($css_file) {

	if (file_exists(TEMPLATEPATH.'/'.$css_file)) {
		$default_css_filepath = TEMPLATEPATH.'/'.$css_file;
		printpre($default_css_filepath);
	}
	
	
    if( ! ($default_css = @file("$default_css_filepath", FILE_IGNORE_NEW_LINES)) ) {
        print("Unable to read css file: $css_file");
        return(false);
    }
}

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
