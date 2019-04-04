<?php
/**
 * Template Name: Component Library
 */

get_header(); ?>

<?php include( 'partials/hero-cta.php' ); ?>

<div class="home">
	
	<div class="home__icon-blocks wrapper">
		
		<?php $icon_blocks = array( 'a', 'b', 'c', 'd' ); ?>
		<?php foreach( $icon_blocks as $icon_block ) { ?>
			
			<?php include( 'partials/icon-block.php' ); ?>
		
		<?php } ?>
	
	</div>
	
	<div class="home__cta-rows wrapper">
		
		<?php $cta_rows = array( 'a', 'b', 'c' ); ?>
		<?php foreach( $cta_rows as $cta_row ) { ?>
			
			<?php include( 'partials/image-and-content.php' ); ?>
		
		<?php } ?>
	
	</div>
	
	<div class="section-title breathe--treble">
		<h2 class="title__secondary">Lorem ipsum dolor sit amet</h2>
	</div>
	
	<div class="home__info-boxes box-row">
		
		<?php $info_boxes = array( 'a', 'b', 'c', 'd' ); ?>
		<?php foreach( $info_boxes as $info_box ) { ?>
			
			<?php include( 'partials/info-box.php' ); ?>
		
		<?php } ?>
	
	</div>
	
	<?php include( 'partials/cta-universal.php' ); ?>
	
	<div class="section-title breathe--bottom-double">
		<h2 class="title__secondary">Lorem ipsum dolor sit amet consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem</h2>
		<p class="section-title__intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. </p>
	</div>
	
	<?php include( 'partials/box-grid.php' ); ?>
	
	<div class="section-title breathe--treble">
		<h2 class="title__secondary">Articles &amp; Blog</h2>
		<p class="section-title__intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus. Donec maximus mauris vel interdum pharetra.</p>
    </div>
	
	<div class="breathe--bottom-double">
	    <?php include( 'partials/card-grid.php' ); ?>
    </div>
    
	<?php include( 'partials/cta-portfolio-item.php' ); ?>
	
	<div class="home__icon-blocks wrapper">
		
		<?php $icon_blocks = array( 'a', 'b', 'c', 'd' ); ?>
		<?php foreach( $icon_blocks as $icon_block ) { ?>
			
			<?php include( 'partials/icon-block.php' ); ?>
		
		<?php } ?>
	
	</div>
	
	<?php include( 'partials/cta-testimonials.php'); ?>
	
	<div class="home__icon-blocks wrapper">
		
		<?php $icon_blocks = array( 'a', 'b', 'c', 'd' ); ?>
		<?php foreach( $icon_blocks as $icon_block ) { ?>
			
			<?php include( 'partials/icon-block.php' ); ?>
		
		<?php } ?>
	
	</div>
</div>

<?php get_footer(); ?>
