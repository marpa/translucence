/**
 * Inline label v1.2.0
 * Tested with jQuery 1.3.x and 1.4.x.
 * Released under CC-BY-SA http://creativecommons.org/licenses/by-sa/2.5/se/
 * 
 * Usage: 	$('#id').inline_label();
 * 			$('#id').inline_label({text: "yada yada"}); // use text instead of label text
 * 			$('#id').inline_label({use_title: true}); // use the title instead of label text
 * 			$('#id').inline_label({css_class: "my_inline_label"}); // which css-class the field should use
 * 			$('#id').inline_label({hide_label: false}); // whether to hide the label or not
 * 
 * When using the text option, hide_label makes no difference.
 * 
 */
(function($) {
	
	$.inline_label = function(elem, options) {
		var t = $(elem);
		var text;
		if (options.text) {
			// if a text is defined, use that
			text = options.text;
		} else if (options.use_title) {
			text = t.attr('title');
		} else {
			// otherwise use the labels text
			if (!t.attr('id')) {
				throw "No id attribute found!";
			}
			var label = $('label[for='+t.attr('id')+']');
			// sanity checks
			if (label.length == 0) {
				throw "No label for "+t.attr('id')+"!";
			}
			if (label.length > 1) {
				throw "Too many labels for "+t.attr('id')+"!";
			}
			
			text = label.text();
			if (options.hide_label) {
				label.hide();
			}
		}
		
		// set up the focus hook
		t.focus(function() {
			if (t.val() == text) {
				t.val('');
			}
			if (options.css_class) {
				t.removeClass(options.css_class);
			}
			return t; // made chainable
		});
		
		// set up the blur hook
		t.blur(function() {
			if (t.val() == '') {
				t.val(text);
				if (options.css_class && !t.hasClass(options.css_class)) {
					t.addClass(options.css_class);
				}
			}
			return t;
		});
		
		// set up the change hook
		// when changing the field value programmatically, run .triggerHandler('change') to trigger this handler.
		t.change(function() {
			if (t.val() == '') {
				t.val(text);
			}
			if (options.css_class) {
				if (t.val() == text) {
					t.addClass(options.css_class);
				} else {
					t.removeClass(options.css_class);
				}
			}
			return t;
		});
		
		// bugfix from sendai, focus before bluring
		// bugfix from Lailson Bandeira, actually focusing and blur stuff below the fold
		//        scrolls the window, not good. Use triggerHandler instead of trigger.
		t.triggerHandler('change');
	};
	
	$.inline_label.version = 1.2;
	$.inline_label.defaults = {
		text: false,
		use_title: false,
		css_class: "inline_label",
		hide_label: true
	};
	
	$.fn.inline_label = function(options) {
		options = $.extend({}, $.inline_label.defaults, options || {});
		return this.each(function() {
			new $.inline_label(this, options);
		});
	};
	
})(jQuery);