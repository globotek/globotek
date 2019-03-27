<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 13/12/18
 * Time: 12:59 PM
 */
if(function_exists('acf')) {
	
	function acf_admin_markup() {
		
		$input_ID          = str_replace( 'item_', NULL, $_REQUEST[ 'row_id' ] );
		$input_data = chumly_unserialize( $_REQUEST[ 'input_data' ] ); ?>
		<?php //var_dump( $input_data ); ?>
		<tr class="field-type-anchor"></tr>
		
		<tr class="input-data">
			<td class="label">
				<label>Placeholder Text</label>
				<p>Appears within the input</p>
			</td>
			
			<td class="input-wrap">
				<input type="text" class="input" name="input_<?php echo $input_ID; ?>[input_data][placeholder]" value="<?php echo $input_data[ 'placeholder' ]; ?>"/>
			</td>
		</tr>
		
		<tr class="input-data">
			<td class="label">
				<label>Character Limit</label>
				<p>Leave blank for no limit</p>
			</td>
			
			<td class="input-wrap">
				Advanced Custom Field
				
				<?php
				$acf_groups = acf_get_field_groups();
				
				$groups = array();
				
				foreach ( $acf_groups as $acf_group ) {
					
					foreach ( $acf_group[ 'location' ] as $group_locations ) {
						
						foreach ( $group_locations as $rule ) {
							
							if ( $rule[ 'param' ] == 'chumly_profile_field_group' && $rule[ 'operator' ] == '==' && $rule[ 'value' ] == 'default_user-input-group' ) {
								
								$groups[] = $acf_group;
								
							}
							
						}
						
					}
					
				} ?>
				
				<select class="funnel-select" name="input_<?php echo $input_ID; ?>[input_data][acf_group_key]" data-funnel_action="chumly_acf_field_filter">
					
					<option selected disabled>Select a field group.</option>
					
					<?php foreach ( $groups as $group ) { ?>
						
						<option value="<?php echo $group[ 'key' ]; ?>" <?php selected( $group[ 'key' ], $input_data[ 'acf_group_key' ] ); ?>)><?php echo $group[ 'title' ]; ?></option>
					
					<?php } ?>
				
				</select>
				
				<select class="recipient-select" name="input_<?php echo $input_ID; ?>[input_data][acf_field_key]">
					
					<?php if ( $input_data[ 'acf_group_key' ] ) { ?>
						
						<?php $fields = acf_get_fields( $input_data[ 'acf_group_key' ] ); ?>
						
						<?php foreach ( $fields as $field ) { ?>
							
							<option value="<?php echo $field[ 'key' ]; ?>" <?php selected( $field[ 'key' ], $input_data[ 'acf_field_key' ] ); ?>><?php echo $field[ 'label' ]; ?></option>
						
						<?php } ?>
					
					
					<?php } else { ?>
						
						<option selected disabled>Select option from above dropdown.</option>
					
					<?php } ?>
				
				</select>
				
				<div class="acf_ajax_return"></div>
			
			</td>
		</tr>
		
		<?php wp_die();
		
	}
	
	add_action( 'wp_ajax_acf_admin_markup', 'acf_admin_markup' );
	
}