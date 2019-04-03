/**
 * Created by matthew on 2/4/19.
 */
(function ($) {
	
	$.fn.freshSales = function () {
		
		var init = function () {
			
			console.log('Freshsales Init');
			
			$('#submit-contact-form').on('click', function (event) {
				event.preventDefault();
				
				$('.cta__contact__prompt').hide();
				
				if (!$('input[name="contact-form-name"]').val() || !$('input[name="contact-form-email"]').val()) {
					
					$('.cta__contact__prompt').show();
					console.log('Error');
					
				} else {
					
					var splitName = $('input[name="contact-form-name"]').val().split(' '),
					    lastName  = splitName[splitName.length - 1];
					
					splitName.pop();
					
					var leadData = {
						
						'first_name':     splitName.join(' '),
						'last_name':      lastName,
						'emails':         $('input[name="contact-form-email"]').val(),
						'lead_source_id': $('input[name="contact-form-source_id"]').val(),
						'deal':           {
							'amount': parseInt($('input[name="contact-form-budget"]').val())
							
						},
						'custom_field':   {
							'cf_referrer': $('input[name="contact-form-referrer"]').val()
						},
						'note':           {
							'value':       $('textarea[name="contact-form-message"]').val(),
							'target_type': 'Lead'
						}
						
					};
					
					console.log(leadData);
					$.ajax({
						url:     gtek_vars.ajax_url,
						method:  'POST',
						//dataType: 'json',
						data:    {
							'action':    'gtek_submit_to_freshsales',
							'lead_data': leadData
						},
						success: function (data) {
							
							$('#form-output').html(data);
							
						}
					});
					
				}
				
			});
			
		};
		
		init();
		return this;
		
	}
	
}(jQuery));