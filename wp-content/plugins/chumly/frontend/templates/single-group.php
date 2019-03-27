<?php do_action( 'chumly_before_content' ); ?>
<?php
global $chumly_group;

$group_name = $chumly_group->name;
$group_id   = $chumly_group->id;

$group = new Chumly_Groups();

$group_data    = $group->get_group( $group_id );
$group_fields  = $group->group_fields( $group_id );
$group_members = $group->get_group_members( $group_id, array( 'all' ) );

$group_membership = new Chumly_Group_Membership();
$user_membership  = $group_membership->check_membership( $group_id );

$current_user_id = get_current_user_id(); ?>
	
	<div class="navigator navigator--content-full-width">
		
		
		<?php if ( ( $group->is_secret( $group_id ) || $group->is_private( $group_id ) ) && $user_membership['is_active'] || $group->is_public( $group_id ) ) { ?>
			
			<div class="navigator__content">
				<?php //chumly_alert( 'success', 'This is an alert' ); ?>
				<?php //chumly_alert( 'error', 'There was an error' ); ?>
				<?php //chumly_alert_modal( 'success', 'This is an alert' ); ?>
				
				<div class="chunk">
					
					<div class="hero hero--400">
						
						<?php chumly_avatar( $group_id, 'group', 'hero__image' ); ?>
					
					</div>
				
				</div>
			
			</div>
		
		<?php } elseif ( $group->is_private( $group_id ) ) { ?>
			
			<div class="navigator__content">
				
				<div class="chunk">
					
					<h3 class="grid">Join group</h3>
				
				</div>
			
			</div>
		
		
		<?php } else { ?>
			
			<div class="navigator__content">
				
				<div class="chunk">
					
					<h3 class="grid">This is a secret group</h3>
				
				</div>
			
			</div>
		
		<?php } ?>
	
	</div>


<?php if ( 1 == 1 ) { ?>
<?php //if ( ( $group->is_secret( $group_id ) || $group->is_private( $group_id ) ) && $user_membership->is_active || $group->is_public( $group_id ) ) { ?>
	
	<div class="navigator">
		
		<div class="navigator__content">
						
			<div class="headline">
				
				<figure class="avatar avatar--large">
					
					<?php chumly_avatar( $group_id, 'group' ); ?>
				
				</figure>
				
				
				<h1 class="headline__heading breathe--top"><?php $group->group_field( $group_id, 'group_name' ); ?></h1>
			
			</div>
			
			
			<div class="chunk">
				<div class="wysiwyg"><?php echo stripslashes_deep( $group_fields->description->value ); ?></div>
			</div>
		
		
		</div>
		
		
		<div class="navigator__sidebar">
			
			<div class="chunk">
				<div class="button-group button-group--right">

					<?php if ( is_user_logged_in() && $user_membership['status'] != 'owner' ) { ?>
						<?php //var_dump($user_membership); ?>
						<?php //var_dump(get_user_meta( $current_user_id, 'user_public_groups', true )); ?>
						<?php //var_dump(get_user_meta( $current_user_id, 'user_private_groups', true )); ?>
						
						<button class="group_connection_action button <?php echo $user_membership['css_class']; ?>"
						        membership-status="<?php echo $user_membership['status']; ?>"
						        connection-id="<?php echo $user_membership['group_id']; ?>"
						        connection-action="<?php echo $user_membership['action']; ?>">
							<?php echo $user_membership['button_label']; ?>
						</button>
					
					<?php } elseif ( ! is_user_logged_in() ) { ?>
						
						<?php chumly_login_form(); ?>
					
					<?php } else { ?>
						
						<a href="<?php echo chumly_edit_group_link( $group_id ); ?>" class="button button--primary">Manage Group</a>
					
					<?php } ?>
				</div>
			
			</div>
		
		</div>
	
	</div>
	
	<div class="chunk chunk--double">
		
		<div class="navigator">
			
			<div class="navigator__content">
				
				<h3>Post a message</h3>
				
				<?php chumly_post_form( 'chumly_group_message', array( 'target_id' => $group_id ) ); ?>
				<?php chumly_get_template( 'group', 'activity-feed', $group_id ); ?>
				
			</div>
			
			
			<div class="navigator__sidebar">
				
				<h3>Members</h3>
				
				<div class="chunk">
					
					<?php chumly_get_template( 'groups', 'members-list', NULL, $group_members ); ?>
				
				</div>
				
				<div class="chunk">
										
					<?php if ( $group_membership->check_membership( $group_id, $current_user_id )->is_admin ) { ?>
						
						<a href="<?php echo chumly_edit_group_link( $group_id ); ?>" class="button button--primary ">Edit Group</a>
					
					<?php } ?>
					
					<?php if ( $group_membership->check_membership( $group_id, $current_user_id )->is_owner ) { ?>
						
						
						<a href="#" id="delete_group" data-group_id="<?php echo $group_id ?>" class="button button--negative ">Delete Group</a>
					
					<?php } ?>
				
				</div>
			
			</div>
		
		</div>
	
	</div>

<?php } ?>

<?php chumly_modal( 'alert', '' ); ?>

<?php do_action( 'chumly_after_content' ); ?>