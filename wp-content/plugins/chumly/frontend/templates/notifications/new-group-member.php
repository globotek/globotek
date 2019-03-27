<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 20/6/18
 * Time: 12:59 AM
 */
?>

<?php do_action( 'chumly_before_notification' ); ?>

<li class="list-view__item box box--flush breathe--bottom notification <?php echo $notification_read; ?>" data-module="chumly-notification" data-notification_id="<?php echo $notification->ID; ?>">
	
	<div class="notification__inner">
		
		<figure class="notification__image avatar avatar--round">
			
			<a href="<?php echo chumly_profile_url( $notification->sender_id ); ?>">
				
				<?php chumly_avatar( $notification->sender_id, $notification->source ); ?>
			
			</a>
		
		</figure>
		
		<a href="<?php echo $notification->link; ?>" class="notification__body">
			
			<p>
				<?php echo stripslashes( $notification->message ); ?>
			</p>
			
			<div class="notification__meta">
				
				<div class="notification__meta__icon">
					<?php chumly_icon( 'globe' ); ?>
				</div>
				
				<time class="notification__meta__timestamp" datetime="04-06-2015"><?php echo chumly_format_datetime( NULL, date( 'Y-m-d H:i:s', $notification->timestamp ) )->elapsed; ?></time>
			
			</div>
		
		</a>
		
		<!--		<div class="notification__interactions">
			
			<?php /*$group_id = chumly_explode_url( $notification->link )->ID; */?>
			
			<?php /*$group_membership = new Chumly_Group_Membership(); */?>
			
			<?php /*$membership = $group_membership->check_membership( $group_id, $notification->sender_id ); */?>
			<?php /*//var_dump($membership); */?>
			<?php /*if ( $membership->status == 'pending' && !$notification->viewed ) { */?>
				
				<a href="#" class="button  button--positive approve_group_member" data-user_id="<?php /*echo $notification->sender_id; */?>" data-group_id="<?php /*echo $group_id; */?>">Approve</a>
				<a href="#" class="button  button--negative decline_group_member" data-user_id="<?php /*echo $notification->sender_id; */?>" data-group_id="<?php /*echo $group_id; */?>">Decline</a>
			
			<?php /*} */?>
		
		</div>
-->
		<a href="#" class="notification__decor" data-action="mark_notifications_read">
			
			<?php chumly_icon( 'circle-check', 'notification__decor__item' ); ?>
		
		</a>
	
	</div>

</li>

<?php do_action( 'chumly_after_notification' ); ?>
