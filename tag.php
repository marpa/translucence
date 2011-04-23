<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since Twenty Ten 1.0
 */

get_header(); 
$this_tag = get_tags($tag);
$tag_id = get_query_var('tag_id');
$content_width = translucence_get_content_width ("tag");
?>

	<div id="container">
	<?php if ( $options['tag-sidebar-left-display'] == "show" && $options['left01-width'] != '0') : ?> 		
	<?php get_sidebar('tertiary'); ?>
	<?php endif; ?>	
			<div id="content" role="main" style="width: <?php print $content_width; ?>px;">
		<?php print translucence_toggle_links(); ?>			
			<div style = "width: 50%; float: right;">
				<div id="syndication">
				<a href="<?php print get_tag_feed_link( $tag_id, 'rss2' ); ?>" class="feed">
				&#8216;<?php single_cat_title(); ?>&#8217; Tags RSS</a>
				</div>
			</div>

				<h1 class="page-title"><?php
					printf( __( 'Tags &raquo; %s', '2010-translucence' ), '<span>' . single_tag_title( '', false ) . '</span>' );
				?></h1>

<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
 get_template_part( 'loop', 'tag' );
?>
			</div><!-- #content -->

<?php if ( $options['tag-sidebar-right-display'] == "show" && $options['right01-width'] != '0') : ?>
	<?php get_sidebar('primary'); ?>	
<?php endif; ?>	
<?php if ( $options['tag-sidebar-right02-display'] == "show" && $options['right02-width'] != '0' ) : ?>
	<?php get_sidebar('secondary'); ?>	
<?php endif; ?>	
		</div><!-- #container -->
<?php get_footer(); ?>
