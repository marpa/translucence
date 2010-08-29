<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<style type="text/css" >
<?php 
	global $variation_css, $options; 
	print $variation_css;
	
	// IE hack opacity options
	print $options['header-color-ie']."\n"; 
	print $options['top-color-ie']."\n"; 
	print $options['submenu-color-ie']."\n"; 
	print $options['content-color-ie']."\n"; 
	print $options['bottom-color-ie']."\n"; 
	print $options['left01-color-ie']."\n"; 
	print $options['right01-color-ie']."\n"; 
	print $options['right02-color-ie']."\n"; 
?>
</style>
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
</head>

<body <?php body_class(); ?>>

<div class="sitewrapper">
	
	<div class="headermeta_right">
		<span class="bgtextcolor">
		<?php print stripslashes($options['headerright']);
		
		if ($options['headermeta'] == "on") {
			if (current_user_can( 'moderate_comments' )) print "<a href='".get_bloginfo('siteurl')."/wp-admin/nav-menus.php'>Menus</a>";
			if (current_user_can( 'edit_theme_options' )) print " | <a href='".get_bloginfo('siteurl')."/wp-admin/widgets.php'>Widgets</a>";
			if (current_user_can( 'edit_theme_options' )) print " | <a href='".get_bloginfo('siteurl')."/wp-admin/themes.php?page=Variations'>Design</a>";
			
			if (current_user_can( 'edit_posts' )) {
				print " | <a href='".get_bloginfo('siteurl')."/wp-admin/profile.php'>";
				print wp_get_current_user()->display_name."</a>";
			}
			
			if (is_user_logged_in() == 'true') print "";	
			//print wp_loginout('','')."";
		}
		?>	
		</span><br/>
	</div>
	<div class="headermeta_left">
		<span class="bgtextcolor">
		<?php print stripslashes($options['headerleft']); ?>
		</span><br/>
	</div>
	
</div>


<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="masthead">
			<div id="branding" role="banner">


				<?php
					// Check if this is a post or page, if it has a thumbnail, and if it's a big one
					if ( is_singular() &&
							has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
							$image[1] >= HEADER_IMAGE_WIDTH ) :
						// Houston, we have a new header image!
						echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
					else : ?>
						<!-- <img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" /> -->
						
						<div class="headerblock" onclick="location.href='<?php echo get_option('home'); ?>';" style="cursor: pointer;">

							<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
							<<?php echo $heading_tag; ?> id="site-title">
								<span>
									<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
								</span>
							</<?php echo $heading_tag; ?>>
							<div id="site-description"><?php bloginfo( 'description' ); ?></div>

							
							
						</div>
					<?php endif; ?>
			</div><!-- #branding -->

			<div id="access" role="navigation">
			  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentyten' ); ?>"><?php _e( 'Skip to content', 'twentyten' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
			</div><!-- #access -->
		</div><!-- #masthead -->
	</div><!-- #header -->
	

	<div id="main">
