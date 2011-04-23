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
global $options;
$content_width = translucence_get_content_width("page");
?>

<div id="container">
<?php if ($options['left01-width'] != '0') : ?>
	<?php get_sidebar('tertiary'); ?>
<?php endif;  ?>

<div id="content" role="main" style="width: <?php print $content_width; ?>px;">

<?php print translucence_toggle_links(); ?>	
<?php print translucence_get_breadcrumbs($post); ?>


<?php /* display link to new post if user is at least an author */?>
<?php if (current_user_can( 'edit_posts' ) && !is_archive() && !is_search()) : ?>
	<div class='post-link' style="float: right; width: 40%;">
	<a href="<?php echo home_url(); ?>/wp-admin/post-new.php?post_type=page">New Page</a>
	</div>
<?php endif; ?>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>
					<?php translucence_page_links($post, 'before'); ?>
					
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

<?php if ($options['right01-width'] != '0') : ?>
	<?php get_sidebar('primary'); ?>
<?php endif;  ?>
<?php if ($options['right02-width'] != '0') : ?>
	<?php get_sidebar('secondary'); ?>
<?php endif;  ?>
		</div><!-- #container -->
<?php get_footer(); ?>
