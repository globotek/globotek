<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 5/6/19
 * Time: 6:24 AM
 */

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sales_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', '', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action( 'woocommerce_before_single_product', function () {
	
	echo '<div class="wrapper chunk">';
	
	//echo '<div class="woocommerce-product">';
	
	//echo '<div class="woocommerce-product__content">';
	
}, 5 );

add_action('woocommerce_after_single_product', function(){
	
	echo '</div>';
	
}, 5);

/*
add_action( 'woocommerce_before_single_product', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_before_single_product', 'woocommerce_show_product_images', 20 );
add_action( 'woocommerce_before_single_product', 'woocommerce_template_single_excerpt', 20 );

add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_add_to_cart', 20 );

add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 30 );





add_action( 'woocommerce_before_single_product', function () {
	
	echo '<div class="wrapper"><div class="chunk">';
	
	echo '<div class="woocommerce-product">';
	
	echo '<div class="woocommerce-product__content">';
	
}, 5 );


add_action( 'woocommerce_after_description', function () {
	
	echo '</div>';
	echo '</div>';
	echo '</div>';
	
	echo '<div class="woocommerce-product__sidebar">';
	
}, 5 );


add_action( 'woocommerce_before_single_product_summary', function () {
	
	echo '<div class="gradient-box">';
	
}, 5 );


add_action( 'woocommerce_single_product_summary', function () {
	
	echo '</div>';
	
}, 5 );


add_action( 'woocommerce_sidebar', function () {
	
	echo '<div class="support">
    <h3>Support</h3>
    <p>Fusce massa odio, fringilla eget nisi elementum, rhoncus consectetur risus.</p>
    <div class="center">
        <a class="button--white">
            Ask Us a Question
        </a>
    </div>
    </div>
    <div class="details"></div>';
	
}, 15 );


add_action( 'woocommerce_after_single_product', function () {
	
	echo '</div></div></div>';
	
	echo '</div>';
	echo '</div>';
	
	
}, 5 );*/