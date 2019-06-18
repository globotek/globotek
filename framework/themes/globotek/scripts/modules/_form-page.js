(function ($) {
	
	$.fn.formPage = function () {
          var elem = $(this),
            triggerNext = elem.find('.js-next__trigger'),
            triggerPrev = elem.find('.js-prev__trigger'),
            target = $('.form'),
            targetPage = $('.form-slider__page');
		
		var init = function () {

            var pageNum = targetPage.length,
              formWidth = target.width();
              pageWidth = targetPage.width(),
            sliderWidth = formWidth * pageNum;

            targetPage.width(formWidth);
            $('.form-slider__slider').width(sliderWidth);

            triggerNext.off('click').on('click', function() {
            
                var left = parseInt($('.form-slider__slider').css("left")),
                leftNew = left - formWidth,
                slideNextHeight = $('.active').next().height();

                $('.active').removeClass('active').next().addClass('active');
                $('.form-slider__slider').css('left', leftNew);

                $('.form-slider__slider').css({
                    height: slideNextHeight + 60
                });
                
                hideButtons();

            });

            triggerPrev.off('click').on('click', function() {

                var left = parseInt($('.form-slider__slider').css("left")),
                leftNew = left + formWidth,
                slidePrevHeight = $('.active').prev().height();
			
                $('.active').removeClass('active').prev().addClass('active');
                $('.form-slider__slider').css('left', leftNew);

                $('.form-slider__slider').css({
                    height: slidePrevHeight + 60
                }); 

                hideButtons();
            
            });

            $('[data-toggle="toggle"]').change(function(){
                $('.datepicker__calendar__afternoon').toggleClass('datepicker__calendar__afternoon--active');
            });

            function hideButtons() {
                if ($('.form-slider__page:first-child').hasClass('active')) {
                    $('.back').css('opacity', '0');
                } else {
                    $('.back').css('opacity', '1');
                }

                if ($('.form-slider__page:last-child').hasClass('active')) {
                    $('.next').hide();
                    $('.back').hide();
                } else {
                    $('.next').show();
                    $('.back').show();
                }

                /*if ($('.form-slider__page:nth-last-child(2)').hasClass('active')) {
                    $('.next').hide();
                    $('.book').show();
                } else {
                    $('.next').show();
                    $('.book').hide();
                }*/
            } 
            
		}
		
		init();
		return this;
	};
	
}(jQuery));