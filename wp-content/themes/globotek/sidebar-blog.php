<div class="blog-archive__sidebar">
	
	<div class="widget">
		<h3 class="widget__heading">Categories</h3>
		
		<ul class="widget__list">
			
			<?php foreach ( get_categories() as $category ) { ?>
				
				<li class="widget__list__item">
					<a href="<?php echo get_term_link( $category ); ?>"><?php echo $category->name; ?></a>
				</li>
			
			<?php } ?>
		
		</ul>
	
	</div>
	
	<div class="widget">
		<h3 class="widget__heading">Archives</h3>
		
		<ul class="widget__list">
			
			<?php wp_get_archives( array(
				'limit'  => 12,
				'format' => 'custom',
				'before' => '<li class="widget__list__item">',
				'after'  => '</li>',
				'echo'   => TRUE
			) ); ?>
		
		
		</ul>
	
	</div>

</div>
