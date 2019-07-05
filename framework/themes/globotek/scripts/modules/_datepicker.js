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
			
<<<<<<< HEAD
			var pageNum     = targetPage.length,
			    calWidth    = targetSlider.width(),
			    pageWidth   = targetPage.width(),
			    sliderWidth = calWidth * pageNum;
=======
			var pageNum  = targetPage.length,
			    calWidth = targetSlider.width();
			   pageWidth = targetPage.width(),
			 sliderWidth = calWidth * pageNum;
>>>>>>> 98a1636e44ba456a8965370fcfc77484487aa482
			
			targetPage.width(calWidth);
			targetSlider.width(sliderWidth);
			
			// Find elem class
			if (elem.attr(settings.elemClassAttribute)) {
				settings.elemClass = elem.attr(settings.elemClassAttribute);
			}
			
			
<<<<<<< HEAD
			var nextClick = function () {
				var $self = $(this);
				
				var leftCurrent = parseInt(targetSlider.css("left")),
				    leftCalNew  = leftCurrent - calWidth;
				
				$('.activeCal').removeClass('activeCal').next().addClass('activeCal');
				targetSlider.css('left', leftCalNew);
				
				$self.unbind('click');
				
				setTimeout(function () {
					$self.click(nextClick);
				}, 500);
				
				hideButtons();
			};
			
			triggerCalNext.click(nextClick);
			
			
			var prevClick = function () {
				var $self = $(this);
				
				var leftCurrent = parseInt(targetSlider.css("left")),
				    leftCalNew  = leftCurrent + calWidth;
				
				$('.activeCal').removeClass('activeCal').prev().addClass('activeCal');
				targetSlider.css('left', leftCalNew);
				
				$self.unbind('click');
				
				setTimeout(function () {
					$self.click(prevClick);
				}, 500);
				
				
				hideButtons();
				
			};
			
			triggerCalPrev.click(prevClick);
=======
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
>>>>>>> 98a1636e44ba456a8965370fcfc77484487aa482
			
			
			triggerAfternoon.off('click').on('click', function () {
				var $this = $(this);
				$this.parent().css('top', '-534px');
			});
			
			
			triggerMorning.off('click').on('click', function () {
				var $this = $(this);
				$this.parent().css('top', '0px');
			});
			
			
<<<<<<< HEAD
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
			
			
=======
>>>>>>> 98a1636e44ba456a8965370fcfc77484487aa482
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