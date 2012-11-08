<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since Twenty Ten 1.0
 */
 global $translucence_options;
?>

<?php if (!is_single() && !is_archive() && !is_search()) : ?>
<div style = "width: 100%; float: right;">
	<div id="syndication">
		<a href="<?php bloginfo('rss2_url'); ?>" class="feed"><?php _e( 'Posts RSS', '2010-translucence' ); ?></a> 
		<a href="<?php bloginfo('comments_rss2_url'); ?>" class="feed"><?php _e( 'Comments RSS', '2010-translucence' ); ?></a>
	</div>
</div>
<?php endif; ?>

<div style="display: block;">
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-above" class="navigation" style="clear: right;">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older posts', '2010-translucence' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&raquo;</span>', '2010-translucence' ) ); ?></div>
	</div><!-- #nav-above -->
<?php endif; ?>
</div>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', '2010-translucence' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', '2010-translucence' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 * In Twenty Ten we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display posts in the Gallery category. */ ?>

	<?php if ( in_category( _x('gallery', 'gallery category slug', 'twentyten') ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', '2010-translucence' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php twentyten_posted_on(); ?>
			</div><!-- .entry-meta -->

			<div class="entry-content">
<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
<?php else : ?>			
				<?php 
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>
						<div class="gallery-thumb">
							<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
						</div><!-- .gallery-thumb -->
						<p><em><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', '2010-translucence' ),
								'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', '2010-translucence' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
								$total_images
							); ?></em></p>
				<?php endif; ?>
						<?php the_excerpt(); ?>
<?php endif; ?>
			</div><!-- .entry-content -->

			<div class="entry-utility">
				<a href="<?php echo get_term_link( _x('gallery', 'gallery category slug', 'twentyten'), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', '2010-translucence' ); ?>"><?php _e( 'More Galleries', '2010-translucence' ); ?></a>
				<span class="meta-sep">|</span>
				<div class="comments-link"><?php comments_popup_link( __( 'No comments', '2010-translucence' ), __( '1 Comment', '2010-translucence' ), __( '% Comments', '2010-translucence' ) ); ?></div>
				<?php edit_post_link( __( 'Edit', '2010-translucence' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->

<?php /* How to display posts in the asides category */ ?>

	<?php elseif ( in_category( _x('asides', 'asides category slug', 'twentyten') ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'More  <span class="meta-nav">&rarr;</span>', '2010-translucence' ) ); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

			<div class="entry-utility">
				<?php twentyten_posted_on(); ?>
				<span class="meta-sep">|</span>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', '2010-translucence' ), __( '1 Comment', '2010-translucence' ), __( '% Comments', '2010-translucence' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', '2010-translucence' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->

<?php /* How to display all other posts. */ ?>

	<?php else : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', '2010-translucence' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php if ( $translucence_options['default-post-display'] != "titles")  : ?>
			<div class="entry-meta">
				<?php twentyten_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
			<?php if ( count( get_the_category() ) ) : ?>
			<span class="catlinks"><?php
			$category_base = get_option('category_base');
			$category_base = ($category_base ? ucwords(str_replace(array('-', '/'),array(' ',' &raquo; '),$category_base)) : 'Categories');
			printf( __( '<span class="%1$s">'.$category_base.': </span> %2$s', '2010-translucence' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
			</span>
			<?php endif; ?>

	<?php if ( is_search() ) : // Only display excerpts for  search. ?>		
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
	<?php else : ?>
		<?php if ( $translucence_options['default-post-display'] == "title-excerpt") : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php elseif ( $translucence_options['default-post-display'] != "title")  : ?>
			<div class="entry-content">
				<?php the_content( __( 'More <span class="meta-nav">&rarr;</span>', '2010-translucence' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', '2010-translucence' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->		
		<?php endif; ?>
	<?php endif; ?>

			<div class="entry-utility">
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<div class="taglinks"><?php
						$tag_base = get_option('tag_base');
						$tag_base = ($tag_base ? ucwords(str_replace(array('-', '/'),array(' ',' &raquo; '),$tag_base)) : 'Tags');
						printf( __( '<span class="%1$s">'.$tag_base.':</span> %2$s', '2010-translucence' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					</div>
				<?php endif; ?>
				<div class="comments-link"><?php comments_popup_link( __( 'No comments &raquo;', '2010-translucence' ), __( '1 Comment &raquo;', '2010-translucence' ), __( '% Comments &raquo;', '2010-translucence' ) ); ?></div>
				<?php edit_post_link( __( 'Edit', '2010-translucence' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->

		<?php comments_template( '', true ); ?>

	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older posts', '2010-translucence' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&raquo;</span>', '2010-translucence' ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>
