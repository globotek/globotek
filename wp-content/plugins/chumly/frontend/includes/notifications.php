<?php


/**
 * @TODO Move to proper JS file
 */
function chumly_poll_notifications() {
	?>
	<script>
		jQuery(document).ready(function ($) {
			var loop_count = 0;
			
			setInterval(function () {
				
				if (loop_count >= 120) {
					
					return false;
					
				} else {
					
					$.ajax({
						url: chumly_vars.ajax_url,
						type: 'POST',
						data: {
							action: 'chumly_get_notifications',
							live_update: true
						},
						success: function (data) {
							$('#profile-ajax-response').html(data);
						}
					});
					
				}
				
				loop_count++;
				
			}, 5000);
			
		});
	</script>
	<?php
}

//add_action('wp_head', 'chumly_poll_notifications');




