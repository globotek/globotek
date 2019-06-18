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
                            
                            <div class="datepicker">

                                <div class="datepicker__buttons">
                                    <a class="datepicker__buttons__prev" href="#prev"><i class="fas fa-angle-left"></i></a>
                                    <a class="datepicker__buttons__next" href="#next"><i class="fas fa-angle-right"></i></a>
                                </div>

                                <table cellpadding="0" cellspacing="0" class="datepicker__calendar">
                                    <thead>
                                        <tr>
                                            <th class="datepicker__calendar__head"><span class="datepicker__calendar__day">Mon</span>17 Jun</th>
                                            <th class="datepicker__calendar__head"><span class="datepicker__calendar__day">Tue</span>18 Jun</th>
                                            <th class="datepicker__calendar__head"><span class="datepicker__calendar__day">Wed</span>19 Jun</th>
                                            <th class="datepicker__calendar__head"><span class="datepicker__calendar__day">Thu</span>20 Jun</th>
                                            <th class="datepicker__calendar__head"><span class="datepicker__calendar__day">Fri</span>21 Jun</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="datepicker__calendar__time">9:00 am</td>
                                            <td class="datepicker__calendar__time">9:00 am</td>
                                            <td class="datepicker__calendar__time">9:00 am</td>
                                            <td class="datepicker__calendar__time">9:00 am</td>
                                            <td class="datepicker__calendar__time">9:00 am</td>
                                        </tr>
                                        <tr>
                                            <td class="datepicker__calendar__time datepicker__calendar__unavailable">9:30 am</td>
                                            <td class="datepicker__calendar__time">9:30 am</td>
                                            <td class="datepicker__calendar__time">9:30 am</td>
                                            <td class="datepicker__calendar__time">9:30 am</td>
                                            <td class="datepicker__calendar__time">9:30 am</td>
                                        </tr>
                                        <tr>
                                            <td class="datepicker__calendar__time">10:00 am</td>
                                            <td class="datepicker__calendar__time">10:00 am</td>
                                            <td class="datepicker__calendar__time datepicker__calendar__time__selected">10:00 am</td>
                                            <td class="datepicker__calendar__time">10:00 am</td>
                                            <td class="datepicker__calendar__time">10:00 am</td>
                                        </tr>
                                        <tr>
                                            <td class="datepicker__calendar__time">10:30 am</td>
                                            <td class="datepicker__calendar__time">10:30 am</td>
                                            <td class="datepicker__calendar__time">10:30 am</td>
                                            <td class="datepicker__calendar__time datepicker__calendar__unavailable">10:30 am</td>
                                            <td class="datepicker__calendar__time">10:30 am</td>
                                        </tr>
                                        <tr>
                                            <td class="datepicker__calendar__time">11:00 am</td>
                                            <td class="datepicker__calendar__time">11:00 am</td>
                                            <td class="datepicker__calendar__time">11:00 am</td>
                                            <td class="datepicker__calendar__time datepicker__calendar__unavailable">11:00 am</td>
                                            <td class="datepicker__calendar__time">11:00 am</td>
                                        </tr>
                                        <tr>
                                            <td class="datepicker__calendar__time">11:30 am</td>
                                            <td class="datepicker__calendar__time">11:30 am</td>
                                            <td class="datepicker__calendar__time datepicker__calendar__unavailable">11:30 am</td>
                                            <td class="datepicker__calendar__time">11:30 am</td>
                                            <td class="datepicker__calendar__time">11:30 am</td>
                                        </tr>
                                    </tbody>
                                    <tbody class="datepicker__calendar__afternoon">
                                        <tr>
                                            <td class="datepicker__calendar__time">12:00 pm</td>
                                            <td class="datepicker__calendar__time">12:00 pm</td>
                                            <td class="datepicker__calendar__time">12:00 pm</td>
                                            <td class="datepicker__calendar__time">12:00 pm</td>
                                            <td class="datepicker__calendar__time">12:00 pm</td>
                                        </tr>
                                        <tr>
                                            <td class="datepicker__calendar__time">12:30 pm</td>
                                            <td class="datepicker__calendar__time">12:30 pm</td>
                                            <td class="datepicker__calendar__time">12:30 pm</td>
                                            <td class="datepicker__calendar__time">12:30 pm</td>
                                            <td class="datepicker__calendar__time">12:30 pm</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="datepicker__calendar__foot"><label for="afternoon">Afternoon<span class="datepicker__calendar__arrow"><i class="fas fa-angle-down"></i></span></label><input type="checkbox" name="afternoon" id="afternoon" data-toggle="toggle"></td>
                                            <td class="datepicker__calendar__foot"><label for="afternoon">Afternoon<span class="datepicker__calendar__arrow"><i class="fas fa-angle-down"></i></span></label><input type="checkbox" name="afternoon" id="afternoon" data-toggle="toggle"></td>
                                            <td class="datepicker__calendar__foot"><label for="afternoon">Afternoon<span class="datepicker__calendar__arrow"><i class="fas fa-angle-down"></i></span></label><input type="checkbox" name="afternoon" id="afternoon" data-toggle="toggle"></td>
                                            <td class="datepicker__calendar__foot"><label for="afternoon">Afternoon<span class="datepicker__calendar__arrow"><i class="fas fa-angle-down"></i></span></label><input type="checkbox" name="afternoon" id="afternoon" data-toggle="toggle"></td>
                                            <td class="datepicker__calendar__foot"><label for="afternoon">Afternoon<span class="datepicker__calendar__arrow"><i class="fas fa-angle-down"></i></span></label><input type="checkbox" name="afternoon" id="afternoon" data-toggle="toggle"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                
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
