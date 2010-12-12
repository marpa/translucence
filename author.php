<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); 
$content_width = get_content_width ("author");
?>

		<div id="container">
		<?php if ( $options['author-sidebar-left-display'] == "show"  && $options['left01-width'] != '0') : ?>
		<?php get_sidebar('tertiary'); ?>
		<?php endif; ?>	
			<div id="content" role="main" style="width: <?php print $content_width; ?>px;">

<?php
	/* Queue the first post, that way we know who
	 * the author is when we try to get their name,
	 * URL, description, avatar, etc.
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	if ( have_posts() )
		the_post();
?>

<div id="syndication" style="float: right;">
<a href="<?php print get_author_feed_link( get_the_author_meta( 'ID' ), 'rss2' ); ?>" class="feed"> &#8216;<?php print get_the_author_meta( 'display_name' ) ?>&#8217; Author RSS</a>
</div>
<br/>

<?php
// If a user has filled out their description, show a bio on their entries.
//if ( get_the_author_meta( 'description' ) ) : ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
						</div><!-- #author-avatar -->
						<div id="author-description">							
							<h2><?php print get_the_author(); ?></h2>
							<div><a href="<?php the_author_meta( 'user_url' ); ?>"><?php the_author_meta( 'user_url' ); ?></a></div>
							<div><?php the_author_meta( 'description' ); ?></div>
						</div><!-- #author-description	-->
					</div><!-- #entry-author-info -->
<?php //endif; ?>
<div>

<?php
	$authorpages = wp_list_pages("title_li=<h3>Pages by ".get_the_author_meta( 'display_name' )."</h3>&author=".get_the_author_meta( 'ID' )."&echo=0");
	if ($authorpages) {
		print "<ul>";
		print $authorpages;
		print "</ul>";
	}	
?>

<h3>Posts by <?php print get_the_author_meta( 'display_name' ) ?></h3>

<?php
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

	/* Run the loop for the author archive page to output the authors posts
	 * If you want to overload this in a child theme then include a file
	 * called loop-author.php and that will be used instead.
	 */
	 get_template_part( 'loop', 'author' );
?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php if ( $options['author-sidebar-right-display'] == "show" && $options['right01-width'] != '0') : ?>
	<?php get_sidebar('primary'); ?>	
<?php endif; ?>	
<?php if ( $options['author-sidebar-right02-display'] == "show" && $options['right02-width'] != '0') : ?>
	<?php get_sidebar('secondary'); ?>	
<?php endif; ?>	

<?php get_footer(); ?>
