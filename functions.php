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

/**
 * Sets up theme defaults and registers support for various WordPress features.
*/
if (file_exists(dirname(__FILE__).'/config.php')) {
	require_once('config.php');
} else if (file_exists(dirname(__FILE__).'/config-sample.php')) {
	require_once('config-sample.php');
}

/*********************************************************
 * Define theme id, settings, css and options
 *********************************************************/

$theme_id = strtolower($variation_config['theme-name']);
$theme_id = str_replace(" ", "_", $theme_id);

$theme_settings = $theme_id."_settings";
$theme_css = $theme_id."_css";
$theme_options = $variation_config['theme-name']." Options";

/******************************************************************************
 *  Get options
 ******************************************************************************/
  
if (!is_array(get_option($theme_settings))) {
    add_option($theme_settings, array('init' => 1));    
} else {	
	$options = get_option($theme_settings);
}
   
if (!get_option($theme_css)) {
	add_option($theme_css, "");	
} else {
	$variation_css = get_option($theme_css);	
}

$options['theme-url'] = $variation_config['theme-url'];
$options['theme-name'] = $variation_config['theme-name'];

$current_widgets = get_option ('sidebars_widgets');
//printpre($current_widgets['sidebar-2']);

//set_variation_options();

/*********************************************************
 * Setup admin menu
 *********************************************************/ 

add_action('admin_menu', 'variation_admin_menu');

function variation_admin_menu() {
	global $theme_options, $variation_config;
	
    add_theme_page($theme_options, $theme_options, 'edit_themes', 'Variations', 'variation_options');
}

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;


/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
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
 * @since Twenty Ten 1.0
 */
function twentyten_setup() {

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
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyten_header_image_width', 940 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyten_header_image_height', 198 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See twentyten_admin_header_style(), below.
	add_custom_image_header( '', 'twentyten_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/berries.jpg',
			'thumbnail_url' => '%s/images/headers/berries-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Berries', 'twentyten' )
		),
		'cherryblossom' => array(
			'url' => '%s/images/headers/cherryblossoms.jpg',
			'thumbnail_url' => '%s/images/headers/cherryblossoms-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Cherry Blossoms', 'twentyten' )
		),
		'concave' => array(
			'url' => '%s/images/headers/concave.jpg',
			'thumbnail_url' => '%s/images/headers/concave-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Concave', 'twentyten' )
		),
		'fern' => array(
			'url' => '%s/images/headers/fern.jpg',
			'thumbnail_url' => '%s/images/headers/fern-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Fern', 'twentyten' )
		),
		'forestfloor' => array(
			'url' => '%s/images/headers/forestfloor.jpg',
			'thumbnail_url' => '%s/images/headers/forestfloor-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Forest Floor', 'twentyten' )
		),
		'inkwell' => array(
			'url' => '%s/images/headers/inkwell.jpg',
			'thumbnail_url' => '%s/images/headers/inkwell-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Inkwell', 'twentyten' )
		),
		'path' => array(
			'url' => '%s/images/headers/path.jpg',
			'thumbnail_url' => '%s/images/headers/path-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Path', 'twentyten' )
		),
		'sunset' => array(
			'url' => '%s/images/headers/sunset.jpg',
			'thumbnail_url' => '%s/images/headers/sunset-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Sunset', 'twentyten' )
		)
	) );
}
endif;

