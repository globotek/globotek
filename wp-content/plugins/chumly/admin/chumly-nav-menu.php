<?php

class Chumly_Nav_Menu {
	
	public function add_nav_menu_meta_boxes() {
		
		add_meta_box( 'chumly_nav_menu', __( 'Chumly' ), array( $this, 'nav_menu_link' ), 'nav-menus', 'side', 'low' );
		
	}
	
	public function nav_menu_link() { ?>
		
		<div id="posttype-chumly-nav" class="posttypediv">
			<div id="tabs-panel-chumly-login" class="tabs-panel tabs-panel-active">
				
				<!--<p>Pages</p>-->
				<ul id="chumly-checklist" class="categorychecklist form-no-clear">
					<?php
					/*global $wpdb;
					
					$query = "SELECT post_name, post_title FROM " . $wpdb->prefix . "posts WHERE post_content LIKE '[chumly_%' AND post_parent = '0'";
					
					$pages = $wpdb->get_results($query, OBJECT);

					$i = -1;
					foreach($pages as $page){ ?>
						<li>
							<label class="menu-item-title">
								<input type="checkbox" class="menu-item-checkbox" name="menu-item[<?php echo esc_attr($i); ?>][menu-item-object-id]" value="<?php echo esc_attr($i); ?>"><?php echo esc_attr($page->post_title); ?>
							</label>
							<input type="hidden" class="menu-item-type" name="menu-item[<?php echo esc_attr($i); ?>][menu-item-type]" value="custom">
							<input type="hidden" class="menu-item-title" name="menu-item[<?php echo esc_attr($i); ?>][menu-item-title]" value="<?php echo esc_attr($page->post_title); ?>">
							<input type="hidden" class="menu-item-url" name="menu-item[<?php echo esc_attr($i); ?>][menu-item-url]" value="<?php echo esc_url(home_url('/') . $page->post_name); ?>">
							<input type="hidden" class="menu-item-classes" name="menu-item[<?php echo esc_attr($i); ?>][menu-item-classes]">
						</li>
					<?php 
					$i--;
					} */
					?>
				</ul>
				
				
				<ul id="chumly-checklist" class="categorychecklist form-no-clear">
					<li>
						<label class="menu-item-title">
							<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1">Register
						</label>
						<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
						<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="Register">
						<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="<?php bloginfo( 'wpurl' ); ?>/wp-login.php">
						<input type="hidden" class="menu-item-classes" name="menu-item[-1][menu-item-classes]" value="wl-login-pop">
					</li>
					<li>
						<label class="menu-item-title">
							<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1">Login/Logout
						</label>
						<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
						<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="Login">
						<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="<?php bloginfo( 'wpurl' ); ?>/wp-login.php">
						<input type="hidden" class="menu-item-classes" name="menu-item[-1][menu-item-classes]" value="wl-login-pop">
					</li>
					<li>
						<label class="menu-item-title">
							<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1">Login
						</label>
						<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
						<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="Login">
						<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="<?php bloginfo( 'wpurl' ); ?>/wp-login.php">
						<input type="hidden" class="menu-item-classes" name="menu-item[-1][menu-item-classes]" value="wl-login-pop">
					</li>
					<li>
						<label class="menu-item-title">
							<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1">Logout
						</label>
						<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
						<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="Logout">
						<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="<?php echo wp_logout_url( home_url( '/?logged_out=true' ) ); ?>">
						<input type="hidden" class="menu-item-classes" name="menu-item[-1][menu-item-classes]" value="chumly-login-swap">
					</li>
				</ul>
			
			</div>
			
			<p class="button-controls">
				<span class="list-controls">
					<a href="/wordpress/wp-admin/nav-menus.php?page-tab=all&amp;selectall=1#posttype-page" class="select-all">Select All</a>
				</span>
				<span class="add-to-menu">
					<input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-post-type-menu-item" id="submit-posttype-chumly-nav">
					<span class="spinner"></span>
				</span>
			</p>
		</div>
		<!--<div id="posttype-wl-login" class="posttypediv">
			<div id="tabs-panel-wishlist-login" class="tabs-panel tabs-panel-active">
				<ul id ="wishlist-login-checklist" class="categorychecklist form-no-clear">
					<li>
						<label class="menu-item-title">
							<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1"> Login/Logout Link
						</label>
						<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
						<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="Login">
						<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="<?php //bloginfo('wpurl');
		?>/wp-login.php">
						<input type="hidden" class="menu-item-classes" name="menu-item[-1][menu-item-classes]" value="wl-login-pop">
					</li>
				</ul>
			</div>
			<p class="button-controls">
				<span class="list-controls">
					<a href="/wordpress/wp-admin/nav-menus.php?page-tab=all&amp;selectall=1#posttype-page" class="select-all">Select All</a>
				</span>
				<span class="add-to-menu">
					<input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-post-type-menu-item" id="submit-posttype-wl-login">
					<span class="spinner"></span>
				</span>
			</p>
		</div>-->
		
		<?php
	}
}

$chumly_nav_menu = new Chumly_Nav_Menu;

add_action( 'admin_init', array( $chumly_nav_menu, 'add_nav_menu_meta_boxes' ) );