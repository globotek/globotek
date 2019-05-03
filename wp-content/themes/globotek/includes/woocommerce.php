<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 2/5/19
 * Time: 6:51 PM
 */

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sales_flash', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', '', 20);

function clear_add_to_cart(){
	
	if(isset($_GET['add-to-cart'])){
		
		echo 'redirec';
		wp_redirect( wc_get_cart_url() );
		die();
		
	}
	
}

add_action( 'template_redirect', 'clear_add_to_cart' );