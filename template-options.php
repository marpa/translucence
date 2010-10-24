<?php 


/*********************************************************
 * ShadowBox theme options
 * renders UI and theme model for chosing and previewing options
 *********************************************************/

function theme_model() {
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;
    
    $current_widgets = get_option ('sidebars_widgets');	
    
    $model_header_image = get_header_image();
	if ($options['header-image-options'] == "custom") {
   		$match = preg_match('/variations/', $model_header_image);
   		if ($match == 0) {
   			$custom_header_set = 1;
   		} else {
   			$custom_header_set = 0;
   		}
   	} else {
   		//$model_header_image = get_bloginfo('stylesheet_directory')."/variations/".$variation_config['header_image_options'][$options['header-image-options']]['option_value'];
   		$model_header_image = get_header_image();
   	}
 	
 	//printpre ($custom_background_image);
 	if ($custom_background_image) {
 		$options['background_image'] = "url('".$custom_background_image."')";
 		$options['background_repeat'] = get_theme_mod( 'background_repeat', 'repeat' );
 		$options['background_attachment'] = get_theme_mod( 'background_attachment', 'scroll' );
 		$options['background_position'] = get_theme_mod( 'background_position_x', 'left' );
 	}
 
	/*********************************************************
	 * Define theme layout model values
	 *********************************************************/

    $model_right_sidebar_width = $options['right01-width']+50;
    $model_right_sidebar_width02 = $options['right02-width']+50;
    $model_left_sidebar_width = $options['left01-width']+50;
    
   	
	$model_site_width = $options['site-width']+10;
	$model2_site_width = $options['site-width']+50;

	$model_header_width = $options['site-width']-$options['custom-header-width-offset']-7;
	
	$model_page_width = $options['site-width']-$options['custom-header-width-offset']-7;
	$model_header_text_width = $model_site_width - 200;
	$model_content_width = $options['site-width'] - ($options['left01-width'] + $options['right01-width'] + $options['right02-width'] + 150);
	$model_site_width = $model_site_width."";
	$model_site_width_css = $model_site_width."px";
	
	$model_titlebox_padding = $options['header-text-padding-top'] - 20;
	$model_descriptionbox_padding = $options['description-text-padding-top'] -40;

	/*********************************************************
	 * Define theme model css
	 * model css uses most of the actual theme's css except
	 * theme body css 
	 * model css adds css for theme edit UI components
	 *********************************************************/
	 
 	$model_css = preg_replace("/body/", ".body_na", $variation_css); 
	$custom_background_color = get_background_color();
	$custom_background_image = get_background_image();
	$syndication_image = get_bloginfo('stylesheet_directory')."/variations/feed.png";


 	print "
 	<script type='text/javascript' src='".get_bloginfo('stylesheet_directory')."/jscolor/jscolor.js'></script>
 	<style type='text/css'>";
 	print $model_css;
 	print "
 		.modelwrapper {
			background-image: ".$options['background_image'].";
			background-position: ".$options['background_position'].";
			background-color: ".$options['background_color'].";
			background-repeat: ".$options['background_repeat'].";
			background-attachment: ".$options['background_attachment'].";
 			width: ".$model2_site_width."px;
			background-color: ".$options['background_color'].";
			color: #000000;
			padding: 1px 0px 0px 0px;
			border: 1px solid #CCCCCC;
		}

		.headerblock {
			background-image: url(".$model_header_image.");
			background-position: right center;
			background-repeat: no-repeat;
		}

		.title-box {
			position: relative;
			top: ".$model_titlebox_padding."px;
		}

		.headerblock #site-description {
			position: relative;
			top: ".$model_descriptionbox_padding."px;
		}

				
		.options {
			margin-top: 5px;
			margin-bottom: 5px;
			margin-right: 5px;
			margin-left: 5px;
			background-color: #fff;
			color: #000000;
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
			background: url(".$syndication_image.") no-repeat 0 1px;
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
 			color: ".$options['bglinkcolor'].";

 		}
 		
 		.metatext a {
 			color: ".$options['bglinkcolor'].";
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
			border-color: ".$options['right01-link-color'].";
		}

		
 		.editwidgetlink {
			display: block;
 			color: ".$options['linkcolor'].";
 			
 		}
 		
 		.editwidgetlink a {
			display: block;
 			color: ".$options['linkcolor'].";
			border: 1px dotted;
 			padding: 3px;
 			margin-bottom: 3px;
		} 		
 		
 		.editwidgetlink a:hover {
			 border: 1px solid;
			 text-decoration: none;
		}

 		.editheaderlink {
 			color: ".$options['bglinkcolor'].";
 			font-size: 9px;
 			white-space:nowrap; 			
 		}
 		
		.editheaderlink a {
 			color: ".$options['bglinkcolor'].";
 			padding: 3px;
 			border: 1px dotted ".$options['bglinkcolor'].";
		}

 		.editheaderlink a:hover {
			 border: 1px solid ".$options['bglinkcolor'].";
			 text-decoration: none;
			 color: ".$options['bglinkcolor'].";
		}
		
		.modelheadertextposition {
			font-size: 20px; 
			margin-left: 5px;
			padding-top: ".$options['header-text-padding-top']."px;
			color: ".$options['headertext'].";
		}


		".$options['header-color-ie']."
		".$options['top-color-ie']."
		".$options['content-color-ie']." 
		".$options['bottom-color-ie']."
		".$options['left01-color-ie']."
		".$options['right01-color-ie']."
		".$options['right02-color-ie']."

		
		</style>
	
	";
	
	/******************************************************************************
	 * Theme Options Introduction with Update and Revert buttons
	 ******************************************************************************/
			
	?>
		<form id='settings' action='' method='post' class='themeform' style='margin: 20px;'>
		<input type='hidden' id='action' name='action' value='save'/>
	
		<table width = '<?php print $model_site_width; ?>' cellpadding='0' style='background-color: transparent;'>
		<tr>
			<td width='20%'>
			<span class='submit'><input type='submit' value='Update' name='save'/></span>
			</td>
			<td width='60%' align='left'>
			<div class='instructions' style='font-size: 9px;'>	
			<i>Below is a model of your blog's layout and colors. It does not show all the details of your blog's header, borders or sidebar widgets.  
			As well, the width of sidebars and content areas may not be accurate in this preview.</i>&nbsp;&nbsp;
			 <strong>Show recommendations: </strong><input type='checkbox' name='model-instructions' id='model-instructions' <?php (isset($options['model-instructions']) && $options['model-instructions'] == "on" ? ' checked' : ''); ?> onchange='this.form.submit();'/>
			</div>			
			</td>
			<td width='20%'>
			<div class='submit' style='float: right;'><input type='submit' value='Revert to Default' name='reset'/></div>
			</td>
		</tr>
		</table>
	
	<?php
	
	/******************************************************************************
	 * html from theme template files (header.php, index.php, footer.php and sidebars
	 * embedded in this html are functions for printing theme options UI
	 ******************************************************************************/
	?>
	
		<div class='modelwrapper'>			
			<?php print get_global_options(); ?>
			<div class='sitewrapper'> 	
				<div class='headermeta_right'> 
					<div class='bgtextcolor'><?php print headermeta_right(); ?></div><br/> 
				</div> 
				<div class='headermeta_left'> 
					<div class='bgtextcolor'><?php print headermeta_left(); ?></div><br/> 
				</div> 	
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
							<?php print get_topmenu_options(); ?>
							</div>
						</div><!-- #access -->
					</div><!-- #masthead -->
				</div><!-- #header -->
				<div id='main' style="clear: both;">
					<div id='container'>
						<div id='tertiary' class='widget-area'>
							<!-- left sidebar -->
							<h3 class='widget-title'>Left Sidebar</h3>
							<?php print get_left01_options(); ?>
						</div>
						<div id='content'>
							<!-- syndication links -->
							<div style = 'width: 100%; float: right;'> 
								<div id='syndication'> 
									<a href='#' class='feed'>Posts RSS</a> 
									<a href='#' class='feed'>Comments RSS</a> 
								</div> 
							</div> 
							<!-- main content -->
							<?php print get_layout_options(); ?>
							<h2 class='entry-title'>Entry Title</h2>
							<div class='entry-content'>
								<?php print get_post_options(); ?>	
							</div>
						</div>
						<div id='primary' class='widget-area'>
							<!-- 1st right sidebar -->
							<h3 class='widget-title'>1st Right Sidebar</h3>
							<?php print get_right01_options(); ?>
						</div>
						<div id='secondary' class='widget-area' style=''>
							<!-- 2nd right sidebar -->
							<h3 class='widget-title'>2nd Right Sidebar</h3>
							<?php print get_right02_options(); ?>
						</div>
					</div><!-- #container -->
				</div><!-- #main -->
					<br/>
					<div id='colophon'></div><!-- #colophon --> 
					<div id='footer-widget-area'>
					<?php print get_footer_options(); ?>
					<!-- footer -->
						<div id='first' class='widget-area'>
							<ul class='xoxo'>
								<h3 class='widget-title'>First Footer Widget Area</h3>
								<?php print get_footer_widgets('first'); ?>
							</ul>
						</div>
						<div id='second' class='widget-area'>
							<ul class='xoxo'>
								<h3 class='widget-title'>Second Footer Widget Area</h3>
								<?php print get_footer_widgets('second'); ?>
							</ul>
						</div>
						<div id='third' class='widget-area'>
							<ul class='xoxo'>
								<h3 class='widget-title'>Third Footer Widget Area</h3>
								<?php print get_footer_widgets('third'); ?>
							</ul>
						</div>
						<div id='fourth' class='widget-area'>
							<ul class='xoxo'>
								<h3 class='widget-title'>Fourth Footer Widget Area</h3>
								<?php print get_footer_widgets('fourth'); ?>
							</ul>
						</div>
					</div>
			</div><!-- #wrapper -->
				
			<div class='sitewrapper'>  
				<div class='footermeta_right'> 
					<div class='bgtextcolor'><?php print footermeta_right(); ?></div> 
				</div> 	 
				<div class='footermeta_left'> 
					<div class='bgtextcolor'><?php print footermeta_left(); ?></div> 
				</div> 	
			</div><!-- #sitewrapper --> 
			<?php print get_footermeta_options(); ?>
		</div><!-- modelwrapper --> 
		
	<?php
	/******************************************************************************
	 * Theme Options Notes with Update and Revert button
	 ******************************************************************************/
	?>
	
	<table width = '<?php print $model_site_width; ?>' align='center' cellpadding='5' cellspacing='5' border='0'>
		<tr>
			<td>
				<span class='submit'><input type='submit' value='Update' name='save'/></span>
			</td>
			<td>
				<div class='instructions'>	
				When chosing options think about colors and contrasts that complement your content.  For example, if your site focuses on links, be sure your link color contrasts with your 
				text color so links will stand out.  Chose the black theme for blogs that highlight images.  <br/>
				</div>
			</td>
			<td>
				<span class='submit'><input type='submit' value='Revert to Default' name='reset'/></span>
			</td>
		</tr>
	</table>
	</form>	
	<?php
}

