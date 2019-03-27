<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 29/1/18
 * Time: 10:45 PM
 */
$friends = chumly_get_friends( chumly_user_id() ); ?>

<div class="chunk">
	
	<div class="box">
		
		<h4 class="breathe--bottom">Friends</h4>
		
		<div class="grid grid--left grid--thirds">
			
			<?php if ( ! empty( $friends ) ) { ?>
				
				<?php foreach ( $friends as $friend ) { ?>
					
					<a href="<?php echo chumly_profile_url( $friend->ID ); ?>" class="grid__item">
						
						<figure class="avatar avatar--medium">
							<?php chumly_avatar( $friend->ID ); ?>
						</figure>
						
						<p><?php echo $friend->display_name; ?></p>
					
					</a>
				
				<?php } ?>
			
			<?php } else { ?>
				
				<p>You haven't got any friends at the moment. </p>
			
			<?php } ?>
		
		</div>
	
	</div>

</div>