<div class="chumly">

	<div class="wrapper">
		
		<?php if ( is_user_logged_in() ) { ?>
			
			<?php echo chumly_alert( 'standard', 'You\'re already logged in. <a href="' . home_url() . '/profile">Go to your Profile.</a>' ); ?>
		
		<?php } elseif ( isset( $_GET[ 'registered' ] ) && $_GET[ 'registered' ] == TRUE ) { ?>
			
		
			
			<?php echo do_shortcode( '[chumly_login redirect="profile"]' ); ?>
		
		<?php } else { ?>
			
			<?php chumly_form_header( 'register', NULL ); ?>

			<?php $registration = chumly_register_profile( $atts ); ?>
			
			<?php chumly_form_footer( 'register_profile', NULL, 'Register', $registration ); ?>
		
		<?php } ?>
	
	</div>

</div>

