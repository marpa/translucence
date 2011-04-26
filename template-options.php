<?php 

/*********************************************************
 * Theme options
 * renders UI and theme model for chosing and previewing options
 *********************************************************/

function translucence_theme_options_do_page() {
	global $translucence_config, $translucence_options_id, $translucence_options, $translucence_options_values, $translucence_variations, $translucence_header_image;
    global $translucence_custom_header_set, $translucence_custom_background_set, $translucence_custom_header_image, $translucence_model_site_width;
    global $translucence_syndication_image;

	if ($translucence_options['revert'] == 1) {
		translucence_option_feedback();
		translucence_delete_options();		
		$translucence_options['revert'] = 0;
		translucence_theme_options_update(); 
	}

	translucence_option_feedback();
	$translucence_options = get_option($translucence_options_id);
	    
    $current_widgets = get_option ('sidebars_widgets');	
    
    $custom_background_color = get_background_color();
	$custom_background_image = get_background_image();    
    $translucence_custom_header_image = get_header_image();
    
	if (isset($translucence_custom_header_image) && $translucence_custom_header_image != "") {
   		$translucence_custom_header_set = 1;
	} else {
		$translucence_custom_header_set = 0;
	}
	
	if ($translucence_custom_header_set == 0 && $translucence_options['header-image-options'] != "none") {
		$translucence_header_image = $translucence_config['custom_header'][$translucence_options['header-image-options']]['url'];
		$custom_header = str_replace('%s', '', $translucence_header_image);
		$translucence_custom_header_image = get_template_directory_uri().$custom_header;
		$translucence_custom_header_set = 1;
	}

 	if ($custom_background_image) {
 		$translucence_options['background_image'] = "url('".$custom_background_image."')";
 		$translucence_options['background_repeat'] = get_theme_mod( 'background_repeat', 'repeat' );
 		$translucence_options['background_attachment'] = get_theme_mod( 'background_attachment', 'scroll' );
 		$translucence_options['background_position'] = get_theme_mod( 'background_position_x', 'left' );
 		$translucence_custom_background_set = 1;
 	} else if ($custom_background_color) {
 		$translucence_custom_background_set = 1;
 	} else {
 		$translucence_custom_background_set = 0;
 	}
 
	/*********************************************************
	 * Define theme layout model values
	 *********************************************************/
	
	$translucence_model_site_width = $translucence_options['site-width']+80;
	
	$model_right_sidebar_width = $translucence_options['right01-width']+50;
    $model_right_sidebar_width02 = $translucence_options['right02-width']+50;
    $model_left_sidebar_width = $translucence_options['left01-width']+50;	
	
	$model_content_width = $translucence_options['site-width'] - ($translucence_options['left01-width'] + $translucence_options['right01-width'] + $translucence_options['right02-width'] + 220);
	

	/*********************************************************
	 * Define theme model css
	 * model css uses most of the actual theme's css except
	 * theme body css 
	 * model css adds css for theme edit UI components
	 *********************************************************/
	 
 	$model_css = preg_replace("/body/", ".body_na", $translucence_options['css']); 
	$translucence_syndication_image = get_template_directory_uri()."/variations/feed.png";
 	print "
 	<script type='text/javascript' src='".get_template_directory_uri()."/jscolor/jscolor.js'></script>
 	<style type='text/css'>";
 	print $model_css;
 	print translucence_get_theme_model_css();

	
	/******************************************************************************
	 * Theme Options Introduction with Update and Revert buttons
	 ******************************************************************************/
			
	?>	    
		<form id='settings' action='options.php' method='post' class='themeform' style='margin: 20px;'>
		<?php settings_fields( $translucence_options_id ); ?>
		<?php $translucence_options = get_option($translucence_options_id); ?>
	
		<table width = '<?php print $translucence_model_site_width; ?>' cellpadding='0' style='background-color: transparent;'>
		<tr>
			<td width='20%'>
			<span class='submit'><input type='submit' value='<?php _e( 'Update', '2010-translucence' ); ?>' name='save'/></span>
			<span class='submit'><input type='submit' value='<?php _e( 'Revert to Default', '2010-translucence' ); ?>' name='<?php echo $translucence_options_id ?>[reset]'/></span>

			</td>
			<td width='60%' align='left'>
			</td>
			<td width='20%'>
			</td>
		</tr>
		</table>
	
	<?php
	
	/******************************************************************************
	 * html from theme template files (header.php, index.php, footer.php and sidebars
	 * embedded in this html are functions for printing theme options UI
	 ******************************************************************************/
	?>
		<div class='modelwrapper' style='margin-bottom: 5px;'>	
		<?php print translucence_get_global_options(); ?>
		</div>
		<div class='modelwrapper'>						
			<div class='sitewrapper'> 	
				<div class='headermeta_right'> 
					<div class='bgtextcolor'><?php print translucence_headermeta_right(); ?></div>
				</div> 
				<div class='headermeta_left'> 
					<div class='bgtextcolor'><?php print translucence_headermeta_left(); ?></div> 
				</div> 
				<?php print translucence_get_custom_options(); ?>
			</div> 
			<div id='wrapper'>
				<div id='header'>
					<div id='masthead'>
						<div id='branding'>
							<div class='headerblock'>
								<h1 id='site-title'>								
									<span class='title-box'><a href='index.php'><?php print get_bloginfo('name') ?></a></span>
								</h1>
								<div id='site-description' class='description-box'><?php print get_bloginfo('description') ?></div>
							</div>							
						</div><!-- #branding -->
						<div id='access' role='navigation'> 
							<!-- top navigation links -->
							<div class='menu-header'>
							<?php print translucence_get_topmenu_options(); ?>
							</div>
						</div><!-- #access -->
					</div><!-- #masthead -->
				</div><!-- #header -->
				<div id='main' style="clear: both;">
					<div id='container'>
						<div id='tertiary' class='widget-area'>
							<!-- left sidebar -->
							<h3 class='widget-title'><?php _e( 'Left Sidebar', '2010-translucence' ); ?></h3>
							<?php print translucence_get_left01_options(); ?>
						</div>
						<div id='content'>
							<!-- syndication links -->
							<div style = 'width: 100%; float: right;'> 
								<div id='syndication'> 
									<a href='#' class='feed'><?php _e( 'Posts RSS', '2010-translucence' ); ?></a> 
									<a href='#' class='feed'><?php _e( 'Comments RSS', '2010-translucence' ); ?></a> 
								</div> 
							</div> 
							<!-- main content -->
							<?php print translucence_get_layout_options(); ?>
							<h2 class='entry-title'><?php _e( 'Entry Title', '2010-translucence' ); ?></h2>
							<div class='entry-content'>
								<?php print translucence_get_post_options(); ?>	
							</div>
						</div>
						<div id='primary' class='widget-area'>
							<!-- 1st right sidebar -->
							<h3 class='widget-title'><?php _e( '1st Right Sidebar', '2010-translucence' ); ?></h3>
							<?php print translucence_get_right01_options(); ?>
						</div>
						<div id='secondary' class='widget-area' style=''>
							<!-- 2nd right sidebar -->
							<h3 class='widget-title'><?php _e( '2nd Right Sidebar', '2010-translucence' ); ?></h3>
							<?php print translucence_get_right02_options(); ?>
						</div>
					</div><!-- #container -->
				</div><!-- #main -->
					<br/>
					<div id='colophon'></div><!-- #colophon --> 
					<div id='footer-widget-area'>
					<?php print translucence_get_footer_options(); ?>
					<!-- footer -->
						<div id='first' class='widget-area'>
							<ul class='xoxo'>
								<h3 class='widget-title'><?php _e( 'First Footer Widget Area', '2010-translucence' ); ?></h3>
								<?php print translucence_get_footer_widgets('first'); ?>
							</ul>
						</div>
						<div id='second' class='widget-area'>
							<ul class='xoxo'>
								<h3 class='widget-title'><?php _e( 'Second Footer Widget Area', '2010-translucence' ); ?></h3>
								<?php print translucence_get_footer_widgets('second'); ?>
							</ul>
						</div>
						<div id='third' class='widget-area'>
							<ul class='xoxo'>
								<h3 class='widget-title'><?php _e( 'Third Footer Widget Area', '2010-translucence' ); ?></h3>
								<?php print translucence_get_footer_widgets('third'); ?>
							</ul>
						</div>
						<div id='fourth' class='widget-area'>
							<ul class='xoxo'>
								<h3 class='widget-title'><?php _e( 'Fourth Footer Widget Area', '2010-translucence' ); ?></h3>
								<?php print translucence_get_footer_widgets('fourth'); ?>
							</ul>
						</div>
					</div>
			</div><!-- #wrapper -->
				
			<div class='sitewrapper'>  
				<div class='footermeta_right'> 
					<div class='bgtextcolor'><?php print translucence_footermeta_right(); ?></div> 
				</div> 	 
				<div class='footermeta_left'> 
					<div class='bgtextcolor'><?php print translucence_footermeta_left(); ?></div> 
				</div> 	
			</div><!-- #sitewrapper --> 
		</div><!-- modelwrapper -->
		<div class='modelwrapper' style='margin-top: 5px;'>	
		<?php print translucence_get_footermeta_options(); ?>
		</div>
				
		
	<?php
	/******************************************************************************
	 * Update and Revert button
	 ******************************************************************************/
	?>
	<span class='submit'><input type='submit' value='<?php _e( 'Update', '2010-translucence' ); ?>' name='save'/></span>
	<span class='submit'><input type='submit' value='<?php _e( 'Revert to Default', '2010-translucence' ); ?>' name='<?php echo $translucence_options_id ?>[reset]'/></span>
	
	</form>	
	<?php
}


