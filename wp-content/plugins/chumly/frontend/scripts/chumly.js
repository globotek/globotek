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
(function ($) {

	$.fn.chumlyAlert = function (childElem) {
		console.log('Alert');
		
		scrollOff();
		
		if(!childElem){
			childElem = false;
		}

		var elem        = $(this),
		    alertElem   = $(),
		    closeButton = elem.find('.chumly-alert__close'),
		    showButton  = elem.find('.chumly-alert__show'),
		    settings    = {
			    activeClass:      'is-active',
			    destroyOnClose:   true,
			    isAlertChildElem: childElem,
			    hideTimeout:      600
		    };
		console.log(elem);
		var init   = function () {

			    settings = $.extend(true, {}, settings, elem.parseSettings());

			    // Load alert elem based on setting
			    if (settings.isAlertChildElem) {
				    alertElem = elem.find('.chumly-alert__elem');
			    } else {
				    alertElem = elem;
			    }

			    // If there's a close button, add a listener
			    if (closeButton.any()) {

				    closeButton.on('click', function (evt) {
					    evt.preventDefault();
						console.log('Close Alert');
					    console.log(alertElem);
					    toggle('close');

						scrollOn();

				    });
			    }

			    // The same for show button
			    if (showButton.any()) {

				    showButton.on('click', function (evt) {

					    evt.preventDefault();

					    toggle('show');
				    });
			    }

		    },

		    // Hide or show alert element
		    toggle = function (command) {

			    switch (command) {
				    case 'close':
				    case 'hide':
				    default:

				    	$(document).chumlyModal('close');

					    alertElem.removeClass(settings.activeClass);
					    
						alertElem.removeClass(settings.activeClass);
						
					    // If required, wait a second then remove element
					    setTimeout(function () {

						    if (settings.destroyOnClose) {
							    alertElem.remove();
						    } else {
							    alertElem.css('visibility', 'hidden');
						    }

					    }, settings.hideTimeout);

					    break;

				    case 'show':
						alertElem.css('visibility', 'visible').addClass(settings.activeClass);
						
					    break;
			    }
		    };

		init();
		return this;
	};

}($));
/**
 * Created by matthew on 6/2/18.
 */

/**
 * When comment Reply button is clicked, focus the reply textarea
 */
$('.comments').on('click', '.chumly-toggle__trigger', function () {

    $(this).parent().find('textarea').focus();
    
});


/**
 * Focus & scroll to comment textara when Comment interaction button is clicked
 */
$('[data-interaction_action="comment"]').on('click', function (event) {
    console.log('Test 1');
    var post_id = $(this).data('post_id'),
        elem    = $('[data-comment_thread="' + post_id + '"]');

    elem.chumlyScrollTo(function () {
        elem.parents('.news-feed__item').find('.news-feed__item__comment-form textarea').focus();
    });

});


/**
 * Trigger save mechanism for comments
 */
$.fn.chumlyCommentFormTriggers = function () {

    var elem = $(this);

    elem.on('keydown', 'textarea', function (event) {

        if (event.keyCode == 13 && !event.shiftKey) {
    
            chumlyTriggerCommentSave($(this));

        }
        
    });
    
    elem.find('button').on('click', function(event){
       
        event.preventDefault();
    
        chumlyTriggerCommentSave(elem.find('textarea'));
        
    });

};


/**
 * Save a comment
 *
 * @param elem Textarea containing comment content
 */
function chumlyTriggerCommentSave(elem) {

    console.log('Test');
    event.preventDefault();

    if (elem.val().length > 0) {

        var comment      = elem.val(),
            post_id      = elem.data('post_id'),
            username     = elem.data('username'),
            user_id      = elem.data('user_id'),
            reply_parent = elem.parents('.comments__form--reply').data('reply_parent');

        console.log('Reply Parent:', reply_parent);
        console.log('Original Post:', post_id);
        console.log('Username:', username);
        console.log('User ID:', user_id);


        elem.val('');

        $.ajax({
            url: chumly_vars.ajax_url,
            method: 'POST',
            data: {
                'action': 'chumly_trigger_save_comment',
                'comment_content': comment,
                'post_id': post_id,
                'user_id': user_id,
                'comment_author': username,
                'comment_parent': reply_parent
            },
            success: function (data) {
                console.log('Comment Parent:', reply_parent);
                //console.log('Comment Saved Confirmation:', data);
                if (reply_parent) {

                    console.log('Nested Comment');

                    var elem = $('#nested_comments_' + reply_parent);
                    elem.append(data).chumlyScrollTo();
                    
                } else {
                    console.log('New Comment', post_id);
                    var elem = $('.new_comment_anchor[data-comment_thread="' + post_id + '"]');
                    elem.before(data).chumlyScrollTo();

                }

                $('.comments__item__inner').chumlyToggle().chumlyCommentFormTriggers();
                autosize($('textarea'));

            }
        });


    }

}


/**
 * Created by matthew on 31/5/18.
 */
$('.chumly form').validate({
    errorClass: 'is-error'
});


$('input[type="submit"]').on('click', function (event) {

    var form = $(this).parents('form');

    if (!form.valid()) {

        event.preventDefault();

    }

});


$('#new_form_row').on('click', function (event) {

    event.preventDefault();

    var trigger = $(this),
        count = parseInt(trigger.data('count')) + 1,
        lastRow = trigger.parents('.button-group').prev(),
        newRow = lastRow.clone(),
        newInputs = newRow.find('input');

    lastRow.after(newRow);

    newRow.hide().fadeIn(150);

    if (count == 1) {
        newRow.append('<button class="button button--negative button--small delete_form_row"><i class="fa fa-minus-circle"></i></button>');
    }

    $.each(newInputs, function (key, element) {

        var input = $(element),
            inputName = input.attr('name').replace(/\[\d*]/g, '[' + count + ']');

        input.attr('name', inputName);
        input.val('');

    });

    trigger.data('count', count);

});


$('input[type="radio"]').on('click', function () {

    $(this).parents('.form__group').find('input[type="radio"]').removeClass('active').parent('label').removeClass('button--primary');
    $(this).addClass('active').parent('label').addClass('button--primary');

});


$('input[type="file"]').on('change', function () {

    var filepath = $(this).val(),
        filename = filepath.substring(filepath.lastIndexOf('\\') + 1)

    $(this).prev().html(filename);

    console.log(filename);
});


$('input.datepicker').on('click', function () {

    $('.ui-datepicker').css('z-index', '10000');

});


$('body').on('click', '.delete_form_row', function (event) {

    event.preventDefault();

    var addTrigger = $('#new_form_row'),
        count = parseInt(addTrigger.data('count') - 1);

    console.log(count);

    $(this).parents('.form__group__inline').fadeOut(150, function () {
        $(this).remove();
    });

    addTrigger.data('count', count);

});

$('.datepicker').datepicker();
/**
 * Created by matthew on 15/1/18.
 */
$('.update_group').on('click', function (e) {
	
	e.preventDefault();
	
	console.log('Saving Group');
	
	var trigger   = $(this),
	    form      = trigger.parents('form'),
	    group_id  = form.find('input[name="group_id"]').val(),
	    form_data = new FormData(form[0]);

	if (form.valid()) {
		

		trigger.val('Updating...').attr('disabled', 'disabled');
		$('.upload__meter').css('visibility', 'visible');
		form_data.append('action', 'chumly_save_group');
		form_data.append('group_id', group_id);
		
		$.ajax({
			url:         chumly_vars.ajax_url,
			type:        'POST',
			processData: false,
			contentType: false,
			cache:       false,
			dataType: 'json',
			data:        form_data,
			success:     function (data) {

				$('#saved_response').html(data);

				console.log('Group save data:', data);
				console.log('Group save linked ID:', data.linked_post_id);

				
				chumlyUploadFiles(form, data.linked_post_id, 'group', null, function () {
					
					//	$('#ajax_response').empty().append(data);
					trigger.val('Update Group').removeAttr('disabled');
					
				});
				
				
			}
		});
		
	} else {
		
		console.log('Invalid form');
		
	}
	
});


