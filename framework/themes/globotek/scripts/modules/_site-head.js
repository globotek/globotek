(function($) {

	$.fn.siteHead = function() {
		var elem = $(this),
			settings = {
				activeClass: 'is-active'
			};

		var init = function() {
console.log('Head');
			settings = $.extend(true, {}, settings, elem.parseSettings());

			var navTrigger = $('.site-head .js-toggle__trigger'),
				navElem = $('.site-head__nav');

			navTrigger.on('click', function(){

				if(navElem.hasClass('is-active')){
					console.log('Active');
					$('body').addClass('is-locked');
				} else {
					console.log('Not Active');
					$('body').removeClass('is-locked');
				}

			})


			// This is a stub module. Go ahead and delete it if you don't need it
		};

		init();
		return this;
	};

}(jQuery));