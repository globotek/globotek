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
		
        <div class="contact-form__form form" data-module="freshsales">
			
			<div class="contact-form__content">
				<div class="contact-form__contact__content__title title title__secondary">Lorem ipsum dolor sit amet</div>
				<div class="contact-form__contact__content__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus. Donec maximus mauris vel interdum pharetra.</div>
            </div>

            <div class="contact-form__errors" hidden>
                <div class="contact-form__errors--inner">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </div>
            
            </div>
            
            <div class="contact-form__left">
                <div class="contact-form__contact__field">
                    <input type="text" class="form__field" name="contact-form-name" placeholder="Name (required)" value="" />
                </div>
                
                <div class="contact-form__field">
                    <input type="text" class="form__field" name="contact-form-email" placeholder="Email (required)" />
                </div>

                <div class="contact-form__range form__range" data-module="range-slider">
                    <div class="contact-form__content">
                        Budget
                    </div>
                    <input class="form__range--input js-range__trigger" name="contact-form-budget" type="range" min="1000" max="25000" step="100" value="200" data-thumbwidth="20">
                    <output class="form__range--output" name="range-value">£1000</output>
                </div>
	            
			</div>
			
			<div class="contact-form__right">
                <textarea class="contact-form__textarea form__textarea" name="contact-form-message" placeholder="Let us know how we can help"></textarea>

                <input type="hidden" name="contact-form-owner_id" value="Sales" />
				<input type="hidden" name="contact-form-referrer" value="<?php the_permalink(); ?>" />
				<input type="hidden" name="contact-form-source_id" value="<?php gtek_set_lead_source('Web Form'); ?>" />

				<a href="#" id="submit-contact-form" class="button button--white">Send</a>
            </div>
            
            <div class="contact-form__prompt" hidden>
                <div class="contact-form__prompt--inner">
                    <p class="title title__tertiary">Thank you for your message</p>
                    <p>We will get back to you as soon as possible!</p>
                </div>
            </div>
		
        </div>
	
	</div>

</div>

<div id="form-output"></div>
