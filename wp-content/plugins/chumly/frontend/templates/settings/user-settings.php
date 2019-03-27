<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 26/6/18
 * Time: 5:33 PM
 */

do_action( 'chumly_before_content' ); ?>

<?php $settings = new Chumly_Settings(); ?>

<?php if ( ! empty( $_POST ) ) { ?>
	
	<?php $settings->save_settings(); ?>

<?php } ?>

<?php $settings_panels = apply_filters( 'chumly_settings_panels', array() ); ?>

<div class="navigator navigator--skinny-sidebar">
	
	<div class="navigator__sidebar">
		
		<?php do_action( 'chumly_settings_sidebar', $settings_panels ); ?>
	
	</div>
	
	<div class="navigator__content">
		
		<?php $current_panel = $settings_panels[ array_search( trailingslashit( $_SERVER[ 'REQUEST_URI' ] ), array_column( $settings_panels, 'url' ) ) ]; ?>
		
		<?php echo '<h2 class="breathe--bottom">' . $current_panel[ 'title' ] . '</h2>'; ?>
		
		<?php chumly_form_header(); ?>
		
		<?php include( $current_panel[ 'template_path' ] ); ?>
		
		<?php chumly_form_footer(); ?>
	
	</div>

</div>

<?php do_action( 'chumly_after_content' ); ?>
