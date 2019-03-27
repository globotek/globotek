<!DOCTYPE html>
<!--[if IE 9]>
<html dir="ltr" lang="en-US" class="ie9 lt-ie10"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html dir="ltr" lang="en-US"><!--<![endif]-->
<head>
	
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	
	<title><?php wp_title(); ?></title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	
	<?php wp_head(); ?>

</head>


<body <?php body_class(); ?>>

<header class="site-head" role="banner" data-module="toggle,site-head">
	
	<div class="site-head__inner">
		
		<a href="<?php echo home_url(); ?>" class="site-head__logo">
			<img src="<?php echo get_template_directory_uri() . '/images/gtek.png'; ?>"/>
		</a>
		
		<nav id="site-head__nav" class="site-head__nav js-toggle__target">
			
			<ol class="site-head__nav__inner">
				
				<li class="site-head__nav__item">Item 1</li>
				<li class="site-head__nav__item">Item 2</li>
				<li class="site-head__nav__item">Item 3</li>
				<li class="site-head__nav__item">Item 4</li>
				<li class="site-head__nav__item">Item 5</li>
				<li class="site-head__nav__item">Item 6</li>
				
			</ol>
		
		</nav>
		
		<a href="#site-head__nav" class="site-head__hamburger js-toggle__trigger">
			<i class="fas fa-bars"></i>
		</a>
	
	</div>


</header>