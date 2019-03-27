<?php
function output_field_row( $input, $input_order, $input_location, $inputs_index = NULL ) {
	
	if( $input->input_id ) {
		
		$input_ID = $input->input_id;
		$inputs_index = $input->ID;
		
	} else {
		
		$input_ID = $input_location . '_' . $inputs_index;
		
	} ?>
	
	<li id="item_<?php echo $inputs_index; ?>" class="inputs-row fields-input <?php _e( !$input ? 'new_input_row' : NULL ); ?>" data-active="inactive">
		
		<input type="hidden" name="input_<?php echo $inputs_index; ?>[order]" class="input_order" value="<?php echo $input_order; ?>"/>
		<input type="hidden" id="stored_input_data" name="input_<?php echo $inputs_index; ?>[stored_input_data]" value="<?php echo $input->input_data; ?>"/>
		<input type="hidden" id="index_id" name="input_<?php echo $inputs_index; ?>[index_id]" value="<?php _e( $inputs_index ); ?>"/>
		<input type="hidden" id="input_id" name="input_<?php echo $inputs_index; ?>[input_id]" value="<?php _e( $input_ID ); ?>">
		
		<input type="hidden" id="input_delete" name="input_<?php echo $inputs_index; ?>[input_delete]" value="0"/>
		
		<input type="hidden" id="input_name" name="input_<?php echo $inputs_index; ?>[input_name]" value="<?php _e( $input ? stripslashes( $input->input_name ) : 'new_field' ); ?>"/>
		<input type="hidden" id="input_group" name="input_<?php echo $inputs_index; ?>[input_group]" value="<?php _e( $_GET[ 'input_group' ] ? esc_attr( $_GET[ 'input_group' ] ) : esc_attr( $_POST[ 'input_group' ] ) ); ?>"/>
		<input type="hidden" id="input_location" name="input_<?php echo $inputs_index; ?>[input_location]" value="<?php echo $input_location; ?>"/>
		<input type="hidden" id="user_type" name="input_<?php echo $inputs_index; ?>[user_type]" value="<?php _e( $_GET[ 'user_type' ] ? esc_attr( $_GET[ 'user_type' ] ) : esc_attr( $_POST[ 'user_type' ] ) ); ?>"/>
		<input type="hidden" id="input_active" name="input_<?php echo $inputs_index; ?>[input_active]" value="<?php _e( $input ? $input->input_active : 1 ); ?>"/>
		
		<div class="input-column input-column-order">
			<span class="circle input-order"><?php echo $input_order; ?></span>
		</div>
		
		<div class="input-column input-column-name">
			<a class="row-title"><span class="row-loader"></span><?php _e( $input ? $input->input_label : 'New Field' ); ?>
			</a>
			<div class="input-row-actions">
				<p class="row-edit">Edit</p>
				
				<?php if( !$input->input_permanent ) { ?>
					<p class="row-delete">Delete</p>
					<p class="row-active"><?php _e( $input->input_active == 1 || $input->input_active == '' ? 'Deactivate' : 'Activate' ); ?></p>
				<?php } ?>
			
			</div>
		</div>
		<div class="input-column input-name">
			<span class="row-loader"></span><?php _e( $input ? '<span class="row-loader"></span>' . stripslashes( $input->input_name ) : 'new_field' ); ?>
		</div>
		<div class="input-column input-type">
			<span class="row-loader"></span><?php _e( $input ? '<span class="row-loader"></span>' . $input->input_type : 'text' ); ?>
		</div>
		
		
		<div class="row-content">
			
			<table class="widefat">
				<tbody>
				
				<tr>
					<td class="label">
						<label>Field Label<span class="required">*</span></label>
						<p class="description">This is the name which will appear on the EDIT page</p>
					</td>
					
					<td class="input-wrap">
						<input type="text" class="input input-label" name="input_<?php echo $inputs_index; ?>[label]" value="<?php _e( $input ? stripslashes( $input->input_label ) : 'New Field' ); ?>"/>
					</td>
				</tr>
				
				
				<tr <?php _e( $input_location == 'required' ? 'style="visibility: hidden; position: absolute;"' : NULL ); ?>>
					<td class="label">
						<label>Field Name<span class="required">*</span></label>
						<p class="description">Single word, no spaces. Underscores and dashes allowed</p>
					</td>
					
					<td class="input-wrap">
						<input type="text" class="input input-name" name="input_<?php echo $inputs_index; ?>[name]" value="<?php _e( $input ? stripslashes( $input->input_name ) : 'new_field' ); ?>" <?php _e( !$input->input_permanent ?: 'readonly' ); ?> />
					</td>
				</tr>
				
				<tr <?php _e( $input->input_permanent ? 'style="visibility: hidden; position: absolute;"' : NULL ); ?>>
					<td class="label">
						<label>Field Type<span class="required">*</span></label>
					</td>
					<td class="input-wrap">
						<select class="input-type-select input input-type" name="input_<?php echo $inputs_index; ?>[type]">
							<optgroup label="Basic">
								<option value="text" <?php selected( $input->input_type, 'text' ); ?>>Text</option>
								<option value="textarea" <?php selected( $input->input_type, 'textarea' ); ?>>Text Area</option>
								<option value="number" <?php selected( $input->input_type, 'number' ); ?>>Number</option>
								<option value="tel" <?php selected( $input->input_type, 'tel' ); ?>>Phone</option>
								<option value="email" <?php selected( $input->input_type, 'email' ); ?>>Email</option>
								<option value="password" <?php selected( $input->input_type, 'password' ); ?>>Password</option>
								<option value="link" <?php selected( $input->input_type, 'link' ); ?>>URL</option>
								<option value="file" <?php selected( $input->input_type, 'file' ); ?>>File</option>
								<option value="privacy" <?php selected( $input->input_type, 'privacy' ); ?>>Privacy</option>
							</optgroup>
							
							<optgroup label="Content">
								<option value="wysiwyg" <?php selected( $input->input_type, 'wysiwyg' ); ?>>Wysiwyg Editor</option>
								<option value="avatar" <?php selected( $input->input_type, 'avatar' ); ?>>Profile Picture</option>
								<option value="posts" <?php selected( $input->input_type, 'posts' ); ?>>Post Objects</option>
								
								<?php if( function_exists( 'acf' ) ) { ?>
									<option value="acf" <?php selected( $input->input_type, 'acf' ); ?>>Advanced Custom Field</option>
								<?php } ?>
								<!--<option value="file">File</option>-->
							</optgroup>
							
							<optgroup label="Choice">
								<option value="select" <?php selected( $input->input_type, 'select' ); ?>>Select</option>
								<option value="checkbox" <?php selected( $input->input_type, 'checkbox' ); ?>>Checkbox</option>
								<option value="radio" <?php selected( $input->input_type, 'radio' ); ?>>Radio Button</option>
								<!--<option value="true_false">True / False</option>-->
							</optgroup>
							
							<optgroup label="jQuery">
								<!--<option value="google_map">Google Map</option>-->
								<option value="date_picker" <?php selected( $input->input_type, 'date_picker' ); ?>>Date Picker</option>
								<!--<option value="color_picker">Color Picker</option>-->
							</optgroup>
							
							<optgroup label="Email">
								<option value="invite" <?php selected( $input->input_type, 'invite' ); ?>>Email Invites</option>
							</optgroup>
						</select>
					</td>
				</tr>
				
				<tr>
					<td class="label">
						<label for="input_<?php echo $inputs_index; ?>_instructions">Field Instructions</label>
						<p class="description">Instructions shown when submitting data in forms.</p>
					</td>
					
					<td class="input-wrap">
						<textarea class="input" id="input_<?php echo $inputs_index; ?>_instructions" name="input_<?php echo $inputs_index; ?>[instructions]" rows="6"><?php echo stripslashes( $input->input_instructions ); ?></textarea>
					</td>
				</tr>
				
				<tr <?php _e( $input->input_permanent ? 'style="visibility: hidden; position: absolute;"' : NULL ); ?>>
					<td class="label"><label>Required?</label></td>
					
					<td class="input-wrap">
						<ul class="radio horizontal">
							<li>
								<label>
									<input type="radio" name="input_<?php echo $inputs_index; ?>[required]" value="1" <?php checked( ( $input ? $input->input_required : '1' ), '1' ); ?> />
									Yes
								</label>
							</li>
							
							<li>
								<label>
									<input type="radio" name="input_<?php echo $inputs_index; ?>[required]" value="0" <?php checked( $input->input_required, '0' ); ?> />
									No
								</label>
							</li>
						</ul>
					</td>
				</tr>
				
				<tr class="field-type-anchor"></tr>
				
				<tr>
					<td class="label"><label>Select Placement</label><?php echo $input->input_placement; ?></td>
					<td class="input-wrap">
						<select class="input" name="input_<?php echo $inputs_index; ?>[placement]">
							<option value="grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole"
								<?php selected( $input->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole' ); ?>>
								Full Width
							</option>
							<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-quarter"
								<?php selected( $input->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-quarter' ); ?>>
								One Quarter
							</option>
							<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-half"
								<?php selected( $input->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-half' ); ?>>
								One Half
							</option>
							<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--three-quarters"
								<?php selected( $input->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--three-quarters' ); ?>>
								Three Quarters
							</option>
							<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-third"
								<?php selected( $input->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-third' ); ?>>
								One Third
							</option>
							<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--two-thirds"
								<?php selected( $input->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--two-thirds' ); ?>>
								Two Thirds
							</option>
							<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--three-tenths"
								<?php selected( $input->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--three-tenths' ); ?>>
								Three Tenths
							</option>
						</select>
					</td>
				</tr>
				
				<tr>
					<td class="label"></td>
					<td class="input-wrap">
						<ul>
							<li>
								<a class="close_row" title="Close Field" href="javascript:;">Close Field</a>
							</li>
						</ul>
					</td>
				</tr>
				
				</tbody>
			</table>
		</div>
	
	</li>
	
	<?php
	
}


function load_new_field() {

	$input_location = $_POST[ 'input_location' ];
	$inputs_index = $_POST[ 'inputs_index' ];
	
	output_field_row( NULL, NULL, $input_location, $inputs_index );
	
	die();
	
}

add_action( 'wp_ajax_load_new_field', 'load_new_field' );


function save_fields() {
	
	// Convert form inputs string into array
	parse_str( $_REQUEST[ 'data' ], $data );
	
	// Ready WPDB Class
	global $wpdb;
	
	/**
	 * @param $index_ID          = ID of row in database
	 * @param $stored_input_data = The data that's saved when an input is created/updated. New inputs have no stored data
	 * @param $user_type         = If inputs are for users or groups
	 * @param $input_group       = The grouping of inputs per user defined name
	 * @param $location          = Required/Registration/New User/Profile
	 * @param $ID                = input_id in the database e.g. default_1
	 * @param $order             = What position the input is in
	 * @param $delete            = If it should be deleted on save
	 * @param $delete_id         = Unused currently
	 * @param $required          = If the input is a required input in forms
	 * @param $label             = The input's label for forms, human readable name
	 * @param $name              = Codebased name of the input
	 * @param $type              = The input type e.g text, number, email
	 * @param $instructions      = The instructions for users in forms
	 * @param $input_data        = Object of all the params to chumly_serialize() before save
	 * @param $input_active      = If the input should appear in the frontend
	 * @param $placement         = The CSS classes to give the input for the frontend
	 */
	
	foreach( $data as $input_key => $input ) {
		
		if( strpos( $input_key, 'input_' ) === 0 && $input_key != 'input_group' ) {
		
			$index_ID = $input[ 'index_id' ];
			$stored_input_data = $input[ 'stored_input_data' ];
			$user_type = $input[ 'user_type' ];
			$input_group = $input[ 'input_group' ];
			$location = str_replace( '-', '_', $input[ 'input_location' ] );
			$ID = $input[ 'input_id' ];
			$order = $input[ 'order' ];
			$delete = $input[ 'input_delete' ];
			$required = $input[ 'required' ];
			$label = $input[ 'label' ];
			$name = $input[ 'name' ];
			$type = $input[ 'type' ];
			$instructions = $input[ 'instructions' ];
			$input_data = chumly_serialize( $input[ 'input_data' ] );
			$input_active = $input[ 'input_active' ];
			$placement = $input[ 'placement' ];
			
			
			if( $index_ID && $delete == FALSE && $stored_input_data ) {
				
				$wpdb->update(
					$wpdb->prefix . 'chumly_inputs',
					array(
						'input_id'           => $ID,
						'input_order'        => $order,
						'input_name'         => $name,
						'input_label'        => $label,
						'input_type'         => $type,
						'input_instructions' => $instructions,
						'input_required'     => $required,
						'input_data'         => $input_data,
						'input_location'     => $location,
						'input_group'        => $input_group,
						'input_permanent'    => 0,
						'user_type'          => $user_type,
						'input_active'       => $input_active,
						'input_placement'    => $placement
					),
					array( 'ID' => $index_ID )
				);
				
			} elseif( $delete == TRUE ) {
				
				$wpdb->delete(
					$wpdb->prefix . 'chumly_inputs',
					array(
						'ID' => $index_ID
					)
				);
				
			} else {
				
				$wpdb->insert(
					$wpdb->prefix . 'chumly_inputs',
					array(
						'input_id'           => $ID,
						'input_order'        => $order,
						'input_name'         => $name,
						'input_label'        => $label,
						'input_type'         => $type,
						'input_instructions' => $instructions,
						'input_required'     => $required,
						'input_data'         => $input_data,
						'input_location'     => $location,
						'input_group'        => $input_group,
						'input_permanent'    => 0,
						'user_type'          => $user_type,
						'input_active'       => $input_active,
						'input_placement'    => $placement
					)
				);

				chumly_update_option( 'inputs_index', $wpdb->insert_id );
			
			}
		}
	}
	
	die();
}

add_action( 'wp_ajax_save_fields', 'save_fields' );
add_action( 'wp_ajax_nopriv_save_fields', 'save_fields' );
