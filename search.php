<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since Twenty Ten 1.0
 */

get_header();
global $translucence_options; 
$content_width = translucence_get_content_width ("search");
?>

		<div id="container">
		<?php if ( $translucence_options['search-sidebar-left-display'] == "show" && $translucence_options['left01-width'] != '0') : ?>
		<?php get_sidebar('tertiary'); ?>
		<?php endif; ?>	
			<div id="content" role="main" style="width: <?php print $content_width; ?>px;">
<?php print translucence_toggle_links(); ?>
<div class="clearfix"></div>
<?php if ( have_posts() ) : ?>
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', '2010-translucence' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title"><?php _e( 'Nothing Found', '2010-translucence' ); ?></h2>
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', '2010-translucence' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
<?php endif; ?>
			</div><!-- #content -->


<?php if ( $translucence_options['search-sidebar-right-display'] == "show" && $translucence_options['right01-width'] != '0') : ?>
	<?php get_sidebar('primary'); ?>	
<?php endif; ?>	
<?php if ( $translucence_options['search-sidebar-right02-display'] == "show" && $translucence_options['right02-width'] != '0') : ?>
	<?php get_sidebar('secondary'); ?>	
<?php endif; ?>	
		</div><!-- #container -->

<?php get_footer(); ?>
