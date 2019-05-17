<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 09/02/2019
 * Time: 17:15
 */
?>

<div class="cta">
	
	<div class="cta__background">
		<img src="<?php echo get_template_directory_uri() . '/images/row-bg.svg'; ?>"/>
	</div>
	
	<div class="cta__inner">
		
		<div class="cta__universal">
			
			<div class="cta__universal__content">
				<h2 class="cta__universal__content__title title title__secondary"><?php echo $component[ 'title' ]; ?></h2>
				<p class="cta__universal__content__text"><?php echo $component[ 'content' ]; ?></p>
			</div>
			
			<?php if ( ! empty( $component[ 'link' ][ 'link_text' ] ) ) { ?>
				
				<div class="cta__universal__link">
					<a href="<?php echo $component[ 'link' ][ 'link_url' ]; ?>" class="button button--white"><?php echo $component[ 'link' ][ 'link_text' ]; ?></a>
				</div>
			
			<?php } ?>
		
		</div>
	
	</div>

</div>
