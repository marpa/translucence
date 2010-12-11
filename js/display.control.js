// functions for toggling the display of sidebars in Translucence

function changeText(el, newText) {
	// Safari work around
	if (el.innerText) {
		el.innerText = newText;
	} else if (el.firstChild && el.firstChild.nodeValue) {
		el.firstChild.nodeValue = newText;
	}
}

function setToggleFromCookie (primary_width, secondary_width, tertiary_width, content_width) {
	var cookieprimary = document.cookie.indexOf("hideprimary=");
	var cookiesecondary = document.cookie.indexOf("hidesecondary=");
	var cookietertiary = document.cookie.indexOf("hidetertiary=");
	var cookietoc = document.cookie.indexOf("hidetoc=");
	
	cookieprimary = getCookie("hideprimary");
	cookiesecondary = getCookie("hidesecondary");
	cookietertiary = getCookie("hidetertiary");
	cookietoc = getCookie("hidetoc");
	
	if (cookieprimary > -1 && cookieprimary == 1) {
		toggle('primary', primary_width, secondary_width, tertiary_width, content_width);
	}
	if (cookiesecondary > -1 && cookiesecondary == 1) {
		toggle('secondary', primary_width, secondary_width, tertiary_width, content_width);
	}
	if (cookietertiary > -1 && cookietertiary == 1) {
		toggle('tertiary', primary_width, secondary_width, tertiary_width, content_width);
	}

	if (cookietoc > -1 && cookietoc == 1) {
		toggleToc();
	}

	
}

function toggle(obj, primary_width, secondary_width, tertiary_width, content_width) {
	var box = document.getElementById(obj);	
	var primarybox = document.getElementById('primary');
	var secondarybox = document.getElementById('secondary');
	var tertiarybox = document.getElementById('tertiary');
	//alert(box);
	
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
	
	if (box.style.width != box_width) {
		box.style.width = box_width;
		new_content_width = (Number(content_width) + Number(width_adjust) - Number(default_box_width))+"px";
		document.getElementById('content').style.width = new_content_width;
		widgetlist.style.display = 'block';
		document.cookie = "hide"+obj+"=0";
		changeText(toggleLink, "-");
	} else {
		box.style.width = '0px';
		new_content_width = (Number(content_width) + Number(width_adjust) + Number(default_box_width))+"px";
		document.getElementById('content').style.width = new_content_width;
		widgetlist.style.display = 'none';
		document.cookie = "hide"+obj+"=1";
		changeText(toggleLink, "+");
	}	
}

function getCookie(c_name)
{
if (document.cookie.length>0)
  {
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
	var toc = document.getElementById('toc').getElementsByTagName('ul')[0];
	var toggleLink = document.getElementById('togglelink');

	if (toc && toggleLink && toc.style.display == 'none') {
		changeText(toggleLink, "-");
		toc.style.display = 'block';
		document.cookie = "hidetoc=0";
	} else {
		changeText(toggleLink, "+");
		toc.style.display = 'none';
		document.cookie = "hidetoc=1";
	}
}

