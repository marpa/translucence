<?php
/**
 * The Sidebar containing the tertiary widget areas.
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since Translucence 1.0
 */
?>

<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	// A tertiary sidebar for widgets, just because... because.
	
	global $translucence_options; ?>

	<div id="tertiary" class="widget-area" role="complementary" overall-width="<?php echo $translucence_options['overall-left01-width']; ?>">
		<div class="togglelink" style="float:right; cursor:pointer" sidebar="tertiary" title="Hide Sidebar">
						
		</div>
		<ul class="xoxo">
			<?php 				
			if ( !is_active_sidebar( 'tertiary-widget-area' )) {
				//translucence_get_default_widgets('tertiary-widget-area');
								
			} else {
				dynamic_sidebar( 'tertiary-widget-area' ); 		
			}
			?>
		</ul>
	</div><!-- #tertiary .widget-area -->



