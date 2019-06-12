(function ($) {
	
	$.fn.formPage = function () {
        var elem     = $(this),
            targets = elem.find('.js-page__target'),
            triggerNext = elem.find('.js-next__trigger'),
            triggerPrev = elem.find('.js-prev__trigger'),
		    settings = {
			    activeClass:        'is-active',
			    visibleClass:       'is-active',
			    elemClass:          '',
			    elemClassAttribute: 'data-elem-class'
		    };
		
		var init = function () {

            
            triggerNext.off('click').on('click', function() {
			
                var id = $('.form__page:visible').data('id');
                var nextId = $('.form__page:visible').data('id')+1;
                $('[data-id="'+id+'"]').hide();
                $('[data-id="'+nextId+'"]').show();
                
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
                $('[data-id="'+id+'"]').hide();
                $('[data-id="'+prevId+'"]').show();
                $('.next').show();
                
                if(prevId == 1){
                    $('.back').hide();
                }    
            
            });
           
		}
		
		init();
		return this;
	};
	
}(jQuery));