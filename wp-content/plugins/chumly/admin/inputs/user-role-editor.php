<div id="post-body" class="metabox-holder chumly">
	
	<!-- main content -->
	<div id="post-body-content">
		
		<div class="meta-box-sortables">
			
			<h2>Create New Group</h2>
			
			<div class="postbox">
				
				<form method="POST">
					
					<table class="widefat">
						<tr class="inputs-header">
							<th class="header-title">Option</th>
							<th class="header-title">Value</th>
						</tr>
						
						<tr>
							<td>Group Name<span class="description"> (required) </span></td>
							<td>
								<input type="text" name="input_group_name" value="<?php _e( ! empty( $_POST ) ? esc_attr( $_POST['input_group_name'] ) : NULL ); ?>" autocomplete="off"/>
								<?php _e( isset( $_POST['create_inputs_group'] ) && empty( $_POST['input_group_name'] ) ? '<span style="color:#CC0000;">Please name your new Input Group.</span>' : '' ); ?>
							</td>
						</tr>
						<tr>
							<td>Requires Admin Approval?</td>
							<td>
								<input type="checkbox" name="admin_approval" value="1" <?php checked( ! empty( $_POST['admin_approval'] ), '1' ); ?> />
							</td>
						</tr>
						<tr>
							<td>Has Dashboard Access?</td>
							<td>
								<input type="checkbox" name="dashboard_access" value="1" <?php checked( ! empty( $_POST['dashboard_access'] ), '1' ); ?> />
							</td>
						</tr>
						<tr>
							<td>User Role Name<span class="description"> (will default to Group Name if left blank) </span>
							</td>
							<td>
								<input type="text" name="user_role_name" value="<?php _e( $_POST ? esc_attr( $_POST['user_role_name'] ) : NULL ); ?>"/>
								<?php //_e( isset( $_POST['create_inputs_group'] ) && empty( $_POST['user_role_name'] ) ? '<span style="color:#CC0000;">Please name your new User Role.</span>' : '' ); ?>
							</td>
						</tr>
						<tr>
							<td>User Roles</td>
							<td>
								<?php global $wp_roles; ?>
								<?php //var_dump($wp_roles->role_names); ?>
								
								<?php foreach ( $wp_roles->role_objects as $role ) { ?>
									<?php $role_ID = $role->name; ?>
									<?php $role_name = $wp_roles->role_names[ $role->name ]; ?>
									<?php $role_caps = $role->capabilities; ?>
									<?php //var_dump($role_name); ?>
									<?php //var_dump($role_caps); ?>
									<?php //var_dump($role); ?>
								<?php } ?>
								
								
								<select name="preset_role">
									<!--<option value="custom_role">Create A Role</option>-->
									<?php foreach ( $wp_roles->get_names() as $role ) { ?>
										<?php $role_caps = $wp_roles->get_role( $role ); ?>
										<option value="<?php echo $role; ?>"><?php echo $role; ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<!--<td>User Role Options<br><span class="description"> (CURRENTLY NON-FUNCTIONAL FEATURE) </span>
							</td>-->
							<?php //$caps = $_POST['capabilities']; ?>
							<?php //var_dump($caps); ?>
							
							<!--
							<td>
								<label><input type="checkbox" name="capabilities[activate_plugins]">Activate Plugins</label><br>
								<label><input type="checkbox" name="capabilities[create_users]">Create Users</label><br>
								<label><input type="checkbox" name="capabilities[delete_plugins]">Delete Plugins</label><br>
								<label><input type="checkbox" name="capabilities[delete_themes]">Delete Themes</label><br>
								<label><input type="checkbox" name="capabilities[delete_users]">Delete Users</label><br>
								<label><input type="checkbox" name="capabilities[edit_files]">Edit Files</label><br>
								<label><input type="checkbox" name="capabilities[edit_plugins]">Edit Plugins</label><br>
								<label><input type="checkbox" name="capabilities[edit_theme_options]">Edit Theme Options</label><br>
								<label><input type="checkbox" name="capabilities[edit_themes]">Edit Themes</label><br>
								<label><input type="checkbox" name="capabilities[edit_users]">Edit Users</label><br>
								<label><input type="checkbox" name="capabilities[export]">Export</label><br>
							</td>
							<td>
								<label><input type="checkbox" name="capabilities[install_plugins]">Install Plugins</label><br>
								<label><input type="checkbox" name="capabilities[install_themes]">Install Themes</label><br>
								<label><input type="checkbox" name="capabilities[list_users]">List Users</label><br>
								<label><input type="checkbox" name="capabilities[manage_options]">Manage Options</label><br>
								<label><input type="checkbox" name="capabilities[promote_users]">Promote Users</label><br>
								<label><input type="checkbox" name="capabilities[remove_users]">Remove Users</label><br>
								<label><input type="checkbox" name="capabilities[switch_themes]">Switch Themes</label><br>
								<label><input type="checkbox" name="capabilities[update_core]">Update Core</label><br>
								<label><input type="checkbox" name="capabilities[update_plugins]">Update Plugins</label><br>
								<label><input type="checkbox" name="capabilities[upload_files]">Upload Files</label><br>
								<label><input type="checkbox" name="capabilities[publish_posts]">Publish Posts</label><br>
							</td>
							<td>
								<label><input type="checkbox" name="capabilities[update_themes]">Update Themes</label><br>
								<label><input type="checkbox" name="capabilities[edit_dashboard]">Edit Dashboard</label><br>
								<label><input type="checkbox" name="capabilities[customize]">Customize</label><br>
								<label><input type="checkbox" name="capabilities[delete_site]">Delete Site</label><br>
								<label><input type="checkbox" name="capabilities[moderate_comments]">Moderate Comments</label><br>
								<label><input type="checkbox" name="capabilities[manage_categories]">Manage Categories</label><br>
								<label><input type="checkbox" name="capabilities[manage_links]">Manage Links</label><br>
								<label><input type="checkbox" name="capabilities[edit_others_posts]">Edit Others' Posts</label><br>
								<label><input type="checkbox" name="capabilities[edit_pages]">Edit Pages</label><br>
								<label><input type="checkbox" name="capabilities[edit_others_pages]">Edit Others' Pages</label><br>
								<label><input type="checkbox" name="capabilities[publish_pages]">Publish Pages</label><br>
							</td>
							<td>
								<label><input type="checkbox" name="capabilities[delete_pages]">Delete Pages</label><br>
								<label><input type="checkbox" name="capabilities[delete_others_pages]">Delete Others' Pages</label><br>
								<label><input type="checkbox" name="capabilities[delete_published_pages]">Delete Published Pages</label><br>
								<label><input type="checkbox" name="capabilities[delete_others_posts]">Delete Others' Posts</label><br>
								<label><input type="checkbox" name="capabilities[delete_private_posts]">Delete Private Posts</label><br>
								<label><input type="checkbox" name="capabilities[edit_private_posts]">Edit Private Posts</label><br>
								<label><input type="checkbox" name="capabilities[read_private_posts]">Read Private Posts</label><br>
								<label><input type="checkbox" name="capabilities[delete_private_pages]">Delete Private Pages</label><br>
								<label><input type="checkbox" name="capabilities[read_private_pages]">Read Private Pages</label><br>
								<label><input type="checkbox" name="capabilities[unfiltered_html]">Unfiltered HTML</label><br>
								<label><input type="checkbox" name="capabilities[edit_published_posts]">Edit Published Posts</label><br>
							</td>
							<td>
								<label><input type="checkbox" name="capabilities[delete_published_posts]">Delete Published Posts</label><br>
								<label><input type="checkbox" name="capabilities[import]">Import</label><br>
								<label><input type="checkbox" name="capabilities[edit_posts]">Edit Posts</label><br>
								<label><input type="checkbox" name="capabilities[delete_posts]">Delete Posts</label><br>
								<label><input type="checkbox" name="capabilities[read]">Read</label><br>
							</td>
						-->
						</tr>
						
						<tr>
							<td>Create Inputs Group</td>
							<td>
								<button class="button button-large button-primary" type="submit" name="create_inputs_group" value="true">
									Publish
								</button>
							<td>
						</tr>
					</table>
				
				</form>
			
			</div>
		
		</div>
	
	</div>

</div>

<br class="clear">
