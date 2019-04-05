<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 09/02/2019
 * Time: 21:06
 */ ?>

	
<div class="portfolio-box">

    <div class="portfolio-box__inner">

        <div class="portfolio-box__inner__body">
            
            <div class="portfolio-box__inner__body__image">
                <img src="<?php echo get_template_directory_uri() . '/images/scraptastic-banner-min.png'; ?>"/>
            </div>
            
            <div class="portfolio-box__inner__body__content">
                
                <h3 class="title title__quaternary">Project Name</h3>
                
                <div class="portfolio-box__inner__body__tags tag-list">
                    
                    <?php $tags = array( 'Tag 1', 'Tag 2', 'Tag 3' ); ?>
                    
                    <?php $tag_output = implode( ' / ', $tags ); ?>
                    
                    <p><?php echo $tag_output; ?></p>
                
                </div>
                
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus. Donec maximus mauris vel interdum pharetra.</p>
            
            </div>

        </div>

    </div>

</div>