/******************************************************************************
 * Theme model css
 ******************************************************************************/
function translucence_get_theme_model_css() {
	global $translucence_config, $translucence_variations;
    global $translucence_options_id, $translucence_options, $translucence_options_values;
    global $translucence_custom_header_image, $translucence_model_site_width, $translucence_syndication_image;

	ob_start();

 	print "
 		.modelwrapper {
			background-image: ".$translucence_options['background_image'].";
			background-position: ".$translucence_options['background_position'].";
			background-color: ".$translucence_options['background_color'].";
			background-repeat: ".$translucence_options['background_repeat'].";
			background-attachment: ".$translucence_options['background_attachment'].";
 			width: ".$translucence_model_site_width."px;
			background-color: ".$translucence_options['background_color'].";
			color: #000000;
			padding: 1px 0px 0px 0px;
			border: 1px solid #CCCCCC;
		}
		
		#wphead h1 a {
			text-decoration: none;
			border-bottom: none;
		}

		.headerblock {
			background-image: url(".$translucence_custom_header_image.");
			background-position: right center;
			background-repeat: no-repeat;
		}
		
		.headerblock #site-description {
			font-family: 'Helvetica Neue', Arial, Helvetica, 'Nimbus Sans L', sans-serif;
			float: left;
			clear: left;
		}
		
		#branding #site-title {
			font-family: 'Helvetica Neue', Arial, Helvetica, 'Nimbus Sans L', sans-serif;
			float: left;
		}
		
		#site-heading {
			border-bottom: none;
		}
				
		.headerblock h1 {
			display: inline;
			margin: 0px;
		}
				
		.options {
			margin-top: 5px;
			margin-bottom: 5px;
			margin-right: 5px;
			margin-left: 5px;
			background-color: #fff;
			font-size: 10px;
			line-height: 1.5em;
			padding: 10px;
			border: 1px dotted #CCCCCC;
		}
		
		.option-group {
			color: #333333;
		}
		
		.option-label {
			color: #333333;
		}

		.option-label:hover {
			color: #333333;
		}

		.option-label-dimmed {
			color: #CCCCCC;
		}

		.option-label-dimmed:hover {
			color: #333333;
		}
		
		.option-row {
			width: 100%;
			color: #CCCCCC;
			background-color: #fff;
			border-bottom: 1px dotted; 
			padding: 2px;
		}
		
		.option-row:hover {
			background-color: #F8F8F8;
			color: #000000;
		}
		
		.instructions {
			margin-top: 5px;
			margin-bottom: 5px;
			margin-right: 0px;
			margin-left: 0px;
			background-color: #fffeeb;
			color: #000000;
			font-size: 10px;
			line-height: 1.5em;
			padding: 5px;
			border: 1px solid #CCCCCC;
		}
		
		
		#syndication{
			width: 100%; 
			text-align: right;
			font-size: 11px;
			padding: 0px 0 10px 0;
			white-space:nowrap;
		}
		
		#syndication a.feed {
			padding: 5px 2px 0px 23px;
			background: url(".$translucence_syndication_image.") no-repeat 0 1px;
			border-bottom: none;
		}	
		
		.widgetbox {
			font-size: 10px;
			border-width: 1px;
			border-style: solid;
			padding: 5px;
			margin: 3px;
		}

		#appgroupedit textarea {
			width: 300px;
		}

 		.metatext {
 			font-size: 9px; 
 			color: ".$translucence_options['bglinkcolor'].";

 		}
 		
 		.metatext a {
 			color: ".$translucence_options['bglinkcolor'].";
 		}

		.horizontalbar {
			padding-top: 4px;
			padding-bottom: 4px;
			margin-bottom: 4px;
			text-align: right;
		}
		
		#primary a, 
		#secondary a,
		#tertiary a {
			border: 1px dotted;
		}
		
		#primary post-link {
			border-color: ".$translucence_options['right01-link-color'].";
			margin-right: 5px;
			margin-left: 5px;
		}

		.post-link {
			border-color: ".$translucence_options['bgtextcolor'].";
			margin-right: 5px;
			margin-left: 5px;
		}
		
 		.editwidgetlink {
			display: block;
 			color: ".$translucence_options['linkcolor'].";
 			
 		}
 		
 		.editwidgetlink a {
			display: block;
 			color: ".$translucence_options['linkcolor'].";
			border: 1px dotted;
 			padding: 3px;
 			margin-bottom: 3px;
		} 		
 		
 		.editwidgetlink a:hover {
			 border: 1px solid;
			 text-decoration: none;
		}

 		.editheaderlink {
 			color: ".$translucence_options['bglinkcolor'].";
 			font-size: 9px;
 			white-space:nowrap; 			
 		}
 		
		.editheaderlink a {
 			color: ".$translucence_options['bglinkcolor'].";
 			padding: 3px;
 			border: 1px dotted ".$translucence_options['bglinkcolor'].";
		}

 		.editheaderlink a:hover {
			 border: 1px solid ".$translucence_options['bglinkcolor'].";
			 text-decoration: none;
			 color: ".$translucence_options['bglinkcolor'].";
		}
		
		.modelheadertextposition {
			font-size: 20px; 
			margin-left: 5px;
			padding-top: ".$translucence_options['header-text-padding-top']."px;
			color: ".$translucence_options['site-title-color'].";
		}


		".$translucence_options['header-color-ie']."
		".$translucence_options['top-color-ie']."
		".$translucence_options['content-color-ie']." 
		".$translucence_options['bottom-color-ie']."
		".$translucence_options['left01-color-ie']."
		".$translucence_options['right01-color-ie']."
		".$translucence_options['right02-color-ie']."		
		</style>	
	";

	$translucence_theme_model_css = ob_get_contents();
	ob_end_clean();

	return $translucence_theme_model_css;

}

function translucence_headermeta_left() {
	global $translucence_config, $translucence_options, $translucence_options_id;
	
	ob_start();
	print "<div class='metatext'>";
	
	if ($translucence_options['headerleft'] == "") {
		print "no links defined...";				
	} else {
		print $translucence_options['headerleft'];
	}
			
	// if header left links selection is custom
	if ($translucence_options['header-meta-left'] == 'custom') {
		print "
			<input id='appgroupdo' type='hidden' name='appgroupdo' value='0'/> - 			
			<a href='javascript: document.getElementById(\"appgroupedit\").style.display = \"block\"; document.getElementById(\"appgroupdo\").value = \"1\"; exit; '>edit</a>					
			<div id='appgroupedit' style='display: none;'>					
			<textarea name='".$translucence_options_id."[headerleftcustom].' style='width: 100%; height: 50px; font-size: 10px;' class='code'>";
			print stripslashes(stripslashes(trim($translucence_options['headerleftcustom'])));
			print "</textarea>		
			&nbsp;&nbsp;&nbsp;
			<a href='javascript: document.getElementById(\"appgroupedit\").style.display = \"none\"; document.getElementById(\"appgroupdo\").value = \"0\"; exit;'>Cancel</a> - 
			<span class='submit'><input type='submit' value='Update' name='save'/></span>
			</div>
		";
	}
	print "</div>";
	$headermeta_left = ob_get_contents();
	ob_end_clean();
	return $headermeta_left;
}


function translucence_headermeta_right() {
	global $translucence_config, $translucence_options;
	
	ob_start();
	print "<span class='metatext'>";
	print $translucence_options['headerright'];
	
	// Log in link options
	if ($translucence_options['headermeta'] == "on") {
		print __( 'Menus | Widgets | Options', '2010-translucence' );
		print " | ".wp_get_current_user()->display_name;
		//print " - Log out";
	}
	
	print "</span>";
	$headermeta_right = ob_get_contents();
	ob_end_clean();
	return $headermeta_right;
}

