<?php
	/**
	 * Plugin Name: Chumly
	 * Version: 1.0.0
	 * Author: GloboTek
	 * Author URI: https://globotek.net
	 * Description: The next generation of social network plugin for WordPress. A truly modular, developer orientated system that is built for creating bespoke and powerful social network based systems alongside comprehensive social network sites, out the box.
	 * Tags: Chumly, Users, Profiles, Groups, Social Networking, Instant Messaging
	 * Initial Release Date: xx xxx 2018
	 * Created by Matt Campbell
	 * Date: April 3 2015
	 */
	
	/**
	 * Check if Chumly is installed. If it is, do nothing.
	 * If it isn't, run the install functions.
	 * Provides the option to run update procedures as well.
	 */
	function chumly_install() {
		$chumly_installed = get_option('chumly_installed');
		$chumly_version = get_option('chumly_version');
		
		if ($chumly_installed != 1) {
			require_once('chumly-install.php');
		}
		
		if ($chumly_version < 0.1) {
			require_once('chumly-update.php');
		}
	}
	
	register_activation_hook(__FILE__, 'chumly_install');
	
	
	/**
	 * Run Chumly!
	 */
	function chumly() {
		
		/**
		 * Enqueue admin styles & scripts.
		 */
		function chumly_admin_styles() {
			wp_enqueue_style('chumly_css', plugin_dir_url(__FILE__) . 'admin/css/chumly-admin.css');
			//wp_enqueue_style( 'chumly_core', plugin_dir_url( __FILE__ ) . 'frontend/css/chumly-core.css' );
			
		}
		
		add_action('admin_enqueue_scripts', 'chumly_admin_styles');
		
		
		function chumly_admin_scripts() {
			
			
			wp_enqueue_script('jquery-ui-tabs');
			wp_enqueue_script('jquery-ui-sortable');
			
			//wp_enqueue_script( 'chumly_admin_lib', plugin_dir_url( __FILE__ ) . 'frontend/scripts/lib.js', array( 'jquery' ) );
			
			wp_register_script('chumly_admin_js', plugin_dir_url(__FILE__) . 'admin/scripts/chumly_admin.js', array('jquery'));
			wp_localize_script('chumly_admin_js', 'chumly_vars', array('ajax_url' => admin_url('admin-ajax.php')));
			wp_enqueue_script('chumly_admin_js', FALSE, array('jquery'));
			
//			wp_enqueue_script('chumly_input_js', plugin_dir_url(__FILE__) . 'admin/js/input-fields.js', array('jquery'), NULL, TRUE);
			
			if (function_exists('acf')) {
				
				acf_enqueue_scripts();
				
			}
			
		}
		
		add_action('admin_enqueue_scripts', 'chumly_admin_scripts');
		
		
		function chumly_ready_acf() {
			
			if (function_exists('acf')) {
				
				acf_enqueue_scripts();
				
			}
			
		}
		
		add_action('wp_head', 'chumly_ready_acf');
		
		
		function chumly_admin_frontend_scripts() {
			
			$current_screen = get_current_screen();
			
			if ($current_screen->id == 'profile') {
				
				wp_enqueue_script('tiny_mce', includes_url('js/tinymce/') . 'wp-tinymce.php', array('jquery'), FALSE, TRUE);
				wp_enqueue_script('chumly_form_validate', 'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js', array('jquery'), NULL, TRUE);
				wp_enqueue_script('chumly_form_validate', 'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js', array('jquery'), NULL, TRUE);
				wp_enqueue_script('chumly_js_lib', plugin_dir_url(__FILE__) . 'frontend/scripts/lib.js', array('jquery'), NULL);
				wp_enqueue_script('jquery-ui-datepicker', FALSE, array('jquery'), NULL, TRUE);
				wp_enqueue_script('rcrop', plugin_dir_url(__FILE__) . 'frontend/scripts/rcrop.min.js', array('chumly_js_lib'), NULL, TRUE);
				wp_enqueue_script('chumly_prettyphoto', plugin_dir_url(__FILE__) . 'frontend/scripts/prettyphoto.js', array('chumly_js_lib'), NULL, TRUE);
				wp_enqueue_script('chumly_js', plugin_dir_url(__FILE__) . 'frontend/scripts/chumly.js', array('chumly_js_lib'), NULL, TRUE);
//
//		global $chumly;
//
//		$current_user = get_current_user_id();
//		wp_localize_script( 'chumly_js', 'chumly_vars', array(
//			'ajax_url'       => admin_url( 'admin-ajax.php' ),
//			'user_id'        => $current_user,
//			'user_data'      => get_userdata( $current_user ),
//			'media_bucket'   => get_user_meta( 1, '_media_post', TRUE ),
//			'avatar'         => chumly_avatar( $current_user, 'profile', '', FALSE ),
//			'plugin_url'     => plugin_dir_url( __FILE__ ),
//			'chumly_profile' => $chumly->profile
//		) );
			
			}
			
		}
		
		
		add_action('admin_enqueue_scripts', 'chumly_admin_frontend_scripts');
		
		
		/**
		 * Required Admin Area Files.
		 */
		require_once('admin/chumly-admin-ajax.php');
		require_once('admin/chumly-nav-menu.php');
		require_once('admin/includes/post-setup.php');
		
		function require_admin_functionality() {
			foreach (glob(dirname(__FILE__) . '/admin/includes/*.php') as $file) {
				include_once($file);
			}
			
			foreach (glob(dirname(__FILE__) . '/admin/settings/*.php') as $file) {
				include_once($file);
			}
			
			
		}
		
		add_action('plugins_loaded', 'require_admin_functionality');
		
		
		function input_fields_admin_markup() {
			foreach (glob(dirname(__FILE__) . '/admin/inputs/fields/*.php') as $file) {
				require_once($file);
			}
		}
		
		add_action('plugins_loaded', 'input_fields_admin_markup');
		
		
		/**
		 * Redirect headers
		 */
		if (!function_exists('gtek_output_buffer')) {
			function gtek_output_buffer() {
				ob_start();
			}
			
			add_action('init', 'gtek_output_buffer');
		}
		
		
		/**
		 * Global Redirects
		 */
		function chumly_global_redirects() {
			
			global $chumly_user;
			
			$chumly_settings = unserialize(get_option('chumly_settings'));
			
			$approval_url = $chumly_settings['page_urls']['approval_page_url'];
			
			if ($approval_url) {
				
				if (is_user_logged_in() && !current_user_can('manage_options') && !is_admin() && $chumly_user->admin_approval == TRUE) {
					
					add_rewrite_rule(
						$approval_url,
						'index.php?chumly_template=account-approval',
						'top'
					);
					
					if (str_replace('/', '', $_SERVER['REQUEST_URI']) != $approval_url) {
						
						wp_redirect(home_url('/') . $approval_url);
						exit;
						
					}
					
				} else {
					
					if (str_replace('/', '', $_SERVER['REQUEST_URI']) == $approval_url) {
						
						wp_redirect(chumly_profile_url($chumly_user->id));
						exit;
						
					}
					
				}
				
			}
			
		}
		
		//add_action( 'wp_head', 'chumly_global_redirects' );
		add_action('init', 'chumly_global_redirects', 20);
		
		/**
		 * Rewrite rules
		 */
		function query_vars_show() {
			global $wp_query, $wp_rewrite;
			
			var_dump(get_query_var('chumly_template'));
			//var_dump($wp_query);
			
			
			//var_dump( ltrim( parse_url( wc_get_page_permalink( 'myaccount' ) )[ 'path' ], '/' ) );
		}
		
		//add_action( 'wp_head', 'query_vars_show' );
		
		
		function chumly_add_rewrite_rules() {
			
			add_rewrite_tag('%chumly_template%', '([^&]+)');
			add_rewrite_tag('%chumly_user_type%', '([^&]+)');
			
			$user_archive_page = chumly_get_option('user_archive_page');
			$user_profile_page = chumly_get_option('user_profile_page');
			$group_archive_page = chumly_get_option('group_archive_page');
			$group_profile_page = chumly_get_option('group_profile_page');
			
			/**
			 * Settings pages.
			 */
			add_rewrite_rule(
				'settings/([\s\S]*)',
				'index.php?chumly_template=user-preferences&pagename=user-preferences',
				'top'
			);
			
			
			/**
			 * Paginate member archive.
			 */
			add_rewrite_rule(
				$user_archive_page . '/page/(\d*)',
				'index.php?chumly_template=user-archive&pagename=' . $user_archive_page . '&paged=$matches[1]&chumly_user_type=profile',
				'top'
			);
			
			
			/**
			 * Redirect users to individual profile pages while maintaining archive URL structure.
			 */
			add_rewrite_rule(
				$user_archive_page . '/((?!profile)[\s\S]*)',
				'index.php?chumly_template=view-profile&pagename=' . $user_profile_page . '&chumly_user_type=profile',
				'top'
			);
			
			
			/**
			 * Redirect users to the edit profile template from profile template.
			 */
			add_rewrite_rule(
				$user_profile_page . '/edit',
				'index.php?pagename=' . $user_profile_page . '&chumly_template=edit-profile&page_id=' . chumly_get_option('edit_profile_page_id') . '&chumly_user_type=profile',
				'top'
			);
			
			
			/**
			 * Paginate group archive.
			 */
			add_rewrite_rule(
				$group_archive_page . '/page/(\d*)',
				'index.php?chumly_template=group-archive&pagename=' . $group_archive_page . '&paged=$matches[1]&chumly_user_type=group',
				'top'
			);
			
			
			/**
			 * Redirect to group creation page.
			 */
			add_rewrite_rule($group_archive_page . '/create', 'index.php?chumly_template=create-group&page_id=' . chumly_get_option('group_create_page_id') . '&chumly_user_type=group', 'top');
			
			
			/**
			 * Redirect users to edit group page.
			 */
			add_rewrite_rule(
				$group_archive_page . '/((?!edit-group)[\s\S]*)/edit',
				'index.php?pagename=' . $group_archive_page . '&chumly_template=edit-group&page_id=' . chumly_get_option('group_edit_page_id') . '&chumly_user_type=group',
				'top'
			);
			
			
			/**
			 * Redirect to group profile page.
			 */
			add_rewrite_rule($group_archive_page . '/((?!edit-group)[\s\S]*)', 'index.php?chumly_template=view-group&pagename=' . $group_profile_page . '&chumly_user_type=group', 'top');
			
			add_rewrite_rule('logout', 'index.php?chumly_template=logout', 'top');
			
			flush_rewrite_rules(TRUE);
		}
		
		add_action('init', 'chumly_add_rewrite_rules', 0);
		
		
		/**
		 * Fetch correct template file per URL request.
		 *
		 * @param $template
		 *
		 * @return string
		 */
		function chumly_load_plugin_templates($template) {
			
			switch (get_query_var('chumly_template')) {
				
				case 'view-profile':
				case 'edit-profile':
				case 'view-group':
				case 'create-group':
				case 'edit-group':
					
					return chumly_get_page_template();
					
					break;
				
				case 'user-preferences':
					
					$template = chumly_get_page_template();
					chumly_inject_template('user-settings', 'settings');
					
					break;
				
				case 'account-approval':
					
					$template = chumly_get_page_template();
					chumly_inject_template('approval', 'access');
					
					break;
				
			}
			
			return $template;
			
		}
		
		add_action('template_include', 'chumly_load_plugin_templates');
		
		
		/**
		 * Redirect users to correct profile if navigating via query URL.
		 */
		function chumly_redirect_object_ids() {
			
			if (isset($_GET['member_id'])) {
				
				$member_id = $_GET['member_id'];
				
				$redirect = chumly_profile_url($member_id);
				echo $redirect;
				wp_redirect(chumly_profile_url($member_id));
				exit();
			}
			
			
		}
		
		add_action('template_redirect', 'chumly_redirect_object_ids');
		
		
		/**
		 * Enqueue frontend styles & scripts.
		 */
		function chumly_frontend_styles() {
			wp_enqueue_style('prettyphoto_css', plugin_dir_url(__FILE__) . 'frontend/css/prettyphoto.css');
			wp_enqueue_style('rcrop_css', plugin_dir_url(__FILE__) . 'frontend/css/rcrop.min.css');
			wp_enqueue_style('chumly_core', plugin_dir_url(__FILE__) . 'frontend/css/chumly-core.css');
			wp_enqueue_style('chumly_layouts', plugin_dir_url(__FILE__) . 'frontend/css/chumly-layouts.css');
			wp_enqueue_style('chumly_navigation', plugin_dir_url(__FILE__) . 'frontend/css/chumly-navigation.css');
			wp_enqueue_style('chumly_interactions', plugin_dir_url(__FILE__) . 'frontend/css/chumly-interactions.css');
			wp_enqueue_style('chumly_user', plugin_dir_url(__FILE__) . 'frontend/css/chumly-user.css');
			wp_enqueue_style('chumly_messaging', plugin_dir_url(__FILE__) . 'frontend/css/chumly-messaging.css');
			
			global $wp_scripts;
			
			// tell WordPress to load jQuery UI tabs
			wp_enqueue_script('jquery-ui-tabs');
			
			// get registered script object for jquery-ui
			$ui = $wp_scripts->query('jquery-ui-core');
			
			// tell WordPress to load the Smoothness theme from Google CDN
			$protocol = is_ssl() ? 'https' : 'http';
			$url = "$protocol://ajax.googleapis.com/ajax/libs/jqueryui/{$ui->ver}/themes/smoothness/jquery-ui.min.css";
			wp_enqueue_style('jquery-ui-smoothness', $url, FALSE, NULL);
		}
		
		add_action('wp_enqueue_scripts', 'chumly_frontend_styles');
		
		
		function chumly_frontend_scripts() {
			
			wp_enqueue_script('tiny_mce', includes_url('js/tinymce/') . 'wp-tinymce.php', array('jquery'), FALSE, TRUE);
			wp_enqueue_script('chumly_form_validate', 'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js', array('jquery'), NULL, TRUE);
			wp_enqueue_script('chumly_form_validate', 'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js', array('jquery'), NULL, TRUE);
			wp_enqueue_script('chumly_js_lib', plugin_dir_url(__FILE__) . 'frontend/scripts/lib.js', array('jquery'), NULL);
			wp_enqueue_script('jquery-ui-datepicker', FALSE, array('jquery'), NULL, TRUE);
			wp_enqueue_script('rcrop', plugin_dir_url(__FILE__) . 'frontend/scripts/rcrop.min.js', array('chumly_js_lib'), NULL, TRUE);
			wp_enqueue_script('chumly_prettyphoto', plugin_dir_url(__FILE__) . 'frontend/scripts/prettyphoto.js', array('chumly_js_lib'), NULL, TRUE);
			wp_enqueue_script('chumly_js', plugin_dir_url(__FILE__) . 'frontend/scripts/chumly.js', array('chumly_js_lib'), NULL, TRUE);
			
			global $chumly;
			
			$current_user = get_current_user_id();
			wp_localize_script('chumly_js', 'chumly_vars', array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'user_id' => $current_user,
				'user_data' => get_userdata($current_user),
				'media_bucket' => get_user_meta(1, '_media_post', TRUE),
				'avatar' => chumly_avatar($current_user, 'profile', '', FALSE),
				'plugin_url' => plugin_dir_url(__FILE__),
				'chumly_profile' => $chumly->profile
			));
			
		}
		
		add_action('wp_enqueue_scripts', 'chumly_frontend_scripts');
		
		
		/**
		 * Required Frontend Files.
		 */
		function require_frontend_functionality() {
			foreach (glob(dirname(__FILE__) . '/frontend/includes/*.php') as $file) {
				include_once($file);
			}
		}
		
		add_action('plugins_loaded', 'require_frontend_functionality');
		
		
		function require_frontend_fields() {
			foreach (glob(dirname(__FILE__) . '/frontend/templates/fields/*.php') as $file) {
				include_once($file);
			}
		}
		
		add_action('plugins_loaded', 'require_frontend_fields');
		
		
		/**
		 * After theme & plugins ready
		 */
		function chumly_after_theme_ready() {
			
			chumly_add_post_formats(array('share', 'status'));
			new Chumly_Settings();
			
		}
		
		add_action('after_setup_theme', 'chumly_after_theme_ready');
		
		
		register_sidebar(array(
			'name' => __('Chumly'),
			'id' => 'chumly',
			'class' => 'nav-list',
			'before_widget' => '<li id="%1$s" class="nav-list__item breathe breathe--bottom %2$s">'
		));
		
		
		function chumly_upload_filetypes($mime_types) {
			
			$mime_types['svg'] = 'image/svg+xml'; //SVG extension
			//	$mime_types[ 'exe' ] = 'application/octet-stream'; //EXE extension
			$mime_types['rar'] = 'application/x-rar-compressed, application/octet-stream'; //RAR extension
			$mime_types['rar'] = 'application/x-rar-compressed'; //RAR extension
			$mime_types['rar'] = 'application/x-rar'; //RAR extension
			$mime_types['zip'] = 'application/zip'; //RAR extension
			$mime_types['gz'] = 'application/x-gzip'; //RAR extension
			
			return $mime_types;
			
		}
		
		add_filter('upload_mimes', 'chumly_upload_filetypes', 1, 1);
		
		
		function chumly_core_notification_templates($notification_templates) {
			
			$notification_templates['group'] = plugin_dir_path(__FILE__) . 'frontend/templates/notifications/group.php';
			$notification_templates['new_group_member'] = plugin_dir_path(__FILE__) . 'frontend/templates/notifications/new-group-member.php';
			$notification_templates['new_group_application'] = plugin_dir_path(__FILE__) . 'frontend/templates/notifications/new-group-applicant.php';
			$notification_templates['chumly_status_post'] = plugin_dir_path(__FILE__) . 'frontend/templates/notifications/global.php';
			$notification_templates['friend_request'] = plugin_dir_path(__FILE__) . 'frontend/templates/notifications/friend-request.php';
			
			return $notification_templates;
			
		}
		
		add_action('chumly_notification_templates', 'chumly_core_notification_templates', 20);
		
		
		function chumly_user_menu() {
			
			global $chumly_user_menu;
			$chumly_user_menu = new Chumly_User_Menu();
			
			function chumly_additional_menu_items($menu) {
				
				$user_menu = '';
				
				$return = $menu;
				$return .= '<li class="chumly chumly--no-size menu-item"><nav class="user-menu" data-module="chumly-toggle"><ul class="user-menu__inner">';
				$return .= apply_filters('chumly_user_menu', $user_menu);
				$return .= '</ul></nav></li>';
				
				return $return;
				
			}
			
			add_filter('wp_nav_menu_items', 'chumly_additional_menu_items', 10, 2);
			
		}
		
		if (is_user_logged_in()) {
			
			add_action('after_setup_theme', 'chumly_user_menu', 5);
			
		}
		
		/*
		 * @TODO Use as an example for documentation of rearranging user menu.
		 */
