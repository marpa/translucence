<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); 
$this_category = get_category($cat);
$cat_id = $this_category->term_id;
?>

		<div id="container">
			<div id="content" role="main">

			<div style = "width: 50%; float: right;">
				<div id="syndication">
				<a href="<?php print get_category_feed_link( $cat_id, 'rss2' ); ?>" class="feed">
				&#8216;<?php single_cat_title(); ?>&#8217; Category RSS</a>
				</div>
			</div>

				<h1 class="page-title"><?php
					printf( __( 'Categories &raquo; %s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' );
				?></h1>
				<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';

				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				get_template_part( 'loop', 'category' );
				?>

			</div><!-- #content -->

<?php if ( $options['category-sidebar-right-display'] == "show" ) : // Only display sidebar if single. ?>
	<?php get_sidebar('primary'); ?>	
<?php endif; ?>	
<?php if ( $options['category-sidebar-right02-display'] == "show" ) : // Only display sidebar if single. ?>
	<?php get_sidebar('secondary'); ?>	
<?php endif; ?>	

		</div><!-- #container -->
<?php get_footer(); ?>
