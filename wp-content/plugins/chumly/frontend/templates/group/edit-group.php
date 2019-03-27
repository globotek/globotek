<?php do_action( 'chumly_before_content' ); ?>

<?php if ( ! is_user_logged_in() ) { ?>
	
	<?php chumly_login_form(); ?>

<?php } else { ?>
	
	<?php chumly_login_alert(); ?>
	
	<?php chumly_form_header('edit_group_form'); ?>
	
	<?php Chumly_Groups::edit_group(chumly_explode_url()->ID, array('group_invites', 'group_description')); ?>
	
	<?php chumly_form_footer( 'update_group', 'update_group', 'Update Group' ); ?>
	
	<div id="saved_response"></div>
	
<?php } ?>

<?php do_action( 'chumly_after_content' ); ?>


