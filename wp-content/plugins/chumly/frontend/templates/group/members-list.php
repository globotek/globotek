<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 31/5/18
 * Time: 2:56 PM
 */ ?>

<?php
$group_membership        = new Chumly_Group_Membership();
$group_id                = chumly_explode_url()->ID;
$current_user_membership = $group_membership->check_membership( $group_id, get_current_user_id() ); ?>
<?php //var_dump($data); ?>
<div class="breathe--bottom">
	
	<?php chumly_get_template( 'global', 'user-search', NULL, array(
		'placeholder'   => 'Add members to group',
		'submit_button' => TRUE,
		'object_id'     => $group_id
	) ); ?>

</div>

<div class="tabs" data-module="chumly-tabs" data-settings='{"singleToggle": true}'>
	<nav class="tabs__nav">
		<a href="#members" class="tabs__tab is-active chumly-tabs__trigger" role="button">
			<div class="tabs__tab__inner">Members</div>
		</a>
		<a href="#admins" class="tabs__tab chumly-tabs__trigger" role="button">
			<div class="tabs__tab__inner">Admins</div>
		</a>
		<a href="#applicants" class="tabs__tab chumly-tabs__trigger" role="button">
			<div class="tabs__tab__inner">Applicants</div>
		</a>
		<!--		<a href="#banned" class="tabs__tab is-active chumly-tabs__trigger" role="button"><div class="tabs__tab__inner">Banned</div></a>-->
	</nav>
	
	<div class="tabs__panels">
		
		
		<div class="tabs__panel chumly-tabs__target" id="members">
			<a href="#members" class="tabs__panel__heading is-active chumly-tabs__trigger" role="button">Members</a>
			<div class="tabs__panel__inner">
				
				<ul class="user-list user-list--white">
					
					<?php foreach ( $data->members as $member ) { ?>
						
						<?php $membership = $group_membership->check_membership( $group_id, $member->user_id ); ?>
						<?php //echo( $membership[ 'status' ] ); ?>
						
						<?php $member_name = chumly_get_profile_field( $member->user_id, 'first_name' )->value . ' ' . chumly_get_profile_field( $member->user_id, 'last_name' )->value; ?>
						
						<li class="user-list__item">
							
							<div class="user-list__item__inner user-list__item__inner--media">
								
								<a href="<?php echo chumly_profile_url( $member->user_id ); ?>" class="user-list__item__media">
									<figure class="avatar avatar--medium">
										<?php chumly_avatar( $member->user_id, 'profile', 'avatar__image' ); ?>
									</figure>
								</a>
								
								<div class="user-list__item__text">
									<div class="button-group button-group--split">
										<a href="<?php echo chumly_profile_url( $member->user_id ); ?>" class="user-list__item__text--primary">
											<?php echo $member_name; ?>
										</a>
										
										<?php if ( $member->user_id != get_current_user_id() && ( $current_user_membership->status == 'owner' || $current_user_membership->status == 'admin' ) ) { ?>
											
											<a class="user-list__item__text--link delete_group_member" href="#" data-user_id="<?php echo $member->user_id; ?>" data-group_id="<?php echo $group_id; ?>">Remove</a>
										
										<?php } ?>
									
									</div>
								</div>
							
							</div>
						
						</li>
					
					<?php } ?>
									
				</ul>
			
			</div>
		</div>
		
		<div class="tabs__panel chumly-tabs__target" id="admins">
			<a href="#admins" class="tabs__panel__heading chumly-tabs__trigger" role="button">Admins</a>
			<div class="tabs__panel__inner">
				<ul class="user-list user-list--white">
					
					<?php foreach ( $data->admins as $member ) { ?>
						
						<?php $membership = $group_membership->check_membership( $group_id, $member->user_id ); ?>
						<?php //echo( $membership[ 'status' ] ); ?>
						
						<?php $member_name = chumly_get_profile_field( $member->user_id, 'first_name' )->value . ' ' . chumly_get_profile_field( $member->user_id, 'last_name' )->value; ?>
						
						<li class="user-list__item">
							
							<div class="user-list__item__inner user-list__item__inner--media">
								
								<a href="<?php echo chumly_profile_url( $member->user_id ); ?>" class="user-list__item__media">
									<figure class="avatar avatar--medium">
										<?php chumly_avatar( $member->user_id, 'profile', 'avatar__image' ); ?>
									</figure>
								</a>
								
								<div class="user-list__item__text">
									<div class="button-group button-group--split">
										<a href="<?php echo chumly_profile_url( $member->user_id ); ?>" class="user-list__item__text--primary">
											<?php echo $member_name; ?>
										</a>
										
										<?php if ( $member->user_id != get_current_user_id() && ( $current_user_membership->status == 'owner' || $current_user_membership->status == 'admin' ) ) { ?>
											
											<a class="user-list__item__text--link delete_group_member" href="#" data-user_id="<?php echo $member->user_id; ?>" data-group_id="<?php echo $group_id; ?>">Remove</a>
										
										<?php } ?>
									
									</div>
								</div>
							
							</div>
						
						</li>
					
					<?php } ?>
				
				</ul>
			
			</div>
		</div>
		
		<div class="tabs__panel chumly-tabs__target" id="applicants">
			<a href="#applicants" class="tabs__panel__heading chumly-tabs__trigger" role="button">Applicants</a>
			<div class="tabs__panel__inner">
				
				<ul class="user-list user-list--white">
					
					<?php foreach ( $data->applicants as $member ) { ?>
						
						<?php $membership = $group_membership->check_membership( $group_id, $member->user_id ); ?>
						<?php //echo( $membership[ 'status' ] ); ?>
						
						<?php $member_name = chumly_get_profile_field( $member->user_id, 'first_name' )->value . ' ' . chumly_get_profile_field( $member->user_id, 'last_name' )->value; ?>
						
						<li class="user-list__item">
							
							<div class="user-list__item__inner user-list__item__inner--media">
								
								<a href="<?php echo chumly_profile_url( $member->user_id ); ?>" class="user-list__item__media">
									<figure class="avatar avatar--medium">
										<?php chumly_avatar( $member->user_id, 'profile', 'avatar__image' ); ?>
									</figure>
								</a>
								
								<div class="user-list__item__text">
									<div class="button-group button-group--split">
										<a href="<?php echo chumly_profile_url( $member->user_id ); ?>" class="user-list__item__text--primary">
											<?php echo $member_name; ?>
										</a>
										
										<?php if ( $member->user_id != get_current_user_id() && ( $current_user_membership->status == 'owner' || $current_user_membership->status == 'admin' ) ) { ?>
											
											<a class="user-list__item__text--link approve_group_member" href="#" data-user_id="<?php echo $member->user_id; ?>" data-group_id="<?php echo $group_id; ?>">Approve</a>
											<a class="user-list__item__text--link decline_group_member" href="#" data-user_id="<?php echo $member->user_id; ?>" data-group_id="<?php echo $group_id; ?>">Decline</a>
										
										<?php } ?>
									
									</div>
								</div>
							
							</div>
						
						</li>
					
					<?php } ?>
				
				</ul>
			
			</div>
		</div>
	
	</div>

</div>


