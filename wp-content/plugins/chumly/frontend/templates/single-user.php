<?php global $chumly; ?>

<?php $target_id = chumly_user_id(); ?>

<?php $privacy = chumly_check_privacy( $target_id ); ?>

<?php
/**
 * chumly_before_content hook.
 *
 * @hooked chumly_wrapper_start - 0 (outputs chumly, wrapper and chunk divs)
 *
 */
do_action( 'chumly_before_content' ); ?>

<!-- USER PROFILE LAYOUT STARTS -->
<section class="user-profile">
	
	<?php
	/**
	 * @todo Add an action for before  profile header.
	 */
	?>
	
	
	<header class="user-profile__header">
		
		<?php
		/**
		 * chumly_profile_header hook.
		 *
		 * @hooked chumly_profile_picture - 5
		 * @hooked chumly_profile_title - 10
		 *
		 */
		
		do_action( 'chumly_profile_header' );
		?>
	
	
	</header>
	
	
	<div class="user-profile__interactions">
		
		<?php
		/**
		 * chumly_profile_interactions.
		 *
		 * @hooked chumly_profile_networks - 5
		 * @hooked chumly_profile_interactions - 10
		 */
		
		do_action( 'chumly_profile_interactions' );
		?>
	
	</div>
	
	<?php do_action( 'chumly_before_' ) ?>
	
	<?php
	switch ( $chumly->templates->profile->layout ) {
		case 1:
			//echo 'Sidebar & content';
			break;
		case 2:
			echo 'Column';
			break;
		case 3:
			echo 'No feed';
			break;
	} ?>
	
	<?php if ( $privacy ) { ?>
		
		<!-- DEFAULT -->
		<div class="navigator">
			
			<div class="navigator__sidebar">
				
				<div class="user-profile__activity">
					<h3 class="user-profile__sub-heading">Profile</h3>
					
					<?php do_action( 'chumly_profile_sidebar' ); ?>
				
				</div>
			
			</div>
			
			<div class="navigator__content">
				
				<div class="user-profile__activity">

					<?php chumly_get_user( array( 'id' => $target_id ) ); ?>
					
					<h3 class="user-profile__sub-heading">Post a Status</h3>
					
					<div class="chunk">
						
						<?php chumly_post_form( 'chumly_status_post', array(
							'target_id' => chumly_explode_url()->ID,
							'media_classification'    => 'photos',
							'id'        => 'profile_upload'
						) ); ?>
      
						<?php chumly_post_feed(array(
							'post_type'      => array( 'chumly_status_post', 'chumly_shared' ),
							'posts_per_page' => 20,
							'tax_query'      => array(
								'relation' => 'OR',
								array(
									'taxonomy' => 'chumly_post_target',
									'field'    => 'slug',
									'terms'    => $target_id
								),
								array(
									'taxonomy' => 'chumly_linked',
									'field'    => 'slug',
									'terms'    => $target_id
								)
							)
						)); ?>
						<?php //chumly_get_template( 'user', 'activity-feed' ); ?>
					</div>
				
				</div>
			
			</div>
		
		</div>
		<!-- DEFAULT -->
	
	<?php } else { ?>
		
		<div class="breathe--top box">
			
			<h3 class="title">This profile is private</h3>
		
		</div>
	
	<?php } ?>

</section>
<!-- USER PROFILE LAYOUT ENDS -->


<?php
/**
 * chumly_before_content hook.
 *
 * @hooked chumly_wrapper_end - 100 (outputs chumly, wrapper and chunk div closures)
 */
do_action( 'chumly_after_content' );
?>


