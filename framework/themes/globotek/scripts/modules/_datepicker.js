(function ($) {
	
	$.fn.datepicker = function () {
          var elem = $(this),
            target = $('.datepicker'),
            triggers = $('.datepicker__calendar__time'),
		    settings = {
			    activeClass: 'datepicker__calendar__time__selected',
			    visibleClass: 'is-active',
			    elemClass: '',
			    elemClassAttribute: 'data-elem-class'
		    };
		
		var init = function () {

            // Find elem class
			    if(elem.attr(settings.elemClassAttribute)) {
				    settings.elemClass = elem.attr(settings.elemClassAttribute);
                }
                

			    // Bind the click
			    triggers.off('click').on('click', function(evt) {

				    evt.preventDefault();

				    // Load trigger and target
				    var trigger = $(this);

                    triggers.removeClass(settings.activeClass);
                    trigger.addClass(settings.activeClass);

                });
                
                $('[data-toggle="toggle"]').change(function(){
                    $('.datepicker__calendar__afternoon').toggleClass('datepicker__calendar__afternoon--active');
                    $('.datepicker__calendar__foot').toggleClass('datepicker__calendar__foot--active');
                });
            
		}
		
		init();
		return this;
	};
	
}(jQuery));