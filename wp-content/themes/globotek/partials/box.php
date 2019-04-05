<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 09/02/2019
 * Time: 18:05
 */ ?>

<div class="box">
	<div class="box__icon">
		<img src="<?php echo get_template_directory_uri() . '/images/browser.png'; ?>" alt=""/>
	</div>
	
	<h3 class="box__heading heading__tertiary"><?php echo $box['title']; ?></h3>
	<p class="box__text"><?php echo $box['content']; ?></p>
</div>
