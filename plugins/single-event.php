<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since Twenty Ten 1.0
 */
 
get_header(); 
$content_width = translucence_get_content_width ("post");
if( have_posts() )
{
	the_post();
	$event = Exchange_Events::populate_event_data( get_post() );
}
else
{
	$event = null;
}
?>

		<div id="container" class="single-page events">
<?php if ( $translucence_options['post-sidebar-left-display'] == "show" && $translucence_options['left01-width'] != '0') : ?>
	<?php get_sidebar('tertiary'); ?>	
<?php endif; ?>	

			<div id="content" role="main" style="width: <?php print $content_width; ?>px;" margins="<?php print $translucence_options['content-margin-left']; ?>:<?php print $translucence_options['content-margin-right']; ?>">
<?php print translucence_toggle_links(); ?>	

		<?php
		if( $event == null ):

			?>
			<h1>Event Not Found</h1>
			<div class="event"></div>
			<?php

		else:

			?>
			<h1><?php echo $event->post_title; ?></h1>

			<div class="event">

				<div class="contents">
			
					<div class="event-info">
						<div class="datetime"><label>Date/Time: </label><?php echo $event->datetime; ?></div>
						<div class="location"><label>Location: </label><?php echo $event->location; ?></div>
					</div>

					<div class="content"><?php echo $event->post_content; ?></div>			
			
				</div><!-- .contents -->
	
			</div><!-- .event -->
			<?php
		
		endif;

		?>
		</div><!-- #content -->



<?php if ( $translucence_options['post-sidebar-right-display'] == "show" && $translucence_options['right01-width'] != '0') : // When to display 1st right sidebar. ?>
	<?php get_sidebar('primary'); ?>	
<?php endif; ?>	
<?php if ( $translucence_options['post-sidebar-right02-display'] == "show" && $translucence_options['right02-width'] != '0') : // When to display 2nd right sidebar. ?>
	<?php get_sidebar('secondary'); ?>	
<?php endif; ?>	

		</div><!-- #container -->
<?php get_footer(); ?>
