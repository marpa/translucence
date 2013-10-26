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

	<div id="secondary" class="widget-area" role="complementary" overall-width="<?php echo $translucence_options['overall-right02-width']; ?>">
		<div class="togglelink" style="float:right; cursor:pointer" sidebar="secondary" title="Hide Sidebar">
			
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

