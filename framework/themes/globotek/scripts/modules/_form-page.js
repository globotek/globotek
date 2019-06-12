(function ($) {
	
	$.fn.formPage = function () {
		var elem     = $(this),
		    triggers = elem.find('.js-range__trigger'),
		    settings = {
			    activeClass:        'is-active',
			    visibleClass:       'is-active',
			    elemClass:          '',
			    elemClassAttribute: 'data-elem-class'
		    };
		
		var init = function () {

            
			$('body').on('click', '.next', function() { 
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
            
            $('body').on('click', '.back', function() { 
                var id = $('.form__page:visible').data('id');
                var prevId = $('.form__page:visible').data('id')-1;
                $('[data-id="'+id+'"]').hide();
                $('[data-id="'+prevId+'"]').show();
                $('.next').show();
                
                if(prevId == 1){
                    $('.back').hide();
                }    
            });

            $('body').on('click', '.edit-previous', function() { 
                $('.end').hide();
                $('.content-holder').show();
                $('#content-3').show();
            });
            

			
		}
		
		init();
		return this;
	};
	
}(jQuery));