/**
 * functions for toggling the display of sidebars and page links in Translucence.
 *
 * @author Alex Chapin
 * @author Crystal Barton
 */


/**
 *
 */
 
var box_margins = {};
 
jQuery(document).ready( function()
{
	if( !use_mobile_site)
	{
		get_box_margins();
		jQuery('.togglelink').click(function() { click_togglelink(this) });
		setup_togglelinks();
	}
	else
	{
		jQuery('.togglelink').click(function() { click_togglelink_mobile(this) });
	}
});


function get_box_margins()
{
	var boxes = [ 'content', 'primary', 'secondary', 'tertiary' ];
	for( i in boxes )
	{
		var box_id = boxes[i];
		var box = jQuery('#'+box_id);
		if( box.length === 0 ) continue;
		
		var marginLeft = parseInt(jQuery(box).css("marginLeft").replace('px', ''));
		var marginRight = parseInt(jQuery(box).css("marginRight").replace('px', ''));
	
		box_margins[box_id] = {
			'margin-left': marginLeft,
			'margin-right': marginRight,
		};
	}
	
	//alert( var_dump(box_margins) );
}

/**
 *
 */
function setup_togglelinks()
{
	var sidebars = [ 'primary', 'secondary', 'tertiary' ];
	
	for( i in sidebars )
	{
		var sidebar_id = sidebars[i];
		var show_sidebar = sessionStorage.getItem( sidebar_id );
		if( show_sidebar === false )
		{
			sessionStorage.setItem( sidebar_id, 'show' );
		}
		else
		{
			if( show_sidebar === 'hide' )
			{
				var sidebar = jQuery('#'+sidebar_id);
				if( sidebar.length === 0 ) continue;
				var sidebar_width = parseInt(jQuery(sidebar).attr('overall-width'), 10);

				// get the current width of the content.
				var current_content_width = jQuery('#content').width();

				var css = {};
				css['width'] = current_content_width + sidebar_width;

				var adj_sidebar_showing = false;
				var content_margin_name = '';
				switch( sidebar_id )
				{
					case "primary":
						if( jQuery('#secondary').is(':visible') )
							adj_sidebar_showing = true;
						content_margin_name = 'margin-right';
						break;
					case "secondary":
						if( jQuery('#primary').is(':visible') )
							adj_sidebar_showing = true;
						content_margin_name = 'margin-right';
						break;
					case "tertiary":
						content_margin_name = 'margin-left';
						break;
				}

				if( !adj_sidebar_showing )
				{
					css['width'] += box_margins['content'][content_margin_name];
					css[content_margin_name] = '0px';
				}
				
				jQuery(sidebar).hide();
				jQuery('#content').css( css );
			}
		}
	}
}



