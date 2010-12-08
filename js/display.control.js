// functions for toggling the display of sidebars in Translucence

function changeText(el, newText) {
	// Safari work around
	if (el.innerText) {
		el.innerText = newText;
	} else if (el.firstChild && el.firstChild.nodeValue) {
		el.firstChild.nodeValue = newText;
	}
}

function toggle(obj, primary_width, secondary_width, tertiary_width, content_width) {
	var box = document.getElementById(obj);	
	var primarybox = document.getElementById('primary');
	var secondarybox = document.getElementById('secondary');
	var tertiarybox = document.getElementById('tertiary');
	
	var widgetlist = box.getElementsByTagName('ul')[0];
	var toggle_link_element = "toggle"+obj;
	var toggleLink = document.getElementById(toggle_link_element);
	var default_box_width;
	var new_content_width;
	var current_primary_width;
	var current_secondary_width;
	var current_tertiary_width;
	

	switch (obj) {
	case "primary": 
		default_box_width = primary_width;
		break;
	case "secondary": 
		default_box_width = secondary_width;
		break;
	case "tertiary": 
		default_box_width = tertiary_width;
		break;
	}	

	
	
	if (primarybox != null) current_primary_width = primarybox.style.width.replace("px", "");
	if (secondarybox != null) current_secondary_width = secondarybox.style.width.replace("px", "");
	if (tertiarybox != null) current_tertiary_width = tertiarybox.style.width.replace("px", "");
	var width_adjust = 0;
	
	if (current_primary_width == 0) width_adjust = Number(primary_width);
	if (current_secondary_width == 0) width_adjust = width_adjust + Number(secondary_width);
	if (current_tertiary_width == 0) width_adjust = width_adjust + Number(tertiary_width);
	
	box_width = default_box_width+"px";
	//alert("style: "+box.style.width+"  default: "+box_width);
	//alert(box_width);
	
	if (box.style.width != box_width) {
		box.style.width = box_width;
		new_content_width = (Number(content_width) + Number(width_adjust) - Number(default_box_width))+"px";
		document.getElementById('content').style.width = new_content_width;
		widgetlist.style.display = 'block';
		document.cookie = "hidebox=0";
		changeText(toggleLink, "-");
	} else {
		box.style.width = '0px';
		new_content_width = (Number(content_width) + Number(width_adjust) + Number(default_box_width))+"px";
		document.getElementById('content').style.width = new_content_width;
		widgetlist.style.display = 'none';
		document.cookie = "hidebox=1";
		changeText(toggleLink, "+");
	}	
}