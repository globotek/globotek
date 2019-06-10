<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 5/6/19
 * Time: 6:23 AM
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


function woocommerce_after_shop_loop_item_title_short_description() {
	global $product;
	
	if ( ! $product->post->post_excerpt ) {
		return;
	}
	
	echo '<div class="description">';
	
		 echo apply_filters( 'woocommerce_short_description', $product->post->post_excerpt );
	
	echo '</div>';
	
}

//add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_after_shop_loop_item_title_short_description', 5 );


add_action( 'woocommerce_before_main_content', function () {
	
	if ( is_product_category() ) {
		echo '<div class="product-archive"><div class="wrapper"><div class="section-title breathe--treble">';
	}
	
}, 5 );


add_action( 'woocommerce_archive_description', function () {
	
	echo '</div></div></div>';
	
}, 5 );





add_action( 'woocommerce_before_shop_loop', function () {
	
	echo '<div class="product-archive__products">';
	
}, 5 );


add_action( 'woocommerce_after_shop_loop', function () {
	
	echo '</div>';
	
}, 5 );

add_action( 'woocommerce_before_shop_loop_item', function () {
	
	echo '<div class="product-archive__product">
    <div class="product-archive__background product-archive__background-top">
        <img src="' . get_template_directory_uri() . '/images/product-bg-top.svg' . '"/>
    </div>
    <div class="product-archive__inner">
    <div class="product-archive__content wrapper clear">
    <div class="product-archive__image">';
	
}, 5 );


add_action( 'woocommerce_shop_loop_item_title', function () {
	
	echo '</div>
    <div class="product-archive__text">';
	
}, 5 );


add_action( 'woocommerce_after_shop_loop_item', function () {
	
	echo '</div>
    </div>
    </div>
    <div class="product-archive__background product-archive__background-bottom">
    <img src="' . get_template_directory_uri() . '/images/product-bg-bottom.svg' . '"/>
    </div>
    </div>';
	
}, 5 );