function headermeta_left() {
	global $variation_config, $options;
	
	ob_start();
	print "<div class='metatext'>";
	
	if ($options['headerleft'] == "") {
		print "no links defined...";				
	} else {
		print $options['headerleft'];
	}
			
	// if header left links selection is custom
	if ($options['header-meta-left'] == 'custom') {
		print "
			<input id='appgroupdo' type='hidden' name='appgroupdo' value='0'/> - 			
			<a href='javascript: document.getElementById(\"appgroupedit\").style.display = \"block\"; document.getElementById(\"appgroupdo\").value = \"1\"; exit; '>edit</a>					
			<div id='appgroupedit' style='display: none;'>					
			<textarea name='headerleftcustom' style='width: 100%; height: 50px; font-size: 10px;' class='code'>";
			print stripslashes(stripslashes(trim($options['headerleftcustom'])));
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


function headermeta_right() {
	global $variation_config, $options;
	
	ob_start();
	print "<span class='metatext'>";
	print $options['headerright'];
	
	// Log in link options
	if ($options['headermeta'] == "on") {
		print "Menus | Widgets | Design";
		print " | ".wp_get_current_user()->display_name;
		//print " - Log out";
	}
	
	print "</span>";
	$headermeta_right = ob_get_contents();
	ob_end_clean();
	return $headermeta_right;
}

function get_global_options() {
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;	
    
	ob_start();
	print "<div class='options'>";
	print "<table style='width: 100%;'>";
	print "<tr>";
	
	// Variation options	
	print "<td style='width: 60%; text-align: left; border-bottom: 1px solid; padding-bottom: 5px; '>";			
	if (in_array("background", $variation_config['model'])) {				
		print "
		<span style='font-size: 10px;'></span>
		<select name='background' style='font-size: 14px;' onchange='this.form.submit();'>";
			
			// variations defined in variations folder
			foreach ($variations as $label => $value) {
				if (!in_array($value, $variation_config['variations_disabled']))
					print "\n<option value='".$value."'".($options['background'] == $value ? ' selected' : '') . ">".$label."</option>";
			}	
		print "</select>";
		
		if ($custom_background_color !="" || $custom_background_image !="") {
			print "<div  style='font-size: 10px; text-align: center; border-color: ".$options['bgtextcolor']."'>";
			print "(Custom background color or image may change the background of this variation)";	
			print "</div>";
		}
	}						
	print "</td>";	
	
	// Options mode
	print "<td style='width: 40%; text-align: right; border-bottom: 1px solid; padding-bottom: 5px;'>"; 
		print "Options Mode:<span class='option-label'>";
		get_option_selector ("", "options-mode", $options_values['mode'], 'active');
		print "</span>";
	
	print "</td>";	
	print "</tr>";	
	print "</table>";
	
	// global options for: site, header, site title, tagline and header meta
	print "<table style='width: 100%;'>";
	print "<tr>";
	
	// get basic options
	if (in_array('options-mode', $variation_config['model'])) {
		$basic_options = get_basic_options();
	}

	// site width, color, opacity and border options
	if (in_array('site-options', $basic_options)) {
		print "<td class='option-row'>";
			//site width
			print "<span class='option-label'>Site</span>";
			get_option_selector ("width:", "site-width", $options_values['site-width']);
			// site color
			get_option_selector ("color:", "site-color", $options_values['sidebar-color']);
			// site opacity
			get_option_selector ("opacity:", "site-opacity", $options_values['header-opacity']);
			// site border
			get_option_selector ("border:", "site-border-style", $options_values['border-style']);
		print "</td>";
		print "</tr>";
	}
	
	// header height, color, opacity, border options
	if (in_array('header-options', $basic_options)) {
		print "<tr>";
		print "<td class='option-row'>";		
			// header height options
			print "<span class='option-label'>Header</span>";
			get_option_selector ("height:", "header-block-height", $options_values['header-block-height']);
			// header color
			get_option_selector ("color:", "header-color", $options_values['sidebar-color']);
			// header opacity
			get_option_selector ("opacity:", "header-opacity", $options_values['header-opacity']);
			// header border
			get_option_selector ("border:", "header-border-style", $options_values['border-style']);
		print "</td>";	
		print "</tr>";
	}
	
	// header text size color shadow, box and position
	if (in_array('site-title-options', $basic_options)) {
		print "<tr>";
		print "<td class='option-row'>";		
			// header-text-size options		
			if (in_array("site-title-size", $variation_config['model'])) {	
				print "<span class='option-label'>Site Title </span>";
				get_option_selector ("size: ", "site-title-size", $options_values['header-text-size']);
			}
			// header-text-color options		
			if (in_array("site-title-color", $variation_config['model'])) {	
				get_option_field ("Color: #", "site-title-color", 6);
			}
			// header-text-offset options		
			if (in_array("header-text-shadow-offset", $variation_config['model'])) {	
				get_option_selector ("offset: ", "header-text-shadow-offset", $options_values['text-shadow-offset']);
			}	
			// header-text-blur options		
			if (in_array("header-text-shadow-blur", $variation_config['model'])) {	
				get_option_selector ("blur: ", "header-text-shadow-blur", $options_values['text-shadow-blur']);
			}
	
			// header-text-box options		
			if (in_array("title-box-color", $variation_config['model'])) {	
				print "<span class='option-label'> | Site Title Box</span>";
				get_option_selector ("color: ", "title-box-color", $options_values['sidebar-color']);
			}
			if (in_array("title-box-opacity", $variation_config['model'])) {	
				get_option_selector ("opacity:", "title-box-opacity", $options_values['header-opacity']);
			}
			// header-text-display options		
			if (in_array("header-text-display", $variation_config['model'])) {	
				print "
				<span class='option-label'>
				<select name='header-text-display' style='font-size: 10px;' onchange='this.form.submit();'>
					<option value='middle' ".($options['header-text-display'] == 'middle' ? ' selected' : '') . ">Middle</option>
					<option value='top' ".($options['header-text-display'] == 'top' ? ' selected' : '') . ">Top</option>
					<option value='bottom' ".($options['header-text-display'] == 'bottom' ? ' selected' : '') . ">Bottom</option>
					<option value='hide' ".($options['header-text-display'] == 'hide' ? ' selected' : '') . ">Hide</option>
				</select>
				</span>";
			}
	
		print "</td>";	
		print "</tr>";
	}
	
	// Tagline text size, color, box
	if (in_array('tagline-options', $basic_options)) {
		print "<tr>";
		print "<td class='option-row'>";		
			// header-description-size options		
			if (in_array("site-description-size", $variation_config['model'])) {	
				print "<span class='option-label'>Tagline</span><span class='option-label'>";
				get_option_selector ("size: ", "site-description-size", $options_values['header-text-size']);
				print "</span>";
			}
			// header-description-color options		
			if (in_array("site-description-color", $variation_config['model'])) {
				print "<span class='option-label'>";
				get_option_field ("color: #", "site-description-color", 6);
				print "</span>";
			}
			if (in_array("description-box-color", $variation_config['model'])) {	
				print " | Tagline box<span class='option-label'>";
				get_option_selector ("color:", "description-box-color", $options_values['sidebar-color']);
				print "</span>";
			}
	
			if (in_array("description-box-opacity", $variation_config['model'])) {	
				print "<span class='option-label'>";
				get_option_selector ("opacity:", "description-box-opacity", $options_values['header-opacity']);
				print "</span>";
			}
	
		print "</td>";	
		print "</tr>";	
	}
	print "</table>";
	
	// headermeta right and left options
	if (in_array('headermeta-options', $basic_options)) {
		print "<table style='width: 100%;'>";
		print "<tr>";
			// headermeta right options	
			print "<td style='width: 50%'>"; 
			if (in_array("header-meta-left", $variation_config['model'])) {
				print "<span style='font-size: 9px;'>Header Links:</span>\n";
				print "<select name='header-meta-left' style='font-size: 10px;'  onchange='this.form.submit();'>";
				foreach (array_keys($variation_config['header_meta_left_options']) as $meta_left_option) {						
					print "<option value='".$variation_config['header_meta_left_options'][$meta_left_option]['option_name']."' ";
					print ($options['header-meta-left'] == $variation_config['header_meta_left_options'][$meta_left_option]['option_name'] ? ' selected' : '') . ">";
					print $variation_config['header_meta_left_options'][$meta_left_option]['option_label']."</option>";						
				}
				print "</select>";
			}
			print "</td>";
					
			// headermeta left options	
			print "<td style='width: 50%; text-align: right;'>";	
			if (in_array("headermeta", $variation_config['model'])) {	
				print "
				<span style='font-size: 9px;'>Editing Quick Links:</span>
				<select name='headermeta' style='font-size: 10px;' onchange='this.form.submit();'>
					<option value='on' ".($options['headermeta'] == 'on' ? ' selected' : '') . ">Show</option>
					<option value='off' ".($options['headermeta'] == 'off' ? ' selected' : '') . ">Hide</option>
				</select>";
			}
			print "</td>";
		
		print "</tr>";	
		print "</table>";
	}
	
	print "</div>";

	$global_options = ob_get_contents();
	ob_end_clean();
	return $global_options;
}

function get_layout_options() {
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;	
    
    ob_start();
    print "<div>";
	print "<div style='font-size: 10px; text-align: center;'>&larr; ".$model_content_width." px &rarr;<br/>";		
	print "<span style='font-size: 10px;'>Content</span>\n";	
	get_option_selector ("", "content-color", $options_values['sidebar-color']);
	get_option_selector ("", "content-opacity", $options_values['sidebar-opacity']);
	get_option_selector ("", "content-border-style", $options_values['border-style']);				
	print "</div>";

	print "<table style='width: 100%;'>";
	print "<tr>";
	// left sidebar
	print "<td>";
	print "<div>Left Sidebar</div>\n";
	// hidden widgets warning
	if (is_active_sidebar("sidebar-1") && $options['left01-width'] == 0) {
		print "<span style='font-size: 10px;'>hidden widgets!</span>";
	}
	//width
	get_option_selector ("", "left01-width", $options_values['sidebar-width']);
	print "</td>";
	// Right sidebar
	print "<td style='text-align: right;'>";
	print "<div>Right Sidebar</div>\n";
	// hidden widgets warning
	if (is_active_sidebar("primary-widget-area") && $options['right01-width'] == 0) {
		print "<span style='font-size: 10px;'>hidden widgets!</span>";
	}
	// width
	get_option_selector ("", "right01-width", $options_values['sidebar-width']);
	print "</td>";
	print "</tr>";
	print "<tr>";
	print "<td></td>";
	// 2nd Right sidebar
	print "<td style='text-align: right;'>";
	print "<div>2nd Right Sidebar</div>\n";	
	// hidden widgets warning
	if (is_active_sidebar("secondary-widget-area") && $options['right02-width'] == 0) {
		print "<span style='font-size: 10px;'>hidden widgets!</span>";
	}
	// width
	get_option_selector ("", "right02-width", $options_values['sidebar-width']);
	print "</td>";
	print "</tr>";	
	print "</table>";
	print "</div>";

	$entry_options = ob_get_contents();
	ob_end_clean();

	return $entry_options;
}

function get_topmenu_options() {
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;	
    
    ob_start();
    print "<div>";
		print "<span style='padding-top: 0px; font-size: 10px; float: left;'>Menu Bar</span>";
		print "<div style='font-size: 8px; float: left;'>";
	
			get_option_selector ("", "top-color", $options_values['sidebar-color']);
			get_option_selector ("", "top-opacity", $options_values['sidebar-opacity']);
			get_option_selector ("", "top-border-style", $options_values['border-style']);
		
		print"</div>";

	print "</div>";

	$topmenu_options = ob_get_contents();
	ob_end_clean();

	return $topmenu_options;
}

function get_post_options() {
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;	
    
    ob_start();
    print "<div>";
	// post single sidebar options
	print "<div style='float: right; clear: left; font-size: 10px;'>\n";
	get_option_selector ("<span style='font-size: 9px;'>single post pages include</span>", "post-single-sidebar", $options_values['sidebar-display']);
	print "</div>";
	
	// author sidebar options
	print "<div style='float: right; clear: both; font-size: 10px;'>\n";
	get_option_selector ("<span style='font-size: 9px;'>author pages include</span>", "author-single-sidebar", $options_values['sidebar-display']);
	print "</div>";
	print "<div style='font-size: 9px;'>April 16th, 2009 by Author</div>";
					
	// category sidebar options				
	print "<div style='float: right; clear: both; font-size: 10px;'>\n";
	get_option_selector ("<span style='font-size: 9px;'>category archive includes</span>", "category-single-sidebar", $options_values['sidebar-display']);
	print "</div>";
	
	print "<div><span class='entry'>Categories: </span><span class='cat-links'><a href='#'>Category</a></span></div>";
	print "<div><br/>Lorem ipsum dolor sit amet, <span class='entry-visited'>visited link</span> adipiscing elit. Donec ac felis non mauris tristique vehicula. Nunc commodo, justo vel imperdiet cursus, leo dui <a href='#'>link</a>, vel bibendum neque justo nec ipsum. Aliquam erat volutpat. <a href='#'>another link</a> leo tellus, sagittis id mollis non, pretium a tellus.</div>";
	// tag sidebar options
	print "<div style='float: right; clear: left; font-size: 10px;'>\n";
	get_option_selector ("<span style='font-size: 9px;'>tag archive includes</span>", "tag-single-sidebar", $options_values['sidebar-display']);
	print "</div>";
	print "<div><span class='entry'>Tags: </span><span class='tag-links'><a href='#'>tag</a></span></div>";
	print "<div class='entry' style='text-align: right;'>No Comments &#187;</div><br/>";
	// search sidebar options
	print "<div style='float: right; clear: both; font-size: 10px;'>";
	get_option_selector ("<span style='font-size: 9px;'>search archive includes</span><br/>", "search-single-sidebar", $options_values['sidebar-display']);
	print "</div>";

	// archives sidebar options
	print "<div style=' font-size: 10px;'>";
	get_option_selector ("<span style='font-size: 9px;'>archives page includes</span><br/>", "archives-single-sidebar", $options_values['sidebar-display']);
	print "</div>";
				
	/*********************************************************
	 * Text, Link, Category and Tag options
	 *********************************************************/
	
	print "
	<hr/>
	<table width = '100%' cellpadding='0'>
	<tr><td valign='top'>	

		<table width = '100%' cellpadding='0'>
			<tr>
			<td style='border-bottom: 1px dotted;'><span style='font-size: 10px; color:".$options['textcolor'].";'>Text Alignment</span></td>							
			<td style='border-bottom: 1px dotted; text-align: right;'>";
			
			// text alignment options
			get_option_selector ("", "entry-text-align", $options_values['entry-text-align']);
			print "		 							
			</td>								
			</tr>						<tr>
			<td style='border-bottom: 1px dotted;'><span style='font-size: 10px; color:".$options['textcolor'].";'>Text</span></td>							
			<td style='border-bottom: 1px dotted; text-align: right;'>";
			
			// text color and sise options
			get_option_selector ("color", "textcolor", $options_values['textcolor']);
			get_option_selector ("size", "entry-text-size", $options_values['text-size']);
			print "		 							
			</td>								
			</tr>
			<tr>
			<td style='border-bottom: 1px dotted;'><span style='font-size: 10px; color:".$options['linkcolor'].";'>Link color</span></td>
			<td style='border-bottom: 1px dotted; text-align: right;'>";							
			// link color options
			get_option_selector ("", "linkcolor", $options_values['linkcolor']);
			print "
			</td>								
			</tr>						
		</table>
	</td><td valign='top' width='50%'>
		<table width = '100%' cellpadding='0'>
			<tr>";
			
			// category link style
			print "
			<td style='border-bottom: 1px dotted;'><span class='category' style='font-size: 10px;'><a href='#'>Category Link</a></span></td>
			<td style='border-bottom: 1px dotted; text-align: right;'>";						
			get_option_selector ("", "cat-links-color", $options_values['sidebar-color']);
			print "
			</td>								
			</tr><tr>";
			
			// Tag link style
			print "
			<td style='border-bottom: 1px dotted;'><span class='tag' style='font-size: 10px;'><a href='#'>Tag Link</a></span></td>
			<td style='border-bottom: 1px dotted; text-align: right;'>\n";							
			get_option_selector ("", "tag-links-color", $options_values['sidebar-color']);
			print "
			</td>
			</tr><tr>";
			// Entry link style
			print "
			<td style='border-bottom: 1px dotted;'><span class='entry' style='font-size: 10px;'><a href='#'>Entry Link</a></span></td>
			<td style='border-bottom: 1px dotted; text-align: right;'>\n";							
			get_option_selector ("", "entry-link-style", $options_values['entry-link-style']);
			print "
			</td></tr>
		</table>						
	</table>";
	print "</div>";

	$post_options = ob_get_contents();
	ob_end_clean();

	return $post_options;
}

function get_left01_options() {
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;	
   	global $current_widgets;
    
    ob_start();
    print "<div>";
	if ($options['left01-width'] != 0) {
		print "<div style='font-size: 10px; text-align: center; color: ".$options['left01-heading-color'].";'>&larr; ".$options['left01-width']." px &rarr;</div>";
		// opacity
		get_option_selector ("", "left01-opacity", $options_values['sidebar-opacity']);
		// color
		get_option_selector ("", "left01-color", $options_values['sidebar-color']);
		// border
		get_option_selector ("", "left01-border-style", $options_values['border-style']);
		

			if (is_active_sidebar("tertiary-widget-area")) {
				print "<div class='post-link' style='font-size: 10px; border: 1px dotted ".$options['left01-link-color'].";'>";
				print "<a href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>";
				print "</div><br/>";				
				if (is_array($current_widgets['tertiary-widget-area'])) {
					foreach ($current_widgets['tertiary-widget-area'] as $widget) {
						$widget = str_replace("-", " ", $widget);
						$widget = str_replace("_", " ", $widget);
						$widget = rtrim(ucwords($widget), "0..9");
						print "<div class='widgetbox' style='color: ".$options['left01-heading-color']."; border-color: ".$options['left01-heading-color'].";'>";
						print $widget;
						print "</div>";	
					}
				}
				
			} else {
				print "<div class='post-link' style='font-size: 10px; border-color: ".$options['left01-link-color']."'>";			
				print "<a style='color:".$options['left01-link-color'].";' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Add Widgets</a></div>";
				print "<div style='font-size: 10px; padding-left: 10px; color: ".$options['left01-heading-color'].";'>no widgets...</div>";
				print "<div style='font-size: 9px; padding-left: 10px; color: ".$options['left01-heading-color'].";'>add widgets or use defaults...</div>";
				//print "<div class='submit'><input type='submit' value='Add Default Widgets' name='default_widgets'/></div>";
			}					
	}
	print "</div>";
	
	$left01_options = ob_get_contents();
	ob_end_clean();

	return $left01_options;
}

function get_right01_options() {
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;	
   	global $current_widgets;
    
    ob_start();
    print "<div>";
	if ($options['right01-width'] != 0) {
		print "<div style='font-size: 10px; text-align: center; color: ".$options['right01-heading-color'].";'>&larr; ".$options['right01-width']." px &rarr;</div>";
		// opacity
		get_option_selector ("", "right01-opacity", $options_values['sidebar-opacity']);
		// color
		get_option_selector ("", "right01-color", $options_values['sidebar-color']);
		// border
		get_option_selector ("", "right01-border-style", $options_values['border-style']);
		

			if (is_active_sidebar("primary-widget-area")) {
				print "<div class='post-link' style='font-size: 10px; border-color: ".$options['right01-link-color'].";'>";
				print "<a style='' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>";
				print "</div><br/>";
				if (is_array($current_widgets['primary-widget-area'])) {
					foreach ($current_widgets['primary-widget-area'] as $widget) {
						$widget = str_replace("-", " ", $widget);
						$widget = str_replace("_", " ", $widget);
						$widget = rtrim(ucwords($widget), "0..9");
						print "<div class='widgetbox' style='color: ".$options['right01-heading-color']."; border-color: ".$options['right01-heading-color'].";'>";
						print $widget;
						print "</div>";	
					}
				}
				
			} else {
				print "<a style='color:".$options['right01-link-color'].";' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Add Widgets</a></div>";
				print "<div style='font-size: 10px; padding-left: 10px; color: ".$options['right01-heading-color'].";'>no widgets...</div>";
				print "<div style='font-size: 9px; padding-left: 10px; color: ".$options['right01-heading-color'].";'>add widgets or use defaults...</div>";
				//print "<div class='submit'><input type='submit' value='Add Default Widgets' name='default_widgets'/></div>";
			}					



	}
	print "</div>";
	
	$right01_options = ob_get_contents();
	ob_end_clean();

	return $right01_options;
}

function get_right02_options() {
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;	
   	global $current_widgets;

    
    ob_start();
    print "<div>";
	if ($options['right02-width'] != 0) {
		print "<div style='font-size: 10px; text-align: center; color: ".$options['right02-heading-color'].";'>&larr; ".$options['right02-width']." px &rarr;</div>";
		// opacity
		get_option_selector ("", "right02-opacity", $options_values['sidebar-opacity']);
		// color
		get_option_selector ("", "right02-color", $options_values['sidebar-color']);
		// border
		get_option_selector ("", "right02-border-style", $options_values['border-style']);
		

			if (is_active_sidebar("secondary-widget-area")) {
				print "<br/><br/><div class='post-link' style='font-size: 10px; border-color: ".$options['right02-link-color']."'>";
				print "<a href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>";
				print "</div><br/>";
				if (is_array($current_widgets['secondary-widget-area'])) {
					foreach ($current_widgets['secondary-widget-area'] as $widget) {
						$widget = str_replace("-", " ", $widget);
						$widget = str_replace("_", " ", $widget);
						$widget = rtrim(ucwords($widget), "0..9");
						print "<div class='widgetbox' style='color: ".$options['right02-heading-color']."; border-color: ".$options['right02-heading-color'].";'>";
						print $widget;
						print "</div>";	
					}
				}
				
			} else {
				print "<a style='color:".$options['right02-link-color'].";' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Add Widgets</a></div>";
				print "<div style='font-size: 10px; padding-left: 10px; color: ".$options['right02-heading-color'].";'>no widgets...</div>";
				print "<div style='font-size: 9px; padding-left: 10px; color: ".$options['right02-heading-color'].";'>add widgets or use defaults...</div>";
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

function get_footer_options() {
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;	
    
    ob_start();
    print "<div>";
		if (in_array("footer-bottom-color", $variation_config['model']))    
			print "<span style='padding-top: 0px; font-size: 10px; float: left;'>Footer Widgets</span>";
		print "<span class='horizontalbar' style='font-size: 8px'>";
			get_option_selector ("", "bottom-color", $options_values['sidebar-color']);
			get_option_selector ("", "bottom-opacity", $options_values['sidebar-opacity']);
			get_option_selector ("", "bottom-border-style", $options_values['border-style']);			 				
		print"</span>";		

	print "</div>";

	$footer_options = ob_get_contents();
	ob_end_clean();

	return $footer_options;
}

/******************************************************************************
 * Get First Footer widget options
 ******************************************************************************/

function get_footer_widgets($order) {
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;	
    global $current_widgets;
    
    ob_start();
	print "<div>";
		if (is_active_sidebar( $order.'-footer-widget-area' )) {
			foreach ($current_widgets[$order.'-footer-widget-area'] as $widget) {
				$widget = str_replace("-", " ", $widget);
				$widget = str_replace("_", " ", $widget);
				$widget = rtrim(ucwords($widget), "0..9");
				print "<div class='widgetbox' style='width: 150px; color: ".$options['bottom-heading-color']."; border-color: ".$options['bottom-heading-color'].";'>";
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

function footermeta_right() {
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;	
    
    ob_start();
	print "<div style='font-size: 9px; float: right; clear: left; color: ".$options['bgtextcolor'].";'>";
	print $options['theme-name']." | WordPress";
	print "</div>";

	$footermeta_right = ob_get_contents();
	ob_end_clean();

	return $footermeta_right;
}

/******************************************************************************
 * Get Footer meta left otions
 ******************************************************************************/

function footermeta_left() {
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;	
    
    ob_start();
    print "<div style='font-size: 9px;'>";

	if ($options['footerleft'] == "") {
		print "no links defined...";
	} else {
		print $options['footerleft'];
	}
	if ($options['footer-meta-left'] == 'custom') {
		print "
			<input id='footerleftdo' type='hidden' name='footerleftdo' value='0'/> - 
	
			<a href='javascript: document.getElementById(\"footerleftedit\").style.display = \"block\"; document.getElementById(\"footerleftdo\").value = \"1\"; exit;'>edit</a>
			
			<div id='footerleftedit' style='display: none;'>
			
			<textarea name='footerleftcustom' style='width: 100%; height: 50px; font-size: 10px;' class='code'>";
			print stripslashes(stripslashes(trim($options['footerleftcustom'])));
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
function get_footermeta_options() {
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;	
    
	ob_start();
	print "<div class='options'>";

    // footer meta left appgroups options		
	if (in_array("footer-meta-left", $variation_config['model'])) {
		print "<span style='font-size: 9px;'>Footer Links:</span>\n";
		print "<select name='footer-meta-left' style='font-size: 10px;'  onchange='this.form.submit();'>";
		
		foreach (array_keys($variation_config['footer_meta_left_options']) as $meta_left_option) {						
			print "<option value='".$variation_config['footer_meta_left_options'][$meta_left_option]['option_name']."' ";
			print ($options['footer-meta-left'] == $variation_config['footer_meta_left_options'][$meta_left_option]['option_name'] ? ' selected' : '') . ">";
			print $variation_config['footer_meta_left_options'][$meta_left_option]['option_label']."</option>";						
		}
		print "</select>";
		
	}
	
	print "</div>";

	$footermeta_options = ob_get_contents();
	ob_end_clean();
	return $footermeta_options;
}


/******************************************************************************
 * Get options that are included in basic mode
 ******************************************************************************/

function get_basic_options() {
	global $variation_config, $options;
	$basic_options = array();
	
	if (in_array('options-mode', $variation_config['model']) && $options['options-mode'] == "basic") {
		$basic_options[1]  = 'options-mode';
		$basic_options[2]  = 'site-options';
 		$basic_options[3]  = 'header-options';
// 		$basic_options[4]  = 'site-title-options';
// 		$basic_options[5]  = 'tagline-options';
// 		$basic_options[6]  = 'headermeta-options';
		$basic_options[7]  = 'site-width';
		//$basic_options[8]  = 'site-color';
		//$basic_options[9]  = 'site-opacity';
		//$basic_options[10]  = 'site-border-style';
		$basic_options[11]  = 'header-block-height';
		$basic_options[12]  = 'header-color';
		$basic_options[13]  = 'header-opacity';
		//$basic_options[14]  = 'header-border-style';
		$basic_options[15]  = 'left01-width';
		$basic_options[16]  = 'right01-width';
		$basic_options[17]  = 'right02-width';

		
	} else {
		$basic_options = $options;
	}
	return $basic_options;
}


/*********************************************************
 * Get select field for a given theme option
 *********************************************************/

function get_option_selector ($option_title, $option_name, $option_values, $state='dimmed') {
	global $variation_config, $options, $options_values;
	
	$basic_options = get_basic_options();
	$display_option = false;
	
	if ($options['options-mode'] == "basic") {		
		if (in_array($option_name, $basic_options)) $display_option = true;			
	} else {
		$display_option = true;
	}
	
	if ($state == "dimmed") {
		$state_css = "option-label-dimmed";
	} else if ($state == "active") {
		$state_css = "option-label";
	}
	
	if (in_array($option_name, $variation_config['model']) && $display_option == true) {
		print "<span style='white-space:nowrap;'>\n";
		if ($option_title != "") print " <span style='font-size: 10px;'>".$option_title."</span>\n";
		print "<select name='".$option_name."' style='font-size: 10px;' class='".$state_css."' onchange='this.form.submit();'>\n";							
			// options
			foreach ($option_values as $label => $value) {
				print "\n<option value='".$value."'".($options[$option_name] == $value ? ' selected' : '') . ">".$label."</option>";
			}					
		print "</select>\n";
		print "</span> &nbsp;\n";
	}

}

/*********************************************************
 * Get an input field for a given theme option
 *********************************************************/

function get_option_field ($option_title, $option_name, $option_field_width) {
	global $variation_config, $options, $options_values;

	$basic_options = get_basic_options();
	$display_option = false;
	
	if ($options['options-mode'] == "basic") {		
		if (in_array($option_name, $basic_options)) $display_option = true;			
	} else {
		$display_option = true;
	}

	if (in_array($option_name, $variation_config['model']) && $display_option == true) {			
		print "<span style='white-space:nowrap'>";
		if ($option_title != "") print "<span style='font-size: 10px;'>".$option_title."</span>\n";
		print "<input name='".$option_name."' class='color'  type='text' size='".$option_field_width."' style='font-size: 10px;' 
		value='".(isset($options[$option_name]) ? $options[$option_name] : '')."'/></span>";
	}
}

?>