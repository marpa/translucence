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



<script>
jQuery(document).ready(function($) {
	$('.togglelink').click( function() {
	
		// get the sidebar object and its width.
		var sidebar_id = $(this).attr("sidebar");
		var sidebar = $('#'+sidebar_id);
		if( sidebar.length == 0 ) return;
		var sidebar_width = parseInt($(sidebar).attr('overall-width'), 10);

		// get the current width of the content.
		var current_content_width = $('#content').width();

		var margin_name = 'margin-right';
		var adj_object_id = 'content';
		switch( sidebar_id )
		{
			case "primary":
				break;
				
			case "secondary":
				margin_name = 'margin-right';
				if( $('#primary').is(':visible') )
					adj_object_id = 'primary';
				break;
			
			case "tertiary":
				margin_name = 'margin-left';
				break;
				
			default:
				return; break;
		}
		
		var adj_object = $('#'+adj_object_id);
		var current_margin = parseInt( $(adj_object).css(margin_name).replace('px','') );
			
		var showing_sidebar = false;
		if( $(sidebar).is(':visible') )
		{
			// hide the sidebar.
			$(sidebar).hide();
			
			// change margin of adjacent object.
			$(adj_object).css(margin_name, (current_margin + sidebar_width) + 'px');
			
			// animate content width change and adjacent object margin.
			if(adj_object_id == 'content')
			{
				var css = {};
				css['width'] = (current_content_width + sidebar_width) + 'px';
				css[margin_name] = current_margin + 'px';

				$("#content").stop().animate( css, 100, 'linear' );
			}
			else
			{
				var css = {};
				css[margin_name] = current_margin + 'px';

				$("#content").stop().animate( {
						width: (current_content_width + sidebar_width) + 'px'
					}, 100, 'linear'
				);

				$(adj_object).stop().animate( css, 100, 'linear' );
			}
			
			sessionStorage.setItem(sidebar_id, 'hide');
		}
		else
		{
			showing_sidebar = true;
			if(adj_object_id == 'content')
			{
				var css = {};
				css['width'] = (current_content_width - sidebar_width) + 'px';
				css[margin_name] = (current_margin + sidebar_width) + 'px';

				$("#content").stop().animate( css, 100, 'linear', function() {
					var css = {};
					css[margin_name] = current_margin + 'px';
					$('#content').css(css);
					$(sidebar).show();
				} );
			}
			else
			{
				var css = {};
				css[margin_name] = (current_margin + sidebar_width) + 'px';

				$("#content").stop().animate( {
						width: (current_content_width - sidebar_width) + 'px'
					}, 100, 'linear'
				);

				$(adj_object).stop().animate( css, 100, 'linear', function() {
					var css = {};
					css[margin_name] = current_margin + 'px';
					$(adj_object).css(css);
					$(sidebar).show();
				} );
			}
			
			sessionStorage.setItem(sidebar_id, 'show');
		}
		
		// get content togglelink element.
		if( showing_sidebar ) {
			$("#content span.togglelink[sidebar='"+sidebar_id+"']").hide();
		}
		else {
			$("#content span.togglelink[sidebar='"+sidebar_id+"']").show();
		}
	});
	
	var sidebars = [ 'primary', 'secondary', 'tertiary' ];
	for( i  in sidebars )
	{
		var sidebar_id = sidebars[i];
		var show_sidebar = sessionStorage.getItem( sidebar_id );
		if( show_sidebar === false ) {
			sessionStorage.setItem( sidebar_id, 'show' );
		}
		else {
			if( show_sidebar === 'hide' ) {
				var sidebar = $('#'+sidebar_id);
				if( sidebar.length === 0 ) continue;
				
				$(sidebar).hide();
				$('#content').width( $('#content').width() + parseInt($(sidebar).attr('overall-width')) );
				$("#content span.togglelink[sidebar='"+sidebar_id+"']").show();
			}
		}
	}
	
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

				<div class="headerblock" onclick="location.href='<?php echo home_url(); ?>';" style="cursor: pointer;">			
					<?php
					if ( is_singular() &&
							has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
							$image[1] >= HEADER_IMAGE_WIDTH ) :	
					endif; ?>					
	
					<div id="title-box">
						<div id="site-title">				
							<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</div><br/>
						<div id="site-description">	
							<?php bloginfo( 'description' ); ?>		
						</div>
					</div><!-- #title-box -->
				</div><!-- headerblock -->
			</div><!-- #branding -->

			<div id="access" role="navigation">
			  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', '2010-translucence' ); ?>"><?php _e( 'Skip to content', '2010-translucence' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
			</div><!-- #access -->
		</div><!-- #masthead -->
	</div><!-- #header -->
	

	<div id="main">
