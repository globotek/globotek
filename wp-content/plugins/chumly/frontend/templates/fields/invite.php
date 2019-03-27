<?php
function chumly_edit_invite_field( $input, $options = NULL, $attributes = NULL ) {
	
	$registration = isset( $_POST[ 'register_user' ] );
	
	//$value = ($registration) ? $_POST[$input->input_name] : $input_value->$value_key;
	
	$count   = 0;
	$invites = array();
	
	echo '<div class="form__group ' . $input->input_placement . '">';
	
	echo '<label class="form__group__label ' . $options[ 'label_class' ] . '" for="' . $input->input_id . '">' . $input->input_label . '</label>';
	
	echo '<div class="form__group__inline breathe--bottom-mini">';
	
	echo '<input id="' . $input->input_id . '" class="form__group__input form__group__input--singleline ' . $options[ 'input_class' ] . '" type="text" name="' . $input->input_id . '[' . $count . '][first_name]" placeholder="First Name">';
	echo '<input class="form__group__input form__group__input--singleline ' . $options[ 'input_class' ] . '" type="text" name="' . $input->input_id . '[' . $count . '][last_name]" placeholder="Last Name">';
	echo '<input class="form__group__input form__group__input--singleline ' . $options[ 'input_class' ] . '" type="email" name="' . $input->input_id . '[' . $count . '][email]" placeholder="Email">';
	
	echo '</div>';
	
	echo '<div class="button-group button-group--right">';
	echo '<div class="button-group__item">';
	echo '<button class="button button--positive " id="new_form_row" data-count="' . $count . '"><i class="fa fa-plus-circle"></i></button>';
	echo '</div>';
	echo '</div>';
	
	if ( $registration && empty( $_POST[ $input->input_name ] ) ) {
		echo '<span class="' . $options[ 'error_class' ] . '">Please enter your ' . lcfirst( $input->input_label ) . '</span>';
	}
	
	
	echo '</div>';
	
}


function chumly_process_invite_field( $data ) {
	
	if ( $data[ 'input' ]->input_type == 'invite' ) {
		
		if ( $data[ 'value' ] ) {
			
			function set_html_content_type() {
				return 'text/html';
			}
			
			add_filter( 'wp_mail_content_type', 'set_html_content_type' );
			
			foreach ( $data[ 'value' ] as $invite ) {
				
				if ( !email_exists( $invite[ 'email' ] ) ) {
					
					$link         = home_url( '/' ) . 'register?group_id=' . $_POST[ 'group_id' ] . '&email_invite=true';
					$headers      = 'From: Chumly <matthew@globotek.net>';
					$message_body = 'Hi ' . $invite[ 'first_name' ] . ',<br><br>Welcome to the group, click <a href="' . $link . '">here</a> to accept your invitation.<br><br>Regards,<br>Chumly';
					$mail_invite  = wp_mail( $invite[ 'email' ], 'You\'ve been invited to join a group', $message_body, $headers );
					
				} else {
					
					//	$link         = Chumly_Groups::get_group_url( $_POST[ 'group_id' ] );
					$link         = '';
					$headers      = 'From: Chumly <matthew@globotek.net>';
					$message_body = 'Hi ' . $invite[ 'first_name' ] . ',<br><br>Welcome to the group, click <a href="' . $link . '">here</a> to accept your invitation.<br><br>Regards,<br>Chumly';
					$mail_invite  = wp_mail( $invite[ 'email' ], 'You\'ve been invited to join a group', $message_body, $headers );
					
				}
				
			}
			
			remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
			
		}
		
	}
	
}

add_action( 'chumly_process_invite_field', 'chumly_process_invite_field' );
