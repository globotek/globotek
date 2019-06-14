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
	
	<div class="grid grid--one-third-two-thirds wrapper" data-module="freshsales">
		
		<div class="grid__item">
			
			<p>Content</p>
		
		</div>
		
		<div class="grid__item">
			
			<form class="form js-page__target" method="post" data-module="form-page">

                <div class="form-slider">

                    <div class="form-slider__slider clear">
				
                        <div class="form-slider__page active" data-id="1">
                            
                            <h2 class="heading heading__secondary form-slider__page__heading">Please select a date</h2>
                            
                            <div class="datepicker">
                                
                                <div class="js-datepicker"></div>
                                <input type="text" name="dateslot" class="js-datepicker-selection"/>
                            
                            </div>

                        </div>

                        <div class="form-slider__page" data-id="2">

                        <h2 class="heading heading__secondary form-slider__page__heading">Please select a timeslot</h2>
                            
                            <div class="tabs clear">
                                <input class="tabs__input" type="radio" id="tab1" name="tab" checked>
                                <label class="tabs__label button button--small" for="tab1">Morning</label>
                                <input class="tabs__input" type="radio" id="tab2" name="tab">
                                <label class="tabs__label button button--small" for="tab2">Afternoon</label>
                                
                                <div class="tabs__container clear">
                                    <div class="tabs__container__inner">
                                    <div class="tabs__content" id="c1">

                                        <ol class="timeslots">
                                    
                                            <li class="timeslots__item">
                                                <label class="timeslots__item__label">
                                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                                    <span class="timeslots__item__time">09:00 - 09:30</span>
                                                    <span class="timeslots__item__checkmark"></span>
                                                </label>
                                            </li>
                                            <li class="timeslots__item">
                                                <label class="timeslots__item__label">
                                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                                    <span class="timeslots__item__time">10:00 - 10:30</span>
                                                    <span class="timeslots__item__checkmark"></span>
                                                </label>
                                            </li>
                                            <li class="timeslots__item">
                                                <label class="timeslots__item__label">
                                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                                    <span class="timeslots__item__time">11:00 - 11:30</span>
                                                    <span class="timeslots__item__checkmark"></span>
                                                </label>
                                            </li>

                                        </ol>

                                    </div>

                                    <div class="tabs__content" id="c2">

                                        <ol class="timeslots">

                                            <li class="timeslots__item">
                                                <label class="timeslots__item__label">
                                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                                    <span class="timeslots__item__time">12:00 - 12:30</span>
                                                    <span class="timeslots__item__checkmark"></span>
                                                </label>
                                            </li>
                                            <li class="timeslots__item">
                                                <label class="timeslots__item__label">
                                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                                    <span class="timeslots__item__time">13:00 - 13:30</span>
                                                    <span class="timeslots__item__checkmark"></span>
                                                </label>
                                            </li>
                                            <li class="timeslots__item">
                                                <label class="timeslots__item__label">
                                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                                    <span class="timeslots__item__time">14:00 - 14:30</span>
                                                    <span class="timeslots__item__checkmark"></span>
                                                </label>
                                            </li>
                                            <li class="timeslots__item">
                                                <label class="timeslots__item__label">
                                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                                    <span class="timeslots__item__time">15:00 - 15:30</span>
                                                    <span class="timeslots__item__checkmark"></span>
                                                </label>
                                            </li>
                                            <li class="timeslots__item">
                                                <label class="timeslots__item__label">
                                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                                    <span class="timeslots__item__time">16:00 - 16:30</span>
                                                    <span class="timeslots__item__checkmark"></span>
                                                </label>
                                            </li>
                                            <li class="timeslots__item">
                                                <label class="timeslots__item__label">
                                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                                    <span class="timeslots__item__time">17:00 - 17:30</span>
                                                    <span class="timeslots__item__checkmark"></span>
                                                </label>
                                            </li>
                                            <li class="timeslots__item">
                                                <label class="timeslots__item__label">
                                                    <input type="radio" class="timeslots__item__input" name="timeslot" value="09:00"/>
                                                    <span class="timeslots__item__time">18:00 - 18:30</span>
                                                    <span class="timeslots__item__checkmark"></span>
                                                </label>
                                            </li>

                                        </ol>

                                    </div>
                                    </div>
                                </div>

                                <!--<ol class="timeslots">
                                
                                							--><?php //foreach ( $appointment_slots[ '30_minute_appointments' ] as $appointment ) { ?>
<!--								-->
<!--								--><?php //$appointment_start = strtotime( $appointment[ 'start_time' ] ); ?>
<!--								-->
<!--								--><?php //$timeslot_value = date( 'H:i:s', $appointment_start ) . ' - ' . date( 'H:i:s', strtotime( '+30 minutes', $appointment_start ) ); ?>
<!--								--><?php //$timeslot_label = date( 'H:i', $appointment_start ) . ' - ' . date( 'H:i', strtotime( '+30 minutes', $appointment_start ) ); ?>
<!--								-->
<!--								<li class="timeslots__item">-->
<!--									<label>-->
<!--										<input type="radio" name="timeslot" value="--><?php //echo $timeslot_label; ?><!--"/>--><?php //echo $timeslot_label; ?>
<!--									</label>-->
<!--								</li>-->
<!--							-->
<!--							--><?php //} ?>

                            <!--</ol>-->

                            </div>

                        </div>
                        
                        <div class="form-slider__page" data-id="3">

                            <h2 class="heading heading__secondary form-slider__page__heading">Details</h2>
                            
                            <input type="text" class="form-slider__page__field form__field" name="first_name" placeholder="First Name" />
                            <input type="text" class="form-slider__page__field form__field" name="last_name" placeholder="Last Name" />
                            <input type="text" class="form-slider__page__field form__field" name="company" placeholder="Company" />
                            <input type="text" class="form-slider__page__field form__field" name="company_position" placeholder="Company Position" />
                            <input type="email" class="form-slider__page__field form__field" name="email_address" placeholder="Email Address" />
                            <input type="tel" class="form-slider__page__field form__field" name="phone_number" placeholder="Phone Number" />
                            
                        </div>
                        
                        <div class="form-slider__page" data-id="4">
                            
                            <p class="heading heading__secondary form-slider__page__heading">Confirm</p>
                            
                            <input type="submit" class="button button--primary" name="confirm_booking" value="Book Consultation"/>
                            
                        </div>

                    </div>

                    <div class="form-slider__buttons">

                    <a href="#back" class="button button--neutral button--small form-slider__buttons__button js-prev__trigger back">Go Back</a>
                    <a href="#next" class="button button--small form-slider__buttons__button js-next__trigger next">Next</a>

                </div>

                </div>

                
			
            </form>
		
		</div>
	
	</div>

</div>

<?php get_footer(); ?>
