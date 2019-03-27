<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 28/6/18
 * Time: 5:36 PM
 */
function chumly_profile_settings() {
	
	/**
	 * Register Setting Sections
	 */
	
	/**
	 * ID of section
	 * Title of section
	 * callback function name
	 * name of settings section to be referenced by do_settings_section
	 */
	function section_1p() {
		
		echo 'Content from callback function';
		
		//do_settings_fields('chumly_general_settings', 'section_1_id');
		
	}
	
	add_settings_section( 'section_1p_id', 'Section 1p Title', 'section_1p', 'chumly_profile_settings' );
	
	
	/**
	 * Prepare General Settings markup
	 */
	
	/**
	 * ID of field
	 * Field label
	 * Callback function name
	 * Section field is to appear in
	 * Section ID
	 */
	function field_1p() {
		echo '<input type="text" name="test_setting_inputp" placeholder="Go from here" />';
	}
	
	add_settings_field( 'field_1p', 'Field 1p', 'field_1p', 'chumly_profile_settings', 'section_1p_id' );
	
	function field_2p() {
		echo '<fieldset class="chumly">';
		echo '<label for="field_2_1p">';
		echo '<input id="field_2_1p" type="radio" name="field_2p" value="value_1p" />';
		echo 'Field 2 Option 1p</label>';
		
		echo '<label for="field_2_2p">';
		echo '<input id="field_2_2p" type="radio" name="field_2p" value="value_1p" />';
		echo 'Field 2 Option 2p</label>';
		echo '</fieldset>';
		
	}
	
	add_settings_field( 'field_2p', 'Field 2p', 'field_2p', 'chumly_profile_settings', 'section_1p_id' );
}

add_action( 'admin_init', 'chumly_profile_settings' );