if ( ! function_exists( 'twentyten_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyten_setup().
 *
 * @since Twenty Ten 1.0
 */
function twentyten_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
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
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function twentyten_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'twentyten' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'twentyten' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'twentyten' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'twentyten' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
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
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
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
		
    } else if ($_POST['action'] == 'save') {
		save_options();        
	}
	
	//read_css_file("style.css");
	//printpre ($options['headerleft']);
	
	set_variation_options();	
		
	update_option($theme_settings, $options);
	update_option($theme_css, $variation_css);

	$options = get_option($theme_settings);
	$variation_css = get_option($theme_css);
	
	$current_widgets = get_option ('sidebars_widgets');	
    
	/*********************************************************
	 * Define theme layout model values
	 *********************************************************/

    $model_right_sidebar_width = $options['right01-width']+50;
    $model_right_sidebar_width02 = $options['right02-width']+50;
    $model_left_sidebar_width = $options['left01-width']+50;
    
    $model_header_image = get_header_image();
	if ($options['header-image-options'] == "custom") {
   		$match = preg_match('/variations/', $model_header_image);
   		if ($match == 0) {
   			$custom_header_set = 1;
   		} else {
   			$custom_header_set = 0;
   		}
   	} else {
   		//$model_header_image = get_bloginfo('stylesheet_directory')."/variations/".$variation_config['header_image_options'][$options['header-image-options']]['option_value'];
   		$model_header_image = get_header_image();
   	}

	if ($options['site-width'] == 100) {
		$model_site_width = $options['site-width']-5;
		$model_header_text_width = $model_site_width - 200;
  	//	$model_content_width = $options['site-width'] - ($options['left-width'] + $options['right-width'] + $options['right02-width'] + 150);
		$model_site_width = $model_site_width."%";
				
	} else {
		$model_site_width = $options['site-width']-22;
		if ($options['site-width'] >= $options['header-width']) {
			$model_header_width = $options['header-width']-$options['custom-header-width-offset']-7;
		} else {
			$model_header_width = $options['site-width']-$options['custom-header-width-offset']-7;
		}
		$model_page_width = $options['site-width']-$options['custom-header-width-offset']-7;
		$model_header_text_width = $model_site_width - 200;
		$model_content_width = $options['site-width'] - ($options['left01-width'] + $options['right01-width'] + $options['right02-width'] + 150);
		$model_site_width = $model_site_width."";
		$model_site_width_css = $model_site_width."px";
	}

	
	/*********************************************************
	 * Define theme model css
	 * model css uses most of the actual theme's css except
	 * theme body css 
	 * model css adds css for theme edit UI components
	 *********************************************************/
 	
 	$model_css = preg_replace("/body/", ".body_na", $variation_css); 
 	print "
 	<style type='text/css'>".$model_css."

		.modelwrapper {
			background-image: ".$options['background_image'].";
			background-position: ".$options['background_position'].";
			background-color: ".$options['background_color'].";
			background-repeat: ".$options['background_repeat'].";
 			width: ".$model_site_width_css.";
			margin-top: 1px;
			margin-right: 10px;
			background-color: ".$options['background_color'].";
			color: #000000;
			padding: 1px 10px 10px 10px;
			border: 1px solid #CCCCCC;
		}
		
		.contentwrapper {
			background-color: ".$options['background_color'].";
		
		}
		
		.headerwrapper {
			width: ".$options['header-width'].";
		}
						
		.headerblock {
			background-image: url(".$model_header_image.");
			background-position: right center;
			background-repeat: no-repeat;
		}
		 		
 		.contentblock {
 			width: ".$model_content_width."px;
 		}

 		.editheaderlink {
 			color: ".$options['bglinkcolor'].";
 			font-size: 9px;
 			white-space:nowrap; 			
 		}
 		
		.editheaderlink a {
 			color: ".$options['bglinkcolor'].";
 			padding: 3px;
 			border: 1px dotted ".$options['bglinkcolor'].";
		}

 		.editheaderlink a:hover {
			 border: 1px solid ".$options['bglinkcolor'].";
			 text-decoration: none;
			 color: ".$options['bglinkcolor'].";
		}
		
		.modelheadertextposition {
			font-size: 20px; 
			margin-left: 5px;
			padding-top: ".$options['header-text-padding-top']."px;
			color: ".$options['headertext'].";
		}

 		.rss  {
			font-size: 10px;
			text-align: center;
 			color: ".$options['linkcolor'].";
		} 	
		
		#appgroupedit textarea {
			width: 300px;
		}

 		.metatext {
 			font-size: 9px; 
 			color: ".$options['bglinkcolor'].";

 		}
 		
 		.metatext a {
 			color: ".$options['bglinkcolor'].";
 		}

		.horizontalbar {
			padding-top: 4px;
			padding-bottom: 4px;
			margin-bottom: 4px;
			text-align: right;
		}
 		.editwidgetlink {
			display: block;
 			color: ".$options['linkcolor'].";
 			
 		}
 		
 		.editwidgetlink a {
			display: block;
 			color: ".$options['linkcolor'].";
			border: 1px dotted;
 			padding: 3px;
 			margin-bottom: 3px;
		} 		
 		
 		.editwidgetlink a:hover {
			 border: 1px solid;
			 text-decoration: none;
		}
								
		.instructions {
			margin-top: 5px;
			margin-bottom: 5px;
			margin-right: 0px;
			margin-left: 0px;
			background-color: #fffeeb;
			color: #000000;
			font-size: 10px;
			line-height: 1.5em;
			padding: 5px;
			border: 1px solid #CCCCCC;
		}
		
		.optionsrow {
			border-bottom: 1px dotted;
			font-size: 10px;
		}
		
		.options-select {
			font-size: 10px;
		}
		
		.entry a:visited {
			color: ".$options['linkcolor'].";		
			border-bottom: 1px ".$options['entry-link-border'].";
		}

		.entry-visited {
			cursor: pointer;
			color: ".$options['linkcolor_visited'].";		
			border-bottom: 1px ".$options['entry-link-border'].";
		}

		.entry-visited:hover {
			color: ".$options['linkcolor_visited'].";
			background-color: ".$options['entry-link-hover-background_color'].";
			border-bottom: 1px ".$options['entry-link-hover-border'].";
		}
		
		a, h2 a:hover, h3 a:hover {
			text-decoration: none;
			border-bottom: none;
		}

		a:hover {
			text-decoration: none;
			border-bottom: none;
		}

		.entry a:hover {
			background-color: ".$options['entry-link-hover-background_color'].";
			border-bottom: 1px ".$options['entry-link-hover-border'].";		
		}
		
		h1, h2, h3 {	
			border-bottom: none;		
		}
		
		.widgetbox {
			font-size: 10px;
			border-width: 1px;
			border-style: solid;
			padding: 5px;
			margin: 3px;
		}

		".$options['header-color-ie']."
		".$options['top-color-ie']."
		".$options['content-color-ie']." 
		".$options['bottom-color-ie']."
		".$options['left01-color-ie']."
		".$options['right01-color-ie']."
		".$options['right02-color-ie']."

 	</style>";	 
    
	/*********************************************************
	 * Form action 
	 *********************************************************/

	print "
	<form id='settings' action='' method='post' class='themeform' style='margin: 20px;'>
	<input type='hidden' id='action' name='action' value='save'/>";

	/*********************************************************
	 *  Header meta options
	 *  Header meta left set in config
	 *********************************************************/
	print 
	"
	<table width = '".$model_site_width."' cellpadding='0' style='background-color: transparent;'>
		<tr>
			<td width='20%'>
			<span class='submit'><input type='submit' value='Update' name='save'/></span>
			</td>
			<td width='60%' align='left'>
			<div class='instructions' style='font-size: 9px;'>	
			<i>Below is a model of your blog's layout and colors. It does not show all the details of your blog's header, borders or sidebar widgets.  
			As well, the width of sidebars and content areas may not be accurate in this preview.</i>&nbsp;&nbsp;
			 <strong>Show recommendations: </strong><input type='checkbox' name='model-instructions' id='model-instructions' ".(isset($options['model-instructions']) && $options['model-instructions'] == "on" ? ' checked' : '') . " onchange='this.form.submit();'/>
			</div>			
			</td>
			<td width='20%'>
			<div class='submit' style='float: right;'><input type='submit' value='Revert to Default' name='reset'/></div>
			</td>
		</tr>
		<tr>
		<td width='20%'>"; 
			// header meta right appgroups options	
			if (in_array("header-meta-left", $variation_config['model'])) {
				print "<span style='font-size: 9px;'>Header Links:</span>\n";
				print "<select name='header-meta-left' style='font-size: 10px;'  onchange='this.form.submit();'>";
				foreach (array_keys($variation_config['header_meta_left_options']) as $meta_left_option) {						
					print "<option value='".$variation_config['header_meta_left_options'][$meta_left_option]['option_name']."' ";
					print ($options['header-meta-left'] == $variation_config['header_meta_left_options'][$meta_left_option]['option_name'] ? ' selected' : '') . ">";
					print $variation_config['header_meta_left_options'][$meta_left_option]['option_label']."</option>";						
				}
				print "</select>";
			}
			print "
			</td>
			<td style='text-align: center;'>";	
			// background options		
			if (in_array("background", $variation_config['model'])) {				
				print "
				<span style='font-size: 10px;'>Variation:</span>
				<select name='background' style='font-size: 10px;' onchange='this.form.submit();'>";
					// custom background image					
					if (!in_array("custom", $variation_config['variations_disabled']))
						print "\n<option value='custom'".($options['background'] == $value ? ' selected' : '') . ">Custom</option>";
					
					// variations defined in variations folder
					foreach ($variations as $label => $value) {
						if (!in_array($value, $variation_config['variations_disabled']))
							print "\n<option value='".$value."'".($options['background'] == $value ? ' selected' : '') . ">".$label."</option>";
					}									
				print "</select>";
			}
	
			//site width			
			get_option_selector ("Site Width", "site-width", $options_values['site-width']);

			//header width
			get_option_selector ("Header Width", "header-width", $options_values['header-width']);
							
			print "
			</td>
			<td width='20%' align='right'>";
	
			// log in link options		
			if (in_array("headermeta", $variation_config['model']) && $variation_config['headermeta'] != "on") {	
				print "
				<span style='color:".$options['bgtextcolor']."; font-size: 10px;'>Log in:
				<select name='headermeta' style='font-size: 10px;' onchange='this.form.submit();'>
					<option value='on' ".($options['headermeta'] == 'on' ? ' selected' : '') . ">Show</option>
					<option value='off' ".($options['headermeta'] == 'off' ? ' selected' : '') . ">Hide</option>
				</select>
				</span>";
			} else {
				$options['headermeta'] = 'on';
			}

			print "
			</td>
		</tr>
		<tr>
			<td colspan='3' style='text-align: center;'>";
			if ($options['background'] == 'custom') {
		
				// background image url
				get_option_field ("Background Image URL", "background_image_url", 70);
				print "<br/>";
								
				// background repeat
				get_option_selector ("Background Repeat", "custom_background_repeat", $options_values['background_repeat']);

				// background position
				get_option_selector ("Background Position", "background_position", $options_values['background_position']);
				print "<br/>";
				
				// background color
				get_option_field ("Background Color", "custom_background_color", 8);

				// background link color
				get_option_field ("Background Link Color", "custom_bglinkcolor", 8);	
				
				// background text color
				get_option_selector ("Background Text Color", "custom_bgtextcolor", $options_values['textcolor']);
				print "<br/>";

				// Blog title and background heading colors	
				get_option_field ("Translucent Blog Title Color", "custom_header_color", 8);
				if (in_array("custom_header_color", $variation_config['model']))
					print "<span style='font-size: 9px;'>(when header opacity < 80%)</span>";
					
				// Background source url
				print "<br/>";
				get_option_field ("Variation source URL", "custom_background-source-url", 50);
				// Background source credit	
				get_option_field ("Variation Name/Credit", "custom_background-source-credit", 20);
			}				
			print "</td>
		</tr>
	</table>
	
	<div class='modelwrapper'>";
	

	/*********************************************************
	 *  Header meta and background  model
	 *********************************************************/
	
	print "	
	<table width='100%' cellpadding='5'>
	<tr>
		<td colspan='3'>
			<table width='100%' cellspacing='0' cellpadding='5'>
			<tr>
			<td width='70%'>
			<div class='metatext'>";
			
			if ($options['headerleft'] == "") {
				print "no links defined...";				
			} else {
				print $options['headerleft'];
			}
					
			// if header left links selection is custom
			if ($options['header-meta-left'] == 'custom') {
				print "
					<input id='appgroupdo' type='hidden' name='appgroupdo' value='0'/> - 			
					<a href='javascript: document.getElementById(\"appgroupedit\").style.display = \"block\"; document.getElementById(\"appgroupdo\").value = \"1\"; exit; '>edit</a>					
					<div id='appgroupedit' style='display: none;'>					
					<textarea name='headerleftcustom' style='width: 100%; height: 50px; font-size: 10px;' class='code'>";
					print stripslashes(stripslashes(trim($options['headerleftcustom'])));
					print "</textarea>		
					&nbsp;&nbsp;&nbsp;
					<a href='javascript: document.getElementById(\"appgroupedit\").style.display = \"none\"; document.getElementById(\"appgroupdo\").value = \"0\"; exit;'>Cancel</a> - 
					<span class='submit'><input type='submit' value='Update' name='save'/></span>
					</div>
				";
			}
			print "
			</div>	
			</td>
			<td width='30%' valign='top'>";
			
			print "<div class='metatext' style='float: right; clear: both;'>";
			
			// header right meta options
			print $options['headerright'];
			print "Dashboard ";
			
			
			// Log in link options
			if ($options['headermeta'] == "on") {
				print " | ".wp_get_current_user()->display_name;
				print " - Log out";
			}
			
			print "
			</div>
			</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td width='20%'>";
		
		// header-text-display options		
		if (in_array("header-text-display", $variation_config['model'])) {	
			print "
			<span style='color:".$options['bgtextcolor']."; font-size: 10px;'>Blog Title Position:
			<select name='header-text-display' style='font-size: 10px;' onchange='this.form.submit();'>
				<option value='middle' ".($options['header-text-display'] == 'middle' ? ' selected' : '') . ">Middle</option>
				<option value='top' ".($options['header-text-display'] == 'top' ? ' selected' : '') . ">Top</option>
				<option value='bottom' ".($options['header-text-display'] == 'bottom' ? ' selected' : '') . ">Bottom</option>
				<option value='hide' ".($options['header-text-display'] == 'hide' ? ' selected' : '') . ">Hide</option>
			</select>
			</span>";
		}		
		print "</td>
		<td width='80%' colspan='2'>";
				
		// header height options
		print "<span style='color:".$options['bgtextcolor']."'>";
		get_option_selector ("Header Height", "header-block-height", $options_values['header-block-height']);
		print "</span>";
		
		// header color
		print "<span style='color:".$options['bgtextcolor']."'>";
		get_option_selector ("Header Color", "header-color", $options_values['sidebar-color']);
		print "</span>";

		// header opacity
		print "<span style='color:".$options['bgtextcolor']."'>";
		get_option_selector ("Header Opacity", "header-opacity", $options_values['header-opacity']);
		print "</span>";
		
		// header border
		print "<span style='color:".$options['bgtextcolor']."'>";
		get_option_selector ("Header Border", "header-border-style", $options_values['border-style']);
		print "</span>";
				
		// header image options
		if (in_array("header-image-options", $variation_config['model'])) {
			print " <span style='white-space:nowrap'><span style='font-size: 10px; color:".$options['bgtextcolor']."'>Header Image:</span>\n";

			if ($options['header-image-options'] == "custom" && $custom_header_set == 1) {
				print "<span class ='editheaderlink'><a href='".get_bloginfo('url')."/wp-admin/themes.php?page=custom-header'>Edit Custom Header Image</a></span>";
			} else {
				print "<select name='header-image-options' style='font-size: 10px;'  onchange='this.form.submit();'>\n";
				foreach (array_keys($variation_config['header_image_options']) as $header_image_option) {						
					print "<option value='".$variation_config['header_image_options'][$header_image_option]['option_name']."' ";
					print ($options['header-image-options'] == $variation_config['header_image_options'][$header_image_option]['option_name'] ? ' selected' : '') . ">";
					print $variation_config['header_image_options'][$header_image_option]['option_label']."</option>\n";						
				}
				print "</select>";
				if ($options['header-image-options'] == "custom" && $custom_header_set == 0) 
					print "<span class ='editheaderlink'><a href='".get_bloginfo('url')."/wp-admin/themes.php?page=custom-header'>Edit Custom Header Image</a></span>";
			}
		}
		print "</span>";
		print "
		</td>		
	</tr>
	<tr><td colspan='3'>";		
		if ($options['model-instructions'] == "init" || $options['model-instructions'] == "on") {
			print "
			<div class='instructions' style='font-size: 8px;'>	
				<i>If you use your own custom header image, consider an image with transparent background for graphics or logo type images. 
				If your custom header image spans the entire width of the header, move the blog title and description to top or bottom or hide it </i>
			</div>		
			";		
		}		
		print "	
	</td></tr>	
	</table>
	";

	/*********************************************************
	 * theme model and options
	 *********************************************************/
	print "	
	<div class='page_top'></div>
	<div class='page_main'>	
	<table width = '".$model_header_width."' align='center' cellpadding='20' style='background-color: transparent;'>
	<tr>
		<td valign='top' height='".$options['header-block-height']."' class='headerblock' style='margin-right:100px;'>";
			
			// blog title and description model
			if ($options['header-text-display'] != "hide") {
				print "<div class='headertext'><a href = '#'>".get_bloginfo('name')."</a></div>";
				print "<div class='description'>".get_bloginfo('description')."</div>";
			} else {
				print "<div style='font-size: 10px; color: ".$options['header-text-color'].";'><i>blog title and description hidden</i></div>";
			}
			print "

		</td>
	</tr>
	</table>

	<table width = '".$model_page_width."' align='center' cellpadding='0' cellspacing='2' style='background-color: ".$options['content-background'].";'>
	<tr>
	<td>				
			<tr>
				<td colspan='4' style='background-color: transparent;'>
				<table width='100%' cellspacing='2' cellpadding='0'>
				<tr>
				<td width='80%' class='topblock'>";
								
				/*********************************************************
				 * top bar
				 *********************************************************/
				
				if ($options['model-instructions'] == "init" || $options['model-instructions'] == "on") {
					print "
					<div class='instructions' style='margin: 2px;'>	
						<span style='font-size: 8px;'><i>Use this area for announcements, or links to other related sites.  Recommended widget: Text/HTML 
						(don't bother with giving your Text widget a title here, probably take too much space...) </i></span>
					</div>						
					";		
				}		
				print "
				<h2 style='padding-top: 0px; font-size: 10px; float: left;'>Top Bar</h2>
				<div class='horizontalbar' style='font-size: 8px; float: left;'>";

				// color
				get_option_selector ("", "top-color", $options_values['sidebar-color']);

				// opacity
				get_option_selector ("", "top-opacity", $options_values['sidebar-opacity']);

				// border
				get_option_selector ("", "top-border-style", $options_values['border-style']);
				print"
				</div>
				<div style='float: left;  margin-top: 3px; width: 100%'>
				<div class='editwidgetlink' style='text-align: center; float: left; margin-top: -3px;'> 
				<a style='color:".$options['top-link-color']."; font-size: 10px; border-color: ".$options['top-link-color']."' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>
				</div>				
				";
				if (is_array($current_widgets['sidebar-4'])) {
					foreach ($current_widgets['sidebar-4'] as $widget) {
						$widget = str_replace("-", " ", $widget);
						$widget = str_replace("_", " ", $widget);
						$widget = rtrim(ucwords($widget), "0..9");
						print "<span class='widgetbox' style='color: ".$options['top-heading-color']."; border-color: ".$options['top-heading-color'].";'>";
						print $widget;
						print "</span> ";					
					}
				}
				print"
				</div>
				</td>
				
				<td width='20%' class='topblock'>
				<div class='rss' style='color:".$options['top-link-color'].";'>Posts RSS | Comments RSS</div>
				</td>
				</tr>
				</table>
			</tr>
			<tr>";
						
			/******************************************************************************
			 * left sidebar model
			 ******************************************************************************/

			if ($options['left01-width'] != 0) {
				print"
				<td valign='top' width='".$model_left_sidebar_width."' class='left01block'>
					<div style='font-size: 10px; text-align: center; color: ".$options['left01-heading-color'].";'>&larr; ".$model_left_sidebar_width." px &rarr; </div>
					<div style='font-size: 8px; margin: 4px;'>					
					<h2 style='margin-bottom: 2px; margin-top: 2px; color: ".$options['left01-heading-color'].";'>Left Sidebar</h2>
					<div class='editwidgetlink' style='font-size: 10px; border-color: ".$options['leftt01-link-color']."'>";
					
					if (is_active_sidebar("sidebar-1")) {
						print "<a style='color:".$options['left01-link-color']."; border-color:".$options['left01-link-color']." ' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a></div><br/>";
						if (is_array($current_widgets['sidebar-1'])) {
							foreach ($current_widgets['sidebar-1'] as $widget) {
								$widget = str_replace("-", " ", $widget);
								$widget = str_replace("_", " ", $widget);
								$widget = rtrim(ucwords($widget), "0..9");
								print "<div class='widgetbox' style='color: ".$options['left01-heading-color']."; border-color: ".$options['left01-heading-color'].";'>";
								print $widget;
								print "</div>";	
							}
						}

					} else {
						print "<a style='color:".$options['left01-link-color'].";' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Add Widgets</a>";
						print "<div style='font-size: 10px; padding-left: 10px; color: ".$options['left01-heading-color'].";'>no widgets...</div>";
						print "<div style='font-size: 9px; padding-left: 10px; color: ".$options['left01-heading-color'].";'>add widgets or hide sidebar...</div>";
					}
					
					print "</div>";
										
					if ($options['model-instructions'] == "init" || $options['model-instructions'] == "on") {
						print "
						<div class='instructions' style='font-size: 8px;'>	
							<i>Recommended widgets:<br/>";					
							if ($options['right01-width'] == 0 && $options['right02-width'] == 0) {
								print "								
								1. Search<br/>
								2. Pages<br/>
								3. Recent Posts<br/>
								4. Recent Comments<br/>
								5. Categories<br/>
								6. Tag Cloud<br/>";
							} else {
								print "
								1. Pages<br/>
								2. Categories<br/>";							
							}
							print "
							</i>
						</div>		
						";							
					}
					print "
					
				</td>";
			}
			
			/*********************************************************
			 * model main column contains options for:
			 * sidebar colors and widths
			 * post model with text and link color and style options
			 *********************************************************/
			
			print "
			<td class='contentblock' style='color: ".$options['textcolor']."'>	
				<div style='font-size: 10px; text-align: center;'> &larr; ".$model_content_width." px &rarr;</div>
				<div style='font-size: 10px; text-align: center;'>";
				
				/*********************************************************
				 * Content Sidebar Options
				 *********************************************************/			
				print "<span style='font-size: 10px;'>Content</span>\n";
				
				// color
				get_option_selector ("", "content-color", $options_values['sidebar-color']);

				// opacity
				get_option_selector ("", "content-opacity", $options_values['sidebar-opacity']);

				// border
				get_option_selector ("", "content-border-style", $options_values['border-style']);
				print "
				</div>
				<table width = '100%' cellpadding='0'>
					<tr><td valign='top'>
						<table width = '100%' cellpadding='0'>";
						
							/*********************************************************
							 * Left Sidebar Options
							 *********************************************************/							
							
							print "<tr><td class='optionsrow'>";
							print "<div>Left Sidebar</div>\n";
							// color
							get_option_selector ("", "left01-color", $options_values['sidebar-color']);
							// opacity
							get_option_selector ("", "left01-opacity", $options_values['sidebar-opacity']);
							//width
							get_option_selector ("", "left01-width", $options_values['sidebar-width']);
							// border
							get_option_selector ("", "left01-border-style", $options_values['border-style']);
							if (is_active_sidebar("sidebar-1") && $options['left01-width'] == 0) {
								print "<span style='font-size: 10px;'>hidden widgets!</span>";
							}
							
							print "
							</td></tr>
						</table>
						
					</td><td>					
						<table width = '100%' cellpadding='0'>";
					
						/*********************************************************
						 * Right Sidebar Options
						 *********************************************************/
						print "<tr><td class='optionsrow' style='text-align: right;'>\n";
						print "<div>Right Sidebar</div>\n";
						
						// color
						get_option_selector ("", "right01-color", $options_values['sidebar-color']);

						// opacity
						get_option_selector ("", "right01-opacity", $options_values['sidebar-opacity']);

						// width
						get_option_selector ("", "right01-width", $options_values['sidebar-width']);

						// border
						get_option_selector ("", "right01-border-style", $options_values['border-style']);
						
						// hidden widgets warning
						if (is_active_sidebar("sidebar-2") && $options['right01-width'] == 0) {
							print "<span style='font-size: 10px;'>hidden widgets!</span>";
						}

						print "</td></tr>";
					
						/*********************************************************
						 * 2nd Right Sidebar Options
						 *********************************************************/
						print "<tr><td class='optionsrow' style='text-align: right;'>\n";
						print "<div>2nd Right Sidebar</div>\n";

						// color
						get_option_selector ("", "right02-color", $options_values['sidebar-color']);

						// opacity
						get_option_selector ("", "right02-opacity", $options_values['sidebar-opacity']);

						// width
						get_option_selector ("", "right02-width", $options_values['sidebar-width']);

						// border
						get_option_selector ("", "right02-border-style", $options_values['border-style']);
						
						// hidden widgets warning
						if (is_active_sidebar("sidebar-3") && $options['right02-width'] == 0) {
							print "<span style='font-size: 10px;'>hidden widgets!</span>";
						}

						print "
						</td></tr>								
					</table>						
					</td></tr>
				</table>
				<hr/>
				";
				
				/*********************************************************
				 * Post model
				 *********************************************************/
				 
				// post single sidebar options
				print "<div style='float: right; clear: left; font-size: 10px;'>\n";
				get_option_selector ("<span style='font-size: 9px;'>single post pages include</span>", "post-single-sidebar", $options_values['sidebar-display']);
				print "
				</div>
				<div style='color: ".$options['linkcolor']."; font-size: 16px; font-weight: bold;'>Post Title</div>";
				
				// author sidebar options
				print "<div style='float: right; clear: both; font-size: 10px;'>\n";
				get_option_selector ("<span style='font-size: 9px;'>author pages include</span>", "author-single-sidebar", $options_values['sidebar-display']);
 				print "						
				</div>
				<div style='font-size: 9px;'>April 16th, 2009 by Author</div>";
								
				// category sidebar options				
				print "<div style='float: right; clear: both; font-size: 10px;'>\n";
				get_option_selector ("<span style='font-size: 9px;'>category archive includes</span>", "category-single-sidebar", $options_values['sidebar-display']);
				print "
				</div>
				
				<div>
				<span class='entry'>Categories: </span><span class='category'><a href='#'>Category</a></span>
				</div>
				
				<div class='entry'>
				<p>Lorem ipsum dolor sit amet, <span class='entry-visited'>visited link</span> 
				adipiscing elit. Donec ac felis non mauris tristique vehicula. 
				Nunc commodo, justo vel imperdiet cursus, leo dui <a href='#'>link</a>, vel bibendum neque justo nec ipsum. 
				Aliquam erat volutpat. <a href='#'>another link</a> leo tellus, sagittis id mollis non, pretium a tellus.</p>
				</div>";
								
				// tag sidebar options
				print "<div style='float: right; clear: left; font-size: 10px;'>\n";
				get_option_selector ("<span style='font-size: 9px;'>tag archive includes</span>", "tag-single-sidebar", $options_values['sidebar-display']);
				print"
				</div>
				<div>
				<span class='entry'>Tags: </span><span class='tag'><a href='#'>tag</a></span>
				</div>
				
				<div class='entry' style='text-align: right;'>No Comments &#187;</div><br/>";

				// search sidebar options
				print "<div style='float: right; clear: both; font-size: 10px;'>";
				get_option_selector ("<span style='font-size: 9px;'>search archive includes</span><br/>", "search-single-sidebar", $options_values['sidebar-display']);
				print "</div>";

				// archives sidebar options
				print "<div style=' font-size: 10px;'>";
				get_option_selector ("<span style='font-size: 9px;'>archives page includes</span><br/>", "archives-single-sidebar", $options_values['sidebar-display']);
				print "</div>";

				/*********************************************************
				 * Text, Link, Category and Tag options
				 *********************************************************/
				
				print "
				<hr/>
				<table width = '100%' cellpadding='0'>
				<tr><td valign='top'>	

					<table width = '100%' cellpadding='0'>
						<tr>
						<td style='border-bottom: 1px dotted;'><span style='font-size: 10px; color:".$options['textcolor'].";'>Text Alignment</span></td>							
						<td style='border-bottom: 1px dotted; text-align: right;'>";
						
						// text color options
						get_option_selector ("", "entry-text-align", $options_values['entry-text-align']);
						print "		 							
						</td>								
						</tr>						<tr>
						<td style='border-bottom: 1px dotted;'><span style='font-size: 10px; color:".$options['textcolor'].";'>Text color</span></td>							
						<td style='border-bottom: 1px dotted; text-align: right;'>";
						
						// text color options
						get_option_selector ("", "textcolor", $options_values['textcolor']);
						print "		 							
						</td>								
						</tr>
						<tr>
						<td style='border-bottom: 1px dotted;'><span style='font-size: 10px; color:".$options['linkcolor'].";'>Link color</span></td>
						<td style='border-bottom: 1px dotted; text-align: right;'>";							
						// link color options
						get_option_selector ("", "linkcolor", $options_values['linkcolor']);
						print "
						</td>								
						</tr>						
					</table>
				</td><td valign='top' width='50%'>
					<table width = '100%' cellpadding='0'>
						<tr>";
						
						// category link style
						print "
						<td style='border-bottom: 1px dotted;'><span class='category' style='font-size: 10px;'><a href='#'>Category Link</a></span></td>
						<td style='border-bottom: 1px dotted; text-align: right;'>";
						
						get_option_selector ("", "category-link-style", $options_values['category-link-style']);
						print "
						</td>								
						</tr><tr>";
						
						// Tag link style
						print "
						<td style='border-bottom: 1px dotted;'><span class='tag' style='font-size: 10px;'><a href='#'>Tag Link</a></span></td>
						<td style='border-bottom: 1px dotted; text-align: right;'>\n";							
						get_option_selector ("", "tag-link-style", $options_values['tag-link-style']);
						print "
						</td>
						</tr><tr>";
						// Entry link style
						print "
						<td style='border-bottom: 1px dotted;'><span class='entry' style='font-size: 10px;'><a href='#'>Entry Link</a></span></td>
						<td style='border-bottom: 1px dotted; text-align: right;'>\n";							
						get_option_selector ("", "entry-link-style", $options_values['entry-link-style']);
						print "
						

					</table>						
				</table>
			</td>";
			
			/*********************************************************
			 * right sidebar model
			 *********************************************************/

			if ($options['right01-width'] != 0) {
				print"
				<td valign='top' width='".$model_right_sidebar_width."' class='right01block'>
					<div style='font-size: 10px; text-align: center; color: ".$options['right01-heading-color'].";'>&larr; ".$model_right_sidebar_width." px &rarr;</div>
					<div style='font-size: 8px; margin: 4px;'>
					<div style='font-size: 8px;'>
					<h2 style='margin-bottom: 2px; margin-top: 2px; color: ".$options['right01-heading-color'].";'>Right Sidebar</h2></div>
					<div class='editwidgetlink' style='font-size: 10px; border-color: ".$options['right01-link-color']."'>";

					if (is_active_sidebar("sidebar-2")) {
						print "<a style='color:".$options['right01-link-color']."; border-color:".$options['right01-link-color']." ' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a></div><br/>";
						if (is_array($current_widgets['sidebar-2'])) {
							foreach ($current_widgets['sidebar-2'] as $widget) {
								$widget = str_replace("-", " ", $widget);
								$widget = str_replace("_", " ", $widget);
								$widget = rtrim(ucwords($widget), "0..9");
								print "<div class='widgetbox' style='color: ".$options['right01-heading-color']."; border-color: ".$options['right01-heading-color'].";'>";
								print $widget;
								print "</div>";	
							}
						}
						
					} else {
						print "<a style='color:".$options['right01-link-color'].";' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Add Widgets</a></div>";
						print "<div style='font-size: 10px; padding-left: 10px; color: ".$options['right01-heading-color'].";'>no widgets...</div>";
						print "<div style='font-size: 9px; padding-left: 10px; color: ".$options['right01-heading-color'].";'>add widgets or use defaults...</div>";
						print "<div class='submit'><input type='submit' value='Add Default Widgets' name='default_widgets'/></div>";
					}
					
					
					
					if ($options['model-instructions'] == "init" || $options['model-instructions'] == "on") {
						print "
						<div class='instructions' style='font-size: 8px;'>	
							<i>Recommended widgets:<br/>";
							if ($options['left01-width'] == 0 && $options['right02-width'] == 0) {
								print "								
								1. Search<br/>
								2. Pages<br/>
								3. Recent Posts<br/>
								4. Recent Comments<br/>
								5. Categories<br/>
								6. Tag Cloud<br/>";
							} else if ($options['left01-width'] == 0 && $options['right02-width'] == 1) {
								print "
								1. Search<br/>
								2. Recent Posts<br/>
								3. Recent Comments<br/>";								
								
							} else {	
								print "
								1. Search<br/>
								2. Recent Posts<br/>
								3. Recent Comments<br/>
								4. Tag Cloud<br/>";							
							}
							print "
							</i>
						</div>		
						";		
					}
					print "
					</div>	
				</td>";
			}
			/*********************************************************
			 * 2nd right sidebar model
			 *********************************************************/

			if ($options['right02-width'] != 0) {
				print"
				<td valign='top' width='".$model_right_sidebar_width02."'  class='right02block'>
					<div style='font-size: 10px; text-align: center; color: ".$options['right02-heading-color'].";'>&larr; ".$model_right_sidebar_width02." px &rarr;</div>
					<div style='font-size: 8px; margin: 4px;'>
					<div style='font-size: 8px;'>
					<h2 style='margin-bottom: 2px; margin-top: 2px; color: ".$options['right02-heading-color'].";'>2nd Right Sidebar</h2></div>
					<div class='editwidgetlink' style='font-size: 10px; border-color: ".$options['right02-link-color']."'>";

					if (is_active_sidebar("sidebar-3")) {
						print "<a style='color:".$options['right02-link-color']."; border-color:".$options['right02-link-color']." ' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a></div><br/>";
						if (is_array($current_widgets['sidebar-3'])) {
							foreach ($current_widgets['sidebar-3'] as $widget) {
								$widget = str_replace("-", " ", $widget);
								$widget = str_replace("_", " ", $widget);
								$widget = rtrim(ucwords($widget), "0..9");
								print "<div class='widgetbox' style='color: ".$options['right02-heading-color']."; border-color: ".$options['right02-heading-color'].";'>";
								print $widget;
								print "</div>";	
							}
						}

					} else {
						print "<a style='color:".$options['right02-link-color'].";' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Add Widgets</a>";
						print "<div style='font-size: 10px; padding-left: 10px; color: ".$options['right02-heading-color'].";'>no widgets...</div>";
						print "<div style='font-size: 9px; padding-left: 10px; color: ".$options['right02-heading-color'].";'>add widgets or hide sidebar...</div>";
					}

					print "</div>";
					
					if ($options['model-instructions'] == "init" || $options['model-instructions'] == "on") {
						print "
						<div class='instructions' style='font-size: 8px;'>	
							<i>Recommended widgets:<br/>";
							if ($options['left01-width'] == 0 && $options['right01-width'] == 0 ) {
								print "								
								1. Search<br/>
								2. Pages<br/>
								3. Recent Posts<br/>
								4. Recent Comments<br/>
								5. Categories<br/>
								6. Tag Cloud<br/>";
							} else if ($options['left01-width'] == 0 && $options['right01-width'] == 1) {
								print "
								1. Pages<br/>
								2. Categories<br/>
								3. Tag Cloud<br/>";
							} else {
								print "
								1. Pages<br/>
								2. Categories<br/>
								3. Tag Cloud<br/>";							
							}
							print "
							</i>
						</div>		
						";		
					}
					print "
				</td>";
			}
			print "	
			</tr>
		</table>
	
		<table width='100%' cellspacing='2' cellpadding='0'>
		<tr>
		<td class='bottomblock'>";	
		
		/*********************************************************
		 *  bottom bar model
		 *********************************************************/
		
		if ($options['model-instructions'] == "init" || $options['model-instructions'] == "on") {
			print "
			<div class='instructions' style='margin: 2px;'>	
				<span style='font-size: 8px;'><i>Use this area for additional RSS feeds, links to other related sites.  Recommended widgets: Text/HTML, RSS</i></span>
			</div>		
			";		
		}		
		print "	
		<h2 style='padding-top: 0px; font-size: 10px; float: left;'>Bottom Bar</h2>
		<div class='horizontalbar' style='font-size: 8px; float: left;'>";
		// color
		get_option_selector ("", "bottom-color", $options_values['sidebar-color']);

		// opacity
		get_option_selector ("", "bottom-opacity", $options_values['sidebar-opacity']);

		// border
		get_option_selector ("", "bottom-border-style", $options_values['border-style']);			 				
		print"
		</div>		
		<div style='float: left;  margin-top: 3px; width: 100%'>
		<div class='editwidgetlink' style='text-align: center; float: left; margin-top: -3px;'> 
		<a style='color:".$options['top-link-color']."; font-size: 10px; border-color: ".$options['top-link-color']."' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>
		</div>				
		";
		if (is_array($current_widgets['sidebar-5'])) {
			foreach ($current_widgets['sidebar-5'] as $widget) {
				$widget = str_replace("-", " ", $widget);
				$widget = str_replace("_", " ", $widget);
				$widget = rtrim(ucwords($widget), "0..9");
				print "<span class='widgetbox' style='color: ".$options['bottom-heading-color']."; border-color: ".$options['bottom-heading-color'].";'>";
				print $widget;
				print "</span>";					
			}
		}
		
		print "
		</div>
		</td>
		</tr>
		</table>

	<table width='100%' cellpadding='5'>
	<tr><td width='80%'>
	</td>
	<td valign='bottom' width='20%'>

	</td></tr>
	</table>
	</div>
	<div class='page_bottom'></div>
	
	<div style='font-size: 9px; float: right; clear: left; color: ".$options['bgtextcolor'].";'>";
	print $options['theme-name'];
	print " | WordPress
	</div>
	
	<div style='font-size: 9px; color: ".$options['bgtextcolor'].";'>";

		if ($options['footerleft'] == "") {
			print "no links defined...";
		} else {
			print $options['footerleft'];
		}
		if ($options['footer-meta-left'] == 'custom') {
			print "
				<input id='footerleftdo' type='hidden' name='footerleftdo' value='0'/> - 
		
				<a href='javascript: document.getElementById(\"footerleftedit\").style.display = \"block\"; document.getElementById(\"footerleftdo\").value = \"1\"; exit;'>edit</a>
				
				<div id='footerleftedit' style='display: none;'>
				
				<textarea name='footerleftcustom' style='width: 100%; height: 50px; font-size: 10px;' class='code'>";
				print stripslashes(stripslashes(trim($options['footerleftcustom'])));
				print "</textarea>		
				&nbsp;&nbsp;&nbsp;
				<a href='javascript: document.getElementById(\"footerleftedit\").style.display = \"none\"; document.getElementById(\"footerlefteditdo\").value = \"0\"; exit;'>Cancel</a> - 
				<span class='submit'><input type='submit' value='Update' name='save'/></span>	
				</div>
			";
	
			print "</div>\n";
		}
	print "</div>";
	// end options		

	/*********************************************************
	 * ShadowBox Theme instructions and Save Changes button
	 *********************************************************/

    	// footer meta left appgroups options		
	if (in_array("footer-meta-left", $variation_config['model'])) {
		print "<span style='font-size: 9px;'>Footer Links:</span>\n";
		print "<select name='footer-meta-left' style='font-size: 10px;'  onchange='this.form.submit();'>";
		
		foreach (array_keys($variation_config['footer_meta_left_options']) as $meta_left_option) {						
			print "<option value='".$variation_config['footer_meta_left_options'][$meta_left_option]['option_name']."' ";
			print ($options['footer-meta-left'] == $variation_config['footer_meta_left_options'][$meta_left_option]['option_name'] ? ' selected' : '') . ">";
			print $variation_config['footer_meta_left_options'][$meta_left_option]['option_label']."</option>";						
		}
		print "</select>";
		
	}
	print "
    <table width = '".$model_site_width."' align='center' cellpadding='5' cellspacing='5' border='0'>
    <tr><td>
    <span class='submit'><input type='submit' value='Update' name='save'/></span>
    </td><td>
    <div class='instructions'>	
	When chosing options think about colors and contrasts that complement your content.  For example, if your site focuses on links, be sure your link color contrasts with your 
	text color so links will stand out.  Chose the black theme for blogs that highlight images.  <br/>
	</div>
	</td><td>
	<span class='submit'><input type='submit' value='Revert to Default' name='reset'/></span>
	</td></tr>
	</table>
	</form>";

}	

