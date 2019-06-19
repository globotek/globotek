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
                            
                            <h2 class="title title__secondary form-slider__page__heading">Please select a date</h2>
                            
                            <div class="datepicker" data-module="datepicker">

                                <div class="datepicker__buttons">
                                    <a class="datepicker__buttons__prev js-prevcal__trigger" href="#prev"><i class="fas fa-angle-left"></i></a>
                                    <a class="datepicker__buttons__next js-nextcal__trigger" href="#next"><i class="fas fa-angle-right"></i></a>
                                </div>

                                <div class="datepicker__calendar">
                                    <div class="datepicker__calendar__slider clear">
                                        <div class="datepicker__calendar__page activeCal">
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

                                        <div class="datepicker__calendar__page">
                                            <div class="datepicker__calendar__row">
                                                <div class="datepicker__calendar__head"><span class="datepicker__calendar__day">Mon</span>24 Jun</div>
                                                <div class="datepicker__calendar__head"><span class="datepicker__calendar__day">Tue</span>25 Jun</div>
                                                <div class="datepicker__calendar__head"><span class="datepicker__calendar__day">Wed</span>26 Jun</div>
                                                <div class="datepicker__calendar__head"><span class="datepicker__calendar__day">Thu</span>27 Jun</div>
                                                <div class="datepicker__calendar__head"><span class="datepicker__calendar__day">Fri</span>28 Jun</div>
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
                                                <div class="datepicker__calendar__time datepicker__calendar__unavailable">10:00 am</div>
                                                <div class="datepicker__calendar__time datepicker__calendar__unavailable">10:00 am</div>
                                                <div class="datepicker__calendar__time datepicker__calendar__unavailable">10:00 am</div>
                                                <div class="datepicker__calendar__time">10:00 am</div>
                                            </div>
                                            <div class="datepicker__calendar__row">
                                                <div class="datepicker__calendar__time">10:30 am</div>
                                                <div class="datepicker__calendar__time">10:30 am</div>
                                                <div class="datepicker__calendar__time">10:30 am</div>
                                                <div class="datepicker__calendar__time">10:30 am</div>
                                                <div class="datepicker__calendar__time">10:30 am</div>
                                            </div>
                                            <div class="datepicker__calendar__row">
                                                <div class="datepicker__calendar__time">11:00 am</div>
                                                <div class="datepicker__calendar__time datepicker__calendar__unavailable">11:00 am</div>
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
                                                    <div class="datepicker__calendar__time datepicker__calendar__unavailable">12:00 pm</div>
                                                    <div class="datepicker__calendar__time">12:00 pm</div>
                                                    <div class="datepicker__calendar__time">12:00 pm</div>
                                                </div>
                                                <div class="datepicker__calendar__row">
                                                    <div class="datepicker__calendar__time">12:30 pm</div>
                                                    <div class="datepicker__calendar__time">12:30 pm</div>
                                                    <div class="datepicker__calendar__time datepicker__calendar__unavailable">12:30 pm</div>
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
			
            </form>
		
		</div>
	
	</div>

</div>

<?php get_footer(); ?>
