<?php 


/*********************************************************
 * ShadowBox theme options
 * renders UI and theme model for chosing and previewing options
 *********************************************************/

function theme_model() {
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;

 	$model_css = preg_replace("/body/", ".body_na", $variation_css); 
	$custom_background_color = get_background_color();
	$custom_background_image = get_background_image();
	$syndication_image = get_bloginfo('stylesheet_directory')."/variations/feed.png";
 	
 	//printpre ($custom_background_image);
//  	if ($custom_background_image) {
//  		$options['background_image'] = "url('".$custom_background_image."')";
//  		$options['background_repeat'] = get_theme_mod( 'background_repeat', 'repeat' );
//  		$options['background_attachment'] = get_theme_mod( 'background_attachment', 'scroll' );
//  		$options['background_position'] = get_theme_mod( 'background_position_x', 'left' );
//  	}
 
 	$model2_site_width = $options['site-width']+50;
 	$model_content_width = 

	$model_header_width = $options['site-width']-$options['custom-header-width-offset']-7;
	
	$model_page_width = $options['site-width']-$options['custom-header-width-offset']-7;
	$model_header_text_width = $model_site_width - 200;
	$model_content_width = $options['site-width'] - ($options['left01-width'] + $options['right01-width'] + $options['right02-width'] + 50);
	$model_site_width = $model_site_width."";
	$model_site_width_css = $model_site_width."px";


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
			color: #CCCCCC;
		}

		.option-label:hover {
			color: #333333;
		}
		
		.option-row {
			width: 100%;
			color: #333333;
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
		
		#content {
			width: ".$model_content_width."px;
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
	";
 	
 	print "</style>";

	print "
	<form id='settings' action='' method='post' class='themeform' style='margin: 20px;'>
	<input type='hidden' id='action' name='action' value='save'/>";

 	
	/******************************************************************************
	 * html from theme template files
	 * should contain most html from header.php, index.php and footer.php
	 * 
	 ******************************************************************************/

	print "<br/><br/>
	<div class='modelwrapper'>
		<div class='options'>
		".get_global_options()."
		</div>
		<div class='sitewrapper'> 	
			<div class='headermeta_right'> 
				<span class='bgtextcolor'>".headermeta_right()."</span><br/> 
			</div> 
			<div class='headermeta_left'> 
				<span class='bgtextcolor'>".headermeta_left()."</span><br/> 
			</div> 	
		</div> 
		<div id='wrapper'>
			<div id='header'>
				<div id='masthead'>
					<div id='branding'>
						<div class='headerblock'>
						<h1 id='site-title' class='title-box'><a href='index.php'>Translucence Template</a></h1>
						<div id='site-description' class='description-box'>A set of templates based on the Translucence Theme</div>
						</div>
					</div>
				</div>
				<div id='access' role='navigation'> 
					<!-- top navigation links -->
					<div class='menu-header'>
					</div>
				</div>
			</div>
			<div id='main'>
				<div id='container'>
					<div id='tertiary' class='widget-area'>
						<!-- left sidebar -->
						<h3 class='widget-title'>Left Sidebar</h3>
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
						<h2 class='entry-title'>Entry Title</h2>
						<div class='entry-content'>
							".get_entry_options()."
						</div>							
					</div>
					<div id='primary' class='widget-area' style=''>
						<!-- 1st right sidebar -->
						<h3 class='widget-title'>1st Right Sidebar</h3>
					</div>
					<div id='secondary' class='widget-area' style=''>
						<!-- 2nd right sidebar -->
						<h3 class='widget-title'>2nd Right Sidebar</h3>
					</div>
				</div><!-- #container -->
			</div><!-- #main -->
				<br/>
				<div id='colophon'></div><!-- #colophon --> 
				<div id='footer-widget-area'>
				<!-- footer -->
					<div id='first' class='widget-area'>
						<ul class='xoxo'>
							<h3 class='widget-title'>Footer Title</h3>
		
						</ul>
					</div>
					<div id='second' class='widget-area'>
						<ul class='xoxo'>
							<h3 class='widget-title'>Footer Title</h3>
		
						</ul>
					</div>
					<div id='third' class='widget-area'>
						<ul class='xoxo'>
							<h3 class='widget-title'>Footer Title</h3>
		
						</ul>
					</div>
					<div id='fourth' class='widget-area'>
						<ul class='xoxo'>
							<h3 class='widget-title'>Footer Title</h3>
		
						</ul>
					</div>
				</div>
		</div><!-- #wrapper -->
			
		<div class='sitewrapper'>  
			<div class='footermeta_right'> 
				<span class='bgtextcolor'>Footer meta right</span> 
			</div> 	 
			<div class='footermeta_left'> 
				<span class='bgtextcolor'>Footer meta left</span> 
			</div> 	
		</div><!-- #sitewrapper --> 
	</div><!-- modelwrapper --> 
";

print "
<table width = '".$model_site_width."' align='center' cellpadding='5' cellspacing='5' border='0'>
<tr><td>
<span class='submit'><input type='submit' value='Update' name='save'/></span>
</td><td>
<div class='instructions'>	
When chosing options think about colors and contrasts that complement your content.  For example, if your site focuses on links, be sure your link color contrasts with your 
text color so links will stand out.  Chose the black theme for blogs that highlight images.  <br/>
</div>
</td><td>
<span class='submit'><input type='submit' value='Revert to Default' name='reset'/></span>
</td></tr>
</table>
</form>";

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
	print "<div class='metatext'>";
	print $options['headerright'];
	
	// Log in link options
	if ($options['headermeta'] == "on") {
		print "Menus | Widgets | Design";
		print " | ".wp_get_current_user()->display_name;
		//print " - Log out";
	}
	
	print "</div>";
	$headermeta_right = ob_get_contents();
	ob_end_clean();
	return $headermeta_right;
}