$('#delete_group').on('click', function (e) {
	
	e.preventDefault();
	
	var trigger  = $(this),
	    group_id = trigger.data('group_id');
		
	$.ajax({
		url:      chumly_vars.ajax_url,
		type:     'POST',
		dataType: 'json',
		data:     {
			'action':   'chumly_delete_group',
			'group_id': group_id
		},
		success:  function (data) {
						
			if (data === 1) {
				
				chumlyAlertModal(trigger, 'success', 'Group deleted successfully', function(){
					window.location.replace('/newsfeed');
				});
				
			} else {
				
				chumlyAlertModal(trigger, 'error', 'There was an error deleting the group.<br>Please try again or contact support.');
				
			}
			
		}
	})
	
});


/**
 * Delete a user from a group
 */
$('.delete_group_member').on('click', function (event) {
	
	event.preventDefault();
	
	var elem = $(this);
	
	$.ajax({
		url:     chumly_vars.ajax_url,
		type:    'POST',
		data:    {
			'action':   'chumly_remove_group_member',
			'group_id': elem.data('group_id'),
			'user_id':  elem.data('user_id')
		},
		success: function (data) {
			
			elem.parents('li').fadeOut(400, 'swing', function () {
				$(this).remove();
			});
			
		}
	});
});


var current_user_id   = chumly_vars.user_id,
    current_timestamp = $.now();


$('button.group_connection_action').on('click', function () {
	
	var trigger           = $(this),
	    membership_status = trigger.attr('membership-status'),
	    target_id         = trigger.attr('connection-id'),
	    connection_action = trigger.attr('connection-action');
	
	//console.log(membership_status);
	
	//console.log(connection_action);
	//console.log(target_id);
	//console.log(current_user_id);
	// console.log(current_timestamp);
	
	$.ajax({
		url:      chumly_vars.ajax_url,
		type:     'POST',
		dataType: 'json',
		data:     {
			action:            'chumly_update_membership_state',
			current_user:      current_user_id,
			status:            membership_status,
			group_id:          target_id,
			connection_action: connection_action
		},
		success:  function (data) {
			
			//$('.chumly').prepend('<pre>' + JSON.stringify(data, null, 2) + '</pre>');
			
			//$('.hero').after('<pre>' + JSON.stringify(data, null, 2) + '</pre>');
			
			//data = $.parseJSON(data);
			console.log(data);
			console.log('Complete', trigger);
			
			
			trigger.removeAttr('class')
			.addClass('button ' + data.css_class)
			.attr('membership-status', data.status)
			.attr('connection-id', data.group_id)
			.attr('connection-action', data.action)
			.html(data.button_label);
			
		}
	});
	
});


$('.approve_group_member').on('click', function (event) {
	
	event.preventDefault();
	
	var elem     = $(this),
	    user_id  = elem.data('user_id'),
	    group_id = elem.data('group_id');
	
	$.ajax({
		url:     chumly_vars.ajax_url,
		type:    'POST',
		data:    {
			action:   'chumly_approve_group_member',
			user_id:  user_id,
			group_id: group_id
		},
		success: function (data) {
			
			elem.html('Approved').removeClass('approve_group_member');
			elem.siblings('.decline_group_member').remove();
			
		}
	})
	
});


$('.decline_group_member').on('click', function (event) {
	
	event.preventDefault();
	
	var elem     = $(this),
	    user_id  = elem.data('user_id'),
	    group_id = elem.data('group_id');
	
	$.ajax({
		url:     chumly_vars.ajax_url,
		type:    'POST',
		data:    {
			action:   'chumly_decline_group_member',
			user_id:  user_id,
			group_id: group_id
		},
		success: function (data) {
			
			elem.html('Declined').removeClass('decline_group_member');
			elem.siblings('.approve_group_member').remove();
			
		}
	})
	
})


/**
 * Created by matthew on 16/1/18.
 */

$.fn.chumlyConnect = function () {

	var trigger = $(this).find('[ajax-trigger="member_connection_action"]');
	
	trigger.on('click', function (event) {
		
		var	request_receiver_id = trigger.attr('target-user'),
			request_sender_id = chumly_vars.user_id,
			request_timestamp = $.now(),
			connection_status = trigger.attr('connection-status'),
			connection_id = trigger.attr('connection-id'),
			connection_action = trigger.attr('connection-action');
		
		event.preventDefault();
		console.log(request_receiver_id);
		console.log(connection_action);
		
		$.ajax({
			url: chumly_vars.ajax_url,
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'chumly_update_connection_state',
				receiver_id: request_receiver_id,
				sender_id: request_sender_id,
				timestamp: request_timestamp,
				status: connection_status,
				connection_id: connection_id,
				connection_action: connection_action
			},
			success: function (data) {
				//$('#connection_ajax_response').html(data);
				console.log(data);
				if (!trigger.hasClass('dropdown__menu__item')) {
					console.log('Is Button');
					trigger.removeAttr('class')
					.addClass('button button--small ' + data.css_class)
					.attr('connection-status', data.status)
					.attr('connection-id', data.connection_id)
					.attr('connection-action', data.connection_action)
					.html(data.button_label);
					
				} else {
					console.log('Is Dropdown');
					trigger.parents('.dropdown__inner').find('button').removeAttr('class')
					.addClass('button button--small ' + data.css_class)
					.attr('connection-status', data.status)
					.attr('connection-id', data.connection_id)
					.attr('connection-action', data.connection_action)
					.attr('target-user', data.target_user)
					.attr('ajax-trigger', 'member_connection_action')
					.html(data.button_label);
					
					trigger.parents('.dropdown__menu').remove();
					
				}
			},
			error: function (xhr, status, error) {
				var err = eval("(" + xhr.responseText + ")");
				console.log('Error: ', err.Message);
			}
		});
		
	});
	
};
	

/**
 * Created by matthew on 25/7/17.
 */
var search_results    = $('.search__results'),
    recipients_list   = $('.message-centre__feed__recipients .user-list'),
    message_window    = $('.message-centre__feed__content'),
    message_container = $('.message-centre__feed__content__inner');

function chumlyScrollMessages(duration) {
	$(message_window).animate({scrollTop: $(message_window)[0].scrollHeight}, duration);
}

if ($('.message-centre').length) {
	chumlyScrollMessages(0);
}

// Search for users
$('#find_recipient').on('keyup', function () {
	
	var elem         = $(this),
	    query_string = elem.val();
	
	if (elem.val() != '') {
		
		recipients_list.hide();
		search_results.show();
		
	} else {
		
		recipients_list.show();
		search_results.hide();
		
	}
	
	$.ajax({
		url:     chumly_vars.ajax_url,
		type:    'POST',
		data:    {
			action:        'chumly_search_members',
			query:         query_string,
			output_option: 'message_center'
		},
		success: function (data) {
			$('.search__results').html(data);
		}
	});
});


