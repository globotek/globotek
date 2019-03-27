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
							<td>Inputs Group Name<span class="description"> (required) </span></td>
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