//	function chumly_adjust_user_menu() {
//		global $chumly_user_menu;
//
//		remove_filter( 'chumly_user_menu', array( $chumly_user_menu, 'add_item_1' ), 5 );
//		add_filter( 'chumly_user_menu', array( $chumly_user_menu, 'add_item_1' ), 50 );
//
//	}
//
//	add_action( 'after_setup_theme', 'chumly_adjust_user_menu', 10 );
		
		/**
		 * Create our $_GLOBAL $chumly for general data access.
		 */
		function chumly_globals() {
			
			global $chumly, $chumly_templates, $chumly_user, $chumly_profile, $chumly_group;
			
			$chumly = new stdClass();
			$chumly->current_user = $chumly_user = new stdClass();
			$chumly_templates = new stdClass();
			$chumly_templates->paths = new stdClass();
			$chumly_templates->profile = new stdClass();
			
			if (!is_admin() || chumly_ajax()) {
				
				$user_meta = get_user_meta(get_current_user_id());
				
				$chumly->plugin_path = plugin_dir_path(__FILE__);
				$chumly->theme_path = get_stylesheet_directory();
				$chumly->plugin_uri = plugin_dir_url(__FILE__);
				$chumly->theme_uri = get_stylesheet_directory_uri();
				$chumly->current_user->role = $chumly_user->role = $user_meta['_chumly_user_role'][0];
				$chumly->current_user->dashboard_access = $chumly_user->dashboard_access = $user_meta[ '_chumly_dashboard_access' ][ 0 ];
				$chumly->current_user->admin_approval = $chumly_user->admin_approval = $user_meta['_requires_activation'][0];
				$chumly->current_user->new_user = $chumly_user->new_user = $user_meta['_chumly_new_user'][0];
				$chumly->current_user->id = $chumly_user->id = chumly_explode_url()->ID;
				
				/**
				 * @param integer $chumly_templates ->profile->layout 1 = Sidebar & Content, 2 = Profile -> Activity, 3 = No Activity Feed
				 */
				$chumly_templates->paths->plugin_path = $chumly->plugin_path . 'frontend/templates/';
				$chumly_templates->paths->theme_path = $chumly->theme_path . '/chumly/';
				$chumly_templates->profile->layout = 1;
				$chumly_templates->profile->avatars = TRUE;
				$chumly_templates->profile->networks = TRUE;
				
				$chumly->templates = $chumly_templates;
				
				
			}
			
			
			if (!chumly_ajax() && !is_admin()) {
				
				$chumly_profile = new stdClass();
				$chumly_group = new stdClass();
				
				$chumly->group = $chumly_group;
				$chumly->profile = $chumly_profile;
				
				
				//var_dump( $chumly_profile );
				//var_dump( $chumly_group );
				
			}
			
		}
		
		add_action('init', 'chumly_globals', 10);
		
		
		function chumly_object_id_globals() {
			
			global $chumly, $chumly_profile, $chumly_group;
			
			$user_type = get_query_var('chumly_user_type');
			
			$chumly->user_type = $user_type;
			
			switch ($user_type) {
				
				case 'profile':
					$chumly_profile->name = chumly_explode_url()->name;
					$chumly_profile->id = chumly_explode_url()->ID;
					
					break;
				
				case 'group':
					$chumly_group->name = chumly_explode_url()->name;
					$chumly_group->id = chumly_explode_url()->ID;
					
					break;
			}
			
		}
		
		add_action('wp_head', 'chumly_object_id_globals');
		
		
		function chumly_template_directories_setup() {
			
			global $chumly_template_directories;
			
			$chumly_template_directories[] = get_stylesheet_directory() . '/chumly';
			
			return $chumly_template_directories;
		}
		
		//add_filter( 'chumly_template_directories_setup', 'chumly_template_directories_setup', 20 );
		
		
		/**
		 *  Add Chumly admin menu & items.
		 */
		function chumly_admin_menu() {
			/** Add main page. */
			add_menu_page(__('Chumly', 'chumly'), __('Chumly', 'chumly'), 'manage_options', 'chumly-dashboard', 'chumly_admin_dashboard', 'dashicons-smiley');
			
			/** Add submenu pages. */
			add_submenu_page('chumly-dashboard', __('Profiles', 'chumly'), __('Profiles', 'chumly'), 'manage_options', 'user-input-groups', 'chumly_user_inputs');
			add_submenu_page('chumly-dashboard', __('Groups', 'chumly'), __('Groups', 'chumly'), 'manage_options', 'group-input-groups', 'chumly_group_inputs');
			add_submenu_page('chumly-dashboard', __('New User Approval', 'chumly'), __('New User Approval', 'chumly'), 'manage_options', 'chumly-user-approval', 'chumly_user_approval');
			add_submenu_page('chumly-dashboard', __('Settings', 'chumly'), __('Settings', 'chumly'), 'manage_options', 'chumly-settings', 'chumly_admin_settings');
			
			global $submenu;
			
			if (isset($submenu['chumly-dashboard'])) {
				$submenu['chumly-dashboard'][0][0] = __('Dashboard', 'chumly');
			}
			
			function chumly_admin_dashboard() {
				require_once('admin/chumly-dashboard.php');
			}
			
			function chumly_user_inputs() {
				$user_type = 'user';
				require_once('admin/inputs/input-groups.php');
			}
			
			function chumly_group_inputs() {
				$user_type = 'group';
				//	require_once('admin/group-inputs/group-input-groups.php');
				require_once('admin/inputs/input-groups.php');
			}
			
			function chumly_admin_settings() {
				require_once('admin/chumly-settings.php');
			}
			
			function chumly_user_approval() {
				require_once('admin/chumly-user-approval.php');
			}
			
		}
		
		add_action('admin_menu', 'chumly_admin_menu');
		
		
		/**
		 * @param $data
		 *
		 * @return string
		 *
		 * Couple of little functions for getting Objects into a format that can be stored in the database.
		 */
		function chumly_serialize($data) {
			return base64_encode(serialize($data));
		}
		
		function chumly_unserialize($data) {
			if (base64_encode(base64_decode($data)) === $data) {
				return unserialize(base64_decode($data));
			} else {
				return unserialize($data);
			}
		}
		
		
		function chumly_ajax() {
			if (defined('DOING_AJAX') && DOING_AJAX && wp_doing_ajax()) {
				return TRUE;
			}
		}
		
		
		function chumly_die() {
			if (chumly_ajax()) {
				wp_die();
			}
		}
		
		/**
		 * Development Files. Comment out post production.
		 */
		require_once('chumly-dev-tools.php');
		/** Development Files. Comment out post production. */
		
		//chumly_elearning();
		
	}
	
	add_action('plugins_loaded', 'chumly', 5);
	
