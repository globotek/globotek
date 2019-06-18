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
	
	<?php $timeslots = gtek_get_available_timeslots_for_date( '2019-06-04' ); ?>
	
	<?php //var_dump( gtek_get_appointments_for_date( '2019-06-14' ) ); ?>
	<?php //var_dump( $_POST ); ?>
	
	<div class="grid grid--halves wrapper" data-module="freshsales">
		
		<div class="grid__item">
			
			<p>Content</p>
		
		</div>
		
		<div class="grid__item">
			
			<form class="form js-page__target" method="post" data-module="form-page">
				
<<<<<<< HEAD
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
												
												<?php foreach ( $appointment_slots[ '30_minute_appointments' ] as $appointment ) { ?>
													
													<?php $appointment_start = strtotime( $appointment[ 'start_time' ] ); ?>
													
													<?php $timeslot_value = date( 'H:i:s', $appointment_start ) . ' - ' . date( 'H:i:s', strtotime( '+30 minutes', $appointment_start ) ); ?>
													<?php $timeslot_label = date( 'H:i', $appointment_start ) . ' - ' . date( 'H:i', strtotime( '+30 minutes', $appointment_start ) ); ?>
													
													<li class="timeslots__item">
														<label>
															<input type="radio" name="timeslot" value="<?php echo $timeslot_label; ?>"/><?php echo $timeslot_label; ?>
														</label>
													</li>
												
												<?php } ?>
												
												
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
							
							</div>
						
						</div>
						
						<div class="form-slider__page" data-id="3">
							
							<h2 class="heading heading__secondary form-slider__page__heading">Details</h2>
							
							<input type="text" class="form-slider__page__field form__field" name="first_name" placeholder="First Name"/>
							<input type="text" class="form-slider__page__field form__field" name="last_name" placeholder="Last Name"/>
							<input type="text" class="form-slider__page__field form__field" name="company" placeholder="Company"/>
							<input type="text" class="form-slider__page__field form__field" name="company_position" placeholder="Company Position"/>
							<input type="email" class="form-slider__page__field form__field" name="email_address" placeholder="Email Address"/>
							<input type="tel" class="form-slider__page__field form__field" name="phone_number" placeholder="Phone Number"/>
						
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
			
