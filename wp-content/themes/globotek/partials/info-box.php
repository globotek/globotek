<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 02/02/2019
 * Time: 18:42
 */ ?>

<div class="page__info-boxes box-row">
	
	<?php foreach ( $component[ 'block' ] as $info_box ) { ?>
		
		<div class="info-box">
			
			<div class="info-box__icon" style="background-image: url(<?php echo get_template_directory_uri() . '/images/small-cloud-bg.png'; ?>)">
				<img src="<?php echo get_template_directory_uri() . '/images/lightbulb.png'; ?>"/>
			</div>
			
			<h3 class="info-box__heading heading__tertiary"><?php echo $info_box[ 'title' ]; ?></h3>
			
			<p class="info-box__text"><?php echo $info_box['content']; ?></p>
		</div>
	
	<?php } ?>

</div>