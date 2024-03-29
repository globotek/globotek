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
	}


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
                $.log("Check input data. Message: " + ex.message);
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
	
	$.fn.datepicker = function () {
		
		var elem             = $(this),
		    triggerCalNext   = elem.find('.js-nextcal__trigger'),
		    triggerCalPrev   = elem.find('.js-prevcal__trigger'),
		    targetSlider     = $('.datepicker__calendar__slider'),
		    triggers         = $('.datepicker__calendar__time'),
		    targetPage       = $('.datepicker__calendar__page'),
		    triggerAfternoon = $('.datepicker__calendar__afternoon'),
		    triggerMorning   = $('.datepicker__calendar__morning'),
		    settings         = {
			    sliderClass:        'datepicker__calendar__slots',
			    activeClass:        'datepicker__calendar__time__selected',
			    visibleClass:       'is-active',
			    elemClass:          '',
			    elemClassAttribute: 'data-elem-class'
		    };
		
		var init = function () {
			
			var pageNum  = targetPage.length,
			    calWidth = targetSlider.width();
			   pageWidth = targetPage.width(),
			 sliderWidth = calWidth * pageNum;
			
			targetPage.width(calWidth);
			targetSlider.width(sliderWidth);
			
			// Find elem class
			if (elem.attr(settings.elemClassAttribute)) {
				settings.elemClass = elem.attr(settings.elemClassAttribute);
			}
			
			
			var nextClick = function() {
                if ($('.datepicker__calendar__page:nth-last-child(2)').hasClass('activeCal')) {
					triggerCalNext.addClass('is-hidden');
                }
                if ($('.datepicker__calendar__page:first-child').hasClass('activeCal')) {
					triggerCalPrev.removeClass('is-hidden');
				}

                var $self = $(this),
			  leftCurrent = parseInt(targetSlider.css("left")),
			  leftCalNew  = leftCurrent - calWidth;
				
				$('.activeCal').removeClass('activeCal').next().addClass('activeCal');
				targetSlider.css('left', leftCalNew);
                
                $self.unbind('click'); 

                setTimeout(function(){
                    $self.click(nextClick);
                }, 500);
            };
            
            triggerCalNext.click(nextClick);

            
            var prevClick = function() {
                if ($('.datepicker__calendar__page:nth-child(2)').hasClass('activeCal')) {
                    triggerCalPrev.addClass('is-hidden');
                }
                if ($('.datepicker__calendar__page:last-child').hasClass('activeCal')) {
					triggerCalNext.removeClass('is-hidden');
				}

                var $self = $(this),
			  leftCurrent = parseInt(targetSlider.css("left")),
			  leftCalNew  = leftCurrent + calWidth;
				
				$('.activeCal').removeClass('activeCal').prev().addClass('activeCal');
                targetSlider.css('left', leftCalNew);
                
                $self.unbind('click'); 

                setTimeout(function(){
                    $self.click(prevClick);
                }, 500);
            };
            
            triggerCalPrev.click(prevClick);
			
			
			triggerAfternoon.off('click').on('click', function () {
				var $this = $(this);
				$this.parent().css('top', '-534px');
			});
			
			
			triggerMorning.off('click').on('click', function () {
				var $this = $(this);
				$this.parent().css('top', '0px');
			});
			
			
			// Bind the click
			triggers.off('click').on('click', function (evt) {
				
				//evt.preventDefault();
				
				// Load trigger and target
				var trigger = $(this);
				
				triggers.removeClass(settings.activeClass);
				trigger.addClass(settings.activeClass);
				
			});
			
		}
		
		init();
		return this;
	};
	
}(jQuery));
(function ($) {
	
	$.fn.formPage = function () {
		var elem        = $(this),
		    triggerNext = elem.find('.js-next__trigger'),
		    triggerPrev = elem.find('.js-prev__trigger'),
		    bookBtn     = elem.find('.book'),
		    formSlider  = $('.form-slider__slider'),
		    target      = $('.form'),
		    targetPage  = $('.form-slider__page');
		
		var init = function () {
			
			var pageNum     = targetPage.length,
			    formWidth   = target.width(),
			    pageWidth   = targetPage.width(),
			    sliderWidth = formWidth * pageNum;
			
			targetPage.width(formWidth);
			formSlider.width(sliderWidth);
			
			triggerNext.off('click').on('click', function (evt) {
				
				evt.preventDefault();
				
				nextPage();
				hideButtons();
				
			});
			
			triggerPrev.off('click').on('click', function (evt) {
				
				evt.preventDefault();
				
				prevPage();
				hideButtons();
				
			});
			
			bookBtn.off('click').on('click', function (evt) {
				
				//evt.preventDefault();
				
				//nextPage();
				//hideButtons();
				
			});
			
			function nextPage() {
				var left            = parseInt(formSlider.css("left")),
				    leftNew         = left - formWidth,
				    slideNextHeight = $('.active').next().height();
				
				targetPage.css('opacity', '1');
				$('.active').css('opacity', '0');
				$('.active').removeClass('active').next().addClass('active');
				
				formSlider.css('left', leftNew);
				
				formSlider.css({
					height: slideNextHeight + 60
				});
			}
			
			function prevPage() {
				var left            = parseInt(formSlider.css("left")),
				    leftNew         = left + formWidth,
				    slidePrevHeight = $('.active').prev().height();
				
				targetPage.css('opacity', '1');
				$('.active').css('opacity', '0');
				$('.active').removeClass('active').prev().addClass('active');
				formSlider.css('left', leftNew);
				
				formSlider.css({
					height: slidePrevHeight
				});
			}
			
			function hideButtons() {
				
				event.preventDefault();
				
				if ($('.form-slider__page:first-child').hasClass('active')) {
					
					$('.back').hide();
					
				} else {
					
					$('.back').show();
					
				}
				
				if ($('.form-slider__page:nth-last-child(2)').hasClass('active')) {
					
					$('.next').hide();
					$('.book').show();
					
				} else if ($('.form-slider__page:last-child').hasClass('active')) {
					
					$('.next').hide();
					$('.back').hide();
					$('.book').hide();
					
				} else {
					
					$('.next').show();
					$('.book').hide();
					
				}
			}
			
		}
		
		init();
		return this;
	};
	
}(jQuery));
/**
 * Created by matthew on 3/5/19.
 */
