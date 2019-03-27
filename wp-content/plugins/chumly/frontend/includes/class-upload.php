<?php

/**
 * Class Chumly_Upload
 */
class Chumly_Upload {
	
	function __construct() {
		
		add_action( 'wp_ajax_process_crop', array( $this, 'process_crop' ) );
		add_action( 'wp_ajax_nopriv_process_crop', array( $this, 'process_crop' ) );
		add_action( 'wp_ajax_chumly_save_file', array( $this, 'save_file' ) );
		add_action( 'wp_ajax_nopriv_chumly_save_file', array( $this, 'save_file' ) );
		//add_action( 'chumly_before_file_save', array( $this, 'chumly_before_file_save' ) );
		//add_action( 'chumly_after_file_save', array( $this, 'chumly_after_file_save' ) );
		
	}
	
	
	function detect_file_type( $file = array() ) {
		
		$file_type = wp_check_filetype( $file[ 'name' ] );
		
		$file_type = substr( $file_type[ 'type' ], 0, strpos( $file_type[ 'type' ], '/' ) );
		
		return $file_type;
		
	}
	
	
	function clone_image( $image ) {
		
		$image_source = $image[ 'tmp_name' ];
		
		$dimensions = getimagesize( $image_source );
		
		$image_width  = $dimensions[ 0 ];
		$image_height = $dimensions[ 1 ];
		
		$source_image = imagecreatefromjpeg( $image_source );
		
		$clone_image = imagecreatetruecolor( $image_width, $image_height );
		
		imagecopyresampled( $clone_image, $source_image, 0, 0, 0, 0, $image_width, $image_height, $image_width, $image_height );
		
		return $clone_image;
		
	}
	
	
	function orientate_image( $image = array(), $image_info ) {
		
		$clone_image = $this->clone_image( $image );
		
		$orientation = $image_info[ 'Orientation' ];
		
		switch ( $orientation ) {
			
			case 3 :
				$final_image = imagerotate( $clone_image, 180, 1 );
				break;
			case 5 :
			case 6 :
			case 7 :
				$final_image = imagerotate( $clone_image, - 90, 1 );
				break;
			case 8 :
			case 9 :
				$final_image = imagerotate( $clone_image, 90, 1 );
				break;
			default :
				$final_image = $clone_image;
			
		}
		
		return $final_image;
		
	}
	
	
	/** Process the submitted cropped image data from jquery and turn it into PHP readable format. */
	public function process_crop() {
		
		$image_string = substr( $_REQUEST[ 'image_source' ], strpos( $_REQUEST[ 'image_source' ], ',' ) + 1 );
		
		$cropped_width  = $_REQUEST[ 'image_width' ];
		$cropped_height = $_REQUEST[ 'image_height' ];
		
		$decode_string = base64_decode( $image_string );
		
		$source_image = imagecreatefromstring( $decode_string );
		$new_image    = imagecreatetruecolor( $cropped_width, $cropped_height );
		
		imagecopyresampled(
			$new_image,
			$source_image,
			0,
			0,
			0,
			0,
			$cropped_width,
			$cropped_height,
			$_REQUEST[ 'image_width' ],
			$_REQUEST[ 'image_height' ]
		);
		
		ob_start();
		
		imagepng( $new_image );
		imagedestroy( $new_image );
		$image_data = ob_get_contents();
		
		ob_end_clean();
		
		echo base64_encode( $image_data );
		
		die();
	}
	
	
	public function save_file( $parent_post_id = NULL, $term = NULL, $user_id = NULL ) {
		
		$return_data = array();
		
		do_action( 'chumly_before_save_file', $_POST );
		
		if ( $parent_post_id == NULL ) {
			
			$parent_post_id = $_POST[ 'parent_post' ];
			
			if ( $parent_post_id == 0 ) {
				
				$parent_post_id = $_POST[ 'media_bucket' ];
			}
			
		}
		
		if ( $term == NULL ) {
			
			$term = $_POST[ 'term' ];
			
		}
		
		if ( $user_id == NULL ) {
			
			$user_id = $_POST[ 'user_id' ];
			
		}
		
		if ( ! get_page_by_title( $user_id, OBJECT, 'chumly_user_media' ) ) {
			
			chumly_create_media_bucket( $user_id );
			
		}
		
		if ( $term ) {
			
			$media_bucket_term = get_term_by( 'slug', intval( $user_id ), 'chumly_media_classification' );
			
			if ( ! $media_bucket_term ) {
				
				$media_bucket_term = wp_insert_term( $user_id, 'chumly_media_classification' );
				$media_bucket_term = get_term_by( 'id', intval( $media_bucket_term[ 'term_id' ] ), 'chumly_media_classification', OBJECT );
				
			}
			
		}
		
		if ( $parent_post_id > 0 ) {
			
			foreach ( $_FILES as $files ) {
				
				if ( ! chumly_ajax() ) {
					
					$file_array = array();
					$file_count = count( $files[ 'name' ] );
					$file_keys  = array_keys( $files );
					
					for ( $i = 0; $i < $file_count; $i ++ ) {
						foreach ( $file_keys as $key ) {
							$file_array[ $i ][ $key ] = $files[ $key ][ $i ];
						}
					}
					
				} else {
					
					$file_array = $_FILES;
					
				}
				
				// These files need to be included as dependencies when on the front end.
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
				require_once( ABSPATH . 'wp-admin/includes/image.php' );
				require_once( ABSPATH . 'wp-admin/includes/media.php' );
				
				
				$upload_overrides = array( 'test_form' => FALSE, 'action' => 'chumly_upload' );
				
				foreach ( $file_array as $file ) {
					
					//Let WordPress handle the upload.
					$attachment = wp_handle_upload( $file, $upload_overrides );
					
					if ( $attachment && isset( $attachment[ 'error' ] ) ) {
						
						// There was an error uploading the image.
						$error_string = $attachment[ 'error' ];
						
						if ( chumly_ajax() ) {
							
							//$return_data[ 'alert' ]        = chumly_alert( 'error', array( $error_string ) );
							$return_data[ 'state' ] = 'error';
							//$return_data[ 'FILES' ]        = $_FILES;
							//$return_data[ 'media_bucket' ] = $parent_post_id;
							
							echo json_encode( $return_data );
							
						} else {
							
							echo chumly_alert( 'error', array( $error_string ) );
							
						}
						
					} else {
						
						$filename   = $attachment[ 'file' ];
						$filetype   = wp_check_filetype( basename( $filename, NULL ) );
						$upload_dir = wp_upload_dir();
						
						$attachment_post_data = array(
							'guid'           => $upload_dir[ 'url' ] . '/' . basename( $filename ),
							'post_mime_type' => $filetype[ 'type' ],
							'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
							'post_content'   => '',
							'post_status'    => 'inherit',
							'post_author'    => $user_id
						);
						
						$attachment_id = wp_insert_attachment( $attachment_post_data, $filename, $parent_post_id );
						
						// The image was uploaded successfully!
						wp_update_attachment_metadata( $attachment_id, wp_generate_attachment_metadata( $attachment_id, get_attached_file( $attachment_id ) ) );
						
						if ( $term ) {
							
							$child_term = get_terms( array(
								'taxonomy'   => 'chumly_media_classification',
								'child_of'   => $media_bucket_term->term_id,
								'hide_empty' => FALSE,
								'slug'       => $term . '-' . $media_bucket_term->slug
							) )[ 0 ];
							
							//$return_data[ 'ct1' ] = $child_term;
							
							if ( ! $child_term ) {
								
								$child_term = wp_insert_term( $term, 'chumly_media_classification', array(
									'parent' => $media_bucket_term->term_id,
									'slug'   => $term . '-' . $media_bucket_term->slug
								) );
								
								$child_term = get_term_by( 'id', intval( $child_term[ 'term_id' ] ), 'chumly_media_classification', OBJECT );
								
								$attachment_term_id = wp_set_post_terms( $attachment_id, $child_term->term_id, 'chumly_media_classification', TRUE );
								//$return_data[ 'ati1' ] = $attachment_term_id;
							} else {
								//$return_data[ 'ct2' ] = $child_term;
								
								$attachment_term_id = wp_set_post_terms( $attachment_id, $child_term->term_id, 'chumly_media_classification', TRUE );
							}
							
						}
						
						if ( $_POST[ 'parent_post' ] > 0 ) {
							set_post_thumbnail( $parent_post_id, $attachment_id );
						}
						
						do_action( 'chumly_after_save_file', $_POST[ 'media_classification' ], $attachment_id );
						
						if ( chumly_ajax() ) {
							
							$return_data['$_POST'] = $_POST;
							
							$return_data[ 'state' ] = 'success';
							$return_data[ 'attachment_id' ] = $attachment_id;
							$return_data[ 'media_classification' ] = $_POST[ 'media_classification' ];
							
							echo json_encode( $return_data );
							
						} else {
							
							return $attachment_id;
							
						}
						
					}
					
				}
				
			}
			
		} else {
			
			/*
			 * @TODO RETURN ERROR & OUTPUT TO UI
			 */
			
		}
		
		chumly_die();
		
	}
	
	
	function count_images() {
		$attachment_array = $types_array = array();
		if ( in_array( 'image', $types_array ) ) {
			if ( count( $attachment_array ) > 1 ) {
				$post_format = 'gallery';
			} else {
				$post_format = 'image';
			}
		}
		
		return $post_format;
		
	}
	
	function create_gallery() {
		
	}
	
}

new Chumly_Upload();