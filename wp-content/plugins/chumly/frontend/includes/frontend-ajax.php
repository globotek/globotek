<?php
///** Process the submitted cropped image data from jquery and turn it into PHP readable format. */
//function process_crop(){
//	var_dump($_REQUEST);
//
//	$image_string = substr($_REQUEST['image_source'], strpos($_REQUEST['image_source'], ',') + 1);
//
//	$cropped_width = $_REQUEST['image_width'];
//	$cropped_height = $_REQUEST['image_height'];
//
//	$decode_string = base64_decode($image_string);
//
//	$source_image = imagecreatefromstring($decode_string);
//	$new_image = imagecreatetruecolor($cropped_width, $cropped_height);
//
//	$cropped_image = imagecopyresampled($new_image, $source_image, 0, 0, $_REQUEST['start_x'], $_REQUEST['start_y'], $cropped_width, $cropped_height, $_REQUEST['image_width'], $_REQUEST['image_height']);
//
//	ob_start ();
//
//	imagepng($new_image);
//	imagedestroy($new_image);
//	$image_data = ob_get_contents ();
//
//	ob_end_clean ();
//
//	echo '<img id="cropped_image" src="data:image/png;base64,' . base64_encode($image_data) . '">';
//
//	die();
//}
//
//add_action('wp_ajax_process_crop', 'process_crop');
//add_action('wp_ajax_nopriv_process_crop', 'process_crop');
//
//
///** Save the PHP formatted image data. */
//function save_crop(){
//
//	var_dump($_REQUEST);
//
//	if(!empty($_REQUEST['image_source'])){
//		$user = (isset($_REQUEST['user_id'])) ? get_userdata($_REQUEST['user_id']) : get_userdata(get_current_user_id());
//		$upload_dir = wp_upload_dir();
//
//		/** Define filepath for where to save the final image. This will be a directory in wp-content/uploads called chumly/avatars */
//		if($_REQUEST['image_location'] == 'profile'){
//
//			$filepath = $upload_dir['basedir'] . '/chumly/profile-avatars/' . $user->ID . '_' . $user->first_name . '_' . $user->last_name . '.png';
//
//		}
//
//		if($_REQUEST['image_location'] == 'groups' && $_REQUEST['page_role'] != 'edit'){
//
//			$filename = strtolower(str_replace(' ', '_', $_REQUEST['group_name'])) . '_' . time('U');
//			$filepath = $upload_dir['basedir'] . '/chumly/group-avatars/' . $filename . '.png';
//			$fileurl = $upload_dir['baseurl'] . '/chumly/group-avatars/' . $filename . '.png';
//
//		}elseif($_REQUEST['image_location'] == 'groups' && $_REQUEST['page_role'] == 'edit'){
//
//			$filename_array = explode('/', $_REQUEST['image_filepath']);
//			end($filename_array);
//			$filename_position = key($filename_array);
//			$filename = $filename_array[$filename_position];
//
//			$filepath = $upload_dir['basedir'] . '/chumly/group-avatars/' . $filename;
//			$fileurl = $upload_dir['baseurl'] . '/chumly/group-avatars/' . $filename;
//
//		}
//
//		/** Convert image from string format which is how it arrives, into readable format. */
//		$image_string = substr($_REQUEST['image_source'], strpos($_REQUEST['image_source'], ',') + 1);
//
//		/** Turn encoded string into raw image string. */
//		$decode_string = base64_decode($image_string);
//
//		/** Create an image from the image string. We'll be saving this created image momentarily. */
//		$temporary_image = imagecreatefromstring($decode_string);
//
//		ob_start();
//
//		/** imagepng takes our temporary image and saves it to the directory specified by $filepath. */
//		imagepng($temporary_image, $filepath, 0);
//
//		/** Now we've saved the temporary image, we no longer need it so it can be deleted. */
//		imagedestroy($temporary_image);
//
//		ob_end_clean();
//
//		if($_REQUEST['image_location'] == 'profile'){
//			/** Save as user_meta the path to the saved profile image. */
//			update_user_meta($user->ID, 'chumly_avatar', esc_html($filepath));
//		}
//
//		if($_REQUEST['image_location'] == 'groups'){
//			$_POST['image_filepath'] = $fileurl;
//		}
//
//		if($_REQUEST['page_role'] == 'edit'){
//			die();
//		}
//	}
//}
//
//add_action('wp_ajax_save_crop', 'save_crop');
//add_action('wp_ajax_nopriv_save_crop', 'save_crop');
