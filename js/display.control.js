/**
 * functions for toggling the display of sidebars and page links in Translucence.
 *
 * @author Alex Chapin
 * @author Crystal Barton
 */


/**
 *
 */
jQuery(document).ready( function() {
	jQuery('.togglelink').click(function() { click_togglelink(this) });
	if (!is_mobile) setup_togglelinks();
});


/**
 *
 */
function setup_togglelinks()
{
	var sidebars = [ 'primary', 'secondary', 'tertiary' ];
	for( i  in sidebars )
	{
		var sidebar_id = sidebars[i];
		var show_sidebar = sessionStorage.getItem( sidebar_id );
		if( show_sidebar === false ) {
			sessionStorage.setItem( sidebar_id, 'show' );
		}
		else {
			if( show_sidebar === 'hide' ) {
				var sidebar = jQuery('#'+sidebar_id);
				if( sidebar.length === 0 ) continue;
				
				jQuery(sidebar).hide();
				jQuery('#content').width( jQuery('#content').width() + parseInt(jQuery(sidebar).attr('overall-width')) );
				jQuery("#content span.togglelink[sidebar='"+sidebar_id+"']").show();
			}
		}
	}
}


/**
 *
 */
function click_togglelink( togglelink )
{
	// get the sidebar object and its width.
	var sidebar_id = jQuery(togglelink).attr("sidebar");
	var sidebar = jQuery('#'+sidebar_id);
	if( sidebar.length == 0 ) return;
	var sidebar_width = parseInt(jQuery(sidebar).attr('overall-width'), 10);

	// get the current width of the content.
	var current_content_width = jQuery('#content').width();

	var margin_name = 'margin-right';
	var adj_object_id = 'content';
	switch( sidebar_id )
	{
		case "primary":
			break;
			
		case "secondary":
			margin_name = 'margin-right';
			if( jQuery('#primary').is(':visible') )
				adj_object_id = 'primary';
			break;
		
		case "tertiary":
			margin_name = 'margin-left';
			break;
			
		default:
			return; break;
	}
	
	var adj_object = jQuery('#'+adj_object_id);
	var current_margin = parseInt( jQuery(adj_object).css(margin_name).replace('px','') );
		
	var showing_sidebar = false;
	if( jQuery(sidebar).is(':visible') )
	{
		// hide the sidebar.
		jQuery(sidebar).hide();
		
		// change margin of adjacent object.
		jQuery(adj_object).css(margin_name, (current_margin + sidebar_width) + 'px');
		
		// animate content width change and adjacent object margin.
		if(adj_object_id == 'content')
		{
			var css = {};
			css['width'] = (current_content_width + sidebar_width) + 'px';
			css[margin_name] = current_margin + 'px';

			jQuery("#content").stop().animate( css, 100, 'linear' );
		}
		else
		{
			var css = {};
			css[margin_name] = current_margin + 'px';

			jQuery("#content").stop().animate( {
					width: (current_content_width + sidebar_width) + 'px'
				}, 100, 'linear'
			);

			jQuery(adj_object).stop().animate( css, 100, 'linear' );
		}
		
		sessionStorage.setItem(sidebar_id, 'hide');
	}
	else
	{
		showing_sidebar = true;
		if(adj_object_id == 'content')
		{
			var css = {};
			css['width'] = (current_content_width - sidebar_width) + 'px';
			css[margin_name] = (current_margin + sidebar_width) + 'px';

			jQuery("#content").stop().animate( css, 100, 'linear', function() {
				var css = {};
				css[margin_name] = current_margin + 'px';
				jQuery('#content').css(css);
				jQuery(sidebar).show();
			} );
		}
		else
		{
			var css = {};
			css[margin_name] = (current_margin + sidebar_width) + 'px';

			jQuery("#content").stop().animate( {
					width: (current_content_width - sidebar_width) + 'px'
				}, 100, 'linear'
			);

			jQuery(adj_object).stop().animate( css, 100, 'linear', function() {
				var css = {};
				css[margin_name] = current_margin + 'px';
				jQuery(adj_object).css(css);
				jQuery(sidebar).show();
			} );
		}
		
		sessionStorage.setItem(sidebar_id, 'show');
	}
	
	// get content togglelink element.
	if( showing_sidebar ) {
		jQuery("#content span.togglelink[sidebar='"+sidebar_id+"']").show();
	}
	else {
		jQuery("#content span.togglelink[sidebar='"+sidebar_id+"']").show();
	}
}


/**
 *
 */
function changeText(el, newText) 
{
	// Safari work around
	if (el.innerText) {
		el.innerText = newText;
	} else if (el.firstChild && el.firstChild.nodeValue) {
		el.firstChild.nodeValue = newText;
	}
}


/**
 *
 */
function getMetaValue (meta_name) 
{
	//alert (meta_name);
	var meta_elements = document.getElementsByTagName("META");
	for (var counter=0; counter<meta_elements.length; counter++) {
		if (meta_elements[counter].name.toLowerCase() == meta_name.toLowerCase()) {
			return meta_elements[counter].content;
		}
	}
}


/**
 *
 */
function getCookie(c_name) 
{
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


/**
 * Toggles the display of author pages on the author page
 */
function toggleToc() 
{
	//alert("update");
	var toc = document.getElementById('authorpages');
	
	if (toc) {
		
		var toc = toc.getElementsByTagName('ul')[0];
		//alert(toc);
		var toggleLink = document.getElementById('toggletoc');
		//alert(toc.style.display);
		if (toc && toggleLink && toc.style.display != 'block') {
			changeText(toggleLink, "[hide page links]");
			toc.style.display = 'block';
			document.cookie = "hidetoc=0";
		} else if (toc.style.display == 'block') {
			changeText(toggleLink, "[show page links]");
			toc.style.display = 'none';
			document.cookie = "hidetoc=1";
		}
	}
}


