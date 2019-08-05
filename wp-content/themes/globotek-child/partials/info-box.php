<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 02/02/2019
 * Time: 18:42
 */ ?>

<div class="page__info-boxes box-row wrapper">
	
	<?php foreach ( $component[ 'block' ] as $info_box ) { ?>
		
		<div class="info-box">
			
			<div class="info-box__icon" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/images/small-cloud-bg.png'; ?>)">
				<?php icon( $info_box[ 'icon' ] ); ?>
			</div>
			
			<h3 class="info-box__heading heading__tertiary"><?php echo $info_box[ 'title' ]; ?></h3>
			
			<p class="info-box__text"><?php echo $info_box[ 'content' ]; ?></p>
		</div>
	
	<?php } ?>

</div>