<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 1/7/19
 * Time: 9:09 AM
 */


remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


function gtek_woocom_product_hero() {
	
	if ( is_product() ) {
		
		gtek_hero();
		echo '<div class="wrapper">';
		echo '<div class="woocommerce-product">';
		echo '<div class="woocommerce-product__content">';
		
	}
	
}

add_action( 'woocommerce_before_main_content', 'gtek_woocom_product_hero', 0 );


add_action( 'woocommerce_before_main_content', function () {
	
}, 50 );


add_action( 'woocommerce_after_main_content', function () {
	
	if ( is_product() ) {
		
		echo '</div>';
		
		
	}
	
}, 0 );

function gtek_woocom_content() {

	echo '<div class="content">';
	
	the_content();
	
	echo '</div>';
	
}

add_action( 'woocommerce_single_product_summary', 'gtek_woocom_content', 10 );


add_action( 'woocommerce_sidebar', function () {
	
	echo '<div class="woocommerce-product__sidebar">';
	
}, 0 );


add_action( 'woocommerce_sidebar', function () {
	
	if ( is_product() ) {
		
		
		echo '<div class="price-box gradient-box">';
		
		echo '<h3>Purchase Options</h3>';
		
		
		echo '<div class="centered">';
		//woocommerce_template_single_price();
		woocommerce_template_single_add_to_cart();
		//echo '<a href="#" class="button button--large">Buy Now</a>';
		
		echo '</div>';
		
		echo '</div>';
		
	}
	
}, 11 );


add_action( 'woocommerce_sidebar', function () {
	
	if ( is_product() ) {
		
		echo '<div class="support">';
		echo '<h3>Support</h3>';
		echo '<p>Fusce massa odio, fringilla eget nisi elementum, rhoncus consectetur risus.</p>';
		echo '<div class="center">';
		echo '<a href="#" class="button button--white">Ask Us a Question</a>';
		echo '</div>';
		echo '</div>';
		
		echo '<div class="details">';
		echo '<h3>Details</h3>';
		
		echo '<div class="details__entry">';
		echo '<p>Fusce massa</p><p>1.0.0</p>';
		echo '</div>';
		
		echo '<div class="details__entry">';
		echo '<a href="#">Ask Us a Question</a>';
		echo '</div>';
		
		echo '</div>';
		
		
	}
}, 15 );


add_action( 'woocommerce_sidebar', function () {
	
	echo '</div>';
	echo '</div>';
	echo '</div>';
	
}, 100 );


//add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 10 );


//add_action( 'woocommerce_before_single_product', 'woocommerce_template_single_title', 5 );
//add_action( 'woocommerce_before_single_product', 'woocommerce_show_product_images', 20 );
//add_action( 'woocommerce_before_single_product', 'woocommerce_template_single_excerpt', 20 );
//add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_price', 10 );
//add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_add_to_cart', 20 );
//add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 30 );
	

