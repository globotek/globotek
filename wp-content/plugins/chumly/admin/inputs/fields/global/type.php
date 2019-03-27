<tr <?php _e( $row->input_permanent ? 'style="visibility: hidden; position: absolute;"' : NULL ); ?>>
	<td class="label">
		<label>Field Type<span class="required">*</span></label>
	</td>
	<td class="input-wrap">
		<select class="input-type-select input input-type" name="row_<?php echo $input_ID; ?>[type]">
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
				
				<?php if( function_exists( 'acf' ) ) { ?>
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
