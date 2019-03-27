<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 17/9/18
 * Time: 12:24 PM
 */

$sender_data = get_userdata( $notification->sender_id ); ?>

<li class="list-view__item box box--flush breathe--bottom">
	
	<div class="notification">
		
		<div class="notification__inner">
			
			<figure class="notification__image avatar avatar--round">
				<?php chumly_avatar( $notification->sender_id, $notification->source ); ?>
			</figure>
			
			<a href="<?php echo $notification->link; ?>" class="notification__body">
				<p>
					<?php echo $notification->message; ?>
				</p>
				<!--<a href="--><?php //echo $notification->source_link; ?><!--">View</a>-->
				<!--<a href="#" class="comment__reply">Reply</a>-->
				
				<span class="notification__meta">
							
				<div class="notification__meta__icon">
					<?php chumly_icon( 'globe' ); ?>
				</div>
						
				<time class="notification__meta__timestamp" datetime="04-06-2015"><?php echo chumly_format_datetime( NULL, date( 'Y-m-d H:i:s', $notification->timestamp ) )->elapsed; ?></time>
			</span>
			
			</a>
			
			<a href="<?php echo $notification->link; ?>" class="notification__decor">
				<?php chumly_icon( 'angle-right', 'notification__decor__item', 'static' ); ?>
			</a>
			
		</div>
	
	</div>
</li>