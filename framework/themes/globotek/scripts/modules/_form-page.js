(function ($) {
	
	$.fn.formPage = function () {
          var elem = $(this),
            triggerNext = elem.find('.js-next__trigger'),
            triggerPrev = elem.find('.js-prev__trigger'),
            bookBtn = elem.find('.book'),
            formSlider = $('.form-slider__slider'),
            target = $('.form'),
            targetPage = $('.form-slider__page');
		
		var init = function () {

            var pageNum = targetPage.length,
              formWidth = target.width();
              pageWidth = targetPage.width(),
            sliderWidth = formWidth * pageNum;

            targetPage.width(formWidth);
            formSlider.width(sliderWidth);

            triggerNext.off('click').on('click', function(evt) {
                
                evt.preventDefault();

                nextPage();
                hideButtons();

            });

            triggerPrev.off('click').on('click', function(evt) {

                evt.preventDefault();

                prevPage();
                hideButtons();
            
            });

            bookBtn.off('click').on('click', function(evt) {

                evt.preventDefault();

                nextPage();
                hideButtons();
            
            });

            function nextPage() {
                var left = parseInt(formSlider.css("left")),
                leftNew = left - formWidth,
                slideNextHeight = $('.active').next().height();

                targetPage.css('opacity','1');
                $('.active').css('opacity', '0');
                $('.active').removeClass('active').next().addClass('active');
                formSlider.css('left', leftNew);

                formSlider.css({
                    height: slideNextHeight + 60
                });
            }

            function prevPage() {
                var left = parseInt(formSlider.css("left")),
                leftNew = left + formWidth,
                slidePrevHeight = $('.active').prev().height();
                
                targetPage.css('opacity','1');
                $('.active').css('opacity', '0');
                $('.active').removeClass('active').prev().addClass('active');
                formSlider.css('left', leftNew);

                formSlider.css({
                    height: slidePrevHeight + 60
                }); 
            }

            function hideButtons() {
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