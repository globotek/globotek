<?php
/*
function output_field_row( $row, $i, $location_index, $input_location, $inputs_index = NULL ) { ?>
	
	<li id="item_<?php echo $row->ID; ?>" class="inputs-row fields-input <?php _e( ! $row ? 'new_input_row' : NULL ); ?>" data-active="inactive">
		
		<input type="hidden" name="row_<?php echo $i; ?>[order]" class="input_order" value="<?php echo $i; ?>"/>
		<input type="hidden" id="stored_input_data" name="row_<?php echo $i; ?>[stored_input_data]" value="<?php echo $row->input_data; ?>"/>
		<input type="hidden" id="index_id" name="row_<?php echo $i; ?>[index_id]" value="<?php _e( $row ? $row->ID : $inputs_index ); ?>"/>
		<input type="hidden" id="input_group" name="row_<?php echo $i; ?>[input_group]" value="<?php _e( $_GET[ 'input_group' ] ? esc_attr( $_GET[ 'input_group' ] ) : esc_attr( $_POST[ 'input_group' ] ) ); ?>"/>
		<input type="hidden" id="input_location" name="row_<?php echo $i; ?>[input_location]" value="<?php echo $input_location; ?>"/>
		<input type="hidden" id="user_type" name="row_<?php echo $i; ?>[user_type]" value="<?php _e( $_GET[ 'user_type' ] ? esc_attr( $_GET[ 'user_type' ] ) : esc_attr( $_POST[ 'user_type' ] ) ); ?>"/>
		<input type="hidden" id="input_name" name="row_<?php echo $i; ?>[input_name]" value="<?php _e( $row ? stripslashes( $row->input_name ) : 'new_field' ); ?>"/>
		<input type="hidden" id="row_delete" name="row_<?php echo $i; ?>[input_delete]" value="0"/>
		<input type="hidden" id="input_active" name="row_<?php echo $i; ?>[input_active]" value="<?php _e( $row ? $row->input_active : 1 ); ?>"/>
		<input type="hidden" id="input_id" name="row_<?php echo $i; ?>[input_id]" value="<?php _e( $row ? $row->input_id : $input_location . '_' . $location_index ); ?>">
		
		<div class="input-column input-column-order"><span class="circle input-order"><?php echo $i; ?></span></div>
		<div class="input-column input-column-name">
			<a class="row-title"><span class="row-loader"></span><?php _e( $row ? $row->input_label : 'New Field' ); ?>
			</a>
			<div class="input-row-actions">
				<p class="row-edit">Edit</p>
				
				<?php if ( ! $row->input_permanent ) { ?>
					<p class="row-delete">Delete</p>
					<p class="row-active"><?php _e( $row->input_active == 1 || $row->input_active == '' ? 'Deactivate' : 'Activate' ); ?></p>
				<?php } ?>
			
			</div>
		</div>
		<div class="input-column input-name">
			<span class="row-loader"></span><?php _e( $row ? '<span class="row-loader"></span>' . stripslashes( $row->input_name ) : 'new_field' ); ?>
		</div>
		<div class="input-column input-type">
			<span class="row-loader"></span><?php _e( $row ? '<span class="row-loader"></span>' . $row->input_type : 'text' ); ?>
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
						<input type="text" class="input input-label" name="row_<?php echo $i; ?>[label]" value="<?php _e( $row ? stripslashes( $row->input_label ) : 'New Field' ); ?>"/>
					</td>
				</tr>
				
				
				<tr <?php _e( $input_location == 'required' ? 'style="visibility: hidden; position: absolute;"' : NULL ); ?>>
					<td class="label">
						<label>Field Name<span class="required">*</span></label>
						<p class="description">Single word, no spaces. Underscores and dashes allowed</p>
					</td>
					
					<td class="input-wrap">
						<input type="text" class="input input-name" name="row_<?php echo $i; ?>[name]" value="<?php _e( $row ? stripslashes( $row->input_name ) : 'new_field' ); ?>" <?php _e( ! $row->input_permanent ?: 'readonly' ); ?> />
					</td>
				</tr>
				
				<tr <?php _e( $row->input_permanent ? 'style="visibility: hidden; position: absolute;"' : NULL ); ?>>
					<td class="label">
						<label>Field Type<span class="required">*</span></label>
					</td>
					<td class="input-wrap">
						<select class="input-type-select input input-type" name="row_<?php echo $i; ?>[type]">
							<optgroup label="Basic">
								<option value="text" <?php selected( $row->input_type, 'text' ); ?>>Text</option>
								<option value="textarea" <?php selected( $row->input_type, 'textarea' ); ?>>Text Area</option>
								<option value="number" <?php selected( $row->input_type, 'number' ); ?>>Number</option>
								<option value="tel" <?php selected( $row->input_type, 'tel' ); ?>>Phone</option>
								<option value="email" <?php selected( $row->input_type, 'email' ); ?>>Email</option>
								<option value="password" <?php selected( $row->input_type, 'password' ); ?>>Password</option>
								<option value="link" <?php selected( $row->input_type, 'link' ); ?>>URL</option>
								<option value="file" <?php selected( $row->input_type, 'file' ); ?>>File</option>
								<option value="privacy" <?php selected( $row->input_type, 'privacy' ); ?>>Privacy</option>
							</optgroup>
							
							<optgroup label="Content">
								<option value="wysiwyg" <?php selected( $row->input_type, 'wysiwyg' ); ?>>Wysiwyg Editor</option>
								<option value="avatar" <?php selected( $row->input_type, 'avatar' ); ?>>Profile Picture</option>
								<option value="posts" <?php selected( $row->input_type, 'posts' ); ?>>Post Objects</option>
								
								<?php if ( function_exists( 'acf' ) ) { ?>
									<option value="acf" <?php selected( $row->input_type, 'acf' ); ?>>Advanced Custom Field</option>
								<?php } ?>
								<!--<option value="file">File</option>-->
							</optgroup>
							
							<optgroup label="Choice">
								<option value="select" <?php selected( $row->input_type, 'select' ); ?>>Select</option>
								<option value="checkbox" <?php selected( $row->input_type, 'checkbox' ); ?>>Checkbox</option>
								<option value="radio" <?php selected( $row->input_type, 'radio' ); ?>>Radio Button</option>
								<!--<option value="true_false">True / False</option>-->
							</optgroup>
							
							<optgroup label="jQuery">
								<!--<option value="google_map">Google Map</option>-->
								<option value="date_picker" <?php selected( $row->input_type, 'date_picker' ); ?>>Date Picker</option>
								<!--<option value="color_picker">Color Picker</option>-->
							</optgroup>
							
							<optgroup label="Email">
								<option value="invite" <?php selected( $row->input_type, 'invite' ); ?>>Email Invites</option>
							</optgroup>
						</select>
					</td>
				</tr>
				
				<tr>
					<td class="label"><label for="row_<?php echo $i; ?>_instructions">Field Instructions</label>
						<p class="description">Instructions shown when submitting data in forms.</p>
					</td>
					
					<td class="input-wrap">
						<textarea class="input" id="row_<?php echo $i; ?>_instructions" name="row_<?php echo $i; ?>[instructions]" rows="6"><?php echo stripslashes( $row->input_instructions ); ?></textarea>
					</td>
				</tr>
				
				<tr <?php _e( $row->input_permanent ? 'style="visibility: hidden; position: absolute;"' : NULL ); ?>>
					<td class="label"><label>Required?</label></td>
					
					<td class="input-wrap">
						<ul class="radio horizontal">
							<li>
								<label>
									<input type="radio" name="row_<?php echo $i; ?>[required]" value="1" <?php checked( ( $row ? $row->input_required : '1' ), '1' ); ?> />
									Yes
								</label>
							</li>
							
							<li>
								<label>
									<input type="radio" name="row_<?php echo $i; ?>[required]" value="0" <?php checked( $row->input_required, '0' ); ?> />
									No
								</label>
							</li>
						</ul>
					</td>
				</tr>
				
				<tr class="field-type-anchor"></tr>
				
				<tr>
					<td class="label"><label>Select Placement</label><?php echo $row->input_placement; ?></td>
					<td class="input-wrap">
						<select class="input" name="row_<?php echo $i; ?>[placement]">
							<option value="grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole"
								<?php selected( $row->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole' ); ?>>
								Full Width
							</option>
							<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-quarter"
								<?php selected( $row->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-quarter' ); ?>>
								One Quarter
							</option>
							<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-half"
								<?php selected( $row->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-half' ); ?>>
								One Half
							</option>
							<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--three-quarters"
								<?php selected( $row->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--three-quarters' ); ?>>
								Three Quarters
							</option>
							<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-third"
								<?php selected( $row->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-third' ); ?>>
								One Third
							</option>
							<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--two-thirds"
								<?php selected( $row->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--two-thirds' ); ?>>
								Two Thirds
							</option>
							<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--three-tenths"
								<?php selected( $row->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--three-tenths' ); ?>>
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