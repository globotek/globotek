/**
 * Created by matthew on 2/4/19.
 */
(function ($) {
	
	$.fn.freshSales = function () {
		
		var elem          = $(this),
		    errorPrompt   = elem.find('.contact-form__errors'),
		    successPrompt = elem.find('.contact-form__prompt');
		
		
		var init = function () {
			
			console.log('a');
			var disabledDates = ['2019-06-28', '2019-06-13', '2019-06-21'];
			$('.js-datepicker').datepicker({
				firstDay:      7,
				dateFormat: 'DD-yy-mm-dd',
				minDate: 0,
				maxDate: '+1m',
				dayNamesMin:   ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
				beforeShowDay: function (date) {
					var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
					return [disabledDates.indexOf(string) == -1];
				},
				altField:      '.js-datepicker-selection',
				altFormat:     'DD, d MM',
				nextText:      '',
				prevText:      '',
				onSelect: function(date){
					
					$.ajax({
						url:     gtek_vars.ajax_url,
						method:  'POST',
						data:    {
							'action':    'gtek_get_available_timeslots_for_date',
							'date': date
						},
						success: function (data) {
							
							console.log(data);
							
						}
					});
				}
				
			});
			
			
			$('#submit-contact-form').on('click', function (event) {
				
				event.preventDefault();
				
				errorPrompt.hide();
				successPrompt.hide();
				
				if (!$('input[name="contact-form-name"]').val() || !$('input[name="contact-form-email"]').val()) {
					
					errorPrompt.show();
					
				} else {
					
					var splitName = $('input[name="contact-form-name"]').val().split(' '),
					    lastName  = splitName[splitName.length - 1];
					
					splitName.pop();
					
					var leadData = {
						
						'first_name':     splitName.join(' '),
						'last_name':      lastName,
						'emails':         $('input[name="contact-form-email"]').val(),
						'lead_source_id': $('input[name="contact-form-source_id"]').val(),
						'work_number':    $('input[name="contact-form-phone"]').val(),
						'name':           $('input[name="contact-form-company"]').val(),
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
						data:    {
							'action':    'gtek_submit_to_freshsales',
							'lead_data': leadData
						},
						success: function (data) {
							
							successPrompt.show();
							
						}
					});
					
				}
				
			});
			
			
			$('#submit_appointment_booking').on('click', function (event) {
				
				
			});
			
		};
		
		init();
		return this;
		
	}
	
}(jQuery));