// Start conversation between users or load existing
$('.message-centre').on('click', '.user-list__item', function (event) {
	
	event.preventDefault();
	
	var elem = $(this);
	
	$('#find_recipient').val('');
	$('.message-centre .user-list__item').removeClass('is-active');
	
	elem.find('.unread_state').attr('class', 'icon unread_state is-hidden');
	elem.find('.read_state').attr('class', 'icon read_state is-visible');
	
	elem.removeClass('is-notification').addClass('is-active');
	
	search_results.hide();
	recipients_list.show();
	
	var trigger   = elem,
	    thread    = trigger.attr('thread_id'),
	    recipient = trigger.attr('receiver_id');
	
	$.ajax({
		url:      chumly_vars.ajax_url,
		type:     'POST',
		dataType: 'json',
		data:     {
			action:       'chumly_trigger_conversation',
			thread_id:    thread,
			recipient_id: recipient,
			sender_id:    chumly_vars.user_id
		},
		success:  function (data) {
			
			//console.log(data);
			
			$('#recipient_id').val(recipient);
			$('#thread_id').val(data.thread_id);
			$('.message-centre__feed__content__inner').html(data.messages);
			
			if (data.new_conversation == 1) {
				
				$('.message-centre__feed__recipients').find('.user-list').prepend('<li class="user-list__item is-active"  receiver_id="' + recipient + '" thread_id="' + data.thread_id + '">' +
					'<a href="#" class="user-list__item__inner user-list__item__inner--media-icon" role="button">' +
					'<div class="user-list__item__media user-list__item__media--small">' +
					'<figure class="avatar">' +
					'<img class="avatar__image" src="' + data.avatar_url + '"/>' +
					'</figure>' +
					'</div>' +
					'<div class="user-list__item__text">' +
					'<span class="user-list__item__text--primary">' + data.username + '</span>' +
					'</div>' +
					'<div class="user-list__item__icon">' +
					'<svg class="icon" aria-hidden="true">' +
					'<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="' + chumly_vars.plugin_url + 'frontend/images/icons/svg-symbols.svg#angle-right"></use>' +
					'</svg>' +
					'</div>' +
					'</a>' +
					'</li>'
				);
				
			} else {
				
				//console.log(data.thread_id);
				$('[thread_id=' + data.thread_id + ']').addClass('is-active');
				
			}
			
			chumlyScrollMessages(0);
			
		}
	});
	
});


function chumlyPollForMessage() {
	
	var lastLoadedMessage = message_container.find('.message').last().attr('timestamp');
	//console.log('polling');
	
	$.ajax({
		url:     chumly_vars.ajax_url,
		type:    'POST',
		data:    {
			action:       'chumly_poll_new_message',
			last_message: lastLoadedMessage,
			receiver_id:  $('#recipient_id').val(),
			thread_id:    $('#thread_id').val()
		},
		success: function (data) {
			
			var scroll_height   = message_window[0].scrollHeight,
			    scroll_position = message_window.scrollTop(),
			    feed_height     = message_window.height();
			
			message_container.find('.message').last().after(data);
			
			if ((scroll_height - feed_height) == scroll_position) {
				//console.log('Bottom');
				chumlyScrollMessages(0);
			}
		}
	});
	
}


$('#poll_message').on('click', function (e) {
	e.preventDefault();
	chumlyPollForMessage();
});


if ($('.message-centre').length) {
	setInterval(function () {
		chumlyPollForMessage();
	}, 1500);
}


$('#message_editor').keypress(function (event) {
	
	if (event.keyCode == 13 && event.shiftKey) {
		var content = this.value;
		var caret   = getCaret(this);
		
		this.value = content.substring(0, caret);
		event.stopPropagation();
		
	} else if (event.keyCode == 13) {
		
		$('#send_message').click();
		return false;
		
	}
	
});

function getCaret(el) {
	if (el.selectionStart) {
		
		return el.selectionStart;
		
	} else if (document.selection) {
		
		el.focus();
		var r = document.selection.createRange();
		
		if (r == null) {
			
			return 0;
			
		}
		
		var re = el.createTextRange(),
		    rc = re.duplicate();
		
		re.moveToBookmark(r.getBookmark());
		rc.setEndPoint('EndToStart', re);
		
		return rc.text.length;
	}
	
	return 0;
}

$('#send_message').on('click', function (e) {
	
	e.preventDefault();
	var messageContent = $('#message_editor').val(),
	    userdata       = chumly_vars.user_data,
	    profileImage   = chumly_vars.avatar;
	
	$('#message_editor').val('');
	
	message_container.find('.message').last().after('' +
		'<div class="message" timestamp="' + Math.floor(new Date().getTime() / 1000) + '">' +
		'<div class="message__media">' +
		'<figure class="avatar">' +
		'<img class="avatar__image" src="' + profileImage + '">' +
		'</figure>' +
		'</div>' +
		'<div class="message__content">' +
		'<a class="message__sender" href="#">' + userdata.data.display_name + '</a>' +
		'<div class="message__body wysiwyg" style="white-space: pre">' +
		messageContent +
		'</div>' +
		'</div>' +
		'</div>'
	);
	
	chumlyScrollMessages(1000);
	
	if ($.trim(messageContent)) {
		$.ajax({
			url:  chumly_vars.ajax_url,
			type: 'POST',
			data: {
				action:          'chumly_send_message',
				message_content: messageContent,
				receiver_id:     $('#recipient_id').val(),
				thread_id:       $('#thread_id').val()
			}
		});
	}
});


/**
 * Created by matthew on 25/7/17.
 */
function misc() {
	
	autosize($('textarea'));
	
	var userMenu   = $('.user-menu__text'),
	    sourceElem = $('.user-menu__text').parents('.chumly').parents('ul').find('a').first(),
	    fontFamily = sourceElem.css('font-family'),
	    fontSize   = sourceElem.css('font-size');
	
	userMenu.css('font-family', fontFamily);
	userMenu.css('font-size', fontSize);
	
	$("a[rel^='prettyPhoto']").prettyPhoto({
		social_tools: ''
	});
	
	
	tinymce.init({
		selector:                    '#profile_10',
		mode:                        "exact",
		elements:                    'pre-details',
		theme:                       "modern",
		skin:                        "lightgray",
		menubar:                     false,
		statusbar:                   false,
		toolbar:                     [
			"bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | undo redo"
		],
		plugins:                     "paste",
		paste_auto_cleanup_on_paste: true,
		paste_postprocess:           function (pl, o) {
			o.node.innerHTML = o.node.innerHTML.replace(/&nbsp;+/ig, " ");
		}
	});
		
}
/**
 * Created by matthew on 8/2/18.
 */
(function ($) {		
	
	$.fn.chumlyModal = function (method) {
		
		var elem = $(this),
		    triggers = elem.find('.chumly-modal__trigger'),
			target = elem.find('.modal'),
			settings = {
				activeClass: 'is-active',
				visibleClass: 'is-active'
			};
		
			var init = function (method) {
				
				triggers.off('click').on('click', function (event) {

					event.preventDefault();
					
					var trigger = $(this);
					
					if (target.hasClass(settings.activeClass)) {
						toggle(target, 'off');
					} else {
						toggle(target, 'on');
						var postID = trigger.data('post_id');
						
						target.find('.modal__header, .modal__body').remove();
						
						loadPost(postID, function(){
							
							target.find($('input[name="loaded_post_id"]')).val(postID);
							target.find($('.chumly .search')).chumlySearch();
							toggleHeaderContent();
							target.find('.modal__footer').addClass('is-active');
						});
					}
					
				});
			},
			
			toggle = function (target, state) {
				
				switch (state) {
					case 'off':
					default:
	
						scrollOn();
						target.removeClass(settings.visibleClass);
						target.css('visibility', 'hidden').find('.modal__inner').removeClass(settings.visibleClass);
						
						break;
					case 'on':

						scrollOff();
						target.css('visibility', 'visible').addClass(settings.visibleClass);
						//target.find('.modal__inner').css('visibility', 'visible').addClass(settings.visibleClass);
					
						break;
				}
			},
			
			loadPost = function (postID, callback) {
				
				$.ajax({
					url: chumly_vars.ajax_url,
					type: 'POST',
					data: {
						'action': 'chumly_load_modal_body',
						'modal_template': target.data('modal_template'),
						'post_id': postID
					},
					success: function (data) {
						target.find('.modal__inner').addClass('is-active').prepend(data);
						callback();
						
					}
				});
				
			},
			
			toggleHeaderContent = function(callback){
				
				var selector = target.find($('select[name="target_select"]'));
				
				selector.on('change', function(){
					var targetElem = $('.' + $(this).val());
					
					target.find($('.search').parent().addClass('is-hidden').removeClass('is-active'));
					targetElem.removeClass('is-hidden').addClass('is-active');
					target.find($('.search__output')).empty();
					
					if(callback) {
						callback();
					}
				});
				
			};
		
		
		if (method == 'close') {
			
			toggle(target);
			
		} else if (method == 'open') {
			
			toggle(target, 'on');
			
		} else {
			
			init();
			
		}
		
		return this;
		
	};

}(jQuery));
/**
 * Created by matthew on 21/6/18.
 */
