<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 5/12/16
 * Time: 7:52 PM
 */
?>

<?php $user_id = chumly_user_id(); ?>

<?php if ( is_user_logged_in() && chumly_check_privacy( $user_id ) || chumly_own_profile() ) { ?>
	
	<div class="user-profile__interactions__item">
		
		<!-- BUTTON GROUP -->
		<!-- Only one button here, but it gives you plenty of scalabilty -->
		<?php chumly_connection_button( $user_id ); ?>
		<!-- BUTTON GROUP -->
		
		
		<div id="connection_ajax_response"></div>
	
	
	</div>

<?php } ?>