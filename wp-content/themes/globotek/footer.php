<footer class="site-foot">
	
	<div class="site-foot__background">
		<img src="<?php echo get_template_directory_uri() . '/images/footer-bg.svg'; ?>"/>
	</div>
	
	<div class="site-foot__inner">
		
		<div class="site-foot__content">
			
			<div class="site-foot__contact">
				
				<div class="site-foot__contact__logo">
					<img src="<?php echo get_template_directory_uri() . '/images/gtek.png'; ?>" alt=""/>
				</div>
				
				<a href="tel:01905570735" class="site-foot__contact__phone">01905 570735</a>
				<p class="site-foot__contact__hours">Available 10am - 6pm UK Time</p>
			
			</div>
			
			<div class="site-foot__nav">
				<div class="site-foot__nav__item">
					<h3>Explore</h3>
					<ul class="site-foot__nav__item__menu">
						<li><a href="#">Home</a></li>
						<li><a href="#">Articles</a></li>
						<li><a href="#">Contact Us</a></li>
						<li><a href="#">Client Area</a></li>
					</ul>
				</div>
				<div class="site-foot__nav__item">
					<h3>Website Services</h3>
					<ul class="site-foot__nav__item__menu">
						<li><a href="#">Our Services</a></li>
						<li><a href="#">Sitecare Packages</a></li>
						<li><a href="#">Portfolio</a></li>
					</ul>
				</div>
				<div class="site-foot__nav__item">
					<h3>Follow</h3>
					<ul class="site-foot__nav__item__menu">
						<li><a href="#">LinkedIn</a></li>
						<li><a href="#">Facebook</a></li>
						<li><a href="#">Twitter</a></li>
					</ul>
				</div>
				<div class="site-foot__nav__item">
					<h3>Legal</h3>
					<ul class="site-foot__nav__item__menu">
						<li><a href="#">Terms</a></li>
						<li><a href="#">Privacy</a></li>
					</ul>
				</div>
			</div>
		
		</div>
		
		<p class="site-foot__copyright">&copy; GloboTek Ltd <?php echo date( 'Y' ); ?>. All rights reserved</p>
	
	</div>

</footer>

<?php wp_footer(); ?>

</body>
</html>