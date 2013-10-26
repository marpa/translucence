<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since 2010 Translucence 1.0
 */

get_header(); 
global $translucence_options, $use_mobile_site;

if( $use_mobile_site ) {
	$content_width = $translucence_options['site-width'] - 2 - 1 - ($translucence_options['content-padding'] * 2);
} else {
	$content_width = translucence_get_content_width ("author");
}

$author = get_userdata($wp_the_query->query_vars['author']);

?>

		<div id="container">
		<?php if ( $translucence_options['author-sidebar-left-display'] == "show"  && $translucence_options['left01-width'] != '0') : ?>
		<?php get_sidebar('tertiary'); ?>
		<?php endif; ?>	
			<div id="content" role="main" style="width: <?php print $content_width; ?>px;">
<?php print translucence_toggle_links(); ?>

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

<?php if ( $translucence_options['author-sidebar-right-display'] == "show" && $translucence_options['right01-width'] != '0') : ?>
	<?php get_sidebar('primary'); ?>	
<?php endif; ?>	
<?php if ( $translucence_options['author-sidebar-right02-display'] == "show" && $translucence_options['right02-width'] != '0') : ?>
	<?php get_sidebar('secondary'); ?>	
<?php endif; ?>	

<?php get_footer(); ?>
