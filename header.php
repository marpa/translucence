<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since Twenty Ten 1.0
 */
 
 // Starting the session 
session_start(); 

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged, $translucence_options, $blog_id;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', '2010-translucence' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#s').inline_label({text: "Search Site..."});
});
</script>

</head>

<body <?php body_class(); ?> >
<div class="sitewrapper">
	
	<div class="headermeta_right">
		<span class="bgtextcolor">
		<?php print translucence_display_privacy($blog_id); ?>
		<?php print stripslashes($translucence_options['headerright']);?>
		</span><br/>
	</div>
	<div class="headermeta_left">
		<span class="bgtextcolor">
		<?php print stripslashes($translucence_options['headerleft']); ?>
		</span><br/>
	</div>
	
</div>


<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="masthead">
			<div id="branding" role="banner">
			
				<div class="headerblock" onclick="location.href='<?php echo home_url(); ?>';">
				
					<!-- Anything to appear behind the title should be here... -->
					<?php apply_filters( 'translucence_behind_header_title', NULL ); ?>
					
				</div>
			
				<span id="title-box">
					<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<div id="site-title">			
							<?php bloginfo( 'name' ); ?>
						</div><br/>
						<div id="site-description">	
							<?php bloginfo( 'description' ); ?>		
						</div>
					</a>
				</span>
			</div><!-- branding -->

			<div id="access" role="navigation">
			  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', '2010-translucence' ); ?>"><?php _e( 'Skip to content', '2010-translucence' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
			</div><!-- #access -->
		</div><!-- #masthead -->
	</div><!-- #header -->
	

	<div id="main">
