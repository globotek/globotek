<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 4/4/19
 * Time: 8:38 PM
 */

/**
 * @param $components array Template part assigned by ACF
 */
function gtek_template_router($components){

	foreach($components as $component){

		include (get_stylesheet_directory() . '/partials/' . $component['acf_fc_layout'] . '.php');
		
	}
	
	
}