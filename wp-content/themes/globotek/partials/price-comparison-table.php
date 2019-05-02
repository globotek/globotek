<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 09/02/2019
 * Time: 18:05
 */ ?>

<div class="comparison-grid breathe--treble wrapper">
	
	<?php foreach ( $component[ 'columns' ] as $column ) { ?>
		
		<?php if ( $column['title'] ) { ?>
			
			<div class="comparison-grid__item breathe--top">
				
				<div class="comparison">
					
					<div class="comparison__title <?php _e( ! $column[ 'promoted_option' ] ? '' : 'comparison__title--popular' ); ?>">
						<h2 class="heading"><?php echo $column[ 'title' ]; ?></h2>
						<h3 class="title__secondary title--blue"><?php echo get_woocommerce_currency_symbol() . $column[ 'price' ]; ?></h3>
					</div>
					
					<div class="comparison__content">
						
						<div class="comparison__list">
							
							<ul>
								
								<?php foreach ( $column[ 'feature_list' ] as $feature ) { ?>
									
									<li class="comparison__list__item">
										<i class="fas fa-check"></i><?php echo $feature[ 'feature' ]; ?></li>
								
								<?php } ?>
							
							</ul>
						
						</div>
						
						<div class="comparison__text">
							
							<p><?php echo $column[ 'content' ]; ?></p>
						
						</div>
						
						<div class="comparison__link">
							
							<a href="<?php echo $column[ 'linked_page' ]; ?>" class="button button--white"><?php echo $column[ 'link_text' ]; ?></a>
						
						</div>
					
					</div>
					
					<div class="comparison__bottom">
						<img class="comparison__bottom__image" src="<?php echo get_template_directory_uri() . '/images/comparison-bottom.svg'; ?>"/>
					</div>
				
				</div>
			
			</div>
		
		<?php } ?>
	
	<?php } ?>

</div>
