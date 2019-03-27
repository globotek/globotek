<?php

/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 6/11/18
 * Time: 12:37 PM
 */
class Chumly_Privacy {
	
	protected $result, $target_id;
	
	public function __construct( $target_id ) {
		
		$this->target_id = $target_id;
		$this->result    = FALSE;
		
	}
	
	public function profile_privacy() {
		
		$connection = new Chumly_Member_Connections();
		
		if ( $connection->is_connection() ) {
			
			$this->result = TRUE;
			
		}
		
	}
	
	public function public_connection_button() {
		
		$public_connections = get_user_meta( $this->target_id, 'public_connections' );
		
		if ( $public_connections != 0 ) {
			
			$this->result = TRUE;
			
		}
		
	}
	
	public function check_privacy() {
		
		if ( ! chumly_own_profile() ) {
			
			$methods = get_class_methods( get_class() );
			
			foreach ( $methods as $method ) {
				
				if ( $method != 'check_privacy' && $method != '__construct' ) {
					
					$this->$method();
					
				}
			}
			
		} else {
			
			$this->result = TRUE;
			
		}
		
		return $this->result;
		
	}
	
}