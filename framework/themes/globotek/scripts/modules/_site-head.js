(function($) {

	$.fn.siteHead = function() {
		var elem = $(this),
			settings = {
				activeClass: 'is-active'
			};

		var init = function() {
            
			settings = $.extend(true, {}, settings, elem.parseSettings());

			var navTrigger = $('.site-head .js-toggle__trigger'),
				navElem = $('.site-head__nav');

			navTrigger.on('click', function(){

				if(navElem.hasClass('is-active')){
					
                    $('body').addClass('is-locked');
					
				} else {
					
					$('body').removeClass('is-locked');
					
                }

            });

            $('.menu-item-has-children > a .site-head__nav__item__arrow').click(function(e) {
                if(navElem.hasClass('is-active')){
                    
                    e.preventDefault();
                    var $this = $(this);


                    if($this.closest('.menu-item-has-children').hasClass('is-active')) {
                        $this.closest('.menu-item-has-children').removeClass('is-active');
                    } else {
                        $this.closest('.menu-item-has-children').addClass('is-active');
                    }                  

                }
            });

            $('.search__icon').click(function(){
                $('.search').toggleClass('search--open');
            });
              


			// This is a stub module. Go ahead and delete it if you don't need it
		};

		init();
		return this;
	};

}(jQuery));