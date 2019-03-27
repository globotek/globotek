<?php

/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 31/7/18
 * Time: 8:08 PM
 */
class Chumly_Newsfeed {
	
	protected $friends;
	protected $friend_ids = array();
	static $posts = array();
	
	function __construct() {
		
		$this->friends = chumly_get_friends( get_current_user_id(), NULL );
		//var_dump( $this->friends );
		foreach ( $this->friends as $friend ) {
			
			$this->friend_ids[] = intval( $friend->data->ID );
			
		}
		
		$this->generate_newsfeed();
		
	}
	
	public function generate_newsfeed() {
		
		if($this->friends) {
			
			$this->posts[] = $this->get_friend_status_posts();
			$this->posts[] = $this->get_friend_group_posts();
			
			/**
			 * ... on $this->posts shifts all 2nd level arrays to top level to make the
			 * array single dimensional after the creation of the array as an array of arrays.
			 */
			$this->posts = array_merge( ...$this->posts );

			usort( $this->posts, function ( $item1, $item2 ) {
				
				if ( $item1->post_date_gmt == $item2->post_date_gmt ) {
					return 0;
				}
				
				return ( $item1->post_date_gmt < $item2->post_date_gmt ) ? 1 : - 1;
				
			} );
			
			return $this->posts;
			
		}
		
	}
	
	public function get_friend_status_posts() {
		
		$query = new WP_Query( array(
			'post_type' => 'chumly_status_post',
			'author'    => implode( ',', $this->friend_ids )
		) );
		
		return $query->posts;
		
	}
	
	public function get_friend_group_posts() {
		
		$query = new WP_Query( array(
			'post_type' => 'chumly_group_message',
			'author'    => implode( ',', $this->friend_ids )
		) );
		
		return $query->posts;
		
	}
	
}