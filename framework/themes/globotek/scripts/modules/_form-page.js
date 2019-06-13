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

                $('.form-slider__slider, .form-slider').css({
                    height: slideNextHeight
                });
            
            });

            triggerPrev.off('click').on('click', function() {

                var left = parseInt($('.form-slider__slider').css("left")),
                leftNew = left + formWidth,
                slidePrevHeight = $('.active').prev().height();
			
                $('.active').removeClass('active').prev().addClass('active');
                $('.form-slider__slider').css('left', leftNew);

                $('.form-slider__slider, .form-slider').css({
                    height: slidePrevHeight
                }); 
            
            });
           
		}
		
		init();
		return this;
	};
	
}(jQuery));