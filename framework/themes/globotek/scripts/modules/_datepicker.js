(function ($) {
	
	$.fn.datepicker = function () {
          var elem = $(this),
            triggerCalNext = elem.find('.js-nextcal__trigger'),
            triggerCalPrev = elem.find('.js-prevcal__trigger'),
            targetSlider = $('.datepicker__calendar__slider'),
            triggers = $('.datepicker__calendar__time'),
            targetPage = $('.datepicker__calendar__page');
		    settings = {
			    activeClass: 'datepicker__calendar__time__selected',
			    visibleClass: 'is-active',
			    elemClass: '',
			    elemClassAttribute: 'data-elem-class'
		    };
		
		var init = function () {

            var pageNum = targetPage.length,
               calWidth = targetSlider.width();
              pageWidth = targetPage.width(),
            sliderWidth = calWidth * pageNum;

            targetPage.width(calWidth);
            targetSlider.width(sliderWidth);

            // Find elem class
            if(elem.attr(settings.elemClassAttribute)) {
                settings.elemClass = elem.attr(settings.elemClassAttribute);
            }



            triggerCalNext.off('click').on('click', function() {

                var leftCurrent = parseInt(targetSlider.css("left")),
                leftCalNew = leftCurrent - calWidth;

                $('.activeCal').removeClass('activeCal').next().addClass('activeCal');
                targetSlider.css('left', leftCalNew);

                hideButtons();

            });

            triggerCalPrev.off('click').on('click', function() {

                var leftCurrent = parseInt(targetSlider.css("left")),
                leftCalNew = leftCurrent + calWidth;
			
                $('.activeCal').removeClass('activeCal').prev().addClass('activeCal');
                targetSlider.css('left', leftCalNew);

                hideButtons();
            
            });


            function hideButtons() {
                if ($('.datepicker__calendar__page:first-child').hasClass('activeCal')) {
                    triggerCalPrev.css('opacity', '0');
                } else {
                    triggerCalPrev.css('opacity', '1');
                }

                if ($('.datepicker__calendar__page:last-child').hasClass('activeCal')) {
                    triggerCalNext.hide();
                    triggerCalPrev.show();
                } else {
                    triggerCalNext.show();
                    triggerCalPrev.show();
                }
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