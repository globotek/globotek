<?php
echo 'inputs-group.php';
if ( isset( $_GET['input_group'] ) ) {
	
	echo $user_type . '-inputs-editor.php';
	require_once( $user_type . '-inputs-editor.php' );
	
} else {
	
	require_once( plugin_dir_path( __DIR__ ) . 'includes/input-group-actions.php' );
	//var_dump($user_type);
	
	global $wpdb;
	$input_groups = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "chumly_input_groups WHERE user_type = '" . $user_type . "'" );
	//var_dump($input_groups);
	//var_dump( $input_groups );
	//var_dump( $_POST );
	if ( isset( $_POST['create_inputs_group'] ) ) {
		
		chumly_create_inputs_group( $user_type );
		
	} ?>
	
	<h1><?php esc_attr_e( ucfirst($user_type) . ' Management' ); ?></h1>
	
	<div class="wrap">
		
		<div id="poststuff">
			
			<div id="post-body" class="metabox-holder">
				
				<!-- main content -->
				<div id="post-body-content">
					
					<div class="meta-box-sortables">
						
						<div class="postbox">
							
							<table class="widefat">
								<tr class="inputs-header">
									<th class="header-title">Input Group Name</th>
									<th class="header-title">Group User Role</th>
									<th class="header-title">Requires Admin Approval?</th>
									<th class="header-title">Has Dashboard Access?</th>
								</tr>
								
								<?php
								foreach ( $input_groups as $group ) {
									echo '<tr>';
									echo '<td><a href="?page=' . $user_type . '-input-groups&input_group=' . esc_attr( $group->user_role ) . '&user_type=' . $user_type . '">' . esc_attr( $group->input_group_name ) . '</a></td>';
									echo '<td>' . esc_attr( $group->user_role ) . '</td>';
									echo '<td>' . ( esc_attr( $group->admin_approval ) === '1' ? 'Yes' : 'No' ) . '</td>';
									echo '<td>' . ( esc_attr( $group->dashboard_access ) === '1' ? 'Yes' : 'No' ) . '</td>';
									if( $group->required == FALSE ) {
										echo '<td><form method="POST"><button name="delete_input_group" value="' . esc_attr( $group->ID ) . '" class="button">Delete</button>';
										echo '<input type="hidden" name="input_group" value="' . $group->user_role . '" />';
										echo '</form></td>';
									}
									echo '</tr>';
								} ?>
							</table>
						
						</div>
						<!-- .postbox -->
					
					</div>
					<!-- .meta-box-sortables .ui-sortable -->
				
				</div>
				<!-- post-body-content -->
			
			</div>
			<!-- #post-body .metabox-holder .columns-2 -->
			
			<br class="clear">
			
			<?php include_once( $user_type . '-role-editor.php' ); ?>
						
			<div id="ajax-response-fields"></div>
		
		</div>
		<!-- #poststuff -->
	
	</div> <!-- .wrap -->

<?php }

