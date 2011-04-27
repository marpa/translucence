<?php
/**
 * The Sidebar containing the primary widget areas.
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
	global $translucence_options; ?>
	
	<div id="primary" class="widget-area" role="complementary" style="<?php translucence_box_display('primary') ?>">
		<div class="toggle" style="margin-right: -20px;">
		<a id="toggleprimary" href="javascript:toggle('primary','sidebar',<?php print translucence_get_box_widths(); ?>)">&laquo;</a>
		</div>
		<ul class="xoxo">
			<?php 				
			if ( !is_active_sidebar( 'primary-widget-area' )) {
				translucence_get_default_widgets('primary-widget-area');
								
			} else {
				dynamic_sidebar( 'primary-widget-area' ); 		
			}
			?>
		</ul>
	</div><!-- #primary .widget-area -->
	