function save_options() {
    global $_POST, $options, $variation_css, $variation_config;
    global $theme_settings, $theme_css;

	// options are those exposed in the UI
	set_primary_options();

	// options specific to a particular variation
	set_variation_options();
	
	if ($options['site-width'] == 100) {
		$sitewidth = $options['site-width']-10;
		$sitewidth = $sitewidth."%";
	} else {
		$sitewidth = $options['site-width']."px";
	}

	if ($options['header-width'] == 100) {
		$headerwidth = $options['header-width']-10;
		$headerwidth = $headerwidth."%";
	} else {
		$headerwidth_measure = $options['header-width'] - 8;
		$headerwidth = $headerwidth_measure."px";
		$contentwidth = ($headerwidth_measure-20)."px";
	}

	/******************************************************************************
	 * add theme options to theme CSS
	 ******************************************************************************/
	
	$variation_css =
	"	
		body {
			font-size: 62.5%;
			font-family:'Helvetica Neue',Arial,Helvetica,sans-serif;
			color: ".$options['textcolor'].";
			background-color: ".$options['background_color'].";
			background-image: ".$options['background_image'].";
			background-repeat: ".$options['background_repeat'].";
			background-position: ".$options['background_position'].";	 
			margin-top: 10px;
		}
	
		.sitewrapper {
			width: ".$sitewidth.";
			margin-left: auto;
			margin-right: auto;
			margin-top: ".$options['site-margin-top']."px;
		}

		.headerwrapper {
			width: ".$headerwidth.";
			margin-left: auto;
			margin-right: auto;
		}

		#wrapper,
		#branding {
			margin: 0 auto;
			width: ".$headerwidth.";		
		}

		/* The main theme structure */
		#access .menu-header,
		div.menu,
		#colophon,
		#main {
			margin: 0 auto;
			width: ".$contentwidth.";
		}

		.page_top {
			background-image: ".$options['page_top_background_image'].";
			background-repeat: no-repeat;
			background-position: center;
			border-top: 1px none #000000;
			border-left: 1px none #000000;
			border-right: 1px none #000000;
			padding-top: ".$options['page_top_padding']."px;
			margin-top: ".$options['page_top_margin']."px;
		}
		
		.page_main {
			background-color: transparent;
			background-image:  ".$options['page_main_background_image']."; 
			background-repeat: repeat-y; 
			background-position: center;
			border-left: 1px none #000000;
			border-right: 1px none #000000;
			padding-top: ".$options['page_main_top_padding']."px;
			padding-right: ".$options['page_main_padding']."px;
			padding-left: ".$options['page_main_padding']."px;
		}
				
		.page_bottom {
			background-color: transparent;
			background-image:  ".$options['page_bottom_background_image'].";
			background-repeat: no-repeat; 
			background-position: center;
			border-bottom: 1px none #000000;
			border-left: 1px none #000000;
			border-right: 1px none #000000;
			padding-top: ".$options['page_bottom_padding']."px;
			margin-bottom: ".$options['page_bottom_margin']."px;
		}

		#header {
			border-bottom: 1px ".$options['header-outer-border-style']." ".$options['header-border02-top'].";
			border-top: 1px ".$options['header-outer-border-style']." ".$options['header-border02-bottom'].";
			margin: 0 0 0 1px;
			padding: 0 2px 0 2px;
		}

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


		.contentblock, .widecolumn, .narrowcolumn {
			color: ".$options['content-text-color'].";
			background-color: ".$options['content-color-rgb'].";
			border-top: 1px ".$options['content-border-style'] ." ".$options['content-border-top'].";
			border-bottom: 1px ".$options['content-border-style'] ." ".$options['content-border-bottom'].";
			border-left: 1px ".$options['content-border-style'] ." ".$options['content-border-left'].";
			border-right: 1px ".$options['content-border-style'] ." ".$options['content-border-right'].";
			padding-right: 20px;
			padding-left: 20px;
			padding-bottom: 20px;
		}

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

		.headerblock {
			color: ".$options['header-text-color'].";
			background-color: ".$options['header-color-rgb'].";
			border-top: 1px ".$options['header-border-style']." ".$options['header-border-top'].";
			border-bottom: 1px ".$options['header-border-style']." ".$options['header-border-bottom'].";
			border-left: 1px ".$options['header-border-style']." ".$options['header-border-left'].";
			border-right: 1px ".$options['header-border-style']." ".$options['header-border-right'].";				
			padding-top: 0px;
			height: ".$options['header-block-height']."px;
		}
		
		.headerblock:hover {
			background-color: ".$options['header-color-hover-rgb'].";
			border-top: 1px ".$options['header-hover-border-style']." ".$options['header-border-top'].";
			border-bottom: 1px ".$options['header-hover-border-style']." ".$options['header-border-bottom'].";
			border-left: 1px ".$options['header-hover-border-style']." ".$options['header-border-left'].";
			border-right: 1px ".$options['header-hover-border-style']." ".$options['header-border-right'].";	 
		}

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

		.bottomblock {
			color:  ".$options['bottom-text-color'].";
			background-color: ".$options['bottom-color-rgb'].";
			border-top: 1px ".$options['bottom-border-style']." ".$options['bottom-border-top'].";
			border-bottom: 1px ".$options['bottom-border-style']." ".$options['bottom-border-bottom'].";
			border-left: 1px ".$options['bottom-border-style']." ".$options['bottom-border-left'].";
			border-right: 1px ".$options['bottom-border-style']." ".$options['bottom-border-right'].";				
			padding-top: 2px;
			padding-bottom: 2px;
			padding-left: 10px;
			margin-right: 5px;
		}
		
		.bottomblock:hover {
			background-color: ".$options['bottom-color-hover-rgb'].";
			border-top: 1px ".$options['bottom-hover-border-style']." ".$options['bottom-border-top'].";
			border-bottom: 1px ".$options['bottom-hover-border-style']." ".$options['bottom-border-bottom'].";
			border-left: 1px ".$options['bottom-hover-border-style']." ".$options['bottom-border-left'].";
			border-right: 1px ".$options['bottom-hover-border-style']." ".$options['bottom-border-right'].";		
		}		

		.bottomblock a {
			color: ".$options['bottom-link-color'].";		
		}

		.bottomblock a:hover {
			color: ".$options['bottom-link-color'].";	
			border-bottom: 1px solid ".$options['bottom-link-color'].";	
		}
		
		div .hr {
			color: ".$options['header-border-top'].";
			background-color: ".$options['header-border02-top'].";
			height: ".$options['header-border02-height']."px;
			margin-right: -1px;
			margin-left: -1px;
			margin-bottom: 0px;
		}
		
		.headertext a {
			display: ".$options['show-header-text'].";
			padding-top: ".$options['header-text-padding-top']."px;
			padding-left: ".$options['header-text-padding-left']."px;
			color: ".$options['header-blogtitle-color'].";
			font-size: ".$options['header-blogtitle-size']."px;
			font-weight: normal;	
			text-shadow: ".$options['header-text-shadow-color']." ".$options['header-text-shadow-offset']." ".$options['header-text-shadow-blur'].";
			border-bottom: none;
		}

		.headertext a:hover {
			display: ".$options['show-header-text'].";
			padding-top: ".$options['header-text-padding-top']."px;
			padding-left: ".$options['header-text-padding-left']."px;
			color: ".$options['header-blogtitle-color'].";
			text-shadow: ".$options['header-text-shadow-color']." ".$options['header-text-shadow-offset']." ".$options['header-text-shadow-blur'].";
			border-bottom: none;
		}

		
		.headerblock .description {
			display: ".$options['show-header-text'].";
			padding-left: 15px;
			color: ".$options['header-blogdescription-color'].";
			font-size: 12px;
		}
		
		/* Begin sidebar list */
		.sidebarleft01 ul ul li, .sidebarleft01 ul ol li {
			font-size: 12px;
			color: ".$options['left01-text-color'].";
			list-style-type:none;
			margin: 3px 0 -4px;
			padding: 3px;
			padding-right: 10px;
		}
		
		.sidebarright01 ul ul li, .sidebarright01 ul ol li {
			font-size: 12px;
			color: ".$options['right01-text-color'].";
			list-style-type:none;
			margin: 3px 0 -4px;
			padding: 3px;
			padding-right: 10px;
		}

		.sidebarright02 ul ul li, .sidebarright02 ul ol li {
			font-size: 12px;
			color: ".$options['right02-text-color'].";
			list-style-type:none;
			margin: 3px 0 -4px;
			padding: 3px;
			padding-right: 10px;
		}
		
		/* Begin sidebar search form */
		.sidebarleft01  #searchform #s {
			background-color: ".$options['searchbox-color'].";
			color: ".$options['linkcolor'].";
			border: 1px solid #999999;
			width: 108px;
			padding: 2px;			
		}

		.sidebarright01  #searchform #s {
			background-color: ".$options['searchbox-color'].";
			color: ".$options['linkcolor'].";
			border: 1px solid #999999;
			width: 108px;
			padding: 2px;				
		}

		.sidebarright02  #searchform #s {
			background-color: ".$options['searchbox-color'].";
			color: ".$options['linkcolor'].";
			border: 1px solid #999999;
			width: 108px;
			padding: 2px;			
		}

		/* Begin block color borders and opacity */
		.left01block {
			color: ".$options['left01-text-color'].";
			background-color: ".$options['left01-color-rgb'].";
			border-top: 1px ".$options['left01-border-style']." ".$options['left01-border-top'].";
			border-bottom: 1px ".$options['left01-border-style']." ".$options['left01-border-bottom'].";
			border-left: 1px ".$options['left01-border-style']." ".$options['left01-border-left'].";
			border-right: 1px ".$options['left01-border-style']." ".$options['left01-border-right'].";
			width: ".$options['left01-width']."px;
		}

		.left01block:hover {
			background-color: ".$options['left01-color-hover-rgb'].";
			border-top: 1px ".$options['left01-hover-border-style']." ".$options['left01-border-top'].";
			border-bottom: 1px ".$options['left01-hover-border-style']." ".$options['left01-border-left'].";
			border-left: 1px ".$options['left01-hover-border-style']." ".$options['left01-border-left'].";
			border-right: 1px ".$options['left01-hover-border-style']." ".$options['left01-border-right'].";
		}
				
		.right01block {
			color: ".$options['right01-text-color'].";
			background-color: ".$options['right01-color-rgb'].";
			border-top: 1px ".$options['right01-border-style']." ".$options['right01-border-top'].";
			border-bottom: 1px ".$options['right01-border-style']." ".$options['right01-border-bottom'].";
			border-left: 1px ".$options['right01-border-style']." ".$options['right01-border-left'].";
			border-right: 1px ".$options['right01-border-style']." ".$options['right01-border-right'].";
			width: ".$options['right01-width']."px;
		}
		
		.right01block:hover {
			background-color: ".$options['right01-color-hover-rgb'].";
			border-top: 1px ".$options['right01-hover-border-style']." ".$options['right01-border-top'].";
			border-bottom: 1px ".$options['right01-hover-border-style']." ".$options['right01-border-right'].";
			border-left: 1px ".$options['right01-hover-border-style']." ".$options['right01-border-left'].";
			border-right: 1px ".$options['right01-hover-border-style']." ".$options['right01-border-right'].";
		}

		.right02block {
			color: ".$options['right02-text-color'].";
			background-color: ".$options['right02-color-rgb'].";
			border-top: 1px ".$options['right02-border-style']." ".$options['right02-border-top'].";
			border-bottom: 1px ".$options['right02-border-style']." ".$options['right02-border-bottom'].";
			border-left: 1px ".$options['right02-border-style']." ".$options['right02-border-left'].";
			border-right: 1px ".$options['right02-border-style']." ".$options['right02-border-right'].";
			width: ".$options['right02-width']."px;
		}

		.right02block:hover {
			background-color: ".$options['right02-color-hover-rgb'].";
			border-top: 1px ".$options['right02-hover-border-style']." ".$options['right02-border-top'].";
			border-bottom: 1px ".$options['right02-hover-border-style']." ".$options['right02-border-right'].";
			border-left: 1px ".$options['right02-hover-border-style']." ".$options['right02-border-left'].";
			border-right: 1px ".$options['right02-hover-border-style']." ".$options['right02-border-right'].";
		}
		
		/* Begin sidebar text, width and visibility  */
		.sidebarleft01 {
			color: ".$options['left01-text-color'].";
			width: ".$options['left01-width']."px;
			visibility: ".$options['left01-visibility'].";
			padding-left: 25px;
			padding-right: 25px;
		}

		.sidebarright01 {
			width: ".$options['right01-width']."px;
			visibility: ".$options['right01-visibility'].";
			padding-left: 25px;
			padding-right: 25px;
		}

		.sidebarright02 {
			width: ".$options['right02-width']."px;
			visibility: ".$options['right02-visibility'].";
			padding-left: 25px;
			padding-right: 25px;
		}
		
		/* Begin sidebar links */
		.sidebarleft01 a {
			color: ".$options['left01-link-color'].";
			border-bottom:1px none ".$options['left01-link-color'].";
		}
				
		.sidebarleft01 a:hover {
			color: ".$options['left01-link-color'].";
			border-bottom:1px solid ".$options['left01-link-color'].";
		}
		
		.sidebarright01 a {
			color: ".$options['right01-link-color'].";
			border-bottom:1px none ".$options['right01-link-color'].";
		}
				
		.sidebarright01 a:hover {
			color: ".$options['right01-link-color'].";
			border-bottom:1px solid ".$options['right01-link-color'].";
		}

		.sidebarright02 a {
			color: ".$options['right02-link-color'].";
			border-bottom:1px none ".$options['right02-link-color'].";
		}

		.sidebarright02 a:hover {
			color: ".$options['right02-link-color'].";
			border-bottom:1px solid ".$options['right02-link-color'].";
		}		
		
		/* Begin sidebar headings */
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

		.sidebarleft01 h2 {
			color: ".$options['left01-heading-color'].";
			padding-left: 0px;
			border-bottom: 1px none #CCCCCC;
		}
				
		.sidebarright01 h2 {
			color: ".$options['right01-heading-color'].";
			padding-left: 0px;
			border-bottom: 1px none #CCCCCC;
		}

		.sidebarright02 h2 {
			color: ".$options['right02-heading-color'].";
			padding-left: 0px;
			border-bottom: 1px none #CCCCCC;
		}
		
		/* Begin entry/post links */
		
		.entry {
			text-align: ".$options['entry-text-align'].";
		}
		
		.entry a {
			color: ".$options['linkcolor'].";	
			text-decoration:none;
			border-bottom: 1px ".$options['entry-link-border'].";
			padding:0.07em;
		}

		.entry a:hover {
			border-bottom: 1px ".$options['entry-link-hover-border']."; 
			background-color: ".$options['entry-link-hover-background_color'].";
		}

		.entry a:visited {
			color: ".$options['linkcolor_visited'].";		
			border-bottom: 1px ".$options['entry-link-border'].";
		}

		.entry .morelink a {
			display: block;			
			text-align: center;
			border-top: 1px solid #CCCCCC;
			border-bottom: 1px dotted #CCCCCC;
			text-decoration: none;
		}
		
		.morelink a:hover {
			background-color: transparent;
			color: ".$options['linkcolor'].";
			border-top: 1px solid ".$options['content-link-color'].";
			border-bottom: 1px dotted ".$options['content-link-color'].";
		}

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
		.tag a {
			-moz-border-radius-bottomleft:3px; 
			-moz-border-radius-bottomright:3px; 
			-moz-border-radius-topleft:3px; 
			-moz-border-radius-topright:3px; 
			color:".$options['tag-link-color'].";
			background-color:".$options['tag-link-background'].";
			border:1px solid #ccc; 
			cursor:pointer; 
			display:inline-block; 
			margin:2px 0.2em; padding:0.1em 0.2em;			
		}
		
		.tag a:hover {
			text-decoration: ".$options['tag-link-hover-decoration'].";
			background-color: ".$options['tag-link-background'].";
			border:1px solid ".$options['linkcolor']."; 
		}
		
		/* Begin category links */
		.category a {
			-moz-border-radius-bottomleft:3px; 
			-moz-border-radius-bottomright:3px; 
			-moz-border-radius-topleft:3px; 
			-moz-border-radius-topright:3px; 
			color:".$options['category-link-color'].";
			background-color:".$options['category-link-background'].";
			border:1px solid #ccc; 
			cursor:pointer; 
			display:inline-block; 
			margin:2px 0.2em; padding:0.1em 0.2em;	
		}

		.category a:hover {
			text-decoration: ".$options['category-link-hover-decoration'].";
			background-color: ".$options['category-link-background'].";
			border:1px solid ".$options['linkcolor']."; 
		}		
		
		/* Begin editing UI links */
		.postlink a {
			display: block;
			border: 1px dotted ".$options['linkcolor'].";
			text-align: center;
			padding: 5px;
			margin-top: 10px;
		}

		.postlink a:hover {
			display: block;
			border: 1px solid ".$options['linkcolor'].";
			text-align: center;
			padding: 5px;
			margin-top: 10px;
		}

		.editlink a {
			display: block;
			border: 1px dotted ".$options['linkcolor'].";
			text-align: center;
			text-decoration: none;
			padding: 1px;
			margin-top: 10px;
			margin-bottom: 10px;
		}

		.editlink a:hover {
			background-color: transparent;
			text-decoration: none;
			border: 1px solid ".$options['linkcolor'].";
		}
		
		.post h2 {
			color: ".$options['linkcolor'].";
			display: block;
			text-align: left;
			text-shadow: ".$options['post-text-shadow-color']." ".$options['post-text-shadow-offset']." ".$options['post-text-shadow-blur'].";
			border-bottom: 1px solid #CCCCCC;
		}
		
		.post h2:hover {
			border-bottom: 1px solid ".$options['linkcolor'].";
		}
		
		.post h2 a {
			display: block;
			border-bottom: none;
		}

		.entry h2, .entry h3, .entry h1 {
			color: ".$options['textcolor'].";
			border-bottom: 1px solid #CCCCCC;
		}

		.entry h2:hover, .entry h3:hover, .entry h1:hover {
			border-bottom: 1px solid #CCCCCC;
		}
		
		.entry h2 a, .entry h3 a, .entry h1 a {
			text-decoration: none;
			border-bottom: none;
		}
		
		.entry h2 a:hover, .entry h3 a:hover, .entry h1 a:hover {
			border-bottom: none;
			text-decoration: none;
		}

		.entry h2 a:visited, .entry h3 a:visited, .entry h1 a:visited {
			display: block;
			text-decoration: none;
			border-bottom: none;
		}

				
		/* Begin comments */
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
		
	update_option($theme_settings, $options);
	update_option($theme_css, $variation_css);
	
	print_option_feedback();
	
}

