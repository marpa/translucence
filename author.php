<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); 
$content_width = translucence_get_content_width ("author");

$author = get_userdata($wp_the_query->query_vars['author']);

?>

		<div id="container">
		<?php if ( $options['author-sidebar-left-display'] == "show"  && $options['left01-width'] != '0') : ?>
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

<?php
	/* Queue the first post, that way we know who
	 * the author is when we try to get their name,
	 * URL, description, avatar, etc.
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	if ( have_posts() )
?>

<div id="syndication" style="float: right;">
<a href="<?php print get_author_feed_link( $author->ID, 'rss2' ); ?>" class="feed"> &#8216;<?php print $author->display_name ?>&#8217; Author RSS</a>
</div>
<br/>

		<div id="entry-author-info">
			<div id="author-avatar">
				<?php echo get_avatar( $author->user_email, apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
			</div><!-- #author-avatar -->
			<div id="author-description">							
				<h2><?php print $author->display_name; ?></h2>
				<div><a href="<?php print $author->user_url; ?>"><?php print $author->user_url; ?></a></div>
				<div><?php print $author->description; ?></div>
			</div><!-- #author-description	-->
		</div><!-- #entry-author-info -->
<div id="entry-author-pages">
<div id="toc" class="toc">
<?php 
$authorpages = wp_list_pages("title_li=&author=".$author->ID."&echo=0");
$num_authorpages = get_pages("authors=".$author->ID);
if ($authorpages && count($num_authorpages) > 0) { ?>
<h3>Pages by <?php print $author->display_name; ?></h3>
<div class="toggle">
	<a id="togglelink" href="javascript:toggleToc()">[show page links]</a>
</div>
<?php } ?>
<?php
	if ($authorpages && count($num_authorpages) > 0 && $author->ID != 0) {
		print "<div class='pagenav' style='margin-bottom: 15px;'>";
		print "<ul>";	
		print $authorpages;
		print "</ul>";
		print "</div>";
	}
?>
</div>

<h3>Posts by <?php print $author->display_name ?></h3>

<?php
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
