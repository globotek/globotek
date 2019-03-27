<div class="wrap">
	
	<h2>Chumly Settings</h2>
	
	<div id="tabs" class="settings">
		
		<?php if ( isset( $_GET[ 'settings-tab' ] ) ) { ?>
			
			<?php $active_tab = $_GET[ 'settings-tab' ]; ?>
		
		<?php } else { ?>
			
			<?php $active_tab = 'general'; ?>
		
		<?php } ?>
		
		<h2 class="nav-tab-wrapper">
			
			<a href="?page=chumly-settings&settings-tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">General</a>
			<a href="?page=chumly-settings&settings-tab=profile" class="nav-tab <?php echo $active_tab == 'profile' ? 'nav-tab-active' : ''; ?>">Profile</a>
			<a href="?page=chumly-settings&settings-tab=page_layout" class="nav-tab <?php echo $active_tab == 'page_layout' ? 'nav-tab-active' : ''; ?>">Page Layouts</a></li>
			<a href="?page=chumly-settings&settings-tab=page_visibility" class="nav-tab <?php echo $active_tab == 'page_visibility' ? 'nav-tab-active' : ''; ?>">Page Visibility</a></li>
			<a href="?page=chumly-settings&settings-tab=page_urls" class="nav-tab <?php echo $active_tab == 'page_urls' ? 'nav-tab-active' : ''; ?>">Page URLs & Content</a></li>
			
			<?php do_action( 'chumly_settings_menu', $active_tab ); ?>
		
		</h2>
		
		<form method="POST" action="<?php echo plugin_dir_url(__FILE__) . 'chumly-save-settings.php'; ?>">
			
			<?php
			$core_sections = array(
				array(
					'case'    => 'general',
					'section' => 'chumly_general_settings'
				),
				array(
					'case'    => 'profile',
					'section' => 'chumly_profile_settings'
				),
				array(
					'case'    => 'page_layout',
					'section' => 'chumly_layout_settings'
				),
				array(
					'case'    => 'page_visibility',
					'section' => 'chumly_visibility_settings'
				),
				array(
					'case'    => 'page_urls',
					'section' => 'chumly_page_urls_settings'
				)
			);
			
			$sections = apply_filters( 'chumly_settings_sections', $core_sections );
			
			foreach ( $sections as $section ) {
				
				if ( $active_tab == $section[ 'case' ] ) {
					
					do_settings_sections( $section[ 'section' ] );
					
				}
				
			}
			
			submit_button(); ?>
		
		</form>
	
	</div>

</div>