(function ($) {
	
	$.fn.chumlyNotification = function () {
		
		var elem    = $(this),
		    trigger = elem.find('svg'),
		    ID      = elem.data('notification_id');
		
		var init                  = function () {
			
			    elem.on('click', 'a', function () {
							    
				    markNotificationsRead(ID);
				
			    });
			
			    trigger.on('click', function (event) {
				
				    var action = $(this).parent().data('action');
				
				    if (action) {
					    event.preventDefault();
				    }
				
				    if (action == 'mark_notifications_read') {
					
					    markNotificationsRead(ID);
					
				    }
				
			    });
			
		    },
		    markNotificationsRead = function (ID, callback) {
			
			    $.ajax({
				    url:     chumly_vars.ajax_url,
				    type:    'POST',
				    data:    {
					    action:          'chumly_mark_notification_read',
					    notification_id: ID
				    },
				    success: function (data) {
					
					    elem.removeClass('notification--unread');
					
					    var notificationIndicator = $('.user-menu__indicator.notifications'),
					        count                 = notificationIndicator.html();
					
					    if (count > 1) {
						
						    notificationIndicator.html((count - 1));
						
					    } else {
						
						    notificationIndicator.hide();
						
					    }
					
					    if(callback){
						    callback();
					    }
					    
				    }
			    });
			
		    }
		
		
		init();
		
	}
	
}(jQuery));
/**
 * Created by matthew on 24/10/18.
 */
function chumlyLoadFeedTemplate(post_id, post_format, post_type) {
	
	$.ajax({
		url:     chumly_vars.ajax_url,
		type:    'POST',
		data:    {
			action:      'chumly_load_feed_part',
			post_id:     post_id,
			post_format: post_format,
			post_type:   post_type
		},
		success: function (template) {
			//console.log('Loading template', template);
			$('.news-feed').prepend(template).chumlyCommentFormTriggers();
			$('.news-feed__item').first().chumlyScrollTo();

			$('body').find($('a[rel="prettyPhoto"]')).prettyPhoto({
				social_tools: ''
			});
			
		}
	});
	
}

/**
 * Created by matthew on 15/11/17.
 */
/**
 * TRIGGER PROFILE SAVE PROCESS
 *
 * Run the processes to upload files and
 * update a user profile.
 */
$('.chumly').on('click', '.update_profile', function (event) {
	
	chumlyPrepareProfileForm(event, $(this));
		
});


/** PROCESS FORM
 *
 * Process anything that's required before the form is submitted
 * such as saving the tinyMCE content to the textarea.
 *
 */
function chumlyPrepareProfileForm(event, trigger) {
	
	event.preventDefault();
	
	var form          = trigger.parents('form'),
	    tinymceEditor = $(form).find('textarea.form__group__field--wysiwyg');
	
	if (tinymceEditor.length) {
		
		tinymce.get(tinymceEditor.attr('id')).save();
		
		chumlySaveProfile(trigger);
		
	} else {
		
		//console.log('No tinyMCE');
		chumlySaveProfile(trigger);
		
	}
	
}

/** SAVE PROFILE
 *
 * Save Chumly profile data
 *
 * @param event Event from trigger - e.g. click
 * @param trigger The element which has triggered the event
 */
function chumlySaveProfile(trigger) {
	
	var form      = trigger.parents('form'),
	    formData = new FormData(form[0]);
	
	formData.append('action', 'chumly_update_profile');
		
	if(form.valid()) {
		
		trigger.val('Updating...').attr('disabled', 'disabled');
		
		$.ajax({
			url:         chumly_vars.ajax_url,
			type:        'POST',
			processData: false,
			contentType: false,
			cache:       false,
			data:        formData,
			success:     function (data) {
				
				$('#ajax_testing').html(data);
				console.log('Success');
				if ($(form).find('input[type="file"]').length) {
					
					chumlyUploadFiles(form, 0, null, null, function () {

						chumlyPrompt(trigger, 'success', 'Success!', "Your profile has been updated. <a href='/profile'>Go back to your profile?</a>");
						trigger.val('Update Profile').removeAttr('disabled');
						
					});
					
				} else {

					chumlyPrompt(trigger, 'success', 'Success!', "Your profile has been updated. <a href='/profile'>Go back to your profile?</a>");
					trigger.val('Update Profile').removeAttr('disabled');
					
				}
				
			}
			
		});
		
	}
	
}

/**
 * Created by matthew on 18/10/18.
 */
(function($) {
	
	$.fn.chumlyPrompt = function(method) {
		var elem = $(this),
		    promptElem = $(),
		    closeButton = elem.find('.chumly-prompt__close'),
		    showButton = elem.find('.chumly-prompt__show'),
		    settings = {
			    activeClass: 'is-active',
			    destroyOnClose: true,
			    isAlertChildElem: false,
			    hideTimeout: 600
		    };

		var init = function(method) {
				console.log('Prompt INIT', elem);
			    settings = $.extend(true, {}, settings, elem.parseSettings());

			    // Load alert elem based on setting
			    if(settings.isAlertChildElem) {
				    promptElem = elem.find('.chumly-prompt__elem');
			    } else {
				    promptElem = elem;
			    }

			    // If there's a close button, add a listener
			    if(closeButton.any()) {

				    closeButton.on('click', function(evt) {
					    evt.preventDefault();

					    toggle('close');

				    });

			    }

			    // The same for show button
			    if(showButton.any()) {

				    showButton.on('click', function(evt) {

					    evt.preventDefault();

					    toggle('show');
				    });

			    }

			    if(method == 'show'){
				    toggle('show');
			    }

		    },

		    // Hide or show alert element
		    toggle = function(command) {

			    switch(command) {
				    case 'hide':
				    default:
						console.log('Prompt Hide', promptElem);
						scrollOn();
					    promptElem.removeClass(settings.activeClass);

					    // If required, wait a second then remove element
					    setTimeout(function() {

						    if(settings.destroyOnClose) {
							    elem.remove();
						    } else {
							    promptElem.css('visibility', 'hidden');
						    }

					    }, settings.hideTimeout);

					    break;

				    case 'show':
						console.log('Prompt Show', promptElem);
					    $(document).chumlyModal('close');
						scrollOff();
					    promptElem.css('visibility', 'visible').addClass(settings.activeClass);
					    break;
			    }
		    };
		
		init(method);

		return this;

	};
	
}($));


