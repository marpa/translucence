<?php
/**
 * Template Name: Left Sidebar
 *
 * A custom page template a left sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since Translucence 1.0
 */

get_header(); 
global $translucence_options;

$content_width = translucence_get_content_width("page");
?>

<div id="container">
<?php get_sidebar('tertiary'); ?>	

<div id="content" role="main" style="width: <?php print $content_width; ?>px;">

<?php print translucence_toggle_links(); ?>
<div class="clearfix"></div>
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



		</div><!-- #container -->
<?php get_footer(); ?>
