(function($) {
	
	/*------------------------------------*\
	    ANY
	    
	    This will return true if there are any items 
	    in a jQuery collection. 
	    
	    EXAMPLE
	    
	    var items = $(".item");
	    
	    if(items.any()) {
			console.log("YAY!");
		}
	\*------------------------------------*/
	
	$.fn.any = function() {
		return $(this).length > 0;
	};


    /*------------------------------------*\
        PARSE SETTINGS
        
        This will try and parse inline json settings as an object literal to pass into a plugin
        
        EXAMPLE
        
        <div class="item" data-settings='{"setting1": true}'></div>

        var item = $(".item"),
            settings = item.parseSettings();
        
        console.log(settings.setting1);
        
        returns true;

    \*------------------------------------*/
    $.fn.parseSettings = function () {

        var elem = $(this),
            response = {};

        if (elem.attr("data-settings")) {

            try {
                response = $.parseJSON(elem.attr("data-settings"));
            }
            catch (ex) {
                console.log("Check input data. Message: " + ex.message);
                return {};
            }
        }

        return response;
    };
    

    /*------------------------------------*\
        AJAX REQUEST
        
        A nice Ajax wrapper method
        
        EXAMPLE
        
        $.ajaxRequest({
            url: "/test",
            callback(function(data, isSuccess) {
                
                if(isSuccess) {
                    alert('All the data is WINNING');
                }
            });
        });

    \*------------------------------------*/
	$.extend({
		ajaxRequest: function(options) {
			
			var settings = {
                dataType: "application/json",
                url: "/",
                data: {},
                method: "GET",
                callback: null
			};
			
			var init = function() {
				
				settings = $.extend(true, {}, settings, options);

				$.ajax({
					contentType: settings.dataType, 
					url: settings.url,
					data: settings.data,
					type: settings.method,
					success: function(responseData) {
						tryCallback(responseData);
					},
					error: function(responseData) {
						tryCallback(responseData);
					}
				});
			},
			
			tryCallback = function(responseData) {
				
				if(typeof(settings.callback) == "function") {
					settings.callback(responseData, (responseData != null ? (responseData.status == 200 ? false : true) : true));
				}
			}
			
			init();
			
		}
	});

    /*------------------------------------*\
        AJAX HTML

        A wrapper to ajaxRequest for simple HTML getting

        EXAMPLE

        $.ajaxHtml('http://google.com', function(data) {
			// do stuff
		});

    \*------------------------------------*/
	$.extend({
		ajaxHtml: function(url, callback) {
			$.ajaxRequest({
				dataType: "text/html",
				url: url,
				callback: callback
			});
		}
	});


    /*------------------------------------*\
        QUERY STRING

        A helper to work with query strings

        toJson: take the current query string and return it as json
        fromJson: takes a json object and converts into a query string

    \*------------------------------------*/
    $.extend({
    	queryString: {

    		toJson: function(ignoreKeys) {
				var response = {},
					data = window.location.href.toString().toLowerCase(),
					splitData = [];

				// Return empty object if undefined
				if(typeof(data) == 'undefined') {
					return {};
				}

				// Return empty object if empty
				if(data.length == 0) {
					return {};
				}

				// Set empty array if ignore keys not set
				if(typeof(ignoreKeys) == 'undefined') {
					ignoreKeys = [];
				}

				// Split query string into array
				splitData = data.split('?')[1].split('&');

				// Loop and create key value pairs
				for (var i = 0, l = splitData.length; i < l; i++) {
				    var param = splitData[i].split('=');
				    response[param[0]] = param[1];
				}

				// Check ignore keys length
				if(ignoreKeys.length > 0) {

					// Loop each one and delete if exists
					$.each(ignoreKeys, function(i, val) {

						if(response.hasOwnProperty(val)) {
							delete response[val];
						}
					});

				}

				return response;
    		},

    		fromJson: function(data) {
    			return '?' + $.param(data).replace('?', '&');
    		}
    	}
    });
	
	
    /*------------------------------------*\
        ESC
        
        A useful little wrapper for the escape key press event
        
        EXAMPLE
        
		$.esc({
			callback: function(evt) {
				
				// Close your modal or whatever. Accessibility FTW
			}
		});

    \*------------------------------------*/
	$.extend({
		esc: function(options) {
			
			var settings = {
				callback: null
			}
			
			settings = $.extend(true, {}, settings, options);
			
			if(typeof(settings.callback) == 'function') {
				
				$(document).keyup(function(evt) {
					
					// escape key maps to keycode `27`
					if (evt.keyCode == 27) { 
						
						// run callback and pass the event over
						settings.callback(evt);
					}
				});	
			}

		}
	});

	/*------------------------------------*\
        GET BREAKPOINT

		Returns the current CSS breakpoint as defined in global.scss
	\*------------------------------------*/
	$.extend({
		getBreakpoint: function() {
			return window.getComputedStyle(document.querySelector('body'), ':before').getPropertyValue('content').replace(/\"/g, '');
		}
	});

    /*------------------------------------*\
        CHANGE EVENT

        A helper to return the correct 'change' event for an element

        EXAMPLE

        var event = $('.item').changeEvent();

    \*------------------------------------*/
    $.fn.changeEvent = function() {

    	var elem = $(this),
    		response = 'change';

			// Work out what the change event will be, based on input type
			switch(elem.prop('tagName').toString().toLowerCase()) {
				case 'input':

					if(elem.attr('type') != 'checkbox' && elem.attr('type') != 'radio') {
						response = 'input';
					}

					break;
			}

		return response;
    };
}(jQuery));

// TAKEN FROM David Walsh blog - http://davidwalsh.name/javascript-debounce-function
// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// N milliseconds. If `immediate` is passed, trigger the function on the
// leading edge, instead of the trailing.
function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		var later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
};
jQuery(document).ready(function ($) {

	/** Set up tabs and set Profile as active on load */
	$('#tabs.chumly').tabs({
		active: 3
	});

	/** Define selector for inputs form based on if tabs are in use */
	if ($('#tabs').length) {
		var live_tab         = $('.ui-tabs-nav li.ui-state-active'),
		    current_location = live_tab.attr('aria-controls'),
		    live_form        = $('#' + current_location);
	} else {
		var live_form        = $('form'),
		    current_location = $('form').attr('id');
	}

	/** When changing to another tab, redefine the live_form & current_location */
	$('#tabs').tabs({
		activate: function (event, ui) {
			live_tab = $('.ui-tabs-nav li.ui-state-active');
			current_location = live_tab.attr('aria-controls');
			live_form = $('#' + current_location);
		}
	});


	/** Add drag and drop sorting to inputs rows */
	$('#profile ul, #registration ul, #new-user ul, #required ul, #groups ul').sortable({
		handle: '.input-column-order',
		cancel: '.row-content',
		axis: 'y',
		update: function () {
			update_order_count();
		}
	});

	$("#sortable").disableSelection();


	/** Update order numbers on sort and delete of row */
	function update_order_count() {
		var count       = 0,
		    inputs_list = $('#' + current_location + ' ul').children('li.fields-input:not(.delete)');
		//console.log(inputs_list);

		inputs_list.each(function () {
			count++;
			//console.log(count);
			$(this).children('.input-column-order').html('<span class="circle">' + count + '</span>');
			//$(this).attr('id', 'item_' + count);
			$(this).children('.input_order').val(count);
		});
	}


	/** Toggle up and down action on inputs rows */
	$(document).on('click', '.input-column-name .row-title, .row-edit', function () {
		if ($(this).parents('.inputs-row').attr('data-active') == 'inactive') {
			var row_content = $(this).parents('.inputs-row').find('.row-content');
			$(this).parents('.inputs-row').css('border-bottom', 'none').attr('data-active', 'active');
			row_content.animate({height: row_content.get(0).scrollHeight}, 200);
		} else {
			$(this).parents('.inputs-row').css('border-bottom', '1px solid #E5E5E5').attr('data-active', 'inactive');
			$(this).parents('.inputs-row').find('.row-content').animate({height: 0}, 200);
		}
	});

	$('.close_row').on('click', function () {
		$(this).parents('.inputs-row').css('border-bottom', '1px solid #E5E5E5');
		$(this).parents('.row-content').animate({height: 0}, 200);
	});


	/** On page load, get the respective row content */
	$('.fields-input').each(function () {

		var input_location = $(this).parents('form').attr('id'),
		    row_id         = $(this).attr('id'),
		    input_type     = $(this).find('.input-type-select').find(':selected').val(),
		    ajax_function  = input_type + '_admin_markup',
		    input_data     = $(this).find('#stored_input_data').val().replace(/\\"/g, '"');

		//console.log(input_type);

		load_row_content(ajax_function, row_id, input_data, input_location, input_type);

	});


	/** Deactivate an input */
	$('form').on('click', '.row-active', function () {
		var deac_input = $(this).parents('.inputs-row').find('#input_active');

		if (deac_input.val() == 1) {
			deac_input.val(0);
			$(this).html('Activate');
		} else {
			deac_input.val(1);
			$(this).html('Deactivate');
		}
	});


	/** Save input fields */
	$('#save-fields').on('click', function () {
		$('.chumly.spinner').css('visibility', 'visible');
		$('.add-field-row, #save-fields').prop('disabled', 'disabled');

		$.ajax({
			url: chumly_vars.ajax_url,
			type: 'POST',
			data: {
				'action': 'save_fields',
				'data': live_form.serialize().replace(/\%5B/g, '[').replace(/\%5D/g, ']')
			},
			success: function (data) {
				$('#ajax-response-fields').prepend('Saved Fields');
				$('#ajax-response-fields').html(data);
				$('.chumly.spinner').css('visibility', 'hidden');
				$('.add-field-row, #save-fields').removeProp('disabled', 'disabled');

				//location.reload();
			}
		});
	});


	/** Create New Field */
	$('.add-field-row').on('click', function () {

		$('.add-field-row, #save-fields').prop('disabled', 'disabled');

		var input_group          = live_form.find('#input_group').val(),
		    // location_field_count = live_form.find('#field_count').val(),
		    user_type            = live_form.find('#user_type').val(),
		    // location_index       = live_form.find('#location_index').val(),
		    inputs_index         = $('#inputs_index').val(),
		    // new_field_count      = (parseInt(location_field_count) + 1),
		    // new_location_index   = (parseInt(location_index) + 1),
		    new_inputs_index     = (parseInt(inputs_index) + 1);

		console.log('Inputs Index:', inputs_index);

		$.ajax({
			url: chumly_vars.ajax_url,
			type: 'POST',
			data: {
				'action': 'load_new_field',
				'input_group': input_group,
				'input_location': current_location,
				// 'input_count': location_index,
				'inputs_index': new_inputs_index,
				'user_type': user_type
			},
			success: function (data) {

				live_form.children('.inputs-list').append(data);
				// live_form.children('#field_count').val(new_field_count);
				// live_form.children('#location_index').val(new_location_index);
				$('#inputs_index').val(new_inputs_index);

				console.log('New Inputs Index:', new_inputs_index);

				update_order_count();

				load_row_content('text_admin_markup', 'item_' + new_inputs_index, '', current_location, 'text');
				$('.add-field-row, #save-fields').removeProp('disabled', 'disabled');
			}
		});

	});


	/** Remove inputs row */
	$('form').on('click', '.row-delete', function () {

		$(this).parents('.inputs-row').find('#input_delete').val(true);

		$(this).parents('.inputs-row').fadeOut('fast', function () {

			$(this).addClass('delete').find('.row-content').remove();
			update_order_count();

		});

	});

	/** Function that gets the respective input type's row content and loads it into the markup */
	function load_row_content(ajax_function, row_id, input_data, input_location, input_type) {

		$('.add-field-row, #save-fields').prop('disabled', 'disabled');

		$.ajax({
			url: chumly_vars.ajax_url,
			type: 'POST',
			data: {
				'action': ajax_function,
				'row_id': row_id,
				'input_data': input_data,
				'input_location': input_location,
				'input_type': input_type,
				'input_group': $('#input_group').val()
			},
			success: function (data) {
				$('#' + input_location + ' #' + row_id + ' .input-column.input-type').html(input_type);
				$('#' + input_location + ' #' + row_id + ' .field-type-anchor').replaceWith(data);

				$('.row-loader').delay(1500).fadeOut('fast', function () {
					$('.input-row-actions').delay(1500).fadeIn('fast').addClass('active');
				});

				$('.add-field-row, #save-fields').removeProp('disabled', 'disabled');
			}
		});

	};


	/** Auto fill field_name with formatted field_label */
	$(document).on('focusout', '.input.input-label', function () {
		var label_value     = $(this).val(),
		    formatted_value = label_value.toLowerCase().replace(/\s/g, '_').replace(/[^\s\w\d]/g, '');

		$(this).parents('.inputs-row').find('.input-column-name .row-title').text(label_value);
		$(this).parents('.inputs-row').find('.input-column.input-name').text(formatted_value);
		$(this).parents('.row-content').find('.input-name').val(formatted_value);

	});


	/** Get respective row content when input changes */
	$(document).on('change', '.input-type-select', function () {
		console.log('Load New Content');
		$('.add-field-row, #save-fields').prop('disabled', 'disabled');
		var row_id        = $(this).parents('.inputs-row').attr('id'),
		    input_type    = $(this).val(),
		    ajax_function = input_type + '_admin_markup';

		console.log(live_form);
		console.log($('.ui-tabs-nav li.ui-state-active').attr('aria-controls'));


		$.ajax({
			url: chumly_vars.ajax_url,
			type: 'POST',
			data: {
				'action': ajax_function,
				'row_id': row_id
			},
			success: function (data) {
				$(live_form).find('#' + row_id + ' .input-data').remove();
				$(live_form).find('#' + row_id + ' .field-type-anchor').replaceWith(data);
				$(live_form).find('#' + row_id + ' .input-column.input-type').html(input_type);

				var total_height = 0;
				$(live_form).find('#' + row_id + ' tr').each(function () {
					total_height += $(this).outerHeight();
				});

				$(live_form).find('#' + row_id + ' .row-content').css('height', total_height + 'px');
				$('.add-field-row, #save-fields').removeProp('disabled', 'disabled');
			}
		});
	});



	/*
	@TODO Comment the below function
	 */
	$(document).on('change', '.funnel-select', function (event) {

		console.log('Funnel change', $(this));

		var elem         = $(this),
		    funnelAction = $(this).data('funnel_action'),
		    funnelValue  = $(this).find('option:selected').val();

		console.log(funnelAction);
		console.log(funnelValue);

		$.ajax({
			url: chumly_vars.ajax_url,
			type: 'POST',
			data: {
				'action': funnelAction,
				'funnelValue': funnelValue
			},
			success: function (data) {
				console.log($(this));
				var recipientElem = elem.siblings('.recipient-select');

				console.log(recipientElem, data);
				recipientElem.append(data);

			}
		})

	});

});
jQuery(document).ready(function ($) {

	if ($('.chumly').length > 0) {

		$('.openDrawer').click(function (e) {

			e.preventDefault();

			//Expand or collapse this panel
			$(this).parents('tr').next().slideToggle(600);

		});

		$('.closeDrawer').click(function () {

			//Expand or collapse this panel
			$(this).parents('tr').slideToggle();

		});

	}

});
//# sourceMappingURL=chumly_admin.js.map