function chumlyPrompt (target, alertType, promptTitle, promptMessage, callback) {
	
	//console.log(chumly_vars);

	var output = $('<div class="chumly-prompt" data-module="chumly-prompt" data-settings=\'{"destroyOnClose": true, "isAlertChildElem": true}\'>' +
		//'<button class="button chumly-prompt__show">Show Default Prompt</button>' +
		'<div class="prompt chumly-prompt__elem prompt--' + alertType + '" role="alert" style="visibility: hidden">' +
		'<div class="prompt__window">' +
		'<div class="prompt__header">' +
		'<h3 class="prompt__heading">' + promptTitle + '</h3></div>' +
		'<div class="prompt__content wysiwyg">' +
		'<p>' + promptMessage + '</p>' +
		'</div>' +
		'<div class="prompt__button">' +
		'<button class="button chumly-prompt__close">Okay, thanks</button>' +
		'</div>' +
		'</div>' +
		'<div class="prompt__overlay chumly-prompt__close" aria-hidden="true"></div>' +
		'</div>' +
		'</div>');
		
	
	//var output = '<div class="alert__modal" data-module="chumly-modal">' +
	//	'<div class="modal is-active" style="visibility: visible">' +
	//	'<div class="modal__inner is-active" style="visibility: visible">' +
	//	'<div class="alert chumly-alert__elem is-active alert--' + alertType + '" data-module="chumly-alert" role="alert">' +
	//	'<div class="alert__content">' + message + '</div>' +
	//	'<button class="alert__close chumly-alert__close">' +
	//	'<span class="is-hidden--text">Click here to close this alert</span>' +
	//	'<svg aria-hidden="true" class="alert__content__icon icon" aria-hidden="true">' +
	//	'<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="' + chumly_vars.plugin_url + 'frontend/images/icons/svg-symbols.svg#cross"></use>' +
	//	'</svg>' +
	//	'</button>' +
	//	'</div>' +
	//	'</div>' +
	//	'<div class="modal__mask chumly-modal__trigger"></div>' +
	//	'</div>' +
	//	'</div>';
	
	
	target.parents('.chumly').prepend(output);
	
	output.chumlyPrompt('show');
	
	if(callback){
		callback();
	}
	
	/*$.ajax({
		url:     chumly_vars.ajax_url,
		type:    'POST',
		data:    {
			'action':     'chumly_load_alert_modal',
			'alert_type': alertType,
			'message':    message
		},
		success: function (data) {
			//console.log(data);
			//modal.empty().append(data);
			
			target.parents('.chumly').append(data).chumlyModal().chumlyAlert(true);
			
			if (callback) {
				
				callback();
				
			}
			
		}
	});*/
	
}
	

/**
 * Created by matthew on 25/7/17.
 */
/**
 * TRIGGER POST CREATION PROCESS
 *
 * Run the processes to upload files
 * and create a post.
 */
$('.chumly form.editor').find('input, textarea').on('change keyup', function (event) {
	//console.log(event);
	var form         = $(this).parents('form'),
	    text         = form.find('textarea'),
	    submitButton = form.find('#status_submit');
	
	if(event.keyCode != 13) {
		
		if ($.trim(text.val())) {
			
			submitButton.removeAttr('disabled');
			
		} else {
			
			submitButton.attr('disabled', 'disabled');
			
		}
		
		$.each(form.find('input[type="file"]'), function (index, value) {
			
			if (value.files.length > 0) {
				
				//console.log('has files');
				submitButton.removeAttr('disabled');
			}
			
		});
		
	}
	
});

$('#status_submit').on('click', function (event) {
	
	chumlySaveStatusPost(event, $(this), $(this).parents('form'));
	
});

$('.chumly form.editor textarea').on('keydown', function (event) {
	
	var form         = $(this).parents('form'),
	    text         = $(this),
	    submitButton = form.find('#status_submit');
	
	if (event.which == 13) {
		
		event.preventDefault();
		
		if ($.trim(text.val())) {
			
			chumlySaveStatusPost(event, submitButton, form);
			
		}
		
	}
	
});

$(document).on('click', '.share_post', function (event) {
	//console.log('Modal submitting...');
	chumlyShareStatusPost(event, $(this), $(this).parents('.modal').find('.modal__body form'));
	
});


/**
 * SAVE POST
 *
 * Save posts from the Post Form such as the
 * status post form on the default profile page.
 *
 * @param event Event from trigger - e.g. click
 * @param trigger The element which has triggered the event
 */
function chumlySaveStatusPost(event, trigger, form) {
	/**
	 * Submit a post status to the database and load into news feed
	 */
	event.preventDefault();
	console.log('Saving Post...');
	var form_data      = new FormData(form[0]),
	    upload_trigger = false,
	    post_format    = form.find('input[name="post_format"]').val();

	if(!trigger.prop('disabled')) {
		
		trigger.attr('disabled', 'disabled').text('Saving...');
		
		$.each($(form).find('input[type="file"]'), function (index, value) {
			
			if (value.files.length > 0) {
				
				form_data.append('has_files', true);
				post_format    = 'image';
				upload_trigger = true;
				
			}
			
		});
		
		form_data.append('action', 'chumly_save_post');
		
		if (post_format) {
			
			form_data.append('post_format', post_format);
			
		}
		
		form_data.append('target_user', chumly_vars.chumly_profile.id);
		
		$.ajax({
			url:         chumly_vars.ajax_url,
			processData: false,
			contentType: false,
			type:        'POST',
			cache:       false,
			dataType:    'json',
			data:        form_data,
			success:     function (data) {
				
				$('.news-feed--empty-prompt').remove();
				
				if (upload_trigger == true) {
					
					chumlyUploadFiles(form, data.parent_post, data.post_type, data.post_format, function () {
						
						chumlyLoadFeedTemplate(data.parent_post, data.post_format, data.post_type);
						//$('.editor__feedback').empty();
						$(form).trigger('reset');
						trigger.prop('disabled', 'disabled').text('Post Message');
						
					});
					
				} else {
					
					chumlyLoadFeedTemplate(data.parent_post, data.post_format, data.post_type);
					form.trigger('reset');
					//$('.editor__feedback').empty();
					trigger.prop('disabled', '').text('Post Message');
					
				}
				
			}
		})
		
	}
		
}


function chumlyShareStatusPost(event, trigger, form) {
	
	event.preventDefault();
	
	var form_data      = new FormData(form[0]),
	    upload_trigger = false,
	    modal          = trigger.parents('.modal__inner');
	//console.log(trigger);
	trigger.prop('disabled', 'disabled').val('Sharing...').css('opacity', 0.6);
	
	var target_user_id  = [],
	    target_selector = trigger.parents('.modal').find('select[name="target_select"] option:selected').val(),
	    post_id         = $('.modal.is-active').find($('input[name="loaded_post_id"]')).val();
	
	if (!isNaN(target_selector)) {
		
		target_user_id.push(target_selector);
		
	}
	
	$.each($(form).find('input[type="file"]'), function (index, value) {
		
		if (value.files.length > 0) {
			
			form_data.append('has_files', true);
			post_format    = 'image';
			upload_trigger = true;
			
		}
		
	});
	
	$.each(modal.find('.form__group.is-active .search__output button').get(), function (index, value) {
		
		//console.log();
		target_user_id.push($(value).data('user_id'));
		
	});
	
	form_data.append('action', 'chumly_share_post');
	form_data.append('post_format', 'quote');
	form_data.append('target_id', target_user_id);
	form_data.append('source_profile_id', chumly_vars.chumly_profile.id);
	form_data.append('source_user_id', chumly_vars.user_id);
	form_data.append('shared_content_id', post_id);
	console.log(post_id);
	
	$.ajax({
		url:         chumly_vars.ajax_url,
		processData: false,
		contentType: false,
		type:        'POST',
		cache:       false,
		dataType:    'json',
		data:        form_data,
		success:     function (data) {
			
			//console.log('Return', data);
			
			form.trigger('reset');
			trigger.prop('disabled', '').text('Share').css('opacity', 1);
			
			$(document).chumlyModal('close');
			
		}
	});
	
	
}
/**
 * Created by alex on 31/10/18.
 */
var scrollOff = function () {
	
	var current = $(window).scrollTop();
	$(window).scroll(function() {
		$(window).scrollTop(current);
	});
	
};

var scrollOn = function () {
	
	$(window).off('scroll');
	
};

/**
 * Created by matthew on 8/2/18.
 */
$.fn.chumlyScrollTo = function (callback) {
	
	var elem = $(this),
		elem_offset = elem.offset().top,
		elem_height = elem.height(),
		window_height = $(window).height(),
		dom = $('html, body'),
		offset = elem_offset - ((window_height / 2) - (elem_height / 2)) + 'px';
		
	dom.animate({
		scrollTop: offset
	}, 500, 'swing', function () {
		
		if (callback) {
			callback();
		}
		
	});
	
};