(function ($) {
	
	$.fn.gallery = function () {
		
		var elem = $(this);
		
		var init = function () {
			
			$(window).load(function () {
				
				console.log('Packery Time', elem);
				
				elem.isotope({
					layoutMode:      'packery',
					itemSelector:    '.gallery__item',
					percentPosition: true,
					packery:         {
						gutter: 30,
						//horizontal: true
					}
				});
				
			});
			
		};
		
		init();
		return this;
		
	}
	
	
}(jQuery));
(function ($) {
	
	$.fn.rangeSlider = function () {
		var elem     = $(this),
		    triggers = elem.find('.js-range__trigger'),
		    settings = {
			    activeClass:        'is-active',
			    visibleClass:       'is-active',
			    elemClass:          '',
			    elemClassAttribute: 'data-elem-class'
		    };
		
		var init = function () {
            
			triggers.off('input').on('input', function () {
				
				var control           = $(this),
				    controlMin        = control.attr('min'),
				    controlMax        = control.attr('max'),
				    controlVal        = control.val(),
				    controlThumbWidth = control.data('thumbwidth');
				
				var range = controlMax - controlMin;
				
				var position       = ((controlVal - controlMin) / range) * 100;
				var positionOffset = Math.round(controlThumbWidth * position / 100) - (controlThumbWidth / 2);
				var output         = control.next('output');
				
				if (controlVal == 25000) {
					
					controlVal = controlVal + '+';
					
				}
				
				output.css('left', 'calc(' + position + '% - ' + positionOffset + 'px - 51px)').text('£' + controlVal);
				
			}).trigger("change");
			
		}
		
		init();
		return this;
	};
	
}(jQuery));
(function($) {

	$.fn.siteHead = function() {
		var elem = $(this),
			settings = {
				activeClass: 'is-active'
			};

		var init = function() {
            
			settings = $.extend(true, {}, settings, elem.parseSettings());

			var navTrigger = $('.site-head .js-toggle__trigger'),
				navElem = $('.site-head__nav');

			navTrigger.on('click', function(){

				if(navElem.hasClass('is-active')){
					
                    $('body').addClass('is-locked');
					
				} else {
					
					$('body').removeClass('is-locked');
					
                }

            });

            $('.menu-item-has-children > a .site-head__nav__item__arrow').click(function(e) {
                if(navElem.hasClass('is-active')){
                    
                    e.preventDefault();
                    var $this = $(this);


                    if($this.closest('.menu-item-has-children').hasClass('is-active')) {
                        $this.closest('.menu-item-has-children').removeClass('is-active');
                    } else {
                        $this.closest('.menu-item-has-children').addClass('is-active');
                    }                  

                }
            });

            $('.search__icon').click(function(){
	            
                $('.search').toggleClass('search--open')
                $('.search__form__field').focus();
	            
            });
              


			// This is a stub module. Go ahead and delete it if you don't need it
		};

		init();
		return this;
	};

}(jQuery));
(function($) {

	$.fn.toggle = function() {
		var elem = $(this),
		    targets = elem.find('.js-toggle__target'),
		    triggers = elem.find('.js-toggle__trigger'),
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
/**
 * Created by matthew on 2/7/19.
 */

(function($){
	
	$('.variations_form input[type="radio"]').on('click', function(){
		
		$('input[name="variation_id"]').val($(this).val());
		
	});
	
})(jQuery);


/*------------------------------------*\
 CENTRAL APP MASTER
 
 This file includes the module placeholders system that allows modular
 binding of custom methods / plugins etc.
 
 EXAMPLE
 
 <div data-module="example1,example2"></div>
 
 The above would meet two conditions in the below switch statement.
 
 \*------------------------------------*/
var app = (function ($) {
	
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
					modules = modules.split(',');
					
					// Loop each module key
					$.each(modules, function (i, module) {
						
						// Run switch to bind each module to each key
						switch (module) {
							
							// This is an example. Delete when you add your own cases.
							case 'site-head':
								
								elem.siteHead();
								break;
							
							case 'toggle':
								
								elem.toggle();
								break;
							
							case 'range-slider':
								
								elem.rangeSlider();
								break;
							
							case 'gallery':
								
								elem.gallery();
                                break;
                                
                            case 'form-page':
								
                                elem.formPage();
                                break;

                            case 'datepicker':
								
                                elem.datepicker();
                                break;
							
						}
						
					});
				}
			});
		}
		
		// Delete this line. This is just for letting you know that everything is fine on first load.
		console.log('Let\'s Go!!! Fun time!!!');
	};
	
	return {
		init: init
	}
	
}(window.jQuery));

// RUN!!
app.init();
//# sourceMappingURL=globotek.js.map