function translucence_get_global_options() {
	global $translucence_config, $translucence_options, $translucence_options_values, $translucence_variations;
    global $translucence_options_id;	
    global $translucence_custom_header_set, $translucence_custom_background_set, $active_options;
       
	ob_start();
	print "<div class='options'>";
	print "<table style='width: 100%;'>";
	print "<tr>";
	
	// Variation options	
	print "<td style='width: 70%; text-align: left; border-bottom: 1px solid; padding-bottom: 5px; '>";			
	if (in_array("background", $translucence_config['model'])) {				
		print "<div>";
		print "<select name='".$translucence_options_id."[background]' style='font-size: 14px;' onchange='this.form.submit();'>";			
			// variations defined in variations folder
			foreach ($translucence_variations as $label => $value) {
				if (!in_array($value, $translucence_config['variations_disabled']))
					print "\n<option value='".$value."'".($translucence_options['background'] == $value ? ' selected' : '') . ">".$label."</option>";
			}	
		print "</select>";
		print "</div>";
		
		if ($translucence_custom_background_set == 1) {
			print "<div style='font-size: 10px; text-align: left; border-color: ".$translucence_options['bgtextcolor']."'>";
			print "(Custom background color or image may change the background of this variation)";	
			print "</div>";
		}
	}					
	print "</td>";	
	
	// options mode values (used in translucence_get_active_options)
	$translucence_options_values['mode'] = translucence_get_option_modes();
	
	print "<td style='width: 30%; text-align: right; border-bottom: 1px solid; padding-bottom: 5px;'>"; 
	print __( 'Options Mode', '2010-translucence' ).":<span class='option-label'>";

	translucence_get_option_selector ("", "options-mode", $translucence_options_values['mode'], 'active');
	print "</span>";
	
	print "</td>";	
	print "</tr>";	
	print "</table>";
	
	// global options for: site, header, site title, tagline and header meta
	print "<table style='width: 100%;'>";
	print "<tr>";
	
	// get active options
	if (in_array('options-mode', $translucence_config['model'])) {
		$active_options = translucence_get_active_options($translucence_options['options-mode']);
	}

	// site width, color, opacity and border options
	if (in_array('site-options', $active_options)) {
		print "<td class='option-row'>";
			//site width
			print "<span class='option-label'>".__( 'Site', '2010-translucence' )."</span>";
			$translucence_title = __( 'width', '2010-translucence' );
			translucence_get_option_selector ($translucence_title, "site-width", $translucence_options_values['site-width']);
			// site color
			$translucence_title = __( 'color', '2010-translucence' );
			translucence_get_option_selector ($translucence_title, "site-color", $translucence_options_values['sidebar-color']);
			// site opacity
			$translucence_title = __( 'opacity', '2010-translucence' );
			translucence_get_option_selector ($translucence_title, "site-opacity", $translucence_options_values['header-opacity']);
			// site border
			$translucence_title = __( 'border', '2010-translucence' );
			translucence_get_option_selector ($translucence_title, "site-border-style", $translucence_options_values['border-style']);
		print "</td>";
		print "</tr>";
	// if not in active_options print out as hidden fields
	} else {
		translucence_get_option_selector ("", "site-width", $translucence_options_values['site-width'])."<br/>";
		translucence_get_option_selector ("", "site-color", $translucence_options_values['sidebar-color'])."<br/>";
		translucence_get_option_selector ("", "site-opacity", $translucence_options_values['header-opacity'])."<br/>";
		translucence_get_option_selector ("", "site-border-style", $translucence_options_values['border-style'])."<br/>";
	}
	
	// header height, color, opacity, border options
	if (in_array('header-options', $active_options)) {
		print "<tr>";
		print "<td class='option-row'>";		
			// header height options
			print "<span class='option-label'>".__( 'Header', '2010-translucence' )."</span>";
			$translucence_title = __( 'height', '2010-translucence' );
			translucence_get_option_selector ($translucence_title, "header-block-height", $translucence_options_values['header-block-height']);
			// header color
			$translucence_title = __( 'color', '2010-translucence' );
			translucence_get_option_selector ($translucence_title, "header-color", $translucence_options_values['header-color']);
			// header opacity
			$translucence_title = __( 'opacity', '2010-translucence' );
			translucence_get_option_selector ($translucence_title, "header-opacity", $translucence_options_values['header-opacity']);
			// header border
			$translucence_title = __( 'border', '2010-translucence' );
			translucence_get_option_selector ($translucence_title, "header-border-style", $translucence_options_values['border-style']);
		print "</td>";	
		print "</tr>";
	// if not in active_options print out as hidden fields
	} else {
			translucence_get_option_selector ("", "header-block-height", $translucence_options_values['header-block-height']);
			translucence_get_option_selector ("", "header-color", $translucence_options_values['header-color']);
			translucence_get_option_selector ("", "header-opacity", $translucence_options_values['header-opacity']);
			translucence_get_option_selector ("", "header-border-style", $translucence_options_values['border-style']);	
	}
	
	// header text size color shadow, box and position
	if (in_array('site-title-options', $active_options) || $translucence_custom_header_set == 1) {
		print "<tr>";
		print "<td class='option-row'>";	
		
		if (in_array('site-title-options', $active_options)) {
		
			// header-text-size options		
			if (in_array("site-title-size", $translucence_config['model'])) {	
				print "<span class='option-label'>".__( 'Site Title', '2010-translucence' )." </span>";
				$translucence_title = __( 'size', '2010-translucence' );
				translucence_get_option_selector ($translucence_title, "site-title-size", $translucence_options_values['header-text-size']);
			}
			// header-text-color options
			if (in_array("site-title-color", $translucence_config['model'])) {	
				$translucence_title = __( 'color', '2010-translucence' );
				translucence_get_option_field ($translucence_title, "site-title-color", 6);
			}
			// header-text-offset options		
			if (in_array("header-text-shadow-offset", $translucence_config['model'])) {
				$translucence_title = __( 'offset', '2010-translucence' );
				translucence_get_option_selector ($translucence_title, "header-text-shadow-offset", $translucence_options_values['text-shadow-offset']);
			}	
			// header-text-blur options		
			if (in_array("header-text-shadow-blur", $translucence_config['model'])) {	
				$translucence_title = __( 'blur', '2010-translucence' );
				translucence_get_option_selector ($translucence_title, "header-text-shadow-blur", $translucence_options_values['text-shadow-blur']);
			}
		}		
		
		if (in_array('site-title-box-options', $active_options) || $translucence_custom_header_set == 1) {
		
			// header-text-box options		
			if (in_array("title-box-color", $translucence_config['model'])) {	
				print "<span class='option-label'> ".__( 'Site Title Box', '2010-translucence' )."</span>";
				$translucence_title = __( 'color', '2010-translucence' );
				translucence_get_option_selector ($translucence_title, "title-box-color", $translucence_options_values['header-color']);
			}
			if (in_array("title-box-opacity", $translucence_config['model'])) {
				$translucence_title = __( 'opacity', '2010-translucence' );
				translucence_get_option_selector ($translucence_title, "title-box-opacity", $translucence_options_values['header-opacity']);
			}
			// header-text-display options		
			if (in_array("header-text-display", $translucence_config['model'])) {	
				print "
				<span class='option-label' <span style='font-size: 10px;'>".__( 'position', '2010-translucence' )." 
				<select name='".$translucence_options_id."[header-text-display]' class='option-label-dimmed' style='font-size: 10px;' onchange='this.form.submit();'>
					<option value='middle' ".($translucence_options['header-text-display'] == 'middle' ? ' selected' : '') . ">".__( 'Middle', '2010-translucence' )."</option>
					<option value='top' ".($translucence_options['header-text-display'] == 'top' ? ' selected' : '') . ">".__( 'Top', '2010-translucence' )."</option>
					<option value='bottom' ".($translucence_options['header-text-display'] == 'bottom' ? ' selected' : '') . ">".__( 'Bottom', '2010-translucence' )."</option>
					<option value='hide' ".($translucence_options['header-text-display'] == 'hide' ? ' selected' : '') . ">".__( 'hide', '2010-translucence' )."</option>
				</select>
				</span></span>";
			}
		}
	
		print "</td>";	
		print "</tr>";
		
	// if not in active_options print out as hidden fields
	} else {
		translucence_get_option_selector ("size: ", "site-title-size", $translucence_options_values['header-text-size']);
		translucence_get_option_field ("Color: #", "site-title-color", 6);
		translucence_get_option_selector ("offset: ", "header-text-shadow-offset", $translucence_options_values['text-shadow-offset']);
		translucence_get_option_selector ("blur: ", "header-text-shadow-blur", $translucence_options_values['text-shadow-blur']);			
		translucence_get_option_selector ("color: ", "title-box-color", $translucence_options_values['header-color']);
		translucence_get_option_selector ("opacity:", "title-box-opacity", $translucence_options_values['header-opacity']);
		print "<input type='hidden' name='".$translucence_options_id."[header-text-display]' value = '".$translucence_options['header-text-display']."'/>";
	}
	
	// Tagline text size, color, box
	if (in_array('tagline-options', $active_options) || $translucence_custom_header_set == 1) {
		print "<tr>";
		print "<td class='option-row'>";
		
		// text size and color
		if (in_array('site-description-size', $active_options)) {
			// header-description-size options		
			if (in_array("site-description-size", $translucence_config['model'])) {	
				print "<span class='option-label'>".__( 'Tagline', '2010-translucence' )."</span><span class='option-label'>";
				$translucence_title = __( 'size', '2010-translucence' );
				translucence_get_option_selector ("size: ", "site-description-size", $translucence_options_values['header-text-size']);
				print "</span>";
			}
		// if not in active_options print out as hidden fields	
		} else {
			translucence_get_option_selector ("size: ", "site-description-size", $translucence_options_values['header-text-size']);
		}
		if (in_array('site-description-color', $active_options)) {
			// header-description-color options		
			if (in_array("site-description-color", $translucence_config['model'])) {
				print "<span class='option-label'>";
				$translucence_title = __( 'color', '2010-translucence' );
				translucence_get_option_field ($translucence_title, "site-description-color", 6);
				print "</span>";
			}
		// if not in active_options print out as hidden fields
		} else {			
			translucence_get_option_field ("color: #", "site-description-color", 6);
		}
		
		if (in_array('description-box-color', $active_options) || $translucence_custom_header_set == 1) {
	
			if (in_array("description-box-color", $translucence_config['model'])) {	
				print "<span class='option-label'> ".__( 'Tagline box', '2010-translucence' )."</span><span class='option-label'>";
				$translucence_title = __( 'color', '2010-translucence' );
				translucence_get_option_selector ($translucence_title, "description-box-color", $translucence_options_values['header-color']);
				print "</span>";
			}
	
			if (in_array("description-box-opacity", $translucence_config['model'])) {	
				print "<span class='option-label'>";
				$translucence_title = __( 'opacity', '2010-translucence' );
				translucence_get_option_selector ($translucence_title, "description-box-opacity", $translucence_options_values['header-opacity']);
				print "</span>";
			}
		// if not in active_options print out as hidden fields
		} else {
			translucence_get_option_selector ("color:", "description-box-color", $translucence_options_values['header-color']);
			translucence_get_option_selector ("opacity:", "description-box-opacity", $translucence_options_values['header-opacity']);
		}
		
		print "</td>";	
		print "</tr>";
	// if not in active_options print out as hidden fields
	} else {
		translucence_get_option_selector ("size: ", "site-description-size", $translucence_options_values['header-text-size']);
		translucence_get_option_field ("color: #", "site-description-color", 6);
		translucence_get_option_selector ("color:", "description-box-color", $translucence_options_values['header-color']);
		translucence_get_option_selector ("opacity:", "description-box-opacity", $translucence_options_values['header-opacity']);	
	}
	print "</table>";
	
	// headermeta right and left options
	if (in_array('headermeta-options', $active_options)) {
		print "<table style='width: 100%;'>";
		print "<tr>";
			// headermeta left options	
			print "<td style='width: 50%'>"; 
			if (in_array("header-meta-left", $translucence_config['model'])) {
				print "<span style='font-size: 9px;'>".__( 'Header Links', '2010-translucence' )."</span>\n";
				print "<select name='".$translucence_options_id."[header-meta-left]' style='font-size: 10px;'  onchange='this.form.submit();'>";
				foreach (array_keys($translucence_config['header_meta_left_options']) as $meta_left_option) {						
					print "<option value='".$translucence_config['header_meta_left_options'][$meta_left_option]['option_name']."' ";
					print ($translucence_options['header-meta-left'] == $translucence_config['header_meta_left_options'][$meta_left_option]['option_name'] ? ' selected' : '') . ">";
					print $translucence_config['header_meta_left_options'][$meta_left_option]['option_label']."</option>";						
				}
				print "</select>";
			}
			print "</td>";
					
			// headermeta right options	
			print "<td style='width: 50%; text-align: right;'>";	
			if (in_array("headermeta", $translucence_config['model'])) {	
				print "
				<span style='font-size: 9px;'>".__( 'Editing Quick Links', '2010-translucence' ).":</span>
				<select name='".$translucence_options_id."[headermeta]' style='font-size: 10px;' onchange='this.form.submit();'>
					<option value='on' ".($translucence_options['headermeta'] == 'on' ? ' selected' : '') . ">".__( 'Show', '2010-translucence' )."</option>
					<option value='off' ".($translucence_options['headermeta'] == 'off' ? ' selected' : '') . ">".__( 'Hide', '2010-translucence' )."</option>
				</select>";
			}
			print "</td>";		
		print "</tr>";	
		print "</table>";
	// if not in active_options print out as hidden fields
	} else {
		print "<input type='hidden' name='".$translucence_options_id."[header-meta-left]' value='".$translucence_options['header-meta-left']."'/>";
		print "<input type='hidden' name='".$translucence_options_id."[headermeta]' value='".$translucence_options['headermeta']."'/>";
	}

	print "<div style='font-size: 10px;'>";
	if ($translucence_options['options-mode'] != "global" && $translucence_options['options-mode'] != "advanced") {
		print __( 'For more site and header options see', '2010-translucence' ).": ";
		print "<a style='color: #003366;' href='javascript:setThemeOptionsMode(\"global\", \"".$translucence_options_id."\")'>Global Options</a>";	
	} else {
		print __( 'For basic options see', '2010-translucence' ).": ";
		print "<a style='color: #003366;' href='javascript:setThemeOptionsMode(\"basic\", \"".$translucence_options_id."\")'>Basic Options</a>";	
	}
	print "</div>";		
	print "</div>";

	$global_options = ob_get_contents();
	ob_end_clean();
	return $global_options;
}

