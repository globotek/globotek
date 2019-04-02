<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 09/02/2019
 * Time: 17:15
 */
?>

<div class="cta">
	
	<div class="cta__background">
		<img src="<?php echo get_template_directory_uri() . '/images/contact-bg.svg'; ?>"/>
	</div>
	
	<div class="cta__inner">
		
		<div class="cta__contact form">
			
			<div class="cta__contact__content">
				<div class="cta__contact__content__title title title__secondary">Lorem ipsum dolor sit amet</div>
				<div class="cta__contact__content__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus. Donec maximus mauris vel interdum pharetra.</div>
            </div>

            <div class="cta__contact__prompt">
                <div class="cta__contact__prompt-inner">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </div>
            </div>
            
            <div class="cta__contact__left">
                <div class="cta__contact__field">
                    <input type="text" class="form__field" placeholder="Name" />
                </div>
                
                <div class="cta__contact__field">
                    <input type="text" class="form__field" placeholder="Email" />
                </div>

                <div class="form__range" data-module="range-slider">
                    <div class="cta__contact__content">
                        Budget
                    </div>
                    <input class="form__range-input js-range__trigger" type="range" min="1000" max="25000" step="100" value="200" data-thumbwidth="20">
                    <output class="form__range-output" name="range-value">£100</output>
                </div>
			</div>
			
			<div class="cta__contact__right">
                <textarea class="form__textarea" placeholder="Message"></textarea>

				<a href="#" class="button button--white">Send</a>
			</div>
		
		</div>
	
	</div>

</div>