function click_togglelink_mobile( togglelink )
{
	// get the sidebar object and its width.
	var sidebar_id = jQuery(togglelink).attr("sidebar");
	var sidebar = jQuery('#'+sidebar_id);
	if( sidebar.length == 0 ) return;
	
	var sidebar_width = parseInt(jQuery(sidebar).attr('overall-width'), 10);

	switch( sidebar_id )
	{
		case "primary":
			var other_sidebars = [ 'secondary', 'tertiary' ];
			var content_margin_name = 'margin-right';
			break;
			
		case "secondary":
			var other_sidebars = [ 'primary', 'tertiary' ];
			var content_margin_name = 'margin-right';
			break;
		
		case "tertiary":
			var other_sidebars = [ 'primary', 'secondary' ];
			var content_margin_name = 'margin-left';
			break;
			
		default:
			return; break;
	}

	//------------------------------------------------------------------------------------
	// Hide, if visible.
	//------------------------------------------------------------------------------------

	if( jQuery(sidebar).is(':visible') )
	{
		var css = {};
		css[content_margin_name] = sidebar_width + 1;	

		jQuery(sidebar).hide();
		jQuery('#content').css( css );

		css['width'] = jQuery('#content').width() + parseInt( jQuery(sidebar).attr('overall-width') );
		css['margin-left'] = css['margin-right'] = '0px';	
		jQuery("#content").stop().animate( css, 100, 'linear' );


		return;
	}
		
	//------------------------------------------------------------------------------------
	// Hide other sidebars.
	//------------------------------------------------------------------------------------
	
	var css = {};
	css['width'] = jQuery('#content').width();

	for( var s in other_sidebars )
	{
		var sid = other_sidebars[s];
		if( jQuery('#'+sid).is(':visible') )
		{
			css['width'] += parseInt( jQuery('#'+sid).attr('overall-width') );
			jQuery('#'+sid).hide();
		}
	}

	css['margin-left'] = css['margin-right'] = '0px';	
	jQuery('#content').css( css );
	
	//------------------------------------------------------------------------------------
	// Show sidebar.
	//------------------------------------------------------------------------------------
	
	css = {};
	css[content_margin_name] = (sidebar_width + 1) + 'px';
	css['width'] = (jQuery('#content').width() - sidebar_width - 1) + 'px';
	
	jQuery("#content").stop().animate( css, 100, 'linear', function() {
		var css = {};
		css[content_margin_name] = '1px';
		jQuery('#content').css(css);
		jQuery(sidebar).show();
	} );
}

/**
 *
 */
function click_togglelink( togglelink )
{
	//alert( var_dump(box_margins) );

	// get the sidebar object and its width.
	var sidebar_id = jQuery(togglelink).attr("sidebar");
	var sidebar = jQuery('#'+sidebar_id);
	if( sidebar.length == 0 ) return;
	var sidebar_width = parseInt(jQuery(sidebar).attr('overall-width'), 10);

	// get the current width of the content.
	var current_content_width = jQuery('#content').width();

	var sidebar_margin_name = '';
	var adj_object_margin_name = '';
	var adj_object_id = '';
	switch( sidebar_id )
	{
		case "primary":
			sidebar_margin_name = 'margin-left';
			adj_object_id = 'content';
			adj_object_margin_name = 'margin-right';
			break;
			
		case "secondary":
			sidebar_margin_name = 'margin-left';
			adj_object_margin_name = 'margin-right';
			if( jQuery('#primary').is(':visible') )
				adj_object_id = 'primary';
			else
				adj_object_id = 'content';
			break;
		
		case "tertiary":
			sidebar_margin_name = 'margin-right';
			adj_object_id = 'content';
			adj_object_margin_name = 'margin-left';
			break;
			
		default:
			return; break;
	}
	
	var adj_object = jQuery('#'+adj_object_id);
	var adj_object_margin = box_margins[adj_object_id][adj_object_margin_name];
	
	var adj_sidebar_showing = false
	switch( sidebar_id )
	{
		case "primary":
			if( jQuery('#secondary').is(':visible') ) adj_sidebar_showing = true;
			break;
		case "secondary":
			if( jQuery('#primary').is(':visible') ) adj_sidebar_showing = true;
			break;
		case "tertiary":
			break;
	}

	if( jQuery(sidebar).is(':visible') )
	{
		//--------------------------------------------------------------------------------
		// Hiding the Sidebar.
		//--------------------------------------------------------------------------------
		
		// hide the sidebar.
		jQuery(sidebar).hide();
		
		// change margin of adjacent object.
		jQuery(adj_object).css(adj_object_margin_name, (adj_object_margin + sidebar_width) + 'px');
		
		// animate content width change and adjacent object margin.
		if(adj_object_id == 'content')
		{
			var css = {};
			if( adj_sidebar_showing )
			{
				css[adj_object_margin_name] = adj_object_margin + 'px';
				css['width'] = (current_content_width + sidebar_width) + 'px';
			}
			else 
			{
				css[adj_object_margin_name] = '0px';
				css['width'] = (current_content_width + sidebar_width + adj_object_margin) + 'px';
			}

			jQuery("#content").stop().animate( css, 100, 'linear' );
		}
		else
		{
			var css = {};
			css[adj_object_margin_name] = '0px';

			jQuery("#content").stop().animate( {
					width: (current_content_width + sidebar_width + adj_object_margin) + 'px'
				}, 100, 'linear'
			);

			jQuery(adj_object).stop().animate( css, 100, 'linear' );
		}
		
		// update session data for sidebar.
		sessionStorage.setItem(sidebar_id, 'hide');
	}

	else
	{
		//--------------------------------------------------------------------------------
		// Showing the sidebar.
		//--------------------------------------------------------------------------------
		
		if(adj_object_id == 'content')
		{
			var css = {};
			css[adj_object_margin_name] = (adj_object_margin + sidebar_width) + 'px';
			if( adj_sidebar_showing )
			{
				css['width'] = (current_content_width - sidebar_width) + 'px';
			}
			else 
			{
				css['width'] = (current_content_width - sidebar_width - adj_object_margin) + 'px';
			}

			jQuery("#content").stop().animate( css, 100, 'linear', function() {
				var css = {};
				css[adj_object_margin_name] = adj_object_margin + 'px';
				jQuery('#content').css(css);
				jQuery(sidebar).show();
			} );
		}
		else
		{
			var css = {};
			css[adj_object_margin_name] = (sidebar_width + adj_object_margin) + 'px';

			jQuery("#content").stop().animate( {
					width: (current_content_width - sidebar_width) + 'px'
				}, 100, 'linear'
			);

			jQuery(adj_object).stop().animate( css, 100, 'linear', function() {
				var css = {};
				css[adj_object_margin_name] = adj_object_margin + 'px';
				jQuery(adj_object).css(css);
				jQuery(sidebar).show();
			} );
		}
		
		sessionStorage.setItem(sidebar_id, 'show');
	}
}


