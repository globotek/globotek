<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 30/1/18
 * Time: 12:28 AM
 */
?>

<div class="chunk">
	
	<div class="box wysiwyg">
		
		<h4 class="breathe--bottom">Intro</h4>
		
		<?php chumly_profile( array( 'user_id' => chumly_explode_url()->ID, 'labels' => TRUE, 'exclude' => array('profile_picture', 'profile_introduction' )) ); ?>
<!--		--><?php //chumly_profile( array( 'user_id' => chumly_explode_url()->ID, 'labels' => TRUE) ); ?>
	
	</div>

</div>



