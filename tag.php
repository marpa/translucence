<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

				<h1 class="page-title"><?php
					printf( __( 'Tag Archives: %s', 'twentyten' ), '<span>' . single_tag_title( '', false ) . '</span>' );
				?></h1>

<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
 get_template_part( 'loop', 'tag' );
?>
			</div><!-- #content -->

<?php if ( $options['tag-sidebar-right-display'] == "show" ) : // Only display sidebar if single. ?>
	<?php get_sidebar('primary'); ?>	
<?php endif; ?>	
<?php if ( $options['tag-sidebar-right02-display'] == "show" ) : // Only display sidebar if single. ?>
	<?php get_sidebar('secondary'); ?>	
<?php endif; ?>	
		</div><!-- #container -->
<?php get_footer(); ?>
