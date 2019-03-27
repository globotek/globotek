<?php
function chumly_pagination( $total_pages, $current_page, $paginated_archive ) {
	
	$previous_page = $current_page - 1;
	$next_page = $current_page + 1;
	
	if ( $total_pages > 1 ) { ?>
		
		<div class="chunk chunk--double">
			<nav class="pagination">
				
				<ul class="pagination__group">
					
					<?php if ( $previous_page >= 1 ) { ?>
						
						<li class="pagination__item">
							<a href="<?php echo trailingslashit(home_url()) . trailingslashit(chumly_get_option($paginated_archive)) . 'page/1'; ?>" class="pagination__item__inner" aria-label="First page">
								<svg aria-hidden="true" class="pagination__icon icon">
									<use xmlns:xlink="http://www.w3.org/1999/xlink"
										 xlink:href="<?php echo plugin_dir_url( __DIR__ ) . '/images/icons/svg-symbols.svg#rewind'; ?>"></use>
								</svg>
							</a>
						</li>
						<li class="pagination__item">
							<a href="<?php echo trailingslashit(home_url()) . trailingslashit(chumly_get_option($paginated_archive)) . 'page/' . $previous_page; ?>" class="pagination__item__inner"
							   aria-label="Previous page">
								<svg aria-hidden="true" class="pagination__icon icon">
									<use xmlns:xlink="http://www.w3.org/1999/xlink"
										 xlink:href="<?php echo plugin_dir_url( __DIR__ ) . '/images/icons/svg-symbols.svg#angle-left'; ?>"></use>
								</svg>
							</a>
						</li>
					
					<?php } ?>
					
					<!-- Inner loop of pages -->
					<li class="pagination__item pagination__item--nesting-parent">
						<ol class="pagination__group">
							
							<li class="pagination__item pagination__item--numerical">
								<a href="<?php echo trailingslashit(home_url()) . trailingslashit(chumly_get_option($paginated_archive)) . 'page/1'; ?>"
								   class="pagination__item__inner <?php _e( $current_page == 1 ? 'is-active' : '' ); ?>"
								   aria-describedby="current"><span
										class="is-hidden--text">Go to page </span><?php echo 1; ?></a>
							</li>
							
							<?php if ( $current_page > 3 ) { ?>
								
								<li class="pagination__item pagination__item--numerical">
									<span class="pagination__item__inner">...</span>
								</li>
							
							<?php } ?>
							
							<?php for ( $i = 2; $i < $total_pages; $i++ ) { ?>
								
								<?php if ( ( $i >= ( $current_page - 2 ) && $i <= $current_page ) || ( $i <= ( $current_page + 2 ) && $i >= $current_page ) || $i == $current_page ) { ?>
									
									
									<li class="pagination__item pagination__item--numerical">
										<a href="<?php echo trailingslashit(home_url()) . trailingslashit(chumly_get_option($paginated_archive)) . 'page/' . $i; ?>"
										   class="pagination__item__inner <?php _e( $current_page == $i ? 'is-active' : '' ); ?>"
										   aria-describedby="current"><span
												class="is-hidden--text">Go to page </span><?php echo $i; ?></a>
									</li>
								
								<?php } ?>
							
							<?php } ?>
							
							<?php if ( $current_page < ( $total_pages - 3 ) ) { ?>
								
								<li class="pagination__item pagination__item--numerical">
									<span class="pagination__item__inner">...</span>
								</li>
							
							<?php } ?>
							
							<li class="pagination__item pagination__item--numerical">
								<a href="<?php echo trailingslashit(home_url()) . trailingslashit(chumly_get_option($paginated_archive)) . 'page/' . $total_pages; ?>"
								   class="pagination__item__inner <?php _e( $current_page == $total_pages ? 'is-active' : '' ); ?>"
								   aria-describedby="current"><span
										class="is-hidden--text">Go to page </span><?php echo $total_pages; ?>
								</a>
							</li>
						
						</ol>
					</li>
					<!-- Inner loop of pages -->
					
					
					<?php if ( $next_page <= $total_pages ) { ?>
						
						<li class="pagination__item">
							<a href="<?php echo trailingslashit(home_url()) . trailingslashit(chumly_get_option($paginated_archive)) . 'page/' . $next_page; ?>" class="pagination__item__inner"
							   aria-label="Next page">
								<svg aria-hidden="true" class="pagination__icon icon">
									<use xmlns:xlink="http://www.w3.org/1999/xlink"
										 xlink:href="<?php echo plugin_dir_url( __DIR__ ) . '/images/icons/svg-symbols.svg#angle-right'; ?>"></use>
								</svg>
							</a>
						</li>
						<li class="pagination__item">
							<a href="<?php echo trailingslashit(home_url()) . trailingslashit(chumly_get_option($paginated_archive)) . 'page/' . $total_pages; ?>" class="pagination__item__inner"
							   aria-label="Last page">
								<svg aria-hidden="true" class="pagination__icon icon">
									<use xmlns:xlink="http://www.w3.org/1999/xlink"
										 xlink:href="<?php echo plugin_dir_url( __DIR__ ) . '/images/icons/svg-symbols.svg#fast-forward'; ?>"></use>
								</svg>
							</a>
						</li>
					
					<?php } ?>
				
				</ul>
			
			</nav>
		</div>
	
	<?php }
	
} ?>
