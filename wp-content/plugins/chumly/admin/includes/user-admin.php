<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 14/12/18
 * Time: 12:47 PM
 */
function chumly_admin_edit_profile() {
	
	echo '<h2>Chumly</h2>';
	
	echo '<div class="chumly form-table">';
	
	chumly_form_header( NULL, NULL, 'multipart/form-data' );
	
	chumly_edit_profile( array( 'user_email', 'first_name', 'last_name', 'password_one', 'password_two' ) );
	
	chumly_form_footer( 'update_profile', NULL, 'Update Profile' );
	
	echo '</div>';
	
}

//add_action( 'show_user_profile', 'chumly_admin_edit_profile' );