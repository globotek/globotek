<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 5/12/16
 * Time: 7:49 PM
 */
?>

<div class="user-profile__header__content">

	<h2 class="user-profile__heading"><?php echo chumly_username(); ?></h2>
	
	<p class="user-profile__summary"><?php echo stripslashes( chumly_get_profile_field( chumly_explode_url()->ID, 'profile_introduction' )->value ); ?></p>
	
</div>

