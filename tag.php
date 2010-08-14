<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); 
$this_tag = get_tags($tag);
$tag_id = get_query_var('tag_id');
?>

		<div id="container">
			<div id="content" role="main">
			
			<div style = "width: 50%; float: right;">
				<div id="syndication">
				<a href="<?php print get_tag_feed_link( $tag_id, 'rss2' ); ?>" class="feed">
				&#8216;<?php single_cat_title(); ?>&#8217; Category RSS</a>
				</div>
			</div>

				<h1 class="page-title"><?php
					printf( __( 'Tags » %s', 'twentyten' ), '<span>' . single_tag_title( '', false ) . '</span>' );
				?></h1>

<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
 get_template_part( 'loop', 'tag' );
?>
			</div><!-- #content -->

<?php if ( $options['tag-sidebar-right-display'] == "show" ) : // Only display sidebar if single. ?>
	<?php get_sidebar('primary'); ?>	
<?php endif; ?>	
<?php if ( $options['tag-sidebar-right02-display'] == "show" ) : // Only display sidebar if single. ?>
	<?php get_sidebar('secondary'); ?>	
<?php endif; ?>	
		</div><!-- #container -->
<?php get_footer(); ?>
