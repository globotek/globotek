<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 5/12/16
 * Time: 7:48 PM
 */
global $chumly;

if ( $chumly->templates->profile->avatars ) { ?>
	
	<div class="user-profile__header__avatar" data-module="chumly-modal">
		
		<?php chumly_modal( 'edit-profile-picture', 'update_profile', 'Update Profile Picture' ); ?>
		
		<!-- AVATAR COMPONENT -->
		<figure class="avatar avatar--large">
			<?php chumly_avatar(); ?>
			
			<?php if(chumly_own_profile()){ ?>
			
				<a href="#edit_avatar" class="avatar__edit button button--primary chumly-modal__trigger">Update</a>
			
			<?php } ?>
			
		</figure>
		<!-- AVATAR COMPONENT -->
	
	</div>

<?php } ?>
