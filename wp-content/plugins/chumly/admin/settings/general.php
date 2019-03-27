<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 28/6/18
 * Time: 5:36 PM
 */
function chumly_general_settings() {
	
	
	/**
	 * Register Setting Sections
	 */
	
	/**
	 * ID of section
	 * Title of section
	 * callback function name
	 * name of settings section to be referenced by do_settings_section
	 */
	function section_1() {
		
		echo 'Content from callback function';
		
		//do_settings_fields('chumly_general_settings', 'section_1_id');
		
	}
	
	add_settings_section( 'section_1_id', 'Section 1 Title', 'section_1', 'chumly_general_settings' );
	
	
	/**
	 * Prepare General Settings markup
	 */
	function field_1() {
		$chumly_settings = unserialize( get_option( 'chumly_settings' ) );
		if($_POST['general']['test_setting_input']){
			
			$value = $_POST['general']['test_setting_input'];
			
		} else {
			
			$value = $chumly_settings['general']['test_setting_input'];
			
		}
		
		
		echo '<input type="text" name="general[test_setting_input]" placeholder="Go from here" value="' . $value . '" />';
	}
	
	add_settings_field( 'field_1', 'Field 1', 'field_1', 'chumly_general_settings', 'section_1_id' );
	
	function field_2() {
		echo '<fieldset class="chumly">';
		echo '<label for="field_2_1">';
		echo '<input id="field_2_1" type="radio" name="general[field_2]" value="value_1" />';
		echo 'Field 2 Option 1</label>';
		
		echo '<label for="field_2_2">';
		echo '<input id="field_2_2" type="radio" name="general[field_2]" value="value_1" />';
		echo 'Field 2 Option 2</label>';
		echo '</fieldset>';
		
	}
	
	add_settings_field( 'field_2', 'Field 2', 'field_2', 'chumly_general_settings', 'section_1_id' );
}

add_action( 'admin_init', 'chumly_general_settings' );