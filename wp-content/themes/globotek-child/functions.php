<?php
function theme_development() {
	
	global $template;
	
	echo '<strong>' . $template . '</strong>';
	
	echo '
<script id="__bs_script__">//<![CDATA[
    document.write("<script async src=\'http://HOST:3000/browser-sync/browser-sync-client.js?v=2.26.3\'><\/script>".replace("HOST", location.hostname));
//]]></script>
<style>
#__bs_notify__ {
  
  /* Move notification to bottom */
  top: auto !important;
  bottom: 0 !important;
  border-top-left-radius: 5px !important;
  border-bottom-left-radius: 0 !important;
}
</style>

';
	
}

if ( home_url() == 'http://globotek.local' ) {
	
	add_action( 'wp_footer', 'theme_development' );
	
}

function theme_styles() {
	
	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css' );
	wp_enqueue_style( 'global', get_stylesheet_directory_uri() . '/css/globotek-child.css' );
	
}

add_action( 'wp_enqueue_scripts', 'theme_styles' );


function theme_scripts() {
	
	wp_enqueue_script( 'lib', get_template_directory_uri() . '/scripts/lib.js', array( 'jquery' ), 1.0, TRUE );
	wp_register_script( 'app', get_template_directory_uri() . '/scripts/globotek.js', array( 'lib' ), 1.0, TRUE );
	wp_localize_script( 'app', 'ajax_variables', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'user_id'  => get_current_user_id()
	) );
	wp_enqueue_script( 'app' );
	
	wp_dequeue_script( 'wc-cart-fragments' );
	
}

add_action( 'wp_enqueue_scripts', 'theme_scripts' );


function theme_includes() {
	
	foreach ( glob( dirname( __FILE__ ) . '/includes/*.php' ) as $file ) {
		include_once( $file );
	}
	
}

add_action( 'after_setup_theme', 'theme_includes' );

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'category-thumbnails' );
add_theme_support( 'custom-header' );
add_theme_support( 'title-tag' );

add_image_size( 'interior-banner', 0, 200, FALSE );
add_image_size( 'post-hero', 1920, 0, TRUE );
add_image_size( 'card-thumbnail', 0, 250, FALSE );


if ( function_exists( 'rocket_init' ) ) {
	
	function rocket_lazyload_exclude_class( $attributes ) {
		
		$attributes[] = 'class="gallery__item"';
		
		return $attributes;
		
	}
	
	add_filter( 'rocket_lazyload_excluded_attributes', 'rocket_lazyload_exclude_class' );
	
}


if ( class_exists( 'woocommerce' ) ) {
	
	add_theme_support( 'woocommerce' );
	
}


register_nav_menus( array(
	'main'         => 'Main Menu',
	'footer_col_1' => 'Footer Column 1 Menu',
	'footer_col_2' => 'Footer Column 2 Menu',
	'footer_col_3' => 'Footer Column 3 Menu',
	'footer_col_4' => 'Footer Column 4 Menu'
) );


function reduced_excerpt_length( $length ) {
	
	if ( ! is_admin() || ! is_home() ) {
		
		return 20;
		
	}
	
	return $length;
	
}

add_filter( 'excerpt_length', 'reduced_excerpt_length', 999 );


add_filter( 'yoast-acf-analysis/refresh_rate', function () {
	
	// Refresh rates in milliseconds
	return 1000;
	
} );


acf_add_options_page( array( 'page_title' => 'Appointment Slots' ) );
