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

add_action( 'wp_footer', 'theme_development' );


function theme_styles() {
	
	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css' );
	wp_enqueue_style( 'global', get_template_directory_uri() . '/css/global.css' );
	
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


add_image_size( 'interior-banner', 0, 200, false );
add_image_size( 'post-hero', 0, 600, TRUE );

if ( function_exists( 'woocommerce' ) ) {
	
	add_theme_support( 'woocommerce' );
	
}


register_nav_menus( array(
	'main'   => 'Main Menu',
	'footer' => 'Footer Menu'
) );
