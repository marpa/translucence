<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since Twenty Ten 1.0
 */

get_header(); 
global $translucence_options;

$content_width = translucence_get_content_width ("post");
?>

		<div id="container">
<?php if ( $translucence_options['post-sidebar-left-display'] == "show" && $translucence_options['left01-width'] != '0') : ?>
	<?php get_sidebar('tertiary'); ?>	
<?php endif; ?>	

			<div id="content" role="main" style="width: <?php print $content_width; ?>px;">
<?php print translucence_toggle_links(); ?>	
<div class="clearfix"></div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&laquo;', 'Previous post link', 'twentyten' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&raquo;', 'Next post link', 'twentyten' ) . '</span>' ); ?></div>
				</div><!-- #nav-above -->

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<?php twentyten_posted_on(); ?>
					</div><!-- .entry-meta -->
					<?php if ( count( get_the_category() ) ) : ?>
						<span class="catlinks"><?php
							$category_base = get_option('category_base');
							$category_base = ($category_base ? ucwords(str_replace(array('-', '/'),array(' ',' &raquo; '),$category_base)) : 'Categories');
							printf( __( '<span class="%1$s">'.$category_base.': </span> %2$s', '2010-translucence' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
						</span>
					<?php endif; ?>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', '2010-translucence' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
					
					<?php translucence_get_author() ?>
					
					<?php  $tags_list = get_the_tag_list( '', ' ' ); ?>
					<?php if ( $tags_list ):?>
					<div class="taglinks"><?php					
						$tag_base = get_option('tag_base');
						$tag_base = ($tag_base ? ucwords(str_replace(array('-', '/'),array(' ',' &raquo; '),$tag_base)) : 'Tags');
						printf( __( '<span class="%1$s">'.$tag_base.':</span> %2$s', '2010-translucence' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					</div>
					<?php endif; ?>
					<div class="entry-utility">
						<?php //twentyten_posted_in(); ?>
						<?php edit_post_link( __( 'Edit', '2010-translucence' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&laquo;', 'Previous post link', '2010-translucence' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&raquo;', 'Next post link', '2010-translucence' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->

			<div id="syndication">
				<span><?php post_comments_feed_link('Comments RSS'); ?></span>
			</div>


				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->



<?php if ( $translucence_options['post-sidebar-right-display'] == "show" && $translucence_options['right01-width'] != '0') : // When to display 1st right sidebar. ?>
	<?php get_sidebar('primary'); ?>	
<?php endif; ?>	
<?php if ( $translucence_options['post-sidebar-right02-display'] == "show" && $translucence_options['right02-width'] != '0') : // When to display 2nd right sidebar. ?>
	<?php get_sidebar('secondary'); ?>	
<?php endif; ?>	

		</div><!-- #container -->
<?php get_footer(); ?>
