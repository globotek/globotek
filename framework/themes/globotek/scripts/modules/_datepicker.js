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
		    slotSlider       = $('.datepicker__calendar__slots'),
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
			
			
			triggerCalNext.off('click').on('click', function () {
				
				var leftCurrent = parseInt(targetSlider.css("left")),
				    leftCalNew  = leftCurrent - calWidth;
				
				$('.activeCal').removeClass('activeCal').next().addClass('activeCal');
				targetSlider.css('left', leftCalNew);
				
				hideButtons();
				
			});
			
			
			triggerAfternoon.off('click').on('click', function () {
				
				var $this = $(this);
				
				$this.parent().css('top', '-416px');
				
			});
			
			
			triggerMorning.off('click').on('click', function () {
				
				var $this = $(this);
				
				$this.parent().css('top', '0px');
				
			});
			
			
			triggerCalPrev.off('click').on('click', function () {
				
				var leftCurrent = parseInt(targetSlider.css("left")),
				    leftCalNew  = leftCurrent + calWidth;
				
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
			triggers.off('click').on('click', function (evt) {
				
				evt.preventDefault();
				
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