function get_global_options() {
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;	
    
    $model2_site_width = $options['site-width']+30;
	ob_start();
	print "<table style='width: 100%;'>";
	print "<tr>";
	// background options	
	print "<td style='width: 60%; text-align: center; border-bottom: 1px solid; padding-bottom: 5px; '>";			
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
	print "</tr>";	
	print "</table>";
	print "<table style='width: 100%;'>";
	print "<tr>";

	// site width, color, opacity and border options
	print "<td class='option-row'>";
		//site width
		print "Site<span class='option-label'>";
		get_option_selector ("width:", "site-width", $options_values['site-width']);
		print "</span>";
		// site color
		print "<span class='option-label'>";
		get_option_selector ("color:", "site-color", $options_values['sidebar-color']);
		print "</span>";
		// site opacity
		print "<span class='option-label'>";
		get_option_selector ("opacity:", "site-opacity", $options_values['header-opacity']);
		print "</span>";
		// site border
		print "<span class='option-label'>";
		get_option_selector ("border:", "site-border-style", $options_values['border-style']);
		print "</span>";
	print "</td>";
	print "</tr>";
	print "<tr>";
	print "<td class='option-row'>";		
		// header height options
		print "Header<span class='option-label'>";
		get_option_selector ("height:", "header-block-height", $options_values['header-block-height']);
		print "</span>";
		
		// header color
		print "<span class='option-label'>";
		get_option_selector ("color:", "header-color", $options_values['sidebar-color']);
		print "</span>";

		// header opacity
		print "<span class='option-label'>";
		get_option_selector ("opacity:", "header-opacity", $options_values['header-opacity']);
		print "</span>";
		
		// header border
		print "<span class='option-label'>";
		get_option_selector ("border:", "header-border-style", $options_values['border-style']);
		print "</span>";
	print "</td>";	
	print "</tr>";
	print "<tr>";
	print "<td class='option-row'>";		
		// header-text-size options		
		if (in_array("site-title-size", $variation_config['model'])) {	
			print "Site Title<span class='option-label'>";
			get_option_selector ("size: ", "site-title-size", $options_values['header-text-size']);
			print "</span>";
		}
		// header-text-color options		
		if (in_array("site-title-color", $variation_config['model'])) {	
			print "<span class='option-label'>";
			get_option_field ("Color: #", "site-title-color", 6);
			print "</span>";
		}
		// header-text-offset options		
		if (in_array("header-text-shadow-offset", $variation_config['model'])) {	
			print "<span class='option-label'>";
			get_option_selector ("offset: ", "header-text-shadow-offset", $options_values['text-shadow-offset']);
			print "</span>";
		}	
		// header-text-blur options		
		if (in_array("header-text-shadow-blur", $variation_config['model'])) {	
			print "<span class='option-label'>";
			get_option_selector ("blur: ", "header-text-shadow-blur", $options_values['text-shadow-blur']);
			print "</span>";
		}

		// header-text-box options		
		if (in_array("title-box-color", $variation_config['model'])) {	
			print "Site Title box<span class='option-label'>";
			get_option_selector ("color: ", "title-box-color", $options_values['sidebar-color']);
			print "</span>";
		}
		if (in_array("title-box-opacity", $variation_config['model'])) {	
			print "<span class='option-label'>";
			get_option_selector ("opacity:", "title-box-opacity", $options_values['header-opacity']);
			print "</span>";
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
	print "<tr>";
	print "<td class='option-row'>";		
		// header-description-size options		
		if (in_array("site-description-size", $variation_config['model'])) {	
			print "Tagline<span class='option-label'>";
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
			print " <span class='option-group'>Tagline box</span><span class='option-label'>";
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
	
	print "</table>";
	
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
			</select>
			</span>";
		}
		print "</td>";
	
	print "</tr>";	
	print "</table>";

	$global_options = ob_get_contents();
	ob_end_clean();
	return $global_options;
}

function get_entry_options() {
	$entry_options = "entry options";
	return $entry_options;
}

/*********************************************************
 * Get select field for a given theme option
 *********************************************************/

function get_option_selector ($option_title, $option_name, $option_values) {
	global $variation_config, $options, $options_values;

	if (in_array($option_name, $variation_config['model'])) {
		print "<span style='white-space:nowrap;'>\n";
		if ($option_title != "") print " <span style='font-size: 10px;'>".$option_title."</span>\n";
		print "<select name='".$option_name."' style='font-size: 10px;' class='option-label' onchange='this.form.submit();'>\n";							
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

	if (in_array($option_name, $variation_config['model'])) {			
		print "<span style='white-space:nowrap'>";
		if ($option_title != "") print "<span style='font-size: 10px;'>".$option_title."</span>\n";
		print "<input name='".$option_name."' class='color'  type='text' size='".$option_field_width."' style='font-size: 10px;' 
		value='".(isset($options[$option_name]) ? $options[$option_name] : '')."'/></span>";
	}
}

?>