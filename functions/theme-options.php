<?php // 2010 Translucence theme options

add_action( 'admin_init', 'translucence_theme_options_init' );
add_action('admin_menu', 'translucence_variation_add_page');
add_action( 'admin_bar_menu', 'translucence_add_menu_admin_bar' ,  70);

 /**
 * Initialize plugin to white list theme options
 *
 * @uses register_setting()
 *
 * @since 2010 Translucence 1.0
 */

function translucence_theme_options_init() {
	global $translucence_options_id;
	
	register_setting( $translucence_options_id, $translucence_options_id, 'translucence_validate_options' );	
}




 /**
 * Updates theme options
 *
 * @uses translucence_get_variation_options()
 * @uses translucence_set_derivative_options()
 * @uses translucence_options_css()
 * @uses update_option()
 *
 * @since 2010 Translucence 1.0
 */

function translucence_theme_options_update() {
	global $translucence_options_id, $translucence_options;
	
	// get theme option value lists for selected variation theme option
	translucence_get_variation_options();
	
	// set derivative theme options based on default or selected primary theme options
	translucence_set_derivative_options();
	
	// get css generated from primary and derivative theme options
	$translucence_options['css'] = translucence_options_css();
	
	// if content set is selected to be added then add that content
	if ($translucence_options['content'] != "default") {
		translucence_add_default_content($translucence_options['added-content']);
		$translucence_options['added-content'] = "default";
		$translucence_options['content'] = "default";
	}
	
	// update theme options 
	update_option($translucence_options_id, $translucence_options);
}




 /**
 * Add Theme Options page to edit_theme_options
 *
 * @uses add_theme_page()
 *
 * @since 2010 Translucence 1.0
 */

function translucence_variation_add_page() {
	
    add_theme_page('Theme Options', 'Theme Options', 'edit_theme_options', 'variations', 'translucence_theme_options_do_page');
}




 /**
 * Adds link to Theme Options in the Admin Bar
 *
 * @uses current_user_can()
 * @uses is_admin_bar_showing()
 *
 * @since 2010 Translucence 1.0
 */

function translucence_add_menu_admin_bar() {
    global $wp_admin_bar;
    
    if ( !current_user_can( 'switch_themes' ) || !is_admin_bar_showing() )
        return; 
        
    $wp_admin_bar->add_menu( array( 'parent' => 'appearance', 'title' =>__( 'Theme Options', 'options' ), 'href' => admin_url()."themes.php?page=variations" ) );
}




 /**
 * Validate primary options (options exposed to user in theme options UI)
 *
 * @uses translucence_get_option_modes() to get array of option modes
 * @uses wp_kses() to sanitize theme options that contain html
 *
 * @since 2010 Translucence 1.0
 * @return array sanitized input
 */
 
