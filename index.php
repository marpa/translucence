<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since Twenty Ten 1.0
 */

get_header(); 
global $translucence_options;

$content_width = translucence_get_content_width ("page");
?>
	
<div id="container">

	<?php if ($translucence_options['left01-width'] != '0') : ?>
		<?php get_sidebar('tertiary'); ?>	
	<?php endif; ?>	
	
		<div id="content" role="main">

		<?php print translucence_toggle_links(); ?>	

		<?php
		/* Run the loop to output the posts.
		 * If you want to overload this in a child theme then include a file
		 * called loop-index.php and that will be used instead.
		 */
		 get_template_part( 'loop', 'index' );
		?>
		</div><!-- #content -->
	
	<?php if ($translucence_options['right01-width'] != '0') : // Only display sidebar if is not hidden. ?>
		<?php get_sidebar('primary'); ?>	
	<?php endif; ?>	
	<?php if ($translucence_options['right02-width'] != '0' ) : // Only display sidebar if is not hidden. ?>
		<?php get_sidebar('secondary'); ?>	
	<?php endif; ?>		

</div><!-- #container -->
<?php get_footer(); ?>

