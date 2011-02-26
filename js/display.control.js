// functions for toggling the display of sidebars in Translucence

//jQuery(document).ready(function(){
	//alert("hello");
//});

function changeText(el, newText) {
	// Safari work around
	if (el.innerText) {
		el.innerText = newText;
	} else if (el.firstChild && el.firstChild.nodeValue) {
		el.firstChild.nodeValue = newText;
	}
}

function setToggleFromCookie (primary_width, secondary_width, tertiary_width, content_width) {
		
	//alert(cookieprimary+"-"+cookiesecondary+"-"+cookietertiary+"-"+cookietoc);
	// get all box cookies
	var cookieprimary = getCookie("hideprimary");
	var cookiesecondary = getCookie("hidesecondary");
	var cookietertiary = getCookie("hidetertiary");
	var cookietoc = getCookie("hidetoc");
	var toc = document.getElementById('toc');

	//alert(cookieprimary+"-"+cookiesecondary+"-"+cookietertiary+"-"+cookietoc);
	if (cookietoc != 0) {
		toggleToc();		
	} else {
		var toggleLink = document.getElementById('togglelink');
		changeText(toggleLink, "[hide page links]");
	}
	
	if (cookieprimary > -1 && cookieprimary == 1) {
		toggle('primary', 'sidebar', primary_width, secondary_width, tertiary_width, content_width);
	}
	if (cookiesecondary > -1 && cookiesecondary == 1) {
		toggle('secondary', 'sidebar', primary_width, secondary_width, tertiary_width, content_width);
	}
	if (cookietertiary > -1 && cookietertiary == 1) {
		toggle('tertiary', 'sidebar', primary_width, secondary_width, tertiary_width, content_width);
	}
	
	
	
}

// Toggle the visibility of the object, update content width to new context and update toggle links
function toggle(obj, context, primary_width, secondary_width, tertiary_width, content_width) {
	var box = document.getElementById(obj);	
	var primarybox = document.getElementById('primary');
	var secondarybox = document.getElementById('secondary');
	var tertiarybox = document.getElementById('tertiary');
	//alert(box);
	
	// initialize variable for:
	// all toggle links
	// current sidebar box widths
	// initial box width for box to be toogle
	// new content width
	if (box) {
		var widgetlist = box.getElementsByTagName('ul')[0];
		var toggle_link_element = "toggle"+obj;
		var toggle_context_element = "togglecontent"+obj;
		var toggleLink = document.getElementById(toggle_link_element);
		var togglecontextlink = document.getElementById(toggle_context_element);
		var default_box_width;
		var new_content_width;
		var current_primary_width;
		var current_secondary_width;
		var current_tertiary_width;	
		
		// get width of box to be toggled
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
		
		// get current widths of each box
		if (primarybox != null) current_primary_width = primarybox.style.width.replace("px", "");
		if (secondarybox != null) current_secondary_width = secondarybox.style.width.replace("px", "");
		if (tertiarybox != null) current_tertiary_width = tertiarybox.style.width.replace("px", "");
		var width_adjust = 0;
		
		if (current_primary_width == 0) width_adjust = Number(primary_width);
		if (current_secondary_width == 0) width_adjust = width_adjust + Number(secondary_width);
		if (current_tertiary_width == 0) width_adjust = width_adjust + Number(tertiary_width);
		
		// width of box to be toggled
		box_width = default_box_width+"px";
		
		// if current box width is NOT its default width 
		// update its width to default and set display to block
		// calculate new content width
		// change toggle link text to expand text
		// set document cookie to hide = 0	
		if (box.style.width != box_width) {
			box.style.width = box_width;
			box.style.display = "block";
			new_content_width = (Number(content_width) + Number(width_adjust) - Number(default_box_width))+"px";
			document.getElementById('content').style.width = new_content_width;
			widgetlist.style.display = 'block';
			document.cookie = "hide"+obj+"=0";
			
			// update toggle links based on context and location
			if (context == "content") {	
				if (obj == "tertiary") {
					changeText(togglecontextlink, "»");
				} else {
					changeText(togglecontextlink, "«");
				}
			} else if (obj == "tertiary") {
				changeText(toggleLink, "»");
			} else {
				changeText(toggleLink, "«");
			}
			
		// if current box IS its default width
		// update its width to 0 and set display to none
		// calculate new content width
		// change toggle link text to collapse text
		// set document cookie to hide = 1
		} else {
			box.style.width = "0px";
			box.style.display = "none";
			new_content_width = (Number(content_width) + Number(width_adjust) + Number(default_box_width))+"px";
			document.getElementById('content').style.width = new_content_width;
			widgetlist.style.display = 'none';
			document.cookie = "hide"+obj+"=1";
			if (obj == "tertiary") {
				changeText(togglecontextlink, "«");
			} else {
				changeText(togglecontextlink, "»");
			}
		}	
	}
}

function getCookie(c_name) {
	if (document.cookie.length>0) {
	  c_start=document.cookie.indexOf(c_name + "=");
	  if (c_start!=-1)
		{
		c_start=c_start + c_name.length+1;
		c_end=document.cookie.indexOf(";",c_start);
		if (c_end==-1) c_end=document.cookie.length;
		return unescape(document.cookie.substring(c_start,c_end));
		}
	  }
	return "";
}

function toggleToc() {
	//alert("update");
	var toc = document.getElementById('toc');
	if (toc) {
		toc = toc.getElementsByTagName('ul')[0];
		var toggleLink = document.getElementById('togglelink');
	
		if (toc && toggleLink && toc.style.display == 'none') {
			changeText(toggleLink, "[hide page links]");
			toc.style.display = 'block';
			document.cookie = "hidetoc=0";
		} else {
			changeText(toggleLink, "[show page links]");
			toc.style.display = 'none';
			document.cookie = "hidetoc=1";
		}
	}
}

function setThemeOptionsMode(value) {
	var oform = document.getElementById('settings');
	oform.elements['options-mode'].value = value;
	oform.submit();
}

