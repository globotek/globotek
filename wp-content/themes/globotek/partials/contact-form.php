<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 09/02/2019
 * Time: 17:15
 */
?>

<div class="contact-form">
<<<<<<< HEAD

=======
	
>>>>>>> b5762540683435c6b86e38d9995f3da0cedaa41e
	<div class="contact-form__background contact-form__background-top">
		<img src="<?php echo get_template_directory_uri() . '/images/contact-bg-top.svg'; ?>"/>
	</div>
	
	<div class="contact-form__inner">
		
		<div class="contact-form__form form" data-module="freshsales">
			
			<div class="contact-form__content">
				<h3 class="contact-form__content__title title title__secondary">
					<?php _e( !empty($component) ? $component['title'] : 'Get In Touch'); ?>
				</h3>
				<p class="contact-form__content__text">
					<?php _e( !empty($component) ? $component['sub-title'] : 'Please submit your query &amp; a consultant will get back to you.'); ?>
				</p>
			</div>
			
			<div class="contact-form__errors">
				<p class="contact-form__errors--inner">Please make sure all required fields are completed.</p>
			
			</div>
			
			<div class="contact-form__left">
				
				<div class="contact-form__field">
					<input type="text" class="form__field" name="contact-form-name" placeholder="Name (required)" value=""/>
				</div>
				
				<div class="contact-form__field">
					<input type="text" class="form__field" name="contact-form-email" placeholder="Email (required)"/>
				</div>
				
				<div class="contact-form__field">
					<input type="tel" class="form__field" name="contact-form-phone" placeholder="Phone Number (required)"/>
				</div>
				
				<div class="contact-form__range form__range" data-module="range-slider">
					<p class="contact-form__content">
						Budget
					</p>
					<input class="form__range--input js-range__trigger" name="contact-form-budget" type="range" min="1000" max="25000" step="100" value="200" data-thumbwidth="20">
					<output class="form__range--output" name="range-value">£1000</output>
				</div>
			
			</div>
			
			<div class="contact-form__right">
				
				<div class="contact-form__field">
					<input type="text" class="form__field" name="contact-form-company" placeholder="Company"/>
				</div>
				
				<textarea class="contact-form__textarea form__textarea" name="contact-form-message" placeholder="Let us know how we can help"></textarea>
				
				<input type="hidden" name="contact-form-owner_id" value="Sales"/>
				<input type="hidden" name="contact-form-referrer" value="<?php the_permalink(); ?>"/>
				<input type="hidden" name="contact-form-source_id" value="<?php gtek_set_lead_source('Web Form'); ?>"/>
				
				<a href="#" id="submit-contact-form" class="button button--white">Send</a>
			</div>
			
			<div class="contact-form__prompt">
				<div class="contact-form__prompt--inner">
					<p class="title title__tertiary">Thanks for your message</p>
					<p>A consultant will contact you shortly!</p>
				</div>
			</div>
		
		</div>
	
	</div>

    <div class="contact-form__background contact-form__background-bottom">
		<img src="<?php echo get_template_directory_uri() . '/images/contact-bg-bottom.svg'; ?>"/>
	</div>

</div>