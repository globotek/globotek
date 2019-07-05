/**
 * Created by matthew on 2/7/19.
 */

(function($){
	
	$('.variations_form input[type="radio"]').on('click', function(){
		
		$('input[name="variation_id"]').val($(this).val());
		
	});
	
})(jQuery);

