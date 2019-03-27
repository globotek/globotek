<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 21/6/18
 * Time: 3:12 PM
 */
?>

<?php do_action('chumly_before_notification'); ?>

<li class="list-view__item box box--flush breathe--bottom notification <?php _e( $notification->viewed == 0 ? 'notification--unread' : '' ); ?>" data-module="chumly-notification" data-notification_id="<?php echo $notification->ID; ?>">
	
	<div class="notification__inner">
		
		<figure class="notification__image avatar avatar--round">
			<?php chumly_avatar( $notification->sender_id, $notification->source ); ?>
		</figure>
		
		<a href="<?php echo $notification->link; ?>" class="notification__body">
			
			<p>
				<?php echo stripslashes( $notification->message ); ?>
			</p>
			
			<span class="notification__meta">
							
				<div class="notification__meta__icon">
					<?php chumly_icon( 'globe' ); ?>
				</div>
						
				<time class="notification__meta__timestamp" datetime="04-06-2015"><?php echo chumly_format_datetime( NULL, date( 'Y-m-d H:i:s', $notification->timestamp ) )->elapsed; ?></time>
			</span>
		
		</a>
		
		<div class="notification__decor">
			
			<a href="#" data-action="mark_notifications_read">
				
				<?php chumly_icon( 'circle-check', 'notification__decor__item' ); ?>
			
			</a>
			
			<a href="<?php echo $notification->link; ?>">
				
				<?php chumly_icon( 'angle-right', 'notification__decor__item' ); ?>
			
			</a>
		
		</div>
	
	</div>
	
</li>

<?php do_action('chumly_after_notification'); ?>
