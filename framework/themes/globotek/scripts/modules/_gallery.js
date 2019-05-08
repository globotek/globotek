/**
 * Created by matthew on 3/5/19.
 */
(function ($) {
	
	$.fn.gallery = function () {
		
		var elem = $(this);
		
		var init = function () {
			
			console.log('Packery Time', elem);
			
			elem.isotope({
				layoutMode:      'packery',
				itemSelector:    '.gallery__item',
				percentPosition: true,
				packery:         {
					gutter: 30,
					//horizontal: true
				}
			});
			
		};
		
		init();
		return this;
		
	}
	
	
}(jQuery));