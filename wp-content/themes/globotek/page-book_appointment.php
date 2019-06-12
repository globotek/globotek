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
			
			<form class="form" method="post" data-module="form-page">

                <div class="form-page">
				
                    <div class="form__page" data-id="1" style="display: block;">
                        
                        <h2 class="heading heading__secondary form__page__heading">Please select a date</h2>
                        
                        <div class="datepicker">
                            
                            <div class="js-datepicker"></div>
                            <input type="text" name="dateslot" class="js-datepicker-selection"/>
                        
                        </div>

                        <h2 class="heading heading__secondary form__page__heading">Please select a timeslot</h2>
                        
                        <ol class="timeslots">
                            
                            <!--<?php foreach ( $appointment_slots[ '30_minute_appointments' ] as $appointment ) { ?>
                                
                                <?php $appointment_start = strtotime( $appointment[ 'start_time' ] ); ?>
                                
                                <?php $timeslot_value = date( 'H:i:s', $appointment_start ) . ' - ' . date( 'H:i:s', strtotime( '+30 minutes', $appointment_start ) ); ?>
                                <?php $timeslot_label = date( 'H:i', $appointment_start ) . ' - ' . date( 'H:i', strtotime( '+30 minutes', $appointment_start ) ); ?>
                                
                                <li class="timeslots__item">
                                    <label>
                                        <input type="radio" name="timeslot" value="<?php echo $timeslot_label; ?>"/><?php echo $timeslot_label; ?>
                                    </label>
                                </li>
                            
                            <?php } ?>-->

                            <li class="timeslots__item">
                                <label class="timeslots__item__label">
                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                    <span class="timeslots__item__time">09:00</span>
                                    <span class="timeslots__item__checkmark"></span>
                                </label>
                            </li>
                            <li class="timeslots__item">
                                <label class="timeslots__item__label">
                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                    <span class="timeslots__item__time">10:00</span>
                                    <span class="timeslots__item__checkmark"></span>
                                </label>
                            </li>
                            <li class="timeslots__item">
                                <label class="timeslots__item__label">
                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                    <span class="timeslots__item__time">11:00</span>
                                    <span class="timeslots__item__checkmark"></span>
                                </label>
                            </li>
                            <li class="timeslots__item">
                                <label class="timeslots__item__label">
                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                    <span class="timeslots__item__time">12:00</span>
                                    <span class="timeslots__item__checkmark"></span>
                                </label>
                            </li>
                            <li class="timeslots__item">
                                <label class="timeslots__item__label">
                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                    <span class="timeslots__item__time">13:00</span>
                                    <span class="timeslots__item__checkmark"></span>
                                </label>
                            </li>
                            <li class="timeslots__item">
                                <label class="timeslots__item__label">
                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                    <span class="timeslots__item__time">14:00</span>
                                    <span class="timeslots__item__checkmark"></span>
                                </label>
                            </li>
                            <li class="timeslots__item">
                                <label class="timeslots__item__label">
                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                    <span class="timeslots__item__time">15:00</span>
                                    <span class="timeslots__item__checkmark"></span>
                                </label>
                            </li>
                            <li class="timeslots__item">
                                <label class="timeslots__item__label">
                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                    <span class="timeslots__item__time">16:00</span>
                                    <span class="timeslots__item__checkmark"></span>
                                </label>
                            </li>
                            <li class="timeslots__item">
                                <label class="timeslots__item__label">
                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                    <span class="timeslots__item__time">17:00</span>
                                    <span class="timeslots__item__checkmark"></span>
                                </label>
                            </li>
                            <li class="timeslots__item">
                                <label class="timeslots__item__label">
                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                    <span class="timeslots__item__time">18:00</span>
                                    <span class="timeslots__item__checkmark"></span>
                                </label>
                            </li>
                        
                        </ol>
                    
                    </div>
                    
                    <div class="form__page" data-id="2">

                        <h2 class="heading heading__secondary form__page__heading">Details</h2>
                        
                        <input type="text" class="form__field" name="first_name" placeholder="First Name" />
                        <input type="text" class="form__field" name="last_name" placeholder="Last Name" />
                        <input type="text" class="form__field" name="company" placeholder="Company" />
                        <input type="text" class="form__field" name="company_position" placeholder="Company Position" />
                        <input type="email" class="form__field" name="email_address" placeholder="Email Address" />
                        <input type="tel" class="form__field" name="phone_number" placeholder="Phone Number" />
                    
                    </div>
                    
                    <div class="form__page" data-id="3">
                        
                        <h2 class="heading heading__secondary form__page__heading">Confirm</h3>
                        
                        <input type="submit" class="button button--neutral button--small" name="confirm_booking" value="Book Consultation"/>
                    
                    </div>
                    
                    <div class="form__buttons">

                        <a href="#back" class="button button--neutral button--small form__buttons__button back">Go Back</a>
                        <a href="#next" class="button button--small form__buttons__button next">Next</a>
                        
                    </div>
			
			
			</form>
		
		</div>
	
	</div>

</div>

<?php get_footer(); ?>
