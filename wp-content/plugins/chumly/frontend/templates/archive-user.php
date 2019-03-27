<?php
/**
 * chumly_before_content hook.
 *
 * @hooked chumly_wrapper_start - 0 (outputs chumly, wrapper and chunk divs)
 *
 */
do_action( 'chumly_before_content' );

$view_mode = 'grid';
//$view_mode = 'list';

global $wp_query;

$current_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
//var_dump( $current_page );
$members_data = new WP_User_Query( array(
	'exclude' => '',
	'number'  => 15,
	'paged'   => $current_page
	/*'meta_query' => array(
		array(
			'key' => 'profile_active',
			'value' => 'active',
			'compare' => '='
		)
	)*/
) );

$members = $members_data->get_results();

$total_users    = $members_data->total_users;
$users_per_page = $members_data->get( 'number' );
$total_pages    = ceil( $total_users / $users_per_page );

//var_dump($members_data);
//var_dump($total_pages);
?>
	
	
	<section class="archive navigator navigator--skinny-sidebar">
		
		<div class="navigator__sidebar">
			
			<?php chumly_sidebar( 'main' ); ?>
			
		</div>
		
		<div class="navigator__content">
			
			<div class="archive__content__body box">
				
				<!-- ARCHIVE VIEW COMPONENT -->
				<ol class="grid grid--fifths">
					
					<?php
					foreach ( $members as $member ) {
						$member_data = array();
						//$member_data['chumly']    = chumly_profile( FALSE, $member->data->ID );
						$member_data[ 'wordpress' ] = get_userdata( $member->data->ID ); ?>
						
						<?php if ( $view_mode == 'grid' ) { ?>
							
							<li class="grid__item card">
								<a href="<?php echo chumly_profile_url( $member->data->ID ); ?>"
								   class="card__inner">
									<div class="card__image avatar avatar--auto">
										<?php chumly_avatar( $member->data->ID ); ?>
									</div>
									<div class="card__text">
										<p><?php echo $member_data[ 'wordpress' ]->first_name . ' ' . $member_data[ 'wordpress' ]->last_name; ?></p>
									</div>
								</a>
							</li>
						
						<?php } elseif ( $view_mode == 'list' ) { ?>
							
							<li class="grid__item">
								<a href="<?php echo home_url() . '/profile?member_id=' . $member->data->ID; ?>"
								   class="archive-view__item__inner">
									<div class="archive-view__item__image">
										<?php chumly_avatar( $member->data->ID ); ?>
									</div>
									<div class="archive-view__item__text">
										<?php echo $member_data[ 'wordpress' ]->first_name . ' ' . $member_data[ 'wordpress' ]->last_name; ?>
									</div>
								</a>
							</li>
						
						<?php } ?>
					
					<?php } ?>
				
				</ol>
				<!-- ARCHIVE VIEW COMPONENT -->
			
			</div>
			
			
			<div class="archive__content__footer">
				
				<?php chumly_pagination( $total_pages, $current_page, 'user_archive_page' ); ?>
			
			</div>
		
		</div>
	
	</section>

<?php
/**
 * chumly_after_content hook.
 *
 * @hooked chumly_wrapper_end - 100 (outputs chumly, wrapper and chunk div closures)
 */
do_action( 'chumly_after_content' ); ?>