function translucence_get_custom_options() {
	global $translucence_config, $translucence_options, $translucence_options_values, $translucence_variations;
    global $translucence_options_id;	
    global $translucence_custom_header_set, $translucence_custom_background_set;
    
    ob_start();
    print "<div class='options' style='background-color: transparent; clear: both; border: none; margin-bottom: 35px;'>";
	
	if ($translucence_custom_header_set == 1) {
		print "<div class='post-link' style='float: left; width: 40%;'>";
		print "<a style='color:".$translucence_options['bglinkcolor']."; border-color:".$translucence_options['bgtextcolor']." ' href='".get_bloginfo('url')."/wp-admin/themes.php?page=custom-header'>".__( 'Edit Custom Header', '2010-translucence')."</a>";	
		print "</div>";
	} else {
		print "<div class='post-link' style='float: left; width: 55%;'>";
		print "<a style='color:".$translucence_options['bglinkcolor']."; border-color:".$translucence_options['bgtextcolor']." ' href='".get_bloginfo('url')."/wp-admin/themes.php?page=custom-header'>".__( 'Add Custom Header', '2010-translucence')."</a>";	
		print "</div>";
	}

	if ($translucence_custom_background_set == 1) {
		print "<div class='post-link' style='float: right; width: 40%;'>";
		print "<a style='color:".$translucence_options['bglinkcolor']."; border-color:".$translucence_options['bgtextcolor']." ' href='".get_bloginfo('url')."/wp-admin/themes.php?page=custom-background'>".__( 'Edit Custom Background', '2010-translucence')."</a>";	
		print "</div>";
	} else {
		print "<div class='post-link' style='float: right; width: 40%; '>";
		print "<a style='color:".$translucence_options['bglinkcolor']."; border-color:".$translucence_options['bgtextcolor']." ' href='".get_bloginfo('url')."/wp-admin/themes.php?page=custom-background'>".__( 'Add Custom Background', '2010-translucence')."</a>";	
		print "</div>";
	}
	
	if ($translucence_options['header-text-display'] == "hide") {
		print "<div style='float: left; color:".$translucence_options['bglinkcolor']."; padding-bottom: 10px;'>";
		print "<em>".__( 'Site Title and description are hidden', '2010-translucence')."</em> ";	
	//	print "display: <input type='checkbox' name='header-text-display' id='header-text-display'".(isset($translucence_options['header-text-display']) && $translucence_options['header-text-display'] != 'hide' ? ' checked' : '')." onchange='this.form.submit();'/>";
		print "</div>";			
	}
	
	print "</div>";

	$custom_options = ob_get_contents();
	ob_end_clean();

	return $custom_options;
}

