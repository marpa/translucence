<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since 2010 Translucence 1.0
 */

get_header(); 


$content_width = translucence_get_content_width("archives");
?>

<div id="container">


	
	<?php if ( $translucence_options['archives-sidebar-left-display'] == "show" && $translucence_options['left01-width'] != '0') : ?>
		<?php get_sidebar('tertiary'); ?>
	<?php endif; ?>	



			<div id="content" role="main" style="width: <?php print $content_width; ?>px;" margins="<?php print $translucence_options['content-margin-left']; ?>:<?php print $translucence_options['content-margin-right']; ?>">

		<?php print translucence_toggle_links(); ?>

		<h1>Events</h1>
	
		<?php
		if( !have_posts() ):

			?>
			<p>No events found.</p>
			<?php

		else:
		
			?>
			<div class="exchange-events archive">
			<?php

			global $wp_query;
			//echo '<pre>';var_dump($wp_query);echo '</pre>';
			//echo '<pre>';var_dump($wp_query->posts);echo '</pre>';
			Exchange_Events::print_archive_events( $wp_query );
			
			?>
			</div><!-- .exchange-events -->
			<?php
 			
		endif;
		?>

	</div><!-- #content -->



	<?php if ( $translucence_options['archives-sidebar-right-display'] == "show" && $translucence_options['right01-width'] != '0') : ?>
		<?php get_sidebar('primary'); ?>	
	<?php endif; ?>	



	<?php if ( $translucence_options['archives-sidebar-right02-display'] == "show" && $translucence_options['right02-width'] != '0') : ?>
		<?php get_sidebar('secondary'); ?>	
	<?php endif; ?>	



</div><!-- #container -->



<?php get_footer(); ?>
