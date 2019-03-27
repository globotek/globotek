<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 1/11/18
 * Time: 12:27 PM
 */
function chumly_page_urls_settings(){
	
	/**
	 * ID of section
	 * Title of section
	 * callback function name
	 * name of settings section to be referenced by do_settings_section
	 */
	
	function chumly_output_page_urls_section(){
		
		
		
	}
	
	add_settings_section('chumly_page_urls_section', 'Page URLs', 'chumly_output_page_urls_section', 'chumly_page_urls_settings');
	
	/**
	 * ID of field
	 * Field label
	 * Callback function name
	 * Section field is to appear in
	 * Section ID
	 */
	function chumly_approval_page_url(){
		
		$chumly_settings = unserialize( get_option( 'chumly_settings' ) );
		var_dump($chumly_settings);
		var_dump($_POST);
				
		if($_POST['page_urls']['approval_page_url']){
			
			$value = $_POST['page_urls']['approval_page_url'];
			
		} elseif($chumly_settings['page_urls']['approval_page_url']) {
			
			$value = $chumly_settings['page_urls']['approval_page_url'];
			
		} else {
			
			$value = 'awaiting-approval';
		
		}
		
		echo '<p>' . home_url('/') . '<input type="text" name="page_urls[approval_page_url]" value="' . $value . '" /></p>';
		
	}
	
	add_settings_field('chumly_approval_page_url', 'Account Approval URL', 'chumly_approval_page_url', 'chumly_page_urls_settings', 'chumly_page_urls_section');
	
	function chumly_page_urls_setting(){
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
	
	//add_settings_field( 'chumly_page_urls_setting', 'Public Pages', 'chumly_page_urls_setting', 'chumly_page_urls_settings', 'chumly_page_urls_section' );
	
}

add_action( 'admin_init', 'chumly_page_urls_settings' );