<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 27/6/18
 * Time: 10:22 AM
 */
?>

<ul class="list">
	
	<?php foreach ( $data as $panel ) { ?>
		
		<?php (trailingslashit( $_SERVER[ 'REQUEST_URI' ] ) == $panel['url'] ? $active_class = 'is-active' : $active_class = '' ); ?>
		
		<li class="list__item <?php echo $active_class; ?>">
			
			<a href="<?php echo $panel[ 'url' ]; ?>" class="list__item__inner">
				
				<?php chumly_icon( $panel[ 'icon' ], 'list__item__icon' ); ?>
				<p class="list__item__text"><?php echo $panel[ 'title' ]; ?></p>
			
			</a>
		
		</li>
	
	<?php } ?>

</ul>

