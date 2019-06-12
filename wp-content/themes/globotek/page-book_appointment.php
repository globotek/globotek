<?php
/**
 * Template Name: Book Appointment
 * Created by PhpStorm.
 * User: matthew
 * Date: 10/6/19
 * Time: 2:14 PM
 */

get_header(); ?>

<div class="chunk">
	
	<?php gtek_get_available_timeslots_for_date( '2019-06-14' ); ?>
	
	<?php var_dump( gtek_get_appointments_for_date( '2019-06-14' ) ); ?>
	<?php var_dump( $_POST ); ?>
	<div class="grid grid--halves wrapper" data-module="freshsales">
		
		<div class="grid__item">
			
			<p>Content</p>
		
		</div>
		
		<div class="grid__item">
			
			<form class="form" method="post">
				
				<div class="form__page">
					
					<p class="form__error">Please select a timeslot.</p>
					
					<div class="datepicker">
						
						<div class="js-datepicker"></div>
						<input type="text" name="dateslot" class="js-datepicker-selection"/>
					
					</div>
					
					<ol class="timeslots">
						
						<?php foreach ( $appointment_slots[ '30_minute_appointments' ] as $appointment ) { ?>
							
							<?php $appointment_start = strtotime( $appointment[ 'start_time' ] ); ?>
							
							<?php $timeslot_value = date( 'H:i:s', $appointment_start ) . ' - ' . date( 'H:i:s', strtotime( '+30 minutes', $appointment_start ) ); ?>
							<?php $timeslot_label = date( 'H:i', $appointment_start ) . ' - ' . date( 'H:i', strtotime( '+30 minutes', $appointment_start ) ); ?>
							
							<li class="timeslots__item">
								<label><input type="radio" name="timeslot" value="<?php echo $timeslot_label; ?>"/><?php echo $timeslot_label; ?>
								</label>
							</li>
						
						<?php } ?>
					
					</ol>
					<a href="#back" class="button button--neutral button--small">Go Back</a>
					<a href="#next" class="button button--small">Next</a>
				
				</div>
				
				<div class="form__page">
					
					<input type="text" name="first_name"/>
					<input type="text" name="last_name"/>
					<input type="text" name="company"/>
					<input type="text" name="company_position"/>
					<input type="email" name="email_address"/>
					<input type="tel" name="phone_number"/>
					
					Details
					<a href="#back" class="button button--neutral button--small">Go Back</a>
					<a href="#next" class="button button--small">Next</a>
				
				</div>
				
				<div class="form__page">
					
					Confirm
					
					<a href="#back" class="button button--neutral button--small">Go Back</a>
					<input type="submit" class="button button--small" name="confirm_booking" value="Book Consultation"/>
				
				</div>
			
			
			</form>
		
		</div>
	
	</div>

</div>

<?php get_footer(); ?>