/**
 * Created by matthew on 13/6/18.
 */
// Search for users
(function ($) {
	
	$.fn.chumlySearch = function () {
		
		var elem = $(this),
			object_id = elem.data('object_id'),
			search_form = elem.find('form'),
			search_input = elem.find('.search__form__input'),
			search_output = elem.find('.search__output'),
			search_results = elem.find('.search__results'),
			search_mask = elem.find('.search__mask');
		//console.log('Search Init', search_results);
		var init = function () {
				
				elem.on('keyup', function () {
					
					var query_string = search_input.val(),
						output = elem.attr('data-output');
					
					//console.log(query_string);
					
					if (query_string != '') {
						
						search_mask.show();
						search_results.show();
						$.ajax({
							url: chumly_vars.ajax_url,
							type: 'POST',
							data: {
								action: 'chumly_search_members',
								query: query_string,
								object_id: object_id,
								output_option: output
							},
							success: function (data) {
								
								search_results.html(data);
								
							}
						});
						
					} else {
						
						search_results.hide();
						
					}
					
				});
				
				search_mask.on('click', function (event) {
					
					resetSearch();
					
				});
				
				search_results.on('click', '.list-view__item, .user-list__item', function (event) {
					
					event.preventDefault();
					
					var user_id = $(this).data('user_id'),
						search_result = $(this).find('.list-view__text__primary, .user-list__item__text span').html();
					
					//console.log('Result Loaded', search_result);
					resetSearch();
					search_input.focus();
					
					
					var svg = '<svg class="icon button__icon button__icon--right" aria-hidden="true">' +
						'<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="' + chumly_vars.plugin_url + '/frontend/images/icons/svg-symbols.svg#cross"></use>' +
						'</svg>';
					//search_output.append('<input type="button" class="button button-group__item button--small button--primary" value="' + search_result + svg + '">');
					search_output.append('<button type="button" class="button button-group__item button--small button--primary" data-user_id="' + user_id + '"><p>' + search_result + '</p>' + svg + '</button>');
					
				});
			
				search_output.on('click', '.button', function(){
					
					$(this).fadeOut('150', function(){
						$(this).remove();
					})
					
				});
			
			search_form.on('submit', function(event){
				
				event.preventDefault();
				
				
				$.each(search_output.find('button'), function(key, element){
					
					var user_id = $(element).data('user_id');
					
					//console.log(user_id);
					
					$.ajax({
						url: chumly_vars.ajax_url,
						type: 'POST',
						data: {
							action: 'chumly_invite_group_member',
							user_id: user_id,
							group_id: object_id
						},
						success: function(data){
							
							resetSearch();
							search_output.empty();
							
						}
					})
					
				});
				
				//console.log('Submitted');
				
			});
				
			},
			resetSearch = function () {
				search_input.val('');
				search_mask.hide();
				search_results.hide();
			};
		
		init();
		
	}
	
	
}(jQuery));
	

(function ($) {

    $.fn.chumlyTabs = function () {

        var elem = $(this),
            triggers = elem.find('.chumly-tabs__trigger'),
            targets = elem.find('.chumly-tabs__target'),
            settings = {
                activeClass: 'is-active',
                singleToggle: false // When this is true, when a trigger is clicked when it's active, nothing will happen
            };

        var init = function () {

            // Parse settings
            settings = $.extend(true, {}, settings, elem.parseSettings());

            if (triggers.any()) {

                // Attach click to triggers
                triggers.off('click').on('click', function (evt) {

                    evt.preventDefault();

                    // Load up the trigger, it's data, any related triggers and the target that we're looking for
                    var trigger = $(this),
                        targetID = (trigger.attr('href') ? trigger.attr('href') : '#' + trigger.attr('data-target')), // Load target id from href if link or data-target if button
                        relatedtriggers = triggers.filter('[data-target="' + targetID + '"],[href*="' + targetID + '"]'),
                        target = targets.filter(targetID);

                    // If the target is there and this trigger is not active
                    if (target.any() && !trigger.hasClass(settings.activeClass)) {

                        // Clean up targets and add active class to targeted target
                        targets.removeClass(settings.activeClass);
                        target.addClass(settings.activeClass);

                        // Clean up triggers and add active class to targeted trigger. Trigger a 'trigger_active' event for others modules to tap into.
                        // Trigger a 'parent_active' for when a module lives within a hidden tab element that might need to be visual to work (like a google map)
                        triggers.removeClass(settings.activeClass);
                        trigger.addClass(settings.activeClass).trigger('trigger_active').trigger('parent_active');

                        // Find triggers, if any add active class to them
                        if (relatedtriggers.length > 0) {
                            relatedtriggers.each(function () {
                                $(this).addClass(settings.activeClass);
                            });
                        }

                    }

                    // If the target is there but the trigger is active and singleToggle is set to false
                    else if ((target.any() && trigger.hasClass(settings.activeClass)) && !settings.singleToggle) {

                        // Remove active class from target
                        target.removeClass(settings.activeClass);

                        // Remove active class from the trigger
                        trigger.removeClass(settings.activeClass);

                        // Find triggers, if any remove active class
                        if (relatedtriggers.length > 0) {
                            relatedtriggers.each(function () {
                                $(this).removeClass(settings.activeClass);
                            });
                        }
                    }
                });
            }

            $(window).on('hashchange', function() {
                processUrl();
            });
        },

        // Try and find a trigger based on hash. If trigger found run click method
        processUrl = function () {

            var hash = window.location.hash,
                trigger = triggers.filter('[data-target="' + hash.replace('#', '') + '"],[href="' + hash + '"]');

            if (trigger.length > 0) {

                if (trigger.length > 1) {
                    trigger = trigger.eq(0);
                }

                trigger.trigger('click');
            }

        };

        // run methods
        init();
        processUrl();

        return this;
    };

}(jQuery));

