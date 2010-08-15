<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	// A tertiary sidebar for widgets, just because.
	global $options;
	if ( is_active_sidebar( 'tertiary-widget-area' )  && $options['left01-width'] != '0') : ?>

		<div id="tertiary" class="widget-area" role="complementary">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'tertiary-widget-area' ); ?>
			</ul>
		</div><!-- #tertiary .widget-area -->

<?php endif; ?>
