<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 13/12/18
 * Time: 12:56 PM
 */
if(function_exists('acf')) {
	
	function chumly_acf_location_rules_types( $choices ) {
		
		$choices[ 'Chumly' ][ 'chumly_registration' ]        = 'Registration Form';
		$choices[ 'Chumly' ][ 'chumly_profile_field_group' ] = 'Profile Field Group';
		
		return $choices;
		
	}
	
	add_filter( 'acf/location/rule_types', 'chumly_acf_location_rules_types' );
	
	
	function chumly_acf_location_rules_values_chumly_registration( $choices ) {
		
		$choices[ 'chumly_registration' ] = 'Any';
		
		return $choices;
		
	}
	
	add_filter( 'acf/location/rule_values/chumly_registration', 'chumly_acf_location_rules_values_chumly_registration' );
	
	
	function chumly_acf_location_rules_values_profile_field_group( $choices ) {
		
		$choices[ 'chumly_profile_field_group' ] = 'Any';
		
		$user_roles = chumly_get_user_roles();
		
		foreach ( $user_roles as $user_role ) {
			
			$choices[ $user_role[ 'user_role' ] . '_user-input-group' ] = ucwords( $user_role[ 'user_role' ] ) . ' Profile Group';
			
		}
		
		return $choices;
		
	}
	
	add_filter( 'acf/location/rule_values/chumly_profile_field_group', 'chumly_acf_location_rules_values_profile_field_group' );
	
	
	function chumly_acf_location_rules_match_user( $match, $rule, $options ) {
		
		var_dump( $match );
		var_dump( $rule );
		var_dump( $options );
		
	}

//add_filter( 'acf/location/rule_match/user-input-groups', 'chumly_acf_location_rules_match_user', 10, 3 );
	
	
	function chumly_acf_inputs_field_selector() {
		
		$fields = acf_get_fields( $_POST[ 'funnelValue' ] );
		
		foreach ( $fields as $field ) {
			
			echo '<option value="' . $field[ 'key' ] . '">' . $field[ 'label' ] . '</option>';
			
		}
		
		wp_die();
		
	}
	
	add_action( 'wp_ajax_chumly_acf_field_filter', 'chumly_acf_inputs_field_selector' );
	
}