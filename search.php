<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); 
$content_width = get_content_width ("search");
?>

		<div id="container">
		<?php if ( $options['search-sidebar-left-display'] == "show" && $options['left01-width'] != '0') : ?>
		<?php get_sidebar('tertiary'); ?>
		<?php endif; ?>	
			<div id="content" role="main" style="width: <?php print $content_width; ?>px;">

<?php if ( have_posts() ) : ?>
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyten' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title"><?php _e( 'Nothing Found', 'twentyten' ); ?></h2>
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
<?php endif; ?>
			</div><!-- #content -->


<?php if ( $options['search-sidebar-right-display'] == "show" && $options['right01-width'] != '0') : ?>
	<?php get_sidebar('primary'); ?>	
<?php endif; ?>	
<?php if ( $options['search-sidebar-right02-display'] == "show" && $options['right02-width'] != '0') : ?>
	<?php get_sidebar('secondary'); ?>	
<?php endif; ?>	
		</div><!-- #container -->

<?php get_footer(); ?>