(function($) {

	$.fn.chumlyToggle = function() {
		var elem = $(this),
			targets = elem.find('.chumly-toggle__target'),
			triggers = elem.find('.chumly-toggle__trigger'),
			settings = {
				activeClass: 'is-active',
				visibleClass: 'is-active',
				elemClass: '',
				elemClassAttribute: 'data-elem-class'
			};

		var init = function() {
			
			// Find elem class
			if(elem.attr(settings.elemClassAttribute)) {
				settings.elemClass = elem.attr(settings.elemClassAttribute);
			}

			// Bind the click
			triggers.off('click').on('click', function(evt) {

				evt.preventDefault();

				// Load trigger and target
				var trigger = $(this),
					target = targets.filter(trigger.attr('href')),
					relatedTriggers = triggers.filter('[href="' + trigger.attr('href') + '"]');

					// If there are multiple triggers targeting the same elem, just pass them all
					// to the toggle method for class toggling
					if(relatedTriggers.any()) {
						trigger = relatedTriggers;
					}

				// Toggle menu state accordingly
				if(trigger.hasClass(settings.activeClass)) {
					toggle(trigger, target, 'off');
				}
				else {
					toggle(trigger, target, 'on');
				}

			});
		},

		toggle = function(trigger, target, state) {

			switch(state) {
				case 'off':
				default:
					target.removeClass(settings.visibleClass);
					trigger.removeClass(settings.activeClass);

					if(settings.elemClass.length > 0) {
						elem.removeClass(settings.elemClass);
					}
					break;
				case 'on':
					target.addClass(settings.visibleClass);
					trigger.addClass(settings.activeClass);

					if(settings.elemClass.length > 0) {
						elem.addClass(settings.elemClass);
					}
					break;
			}
		};

		init();
		return this;
	};

}(jQuery));
(function ($) {
	
	$.fn.chumlyUploadStatus = function () {
		var elem              = $(this),
		    statusRing        = elem.find('.js-upload-status__status-ring').get(0),
		    bodyElem          = $('body'),
		    completeDashArray = 0,
		    settings          = {
			    completeClass: 'is-complete',
			    errorClass:    'is-error',
			    activeClass:   'is-active'
		    };
		
		var init     = function () {
			
			    // Work out what our completed state will be
			    completeDashArray = parseFloat(statusRing.getAttribute('data-complete-dasharray'), 10);
			
			    // Bind triggers
			    bodyElem.on('chumly-upload-status-update-data', function (evt, data) {
				    update(data.percent);
			    });
			
			    bodyElem.on('chumly-upload-status-complete', complete);
			    bodyElem.on('chumly-upload-status-error', error);
			    bodyElem.on('chumly-upload-status-reset', function () {
				    reset(true);
			    });
		    },
		
		    update   = function (percent) {

			    elem.css('visibility', 'visible');
			
			    // Remove any classes
			    reset(false);
			
			    // Get the current percentage representation of the stroke dasharray
			    var currentVal = completeDashArray * percent;
			
			    // Find the difference between that and the complete value
			    var remainingVal = completeDashArray - currentVal;
			
			    // Set the attribute and increment the index
			    statusRing.setAttribute('stroke-dasharray', currentVal + ' ' + remainingVal);
		    },
		
		    // Show the upload has completed
		    complete = function () {
			    console.log('Completed Upload');
			    //If we're at the end, add the complete modifier
			    //if (percent >= 1) {
			    elem.addClass(settings.completeClass);
			    statusRing.setAttribute('stroke-dasharray', completeDashArray + ' 0');
			    //return;
			    //}
		    },
		
		    // Something has gone wrong so set a visual error
		    error    = function () {
			
			    elem.removeClass(settings.completeClass).addClass(settings.errorClass);
			    statusRing.setAttribute('stroke-dasharray', completeDashArray + ' 0');
		    },
		
		    // Reset to factory settings
		    reset    = function (resetStroke) {
			
			    elem.removeClass(settings.completeClass).removeClass(settings.errorClass);
			
			    if (resetStroke) {
				    statusRing.setAttribute('stroke-dasharray', '0 ' + completeDashArray);
			    }
		    };
		
		init();
		return this;
	};
	
}($));
/**
 * IMAGE UPLOAD PREVIEW
 *
 * Trigger File Upload Image Preview
 */
var uploadPreview, hiddenFields, ajaxResponse;

$('.chumly').on('change', 'input[data-upload="true"]', function () {

	var trigger = $(this),
	    target  = trigger.parents('form');

	trigger.attr('data-new_file', 1);

	if (trigger.parents('.form__group').length > 0) {

		uploadPreview = trigger.parents('.form__group').find('.upload__preview');

	} else {

		uploadPreview = trigger.parents('form').find('.upload__preview');

	}

	hiddenFields = target.find('.hidden_upload_fields');
	ajaxResponse = target.find('.ajax_response');

	uploadPreview.empty();
	hiddenFields.empty();
	ajaxResponse.empty();

	var files   = (this.files),
	    cropper = $(this).data('croppable');

	for (var count = 0, file; file = files[count]; count++) {

		var file_type = chumlyDetermineFiletype(file);

		if (file_type == 'image') {

			//var image = chumlyOrientateImage(file);

			//$('.user-profile__interactions').append(image);

			chumlyPreviewImageUpload(file, count, cropper);

		} else {

			//chumlyAlertModal(trigger, 'error', 'That file type is not permitted');

			chumlyPrompt(trigger, 'negative', 'Invalid Filetype', 'This type of file is not permitted for uploading.');

			/*uploadPreview.append('<div class="upload__preview__item">' +
				'<img class="upload__preview__item__file" src="' + chumly_vars.plugin_url + 'frontend/images/temp/file_icon.png" data-filename="' + file['name'] + '" />' +
				'<div class="upload__meter"></div>' +
				'</div>');
			
			$.ajax({
				url:     chumly_vars.ajax_url,
				type:    'GET',
				data:    {
					action: 'chumly_upload_meter'
				},
				success: function (data) {
					
					$('.upload__meter').html(data);
					uploadPreview.find($('[data-module="chumly-upload-status"]')).chumlyUploadStatus();
					
				}
			});*/
		}

	}

});


/**
 * IMAGE PREVIEW
 *
 * Grab the image(s) and output in the preview area.
 */
function chumlyPreviewImageUpload(file, count, cropper) {

	var fileReader = new FileReader();

	fileReader.onload = function (e) {

		var imageString = e.target.result,
		    contentType = file['type'];

		var imageBlob = chumlyImageStringBlob(imageString.split(',')[1], contentType);


		var imageSrc = URL.createObjectURL(imageBlob);
		//var image = '<img id="image_' + count + '" class="upload__preview__item__image" src="' + imageSrc + '" data-filename="' + file['name'] + '"/>';

		uploadPreview.append('<div id="upload_preview_item_' + count + '" class="upload__preview__item">' +
			'<div class="upload__meter" data-module="chumly-upload"></div>' +
			'</div>'
		);

		//chumlyOrientateImage(file);
		chumlyOrientateImage(file, 'upload_preview_item_' + count, {
			'id': 'image_' + count,
			'class': 'upload__preview__item__image',
			'data-filename': file['name']
		});

		if (cropper) {
			chumlyFireImageCropper($('#image_' + count + ''), count);
		}

		$.ajax({
			url: chumly_vars.ajax_url,
			type: 'GET',
			data: {
				action: 'chumly_upload_meter'
			},
			success: function (data) {

				$('.upload__meter').html(data);
				uploadPreview.find($('[data-module="chumly-upload-status"]')).chumlyUploadStatus();

			}
		});

	};

	return fileReader.readAsDataURL(file);

}


/**
 * IMAGE ORIENTATION
 *
 * Determine what the EXIF orientation of the image is and
 * return relevant correction
 */
function chumlyOrientateImage(file, outputTarget, imgAttrs) {
	
	loadImage(file, function (canvas) {

		var image = new Image();
		image.src = canvas.toDataURL("image/png");

		$('#' + outputTarget).prepend(image);

		$.each(imgAttrs, function (attrName, attrValue) {

			$(image).attr(attrName, attrValue);

		})

	}, {orientation: true});

}


/**
 * SAVE FILES
 *
 * Save posts from the Post Form such as the
 * status post form on the default profile page.
 *
 * @param form Form that contains the file inputs
 * @param parent_post For what entity the file is for. e.g - profile, status post, IM message, group profile, gallery etc.
 *                 This is used for saving metadata such as the URL and attachment ID to link to a profile.
 */
