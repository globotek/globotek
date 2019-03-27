<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 18/10/18
 * Time: 6:27 PM
 */
function chumly_merge_menus( $menus ) {
	
	$menus = apply_filters( 'chumly_dashboard_navigation', $menus );
	
	$menu       = array_values( $menus );
	$navigation = array();
	
	foreach ( $menu as $key => $value ) {
		
		foreach ( $value as $key => $value ) {
			
			if ( array_key_exists( $key, $navigation ) ) {
				
				++ $key;
				
			}
			
			$navigation[ $key ] = $value;
			
		}
		
	}
	
	ksort( $navigation );
	
	return $navigation;
	
}

add_action( 'chumly_merge_menus', 'chumly_merge_menus' );


function chumly_main_menu( $menus ) {
	
	$main_menu = array();
	
	$main_menu[ 10 ] =
		array(
			'nav_items' => array(
				array(
					'icon'  => 'monitor',
					'title' => 'News Feed',
					'url'   => home_url( '/' ) . chumly_get_option( 'dashboard_page' )
				),
				array(
					'icon'  => 'mail',
					'title' => 'Messaging',
					'url'   => home_url( '/' ) . chumly_get_option( 'user_messaging_page' )
				)
			)
		);
	
	$main_menu[ 20 ] =
		array(
			'section_title' => 'Discover',
			'nav_items'     => array(
				array(
					'icon'  => 'users',
					'title' => 'People',
					'url'   => home_url( '/' ) . chumly_get_option( 'user_archive_page' )
				),
				array(
					'icon'  => 'group',
					'title' => 'Groups',
					'url'   => home_url( '/' ) . chumly_get_option( 'group_archive_page' )
				)
			)
		
		);
	
	$main_menu[ 30 ] = array(
		'section_title' => 'Shortcuts',
		'nav_items'     => array(
			array(
				'icon'  => 'cog',
				'title' => 'Settings',
				'url'   => home_url( '/' ) . 'settings/general'
			)
		)
	);
	
	ksort( $main_menu );
	
	$menus[ 'main_menu' ] = $main_menu;
	
	return $menus;
	
}

add_filter( 'chumly_dashboard_navigation', 'chumly_main_menu', 100 );