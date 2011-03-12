<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); 
$content_width = translucence_get_content_width ("post");
?>

		<div id="container">
<?php if ( $options['post-sidebar-left-display'] == "show" && $options['left01-width'] != '0') : ?>
	<?php get_sidebar('tertiary'); ?>	
<?php endif; ?>	

			<div id="content" role="main" style="width: <?php print $content_width; ?>px;">
			<div class="toggle" style="float: left;">
				<a id="togglecontenttertiary" href="javascript:toggle('tertiary','content',<?php print translucence_get_box_widths(); ?>)">&nbsp;</a>
			</div>
			<div class="toggle" style="float: right;">
				<a id="togglecontentsecondary" href="javascript:toggle('secondary','content',<?php print translucence_get_box_widths(); ?>)">&nbsp;</a>
			</div>
			<div class="toggle">
				<a id="togglecontentprimary" href="javascript:toggle('primary','content',<?php print translucence_get_box_widths(); ?>)">&nbsp;</a>
			</div>


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
						<span class="cat-links">
							<?php printf( __( '<span class="%1$s">Categories: </span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
						</span>
					<?php endif; ?>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h2><?php printf( esc_attr__( 'About %s', 'twentyten' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&raquo;</span>', 'twentyten' ), get_the_author() ); ?>
								</a>
							</div><!-- #author-link	-->
						</div><!-- #author-description -->
					</div><!-- #entry-author-info -->
<?php endif; ?>
					
					<?php  $tags_list = get_the_tag_list( '', ' ' ); ?>
					<?php if ( $tags_list ):?>
					<div class="tag-links">						
						<?php printf( __( '<span class="%1$s">Tags:</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					</div>
					<?php endif; ?>
					<div class="entry-utility">
						<?php //twentyten_posted_in(); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&laquo;', 'Previous post link', 'twentyten' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&raquo;', 'Next post link', 'twentyten' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->

			<div id="syndication">
				<span><?php post_comments_feed_link('Comments RSS'); ?></span>
			</div>


				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->



<?php if ( $options['post-sidebar-right-display'] == "show" && $options['right01-width'] != '0') : // Only display sidebar if single. ?>
	<?php get_sidebar('primary'); ?>	
<?php endif; ?>	
<?php if ( $options['post-sidebar-right02-display'] == "show" && $options['right02-width'] != '0') : // Only display sidebar if single. ?>
	<?php get_sidebar('secondary'); ?>	
<?php endif; ?>	

		</div><!-- #container -->
<?php get_footer(); ?>