function translucence_get_layout_options() {
	global $translucence_config, $translucence_options, $translucence_options_values, $model_content_width, $translucence_variations;
    global $translucence_options_id, $active_options;
    
    ob_start();
    if (in_array('layout-options', $active_options)) {
		print "<div class='options' style='background-color: transparent; clear: both;'>";
		print "<div style='font-size: 10px; text-align: center;'>&larr; ".$model_content_width." px &rarr;<br/>";		
		print "<span style='font-size: 10px;'>".__( 'Content', '2010-translucence')."</span>\n";	
		translucence_get_option_selector ("", "content-color", $translucence_options_values['sidebar-color']);
		translucence_get_option_selector ("", "content-opacity", $translucence_options_values['sidebar-opacity']);
		translucence_get_option_selector ("", "content-border-style", $translucence_options_values['border-style']);				
		print "</div>";
	
		print "<table style='width: 100%;'>";
		print "<tr>";
		// left sidebar
		print "<td>";
		print "<div>".__( 'Left Sidebar', '2010-translucence')."</div>\n";
		// hidden widgets warning
		if (is_active_sidebar("sidebar-1") && $translucence_options['left01-width'] == 0) {
			print "<span style='font-size: 10px; color: #990000;'></span>";
		}
		//width
		translucence_get_option_selector ("", "left01-width", $translucence_options_values['sidebar-width']);
		print "</td>";
		// Right sidebar
		print "<td style='text-align: right;'>";
		print "<div>".__( '1st Right Sidebar', '2010-translucence')."</div>\n";
		// hidden widgets warning
		if (is_active_sidebar("primary-widget-area") && $translucence_options['right01-width'] == 0) {
			print "<span style='font-size: 10px; color: #990000;'>".__( 'hidden widgets!', '2010-translucence')."</span>";
		}
		// width
		translucence_get_option_selector ("", "right01-width", $translucence_options_values['sidebar-width']);
		print "</td>";
		print "</tr>";
		print "<tr>";
		print "<td></td>";
		// 2nd Right sidebar
		print "<td style='text-align: right;'>";
		print "<div>".__( '2nd Right Sidebar', '2010-translucence')."</div>\n";	
		// hidden widgets warning
		if (is_active_sidebar("secondary-widget-area") && $translucence_options['right02-width'] == 0) {
			print "<span style='font-size: 10px; color: #990000;'>".__( 'hidden widgets!', '2010-translucence')."</span>";
		}
		// width
		translucence_get_option_selector ("", "right02-width", $translucence_options_values['sidebar-width']);
		print "</td>";
		print "</tr>";	
		print "</table>";
		print __( 'For more sidebar options, see', '2010-translucence').": ";
		print "<a href='javascript:setThemeOptionsMode(\"layout\", \"".$translucence_options_id."\")'>".__( 'Layout Options', '2010-translucence')."</a> | ";
		print "<a href='javascript:setThemeOptionsMode(\"sidebar\", \"".$translucence_options_id."\")'>".__( 'Sidebar Options', '2010-translucence')."</a>";
		print "</div>";
		
	// if not in active_options print out as hidden fields	
	} else {
		translucence_get_option_selector ("", "content-color", $translucence_options_values['sidebar-color']);
		translucence_get_option_selector ("", "content-opacity", $translucence_options_values['sidebar-opacity']);
		translucence_get_option_selector ("", "content-border-style", $translucence_options_values['border-style']);	
		translucence_get_option_selector ("", "left01-width", $translucence_options_values['sidebar-width']);
		translucence_get_option_selector ("", "right01-width", $translucence_options_values['sidebar-width']);
		translucence_get_option_selector ("", "right02-width", $translucence_options_values['sidebar-width']);
		print "<div style='font-size: 10px;'>";
		print __( 'For more sidebar layout options, see', '2010-translucence').": ";
		print "<a href='javascript:setThemeOptionsMode(\"layout\", \"".$translucence_options_id."\")'>".__( 'Layout Options', '2010-translucence')."</a>";
		print "</div>";	
	}

	$entry_options = ob_get_contents();
	ob_end_clean();

	return $entry_options;
}

function translucence_get_topmenu_options() {
	global $translucence_config, $translucence_options, $translucence_options_values, $translucence_variations;
    global $translucence_options_id;	
    
    ob_start();
    print "<div style='padding: 10px;'>";
		//print "<span style='padding-top: 0px; font-size: 10px; float: left;'>Navigation</span>";
		print "<div style='font-size: 8px; float: left; margin-bottom: 10px;'>";
	
			translucence_get_option_selector ("", "top-color", $translucence_options_values['sidebar-color']);
			translucence_get_option_selector ("", "top-opacity", $translucence_options_values['sidebar-opacity']);
			translucence_get_option_selector ("", "top-border-style", $translucence_options_values['border-style']);
		
		print"</div>";

	print "</div>";

	$topmenu_options = ob_get_contents();
	ob_end_clean();

	return $topmenu_options;
}

