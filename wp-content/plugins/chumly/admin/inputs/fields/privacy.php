<?php
function privacy_admin_markup() {
	
	$input_ID          = str_replace( 'item_', NULL, $_REQUEST[ 'row_id' ] );
	$input_data = chumly_unserialize( $_REQUEST[ 'input_data' ] );
	//var_dump( $input_data );
	
	$public_active  = $input_data[ 'public' ][ 'active' ];
	$public_label   = $input_data[ 'public' ][ 'label' ];
	$private_active = $input_data[ 'private' ][ 'active' ];
	$private_label  = $input_data[ 'private' ][ 'label' ];
	$secret_active  = $input_data[ 'secret' ][ 'active' ];
	$secret_label   = $input_data[ 'secret' ][ 'label' ]; ?>
	
	<tr class="field-type-anchor"></tr>
	
	<tr class="input-data">
		
		<td class="label">
			<label>Options</label>
			<p></p><br>
		</td>
		
		<td class="input-wrap">
<!--			<input type="checkbox" value="1" --><?php //_e($public_active == 1 || !$public_active ? 'checked' : ''); ?><!-- />-->
			<label>
				Public
				<select name="input_<?php echo $input_ID; ?>[input_data][options][public][active]">
					<option value="1" <?php _e($public_active == 1 || !$public_active ? 'selected' : ''); ?>>On</option>
					<option value="0" <?php _e($public_active == 0 ? 'checked' : ''); ?> >Off</option>
				</select>
				<input type="text" name="input_<?php echo $input_ID; ?>[input_data][options][public][label]" value="<?php _e( $public_label ? $public_label : 'Public' ); ?>"/>
				<input type="hidden" name="input_<?php echo $input_ID; ?>[input_data][options][public][value]" value="1" />
			</label>
			
			<label>
				Private
				<select name="input_<?php echo $input_ID; ?>[input_data][options][private][active]">
					<option value="1" <?php _e($private_active == 1 || !$private_active ? 'selected' : ''); ?>>On</option>
					<option value="0" <?php _e($private_active == 0 ? 'checked' : ''); ?>>Off</option>
				</select>
				<input type="text" name="input_<?php echo $input_ID; ?>[input_data][options][private][label]" value="<?php _e( $private_label ? $private_label : 'Private' ); ?>"/>
				<input type="hidden" name="input_<?php echo $input_ID; ?>[input_data][options][private][value]" value="0" />
			</label>
			
			<label>
				Secret
				<select name="input_<?php echo $input_ID; ?>[input_data][options][secret][active]">
					<option value="1" <?php _e($secret_active == 1 || !$secret_active ? 'selected' : ''); ?>>On</option>
					<option value="0" <?php _e($secret_active == 0 ? 'checked' : ''); ?>>Off</option>
				</select>
				<input type="text" name="input_<?php echo $input_ID; ?>[input_data][options][secret][label]" value="<?php _e( $secret_label ? $secret_label : 'Secret' ); ?>"/>
				<input type="hidden" name="input_<?php echo $input_ID; ?>[input_data][options][secret][value]" value="2" />
			</label>
			
		</td>
	
	</tr>
	
	<tr class="input-data">
		
		<td class="label">
			<label>Default Privacy</label>
		</td>
		
		<td class="input-wrap">
			
			<select name="input_<?php echo $input_ID; ?>[input_data][default_choice]">
				<option value="1">Public</option>
				<option value="0">Private</option>
				<option value="2">Secret</option>
			</select>
			
		</td>
		
	</tr>
	
	<?php
	die();
}

add_action( 'wp_ajax_privacy_admin_markup', 'privacy_admin_markup' );

