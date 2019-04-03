(function ($) {
	
	$.fn.rangeSlider = function () {
		var elem     = $(this),
		    triggers = elem.find('.js-range__trigger'),
		    settings = {
			    activeClass:        'is-active',
			    visibleClass:       'is-active',
			    elemClass:          '',
			    elemClassAttribute: 'data-elem-class'
		    };
		
		var init = function () {
			
			triggers.off('input').on('input', function () {
				
				var control           = $(this),
				    controlMin        = control.attr('min'),
				    controlMax        = control.attr('max'),
				    controlVal        = control.val(),
				    controlThumbWidth = control.data('thumbwidth');
				
				var range = controlMax - controlMin;
				
				var position       = ((controlVal - controlMin) / range) * 100;
				var positionOffset = Math.round(controlThumbWidth * position / 100) - (controlThumbWidth / 2);
				var output         = control.next('output');
				
				if (controlVal == 25000) {
					
					controlVal = controlVal + '+';
					
				}
				
				output.css('left', 'calc(' + position + '% - ' + positionOffset + 'px - 51px)').text('£' + controlVal);
				
			}).trigger("change");
			
		}
		
		init();
		return this;
	};
	
}(jQuery));