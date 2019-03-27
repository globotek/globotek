<?php do_action( 'chumly_before_content' ); ?>

<?php if ( ! is_user_logged_in() ) { ?>
	
	<?php chumly_login_form(); ?>

<?php } else { ?>
	
	<?php chumly_login_alert(); ?>
	
	<?php chumly_form_header( NULL, NULL, 'multipart/form-data' ); ?>
	
	<?php chumly_edit_profile( array( 'username' ) ); ?>
	
	<?php chumly_form_footer( 'update_profile', NULL, 'Update Profile' ); ?>
	
	<div id="ajax_testing"></div>

<?php } ?>

<?php do_action( 'chumly_after_content' ); ?>

