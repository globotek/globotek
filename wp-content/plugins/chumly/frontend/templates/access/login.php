<?php do_action( 'chumly_before_content' ); ?>

<?php if ( is_user_logged_in() ) { ?>
	
	<?php chumly_login_alert(); ?>

<?php } else { ?>
	
	<?php if ( isset( $_GET[ 'requested_url' ] ) ) { ?>
		
		<?php $redirect = $_GET[ 'requested_url' ]; ?>
	
	<?php } else { ?>
		
		<?php $redirect = home_url( '/' ) . chumly_get_option( 'user_profile_page' ); ?>
	
	<?php } ?>
	
	<?php chumly_login_form( array( 'redirect' => $redirect ) ); ?>

<?php } ?>

<?php do_action( 'chumly_after_content' ); ?>
