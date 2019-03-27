<?php //$user = get_userdata( get_current_user_id() ); ?>
<?php //$notifications = new Chumly_Notifications(); ?>
<?php //$notifications = $notifications->chumly_get_notifications(); ?>
<?php //chumly_read_notification( $notifications ); ?>
<?php do_action( 'chumly_before_content' ); ?>

<?php $notifications = new Chumly_Notifications(); ?>
<?php //var_dump( $notifications->get_notifications() ); ?>

<?php do_action( 'chumly_before_content' ); ?>

<div class="navigator navigator--skinny-sidebar">

    <div class="navigator__sidebar">
		
		<?php chumly_sidebar( 'main' ); ?>

    </div>

    <div class="navigator__content">

        <h2 class="breathe--bottom">Notifications</h2>

        <ul class="list-view">
		
		    <?php foreach ( $notifications->get_notifications() as $notification ) { ?>
			
			    <?php $notifications->output_notification( $notification ); ?>
		
		    <?php } ?>

        </ul>

    </div>

</div>

<?php do_action( 'chumly_after_content' ); ?>