=======
                        <div class="form-slider__page active" data-id="1">
                            
                            <h2 class="title title__secondary form-slider__page__heading">Please select a date</h2>
                            
                            <div class="datepicker" data-module="datepicker">

                                <div class="datepicker__buttons">
                                    <a class="datepicker__buttons__prev" href="#prev"><i class="fas fa-angle-left"></i></a>
                                    <a class="datepicker__buttons__next" href="#next"><i class="fas fa-angle-right"></i></a>
                                </div>

                                <div class="datepicker__calendar">
                                    <div class="datepicker__calendar__row">
                                        <div class="datepicker__calendar__head"><span class="datepicker__calendar__day">Mon</span>17 Jun</div>
                                        <div class="datepicker__calendar__head"><span class="datepicker__calendar__day">Tue</span>18 Jun</div>
                                        <div class="datepicker__calendar__head"><span class="datepicker__calendar__day">Wed</span>19 Jun</div>
                                        <div class="datepicker__calendar__head"><span class="datepicker__calendar__day">Thu</span>20 Jun</div>
                                        <div class="datepicker__calendar__head"><span class="datepicker__calendar__day">Fri</span>21 Jun</div>
                                    </div>
                                   
                                    <div class="datepicker__calendar__row">
                                        <div class="datepicker__calendar__time">9:00 am</div>
                                        <div class="datepicker__calendar__time">9:00 am</div>
                                        <div class="datepicker__calendar__time">9:00 am</div>
                                        <div class="datepicker__calendar__time">9:00 am</div>
                                        <div class="datepicker__calendar__time">9:00 am</div>
                                    </div>
                                    <div class="datepicker__calendar__row">
                                        <div class="datepicker__calendar__time datepicker__calendar__unavailable">9:30 am</div>
                                        <div class="datepicker__calendar__time">9:30 am</div>
                                        <div class="datepicker__calendar__time">9:30 am</div>
                                        <div class="datepicker__calendar__time">9:30 am</div>
                                        <div class="datepicker__calendar__time">9:30 am</div>
                                    </div>
                                    <div class="datepicker__calendar__row">
                                        <div class="datepicker__calendar__time">10:00 am</div>
                                        <div class="datepicker__calendar__time">10:00 am</div>
                                        <div class="datepicker__calendar__time datepicker__calendar__time__selected">10:00 am</div>
                                        <div class="datepicker__calendar__time">10:00 am</div>
                                        <div class="datepicker__calendar__time">10:00 am</div>
                                    </div>
                                    <div class="datepicker__calendar__row">
                                        <div class="datepicker__calendar__time">10:30 am</div>
                                        <div class="datepicker__calendar__time">10:30 am</div>
                                        <div class="datepicker__calendar__time">10:30 am</div>
                                        <div class="datepicker__calendar__time datepicker__calendar__unavailable">10:30 am</div>
                                        <div class="datepicker__calendar__time">10:30 am</div>
                                    </div>
                                    <div class="datepicker__calendar__row">
                                        <div class="datepicker__calendar__time">11:00 am</div>
                                        <div class="datepicker__calendar__time">11:00 am</div>
                                        <div class="datepicker__calendar__time">11:00 am</div>
                                        <div class="datepicker__calendar__time datepicker__calendar__unavailable">11:00 am</div>
                                        <div class="datepicker__calendar__time">11:00 am</div>
                                    </div>
                                    <div class="datepicker__calendar__row">
                                        <div class="datepicker__calendar__time">11:30 am</div>
                                        <div class="datepicker__calendar__time">11:30 am</div>
                                        <div class="datepicker__calendar__time datepicker__calendar__unavailable">11:30 am</div>
                                        <div class="datepicker__calendar__time">11:30 am</div>
                                        <div class="datepicker__calendar__time">11:30 am</div>
                                    </div>
                                   
                                    <div class="datepicker__calendar__afternoon">
                                        <div class="datepicker__calendar__row">
                                            <div class="datepicker__calendar__time">12:00 pm</div>
                                            <div class="datepicker__calendar__time">12:00 pm</div>
                                            <div class="datepicker__calendar__time">12:00 pm</div>
                                            <div class="datepicker__calendar__time">12:00 pm</div>
                                            <div class="datepicker__calendar__time">12:00 pm</div>
                                        </div>
                                        <div class="datepicker__calendar__row">
                                            <div class="datepicker__calendar__time">12:30 pm</div>
                                            <div class="datepicker__calendar__time">12:30 pm</div>
                                            <div class="datepicker__calendar__time">12:30 pm</div>
                                            <div class="datepicker__calendar__time">12:30 pm</div>
                                            <div class="datepicker__calendar__time">12:30 pm</div>
                                        </div>
                                    </div>
                        
                                    <div class="datepicker__calendar__row">
                                        <div class="datepicker__calendar__foot"><label for="afternoon">Afternoon<span class="datepicker__calendar__arrow"><i class="fas fa-angle-down"></i></span></label><input type="checkbox" name="afternoon" id="afternoon" data-toggle="toggle"></div>
                                        <div class="datepicker__calendar__foot"><label for="afternoon">Afternoon<span class="datepicker__calendar__arrow"><i class="fas fa-angle-down"></i></span></label><input type="checkbox" name="afternoon" id="afternoon" data-toggle="toggle"></div>
                                        <div class="datepicker__calendar__foot"><label for="afternoon">Afternoon<span class="datepicker__calendar__arrow"><i class="fas fa-angle-down"></i></span></label><input type="checkbox" name="afternoon" id="afternoon" data-toggle="toggle"></div>
                                        <div class="datepicker__calendar__foot"><label for="afternoon">Afternoon<span class="datepicker__calendar__arrow"><i class="fas fa-angle-down"></i></span></label><input type="checkbox" name="afternoon" id="afternoon" data-toggle="toggle"></div>
                                        <div class="datepicker__calendar__foot"><label for="afternoon">Afternoon<span class="datepicker__calendar__arrow"><i class="fas fa-angle-down"></i></span></label><input type="checkbox" name="afternoon" id="afternoon" data-toggle="toggle"></div>
                                    </div>
                                
                                </div>

                                
                                
                                <!--<div class="js-datepicker"></div>
                                <input type="text" name="dateslot" class="js-datepicker-selection"/>-->
                            
                            </div>

                        </div>

                        <div class="form-slider__page" data-id="2">

                            <h2 class="title title__secondary form-slider__page__heading">Enter your details</h2>
                            
                            <div class="form__select">
                                <select class="form-slider__page__field form__select__field" placeholder="Reason for Visit">
                                    <option selected>Reason for Visit</option>
                                    <option>Reason 1</option>
                                    <option>Reason 2</option>
                                    <option>Reason 3</option>
                                </select>
                            </div>
                            <input type="text" class="form-slider__page__field form__field" name="name" placeholder="Name" />
                            <input type="text" class="form-slider__page__field form__field" name="company" placeholder="Company" />
                            <input type="text" class="form-slider__page__field form__field" name="company_position" placeholder="Company Position" />
                            <input type="email" class="form-slider__page__field form__field" name="company" placeholder="Email Address" />
                            <input type="tel" class="form-slider__page__field form__field" name="company_position" placeholder="Phone Number" />

                        </div>
                        
                        <div class="form-slider__page" data-id="3">

                            <h2 class="title title__secondary form-slider__page__heading">Thank You</h2>
                            
                            <div class="form-slider__add">

                                <p>A confirmation email has been sent to <strong>alex@globotek.net</strong>.</p>

                                <p>Add your appointment to your calendar!</p>

                                <p class="form-slider__add__icon"><i class="fas fa-calendar-plus"></i></p>

                                <a href="#back" class="button button--primary button--small">Add to Calendar</a>

                            </div>
                            
                        </div>

                    </div>

                    <div class="form-slider__buttons">

                        <a href="#back" class="button button--neutral button--small form-slider__buttons__button js-prev__trigger back">Go Back</a>
                        <a href="#next" class="button button--small form-slider__buttons__button js-next__trigger next">Next</a>
                        <input type="submit" class="button button--small form-slider__buttons__button book" name="confirm_booking" value="Book Consultation"/>

                    </div>

                </div>
>>>>>>> 7271a4dd8b08d23a1466609ddeb388470c13ffe2
			
			</form>
		
		</div>
	
	</div>

</div>

<?php get_footer(); ?>
