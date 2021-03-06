<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since 2010 Translucence 1.0
 */

get_header();
global $translucence_options; 
$this_category = get_category($cat);
$cat_id = $this_category->term_id;

$content_width = translucence_get_content_width ("category");
?>

		<div id="container">
		<?php if ( $translucence_options['category-sidebar-left-display'] == "show" && $translucence_options['left01-width'] != '0') : ?>
		<?php get_sidebar('tertiary'); ?>
		<?php endif; ?>	
			<div id="content" role="main" style="width: <?php print $content_width; ?>px;">
		<?php print translucence_toggle_links(); ?>
		<div class="clearfix"></div>
			<div style = "width: 50%; float: right;">
				<div id="syndication">
				<a href="<?php print get_category_feed_link( $cat_id, 'rss2' ); ?>" class="feed">
				&#8216;<?php single_cat_title(); ?>&#8217; Category RSS</a>
				</div>
			</div>

				<h1 class="page-title"><?php
					$category_base = get_option('category_base');
					$category_base = ($category_base ? ucwords(str_replace(array('-', '/'),array(' ',' &raquo; '),$category_base)) : 'Categories');
					printf( __($category_base.' &raquo; %s', '2010-translucence' ), '<span>' . single_cat_title( '', false ) . '</span>' );
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

<?php if ( $translucence_options['category-sidebar-right-display'] == "show" && $translucence_options['right01-width'] != '0') : ?>
	<?php get_sidebar('primary'); ?>	
<?php endif; ?>	
<?php if ( $translucence_options['category-sidebar-right02-display'] == "show" && $translucence_options['right02-width'] != '0') : ?>
	<?php get_sidebar('secondary'); ?>	
<?php endif; ?>	

		</div><!-- #container -->
<?php get_footer(); ?>
