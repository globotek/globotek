<?php
/**
 * Template Name: Product Archive
 * Created by PhpStorm.
 * User: alex
 * Date: 18/02/2019
 * Time: 14:10
 */ ?>

<?php get_header(); ?>

<?php gtek_hero(); ?>

<div class="product-archive">

    <div class="wrapper">

        <div class="section-title breathe--treble">
            <h2 class="title__secondary">Lorem ipsum dolor sit amet</h2>
            <p class="section-title__intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus. Donec maximus mauris vel interdum pharetra.</p>
        </div>

    </div>
	
	<div class="product-archive__products">
		
		<div class="product-archive__product">

            <div class="product-archive__background product-archive__background-top">
                <img src="<?php echo get_template_directory_uri() . '/images/product-bg-top.svg'; ?>"/>
            </div>

            <div class="product-archive__inner">

                <div class="wrapper">

                    <div class="product-archive__image">



                    </div>

                    <div class="product-archive__text">



                    </div>

                </div>

            </div>

            <div class="product-archive__background product-archive__background-bottom">
                <img src="<?php echo get_template_directory_uri() . '/images/product-bg-bottom.svg'; ?>"/>
            </div>

        </div>
	
	
	</div>

</div>

<?php get_footer(); ?>
