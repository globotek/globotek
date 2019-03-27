<h1>Chumly Dashboard</h1>




Advanced Custom Field

<?php
$acf_groups = acf_get_field_groups();

$acf_group = acf_get_field_group('group_5bbe4a69dcb89');

//var_dump($acf_group);

$fields = acf_get_fields( 'group_5bbe4a69dcb89' );
//var_dump($fields);
$fields = '';

foreach ( $acf_groups as $acf_group ) {
	
	foreach ( $acf_group[ 'location' ] as $group_locations ) {
		
		foreach ( $group_locations as $rule ) {
			
			if ( $rule[ 'param' ] == 'chumly_profile_field_group' && $rule[ 'operator' ] == '==' && $rule[ 'value' ] == 'default_user-input-group' ) {
				//var_dumP( $acf_group );
				$fields = acf_get_fields( $acf_group );
				
			}
			
		}
		
	}
	
}

acf_render_fields( $fields);

foreach($fields as $field){
	
	//var_dump($field);
	acf_render_field_wrap($field);
	
}
?>