function translucence_get_post_options() {
	global $translucence_config, $translucence_options, $translucence_options_values, $translucence_variations;
    global $translucence_options_id;
        
    ob_start();
    print "<div>";
	// post single sidebar options
	print "<div style='float: right; clear: left; font-size: 10px;'>\n";
	$translucence_title = "<span style='font-size: 9px;'>".__( 'single post pages', '2010-translucence' )." ".__( 'include', '2010-translucence' )."</span>";
	translucence_get_option_selector ($translucence_title, "post-single-sidebar", $translucence_options_values['sidebar-display']);
	print "</div>";
	
	// author sidebar options
	print "<div style='float: right; clear: both; font-size: 10px;'>\n";
	$translucence_title = "<span style='font-size: 9px;'>".__( 'author pages', '2010-translucence' )." ".__( 'include', '2010-translucence' )."</span>";
	translucence_get_option_selector ($translucence_title, "author-single-sidebar", $translucence_options_values['sidebar-display']);
	print "</div>";
	print "<div style='font-size: 9px;'>April 16th, 2009 by Author</div>";
					
	// category sidebar options				
	print "<div style='float: right; clear: both; font-size: 10px;'>\n";
	$translucence_title = "<span style='font-size: 9px;'>".__( 'category archive', '2010-translucence' )." ".__( 'include', '2010-translucence' )."</span>";
	translucence_get_option_selector ("<span style='font-size: 9px;'>category archive includes</span>", "category-single-sidebar", $translucence_options_values['sidebar-display']);
	print "</div>";
	
	print "<div><span class='entry'>".__( 'Categories', '2010-translucence' ).": </span><span class='catlinks'><a href='#'>".__( 'Category', '2010-translucence' )."</a></span></div>";
	print "<div><br/>Lorem ipsum dolor sit amet, <span class='entry-visited'>visited link</span> adipiscing elit. Donec ac felis non mauris tristique vehicula. Nunc commodo, justo vel imperdiet cursus, leo dui <a href='#'>link</a>, vel bibendum neque justo nec ipsum. Aliquam erat volutpat. <a href='#'>another link</a> leo tellus, sagittis id mollis non, pretium a tellus.</div>";
	// tag sidebar options
	print "<div style='float: right; clear: left; font-size: 10px;'>\n";
	$translucence_title = "<span style='font-size: 9px;'>".__( 'tag archive', '2010-translucence' )." ".__( 'include', '2010-translucence' )."</span>";
	translucence_get_option_selector ("<span style='font-size: 9px;'>tag archive includes</span>", "tag-single-sidebar", $translucence_options_values['sidebar-display']);
	print "</div>";
	print "<div><span class='entry'>".__( 'Tags', '2010-translucence' ).": </span><span class='taglinks'><a href='#'>".__( 'tag', '2010-translucence' )."</a></span></div>";
	print "<div class='entry' style='text-align: right;'>".__( 'No Comments', '2010-translucence' )." &#187;</div><br/>";
	// search sidebar options
	print "<div style='float: right; clear: both; font-size: 10px;'>";
	$translucence_title = "<span style='font-size: 9px;'>".__( 'search archive', '2010-translucence' )." ".__( 'include', '2010-translucence' )."</span>";
	translucence_get_option_selector ("<span style='font-size: 9px;'>search archive includes</span><br/>", "search-single-sidebar", $translucence_options_values['sidebar-display']);
	print "</div>";

	// archives sidebar options
	print "<div style=' font-size: 10px;'>";
	$translucence_title = "<span style='font-size: 9px;'>".__( 'archives page', '2010-translucence' )." ".__( 'include', '2010-translucence' )."</span>";
	translucence_get_option_selector ("<span style='font-size: 9px;'>archives page includes</span><br/>", "archives-single-sidebar", $translucence_options_values['sidebar-display']);
	print "</div>";
				
	/*********************************************************
	 * Text, Link, Category and Tag options
	 *********************************************************/

	if ($translucence_options['options-mode'] == "post"  || $translucence_options['options-mode'] == "advanced") {
		print "
		<hr/>
		<table width = '100%' cellpadding='0'>
		<tr><td valign='top'>	
	
			<table width = '100%' cellpadding='0'>
				<tr>
				<td style='border-bottom: 1px dotted;'><span style='font-size: 10px; color:".$translucence_options['textcolor'].";'>".__( 'Text', '2010-translucence' )." ".__( 'alignment', '2010-translucence' )."</span></td>							
				<td style='border-bottom: 1px dotted; text-align: right;'>";
				
				// text alignment options
				translucence_get_option_selector ("", "entry-text-align", $translucence_options_values['entry-text-align']);
				print "		 							
				</td>								
				</tr>						<tr>
				<td style='border-bottom: 1px dotted;'><span style='font-size: 10px; color:".$translucence_options['textcolor'].";'>".__( 'Text', '2010-translucence' )."</span></td>							
				<td style='border-bottom: 1px dotted; text-align: right;'>";
				
				// text color and size options
				translucence_get_option_selector ("color", "textcolor", $translucence_options_values['textcolor']);
				translucence_get_option_selector ("size", "entry-text-size", $translucence_options_values['text-size']);
				print "		 							
				</td>								
				</tr>
				<tr>
				<td style='border-bottom: 1px dotted;'><span style='font-size: 10px; color:".$translucence_options['linkcolor'].";'>".__( 'Link', '2010-translucence' )." ".__( 'color', '2010-translucence' )."</span></td>
				<td style='border-bottom: 1px dotted; text-align: right;'>";							
				// link color options
				translucence_get_option_selector ("", "linkcolor", $translucence_options_values['linkcolor']);
				print "
				</td>								
				</tr>						
			</table>
		</td><td valign='top' width='50%'>
			<table width = '100%' cellpadding='0'>
				<tr>";
				
				// category link style
				print "
				<td style='border-bottom: 1px dotted;'><span class='catlinks' style='font-size: 10px;'><a href='#'>".__( 'Categories', '2010-translucence' )."</a></span></td>
				<td style='border-bottom: 1px dotted; text-align: right;'>";						
				translucence_get_option_selector ("", "cat-links-color", $translucence_options_values['sidebar-color']);
				print "
				</td>								
				</tr><tr>";
				
				// Tag link style
				print "
				<td style='border-bottom: 1px dotted;'><span class='taglinks' style='font-size: 10px;'><a href='#'>".__( 'Tags', '2010-translucence' )."</a></span></td>
				<td style='border-bottom: 1px dotted; text-align: right;'>\n";							
				translucence_get_option_selector ("", "tag-links-color", $translucence_options_values['sidebar-color']);
				print "
				</td>
				</tr><tr>";
				// Entry link style
				print "
				<td style='border-bottom: 1px dotted;'><span class='entry' style='font-size: 10px;'><a href='#'>".__( 'Entry', '2010-translucence' )." ".__( 'link', '2010-translucence' )."</a></span></td>
				<td style='border-bottom: 1px dotted; text-align: right;'>\n";							
				translucence_get_option_selector ("", "entry-link-style", $translucence_options_values['entry-link-style']);
				print "
				</td></tr>
			</table>						
		</table>";
		
	// if not in active_options print out as hidden fields
	} else {
		translucence_get_option_selector ("", "entry-text-align", $translucence_options_values['entry-text-align']);
		translucence_get_option_selector ("color", "textcolor", $translucence_options_values['textcolor']);
		translucence_get_option_selector ("size", "entry-text-size", $translucence_options_values['text-size']);
		translucence_get_option_selector ("", "linkcolor", $translucence_options_values['linkcolor']);
		translucence_get_option_selector ("", "cat-links-color", $translucence_options_values['sidebar-color']);
		translucence_get_option_selector ("", "tag-links-color", $translucence_options_values['sidebar-color']);
		translucence_get_option_selector ("", "entry-link-style", $translucence_options_values['entry-link-style']);
				
		print "<div style='font-size: 10px;'>";
		print __( 'For text and link options, see', '2010-translucence' ).": ";
		print "<a href='javascript:setThemeOptionsMode(\"post\", \"".$translucence_options_id."\")'>".__( 'Post Options', '2010-translucence' )."</a>";
		print "</div>";
	}
	print "</div>";

	$post_options = ob_get_contents();
	ob_end_clean();

	return $post_options;
}

function translucence_get_left01_options() {
	global $translucence_config, $translucence_options, $translucence_options_values, $translucence_variations;
    global $translucence_options_id;	
   	global $current_widgets;
    
    ob_start();
    print "<div>";
	if ($translucence_options['left01-width'] != 0) {
		print "<div style='font-size: 10px; text-align: center; color: ".$translucence_options['left01-heading-color'].";'>&larr; ".$translucence_options['left01-width']." px &rarr;</div>";
		// opacity
		translucence_get_option_selector ("", "left01-opacity", $translucence_options_values['sidebar-opacity']);
		// color
		translucence_get_option_selector ("", "left01-color", $translucence_options_values['sidebar-color']);
		// border
		translucence_get_option_selector ("", "left01-border-style", $translucence_options_values['border-style']);
		
		if (is_active_sidebar("tertiary-widget-area")) {
			print "<div class='post-link' style='font-size: 10px; border-color: ".$translucence_options['left01-link-color'].";'>";
			print "<a href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>";
			print "</div><br/>";				
			if (is_array($current_widgets['tertiary-widget-area'])) {
				foreach ($current_widgets['tertiary-widget-area'] as $widget) {
					$widget = str_replace("-", " ", $widget);
					$widget = str_replace("_", " ", $widget);
					$widget = rtrim(ucwords($widget), "0..9");
					print "<div class='widgetbox' style='color: ".$translucence_options['left01-heading-color']."; border-color: ".$translucence_options['left01-heading-color'].";'>";
					print $widget;
					print "</div>";	
				}
			}
			
		} else {
			print "<div class='post-link' style='font-size: 10px; border-color: ".$translucence_options['left01-link-color']."'>";			
			print "<a style='color:".$translucence_options['left01-link-color'].";' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Add Widgets</a></div>";
			print "<div style='font-size: 10px; padding-left: 10px; color: ".$translucence_options['left01-heading-color'].";'>no widgets...</div>";
			print "<div style='font-size: 9px; padding-left: 10px; color: ".$translucence_options['left01-heading-color'].";'>add widgets or use defaults...</div>";
			//print "<div class='submit'><input type='submit' value='Add Default Widgets' name='default_widgets'/></div>";
		}					
	}
	print "</div>";
	
	$left01_options = ob_get_contents();
	ob_end_clean();

	return $left01_options;
}

function translucence_get_right01_options() {
	global $translucence_config, $translucence_options, $translucence_options_values, $translucence_variations;
    global $translucence_options_id;	
   	global $current_widgets;
    
    ob_start();
    print "<div>";
	if ($translucence_options['right01-width'] != 0) {
		print "<div style='font-size: 10px; text-align: center; color: ".$translucence_options['right01-heading-color'].";'>&larr; ".$translucence_options['right01-width']." px &rarr;</div>";
		// opacity
		translucence_get_option_selector ("", "right01-opacity", $translucence_options_values['sidebar-opacity']);
		// color
		translucence_get_option_selector ("", "right01-color", $translucence_options_values['sidebar-color']);
		// border
		translucence_get_option_selector ("", "right01-border-style", $translucence_options_values['border-style']);
	
		if (is_active_sidebar("primary-widget-area")) {
			print "<div class='post-link' style='font-size: 10px; border-color: ".$translucence_options['right01-link-color'].";'>";
			print "<a style='' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>";
			print "</div><br/>";
			if (is_array($current_widgets['primary-widget-area'])) {
				foreach ($current_widgets['primary-widget-area'] as $widget) {
					$widget = str_replace("-", " ", $widget);
					$widget = str_replace("_", " ", $widget);
					$widget = rtrim(ucwords($widget), "0..9");
					print "<div class='widgetbox' style='color: ".$translucence_options['right01-heading-color']."; border-color: ".$translucence_options['right01-heading-color'].";'>";
					print $widget;
					print "</div>";	
				}
			}
			
		} else {
			print "<div class='post-link' style='font-size: 10px; border-color: ".$translucence_options['right01-link-color'].";'>";
			print "<a style='color:".$translucence_options['right01-link-color'].";' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Add Widgets</a></div>";
			print "<div style='font-size: 10px; padding-left: 10px; color: ".$translucence_options['right01-heading-color'].";'>no widgets...</div>";
			print "<div style='font-size: 9px; padding-left: 10px; color: ".$translucence_options['right01-heading-color'].";'>add widgets or use defaults...</div>";
			//print "<div class='submit'><input type='submit' value='Add Default Widgets' name='default_widgets'/></div>";
		}					
	}
	print "</div>";
	
	$right01_options = ob_get_contents();
	ob_end_clean();

	return $right01_options;
}