function chumlyUploadFiles(form, parent_post, post_type, post_format, callback) {
	console.log('Upload Parent:', parent_post);
	if ($(form).find('input[type="file"]').length == 0) {

		if (callback) {
			callback();
		}

	} else {

		$.each($(form).find('input[type="file"]'), function (key, input) {
			//console.log($(input).attr('id'));

			var media_classification = $(input).data('media_classification');
			console.log(media_classification);

			if (input.files.length < 1 || $(input).attr('data-new_file') != 1) {
				console.log('Skipping upload');
				if (callback) {
					callback();
				}


			} else {

				$.each(input.files, function (key, file) {

					//console.log(chumly_vars.user_id);
					var fileType   = chumlyDetermineFiletype(file),
					    uploadData = new FormData();

					uploadData.append('action', 'chumly_save_file');
					uploadData.append('media_classification', media_classification);
					uploadData.append('term', media_classification + '-' + $(input).attr('id'));
					uploadData.append('user_id', chumly_vars.user_id);
					uploadData.append('media_bucket', chumly_vars.media_bucket);
					uploadData.append('parent_post', parent_post);

					var xhr = new XMLHttpRequest();
					if (fileType == 'image') {

						if ($('.upload__preview__item__image--cropped').data('filename', file['name']).length > 0) {

							var upload_source = $('.upload__preview__item__image--cropped[data-filename="' + file['name'] + '"]').attr('src');
							//console.log('cropped image');

						} else {

							var upload_source = $('.upload__preview__item__image[data-filename="' + file['name'] + '"]').attr('src');

						}

						xhr.open('GET', upload_source, true);
						xhr.responseType = 'blob';

					} else {

						var upload_source = $('.upload__preview__item__file[data-filename="' + file['name'] + '"]').attr('src');
						//console.log(upload_source);
						xhr.open('GET', upload_source, true);
						uploadData.append('file', file);

					}

					xhr.onload = function (e) {

						if (this.status == 400) {
							console.log('Error - Check with host.');
						}

						if (this.status == 200) {

							var imageBlob = this.response;

							if (fileType == 'image') {

								uploadData.append(0, imageBlob, file['name']);

							}

							$.ajax({
								url: chumly_vars.ajax_url,
								type: 'POST',
								processData: false,
								contentType: false,
								dataType: 'json',
								cache: false,
								data: uploadData,
								xhr: function () {
									//upload Progress
									var xhr = $.ajaxSettings.xhr();
									if (xhr.upload) {
										xhr.upload.addEventListener('progress', function (event) {

											var percent  = 0,
											    position = event.loaded || event.position,
											    total    = event.total;

											if (event.lengthComputable) {
												percent = Math.ceil(position / total).toFixed(2);
											}

											//update upload meter
											$('body').trigger('chumly-upload-status-update-data', [{percent: percent}]);
										}, true);
									}
									return xhr;
								},
								success: function (data) {

									console.log('Saved file response:', data);

									if (data.state == 'success') {
										//console.log($(input));
										$(input).attr('data-new_file', 0);

										$(input).trigger('chumly-upload-status-complete');

									} else if (data.state == 'error') {
										$('body').trigger('chumly-upload-status-error');
									}

									ajaxResponse.append(data);

									if (callback) {
										callback();
									}

								}
							});
						}
					};

					xhr.send(null);

				});

			}

		});

	}

}


/**
 * FILE TYPE ROUTER
 *
 * Determine what type of file we're uploading
 * and decide what happens from there.
 */
function chumlyDetermineFiletype(file) {

	return file['type'].split('/')[0];

}


/**
 * LOAD IMAGE CROPPER
 *
 * Not all files and images uploaded will require or
 * want to be cropped so we'll only load the cropping
 * mechanism conditionally. From here will follow on
 * the necessary mechanism to save the cropped image.
 */
function chumlyFireImageCropper(target, count) {

	ajaxResponse.empty();

	target.rcrop({
		grid: true,
		full: true
	});

	//console.log(target.rcrop('getValues'));

	target.on('rcrop-ready rcrop-changed', function () {

		chumlyProcessCrop(target, count);

	});

}


/** GET CROPPED IMAGE DIMENSIONS & COORDINATES
 *
 * Get the coordinates for our new image.
 */
function chumlyGetCropCoordinates(target) {

	return target.rcrop('getValues');

}


/**
 * PROCESS CROPPED IMAGE
 */
function chumlyProcessCrop(target, count) {

	var image_data   = chumlyGetCropCoordinates(target),
	    image_source = target.rcrop('getDataURL');

	$.ajax({
		url: chumly_vars.ajax_url,
		type: 'POST',
		data: {
			'action': 'process_crop',
			'image_source': image_source,
			'image_id': count,
			'image_height': image_data.height,
			'image_width': image_data.width,
			'image_x_position': image_data.x,
			'image_y_position': image_data.y
		},
		success: function (data) {

			var image_string = data,
			    image_blob   = chumlyImageStringBlob(image_string, 'image/png'),
			    image_src    = URL.createObjectURL(image_blob);

			$('.upload__preview__item').find('.upload__preview__item__image--cropped').remove();
			target.parents('.upload__preview__item')
				.append('<img class="upload__preview__item__image upload__preview__item__image--cropped" src="' + image_src + '" data-filename="' + target.data('filename') + '"/>');

		}
	}); // Close Ajax
}


/**
 * PREPARE UPLOAD OBJECTS
 *
 * We need to take the data we've input and prepare it
 * for being uploaded by getting our Ajax data objects
 * in the correct format as well as feed in any metadata
 * we'll need such as the page we're on.
 */
function chumlyPrepareFileUpload(count) {

	var files = $(document).find('#profile_image')[0].files,
	    data  = new FormData();


	for (var count = 0, file; file = files[count]; count++) {
		data.append('file_' + count, file);
	}

	return data;

}


/**
 * CREATE IMAGES FROM STRINGS
 *
 * We want to have a uniform way of interacting with the images
 * we're outputting to preview and working with. As such, all images
 * become Blobs because we can easily draw new images and have a uniform
 * image object to save via media_handle_upload and such like - be it cropped,
 * rotated, rotated & cropped or just vanilla!
 *
 * @param image_string base64_encoded image source string from FileReader
 * @param content_type What kind of image it is
 * @param slice_size As it suggests - byte slice length
 * @returns {*} A Blob
 */
function chumlyImageStringBlob(image_string, content_type, slice_size) {

	content_type = content_type || '';
	slice_size = slice_size || 512;

	var byte_characters = atob(image_string),
	    byte_arrays     = [];

	for (var offset = 0; offset < byte_characters.length; offset += slice_size) {

		var slice        = byte_characters.slice(offset, offset + slice_size),
		    byte_numbers = new Array(slice.length);

		for (var i = 0; i < slice.length; i++) {
			byte_numbers[i] = slice.charCodeAt(i);
		}

		byte_arrays.push(new Uint8Array(byte_numbers));

	}

	return new Blob(byte_arrays, {type: content_type});

}
	

/*------------------------------------*\
 CHUMLY MASTER
 
 This file includes the module placeholders system that allows modular
 binding of custom methods / plugins etc.
 
 EXAMPLE
 
 <div data-module='example1,example2'></div>
 
 The above would meet two conditions in the below switch statement.
 
 \*------------------------------------*/
var chumly = (function ($) {
	
	// This method will run when the DOM is ready. 
	var init = function () {
		
		// Find any module placeholders 
		var modulePlaceholders = $('[data-module]');
		
		if (modulePlaceholders.any()) {
			
			// Loop each placeholder
			modulePlaceholders.each(function () {
				
				var elem    = $(this),
				    modules = elem.attr('data-module');
				
				// If any modules found	
				if (modules) {
					
					// Split on the comma 
					modules = modules.split(', ');
					
					// Loop each module key
					$.each(modules, function (i, module) {
						
						// Run switch to bind each module to each key
						switch (module) {
							
							case 'chumly-alert':
								elem.chumlyAlert();
								break;
							
							case 'chumly-prompt':
								elem.chumlyPrompt();
								break;
							
							case 'chumly-tabs':
								elem.chumlyTabs();
								break;
							
							case 'chumly-toggle':
								elem.chumlyToggle();
								break;
							
							case 'chumly-upload-status':
								elem.chumlyUploadStatus();
								break;
							
							case 'chumly-comment-form':
								elem.chumlyCommentFormTriggers();
								break;
							
							case 'chumly-modal':
								elem.chumlyModal();
								break;
							
							case 'chumly-search':
								elem.chumlySearch();
								break;
							
							case 'chumly-notification':
								elem.chumlyNotification();
								break;
							
							case 'chumly-connect':
								elem.chumlyConnect();
								break;
						}
						
					});
				}
			});
		}
		
		// Load always run scripts
		misc();
		
	};
	
	return {
		init: init
	}
	
}(window.$));

// RUN!!

if (jQuery('.chumly').length > 0) {
	
	chumly.init();
	
}
//# sourceMappingURL=chumly.js.map
