<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 18/10/18
 * Time: 11:17 AM
 */
?>

<?php if( !is_user_logged_in() ) { ?>
	
	<?php chumly_login_form(); ?>

<?php } else { ?>
	
	<?php global $pagename; ?>
	<?php $navigation = apply_filters( 'chumly_merge_menus', array() ); ?>
	
	<?php $navigation = apply_filters( 'chumly_main_sidebar_menu', $navigation ); ?>
	
	<ul class="nav-list">
		
		<li class="nav-list__section">
			<a href="<?php echo home_url( '/' ) . chumly_get_option( 'user_profile_page' ); ?>" class="nav-list__item is-active">
				<span class="avatar"><?php chumly_avatar( get_current_user_id() ); ?></span>
				<p class="nav-list__item__link"><?php echo chumly_username( get_current_user_id() ); ?></p>
			</a>
		</li>
		
		<?php foreach( $navigation as $navigation_section ) { ?>
			
			<li class="nav-list__section">
				<p class="nav-list__section__title"><?php echo $navigation_section[ 'section_title' ]; ?></p>
			</li>
			
			<?php foreach( $navigation_section[ 'nav_items' ] as $nav_item ) { ?>
				
				<li class="nav-list__item <?php _e( $pagename == $nav_item[ 'url' ] ? 'is-active' : '' ); ?>">
					<a href="<?php echo $nav_item[ 'url' ]; ?>" class="nav-list__item__link">
						<?php chumly_icon( $nav_item[ 'icon' ], 'nav-list__item__icon' );
						echo $nav_item[ 'title' ]; ?>
					</a>
				</li>
			
			<?php } ?>
		
		<?php } ?>
	
	</ul>

<?php } ?>
	

