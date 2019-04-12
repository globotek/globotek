<footer class="site-foot">
	
	<div class="site-foot__background">
		<img src="<?php echo get_template_directory_uri() . '/images/footer-bg.svg'; ?>"/>
	</div>
	
	<div class="site-foot__inner">
		
		<div class="site-foot__content">
			
			<div class="site-foot__contact">
				
				<a href="<?php echo home_url(); ?>" class="site-foot__contact__logo">
					<img src="<?php header_image(); ?>" alt="GloboTek Logo in White" />
				</a>
				
				<a href="tel:01905570735" class="site-foot__contact__phone">01905 570735</a>
				<p class="site-foot__contact__hours">Available 10am - 6pm UK Time</p>
			
			</div>
			
			<div class="site-foot__nav">
				<div class="site-foot__nav__item">
					<h3 class="title title__quaternary">Explore</h3>
					<ul class="site-foot__nav__item__menu">
						<li><a href="#" class="button__text button__text--white">Home</a></li>
						<li><a href="#" class="button__text button__text--white">Articles</a></li>
						<li><a href="#" class="button__text button__text--white">Contact Us</a></li>
						<li><a href="#" class="button__text button__text--white">Client Area</a></li>
					</ul>
				</div>
				<div class="site-foot__nav__item">
					<h3 class="title title__quaternary">Website Services</h3>
					<ul class="site-foot__nav__item__menu">
						<li><a href="#" class="button__text button__text--white">Our Services</a></li>
						<li><a href="#" class="button__text button__text--white">Sitecare Packages</a></li>
						<li><a href="#" class="button__text button__text--white">Portfolio</a></li>
					</ul>
				</div>
				<div class="site-foot__nav__item">
					<h3 class="title title__quaternary">Follow</h3>
					<ul class="site-foot__nav__item__menu">
						<li><a href="#" class="button__text button__text--white">LinkedIn</a></li>
						<li><a href="#" class="button__text button__text--white">Facebook</a></li>
						<li><a href="#" class="button__text button__text--white">Twitter</a></li>
					</ul>
				</div>
				<div class="site-foot__nav__item">
					<h3 class="title title__quaternary">Legal</h3>
					<ul class="site-foot__nav__item__menu">
						<li><a href="#" class="button__text button__text--white">Terms</a></li>
						<li><a href="#" class="button__text button__text--white">Privacy</a></li>
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