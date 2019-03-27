<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 1/11/18
 * Time: 12:27 PM
 */
function chumly_visibility_settings(){
	
	/**
	 * ID of section
	 * Title of section
	 * callback function name
	 * name of settings section to be referenced by do_settings_section
	 */
	
	function chumly_output_page_visibilty_section(){
		
		
		
	}
	
	add_settings_section('chumly_page_visibilty_section', 'Page Visibility', 'chumly_output_page_visibilty_section', 'chumly_visibility_settings');
	/**
	 * ID of field
	 * Field label
	 * Callback function name
	 * Section field is to appear in
	 * Section ID
	 */
	function chumly_page_visibility_setting(){
		$chumly_settings = unserialize( get_option( 'chumly_settings' ) );
		$pages = get_pages(array());
		
		echo '<fieldset class="chumly">';
		
		foreach($pages as $page) {
			
			if($_POST['visibility']['public_pages'][$page->ID]){
				
				$value = $_POST['visibility']['public_pages'][$page->ID];
				
			} else {
				
				$value = $chumly_settings['visibility']['public_pages'][$page->ID];
				
			}
			
			echo '<label><input type="checkbox" name="visibility[public_pages][' . $page->ID . ']" value="' . $page->ID . '"' . checked($page->ID, $value, FALSE) . '/><span>' . $page->post_title . '</span></label>';
			
		}
			
		echo '</fieldset>';
		
		//var_dump($pages);
	}
	
	add_settings_field( 'chumly_page_visibility_setting', 'Public Pages', 'chumly_page_visibility_setting', 'chumly_visibility_settings', 'chumly_page_visibilty_section' );
	
}

add_action( 'admin_init', 'chumly_visibility_settings' );