/*********************************************************
 * set primary options (options exposed to user in model)
 *********************************************************/
 
function set_primary_options() {
	global $_POST, $options, $allowedposttags, $variation_config;

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
	
	if ($variation_config['headermeta'] == "on") $options['headermeta'] = "on";

	if (isset($_POST['model-instructions'])) {
		$options['model-instructions'] = "on";
	} else if (!isset($_POST['model-instructions']) || $options['model-instructions'] == "off") {
		$options['model-instructions'] = "off";
	} else {
		$options['model-instructions'] = "on";
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

	if (file_exists(dirname(__FILE__).'/variations/default/variation.php')) {
		include('variations/default/variation.php');		
	}

	/*********************************************************
	 * Custom backgrounds
	 * Following options are set in the model UI
	 * background_image_url, background_color
	 * background_repeat, background_position
	 * bgtextcolor, bglinkcolor
	 *********************************************************/
	if ($options['background'] == "custom") {			
		$options['background_image'] = "url('".$options['background_image_url']."')";	
		$options['background_color'] = $options['custom_background_color'];
		$options['background_repeat'] = $options['custom_background_repeat'];
		$options['background_position'] = $options['custom_background_position'];
		$options['bgtextcolor'] = $options['custom_bgtextcolor'];
		$options['bglinkcolor'] = $options['custom_bglinkcolor'];
		$options['transparent-blogtitle-color'] = $options['custom_header_color'];
		$options['transparent-blogdescription-color'] = $options['custom_bgtextcolor'];
		$options['transparent-heading-color'] = $options['custom_header_color'];
		$options['transparent-link-color']  = $options['custom_bglinkcolor'];
		$options['transparent-text-color']  = $options['custom_bgtextcolor'];
		$options['background-source-url'] = $options['custom_background-source-url'];
		$options['background-source-credit'] = $options['custom_background-source-credit'];
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
	
	if (file_exists(dirname(__FILE__).'/variations')) {
		$variation_path = dirname(__FILE__).'/variations';
		
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
		if (!in_array($options['header-blogtitle-color'], array_values($options_values['linkcolor']))) $options['header-blogtitle-color'] = $options['linkcolor'];	
	}
	
	set_derivative_options();	
}

/*********************************************************
 * Set directive options uses primary options (i.e. those exposed in UI)
 * to set derivative options
 *********************************************************/

function set_derivative_options() {
	global $variation_config, $_POST, $options, $options_values;

	/******************************************************************************
	 * Header left links (derived from  header_meta_left_options
	 ******************************************************************************/

	if ($options['header-meta-left'] == 'blogs' && $variation_config['header_meta_left_options']['blog'] == "") {
		$options['headerleft'] = "<a href='http:".$current_site->domain . $current_site->path."wp-signup.php' title='View your Blogs'>WordPress</a>";
	} else if ($options['header-meta-left'] == 'custom') {
		$options['headerleft'] = stripslashes($options['headerleftcustom']);
	} else {
		$options['headerleft'] = $variation_config['header_meta_left_options'][$options['header-meta-left']]['option_value'];					
	}

	/******************************************************************************
	 * Header right links (derived from header_meta_right_options)
	 ******************************************************************************/

	if (isset($variation_config['header_meta_right_options'])) {
		$options['headerright'] = $variation_config['header_meta_right_options']['option_value'];
	} else {
		$options['headerright'] = "";
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
		$options['show-header-text'] = "block";
	} else {
		$options['show-header-text'] = "none";
	}
	
	if ($options['header-text-display'] == "top") {
		$options['header-text-padding-top'] = 3;
		
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
	 * sidebar color and link options
	 ******************************************************************************/	

	$widget_bars = array('top', 'bottom', 'left01', 'right01', 'right02', 'header', 'content');
	
	foreach($widget_bars as $bar) {
		
		// white
		if ($options[$bar.'-color'] == '#FFFFFF') {
			$options[$bar.'-border-top'] = "#CCCCCC";
			$options[$bar.'-border-left'] = "#CCCCCC";
			$options[$bar.'-border-bottom'] = "#CCCCCC";
			$options[$bar.'-border-right'] = "#CCCCCC";
			$options[$bar.'-heading-color'] = "#666666";
			$options[$bar.'-link-color'] = $options['linkcolor'];
			$options[$bar.'-text-color'] = $options['textcolor'];
			if ($bar == "header") {
				$options[$bar.'-blogtitle-color'] = $options['linkcolor'];
				$options[$bar.'-blogdescription-color'] = "#666666";
				$options[$bar.'-border02-top'] = "#CCCCCC";
				$options[$bar.'-border02-bottom'] = "#CCCCCC";
			}
		// gray blue
		} else if ($options[$bar.'-color'] == '#364559') {
			$options[$bar.'-border-top'] = "#666666";
			$options[$bar.'-border-left'] = "#666666";
			$options[$bar.'-border-bottom'] = "#666666";
			$options[$bar.'-border-right'] = "#666666";
			$options[$bar.'-heading-color'] = "#CCCC99";
			$options[$bar.'-link-color'] = "#EEEEEE";
			$options[$bar.'-text-color'] = "#CCCCCC";
			if ($bar == "header") {
				$options[$bar.'-blogtitle-color'] = $options['linkcolor'];
				$options[$bar.'-blogdescription-color'] = "#FFFFFF";
				$options[$bar.'-border02-top'] = "#333333";
				$options[$bar.'-border02-bottom'] = "#333333";
			}
		// black
		} else if ($options[$bar.'-color'] == '#000000' || $options[$bar.'-color'] == '#262626') {
			$options[$bar.'-border-top'] = "#666666";
			$options[$bar.'-border-left'] = "#666666";
			$options[$bar.'-border-bottom'] = "#666666";
			$options[$bar.'-border-right'] = "#666666";
			$options[$bar.'-heading-color'] = "#FFFFFF";
			$options[$bar.'-link-color'] = $options['linkcolor'];
			$options[$bar.'-text-color'] = $options['textcolor'];
			if ($bar == "header") {
				$options[$bar.'-blogtitle-color'] = $options['linkcolor'];
				$options[$bar.'-blogdescription-color'] = $options['textcolor'];
				$options[$bar.'-border02-top'] = "#FFFFCC";
				$options[$bar.'-border02-bottom'] = "#FFFFCC";
			}
		// green	
		} else if ($options[$bar.'-color'] == '#83A776') {
			$options[$bar.'-border-top'] = "#666666";
			$options[$bar.'-border-left'] = "#666666";
			$options[$bar.'-border-bottom'] = "#666666";
			$options[$bar.'-border-right'] = "#666666";
			$options[$bar.'-heading-color'] = "#FFFFFF";
			$options[$bar.'-link-color'] = $options['linkcolor'];
			$options[$bar.'-text-color'] = $options['textcolor'];
			if ($bar == "header") {
				$options[$bar.'-blogtitle-color'] = $options['linkcolor'];
				$options[$bar.'-blogdescription-color'] = $options['textcolor'];
				$options[$bar.'-border02-top'] = "#333333";
				$options[$bar.'-border02-bottom'] = "#333333";
			}
		// muted yellow
		}  else if ($options[$bar.'-color'] == '#e9e9c9') {
			$options[$bar.'-border-top'] = "#999999";
			$options[$bar.'-border-left'] = "#999999";
			$options[$bar.'-border-bottom'] = "#999999";
			$options[$bar.'-border-right'] = "#999999";
			$options[$bar.'-heading-color'] = "#AAA448";
			$options[$bar.'-link-color'] = "#FFFFFF";
			$options[$bar.'-text-color'] = $options['textcolor'];
			if ($bar == "header") {
				$options[$bar.'-blogtitle-color'] = $options['linkcolor'];
				$options[$bar.'-blogdescription-color'] = $options['textcolor'];
				$options[$bar.'-border02-top'] = "#333333";
				$options[$bar.'-border02-bottom'] = "#333333";
			}
		// all other colors
		}  else {
			$options[$bar.'-border-top'] = "#CCCCCC";
			$options[$bar.'-border-left'] = "#CCCCCC";
			$options[$bar.'-border-bottom'] = "#CCCCCC";
			$options[$bar.'-border-right'] = "#CCCCCC";
			$options[$bar.'-heading-color'] = "#333333";
			$options[$bar.'-link-color'] = $options['linkcolor'];
			$options[$bar.'-text-color'] = $options['textcolor'];
			if ($bar == "header") {
				$options[$bar.'-blogtitle-color'] = $options['linkcolor'];
				$options[$bar.'-blogdescription-color'] = "#666666";
				$options[$bar.'-border02-top'] = "#999999";
				$options[$bar.'-border02-bottom'] = "#999999";
			}			
		} 
		
		/******************************************************************************
		 * Bar borders 
		 ******************************************************************************/
		if ($options[$bar.'-border-style'] == "none") {
			$options[$bar.'-hover-border-style'] = "none";
		} else {
			$options[$bar.'-hover-border-style'] = "solid";
		}
		

		/******************************************************************************
		 * Only variations with dark background colors or images should have 
		 * different colors for low opacity settings
		 ******************************************************************************/

		if ($options[$bar.'-opacity'] < .7) {
			$options[$bar.'-blogtitle-color'] = $options['transparent-blogtitle-color'];
			$options[$bar.'-blogdescription-color'] = $options['transparent-blogdescription-color'];
			$options[$bar.'-heading-color'] = $options['transparent-heading-color'];
			$options[$bar.'-link-color'] = $options['transparent-link-color'];
			$options[$bar.'-text-color'] = $options['transparent-text-color'];						
		}
		
		// opacity			
		$options[$bar.'-color-rgb'] = "rgba(".hex2rgb($options[$bar.'-color']).", ".$options[$bar.'-opacity'].")";
		$options[$bar.'-color-hover-rgb'] = "rgba(".hex2rgb($options[$bar.'-color']).", ".($options[$bar.'-opacity']+.1).")";
		$options[$bar.'-color-hover02-rgb'] = "rgba(".hex2rgb($options[$bar.'-color']).", ".($options[$bar.'-opacity']+.2).")";
		$options[$bar.'-color-ie'] = ".".$bar."block {".ie_opacity_css($options[$bar.'-color'], $options[$bar.'-opacity'])."}";
		
		// visibility
		if ($options[$bar.'-width'] == '0') {
			$options[$bar.'-visibility'] = "hidden";
			$options[$bar.'-border-style'] = "none";			
		} else {
			$options[$bar.'-visibility'] = "visible";
		}
		
	}
	
	/******************************************************************************
	 * Entry, Tag and Category link style options
	 ******************************************************************************/

	$link_types = array('entry', 'tag', 'category');
	
	foreach($link_types as $link_type) {
		if ($options[$link_type.'-link-style'] == "none") {
			$options[$link_type.'-link-border'] = "none";
			$options[$link_type.'-link-decoration'] = "none";
			$options[$link_type.'-link-hover-border'] = "solid";
			$options[$link_type.'-link-hover-background_color'] = $options['content-color'];
			$options[$link_type.'-link-hover-decoration'] = "underline";
			$options[$link_type.'-link-background'] = "none";
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
			if ($options['content-color'] == '#000000') {
				$options[$link_type.'-link-hover-background_color'] = "#262626";
			} else if ($options['content-color'] == '#262626') {
				$options[$link_type.'-link-hover-background_color'] = "#000000";
			} else {
				$options[$link_type.'-link-hover-background_color'] = "#efc";
			}
			
		} else if ($options[$link_type.'-link-style'] == "right-sidebar-box") {
			$options[$link_type.'-link-border'] = "solid";
			$options[$link_type.'-link-decoration'] = "none";
			$options[$link_type.'-link-hover-border'] = "solid";
			$options[$link_type.'-link-hover-decoration'] = "none";
			$options[$link_type.'-link-background'] = $options['right01-color'];
			$options[$link_type.'-link-hover-decoration'] = "none";
			$options[$link_type.'-link-color'] = $options['right01-link-color'];
	
		} else if ($options[$link_type.'-link-style'] == "right02-sidebar-box") {
			$options[$link_type.'-link-border'] = "solid";
			$options[$link_type.'-link-decoration'] = "none";
			$options[$link_type.'-link-hover-border'] = "solid";
			$options[$link_type.'-link-hover-decoration'] = "none";
			$options[$link_type.'-link-background'] = $options['right02-color'];
			$options[$link_type.'-link-hover-decoration'] = "none";
			$options[$link_type.'-link-color'] = $options['right02-link-color'];
	
			
		} else if ($options[$link_type.'-link-style'] == "left-sidebar-box") {
			$options[$link_type.'-link-border'] = "solid";
			$options[$link_type.'-link-decoration'] = "none";
			$options[$link_type.'-link-hover-border'] = "solid";
			$options[$link_type.'-link-hover-decoration'] = "none";
			$options[$link_type.'-link-background'] = $options['left01-color'];
			$options[$link_type.'-link-hover-decoration'] = "none"; 
			$options[$link_type.'-link-color'] = $options['left01-link-color'];
		
		//ww style links
		} else if ($options[$link_type.'-link-style'] == "yellow-box") {
			$options[$link_type.'-link-border'] = "solid";
			$options[$link_type.'-link-decoration'] = "none";
			$options[$link_type.'-link-hover-border'] = "solid";
			$options[$link_type.'-link-hover-decoration'] = "none";
			$options[$link_type.'-link-background'] = "#FFF8C6";
			$options[$link_type.'-link-hover-decoration'] = "none";
			$options[$link_type.'-link-color'] = $options['linkcolor'];
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
		$message = "These are the default settings for the ".$variation_config['theme-name']." theme.<br/><br/>See the Variation menu below for variations of this theme";
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
		
		if (is_active_sidebar("sidebar-1") && $options['left01-width'] == 0) {
			$message .= " <br/><br/>Your left sidebar is hidden but contains widgets.";
			$error = "true";
		}

		if (is_active_sidebar("sidebar-2") && $options['right01-width'] == 0) {
			$message .= " <br/><br/>Your right sidebar is hidden but contains widgets.";
			$error = "true";
		}

		if (is_active_sidebar("sidebar-3") && $options['right02-width'] == 0) {
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

/*********************************************************
 * Get select field for a given theme option
 *********************************************************/

function get_option_selector ($option_title, $option_name, $option_values) {
	global $variation_config, $options, $options_values;

	if (in_array($option_name, $variation_config['model'])) {
		print "<span style='white-space:nowrap;'>";
		if ($option_title != "") print " <span style='font-size: 10px;'>".$option_title."</span>\n";
		print "<select name='".$option_name."' style='font-size: 10px;' onchange='this.form.submit();'>\n";							
			// options
			foreach ($option_values as $label => $value) {
				print "\n<option value='".$value."'".($options[$option_name] == $value ? ' selected' : '') . ">".$label."</option>";
			}					
		print "</select>";
		print "</span> &nbsp;";
	}
}

/*********************************************************
 * Get an input field for a given theme option
 *********************************************************/

function get_option_field ($option_title, $option_name, $option_field_width) {
	global $variation_config, $options, $options_values;

	if (in_array($option_name, $variation_config['model'])) {			
		print "<span style='white-space:nowrap'>";
		if ($option_title != "") print "<span style='font-size: 10px;'>".$option_title.":</span>\n";
		print "<input name='".$option_name."' type='text' size='".$option_field_width."' style='font-size: 10px;' 
		value='".(isset($options[$option_name]) ? $options[$option_name] : '')."'/></span>";
	}
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
