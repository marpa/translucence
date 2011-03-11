<?php // 2010 Translucence theme options

//add_action( 'admin_init', 'translucence_theme_options_init' );
add_action('admin_menu', 'translucence_variation_add_page');
add_action( 'admin_bar_menu', 'translucence_add_menu_admin_bar' ,  70);

function translucence_variation_add_page() {
	global $theme_options, $variation_config;
	//add_theme_page( __( 'Theme Options' ), __( 'Theme Options' ), 'edit_theme_options', 'theme_options', 'coraline_theme_options_do_page' );
	
    add_theme_page($theme_options, $theme_options, 'edit_theme_options', 'Variations', 'translucence_variation_options');
}

function translucence_add_menu_admin_bar() {
    global $wp_admin_bar;
    
    if ( !current_user_can( 'switch_themes' ) || !is_admin_bar_showing() )
        return; 
        
    $wp_admin_bar->add_menu( array( 'parent' => 'appearance', 'title' =>__( 'Design', 'design' ), 'href' => admin_url('admin.php')."/themes.php?page=Variations" ) );
}

function translucence_variation_options() {	
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;
    	
	if (isset($_POST['reset']) || $options['revert'] == 1) {
		delete_options();
		save_options(); 
		$options['revert'] = 0;
		
    } else if (isset($_POST['action']) && $_POST['action'] == 'save') {
		save_options();        
	}
	
	//read_css_file("style.css");
	
	set_variation_options();	
			
	update_option($theme_settings, $options);
	update_option($theme_css, $variation_css);

	$options = get_option($theme_settings);
	$variation_css = get_option($theme_css);
	
	$current_widgets = get_option ('sidebars_widgets');	
	
	theme_model();


}