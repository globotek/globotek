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
		
        <div class="contact-form__form form">
			
			<div class="contact-form__content">
				<div class="contact-form__contact__content__title title title__secondary">Lorem ipsum dolor sit amet</div>
				<div class="contact-form__contact__content__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus. Donec maximus mauris vel interdum pharetra.</div>
            </div>

            <div class="contact-form__errors">
                <div class="contact-form__errors--inner">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </div>
            </div>
            
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
                </div>
			</div>
			
			<div class="contact-form__right">
                <textarea class="contact-form__textarea form__textarea" placeholder="Message"></textarea>

				<a href="#" class="button button--white">Send</a>
            </div>
            
            <div class="contact-form__prompt" hidden>
                <div class="contact-form__prompt--inner">
                    <h4 class="title title__tertiary">Thank you for your message</h4>
                    <p>We will get back to you as soon as possible!</p>
                </div>
            </div>
		
        </div>
	
	</div>

</div>