function hide_sidebar( sidebar_id )
{
	jQuery('#'+sidebar_id).hide();
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




// http://kevin.vanzonneveld.net
// +   original by: Brett Zamir (http://brett-zamir.me)
// +   improved by: Zahlii
// +   improved by: Brett Zamir (http://brett-zamir.me)
// -	depends on: echo
// %		note 1: For returning a string, use var_export() with the second argument set to true
// *	 example 1: var_dump(1);
// *	 returns 1: 'int(1)'
function var_dump()
{
	var output = '',
	pad_char = ' ',
	pad_val = 4,
	lgth = 0,
	i = 0,
	d = this.window.document;
  
  	var _getFuncName = function (fn)
  	{
		var name = (/\W*function\s+([\w\$]+)\s*\(/).exec(fn);
		if (!name)
		{
			return '(Anonymous)';
		}
		return name[1];
	};

	var _repeat_char = function (len, pad_char)
	{
		var str = '';
		for (var i = 0; i < len; i++)
		{
			str += pad_char;
		}
		return str;
  	};

	var _getInnerVal = function (val, thick_pad)
	{
		var ret = '';
		if (val === null)
		{
			ret = 'NULL';
		}
		else if (typeof val === 'boolean')
		{
			ret = 'bool(' + val + ')';
		}
		else if (typeof val === 'string')
		{
			ret = 'string(' + val.length + ') "' + val + '"';
		}
		else if (typeof val === 'number')
		{
			if (parseFloat(val) == parseInt(val, 10))
			{
				ret = 'int(' + val + ')';
			}
			else
			{
				ret = 'float(' + val + ')';
			}
		}
		// The remaining are not PHP behavior because these values only exist in this exact form in JavaScript
		else if (typeof val === 'undefined')
		{
			ret = 'undefined';
		}
		else if (typeof val === 'function')
		{
			var funcLines = val.toString().split('\n');
			ret = '';
			for (var i = 0, fll = funcLines.length; i < fll; i++)
			{
				ret += (i !== 0 ? '\n' + thick_pad : '') + funcLines[i];
			}
		}
		else if (val instanceof Date)
		{
			ret = 'Date(' + val + ')';
		}
		else if (val instanceof RegExp)
		{
			ret = 'RegExp(' + val + ')';
		}
		else if (val.nodeName) // Different than PHP's DOMElement
		{
			switch (val.nodeType)
			{
				case 1:
					// Undefined namespace could be plain XML, but namespaceURI not widely supported
					if (typeof val.namespaceURI === 'undefined' || val.namespaceURI === 'http://www.w3.org/1999/xhtml')
					{
						ret = 'HTMLElement("' + val.nodeName + '")';
					}
					else
					{
						ret = 'XML Element("' + val.nodeName + '")';
					}
					break;
				case 2:
					ret = 'ATTRIBUTE_NODE(' + val.nodeName + ')';
					break;
				case 3:
					ret = 'TEXT_NODE(' + val.nodeValue + ')';
					break;
				case 4:
					ret = 'CDATA_SECTION_NODE(' + val.nodeValue + ')';
					break;
				case 5:
					ret = 'ENTITY_REFERENCE_NODE';
					break;
				case 6:
					ret = 'ENTITY_NODE';
					break;
				case 7:
					ret = 'PROCESSING_INSTRUCTION_NODE(' + val.nodeName + ':' + val.nodeValue + ')';
					break;
				case 8:
					ret = 'COMMENT_NODE(' + val.nodeValue + ')';
					break;
				case 9:
					ret = 'DOCUMENT_NODE';
					break;
				case 10:
					ret = 'DOCUMENT_TYPE_NODE';
					break;
				case 11:
					ret = 'DOCUMENT_FRAGMENT_NODE';
					break;
				case 12:
					ret = 'NOTATION_NODE';
					break;
			}
		}

		return ret;
	};

	var _formatArray = function (obj, cur_depth, pad_val, pad_char)
	{
		var someProp = '';
		if (cur_depth > 0)
		{
			cur_depth++;
		}

		var base_pad = _repeat_char(pad_val * (cur_depth - 1), pad_char);
		var thick_pad = _repeat_char(pad_val * (cur_depth + 1), pad_char);
		var str = '';
		var val = '';

		if (typeof obj === 'object' && obj !== null)
		{
			if (obj.constructor && _getFuncName(obj.constructor) === 'PHPJS_Resource')
			{
				return obj.var_dump();
			}
			lgth = 0;
			for (someProp in obj)
			{
				lgth++;
			}
			str += 'array(' + lgth + ') {\n';
			for (var key in obj)
			{
				var objVal = obj[key];
				if (typeof objVal === 'object' && objVal !== null && !(objVal instanceof Date) && !(objVal instanceof RegExp) && !objVal.nodeName)
				{
					str += thick_pad + '[' + key + '] =>\n' + thick_pad + _formatArray(objVal, cur_depth + 1, pad_val, pad_char);
				}
				else
				{
					val = _getInnerVal(objVal, thick_pad);
					str += thick_pad + '[' + key + '] =>\n' + thick_pad + val + '\n';
				}
			}
			str += base_pad + '}\n';
		}
		else
		{
			str = _getInnerVal(obj, thick_pad);
		}
		
		return str;
	};

	output = _formatArray(arguments[0], 0, pad_val, pad_char);
	for (i = 1; i < arguments.length; i++)
	{
		output += '\n' + _formatArray(arguments[i], 0, pad_val, pad_char);
	}
  
	return output; // added by Crystal Barton.

	if (d.body)
	{
		this.echo(output);
	}
	else
	{
		try
		{
			d = XULDocument; // We're in XUL, so appending as plain text won't work
			this.echo('<pre xmlns="http://www.w3.org/1999/xhtml" style="white-space:pre;">' + output + '</pre>');
		}
		catch (e)
		{
			this.echo(output); // Outputting as plain text may work in some plain XML
		}
	}
}

