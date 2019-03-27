<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 18/9/18
 * Time: 11:55 AM
 */
?>

<?php do_action( 'chumly_before_notification' ); ?>

<li class="list-view__item box box--flush breathe--bottom notification <?php echo $notification_read; ?>" data-module="chumly-notification" data-notification_id="<?php echo $notification->ID; ?>">
	
	<div class="notification__inner">
		
		<figure class="notification__image avatar avatar--round">
			<?php chumly_avatar( $notification->sender_id, $notification->source ); ?>
		</figure>
		
		<a href="<?php echo $notification->link; ?>" class="notification__body">
			
			<p>
				<?php echo esc_attr( $sender_data->data->display_name . ' ' . $notification->message ); ?>
			</p>
			
			<div class="notification__meta">
				
				<div class="notification__meta__icon">
					<?php chumly_icon( 'globe' ); ?>
				</div>
				
				<time class="notification__meta__timestamp" datetime="04-06-2015"><?php echo chumly_format_datetime( NULL, date( 'Y-m-d H:i:s', $notification->timestamp ) )->elapsed; ?></time>
			
			</div>
		
		</a>
		
		<a href="#" class="notification__decor" data-action="mark_notifications_read">
			
			<?php chumly_icon( 'circle-check', 'notification__decor__item' ); ?>
		
		</a>
	
	</div>

</li>

<?php do_action('chumly_after_notification'); ?>