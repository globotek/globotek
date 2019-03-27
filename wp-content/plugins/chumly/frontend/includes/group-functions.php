<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 15/10/18
 * Time: 1:08 PM
 */

function chumly_edit_group_link($group_id){
	
	return home_url('/') . chumly_get_option('group_archive_page') . '/' . chumly_explode_url()->name . '_' . $group_id . '/edit';
	
}