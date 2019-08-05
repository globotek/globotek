<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', TRUE );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>
	
	<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
		
		<?php do_action( 'woocommerce_before_variations_form' ); ?>
		
		<?php if ( empty( $available_variations ) && FALSE !== $available_variations ) : ?>
			
			<p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
		
		<?php else : ?>
			
			<div class="purchase-options">
				
				<?php $i = 0; ?>
				
				<?php foreach ( $available_variations as $variation ) : ?>
					
					<?php foreach ( $variation[ 'attributes' ] as $attribute_name => $attribute ) { ?>
						
						<label>
							
							<input type="radio" name="<?php echo 'attribute_' . $attribute_name; ?>" value="<?php echo $variation[ 'variation_id' ]; ?>" <?php _e( $i == 0 ? 'checked="checked"' : '' ); ?>/>
							
							<div class="label">
								
								<?php echo '<span class="attribute">' . $attribute . '</span>'; ?>
								<?php echo $variation[ 'price_html' ]; ?>
							
							</div>
						
						</label>
					
					<?php } ?>
					
					<?php $i ++; ?>
				
				<?php endforeach; ?>
			
			</div>
			
			<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
			<div class="quantity hidden">
				<input type="hidden" id="quantity_<?php echo wp_create_nonce(); ?>" class="qty" name="quantity_<?php echo wp_create_nonce(); ?>" value="1"/>
			</div>
			<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>"/>
			<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>"/>
			<input type="hidden" name="variation_id" class="variation_id" value="0"/>
		
		<?php endif; ?>
		
		<?php do_action( 'woocommerce_after_variations_form' ); ?>
	</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
