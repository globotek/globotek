<?php
/**
 * chumly_before_content hook.
 *
 * @hooked chumly_wrapper_start - 0 (outputs chumly, wrapper and chunk divs)
 *
 */
do_action( 'chumly_before_content' ); ?>

<?php $groups = new Chumly_Groups(); ?>

<?php $groups_data = $groups->get_all_groups( 8 ); ?>
	
	<!-- ARCHIVE LAYOUT -->
	
	<section class="archive navigator navigator--skinny-sidebar">
		
		<div class="navigator__sidebar">
			
			<?php chumly_sidebar( 'main' ); ?>
		
		</div>
		
		
		<div class="navigator__content">
			
			<div class="archive__content__header">
				
				<div class="button-group button-group--right">
					<a href="/groups/create" class="button button--positive ">+ Create Group</a>
				</div>
			
			</div>
			
			<div class="archive__content__body box">
				
				<ol class="grid">
					
					<?php foreach ( $groups_data->posts as $group ) { ?>
						
						<?php $group_data = chumly_unserialize( $group->group_data ); ?>
						
						<li class="grid__item--desk--one-quarter grid__item--lap--one-half card breathe--bottom">
							
							<div class="card__inner">
								<?php echo $group->is_public; ?>
								<?php $group_url = home_url( '/' . chumly_get_option( 'group_archive_page' ) . '/' ) . $group->name . '_' . $group->ID; ?>
								
								<a href="<?php echo $group_url; ?>" class="card__image avatar avatar--auto">
									<?php chumly_avatar( $group->ID, 'group' ); ?>
								</a>
								
								<div class="card__text">
									<p>
										<a href="<?php echo $group_url; ?>"><?php echo stripslashes( $group->title ); ?></a>
									</p>
									<p><?php echo $groups->get_group_member_count( $group->ID ) . ' members'; ?></p>
								</div>
								
								<div class="card__members">
									
									<?php $members = $groups->get_group_members( $group->ID, array( 'any' ), 5 ); ?>
									<?php $members = array_merge( $members->admins, $members->members ); ?>
									
									<?php foreach ( $members as $member ) { ?>
										
										<a href="<?php echo chumly_profile_url( $member->user_id ); ?>">
											
											<?php chumly_avatar( $member->user_id, 'profile', 'avatar__image avatar--round avatar--small' ); ?>
										
										</a>
									
									<?php } ?>
								
								
								</div>
							
							</div>
						</li>
					
					<?php } ?>
				
				</ol>
			
			</div>
			
			
			<div class="archive__content__footer">
				
				<?php chumly_pagination( $groups_data->total_pages, $groups_data->current_page, 'group_archive_page' ); ?>
			
			</div>
		
		</div>
	
	</section>
	
	<!-- ARCHIVE LAYOUT -->


<?php do_action( 'chumly_after_content' ); ?>