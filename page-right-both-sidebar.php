<?php
/**
 * Template Name: Both Right Sidebars
 *
 * A custom page template with both right sidebars.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); 
global $options;
$content_width = $options['site-width'] - $options['right01-width']  - $options['right02-width'] - 175;
?>

<div id="container">

	<div id="content" role="main" style="width: <?php print $content_width; ?>px;">
	
	<?php print get_breadcrumbs($post); ?>
			
<?php /* display link to new post if user is at least an author */?>
<?php if (current_user_can( 'edit_posts' ) && !is_archive() && !is_search()) : ?>
	<div class='post-link' style="float: right; width: 40%;">
	<a href="<?php bloginfo('url'); ?>/wp-admin/post-new.php?post_type=page">New Page</a>
	</div>
<?php endif; ?>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>
					<div id="toc" class="toc">
					<div class="toggle">
						<a id="togglelink" href="javascript:toggleToc()">-</a>
					</div>
					<?php
					  if($post->post_parent)
					  $children = wp_list_pages("title_li=<h3>Related Pages </h3>&child_of=".$post->post_parent."&echo=0");
					  else
					  $children = wp_list_pages("title_li=<h3>Sub Pages</h2>&child_of=".$post->ID."&echo=0");
					  if ($children) { ?>
					  <ul>
					  <?php echo $children; ?>
					  </ul>
					  <?php } ?>
					  </div>
					  
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>

<?php endwhile; ?>

			</div><!-- #content -->
		<?php get_sidebar('primary'); ?>
		<?php get_sidebar('secondary'); ?>	


		</div><!-- #container -->
<?php get_footer(); ?>
