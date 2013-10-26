<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since Translucence 1.0
 */

get_header(); 
global $translucence_options, $use_mobile_site;

if( $use_mobile_site ) {
	$content_width = $translucence_options['site-width'] - 2 - 1 - ($translucence_options['content-padding'] * 2);
}
?>

<div id="container">
<?php if ($translucence_options['left01-width'] != '0') : ?>
	<?php get_sidebar('tertiary'); ?>
<?php endif;  ?>

<div id="content" role="main">

<?php print translucence_toggle_links(); ?>	
<?php print translucence_get_breadcrumbs($post); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>
					<?php //translucence_page_links($post, 'before'); ?>
					
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', '2010-translucence' ), 'after' => '</div>' ) ); ?>

					  <ul>
					 <?php translucence_page_links($post, 'after'); ?>
					  </ul>	<br/><br/>			
						
					<?php edit_post_link( __( 'Edit', '2010-translucence' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>

<?php endwhile; ?>

			</div><!-- #content -->

<?php if ($translucence_options['right01-width'] != '0') : ?>
	<?php get_sidebar('primary'); ?>
<?php endif;  ?>
<?php if ($translucence_options['right02-width'] != '0') : ?>
	<?php get_sidebar('secondary'); ?>
<?php endif;  ?>
		</div><!-- #container -->
<?php get_footer(); ?>