function translucence_get_right02_options() {
	global $translucence_config, $translucence_options, $translucence_options_values, $translucence_variations;
    global $translucence_options_id;	
   	global $current_widgets;
    
    ob_start();
    print "<div>";
	if ($translucence_options['right02-width'] != 0) {
		print "<div style='font-size: 10px; text-align: center; color: ".$translucence_options['right02-heading-color'].";'>&larr; ".$translucence_options['right02-width']." px &rarr;</div>";
		// opacity
		translucence_get_option_selector ("", "right02-opacity", $translucence_options_values['sidebar-opacity']);
		// color
		translucence_get_option_selector ("", "right02-color", $translucence_options_values['sidebar-color']);
		// border
		translucence_get_option_selector ("", "right02-border-style", $translucence_options_values['border-style']);
		

		if (is_active_sidebar("secondary-widget-area")) {
			print "<br/><br/><div class='post-link' style='font-size: 10px; border-color: ".$translucence_options['right02-link-color']."'>";
			print "<a href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>";
			print "</div><br/>";
			if (is_array($current_widgets['secondary-widget-area'])) {
				foreach ($current_widgets['secondary-widget-area'] as $widget) {
					$widget = str_replace("-", " ", $widget);
					$widget = str_replace("_", " ", $widget);
					$widget = rtrim(ucwords($widget), "0..9");
					print "<div class='widgetbox' style='color: ".$translucence_options['right02-heading-color']."; border-color: ".$translucence_options['right02-heading-color'].";'>";
					print $widget;
					print "</div>";	
				}
			}
			
		} else {
			print "<a style='color:".$translucence_options['right02-link-color'].";' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Add Widgets</a></div>";
			print "<div style='font-size: 10px; padding-left: 10px; color: ".$translucence_options['right02-heading-color'].";'>no widgets...</div>";
			print "<div style='font-size: 9px; padding-left: 10px; color: ".$translucence_options['right02-heading-color'].";'>add widgets or use defaults...</div>";
			//print "<div class='submit'><input type='submit' value='Add Default Widgets' name='default_widgets'/></div>";
		}					

	}
	print "</div>";
	
	$right02_options = ob_get_contents();
	ob_end_clean();

	return $right02_options;
}

/******************************************************************************
 * Get Footer Options
 ******************************************************************************/

function translucence_get_footer_options() {
	global $translucence_config, $translucence_options, $translucence_options_values, $translucence_variations;
    global $translucence_options_id;	
    
    ob_start();
    print "<div>";
		if (in_array("footer-bottom-color", $translucence_config['model']))    
			print "<span style='padding-top: 0px; font-size: 10px; float: left;'>".__( 'Footer Widgets', '2010-translucence' )."</span>";
			print "<span class='horizontalbar' style='font-size: 8px'>";
			translucence_get_option_selector ("", "bottom-color", $translucence_options_values['sidebar-color']);
			translucence_get_option_selector ("", "bottom-opacity", $translucence_options_values['sidebar-opacity']);
			translucence_get_option_selector ("", "bottom-border-style", $translucence_options_values['border-style']);			 				
		print"</span>";		

	print "</div>";

	$footer_options = ob_get_contents();
	ob_end_clean();

	return $footer_options;
}

/******************************************************************************
 * Get First Footer widget options
 ******************************************************************************/

function translucence_get_footer_widgets($order) {
	global $translucence_config, $translucence_options, $translucence_options_values, $translucence_variations;
    global $translucence_options_id;	
    global $current_widgets;
    
    ob_start();
	print "<div>";
		if (is_active_sidebar( $order.'-footer-widget-area' )) {
			foreach ($current_widgets[$order.'-footer-widget-area'] as $widget) {
				$widget = str_replace("-", " ", $widget);
				$widget = str_replace("_", " ", $widget);
				$widget = rtrim(ucwords($widget), "0..9");
				print "<div class='widgetbox' style='width: 150px; color: ".$translucence_options['bottom-heading-color']."; border-color: ".$translucence_options['bottom-heading-color'].";'>";
				print $widget;
				print "</div>";					
			}
		}
	print "</div>";

	$footer_widgets = ob_get_contents();
	ob_end_clean();

	return $footer_widgets;
}


/******************************************************************************
 * Get Footer meta right options
 ******************************************************************************/

function translucence_footermeta_right() {
	global $translucence_config, $translucence_options, $translucence_options_values, $translucence_variations;
    global $translucence_options_id;	

    ob_start();
    print"<input name='theme-name' type='hidden' value='".$translucence_options['theme-name']."'>";
    print"<input name='theme-url' type='hidden' value='".$translucence_options['theme-url']."'>";
	print "<div style='font-size: 9px; float: right; clear: left; color: ".$translucence_options['bgtextcolor'].";'>";
	print $translucence_options['theme-name']." | WordPress";
	print "</div>";

	$footermeta_right = ob_get_contents();
	ob_end_clean();

	return $footermeta_right;
}

/******************************************************************************
 * Get Footer meta left otions
 ******************************************************************************/

function translucence_footermeta_left() {
	global $translucence_config, $translucence_options, $translucence_options_values, $translucence_variations;
    global $translucence_options_id;	
    
    ob_start();
    print "<div style='font-size: 9px;'>";

	if ($translucence_options['footerleft'] == "") {
		print "no links defined...";
	} else {
		print $translucence_options['footerleft'];
	}
	if ($translucence_options['footer-meta-left'] == 'custom') {
		print "
			<input id='footerleftdo' type='hidden' name='footerleftdo' value='0'/> - 
	
			<a href='javascript: document.getElementById(\"footerleftedit\").style.display = \"block\"; document.getElementById(\"footerleftdo\").value = \"1\"; exit;'>edit</a>
			
			<div id='footerleftedit' style='display: none;'>
			
			<textarea name='".$translucence_options_id."[footerleftcustom]' style='width: 100%; height: 50px; font-size: 10px;' class='code'>";
			print stripslashes(stripslashes(trim($translucence_options['footerleftcustom'])));
			print "</textarea>		
			&nbsp;&nbsp;&nbsp;
			<a href='javascript: document.getElementById(\"footerleftedit\").style.display = \"none\"; document.getElementById(\"footerlefteditdo\").value = \"0\"; exit;'>Cancel</a> - 
			<span class='submit'><input type='submit' value='Update' name='save'/></span>	
			</div>
		";
	}

	print "</div>";

	$footermeta_left = ob_get_contents();
	ob_end_clean();

	return $footermeta_left;
}


/******************************************************************************
 * Get Footer meta options
 ******************************************************************************/
function translucence_get_footermeta_options() {
	global $translucence_config, $translucence_options, $translucence_options_values, $translucence_variations;
    global $translucence_options_id;	
    
	ob_start();
	print "<div class='options'>";

    // footer meta left appgroups options		
	if (in_array("footer-meta-left", $translucence_config['model'])) {
		print "<span style='font-size: 9px;'>Footer Links:</span>\n";
		print "<select name='".$translucence_options_id."[footer-meta-left]' style='font-size: 10px;'  onchange='this.form.submit();'>";
		
		foreach (array_keys($translucence_config['footer_meta_left_options']) as $meta_left_option) {						
			print "<option value='".$translucence_config['footer_meta_left_options'][$meta_left_option]['option_name']."' ";
			print ($translucence_options['footer-meta-left'] == $translucence_config['footer_meta_left_options'][$meta_left_option]['option_name'] ? ' selected' : '') . ">";
			print $translucence_config['footer_meta_left_options'][$meta_left_option]['option_label']."</option>";						
		}
		print "</select>";
		
	}
	
	print "</div>";

	$footermeta_options = ob_get_contents();
	ob_end_clean();
	return $footermeta_options;
}

/******************************************************************************
 * Get option-modes 
 ******************************************************************************/

function translucence_get_option_modes() {
	$option_modes = array(
		'Basic Options' => 'basic', 
		'Post Options' => 'post',
		'Layout Options' => 'layout',
		'Sidebar Options' => 'sidebar',
		'Global Options' => 'global',
		'All Options' => 'advanced' 
	);
	return $option_modes;	
}


/******************************************************************************
 * Get active options that are included in given option mode
 ******************************************************************************/

