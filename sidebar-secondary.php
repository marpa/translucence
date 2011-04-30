<?php
/**
 * The Sidebar containing the secondary widget areas.
 *
 * @package WordPress
 * @subpackage 2010 Translucence
 * @since Translucence 1.0
 */
?>

<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	// A second sidebar for widgets, just because.
	
	global $translucence_options; ?>

	<div id="secondary" class="widget-area" role="complementary" style="<?php translucence_box_display('secondary') ?>">
		<div class="toggle" style="margin-right: -15px;">
		<a id="togglesecondary" href="javascript:toggle('secondary','sidebar',<?php print translucence_get_box_widths(); ?>)">&laquo;</a>
		</div>
		<ul class="xoxo">
			<?php 				
			if ( !is_active_sidebar( 'secondary-widget-area' )) {
				//translucence_get_default_widgets('secondary-widget-area');
								
			} else {
				dynamic_sidebar( 'secondary-widget-area' ); 		
			}
			?>

		</ul>
	</div><!-- #secondary .widget-area -->

