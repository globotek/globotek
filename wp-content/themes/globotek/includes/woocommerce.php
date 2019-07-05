<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 2/5/19
 * Time: 6:51 PM
 */

include_once( 'woocommerce/archive-template.php' );
include_once( 'woocommerce-single-product.php' );


function clear_add_to_cart() {
	
	if ( isset( $_GET[ 'add-to-cart' ] ) ) {
		
		wp_redirect( wc_get_cart_url() );
		die();
		
	}
	
	if ( isset( $_POST[ 'add-to-cart' ] ) ) {
		
		wp_redirect( $_SERVER[ 'HTTP_REFERER' ] );
		die();
		
	}
	
}

add_action( 'template_redirect', 'clear_add_to_cart' );