function translucence_get_active_options($translucence_options_mode) {
	global $translucence_config, $translucence_options;
	$active_options = array();
	
	if (in_array('options-mode', $translucence_config['model'])) {

		if ($translucence_options_mode == "basic") {
			$active_options[]  = 'options-mode';
			$active_options[]  = 'site-options';
	// 		$active_options[]  = 'header-options';
			$active_options[]  = 'layout-options';
			$active_options[]  = 'site-title-options';
			$active_options[]  = 'site-title-color';
			$active_options[]  = 'site-title-size';
 	 		$active_options[]  = 'tagline-options';
 			$active_options[]  = 'site-description-size';
 			$active_options[]  = 'site-description-color';
	// 		$active_options[]  = 'headermeta-options';
			$active_options[]  = 'site-width';
			//$active_options[]  = 'site-color';
			//$active_options[]  = 'site-opacity';
			//$active_options[]  = 'site-border-style';
			//$active_options[]  = 'header-block-height';
			//$active_options[]  = 'header-color';
			//$active_options[]  = 'header-opacity';
			//$active_options[]  = 'header-border-style';
			$active_options[]  = 'left01-width';
			$active_options[]  = 'right01-width';
			$active_options[]  = 'right02-width';
			$active_options[]  = 'top-opacity';
			$active_options[]  = 'left01-opacity';
			$active_options[]  = 'right01-opacity';
			$active_options[]  = 'right02-opacity';	
			$active_options[]  = 'top-color';
			$active_options[]  = 'left01-color';
			$active_options[]  = 'right01-color';
			$active_options[]  = 'right02-color';
			$active_options[]  = 'bottom-color';
			$active_options[]  = 'top-border-style';
			$active_options[]  = 'left01-border-style';
			$active_options[]  = 'right01-border-style';
			$active_options[]  = 'right02-border-style';
			$active_options[]  = 'bottom-border-style';


		
		} else if ($translucence_options_mode == "post") {
			$active_options[]  = 'options-mode';
			$active_options[]  = 'entry-text-align';
			$active_options[]  = 'entry-text-size';
			$active_options[]  = 'textcolor';
			$active_options[]  = 'linkcolor';
			$active_options[]  = 'cat-links-color';
			$active_options[]  = 'tag-links-color';
			$active_options[]  = 'entry-link-style';		

		} else if ($translucence_options_mode == "layout") {
			$active_options[]  = 'options-mode';
			$active_options[]  = 'layout-options';
			$active_options[]  = 'left01-width';
			$active_options[]  = 'right01-width';
			$active_options[]  = 'right02-width';
			$active_options[]  = 'top-border-style';
			$active_options[]  = 'content-border-style';
			$active_options[]  = 'left01-border-style';
			$active_options[]  = 'right01-border-style';
			$active_options[]  = 'right02-border-style';
			$active_options[]  = 'bottom-border-style';
			$active_options[]  = 'top-opacity';
			$active_options[]  = 'left01-opacity';
			$active_options[]  = 'content-opacity';
			$active_options[]  = 'right01-opacity';
			$active_options[]  = 'right02-opacity';
			$active_options[]  = 'bottom-opacity';	
			$active_options[]  = 'top-color';
			$active_options[]  = 'left01-color';
			$active_options[]  = 'content-color';
			$active_options[]  = 'right01-color';
			$active_options[]  = 'right02-color';
			$active_options[]  = 'bottom-color';
			
		} else if ($translucence_options_mode == "sidebar") {
			$active_options[]  = 'options-mode';
			$active_options[]  = 'post-single-sidebar';
			$active_options[]  = 'author-single-sidebar';
			$active_options[]  = 'content-border-style';
			$active_options[]  = 'category-single-sidebar';
			$active_options[]  = 'tag-single-sidebar';
			$active_options[]  = 'search-single-sidebar';
			$active_options[]  = 'archives-single-sidebar';
			$active_options[]  = 'top-border-style';
			$active_options[]  = 'content-border-style';
			$active_options[]  = 'left01-border-style';
			$active_options[]  = 'right01-border-style';
			$active_options[]  = 'right02-border-style';
			$active_options[]  = 'bottom-border-style';
			$active_options[]  = 'top-opacity';
			$active_options[]  = 'left01-opacity';
			$active_options[]  = 'content-opacity';
			$active_options[]  = 'right01-opacity';
			$active_options[]  = 'right02-opacity';
			$active_options[]  = 'bottom-opacity';	
			$active_options[]  = 'top-color';
			$active_options[]  = 'left01-color';
			$active_options[]  = 'content-color';
			$active_options[]  = 'right01-color';
			$active_options[]  = 'right02-color';
			$active_options[]  = 'bottom-color';
		
		} else if ($translucence_options_mode == "global") {
			$active_options[]  = 'options-mode';
			$active_options[]  = 'site-options';
			$active_options[]  = 'header-options';
			$active_options[]  = 'site-title-options';
			$active_options[]  = 'site-title-box-options';
			$active_options[]  = 'tagline-options';
			$active_options[]  = 'headermeta-options';
			$active_options[]  = 'site-width';
			$active_options[]  = 'site-color';
			$active_options[]  = 'site-opacity';
			$active_options[]  = 'site-border-style';
			$active_options[]  = 'header-block-height';
			$active_options[]  = 'header-color';
			$active_options[]  = 'header-opacity';
			$active_options[]  = 'header-border-style';
			$active_options[]  = 'site-title-size';
			$active_options[]  = 'site-title-color';
			$active_options[]  = 'header-text-shadow-offset';
			$active_options[]  = 'header-text-shadow-blur';
			$active_options[]  = 'title-box-color';
			$active_options[]  = 'title-box-opacity';
			$active_options[]  = 'header-text-display';
			$active_options[]  = 'site-description-size';
			$active_options[]  = 'site-description-color';
			$active_options[]  = 'description-box-color';
			$active_options[]  = 'description-box-opacity';
			$active_options[]  = 'header_meta_left_options';
			$active_options[]  = 'headermeta';
			//$active_options[]  = '';
			

		} else {
			$active_options = $translucence_options;
		}
	
	}
	return $active_options;
}


/*********************************************************
 * Get select field for a given theme option
 *********************************************************/

function translucence_get_option_selector ($option_title, $option_name, $option_values, $state='dimmed') {
	global $translucence_config, $translucence_options, $translucence_options_values;
	global $translucence_custom_header_set, $translucence_custom_background_set, $translucence_options_id;
	
	$translucence_options_mode = translucence_get_active_options($translucence_options['options-mode']);
	$display_option = false;
	
	//if ($translucence_options['options-mode'] == "basic") {		
		if (in_array($option_name, $translucence_options_mode)) {	
			$display_option = true;
		} else if ($translucence_custom_header_set == 1 && (preg_match("/box/", $option_name))) {
			$display_option = true;
		}
	
	//} else {
		//$display_option = true;
	//}
	
	if ($state == "dimmed") {
		$state_css = "option-label-dimmed";
	} else if ($state == "active") {
		$state_css = "option-label";
	}
	
	if (in_array($option_name, $translucence_config['model']) && $display_option == true) {
		print "<span style='white-space:nowrap;'>\n";
		if ($option_title != "") print " <span style='font-size: 10px;'>".$option_title."</span>\n";
		print "<select name='".$translucence_options_id."[".$option_name."]' style='font-size: 10px;' class='".$state_css."' onchange='this.form.submit();'>\n";							
			// options
			foreach ($option_values as $label => $value) {
				print "\n<option value='".$value."'".($translucence_options[$option_name] == $value ? ' selected' : '') . ">".$label."</option>";
			}					
		print "</select>\n";
		print "</span> &nbsp;\n";
	} else {
		print "<input type='hidden' name='".$translucence_options_id."[".$option_name."]' value = '".$translucence_options[$option_name]."'/>";
	}

}

/*********************************************************
 * Get an input field for a given theme option
 *********************************************************/

function translucence_get_option_field ($option_title, $option_name, $option_field_width) {
	global $translucence_config, $translucence_options, $translucence_options_values, $translucence_options_id;

	$translucence_options_mode = translucence_get_active_options($translucence_options['options-mode']);
	$display_option = false;
	
	//if ($translucence_options['options-mode'] == "basic") {		
		if (in_array($option_name, $translucence_options_mode)) $display_option = true;			
	//} else {
	//	$display_option = true;
	//}

	if (in_array($option_name, $translucence_config['model']) && $display_option == true) {			
		print "<span style='white-space:nowrap'>";
		if ($option_title != "") print "<span style='font-size: 10px;'>".$option_title."</span>\n";
		print "<input name='".$translucence_options_id."[".$option_name."]' class='color'  type='text' size='".$option_field_width."' style='font-size: 10px;' 
		value='".(isset($translucence_options[$option_name]) ? $translucence_options[$option_name] : '')."'/></span>";
	} else {
		print "<input type='hidden' name='".$translucence_options_id."[".$option_name."]' value = '".$translucence_options[$option_name]."'/>";
	}
}

?>