function translucence_validate_options($input) {
	global $allowedposttags, $translucence_config, $translucence_options_id; 
	global $translucence_options_values, $translucence_variations;

	$translucence_options_mode = translucence_get_option_modes();
	$valid_input = array();
	$validated = array();
	$not_validated = array();
	
	$validation_debug = 0;
	
	if (isset($input['reset']) && $input['reset'] == __( 'Revert to Default', '2010-translucence' )) {
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
			
		} else if ($option == "headerrightcustom") {
			$input['headerrightcustom'] = wp_kses($input['headerrightcustom'], $allowedposttags);
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
			if (in_array($value, $translucence_options_values['border-style'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate all options the specify a shadow offset
		} else if (preg_match("/shadow-offset/", $option)) {
			if (in_array($value, $translucence_options_values['text-shadow-offset'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate all options the specify a shadow blur
		} else if (preg_match("/shadow-blur/", $option)) {
			if (in_array($value, $translucence_options_values['text-shadow-blur'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate all options the specify a which sidebars to display
		// on post, author, category, tag, search and archives pages 
		} else if (preg_match("/single-sidebar/", $option)) {
			if (in_array($value, $translucence_options_values['sidebar-display'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate text-align option
		} else if (preg_match("/text-align/", $option)) {
			if (in_array($value, $translucence_options_values['entry-text-align'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate entry-link-style option
		} else if (preg_match("/entry-link-style/", $option)) {
			if (in_array($value, $translucence_options_values['entry-link-style'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate header-text-display option
		} else if (preg_match("/header-text-display/", $option)) {
			if (in_array($value, $translucence_options_values['header-text-display'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate header-block-height option
		} else if (preg_match("/header-block-height/", $option)) {
			if (in_array($value, $translucence_options_values['header-block-height'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate header-meta-left options
		} else if (preg_match("/header-meta-left/", $option)) {
			if (array_key_exists($value, $translucence_config['header_meta_left_options'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validate header-meta-right options
		} else if (preg_match("/header-meta-right/", $option)) {
			if (array_key_exists($value, $translucence_config['header_meta_right_options'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}


		// validate footer-meta-left options
		} else if (preg_match("/footer-meta-left/", $option)) {
			if (array_key_exists($value, $translucence_config['footer_meta_left_options'])) {
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
			if (in_array($value, $translucence_variations)) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}

		// validates options-mode option
		} else if (preg_match("/options-mode/", $option)) {
			if (in_array($value, $translucence_options_mode)) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}
		} else if (preg_match("/activated-widgets/", $option)) {
			if (in_array($value, array_keys($translucence_config['preset_widgets']))) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}
		} else if (preg_match("/widgets/", $option)) {
			$valid_input = __('Activate New Widgets', '2010-translucence');
			if ($value == $valid_input || $value == "default" || $value == "initialize") {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}
		} else if (preg_match("/added-content/", $option)) {
			if (in_array($value, array_keys($translucence_config['preset_content']))) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}
		} else if (preg_match("/content/", $option)) {
			$valid_input = __('Add New Content', '2010-translucence');
			if ($value == $valid_input || $value == "default") {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}
		} else if (preg_match("/activated-theme/", $option)) {
			if ($value == 0 || $value == 1) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}
		} else if (preg_match("/variation-type/", $option)) {
			if (in_array($value, $translucence_options_values['variation-type'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}
		} else if (preg_match("/default-post-display/", $option)) {
			if (in_array($value, $translucence_options_values['post-display'])) {
				$input[$option] = $value;
				$validated[] = $option;
			} else {
				$input[$option] = null;
				$not_validated[] = $option;
			}
		} else if (preg_match("/page-links-display/", $option)) {
			if ($value == "true" || $value == "false") {
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

 /**
 * Get default variation (note: child themes may override this)
 *
 * @uses get_template_directory() to get default variation
 *
 * @since 2010 Translucence 1.0
 * @return string path to default variation file
 */
 
if (!function_exists('translucence_get_variation_default')) {	
	function translucence_get_variation_default() {
		if (file_exists(get_template_directory() .'/variations/default/variation.php')) {
			$variation_default = get_template_directory() .'/variations/default/variation.php';
		}
		return $variation_default;		
	}
}

 /**
 * Get default theme options from translucence_config
 *
 * @since 2010 Translucence 1.0
 */

function translucence_get_variation_default_config() {
	global $translucence_config, $translucence_options;
	
	//foreach( $translucence_config as $key => $value )
	//{
	//	if( !isset($translucence_options[$key]) )
	//		$translucence_options[$key] = $value;
	//}
	
	if (!isset($translucence_options['theme-name'])) $translucence_options['theme-name'] = $translucence_config['theme-name'];
	if (!isset($translucence_options['theme-url'])) $translucence_options['theme-url'] = $translucence_config['theme-url'];
	
	if (!isset($translucence_options['activated-theme'])) $translucence_options['activated-theme'] = $translucence_config['activated-theme'];
	if (!isset($translucence_options['activated-widgets'])) $translucence_options['activated-widgets'] = $translucence_config['activated-widgets'];
	if (!isset($translucence_options['widgets'])) $translucence_options['widgets'] = $translucence_config['widgets'];
	if (!isset($translucence_options['variation-type'])) $translucence_options['variation-type'] = $translucence_config['variation-type'];
	
	if (!isset($translucence_options['content'])) $translucence_options['content'] = $translucence_config['content'];
	if (!isset($translucence_options['added-content'])) $translucence_options['added-content'] = $translucence_config['added-content'];
	
	if (!isset($translucence_options['headermeta'])) $translucence_options['headermeta'] = $translucence_config['headermeta'];
	if (!isset($translucence_options['background'])) $translucence_options['background'] = $translucence_config['background'];
	if (!isset($translucence_options['site-title-color'])) $translucence_options['site-title-color'] = $translucence_config['site-title-color'];
	if (!isset($translucence_options['site-description-color'])) $translucence_options['site-description-color'] = $translucence_config['site-description-color'];
	
	if (!isset($translucence_options['options-mode'])) $translucence_options['options-mode'] = $translucence_config['options-mode'];
	if (!isset($translucence_options['revert'])) $translucence_options['revert'] = $translucence_config['revert'];
	
	if (!isset($translucence_options['site-width'])) $translucence_options['site-width'] = $translucence_config['site-width'];
	if (!isset($translucence_options['header-block-height'])) $translucence_options['header-block-height'] = $translucence_config['header-block-height'];
	
	if (!isset($translucence_options['site-title-size'])) $translucence_options['site-title-size'] = $translucence_config['site-title-size'];
	if (!isset($translucence_options['site-description-size'])) $translucence_options['site-description-size'] = $translucence_config['site-description-size'];
	if (!isset($translucence_options['header-text-shadow-offset'])) $translucence_options['header-text-shadow-offset'] = $translucence_config['header-text-shadow-offset'];
	if (!isset($translucence_options['header-text-shadow-blur'])) $translucence_options['header-text-shadow-blur'] = $translucence_config['header-text-shadow-blur'];
	
	if (!isset($translucence_options['entry-text-size'])) $translucence_options['entry-text-size'] = $translucence_config['entry-text-size'];
	if (!isset($translucence_options['entry-line-height'])) $translucence_options['entry-line-height'] = $translucence_config['entry-line-height'];
	
	if (!isset($translucence_options['footer-meta-left'])) $translucence_options['footer-meta-left'] = $translucence_config['footer-meta-left'];
	if (!isset($translucence_options['header-meta-left'])) $translucence_options['header-meta-left'] = $translucence_config['header-meta-left'];
	if (!isset($translucence_options['headerleftcustom'])) $translucence_options['headerleftcustom'] = $translucence_config['headerleftcustom'];
	if (!isset($translucence_options['footerleftcustom'])) $translucence_options['footerleftcustom'] = $translucence_config['footerleftcustom'];

	if (!isset($translucence_options['header-meta-right'])) $translucence_options['header-meta-right'] = $translucence_config['header-meta-right'];
	if (!isset($translucence_options['headerrightcustom'])) $translucence_options['headerrightcustom'] = $translucence_config['headerrightcustom'];
	
	if (!isset($translucence_options['header-image-options'])) $translucence_options['header-image-options'] = $translucence_config['header-image-options'];
	
	if (!isset($translucence_options['header-text-display'])) $translucence_options['header-text-display'] = $translucence_config['header-text-display'];
	if (!isset($translucence_options['entry-link-style'])) $translucence_options['entry-link-style'] = $translucence_config['entry-link-style'];
	if (!isset($translucence_options['entry-text-align'])) $translucence_options['entry-text-align'] = $translucence_config['entry-text-align'];
	if (!isset($translucence_options['tag-links-color'])) $translucence_options['tag-links-color'] = $translucence_config['tag-links-color'];
	if (!isset($translucence_options['cat-links-color'])) $translucence_options['cat-links-color'] = $translucence_config['cat-links-color'];
	
	if (!isset($translucence_options['site-padding-top'])) $translucence_options['site-padding-top'] = $translucence_config['site-padding-top'];
	if (!isset($translucence_options['site-padding-bottom'])) $translucence_options['site-padding-bottom'] = $translucence_config['site-padding-bottom'];
	if (!isset($translucence_options['content-padding'])) $translucence_options['content-padding'] = $translucence_config['content-padding'];
	
	if (!isset($translucence_options['site-color'])) $translucence_options['site-color'] = $translucence_config['site-color'];
	if (!isset($translucence_options['title-box-color'])) $translucence_options['title-box-color'] = $translucence_config['title-box-color'];
	if (!isset($translucence_options['description-box-color'])) $translucence_options['description-box-color'] = $translucence_config['description-box-color'];
	if (!isset($translucence_options['header-color'])) $translucence_options['header-color'] = $translucence_config['header-color'];
	if (!isset($translucence_options['top-color'])) $translucence_options['top-color'] = $translucence_config['top-color'];
	if (!isset($translucence_options['left01-color'])) $translucence_options['left01-color'] = $translucence_config['left01-color'];
	if (!isset($translucence_options['content-color'])) $translucence_options['content-color'] = $translucence_config['content-color'];
	if (!isset($translucence_options['right01-color'])) $translucence_options['right01-color'] = $translucence_config['right01-color'];
	if (!isset($translucence_options['right02-color'])) $translucence_options['right02-color'] = $translucence_config['right02-color'];
	if (!isset($translucence_options['bottom-color'])) $translucence_options['bottom-color'] = $translucence_config['bottom-color'];
	
	if (!isset($translucence_options['site-opacity'])) $translucence_options['site-opacity'] = $translucence_config['site-opacity'];
	if (!isset($translucence_options['title-box-opacity'])) $translucence_options['title-box-opacity'] = $translucence_config['title-box-opacity'];
	if (!isset($translucence_options['description-box-opacity'])) $translucence_options['description-box-opacity'] = $translucence_config['description-box-opacity'];
	
	if (!isset($translucence_options['header-opacity'])) $translucence_options['header-opacity'] = $translucence_config['header-opacity'];
	if (!isset($translucence_options['top-opacity'])) $translucence_options['top-opacity'] = $translucence_config['top-opacity'];
	if (!isset($translucence_options['left01-opacity'])) $translucence_options['left01-opacity'] = $translucence_config['left01-opacity'];
	if (!isset($translucence_options['content-opacity'])) $translucence_options['content-opacity'] = $translucence_config['content-opacity'];
	if (!isset($translucence_options['right01-opacity'])) $translucence_options['right01-opacity'] = $translucence_config['right01-opacity'];
	if (!isset($translucence_options['right02-opacity'])) $translucence_options['right02-opacity'] = $translucence_config['right02-opacity'];
	if (!isset($translucence_options['bottom-opacity'])) $translucence_options['bottom-opacity'] = $translucence_config['bottom-opacity'];
	
	if (!isset($translucence_options['site-border-style'])) $translucence_options['site-border-style'] = $translucence_config['site-border-style'];
	if (!isset($translucence_options['header-border-style'])) $translucence_options['header-border-style'] = $translucence_config['header-border-style'];
	if (!isset($translucence_options['top-border-style'])) $translucence_options['top-border-style'] = $translucence_config['top-border-style'];
	if (!isset($translucence_options['content-border-style'])) $translucence_options['content-border-style'] = $translucence_config['content-border-style'];
	if (!isset($translucence_options['left01-border-style'])) $translucence_options['left01-border-style'] = $translucence_config['left01-border-style'];
	if (!isset($translucence_options['right01-border-style'])) $translucence_options['right01-border-style'] = $translucence_config['right01-border-style'];
	if (!isset($translucence_options['right02-border-style'])) $translucence_options['right02-border-style'] = $translucence_config['right02-border-style'];
	if (!isset($translucence_options['bottom-border-style'])) $translucence_options['bottom-border-style'] = $translucence_config['bottom-border-style'];
	
	if (!isset($translucence_options['header-width'])) $translucence_options['header-width'] = $translucence_config['header-width'];
	if (!isset($translucence_options['left01-width'])) $translucence_options['left01-width'] = $translucence_config['left01-width'];
	if (!isset($translucence_options['right01-width'])) $translucence_options['right01-width'] = $translucence_config['right01-width'];
	if (!isset($translucence_options['right02-width'])) $translucence_options['right02-width'] = $translucence_config['right02-width'];
	
	if (!isset($translucence_options['post-single-sidebar'])) $translucence_options['post-single-sidebar'] = $translucence_config['post-single-sidebar'];
	if (!isset($translucence_options['category-single-sidebar'])) $translucence_options['category-single-sidebar'] = $translucence_config['category-single-sidebar'];
	if (!isset($translucence_options['tag-single-sidebar'])) $translucence_options['tag-single-sidebar'] = $translucence_config['tag-single-sidebar'];
	if (!isset($translucence_options['author-single-sidebar'])) $translucence_options['author-single-sidebar'] = $translucence_config['author-single-sidebar'];
	if (!isset($translucence_options['search-single-sidebar'])) $translucence_options['search-single-sidebar'] = $translucence_config['search-single-sidebar'];
	if (!isset($translucence_options['archives-single-sidebar'])) $translucence_options['archives-single-sidebar'] = $translucence_config['archives-single-sidebar'];

	if (!isset($translucence_options['default-post-display'])) $translucence_options['default-post-display'] = $translucence_config['default-post-display'];
	if (!isset($translucence_options['page-links-display'])) $translucence_options['page-links-display'] = $translucence_config['page-links-display'];
	
}

 /**
 * Get path to variations source files (note: child themes may override this)
 *
 * @uses get_template_directory() to get variations directory
 *
 * @since 2010 Translucence 1.0
 * @return string path to variations directory
 */

if (!function_exists('translucence_get_variations_source')) {
	function translucence_get_variations_source() {
	
		if (file_exists(get_template_directory() .'/variations/')) {
			$translucence_variations_path = get_template_directory() .'/variations';
		}
		return $translucence_variations_path;
	}
}

 /**
 * Get options for variations (based on translucence_options['background'])
 *
 * @uses translucence_get_variation_default() to get default variation file
 * @uses translucence_get_variation_default_config() to get default configuration
 * @uses translucence_get_variations_source() to get path to variations directory
 * @uses wp_kses() to sanitize variation name from variation file
 * @uses get_background_color() to get custom background color
 * @uses get_background_image() to get custom background image
 *
 * @since 2010 Translucence 1.0
 */

function translucence_get_variation_options() {
	global $translucence_options, $translucence_options_values, $translucence_variations;

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
	 * option value lists are the option values users can select in the theme options UI
	 * (variation info is extracted from variation.php file using same functions
	 * used to extract theme info from theme style.css
	 ******************************************************************************/
	
	$translucence_variations = array();
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
						$translucence_variations[$name] = $id;
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
				
		if ($custom_background_color !="") $translucence_options['background_color'] = "#".$custom_background_color;
		if ($custom_background_image !="") $translucence_options['background_image'] = $custom_background_image;		

		ksort($translucence_variations);
		
	}
		
	// if no variation has been selected then use theme defaults
	if (isset($_POST)) {
		if (!in_array($translucence_options['header-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['header-color'] = "#F9F9F9";
		if (!in_array($translucence_options['top-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['top-color'] = "#FFFFFF";
		if (!in_array($translucence_options['left01-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['left01-color'] = "#F3F3F3";
		if (!in_array($translucence_options['content-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['content-color'] = "#FFFFFF";
		if (!in_array($translucence_options['right01-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['right01-color'] = "#F3F3F3";
		if (!in_array($translucence_options['right02-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['right02-color'] = "#F3F3F3";
		if (!in_array($translucence_options['bottom-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['bottom-color'] = "#FFFFFF";
		if (!in_array($translucence_options['linkcolor'], array_values($translucence_options_values['linkcolor']))) $translucence_options['linkcolor'] = "#003366";
		if (!in_array($translucence_options['textcolor'], array_values($translucence_options_values['textcolor']))) $translucence_options['textcolor'] = "#444444";
		if (!in_array($translucence_options['entry-link-style'], array_values($translucence_options_values['entry-link-style']))) $translucence_options['entry-link-style'] = "underline";
		if (!in_array($translucence_options['cat-links-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['cat-links-color'] = "#e9e9c9";
		if (!in_array($translucence_options['tag-links-color'], array_values($translucence_options_values['sidebar-color']))) $translucence_options['tag-links-color'] = "#FFF8C6";
	}
	//translucence_set_derivative_options();	
}

 /**
 * Set derivative options uses primary options (i.e. those exposed in theme options UI)
 *
 * @uses translucence_hex2rgb() to convert hexidecimal colors and opacity to rgba()
 * @uses translucence_ie_opacity_css() to hexidecimal colors and opacity to IE image filter transforms
 * @uses is_active_sidebar() to determine how many footer widget areas are active in order to set their widths
 *
 * @since 2010 Translucence 1.0
 */

function translucence_set_derivative_options() {
	global $translucence_config, $translucence_options, $translucence_options_values, $custom_background_image;
	
	/******************************************************************************
	 * Site top padding (derived from  site-border-style)
	 ******************************************************************************/
	
	if ($translucence_options['site-border-style'] != 'none') {
		$translucence_options['site-padding-top'] = "20";
		$translucence_options['site-padding-bottom'] = "20";
	} else {
		$translucence_options['site-padding-top'] = "10";
		$translucence_options['site-padding-bottom'] = "10";
	}
	
	if ($translucence_options['site-border-style'] == 'solid') {
		$translucence_options['site-border-shadow'] = 5;
	} else {
		$translucence_options['site-border-shadow'] = 0;
	}


	/******************************************************************************
	 * Header left links (derived from  header_meta_left_options)
	 ******************************************************************************/
	
	if ($translucence_options['header-meta-left'] == 'custom') {
		if (stripslashes($translucence_options['headerleftcustom']) != "") {
			$translucence_options['headerleft'] = stripslashes($translucence_options['headerleftcustom']);
		} else {
			$translucence_options['headerleft'] = "&nbsp;";
		}
	} else {
		$translucence_options['headerleft'] = $translucence_config['header_meta_left_options'][$translucence_options['header-meta-left']]['option_value'];					
	}

	/******************************************************************************
	 * Header right links (derived from header_meta_right_options)
	 ******************************************************************************/
	
	if ($translucence_options['header-meta-right'] == 'custom') {
		$translucence_options['headerright'] = stripslashes($translucence_options['headerrightcustom']);
	} else {
		$translucence_options['headerright'] = $translucence_config['header_meta_right_options'][$translucence_options['header-meta-right']]['option_value'];					
	}
	
	/******************************************************************************
	 * Top Navigation area margins (derived from top-border-style)
	 * if no border on top nav, then no space between header image and nav
	 ******************************************************************************/
	if ($translucence_options['top-border-style'] == "solid" || $translucence_options['top-border-style'] == "dotted") {
		$translucence_options['top-margin-top'] = "1";
	} else {
		$translucence_options['top-margin-top'] = "0";
	}

	/******************************************************************************
	 * Footer left links (derived from meta_right_options)
	 ******************************************************************************/
	if ($translucence_options['footer-meta-left'] == 'custom') {
		$translucence_options['footerleft'] = stripslashes($translucence_options['footerleftcustom']);
	} else {
		$translucence_options['footerleft'] = $translucence_config['footer_meta_left_options'][$translucence_options['footer-meta-left']]['option_value'];					
	}

	/******************************************************************************
	 * Blog title and description display option 
	 * (derived from header-text-display and header-block-height options)
	 * ugh, i really need to refactor this...
	 ******************************************************************************/
	
	
	if ($translucence_options['header-text-display'] != "hide") {
		$translucence_options['show-header-text'] = "inline-block";
		$translucence_options['show-header-text-ie7'] = "inline";
	} else {
		$translucence_options['show-header-text'] = "none";
		$translucence_options['show-header-text-ie7'] = "none";
	}
	
	$translucence_options['title-box-height'] = $translucence_options['site-title-size'] + $translucence_options['site-description-size'] + 6 + 4 + 2;
	$translucence_options['header-top-margin'] = 0;
	
	switch( $translucence_options['header-text-display'] )
	{
		case "top":
		case "hide":
			$translucence_options['title-box-top'] = 10;
			$translucence_options['title-box-left'] = 10;
			$translucence_options['title-box-top-margin'] = 0;
			break;
		
		case "middle":
			$translucence_options['title-box-top'] = $translucence_options['header-block-height'] / 2;
			$translucence_options['title-box-left'] = 10;
			$translucence_options['title-box-top-margin'] = $translucence_options['title-box-height'] / 2 * -1;
			break;
		
		case "bottom":
			$translucence_options['title-box-top'] = $translucence_options['header-block-height'] - 10;
			$translucence_options['title-box-left'] = 10;
			$translucence_options['title-box-top-margin'] = $translucence_options['title-box-height'] * -1;
			break;
		
		case "above":
		default:
			$translucence_options['title-box-top'] = -10;
			$translucence_options['title-box-left'] = 10;
			$translucence_options['title-box-top-margin'] = $translucence_options['title-box-height'] * -1;
			$translucence_options['header-top-margin'] = $translucence_options['title-box-height'] + 10;
			break;
	}
	
	$translucence_options['description-text-padding-top'] = $translucence_options['header-text-padding-top'] + 12;
	
	// IE hack for title-box padding
	if ($translucence_options['site-title-size'] < 20) {
		$translucence_options['ie-site-title-padding'] = 8;
	} else if ($translucence_options['site-title-size'] < 30) {
		$translucence_options['ie-site-title-padding'] = 10;
	} else if ($translucence_options['site-title-size'] < 40) {
		$translucence_options['ie-site-title-padding'] = 15;
	} else if ($translucence_options['site-title-size'] < 61) {
		$translucence_options['ie-site-title-padding'] = 22;
	}
	

	/******************************************************************************
	 * visited link color options (derived from link and text colors)
	 ******************************************************************************/
	
	// dark blue or gold
	if ($translucence_options['linkcolor'] == '#003366' || $translucence_options['linkcolor'] == '#625b1d') {	
		// black
		if ($translucence_options['textcolor'] == '#222222') {
			$translucence_options['linkcolor_visited'] = "#000000";
		// 80% gray
		} else if ($translucence_options['textcolor'] == '#333333') {
			$translucence_options['linkcolor_visited'] = "#000000";
		// 70% gray
		} else if ($translucence_options['textcolor'] == '#444444') {
			$translucence_options['linkcolor_visited'] = "#000000";
		// 60% gray
		} else if ($translucence_options['textcolor'] == '#555555') {
			$translucence_options['linkcolor_visited'] = "#000000";
		// 50% gray
		} else if ($translucence_options['textcolor'] == '#666666') {
			$translucence_options['linkcolor_visited'] = "#000000";
		// 40% gray
		} else if ($translucence_options['textcolor'] == '#777777') {
			$translucence_options['linkcolor_visited'] = "#000000";
		// 30% gray
		} else if ($translucence_options['textcolor'] == '#888888') {
			$translucence_options['linkcolor_visited'] = "#333333";
		// 20% gray
		} else if ($translucence_options['textcolor'] == '#CCCCCC') {
			$translucence_options['linkcolor_visited'] = "#333333";
		// 10% gray	
		} else if ($translucence_options['textcolor'] == '#EEEEEE') {
			$translucence_options['linkcolor_visited'] = "#CCCCCC";
		}
		
		
	//  light blue
	} else if ($translucence_options['linkcolor'] == '#0066cc') {	
		$translucence_options['linkcolor_visited'] = "#003366";
	// red
	} else if ($translucence_options['linkcolor'] == '#990000') {	
		$translucence_options['linkcolor_visited'] = "#996666";
	// green
	}  else if ($translucence_options['linkcolor'] == '#265e15') {	
		$translucence_options['linkcolor_visited'] = "#6D9C54";
		
	// pale yellow
	}  else if ($translucence_options['linkcolor'] == '#FFFFCC') {	
		// 40% gray
		if ($translucence_options['textcolor'] == '#777777') {
			$translucence_options['linkcolor_visited'] = "#FFFFFF";
		// 30% gray
		} else if ($translucence_options['textcolor'] == '#888888') {
			$translucence_options['linkcolor_visited'] = "#FFFFFF";
		// 20% gray
		} else if ($translucence_options['textcolor'] == '#CCCCCC') {
			$translucence_options['linkcolor_visited'] = "#FFFFFF";
		// 10% gray	
		} else if ($translucence_options['textcolor'] == '#EEEEEE') {
			$translucence_options['linkcolor_visited'] = "#FFFFFF";
		} else {
			$translucence_options['linkcolor_visited'] = "#FFFFFF";
		}	
	// yellow
	}  else if ($translucence_options['linkcolor'] == '#FFCC33') {
	
		// 40% gray
		if ($translucence_options['textcolor'] == '#777777') {
			$translucence_options['linkcolor_visited'] = "#FFFFFF";
		// 30% gray
		} else if ($translucence_options['textcolor'] == '#888888') {
			$translucence_options['linkcolor_visited'] = "#FFFFFF";
		// 20% gray
		} else if ($translucence_options['textcolor'] == '#CCCCCC') {
			$translucence_options['linkcolor_visited'] = "#FFFFFF";
		// 10% gray	
		} else if ($translucence_options['textcolor'] == '#EEEEEE') {
			$translucence_options['linkcolor_visited'] = "#FFFFFF";
		} else {
			$translucence_options['linkcolor_visited'] = "#FFFFFF";
		}	
	
	// black
	}  else if ($translucence_options['linkcolor'] == '#222222') {	
		$translucence_options['linkcolor_visited'] = "#333333";	
	
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
		if ($translucence_options[$box.'-color'] == '#FFFFFF') {
			$translucence_options[$box.'-border-color'] = "#CCCCCC";
			$translucence_options[$box.'-heading-color'] = "#666666";
			$translucence_options[$box.'-link-color'] = $translucence_options['linkcolor'];
			$translucence_options[$box.'-text-color'] = $translucence_options['textcolor'];
			$translucence_options[$box.'-highlight-color'] = "#F9F9F9";
			if ($box == "top") $translucence_options[$box.'-color-hover03'] = "#E5E5E5";

		// gray blue
		} else if ($translucence_options[$box.'-color'] == '#364559') {
			$translucence_options[$box.'-border-color'] = "#666666";
			$translucence_options[$box.'-heading-color'] = "#CCCC99";
			$translucence_options[$box.'-link-color'] = "#EEEEEE";
			$translucence_options[$box.'-text-color'] = "#CCCCCC";
			$translucence_options[$box.'-highlight-color'] = "#364559";
			if ($box == "top") $translucence_options[$box.'-color-hover03'] = "#0B1B2F";
			
		// black
		} else if ($translucence_options[$box.'-color'] == '#000000' || $translucence_options[$box.'-color'] == '#262626') {
			$translucence_options[$box.'-border-color'] = "#666666";
			$translucence_options[$box.'-heading-color'] = "#FFFFFF";
			$translucence_options[$box.'-link-color'] = "#FFFFCC";
			$translucence_options[$box.'-text-color'] = "#CCCCCC";
			$translucence_options[$box.'-highlight-color'] = "#262626";
			if ($box == "top") $translucence_options[$box.'-color-hover03'] = "#333333";
			
		// green	
		} else if ($translucence_options[$box.'-color'] == '#4a6339') {
			$translucence_options[$box.'-border-color'] = "#666666";
			$translucence_options[$box.'-heading-color'] = "#FFFFFF";
			$translucence_options[$box.'-link-color'] = "#FFFFFF";
			$translucence_options[$box.'-text-color'] = "#EEEEEE";
			$translucence_options[$box.'-highlight-color'] = "#83A776";
			if ($box == "top") $translucence_options[$box.'-color-hover03'] = "#3A4A2D";
			
		// muted yellow
		}  else if ($translucence_options[$box.'-color'] == '#e9e9c9') {
			$translucence_options[$box.'-border-color'] = "#666666";
			$translucence_options[$box.'-heading-color'] = "#AAA448";
			$translucence_options[$box.'-link-color'] = $translucence_options['linkcolor'];
			$translucence_options[$box.'-text-color'] = $translucence_options['textcolor'];
			$translucence_options[$box.'-highlight-color'] = "#e9e9c9";
			if ($box == "top") $translucence_options[$box.'-color-hover03'] = "#CBCEB5";
			
		// light green
		}  else if ($translucence_options[$box.'-color'] == '#83A776') {
			$translucence_options[$box.'-border-color'] = "#585858";
			$translucence_options[$box.'-heading-color'] = "#c7c6a7";
			$translucence_options[$box.'-link-color'] = "#FFFFFF";
			$translucence_options[$box.'-link-color'] = "#EEEEEE";
			$translucence_options[$box.'-text-color'] = "#CCCCCC";
			$translucence_options[$box.'-highlight-color'] = "#4a6339";
			if ($box == "top") $translucence_options[$box.'-color-hover03'] = "#3A4A2D";
		
		// yellow
		}  else if ($translucence_options[$box.'-color'] == '#FFF8C6') {
			$translucence_options[$box.'-border-color'] = "#CCCCCC";
			$translucence_options[$box.'-heading-color'] = "#333333";
			$translucence_options[$box.'-link-color'] = $translucence_options['linkcolor'];
			$translucence_options[$box.'-text-color'] = $translucence_options['textcolor'];
			$translucence_options[$box.'-highlight-color'] = "#F9F9F9";
			if ($box == "top") $translucence_options[$box.'-color-hover03'] = "#ECECC3";
			
		// all other colors
		}  else {
			$translucence_options[$box.'-border-color'] = "#CCCCCC";
			$translucence_options[$box.'-heading-color'] = "#333333";
			$translucence_options[$box.'-link-color'] = $translucence_options['linkcolor'];
			$translucence_options[$box.'-text-color'] = $translucence_options['textcolor'];
			$translucence_options[$box.'-highlight-color'] = "#F9F9F9";
			if ($box == "top") $translucence_options[$box.'-color-hover03'] = "#E5E5E5";
			
		} 
		
		/******************************************************************************
		 * Box borders (derived from $box-border-style)
		 ******************************************************************************/
		$translucence_options['cat-links-border-style'] = "solid";
		$translucence_options['tag-links-border-style'] = "solid";
		
		// if border-style is none, then set to solid and set color to transparent
		if (isset($translucence_options[$box.'-border-style']) && $translucence_options[$box.'-border-style'] == "none") {
			
			if ($box == "header") {
				$translucence_options['headerblock-border-style'] = "solid";
				$translucence_options[$box.'-border-color'] = "transparent";
				$translucence_options[$box.'-border-left'] = "transparent";
				$translucence_options[$box.'-border-right'] = "transparent";
				$translucence_options[$box.'-border-top'] = "transparent";
				$translucence_options[$box.'-border-bottom'] = "transparent";
				$translucence_options['headerblock-hover-border-style'] = "solid";
			}
			
			$translucence_options[$box.'-hover-border-style'] = "none";
			if ($box == "top") {
				$translucence_options['top-border-left'] = "transparent";
				$translucence_options['top-border-right'] = "transparent";
			}
		} else {
			$translucence_options[$box.'-hover-border-style'] = "solid";
			if ($box == "header") {
				$translucence_options['headerblock-border-style'] = $translucence_options[$box.'-border-style'];
				$translucence_options['headerblock-hover-border-style'] = "solid";			
			}
		}
				
		/******************************************************************************
		 * Opacity Settings
		 * Only variations with dark background colors or images have 
		 * different colors for low opacity settings see: 
		 * variations/<<variation-name>>/variation.php
		 ******************************************************************************/
		$translucence_options['cat-links-opacity'] = .7;
		$translucence_options['tag-links-opacity'] = .7;
		
		// top bar child/sub-menu opacity never below transparent text and link color 
		if ($box == "top") {
			$translucence_options['top-child-link-color'] = $translucence_options['top-link-color'];
			$translucence_options['top-child-text-color'] = $translucence_options['top-text-color'];		
		}

		// convert hex color and opacity settings to rgba values
		$translucence_options[$box.'-color-rgb'] = "rgba(".translucence_hex2rgb($translucence_options[$box.'-color']).", ".$translucence_options[$box.'-opacity'].")";	
		$translucence_options[$box.'-highlight-color-rgb'] = "rgba(".translucence_hex2rgb($translucence_options[$box.'-highlight-color']).", ".($translucence_options[$box.'-opacity']+.1).")";	
		
		
		// text, link and highlight color adjustment for low opacity settings
		if ($translucence_options[$box.'-opacity'] < .7) {
			$translucence_options[$box.'-heading-color'] = $translucence_options['transparent-heading-color'];
			$translucence_options[$box.'-link-color'] = $translucence_options['transparent-link-color'];
			$translucence_options[$box.'-text-color'] = $translucence_options['transparent-text-color'];		
			
			if ($custom_background_image != "") {
				$translucence_options[$box.'-color-hover-rgb'] = "rgba(".translucence_hex2rgb($translucence_options[$box.'-color']).", ".($translucence_options[$box.'-opacity']-.2).")";
				$translucence_options[$box.'-highlight-hover-color-rgb'] = "rgba(".translucence_hex2rgb($translucence_options[$box.'-color']).", ".($translucence_options[$box.'-opacity']).")";
			} else {
				$translucence_options[$box.'-color-hover-rgb'] = "rgba(".translucence_hex2rgb($translucence_options[$box.'-color']).", ".($translucence_options[$box.'-opacity']+.2).")";
				$translucence_options[$box.'-highlight-hover-color-rgb'] = "rgba(".translucence_hex2rgb($translucence_options[$box.'-color']).", ".($translucence_options[$box.'-opacity']+.1).")";			
			}
			
		} else {
			$translucence_options[$box.'-color-hover-rgb'] = "rgba(".translucence_hex2rgb($translucence_options[$box.'-color']).", ".($translucence_options[$box.'-opacity']+.2).")";
			$translucence_options[$box.'-highlight-color-hover-rgb'] = "rgba(".translucence_hex2rgb($translucence_options[$box.'-highlight-color']).", ".($translucence_options[$box.'-opacity']+.1).")";					
		}
		
		// need to refine top bar opacity settings....
		if ($box == "top") {
			$translucence_options['top-color-hover02-rgba'] = "rgba(".translucence_hex2rgb($translucence_options['top-color']).", .97)";
			$translucence_options['top-color-hover02-rgb'] = "rgb(".translucence_hex2rgb($translucence_options['top-color']).")";
		}
		
		/******************************************************************************
		 * category and tag links use linkcolor as their hover border color
		 ******************************************************************************/
		if (isset($translucence_options['cat-links-link-color'])) {
			$translucence_options['cat-links-hover-border-top'] = $translucence_options['cat-links-link-color'];
			$translucence_options['cat-links-hover-border-bottom'] = $translucence_options['cat-links-link-color'];
			$translucence_options['cat-links-hover-border-left'] = $translucence_options['cat-links-link-color'];
			$translucence_options['cat-links-hover-border-right'] = $translucence_options['cat-links-link-color'];
		}
		
		if (isset($translucence_options['tag-links-link-color'])) {
			$translucence_options['tag-links-hover-border-top'] = $translucence_options['tag-links-link-color'];
			$translucence_options['tag-links-hover-border-bottom'] = $translucence_options['tag-links-link-color'];
			$translucence_options['tag-links-hover-border-left'] = $translucence_options['tag-links-link-color'];
			$translucence_options['tag-links-hover-border-right'] = $translucence_options['tag-links-link-color'];
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
		} else if ($box == "cat-links") {
			$area = ".catlinks a";		
		} else if ($box == "tag-links") {
			$area = ".taglinks a";		
		} else if ($box == "site") {
			$area = "#wrapper";	
		} else {
			$area = ".".$box;
		}
		
		/******************************************************************************
		 * Generate IE only CSS for opacity settings
		 ******************************************************************************/
		
	   $translucence_options[$box.'-color-ie'] = $area." {background-color:transparent;filter:".translucence_ie_opacity_css($translucence_options[$box.'-color'], $translucence_options[$box.'-opacity'])."}";

		// set the IE submenu-color opacity for top bar
		if ($box == "top") {
// 			$translucence_options['submenu-color-ie'] = "#access .sub-menu, #access .children";
// 			$translucence_options['submenu-color-ie'] .= "{".translucence_ie_opacity_css($translucence_options[$box.'-color'], 1)."}";
// 			$translucence_options['submenu-color-ie'] .= "#access .sub-menu li:hover > a,  #access .sub-menu ul ul:hover > a";
// 			$translucence_options['submenu-color-ie'] .= "{".translucence_ie_opacity_css($translucence_options[$box.'-color'], $translucence_options[$box.'-opacity'])."}";
// 			$translucence_options['submenu-color-ie'] .= "#access .children li:hover > a,  #access .children ul ul:hover > a";
// 			$translucence_options['submenu-color-ie'] .= "{".translucence_ie_opacity_css($translucence_options[$box.'-color'], $translucence_options[$box.'-opacity'])."}";					
		}
		
		if ($box == "description-box") {
			$translucence_options[$box.'-color-ie'] = "#site-description {background:transparent;filter:".translucence_ie_opacity_css($translucence_options[$box.'-color'], $translucence_options[$box.'-opacity'])."};";
			$translucence_options[$box.'-color-ie8'] = "background:transparent;filter:".translucence_ie_opacity_css($translucence_options[$box.'-color'], $translucence_options[$box.'-opacity']).";";
		} else if ($box == "title-box") {
			$translucence_options[$box.'-color-ie'] = "#site-title {background:transparent;filter:".translucence_ie_opacity_css($translucence_options[$box.'-color'], $translucence_options[$box.'-opacity']).";}";
			$translucence_options[$box.'-color-ie8'] = "background:transparent;filter:".translucence_ie_opacity_css($translucence_options[$box.'-color'], $translucence_options[$box.'-opacity']).";";
		}
		
		// visibility and padding of bars
		if (isset($translucence_options[$box.'-width']) && $translucence_options[$box.'-width'] == '0') {	
			$translucence_options[$box.'-visibility'] = "none";
			$translucence_options[$box.'-padding'] = "25";
		
		// if visible bar padding
		} else {
			$translucence_options[$box.'-visibility'] = "block";
			$translucence_options[$box.'-padding'] = "25";
		}
		
	}
	
	/******************************************************************************
	 * Calculates the overall width of the sidebars and the content container.
	 ******************************************************************************/

	$left01_width = 0;
	if ($translucence_options['left01-width'] > 0) {
		$left01_width = 2 + $translucence_options['left01-margin-right'] + $translucence_options['left01-width'] + ($translucence_options['left01-padding']*2);
	}

	$right01_width = 0;
	if ($translucence_options['right01-width'] != 0) {
		$right01_width = 2 + $translucence_options['right01-margin-right'] + $translucence_options['right01-width'] + ($translucence_options['right01-padding']*2);
	}

	$right02_width = 0;
	if ($translucence_options['right02-width'] != 0) {
		$right02_width = 2 + $translucence_options['right02-width'] + ($translucence_options['right02-padding']*2);
	}
	
	$content_width = $translucence_options['site-width'] - 2 - $translucence_options['content-margin-right'] - ($translucence_options['content-padding'] * 2) - $left01_width - $right01_width - $right02_width;
	
	$total = $translucence_options['site-width'];
	
	$translucence_options['content-width'] = $content_width;
	$translucence_options['overall-content-width'] = $translucence_options['site-width'] - $left01_width - $right01_width - $right02_width;
	$translucence_options['overall-left01-width'] = $left01_width;
	$translucence_options['overall-right01-width'] = $right01_width;
	$translucence_options['overall-right02-width'] = $right02_width;

	/******************************************************************************
	 * Display colophon with border only if footer-widget-area has no border
	 ******************************************************************************/

	if ($translucence_options['bottom-border-style'] == 'none') {
		$translucence_options['colophon-border-type'] = "dotted";
	} else {
		$translucence_options['colophon-border-type'] = "none";
	}
	
	/******************************************************************************
	 * Entry text line height
	 ******************************************************************************/
	$translucence_options['entry-line-height'] = $translucence_options['entry-text-size'] + round($translucence_options['entry-text-size']/2);
	
	/******************************************************************************
	 * Entry link style options
	 ******************************************************************************/

	$link_types = array('entry');
	
	foreach($link_types as $link_type) {
	
		if ($translucence_options[$link_type.'-link-style'] == "none") {
			$translucence_options[$link_type.'-link-border'] = "none";
			$translucence_options[$link_type.'-link-decoration'] = "none";
			$translucence_options[$link_type.'-link-hover-border'] = "solid";
			$translucence_options[$link_type.'-link-hover-background_color'] = $translucence_options['content-color'];
			$translucence_options[$link_type.'-link-hover-decoration'] = "underline";
			$translucence_options[$link_type.'-link-background'] = "transparent";
			$translucence_options[$link_type.'-link-color'] = $translucence_options['linkcolor'];
			
		} else if ($translucence_options[$link_type.'-link-style'] == "underline") {
			$translucence_options[$link_type.'-link-border'] = "dotted";
			$translucence_options[$link_type.'-link-decoration'] = "none";
			$translucence_options[$link_type.'-link-hover-border'] = "solid"; 
			$translucence_options[$link_type.'-link-hover-background_color'] = $translucence_options['content-color'];
			$translucence_options[$link_type.'-link-hover-decoration'] = "underline";
			$translucence_options[$link_type.'-link-background'] = "none";
			$translucence_options[$link_type.'-link-color'] = $translucence_options['linkcolor'];

		} else if ($translucence_options[$link_type.'-link-style'] == "ww") {
			$translucence_options[$link_type.'-link-border'] = "dotted ";
			$translucence_options[$link_type.'-link-hover-border'] = "solid";
			$translucence_options[$link_type.'-link-decoration'] = "none";
			$translucence_options[$link_type.'-link-hover-decoration'] = "none";
			$translucence_options[$link_type.'-link-color'] = $translucence_options['linkcolor'];
			if ($translucence_options['content-color'] == '#000000') {
				$translucence_options[$link_type.'-link-hover-background_color'] = "#262626";
			} else if ($translucence_options['content-color'] == '#262626') {
				$translucence_options[$link_type.'-link-hover-background_color'] = "#000000";
			} else {
				$translucence_options[$link_type.'-link-hover-background_color'] = "#efc";
			}
		} 
	}	

	/******************************************************************************
	 * Sidebar display options
	 * Options for which sidebars to display on various pages
	 ******************************************************************************/
	$pages = array('post', 'category', 'tag', 'author', 'search', 'archives');

	foreach($pages as $page) {
		if ($translucence_options[$page.'-single-sidebar'] == 'right01') {
			$translucence_options[$page.'-sidebar-left-display'] = "hide";
			$translucence_options[$page.'-sidebar-right-display'] = "show";
			$translucence_options[$page.'-sidebar-right02-display'] = "hide";
			
		} else if ($translucence_options[$page.'-single-sidebar'] == 'left01') {
			$translucence_options[$page.'-sidebar-left-display'] = "show";
			$translucence_options[$page.'-sidebar-right-display'] = "hide";
			$translucence_options[$page.'-sidebar-right02-display'] = "hide";
	
		} else if ($translucence_options[$page.'-single-sidebar'] == 'right02') {
			$translucence_options[$page.'-sidebar-left-display'] = "hide";
			$translucence_options[$page.'-sidebar-right-display'] = "hide";
			$translucence_options[$page.'-sidebar-right02-display'] = "show";
			
		} else if ($translucence_options[$page.'-single-sidebar'] == 'left01right01') {
			$translucence_options[$page.'-sidebar-left-display'] = "show";
			$translucence_options[$page.'-sidebar-right-display'] = "show";
			$translucence_options[$page.'-sidebar-right02-display'] = "hide";
	
		} else if ($translucence_options[$page.'-single-sidebar'] == 'left01right02') {
			$translucence_options[$page.'-sidebar-left-display'] = "show";
			$translucence_options[$page.'-sidebar-right-display'] = "hide";
			$translucence_options[$page.'-sidebar-right02-display'] = "show";
			
		} else if ($translucence_options[$page.'-single-sidebar'] == 'right01right02') {
			$translucence_options[$page.'-sidebar-left-display'] = "hide";
			$translucence_options[$page.'-sidebar-right-display'] = "show";
			$translucence_options[$page.'-sidebar-right02-display'] = "show";
			
		} else if ($translucence_options[$page.'-single-sidebar'] == 'none') {
			$translucence_options[$page.'-sidebar-left-display'] = "hide";
			$translucence_options[$page.'-sidebar-right-display'] = "hide";
			$translucence_options[$page.'-sidebar-right02-display'] = "hide";
		}	
	}
	
			
	$translucence_options['page-image-width'] = $translucence_options['site-width']-50;

}

 /**
 * Provide feedback to user about theme option choses
 *
 * @since 2010 Translucence 1.0
 */

function translucence_option_feedback() {
	global $translucence_options, $translucence_config;
	
	$main_column_width = $translucence_options['site-width'] - ($translucence_options['left01-width'] + $translucence_options['right01-width'] + 174);
	$message = "<strong>".__( 'Your changes have been saved', '2010-translucence' )."</strong>";
	$error = "false";
	
	
	if ($translucence_options['revert'] == 1) {
		$message = __( 'These are the default settings for the ', '2010-translucence' ).$translucence_config['theme-name']." ".__( 'theme', '2010-translucence' );
		$error = "true";

	} else if (isset($_POST['reset'])) {
		$message .= " <br/><br/>".$translucence_options['theme-name'].__( 'theme options have been reverted to their default settings', '2010-translucence' );
		$error = "true";

	} else {
				
		if (is_active_sidebar("tertiary-widget-area") && $translucence_options['left01-width'] == 0) {
			$message .= " <br/>".__( 'Your left sidebar is hidden but contains widgets.', '2010-translucence' );
			$error = "true";
		}

		if (is_active_sidebar("primary-widget-area") && $translucence_options['right01-width'] == 0) {
			$message .= " <br/>".__( 'Your right sidebar is hidden but contains widgets.', '2010-translucence' );
			$error = "true";
		}

		if (is_active_sidebar("secondary-widget-area") && $translucence_options['right02-width'] == 0) {
			$message .= " <br/>".__( 'Your 2nd right sidebar is hidden but contains widgets.', '2010-translucence' );
			$error = "true";
		}
				
		if ($translucence_options['left01-width'] == "125") {
			$message .= " <br/>".__( 'Your left sidebar is only 125px.  This may be too narrow for some widgets (e.g. calendar widget)', '2010-translucence' );
			$error = "true";
		} 

		if ($translucence_options['right01-width'] == "125") {
			$message .= " <br/>".__( 'Your right sidebar is only 125px.  This may be too narrow for some widgets (e.g. calendar widget)', '2010-translucence' );
			$error = "true";
		} 

		if ($translucence_options['right02-width'] == "125") {
			$message .= " <br/>".__( 'Your 2nd right sidebar is only 125px.  This may be too narrow for some widgets (e.g. calendar widget)', '2010-translucence' );
			$error = "true";
		} 		
			
		$pages = array('post', 'category', 'tag', 'author', 'search');
		
		foreach($pages as $page) {
		
			if ($translucence_options[$page.'-sidebar-right-display'] == "show" && $translucence_options['right01-width'] == 0) {
				$message .= " <br/>".__( 'You wanted to show your right sidebar on ', '2010-translucence' ).$page.__( ' pages but you have hidden it...', '2010-translucence' );
				$message .= " <br/>You wanted to show your right sidebar on ".$page." pages but you have hidden it...";
				$error = "true";
			} 
	
			if ($translucence_options[$page.'-sidebar-right02-display'] == "show" && $translucence_options['right02-width'] == 0) {
				$message .= " <br/>".__( 'You wanted to show your 2ND right sidebar on ', '2010-translucence' ).$page.__( ' pages but you have hidden it...', '2010-translucence' );
				$error = "true";
			} 
		
			if ($translucence_options[$page.'-sidebar-left-display'] == "show" && $translucence_options['left01-visibility'] == "hidden") {
				$message .= " <br/>".__( 'You wanted to show your left sidebar on ', '2010-translucence' ).$page.__( ' pages but you have hidden it...', '2010-translucence' );
				$error = "true";
			} 			
		}
		
		if ($error == "false") {
			$message .= " <br/>".__( 'Visit Site', '2010-translucence' );
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

 /**
 * Delete theme options and initializes theme options array
 *
 * @since 2010 Translucence 1.0
 */

function translucence_delete_options() {
    global $translucence_options, $translucence_options_id;
	
	$translucence_options = array();
	
	delete_option($translucence_options_id); 	
	
	add_option($translucence_options_id, array('init' => 1));  	

}

 /**
 * Converts Hex to RGB for setting transparency using RGBa
 *
 * @since 2010 Translucence 1.0
 * @return string rgba color
 */
 
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

 /**
 * Generates IE proprietary CSS for opacity
 *
 * @uses translucence_hex2rgb() to translate hex colors to rgb
 *
 * @since 2010 Translucence 1.0
 * @return string IE proprietary CSS for opacity
 */

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
	
	$out = "progid:DXImageTransform.Microsoft.gradient(startColorstr=";
	$out .= $hex_rgba;
	$out .= ",endColorstr=";
	$out .= $hex_rgba;
	$out .= ");zoom: 1";
	return $out;
}