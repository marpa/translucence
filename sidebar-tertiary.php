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
	if ( is_active_sidebar( 'tertiary-widget-area' )) : ?>

		<div id="tertiary" class="widget-area" role="complementary"  style="width: <?php print $options['left01-width'] ?>px">
			<div class="toggle" style="float: left; margin-left: -15px;"">
			<a id="toggletertiary" href="javascript:toggle('tertiary','sidebar',<?php print translucence_get_box_widths(); ?>)">&raquo;</a>
			</div>

			<ul class="xoxo">
				<?php dynamic_sidebar( 'tertiary-widget-area' ); ?>
			</ul>
		</div><!-- #tertiary .widget-area -->
	<?php else : ?>
		<div id="tertiary" class="widget-area" role="complementary">
		<ul>
		<?php wp_list_pages('title_li=<h3 class="widget-title">Pages</h3>' ); ?>
		</ul>		
		</div><!-- #tertiary .widget-area -->


<?php endif; ?>
