<?php // 2010 Translucence theme options

add_action( 'admin_init', 'translucence_theme_options_init' );
add_action('admin_menu', 'translucence_variation_add_page');
add_action( 'admin_bar_menu', 'translucence_add_menu_admin_bar' ,  70);

/******************************************************************************
 * Initialize plugin to white list theme options
 ******************************************************************************/
function translucence_theme_options_init() {
	global $theme_options, $variation_config, $theme_settings, $theme_css, $theme_id;

	require_once( get_template_directory() . '/template-options.php');
	require_once(get_template_directory() . '/options-css.php');
	
	//create theme id
	$theme_id = strtolower($variation_config['theme-name']);
	$theme_id = str_replace(" ", "_", $theme_id);
	
	//define name of theme options and css
	$theme_settings = $theme_id."_settings";
//	$theme_css = $theme_id."_css";
	$theme_options = $variation_config['theme-name']." Options";

}


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

/*********************************************************
 * set primary options (options exposed to user in model)
 *********************************************************/
 
function set_primary_options() {
	global $_POST, $options, $allowedposttags, $variation_config;
	//printpre($_POST);

	foreach ($variation_config['model'] as $option => $value) {

		//sanitize options that contain HTML
		if ($value == "headerleftcustom") {
			$options['headerleftcustom'] = wp_kses($_POST['headerleftcustom'], $allowedposttags);
		} else if ($value == "footerleftcustom") {
			$options['footerleftcustom'] = wp_kses($_POST['footerleftcustom'], $allowedposttags);
		
		// replaces any characters that are not allowed with null
		} else if (isset($_POST[$value]))  {
			$options[$value] = preg_replace('/[^0-9a-z%#,\.\s-+_\/:~]/i','', stripslashes($_POST[$value]));
		}	
	}
	

	if (isset($_POST['model-instructions'])) {
		$options['model-instructions'] = "on";
	} else if (!isset($_POST['model-instructions']) || $options['model-instructions'] == "off") {
		$options['model-instructions'] = "off";
	} else {
		$options['model-instructions'] = "on";
	}
}

 if (!function_exists('save_options')) {
	function save_options() {
		global $_POST, $options, $variation_css, $variation_config;
		global $theme_settings, $theme_css;

		// options are those exposed in the UI
		set_primary_options();
	
		// options specific to a particular variation
		set_variation_options();
		
		/******************************************************************************
		 * add theme options to theme CSS
		 ******************************************************************************/

		$variation_css = options_css();	
		update_option($theme_settings, $options);
		update_option($theme_css, $variation_css);
		
		print_option_feedback();
		
	}
}