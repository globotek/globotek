(function ($) {
	
	$.fn.formPage = function () {
          var elem = $(this),
            triggerNext = elem.find('.js-next__trigger'),
            triggerPrev = elem.find('.js-prev__trigger'),
            target = $('.form'),
		    settings = {
			    activeClass:        'is-active',
			    elemClass:          '',
			    elemClassAttribute: 'data-elem-class'
		    };
		
		var init = function () {

            triggerNext.off('click').on('click', function() {
			
                var id = $('.form__page:visible').data('id');
                var nextId = $('.form__page:visible').data('id')+1;
                var nextHeight = $('[data-id="'+nextId+'"]').height();
                $('[data-id="'+id+'"]').hide();
                $('[data-id="'+id+'"]').css('opacity', '0');
                $('[data-id="'+nextId+'"]').show();
                $('[data-id="'+nextId+'"]').css('opacity', '1');
                target.height(nextHeight + 150);
                
                if($('.back:hidden').length == 1){
                    $('.back').show();
                }
                
                if(nextId == 3){
                    $('.next').hide();
                }
            
            });

            triggerPrev.off('click').on('click', function() {
			
                var id = $('.form__page:visible').data('id');
                var prevId = $('.form__page:visible').data('id')-1;
                var prevHeight = $('[data-id="'+prevId+'"]').height();
                $('[data-id="'+id+'"]').hide();
                $('[data-id="'+id+'"]').css('opacity', '0');
                $('[data-id="'+prevId+'"]').show();
                $('[data-id="'+prevId+'"]').css('opacity', '1');
                $('.next').show();
                target.height(prevHeight + 150);
                
                if(prevId == 1){
                    $('.back').hide();
                }    
            
            });
           
		}
		
		init();
		return this;
	};
	
}(jQuery));