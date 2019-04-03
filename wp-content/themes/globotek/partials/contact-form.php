<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 09/02/2019
 * Time: 17:15
 */
?>

<div class="contact-form">
	
	<div class="contact-form__background">
		<img src="<?php echo get_template_directory_uri() . '/images/contact-bg.svg'; ?>"/>
	</div>
	
	<div class="contact-form__inner">
		
<<<<<<< HEAD
		<div class="cta__contact form" data-module="freshsales">
			
			<div class="cta__contact__content">
			
				<div class="cta__contact__content__title title title__secondary">Lorem ipsum dolor sit amet</div>
				<div class="cta__contact__content__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus. Donec maximus mauris vel interdum pharetra.</div>
            
			</div>

            <div class="cta__contact__prompt">
             
                <div class="cta__contact__prompt-inner">
                    Please enter your email address and name.
=======
        <div class="contact-form__form form">
			
			<div class="contact-form__content">
				<div class="contact-form__contact__content__title title title__secondary">Lorem ipsum dolor sit amet</div>
				<div class="contact-form__contact__content__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus. Donec maximus mauris vel interdum pharetra.</div>
            </div>

            <div class="contact-form__prompt">
                <div class="contact-form__prompt--inner">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
>>>>>>> d025d9ff205afd4b8cb2e0b5da8a1c9fee07270f
                </div>
            
            </div>
            
<<<<<<< HEAD
            <div class="cta__contact__left">
                
	            <div class="cta__contact__field">
                
                    <input type="text" class="form__field" name="contact-form-name" placeholder="Name (required)" value="" />
                
                </div>
                
                <div class="cta__contact__field">
                
                    <input type="text" class="form__field" name="contact-form-email" placeholder="Email (required)" />
               
                </div>

                <div class="form__range" data-module="range-slider">
                    
	                <div class="cta__contact__content">
                        Budget
                    </div>
	                
                    <input class="form__range-input js-range__trigger" name="contact-form-budget" type="range" min="1000" max="25000" step="1000" value="200" data-thumbwidth="20">
                    <output class="form__range-output">£1000</output>
	                
=======
            <div class="contact-form__left">
                <div class="contact-form__contact__field">
                    <input type="text" class="form__field" placeholder="Name" />
                </div>
                
                <div class="contact-form__field">
                    <input type="text" class="form__field" placeholder="Email" />
                </div>

                <div class="contact-form__range form__range" data-module="range-slider">
                    <div class="contact-form__content">
                        Budget
                    </div>
                    <input class="form__range--input js-range__trigger" type="range" min="1000" max="25000" step="100" value="200" data-thumbwidth="20">
                    <output class="form__range--output" name="range-value">£100</output>
>>>>>>> d025d9ff205afd4b8cb2e0b5da8a1c9fee07270f
                </div>
	            
			</div>
			
<<<<<<< HEAD
			<div class="cta__contact__right">
				
                <textarea class="form__textarea" name="contact-form-message" placeholder="Let us know how we can help"></textarea>
				
				<input type="hidden" name="contact-form-owner_id" value="Sales" />
				<input type="hidden" name="contact-form-referrer" value="<?php the_permalink(); ?>" />
				<input type="hidden" name="contact-form-source_id" value="<?php gtek_set_lead_source('Web Form'); ?>" />
				
				<a href="#" id="submit-contact-form" class="button button--white">Send</a>
				
			</div>
		
			
		</div>
=======
			<div class="contact-form__right">
                <textarea class="contact-form__textarea form__textarea" placeholder="Message"></textarea>

				<a href="#" class="button button--white">Send</a>
			</div>
		
        </div>
>>>>>>> d025d9ff205afd4b8cb2e0b5da8a1c9fee07270f
	
	</div>

</div>

<div id="form-output"></div>
