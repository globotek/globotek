<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 2/5/19
 * Time: 6:51 PM
 */

// SINGLE PRODUCT TEMPLATE HOOKS

// REMOVE HOOKS
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



// ADD HOOKS
function clear_add_to_cart() {
	
	if ( isset( $_GET[ 'add-to-cart' ] ) ) {
		
		wp_redirect( wc_get_cart_url() );
		die();
		
	}
	
}

add_action( 'template_redirect', 'clear_add_to_cart' );

add_action( 'woocommerce_before_single_product', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_before_single_product', 'woocommerce_show_product_images', 20 );
add_action( 'woocommerce_before_single_product', 'woocommerce_template_single_excerpt', 20 );

add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_add_to_cart', 20 );

add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 30 );



add_action( 'woocommerce_before_main_content', function () {
      
    if ( is_product() ) {
        //echo '<div class="wrapper">';
    }
        
}, 5 );


add_action( 'woocommerce_before_single_product', function () {
	
	echo '<div class="product-archive wrapper"><div class="chunk">';

	echo '<div class="woocommerce-product"><div class="woocommerce-product__left">';
	
}, 5 );


add_action( 'woocommerce_after_description', function () {
	
	echo '</div><div class="woocommerce-product__right">';
	
}, 5 );


add_action( 'woocommerce_before_single_product_summary', function () {
	
	echo '<div class="gradient-box">';
	
}, 5 );


add_action( 'woocommerce_single_product_summary', function () {
	
	echo '</div>';
	
}, 5 );


add_action( 'woocommerce_after_single_product_summary', function () {
	
	echo '<div class="support">
    <h3>Support</h3>
    <p>Fusce massa odio, fringilla eget nisi elementum, rhoncus consectetur risus.</p>
    <div class="center">
        <a class="button--white">
            Ask Us a Question
        </a>
    </div>
    </div>
    <div class="details">';
	
}, 5 );


add_action( 'woocommerce_after_single_product', function () {
	
	echo '</div></div></div>';
	
}, 5 );


// ARCHIVE PRODUCT TEMPLATE HOOKS

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


function woocommerce_after_shop_loop_item_title_short_description() {
	global $product;
	if ( ! $product->post->post_excerpt ) return;
	?>
	<div class="description">
		<?php echo apply_filters( 'woocommerce_short_description', $product->post->post_excerpt ) ?>
	</div>
	<?php
}
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_after_shop_loop_item_title_short_description', 5);


add_action( 'woocommerce_before_main_content', function () {
    
    if ( is_product_category() ) {
        echo '<div class="product-archive"><div class="wrapper"><div class="section-title breathe--treble">';
    }
        
}, 5 );


add_action( 'woocommerce_archive_description', function () {
	
	echo '</div></div></div>';
	
}, 5 );


add_action( 'woocommerce_after_main_content', function () {
	
	echo '</div>';
	
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
        <img src="';

    echo get_template_directory_uri() . "/images/product-bg-top.svg";
    
    echo '"/>
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
    <img src="';
        
    echo get_template_directory_uri() . "/images/product-bg-bottom.svg";

    echo '"/>
    </div>
    </div>';
	
}, 5 );