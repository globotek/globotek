<?php
function chumly_form_header( $id = NULL, $class = NULL, $action = '', $encoding = 'multipart/form-data' ) {
	
	global $wpdb;
	
	echo '<form id="' . $id . '" class="' . $class . ' form" method="POST" action="' . $action . '" enctype="' . $encoding . '">';
	
}

function chumly_form_footer( $id = NULL, $class = NULL, $value = 'Update', $attributes = array(), $error = NULL ) {
	
	if( !$error ) {
		
		if( !empty( $attributes ) ) {
			
			foreach( $attributes as $input_name => $input_value ) {
				
				echo '<input type="hidden" name="' . $input_name . '" value="' . $input_value . '" />';
				
			}
			
		}
		
		echo '<div class="form__group form__group--right">';
		
		do_action( 'chumly_form_footer_buttons' );
		
		echo '<input type="submit" class="button button--positive ' . $class . ' ' . $id . '" name="' . $id . '" value="' . $value . '" />';
		
		echo '</div>';
		
	}
	
	echo '</form>';
	?>
	
	<script>
		jQuery(document).ready(function ($) {
			var form         = $('form.register'),
			    password_one = form.find('input[type=password]').first(),
			    password_two = form.find('input[type=password]').last();

			$('.chumly_form input[type=submit]').on('click', function () {
				if (password_one.val() != password_two.val()) {
					password_two.parent().find('.form__error-message').html('Passwords don\'t match, please check both passwords').show();
					$('.chumly_form input[type=submit]').prop('disabled', true);
					console.log('Passwords don\'t match, please check both passwords');
				}
			});

			password_one.add(password_two).on('keyup', function () {
				if (password_one.val() == password_two.val()) {
					password_two.parent().find('.form__error-message').html('Passwords don\'t match, please check both passwords').hide();
					$('.chumly_form input[type=submit]').prop('disabled', false);
					console.log('Passwords don\'t match, please check both passwords');
				}
			});
		});
	</script>
	
	<?php
}


function chumly_format_form_data() {
	
	foreach( $_POST as $item ) {
		
		if( isset( $item[ 'name' ] ) ) {
			$_POST[ $item[ 'name' ] ] = $item[ 'value' ];
		}
		
	}
	
}