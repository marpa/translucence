<?php // 2010 Translucence theme options

add_action( 'admin_init', 'translucence_theme_options_init' );
add_action('admin_menu', 'translucence_variation_add_page');
add_action( 'admin_bar_menu', 'translucence_add_menu_admin_bar' ,  70);

/******************************************************************************
 * Initialize plugin to white list theme options
 ******************************************************************************/

function translucence_theme_options_init() {
	global $theme_options;
	
	register_setting( $theme_options, $theme_options, 'translucence_validate_options' );	
	
}

function translucence_theme_options_save() {
	global $theme_options, $options;
	
	// get theme option value lists for selected variation theme option
	translucence_get_variation_options();
	
	// set derivative theme options based on selected primary theme options
	translucence_set_derivative_options();
	
	// get css generated from primary and derivative theme options
	$options['css'] = translucence_options_css();
	
	// update theme options 
	update_option($theme_options, $options);
	
				
}


function translucence_variation_add_page() {
	
    add_theme_page('Theme Options', 'Theme Options', 'edit_theme_options', 'variations', 'translucence_theme_options_do_page');
}

function translucence_add_menu_admin_bar() {
    global $wp_admin_bar;
    
    if ( !current_user_can( 'switch_themes' ) || !is_admin_bar_showing() )
        return; 
        
    $wp_admin_bar->add_menu( array( 'parent' => 'appearance', 'title' =>__( 'Theme Options', 'options' ), 'href' => admin_url()."themes.php?page=variations" ) );
}

/*********************************************************
 * set primary options (options exposed to user in model)
 *********************************************************/
 
