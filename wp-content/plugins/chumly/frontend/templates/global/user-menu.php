<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 20/6/18
 * Time: 1:34 PM
 */

global $chumly;
?>

<li class="chumly chumly--no-size">
	<div class="user-menu" data-module="chumly-toggle">
		<ul class="user-menu__inner">
			<li class="user-menu__item user-menu__item--palm-fill">
				<a href="<?php echo home_url( '/' ) . chumly_get_option( 'user_profile_page' ); ?>" class="user-menu__text">Hello, <?php echo chumly_username( get_current_user_id() ); ?></a>
			</li>
			
			<li class="user-menu__item">
				<a href="#" class="user-menu__icon"> <span class="is-hidden--text">Your profile</span>
					<?php echo chumly_get_icon( 'head' ); ?>
				</a>
			</li>
			
			<li class="user-menu__item">
				<a href="<?php echo home_url( '/' ) . chumly_get_option( 'notifications_page' ); ?>" class="user-menu__icon">
					<span class="is-hidden--text">Your notifications</span>
					<?php echo chumly_get_icon( 'bell' ); ?>
					<span class="user-menu__indicator" aria-hidden="true"></span> </a>
			</li>
			
			<li class="user-menu__item">
				<a href="#user-settings-menu" class="user-menu__icon chumly-toggle__trigger">
					<span class="is-hidden--text">Your settings</span>
					<?php echo chumly_get_icon( 'cog' ); ?>
				</a>
				<!-- OPTIONAL SUB MENU -->
				<ul class="user-menu__sub-menu chumly-toggle__target" id="user-settings-menu">
					<li class="user-menu__sub-menu__item"><a href="#">A settings item</a></li>
					<li class="user-menu__sub-menu__item"><a href="#">Another settings item</a></li>
					<li class="user-menu__sub-menu__item"><a href="#">One more settings item</a></li>
					<li class="user-menu__sub-menu__mask">
						<a href="#user-settings-menu" class="chumly-toggle__trigger">Close menu</a></li>
				</ul>
				<!-- OPTIONAL SUB MENU -->
			</li>
			
			<li class="user-menu__item">
				<a href="#" class="user-menu__icon"> <span class="is-hidden--text">Help and support</span>
					<?php echo chumly_get_icon( 'help' ); ?>
				</a>
			</li>
		
		</ul>
	</div>
</li>