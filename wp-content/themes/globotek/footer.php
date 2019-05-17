<footer class="site-foot">
	
	<div class="site-foot__background">
		<img src="<?php echo get_template_directory_uri() . '/images/footer-bg.svg'; ?>"/>
	</div>
	
	<div class="site-foot__inner">
		
		<div class="site-foot__content">
			
			<div class="site-foot__contact">
				
				<a href="<?php echo home_url(); ?>" class="site-foot__contact__logo">
					<img src="<?php header_image(); ?>" alt="GloboTek Logo in White"/>
				</a>
				
				<a href="tel:01905570735" class="site-foot__contact__phone">01905 570735</a>
				<p class="site-foot__contact__hours">Available 10am - 6pm UK Time</p>
			
			</div>
			
			<?php
			$menu_locations = get_nav_menu_locations();
			
			/** Select the menu we want for current location, in this case, header so main.*/
			$col_1_menu = $menu_locations[ 'footer_col_1' ];
			$col_2_menu = $menu_locations[ 'footer_col_2' ];
			$col_3_menu = $menu_locations[ 'footer_col_3' ];
			$col_4_menu = $menu_locations[ 'footer_col_4' ];
			
			/** Get all the menu items for the chosen menu.*/
			$col_1_menu_items = wp_get_nav_menu_items( $col_1_menu );
			$col_2_menu_items = wp_get_nav_menu_items( $col_2_menu );
			$col_3_menu_items = wp_get_nav_menu_items( $col_3_menu );
			$col_4_menu_items = wp_get_nav_menu_items( $col_4_menu );
			
			/** Apply WP classes to menu items.*/
			_wp_menu_item_classes_by_context( $col_1_menu_items );
			_wp_menu_item_classes_by_context( $col_2_menu_items );
			_wp_menu_item_classes_by_context( $col_3_menu_items );
			_wp_menu_item_classes_by_context( $col_4_menu_items ); ?>
			
			<div class="site-foot__nav">
				
				<?php if ( ! empty( $col_1_menu_items ) ) { ?>
					
					<div class="site-foot__nav__item">
						
						<h3 class="title title__quaternary"><?php echo wp_get_nav_menu_object( $col_1_menu )->name; ?></h3>
						
						<ul class="site-foot__nav__item__menu">
							
							<?php foreach ( $col_1_menu_items as $menu_item ) { ?>
								
								<li>
									<a href="<?php echo $menu_item->url; ?>" class="button__text button__text--white"><?php echo $menu_item->title; ?></a>
								</li>
							
							<?php } ?>
						
						</ul>
					
					</div>
				
				<?php } ?>
				
				<?php if ( ! empty( $col_2_menu_items ) ) { ?>
					
					<div class="site-foot__nav__item">
						
						<h3 class="title title__quaternary"><?php echo wp_get_nav_menu_object( $col_2_menu )->name; ?></h3>
						
						<ul class="site-foot__nav__item__menu">
							
							<?php foreach ( $col_2_menu_items as $menu_item ) { ?>
								
								<li>
									<a href="<?php echo $menu_item->url; ?>" class="button__text button__text--white"><?php echo $menu_item->title; ?></a>
								</li>
							
							<?php } ?>
						
						</ul>
					
					</div>
				
				<?php } ?>
				
				<?php if ( ! empty( $col_3_menu_items ) ) { ?>
					
					<div class="site-foot__nav__item">
						
						<h3 class="title title__quaternary"><?php echo wp_get_nav_menu_object( $col_3_menu )->name; ?></h3>
						
						<ul class="site-foot__nav__item__menu">
							
							<?php foreach ( $col_3_menu_items as $menu_item ) { ?>
								
								<li>
									<a href="<?php echo $menu_item->url; ?>" class="button__text button__text--white"><?php echo $menu_item->title; ?></a>
								</li>
							
							<?php } ?>
						
						</ul>
					
					</div>
				
				<?php } ?>
				
				<?php if ( ! empty( $col_4_menu_items ) ) { ?>
					
					<div class="site-foot__nav__item">
						
						<h3 class="title title__quaternary"><?php echo wp_get_nav_menu_object( $col_4_menu )->name; ?></h3>
						
						<ul class="site-foot__nav__item__menu">
							
							<?php foreach ( $col_4_menu_items as $menu_item ) { ?>
								
								<li>
									<a href="<?php echo $menu_item->url; ?>" class="button__text button__text--white"><?php echo $menu_item->title; ?></a>
								</li>
							
							<?php } ?>
						
						</ul>
					
					</div>
				
				<?php } ?>
			
			</div>
		
		</div>
		
		<p class="site-foot__copyright">&copy; GloboTek Ltd <?php echo date( 'Y' ); ?>. All rights reserved</p>
	
	</div>

</footer>

<?php wp_footer(); ?>

</body>
</html>