function translucence_validate_options($input) {
	global $allowedposttags, $variation_config, $theme_options; 
	global $options_values, $variations;

	$options_mode = translucence_get_option_modes();
	$valid_input = array();
	$validated = array();
	$not_validated = array();
	
	$validation_debug = 0;
	
	if (isset($input['reset']) && $input['reset'] == "Revert to Default") {
		$input['revert'] = 1;
		$validated[] = $option;
	} else {
		$input['revert'] = 0;
		$validated[] = "revert";
	}
	
//  	$input['site-width'] = "60000";
//  	print $input['site-width']."<br/>";
	
	
	foreach ($input as $option => $value) {	
		//sanitize options that contain HTML
		if ($option == "headerleftcustom") {
			$input['headerleftcustom'] = wp_kses($input['headerleftcustom'], $allowedposttags);
			$validated[] = $option;
		} else if ($option == "footerleftcustom") {
			$input['footerleftcustom'] = wp_kses($input['footerleftcustom'], $allowedposttags);
			$validated[] = $option;
		
		// validate all options that specify a width
		} else if (preg_match("/width/", $option)) {
			if ($value >= 0 && $value <= 1000) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate all options that specify a size
		} else if (preg_match("/size/", $option)) {
			if ($value >= 14 && $value <= 100) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}
							
		// validate all options that specify an opacity
		} else if (preg_match("/opacity/", $option)) {
			if ($value >= 0 && $value <= 1) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate all options that specify a color
		} else if (preg_match("/color/", $option)) {
			if (preg_match('/^#??([0-9a-f]{1,2}){3}$/i', $value)) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}
		
		// validate all options the specify a border-style
		} else if (preg_match("/border-style/", $option)) {
			if (in_array($value, $options_values['border-style'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate all options the specify a shadow offset
		} else if (preg_match("/shadow-offset/", $option)) {
			if (in_array($value, $options_values['text-shadow-offset'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate all options the specify a shadow blur
		} else if (preg_match("/shadow-blur/", $option)) {
			if (in_array($value, $options_values['text-shadow-blur'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate all options the specify a which sidebars to display
		// on post, author, category, tag, search and archives pages 
		} else if (preg_match("/single-sidebar/", $option)) {
			if (in_array($value, $options_values['sidebar-display'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate text-align option
		} else if (preg_match("/text-align/", $option)) {
			if (in_array($value, $options_values['entry-text-align'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate entry-link-style option
		} else if (preg_match("/entry-link-style/", $option)) {
			if (in_array($value, $options_values['entry-link-style'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate header-text-display option
		} else if (preg_match("/header-text-display/", $option)) {
			if (in_array($value, $options_values['header-text-display'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate header-block-height option
		} else if (preg_match("/header-block-height/", $option)) {
			if (in_array($value, $options_values['header-block-height'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate header-meta-left options
		} else if (preg_match("/header-meta-left/", $option)) {
			if (array_key_exists($value, $variation_config['header_meta_left_options'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate footer-meta-left options
		} else if (preg_match("/footer-meta-left/", $option)) {
			if (array_key_exists($value, $variation_config['footer_meta_left_options'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate headermeta option
		} else if (preg_match("/headermeta/", $option)) {
			if ($value == "on" || $value == "off" ) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate headermeta option
		} else if (preg_match("/background/", $option)) {
			if (in_array($value, $variations)) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validates options-mode option
		} else if (preg_match("/options-mode/", $option)) {
			if (in_array($value, $options_mode)) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}
		}
	}
	
	// debugging
	
	if ($validation_debug == 1) {
		// compile list of not_validated options
		foreach ($input as $option => $value) {
			if (!in_array($option, $validated)) $not_validated[] = $option;	
		}
		
		// print out lists of inital input, validated options, invalid options
		// and valid_input
		print "<hr/>Initial Input: ".count($input)." options";
		printpre ($input);
		print "<hr/>validated: ".count($validated)." options";
		printpre ($validated);
		print "<hr/>invalid options: ".count($not_validated)."";
		printpre ($not_validated);
		exit;
	}

	return $input;
}

/******************************************************************************
 * get default variation (note: child themes may override this)
 * 
 ******************************************************************************/
if (!function_exists('translucence_get_variation_default')) {
	function translucence_get_variation_default() {
		if (file_exists(get_template_directory() .'/variations/default/variation.php')) {
			$variation_default = get_template_directory() .'/variations/default/variation.php';
		}
		return $variation_default;		
	}
}

/******************************************************************************
 * get default theme options from variation_config
 * (see config-sample.php or config.php)
 ******************************************************************************/
function translucence_get_variation_default_config() {
	global $variation_config, $options;
		
	if (!isset($options['background'])) $options['background'] = $variation_config['background'];
	if (!isset($options['site-title-color'])) $options['site-title-color'] = $variation_config['site-title-color'];
	if (!isset($options['site-description-color'])) $options['site-description-color'] = $variation_config['site-description-color'];
	
	if (!isset($options['options-mode'])) $options['options-mode'] = $variation_config['options-mode'];
	if (!isset($options['revert'])) $options['revert'] = $variation_config['revert'];
	
	if (!isset($options['site-width'])) $options['site-width'] = $variation_config['site-width'];
	if (!isset($options['header-block-height'])) $options['header-block-height'] = $variation_config['header-block-height'];
	
	if (!isset($options['site-title-size'])) $options['site-title-size'] = $variation_config['site-title-size'];
	if (!isset($options['site-description-size'])) $options['site-description-size'] = $variation_config['site-description-size'];
	if (!isset($options['header-text-shadow-offset'])) $options['header-text-shadow-offset'] = $variation_config['header-text-shadow-offset'];
	if (!isset($options['header-text-shadow-blur'])) $options['header-text-shadow-blur'] = $variation_config['header-text-shadow-blur'];
	
	if (!isset($options['entry-text-size'])) $options['entry-text-size'] = $variation_config['entry-text-size'];
	if (!isset($options['entry-line-height'])) $options['entry-line-height'] = $variation_config['entry-line-height'];
	
	if (!isset($options['footer-meta-left'])) $options['footer-meta-left'] = $variation_config['footer-meta-left'];
	if (!isset($options['header-meta-left'])) $options['header-meta-left'] = $variation_config['header-meta-left'];
	if (!isset($options['headerleftcustom'])) $options['headerleftcustom'] = $variation_config['headerleftcustom'];
	if (!isset($options['footerleftcustom'])) $options['footerleftcustom'] = $variation_config['footerleftcustom'];
	
	if (!isset($options['header-image-options'])) $options['header-image-options'] = $variation_config['header-image-options'];
	
	if (!isset($options['header-text-display'])) $options['header-text-display'] = $variation_config['header-text-display'];
	if (!isset($options['entry-link-style'])) $options['entry-link-style'] = $variation_config['entry-link-style'];
	if (!isset($options['entry-text-align'])) $options['entry-text-align'] = $variation_config['entry-text-align'];
	if (!isset($options['tag-links-color'])) $options['tag-links-color'] = $variation_config['tag-links-color'];
	if (!isset($options['cat-links-color'])) $options['cat-links-color'] = $variation_config['cat-links-color'];
	
	if (!isset($options['site-padding-top'])) $options['site-padding-top'] = $variation_config['site-padding-top'];
	if (!isset($options['site-padding-bottom'])) $options['site-padding-bottom'] = $variation_config['site-padding-bottom'];
	
	if (!isset($options['site-color'])) $options['site-color'] = $variation_config['site-color'];
	if (!isset($options['title-box-color'])) $options['title-box-color'] = $variation_config['title-box-color'];
	if (!isset($options['description-box-color'])) $options['description-box-color'] = $variation_config['description-box-color'];
	if (!isset($options['header-color'])) $options['header-color'] = $variation_config['header-color'];
	if (!isset($options['top-color'])) $options['top-color'] = $variation_config['top-color'];
	if (!isset($options['left01-color'])) $options['left01-color'] = $variation_config['left01-color'];
	if (!isset($options['content-color'])) $options['content-color'] = $variation_config['content-color'];
	if (!isset($options['right01-color'])) $options['right01-color'] = $variation_config['right01-color'];
	if (!isset($options['right02-color'])) $options['right02-color'] = $variation_config['right02-color'];
	if (!isset($options['bottom-color'])) $options['bottom-color'] = $variation_config['bottom-color'];
	
	if (!isset($options['site-opacity'])) $options['site-opacity'] = $variation_config['site-opacity'];
	if (!isset($options['title-box-opacity'])) $options['title-box-opacity'] = $variation_config['title-box-opacity'];
	if (!isset($options['description-box-opacity'])) $options['description-box-opacity'] = $variation_config['description-box-opacity'];
	
	if (!isset($options['header-opacity'])) $options['header-opacity'] = $variation_config['header-opacity'];
	if (!isset($options['top-opacity'])) $options['top-opacity'] = $variation_config['top-opacity'];
	if (!isset($options['left01-opacity'])) $options['left01-opacity'] = $variation_config['left01-opacity'];
	if (!isset($options['content-opacity'])) $options['content-opacity'] = $variation_config['content-opacity'];
	if (!isset($options['right01-opacity'])) $options['right01-opacity'] = $variation_config['right01-opacity'];
	if (!isset($options['right02-opacity'])) $options['right02-opacity'] = $variation_config['right02-opacity'];
	if (!isset($options['bottom-opacity'])) $options['bottom-opacity'] = $variation_config['bottom-opacity'];
	
	if (!isset($options['site-border-style'])) $options['site-border-style'] = $variation_config['site-border-style'];
	if (!isset($options['header-border-style'])) $options['header-border-style'] = $variation_config['header-border-style'];
	if (!isset($options['top-border-style'])) $options['top-border-style'] = $variation_config['top-border-style'];
	if (!isset($options['content-border-style'])) $options['content-border-style'] = $variation_config['content-border-style'];
	if (!isset($options['left01-border-style'])) $options['left01-border-style'] = $variation_config['left01-border-style'];
	if (!isset($options['right01-border-style'])) $options['right01-border-style'] = $variation_config['right01-border-style'];
	if (!isset($options['right02-border-style'])) $options['right02-border-style'] = $variation_config['right02-border-style'];
	if (!isset($options['bottom-border-style'])) $options['bottom-border-style'] = $variation_config['bottom-border-style'];
	
	if (!isset($options['header-width'])) $options['header-width'] = $variation_config['header-width'];
	if (!isset($options['left01-width'])) $options['left01-width'] = $variation_config['left01-width'];
	if (!isset($options['right01-width'])) $options['right01-width'] = $variation_config['right01-width'];
	if (!isset($options['right02-width'])) $options['right02-width'] = $variation_config['right02-width'];
	
	if (!isset($options['post-single-sidebar'])) $options['post-single-sidebar'] = $variation_config['post-single-sidebar'];
	if (!isset($options['category-single-sidebar'])) $options['category-single-sidebar'] = $variation_config['category-single-sidebar'];
	if (!isset($options['tag-single-sidebar'])) $options['tag-single-sidebar'] = $variation_config['tag-single-sidebar'];
	if (!isset($options['author-single-sidebar'])) $options['author-single-sidebar'] = $variation_config['author-single-sidebar'];
	if (!isset($options['search-single-sidebar'])) $options['search-single-sidebar'] = $variation_config['search-single-sidebar'];
	if (!isset($options['archives-single-sidebar'])) $options['archives-single-sidebar'] = $variation_config['archives-single-sidebar'];
	
}


/******************************************************************************
 * get path to variations source files (note: child themes may override this)
 * 
 ******************************************************************************/

if (!function_exists('translucence_get_variations_source')) {
	function translucence_get_variations_source() {
	
		if (file_exists(get_template_directory() .'/variations/')) {
			$variations_path = get_template_directory() .'/variations';
		}
		return $variations_path;
	}
}

/******************************************************************************
 * get options for variations (based on options['background'])
 * 
 ******************************************************************************/

function translucence_get_variation_options() {
	global $options, $options_values, $variations;

	/******************************************************************************
	 * Default options and option value lists
	 ******************************************************************************/

	if (file_exists(translucence_get_variation_default())) {
		$variation_default = translucence_get_variation_default();
		include($variation_default);
	} 
	
	/******************************************************************************
	 * Defaults for variations
	 * variations use defaults unless otherwise specified
	 * variations can have default option values and default option value lists
	 * option value lists are the option values users can select in the theme model UI
	 * (variation info is extracted from variation.php file using same functions
	 * used to extract theme info from theme style.php
	 ******************************************************************************/
	
	$variations = array();
	$themes_allowed_tags = "";
	
	translucence_get_variation_default_config();
	
	//$variation_path = translucence_get_variations_source();
	
	if (file_exists(translucence_get_variations_source())) {
		$variation_path = translucence_get_variations_source();
		
		if ($handle = opendir($variation_path)) {
			while (false !== ($file = readdir($handle))) {
				
				if (is_dir($variation_path.'/'.$file) && $file !="default") {
					
					if (file_exists($variation_path.'/'.$file.'/variation.php')) {
						include($variation_path.'/'.$file.'/variation.php');
						
						$variation_data = implode( '', file( $variation_path.'/'.$file.'/variation.php' ) );
						$variation_data = str_replace ( '\r', '\n', $variation_data );
						
						// get variation name
						if ( preg_match( '|Variation Name:(.*)$|mi', $variation_data, $variation_name ) )
							$name = $variation = wp_kses( _cleanup_header_comment($variation_name[1]), $themes_allowed_tags );
						else
							$name = $variation = '';
						
						// get variation id
						if ( preg_match( '|Variation ID:(.*)$|mi', $variation_data, $variation_id ) )
							$id = $variation = wp_kses( _cleanup_header_comment($variation_id[1]), $themes_allowed_tags );
						else
							$id = $variation = '';						
						$variations[$name] = $id;
					}
				}
			}			
		}
		closedir($handle);
		
		/******************************************************************************
		 * Override variation background color and image if customs background color
		 * and image have been set
		 ******************************************************************************/
	
		$custom_background_color = get_background_color();
		$custom_background_image = get_background_image();
				
		if ($custom_background_color !="") $options['background_color'] = "#".$custom_background_color;
		if ($custom_background_image !="") $options['background_image'] = $custom_background_image;		

		ksort($variations);
		
	}
		
	// if no variation has been selected then use theme defaults
	if (isset($_POST)) {
		if (!in_array($options['header-color'], array_values($options_values['sidebar-color']))) $options['header-color'] = "#F9F9F9";
		if (!in_array($options['top-color'], array_values($options_values['sidebar-color']))) $options['top-color'] = "#FFFFFF";
		if (!in_array($options['left01-color'], array_values($options_values['sidebar-color']))) $options['left01-color'] = "#F3F3F3";
		if (!in_array($options['content-color'], array_values($options_values['sidebar-color']))) $options['content-color'] = "#FFFFFF";
		if (!in_array($options['right01-color'], array_values($options_values['sidebar-color']))) $options['right01-color'] = "#F3F3F3";
		if (!in_array($options['right02-color'], array_values($options_values['sidebar-color']))) $options['right02-color'] = "#F3F3F3";
		if (!in_array($options['bottom-color'], array_values($options_values['sidebar-color']))) $options['bottom-color'] = "#FFFFFF";
		if (!in_array($options['linkcolor'], array_values($options_values['linkcolor']))) $options['linkcolor'] = "#003366";
		if (!in_array($options['textcolor'], array_values($options_values['textcolor']))) $options['textcolor'] = "#444444";
		if (!in_array($options['entry-link-style'], array_values($options_values['entry-link-style']))) $options['entry-link-style'] = "underline";
		if (!in_array($options['cat-links-color'], array_values($options_values['sidebar-color']))) $options['cat-links-color'] = "#e9e9c9";
		if (!in_array($options['tag-links-color'], array_values($options_values['sidebar-color']))) $options['tag-links-color'] = "#FFF8C6";
	}
	//translucence_set_derivative_options();	
}

/*********************************************************
 * Set derivative options uses primary options (i.e. those exposed in UI)
 * to set derivative options
 *********************************************************/

function translucence_set_derivative_options() {
	global $variation_config, $options, $options_values, $custom_background_image;
	
	/******************************************************************************
	 * Site top padding (derived from  site-border-style)
	 ******************************************************************************/
	
	if ($options['site-border-style'] != 'none') {
		$options['site-padding-top'] = "20";
		$options['site-padding-bottom'] = "20";
	} else {
		$options['site-padding-top'] = "10";
		$options['site-padding-bottom'] = "10";
	}
	
	if ($options['site-border-style'] == 'solid') {
		$options['site-border-shadow'] = 5;
	} else {
		$options['site-border-shadow'] = 0;
	}


	/******************************************************************************
	 * Header left links (derived from  header_meta_left_options)
	 ******************************************************************************/
	
	if ($options['header-meta-left'] == 'blogs' && $variation_config['header_meta_left_options']['blogs'] == "") {
		$options['headerleft'] = "<a href='".get_bloginfo('url')."/wp-signup.php' title='View your Blogs'>WordPress</a>";
	} else if ($options['header-meta-left'] == 'custom') {
		$options['headerleft'] = stripslashes($options['headerleftcustom']);
	} else {
		$options['headerleft'] = $variation_config['header_meta_left_options'][$options['header-meta-left']]['option_value'];					
	}

	/******************************************************************************
	 * Header right links (derived from header_meta_right_options)
	 ******************************************************************************/

	if (isset($variation_config['header_meta_right_options'])) {
	
		if (isset($headermeta) && $headermeta == 'on') {
			$options['headerright'] = "Menus | Widgets | Design";
						
		} else {
			$options['headerright'] = "";
		}
	}
	
	/******************************************************************************
	 * Top Navigation area margins (derived from top-border-style)
	 * if no border on top nav, then no space between header image and nav
	 ******************************************************************************/
	if ($options['top-border-style'] == "solid" || $options['top-border-style'] == "dotted") {
		$options['top-margin-top'] = "1";
	} else {
		$options['top-margin-top'] = "0";
	}

	/******************************************************************************
	 * Footer left links (derived from meta_right_options)
	 ******************************************************************************/
	if ($options['footer-meta-left'] == 'custom') {
		$options['footerleft'] = stripslashes($options['footerleftcustom']);
	} else {
		$options['footerleft'] = $variation_config['footer_meta_left_options'][$options['footer-meta-left']]['option_value'];					
	}

	/******************************************************************************
	 * Blog title and description display option 
	 * (derived from header-text-display and header-block-height options)
	 ******************************************************************************/
	
	
	if ($options['header-text-display'] != "hide") {
		$options['show-header-text'] = "inline";
	} else {
		$options['show-header-text'] = "none";
	}
	
	if ($options['header-text-display'] == "top") {
		$options['header-text-padding-top'] = 10;
		
	} else if ($options['header-text-display'] == "middle") {
		if ($options['header-block-height'] == 50) {
			$options['header-text-padding-top'] = 5;
		} else if ($options['header-block-height'] == 70) {
			$options['header-text-padding-top'] = 10;
		} else if ($options['header-block-height'] == 100) {
			$options['header-text-padding-top'] = 25;		
		} else if ($options['header-block-height'] == 125) {
			$options['header-text-padding-top'] = 45;		
		} else if ($options['header-block-height'] == 150) {
			$options['header-text-padding-top'] = 55;		
		} else if ($options['header-block-height'] == 175) {
			$options['header-text-padding-top'] = 65;		
		} else if ($options['header-block-height'] == 200) {
			$options['header-text-padding-top'] = 80;
		} else if ($options['header-block-height'] == 225) {
			$options['header-text-padding-top'] = 90;
		} else if ($options['header-block-height'] == 250) {
			$options['header-text-padding-top'] = 110;
		} else if ($options['header-block-height'] == 300) {
			$options['header-text-padding-top'] = 145;
		}
		
	} else if ($options['header-text-display'] == "bottom") {
		$options['header-text-padding-top'] = $options['header-block-height'] - 50;
		
	} else {
		$options['header-text-padding-top'] = 15;
	}
	
	$options['description-text-padding-top'] = $options['header-text-padding-top'] + 12;
	
	// IE hack for title-box padding
	if ($options['site-title-size'] < 20) {
		$options['ie-site-title-padding'] = 8;
	} else if ($options['site-title-size'] < 30) {
		$options['ie-site-title-padding'] = 10;
	} else if ($options['site-title-size'] < 40) {
		$options['ie-site-title-padding'] = 15;
	} else if ($options['site-title-size'] < 61) {
		$options['ie-site-title-padding'] = 22;
	}
	

	/******************************************************************************
	 * visited link color options (derived from link and text colors)
	 ******************************************************************************/
	
	// dark blue or gold
	if ($options['linkcolor'] == '#003366' || $options['linkcolor'] == '#625b1d') {	
		// black
		if ($options['textcolor'] == '#222222') {
			$options['linkcolor_visited'] = "#000000";
		// 80% gray
		} else if ($options['textcolor'] == '#333333') {
			$options['linkcolor_visited'] = "#000000";
		// 70% gray
		} else if ($options['textcolor'] == '#444444') {
			$options['linkcolor_visited'] = "#000000";
		// 60% gray
		} else if ($options['textcolor'] == '#555555') {
			$options['linkcolor_visited'] = "#000000";
		// 50% gray
		} else if ($options['textcolor'] == '#666666') {
			$options['linkcolor_visited'] = "#000000";
		// 40% gray
		} else if ($options['textcolor'] == '#777777') {
			$options['linkcolor_visited'] = "#000000";
		// 30% gray
		} else if ($options['textcolor'] == '#888888') {
			$options['linkcolor_visited'] = "#333333";
		// 20% gray
		} else if ($options['textcolor'] == '#CCCCCC') {
			$options['linkcolor_visited'] = "#333333";
		// 10% gray	
		} else if ($options['textcolor'] == '#EEEEEE') {
			$options['linkcolor_visited'] = "#CCCCCC";
		}
		
		
	//  light blue
	} else if ($options['linkcolor'] == '#0066cc') {	
		$options['linkcolor_visited'] = "#003366";
	// red
	} else if ($options['linkcolor'] == '#990000') {	
		$options['linkcolor_visited'] = "#996666";
	// green
	}  else if ($options['linkcolor'] == '#265e15') {	
		$options['linkcolor_visited'] = "#6D9C54";
		
	// pale yellow
	}  else if ($options['linkcolor'] == '#FFFFCC') {	
		// 40% gray
		if ($options['textcolor'] == '#777777') {
			$options['linkcolor_visited'] = "#FFFFFF";
		// 30% gray
		} else if ($options['textcolor'] == '#888888') {
			$options['linkcolor_visited'] = "#FFFFFF";
		// 20% gray
		} else if ($options['textcolor'] == '#CCCCCC') {
			$options['linkcolor_visited'] = "#FFFFFF";
		// 10% gray	
		} else if ($options['textcolor'] == '#EEEEEE') {
			$options['linkcolor_visited'] = "#FFFFFF";
		} else {
			$options['linkcolor_visited'] = "#FFFFFF";
		}	
	// yellow
	}  else if ($options['linkcolor'] == '#FFCC33') {
	
		// 40% gray
		if ($options['textcolor'] == '#777777') {
			$options['linkcolor_visited'] = "#FFFFFF";
		// 30% gray
		} else if ($options['textcolor'] == '#888888') {
			$options['linkcolor_visited'] = "#FFFFFF";
		// 20% gray
		} else if ($options['textcolor'] == '#CCCCCC') {
			$options['linkcolor_visited'] = "#FFFFFF";
		// 10% gray	
		} else if ($options['textcolor'] == '#EEEEEE') {
			$options['linkcolor_visited'] = "#FFFFFF";
		} else {
			$options['linkcolor_visited'] = "#FFFFFF";
		}	
	
	// black
	}  else if ($options['linkcolor'] == '#222222') {	
		$options['linkcolor_visited'] = "#333333";	
	
	}

	/******************************************************************************
	 * Translucent box options
	 * translucent boxes have primary options for:
	 * background-color
	 * opacity
	 * border-style
	 *
	 * translucent boxes have derivative options for
	 * color
	 * border color
	 * heading-color
	 * link color
	 * text color
	 * 
	 ******************************************************************************/	
	
	$translucent_boxes = array('site', 'top', 'bottom', 'left01', 'right01', 'right02', 'header', 'content', 'cat-links', 'tag-links', 'title-box', 'description-box');
	
	foreach($translucent_boxes as $box) {
		
		// white
		if ($options[$box.'-color'] == '#FFFFFF') {
			$options[$box.'-border-top'] = "#CCCCCC";
			$options[$box.'-border-left'] = "#CCCCCC";
			$options[$box.'-border-bottom'] = "#CCCCCC";
			$options[$box.'-border-right'] = "#CCCCCC";
			$options[$box.'-heading-color'] = "#666666";
			$options[$box.'-link-color'] = $options['linkcolor'];
			$options[$box.'-text-color'] = $options['textcolor'];
			$options[$box.'-highlight-color'] = "#F9F9F9";

		// gray blue
		} else if ($options[$box.'-color'] == '#364559') {
			$options[$box.'-border-top'] = "#666666";
			$options[$box.'-border-left'] = "#666666";
			$options[$box.'-border-bottom'] = "#666666";
			$options[$box.'-border-right'] = "#666666";
			$options[$box.'-heading-color'] = "#CCCC99";
			$options[$box.'-link-color'] = "#EEEEEE";
			$options[$box.'-text-color'] = "#CCCCCC";
			$options[$box.'-highlight-color'] = "#364559";
			
			
		// black
		} else if ($options[$box.'-color'] == '#000000' || $options[$box.'-color'] == '#262626') {
			$options[$box.'-border-top'] = "#666666";
			$options[$box.'-border-left'] = "#666666";
			$options[$box.'-border-bottom'] = "#666666";
			$options[$box.'-border-right'] = "#666666";
			$options[$box.'-heading-color'] = "#FFFFFF";
			$options[$box.'-link-color'] = $options['linkcolor'];
			$options[$box.'-text-color'] = $options['textcolor'];
			$options[$box.'-highlight-color'] = "#262626";
			
		// green	
		} else if ($options[$box.'-color'] == '#83A776') {
			$options[$box.'-border-top'] = "#666666";
			$options[$box.'-border-left'] = "#666666";
			$options[$box.'-border-bottom'] = "#666666";
			$options[$box.'-border-right'] = "#666666";
			$options[$box.'-heading-color'] = "#FFFFFF";
			$options[$box.'-link-color'] = $options['linkcolor'];
			$options[$box.'-text-color'] = $options['textcolor'];
			$options[$box.'-highlight-color'] = "#83A776";

			
		// muted yellow
		}  else if ($options[$box.'-color'] == '#e9e9c9') {
			$options[$box.'-border-top'] = "#999999";
			$options[$box.'-border-left'] = "#999999";
			$options[$box.'-border-bottom'] = "#999999";
			$options[$box.'-border-right'] = "#999999";
			$options[$box.'-heading-color'] = "#AAA448";
			$options[$box.'-link-color'] = $options['linkcolor'];
			$options[$box.'-text-color'] = $options['textcolor'];
			$options[$box.'-highlight-color'] = "#e9e9c9";

			
		// green
		}  else if ($options[$box.'-color'] == '#4a6339') {
			$options[$box.'-border-top'] = "#585858";
			$options[$box.'-border-left'] = "#585858";
			$options[$box.'-border-bottom'] = "#585858";
			$options[$box.'-border-right'] = "#585858";
			$options[$box.'-heading-color'] = "#c7c6a7";
			$options[$box.'-link-color'] = "#FFFFFF";
			$options[$box.'-link-color'] = "#EEEEEE";
			$options[$box.'-text-color'] = "#CCCCCC";
			$options[$box.'-highlight-color'] = "#4a6339";

			
		// all other colors
		}  else {
			$options[$box.'-border-top'] = "#CCCCCC";
			$options[$box.'-border-left'] = "#CCCCCC";
			$options[$box.'-border-bottom'] = "#CCCCCC";
			$options[$box.'-border-right'] = "#CCCCCC";
			$options[$box.'-heading-color'] = "#333333";
			$options[$box.'-link-color'] = $options['linkcolor'];
			$options[$box.'-text-color'] = $options['textcolor'];
			$options[$box.'-highlight-color'] = "#F9F9F9";
			
		} 
		
		/******************************************************************************
		 * Box borders (derived from $box-border-style)
		 ******************************************************************************/
		$options['cat-links-border-style'] = "solid";
		$options['tag-links-border-style'] = "solid";
		
		if (isset($options[$box.'-border-style']) && $options[$box.'-border-style'] == "none") {
			$options[$box.'-hover-border-style'] = "none";
		} else {
			$options[$box.'-hover-border-style'] = "solid";
		}
				
		/******************************************************************************
		 * Opacity Settings
		 * Only variations with dark background colors or images have 
		 * different colors for low opacity settings see: 
		 * variations/<<variation-name>>/variation.php
		 ******************************************************************************/
		$options['cat-links-opacity'] = 1;
		$options['tag-links-opacity'] = 1;
		
		// top bar child/sub-menu opacity never below transparent text and link color 
		if ($box == "top") {
			$options['top-child-link-color'] = $options['top-link-color'];
			$options['top-child-text-color'] = $options['top-text-color'];		
		}

		// convert hex color and opacity settings to rgba values
		$options[$box.'-color-rgb'] = "rgba(".translucence_hex2rgb($options[$box.'-color']).", ".$options[$box.'-opacity'].")";	
		$options[$box.'-highlight-color-rgb'] = "rgba(".translucence_hex2rgb($options[$box.'-highlight-color']).", ".($options[$box.'-opacity']+.1).")";	
		
		
		// text, link and highlight color adjustment for low opacity settings
		if ($options[$box.'-opacity'] < .7) {
			//$options[$box.'-blogtitle-color'] = $options['transparent-blogtitle-color'];
			//$options[$box.'-blogdescription-color'] = $options['transparent-blogdescription-color'];
			$options[$box.'-heading-color'] = $options['transparent-heading-color'];
			$options[$box.'-link-color'] = $options['transparent-link-color'];
			$options[$box.'-text-color'] = $options['transparent-text-color'];		
			
			if ($custom_background_image != "") {
				$options[$box.'-color-hover-rgb'] = "rgba(".translucence_hex2rgb($options[$box.'-color']).", ".($options[$box.'-opacity']-.2).")";
				$options[$box.'-highlight-hover-color-rgb'] = "rgba(".translucence_hex2rgb($options[$box.'-color']).", ".($options[$box.'-opacity']).")";
			} else {
				$options[$box.'-color-hover-rgb'] = "rgba(".translucence_hex2rgb($options[$box.'-color']).", ".($options[$box.'-opacity']+.2).")";
				$options[$box.'-highlight-hover-color-rgb'] = "rgba(".translucence_hex2rgb($options[$box.'-color']).", ".($options[$box.'-opacity']+.1).")";			
			}
			
		} else {
			$options[$box.'-color-hover-rgb'] = "rgba(".translucence_hex2rgb($options[$box.'-color']).", ".($options[$box.'-opacity']+.2).")";
			$options[$box.'-highlight-color-hover-rgb'] = "rgba(".translucence_hex2rgb($options[$box.'-highlight-color']).", ".($options[$box.'-opacity']+.1).")";					
		}
		
		// need to refine top bar opacity settings....
		if ($box == "top") {
			$options['top-color-hover02-rgb'] = "rgba(".translucence_hex2rgb($options['top-color']).", .9)";
			$options['top-color-hover03-rgb'] = "rgba(".translucence_hex2rgb($options['top-color']).", 1)";
		}
		
		/******************************************************************************
		 * category and tag links use linkcolor as their hover border color
		 ******************************************************************************/
		if (isset($options['cat-links-link-color'])) {
			$options['cat-links-hover-border-top'] = $options['cat-links-link-color'];
			$options['cat-links-hover-border-bottom'] = $options['cat-links-link-color'];
			$options['cat-links-hover-border-left'] = $options['cat-links-link-color'];
			$options['cat-links-hover-border-right'] = $options['cat-links-link-color'];
		}
		
		if (isset($options['tag-links-link-color'])) {
			$options['tag-links-hover-border-top'] = $options['tag-links-link-color'];
			$options['tag-links-hover-border-bottom'] = $options['tag-links-link-color'];
			$options['tag-links-hover-border-left'] = $options['tag-links-link-color'];
			$options['tag-links-hover-border-right'] = $options['tag-links-link-color'];
		}

		
		if ($box == "left01") {
			$area = "#tertiary";
		} else if ($box == "right01") {
			$area = "#primary";
		} else if ($box == "right02") {
			$area = "#secondary";
		} else if ($box == "top") {
			$area = "#access";
		} else if ($box == "bottom") {
			$area = "#footer-widget-area";
		} else if ($box == "content") {
			$area = "#content";
		} else if ($box == "header") {
			$area = ".headerblock";
		} else {
			$area = ".".$box;
		}
		
		/******************************************************************************
		 * Generate IE only CSS for opacity settings
		 ******************************************************************************/
		
	   $options[$box.'-color-ie'] = $area." {".translucence_ie_opacity_css($options[$box.'-color'], $options[$box.'-opacity'])."}";

		// set the IE submenu-color opacity for top bar
		if ($box == "top") {
			$options['submenu-color-ie'] = "#access ul ul a, #access li:hover > a, #access ul ul :hover > a ";
			$options['submenu-color-ie'] .= "{background: ".$options[$box.'-color'].";}";
		}
		
		if ($box == "description-box") {
			$options[$box.'-color-ie'] = "#ie-description-box .description-box {".translucence_ie_opacity_css($options[$box.'-color'], $options[$box.'-opacity'])."}";
		}		
		
		// visibility and padding of bars
		if (isset($options[$box.'-width']) && $options[$box.'-width'] == '0') {	
			$options[$box.'-visibility'] = "none";
			$options[$box.'-padding'] = "25";
		
		// if visible bar padding
		} else {
			$options[$box.'-visibility'] = "block";
			$options[$box.'-padding'] = "25";
		}
		
	}

	/******************************************************************************
	 * Display colophon with border only if footer-widget-area has no border
	 ******************************************************************************/

	if ($options['bottom-border-style'] == 'none') {
		$options['colophon-border-type'] = "dotted";
	} else {
		$options['colophon-border-type'] = "none";
	}
	
	/******************************************************************************
	 * calculate width of footer widget areas based on site width
	 ******************************************************************************/
	$active_widgets = 0;
	if ( is_active_sidebar( 'first-footer-widget-area' ) ) $active_widgets ++;
	if ( is_active_sidebar( 'second-footer-widget-area' ) ) $active_widgets ++;
	if ( is_active_sidebar( 'third-footer-widget-area' ) ) $active_widgets ++;
	if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) $active_widgets ++;
	
	if ($active_widgets > 0)
		$options['footer-widget-width'] = round($options['site-width']/$active_widgets)-10;
	
	//printpre($options['footer-widget-width']);

	/******************************************************************************
	 * Entry text line height
	 ******************************************************************************/
	$options['entry-line-height'] = $options['entry-text-size'] + round($options['entry-text-size']/2);
	
	/******************************************************************************
	 * Entry link style options
	 ******************************************************************************/

	$link_types = array('entry');
	
	foreach($link_types as $link_type) {
	
		if ($options[$link_type.'-link-style'] == "none") {
			$options[$link_type.'-link-border'] = "none";
			$options[$link_type.'-link-decoration'] = "none";
			$options[$link_type.'-link-hover-border'] = "solid";
			$options[$link_type.'-link-hover-background_color'] = $options['content-color'];
			$options[$link_type.'-link-hover-decoration'] = "underline";
			$options[$link_type.'-link-background'] = "transparent";
			$options[$link_type.'-link-color'] = $options['linkcolor'];
			
		} else if ($options[$link_type.'-link-style'] == "underline") {
			$options[$link_type.'-link-border'] = "dotted";
			$options[$link_type.'-link-decoration'] = "none";
			$options[$link_type.'-link-hover-border'] = "solid"; 
			$options[$link_type.'-link-hover-background_color'] = $options['content-color'];
			$options[$link_type.'-link-hover-decoration'] = "underline";
			$options[$link_type.'-link-background'] = "none";
			$options[$link_type.'-link-color'] = $options['linkcolor'];

		} else if ($options[$link_type.'-link-style'] == "ww") {
			$options[$link_type.'-link-border'] = "dotted ";
			$options[$link_type.'-link-hover-border'] = "solid";
			$options[$link_type.'-link-decoration'] = "none";
			$options[$link_type.'-link-hover-decoration'] = "none";
			$options[$link_type.'-link-color'] = $options['linkcolor'];
			if ($options['content-color'] == '#000000') {
				$options[$link_type.'-link-hover-background_color'] = "#262626";
			} else if ($options['content-color'] == '#262626') {
				$options[$link_type.'-link-hover-background_color'] = "#000000";
			} else {
				$options[$link_type.'-link-hover-background_color'] = "#efc";
			}
		} 
	}	

	/******************************************************************************
	 * Sidebar display options
	 * Options for which sidebars to display on various pages
	 ******************************************************************************/
	$pages = array('post', 'category', 'tag', 'author', 'search', 'archives');

	foreach($pages as $page) {
		if ($options[$page.'-single-sidebar'] == 'right01') {
			$options[$page.'-sidebar-left-display'] = "hide";
			$options[$page.'-sidebar-right-display'] = "show";
			$options[$page.'-sidebar-right02-display'] = "hide";
			
		} else if ($options[$page.'-single-sidebar'] == 'left01') {
			$options[$page.'-sidebar-left-display'] = "show";
			$options[$page.'-sidebar-right-display'] = "hide";
			$options[$page.'-sidebar-right02-display'] = "hide";
	
		} else if ($options[$page.'-single-sidebar'] == 'right02') {
			$options[$page.'-sidebar-left-display'] = "hide";
			$options[$page.'-sidebar-right-display'] = "hide";
			$options[$page.'-sidebar-right02-display'] = "show";
			
		} else if ($options[$page.'-single-sidebar'] == 'left01right01') {
			$options[$page.'-sidebar-left-display'] = "show";
			$options[$page.'-sidebar-right-display'] = "show";
			$options[$page.'-sidebar-right02-display'] = "hide";
	
		} else if ($options[$page.'-single-sidebar'] == 'left01right02') {
			$options[$page.'-sidebar-left-display'] = "show";
			$options[$page.'-sidebar-right-display'] = "hide";
			$options[$page.'-sidebar-right02-display'] = "show";
			
		} else if ($options[$page.'-single-sidebar'] == 'right01right02') {
			$options[$page.'-sidebar-left-display'] = "hide";
			$options[$page.'-sidebar-right-display'] = "show";
			$options[$page.'-sidebar-right02-display'] = "show";
			
		} else if ($options[$page.'-single-sidebar'] == 'none') {
			$options[$page.'-sidebar-left-display'] = "hide";
			$options[$page.'-sidebar-right-display'] = "hide";
			$options[$page.'-sidebar-right02-display'] = "hide";
		}	
	}
	
			
	$options['page-image-width'] = $options['site-width']-50;

}

/******************************************************************************
 * Provides feedback to user about theme option choses
 ******************************************************************************/

function translucence_option_feedback() {
	global $options, $variation_config;
	
	$main_column_width = $options['site-width'] - ($options['left01-width'] + $options['right01-width'] + 174);
	$message = "<strong>Your changes have been saved.</strong>";
	$error = "false";
	
	
	if ($options['revert'] == 1) {
		$message = "These are the default settings for the ".$variation_config['theme-name']." theme.";
		$error = "true";

	} else if (isset($_POST['reset'])) {
		$message .= " <br/><br/>The ".$options['theme-name']." theme options have been reverted to their default settings.";
		$error = "true";

	} else {

		if ($options['background_color'] == '#0F0F0F') {
			$message .= " Black is a good choice for blogs that focus on images, particularly photos.";
						
			if ($options['header-image-options'] == "whitegradient") {
				$message .= " <br/><br/>The white gradient image really doesn't look good here.  Best to upload your own custom image or use none.";
				$error = "true";
			} 

		} 		
		
		if (is_active_sidebar("tertiary-widget-area") && $options['left01-width'] == 0) {
			$message .= " <br/><br/>Your left sidebar is hidden but contains widgets.";
			$error = "true";
		}

		if (is_active_sidebar("primary-widget-area") && $options['right01-width'] == 0) {
			$message .= " <br/><br/>Your right sidebar is hidden but contains widgets.";
			$error = "true";
		}

		if (is_active_sidebar("secondary-widget-area") && $options['right02-width'] == 0) {
			$message .= " <br/><br/>Your 2nd right sidebar is hidden but contains widgets.";
			$error = "true";
		}
				
		if ($options['left01-width'] == "125") {
			$message .= "<br/>Your left sidebar is only 175px.  This may be too narrow for some widgets (e.g. calendar widget)";
			$error = "true";
		} 

		if ($options['right01-width'] == "125") {
			$message .= "<br/>Your right sidebar is only 175px.  This may be too narrow for some widgets (e.g. calendar widget)";
			$error = "true";
		} 

		if ($options['right02-width'] == "125") {
			$message .= "<br/>Your 2nd right sidebar is only 175px.  This may be too narrow for some widgets (e.g. calendar widget)";
			$error = "true";
		} 		
			
		$pages = array('post', 'category', 'tag', 'author', 'search');
		
		foreach($pages as $page) {
		
			if ($options[$page.'-sidebar-right-display'] == "show" && $options['right01-width'] == 0) {
				$message .= " <br/>You wanted to show your right sidebar on ".$page." pages but you have hidden it...";
				$error = "true";
			} 
	
			if ($options[$page.'-sidebar-right02-display'] == "show" && $options['right02-width'] == 0) {
				$message .= " <br/>You wanted to show your 2nd right sidebar on ".$page." pages but you have hidden it...";
				$error = "true";
			} 
		
			if ($options[$page.'-sidebar-left-display'] == "show" && $options['left01-visibility'] == "hidden") {
				$message .= " <br/>You wanted to show your left sidebar on ".$page." pages but you have hidden it...";
				$error = "true";
			} 			
		}
		
		if ($error == "false") {
			$message .= " Visit the site";
		}

	}
	
    print
    "
        <div class='updated fade' id='message'
            style='background-color: #fff3cc;
                    margin-right: 50px;
                    margin-top: 30px;
                    margin-left: 20px'>
            <p><em>".$message.".</em></p>
        </div>
    ";

}



/******************************************************************************
 * Delete options deletes the theme options and initializes theme options array
 ******************************************************************************/

function translucence_delete_options() {
    global $options, $theme_options;
	
	$options = array();
	
	delete_option($theme_options); 	
	
	add_option($theme_options, array('init' => 1));  	

}

/*********************************************************
 * Hext to RGB converter for setting transparency using RGBa
 * $c can be either hex or rgb
 *********************************************************/
 
 function translucence_hex2rgb($color) {
	if (!$color) return false;
	$color = trim($color);
	$rgb_color = false;
   
	if (eregi("^[0-9ABCDEFabcdef\#]+$", $color)) {
		$color = str_replace('#','', $color);
		$l = strlen($color) == 3 ? 1 : (strlen($color) == 6 ? 2 : false);
	}

	if ($l) {
		unset($rgb_color);
		//$out = "rgba(";
		$rgb_color = hexdec(substr($color, 0,1*$l)).", ";
		$rgb_color .= hexdec(substr($color, 1*$l,1*$l)).", ";
		$rgb_color .= hexdec(substr($color, 2*$l,1*$l));
	} else $rgb_color = false;
	return $rgb_color;
}

/******************************************************************************
 * Generates IE proprietary CSS for opacity 
 ******************************************************************************/

function translucence_ie_opacity_css ($color, $opacity) {
	if (!$color) return false;
	$color = trim($color);
	$out = false;
	
	if (eregi("^[0-9]+(,| |.)+[0-9]+(,| |.)+[0-9]+$", $color)) {
		$color = translucence_hex2rgb($color);
	}
	
	$color = ereg_replace("#", "", $color);
	$hex_opacity = strtoupper(dechex($opacity*255));
	if ($opacity == "0") $hex_opacity = "00";
	$hex_rgba = "#".$hex_opacity.$color;
	
	$out = "*background:transparent;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=";
	$out .= $hex_rgba;
	$out .= ",endColorstr=";
	$out .= $hex_rgba;
	$out .= ");zoom: 1;";
	return $out;
}