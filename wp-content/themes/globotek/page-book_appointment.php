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
	
	<div class="grid grid__full grid--halves wrapper" data-module="freshsales">
		
		<div class="grid__item">
			
			<p>Content</p>
			
			<?php
			$booked_appointments = gtek_get_freshsales_appointments();
			
			$appointment_slots        = get_fields( 'option' );
			$appointment_availability = $appointment_slots[ 'appointment_availability' ];
			var_dump( $appointment_slots[ 'monday_appointment_slots' ] );
			
			
			//$timeslots = gtek_get_available_timeslots_for_date( '2019-06-14' );
			
			//var_dump( $timeslots );
			$dates = array();
			
			for ( $w = 0; $w <= 7; $w ++ ) {
				
				$next_week   = strtotime( "+$w week" );
				$next_monday = strtotime( date( 'Y-m-d', $next_week ) . ' last monday' );
				
				for ( $i = 0; $i <= 4; $i ++ ) {
					
					$dates[ $w ][] = explode( '-', date( 'Y-m-M-d-D-l', strtotime( date( 'Y-m-d', $next_monday ) . ' +' . $i . ' days' ) ) );
					
				}
				
			} ?>
		
		
		</div>
		
		<div class="grid__item">
			
			<form class="form js-page__target" method="post" data-module="form-page">
				
				<div class="form-slider">
					
					<div class="form-slider__slider clear">
						
						<div class="form-slider__page active" data-id="1">
							
							<h2 class="title title__secondary form-slider__page__heading">Select a date</h2>
							
							<div class="datepicker" data-module="datepicker">
								
								<div class="datepicker__buttons">
									<a class="datepicker__buttons__prev js-prevcal__trigger is-hidden" href="#prev"><i class="fas fa-angle-left"></i></a>
									<a class="datepicker__buttons__next js-nextcal__trigger" href="#next"><i class="fas fa-angle-right"></i></a>
								</div>
								
								<div class="datepicker__calendar">
									<div class="datepicker__calendar__slider">
										
										<?php foreach ( $dates as $week_number => $weekdays ) { ?>
											
											<div class="datepicker__calendar__page <?php _e( $week_number == 0 ? 'activeCal' : '' ); ?>">
												
												<?php foreach ( $weekdays as $day ) { ?>
													
													
													<div class="datepicker__calendar__col">
														
														<div class="datepicker__calendar__head">
															<span class="datepicker__calendar__day"><?php echo $day[ 4 ]; ?></span><?php echo $day[ 3 ] . ' ' . $day[ 2 ]; ?>
														</div>
														
														<div class="datepicker__calendar__slot-slider">
															
															<div class="datepicker__calendar__slots">
																
																<?php if ( ! empty( $appointment_slots[ strtolower( $day[ 5 ] ) . '_appointment_slots' ][ 'morning' ] ) ) { ?>
																	
																	<?php foreach ( $appointment_slots[ strtolower( $day[ 5 ] ) . '_appointment_slots' ][ 'morning' ] as $time ) { ?>
																		
																		<div class="datepicker__calendar__time <?php _e( ! $time[ 'available' ] ? 'datepicker__calendar__time--unavailable' : '' ); ?>">
																			
																			<?php if ( ! empty( $time[ 'start_time' ] ) ) { ?>
																				
																				<?php echo date( 'h:i a', $time[ 'start_time' ] ); ?>
																			
																			<?php } else { ?>
																				
																				<?php echo 'No Time Set'; ?>
																			
																			<?php } ?>
																		
																		</div>
																	
																	<?php } ?>
																
																<?php } ?>
																
																<div class="datepicker__calendar__foot datepicker__calendar__afternoon">Afternoon
																	<span class="datepicker__calendar__arrow"><i class="fas fa-angle-down"></i></span>
																</div>
																
																<?php if ( ! empty( $appointment_slots[ strtolower( $day[ 5 ] ) . '_appointment_slots' ][ 'afternoon' ] ) ) { ?>
																	
																	<?php foreach ( $appointment_slots[ strtolower( $day[ 5 ] ) . '_appointment_slots' ][ 'afternoon' ] as $time ) { ?>
																		
																		<div class="datepicker__calendar__time <?php _e( ! $time[ 'available' ] ? 'datepicker__calendar__time--unavailable' : '' ); ?>">
																			
																			<?php if ( ! empty( $time[ 'start_time' ] ) ) { ?>
																				
																				<?php echo date( 'h:i a', $time[ 'start_time' ] ); ?>
																			
																			<?php } else { ?>
																				
																				<?php echo 'No Time Set'; ?>
																				
																			<?php } ?>
																		
																		</div>
																	
																	<?php } ?>
																
																<?php } ?>
																
																
																<div class="datepicker__calendar__foot datepicker__calendar__morning">Morning
																	<span class="datepicker__calendar__arrow"><i class="fas fa-angle-up"></i></span>
																</div>
																
																
																<!--																<div class="datepicker__calendar__time">9:30 am</div>-->
																<!--																<div class="datepicker__calendar__time">10:00 am</div>-->
																<!--																<div class="datepicker__calendar__time datepicker__calendar__time--unavailable">10:30 am</div>-->
																<!--																<div class="datepicker__calendar__time">11:00 am</div>-->
																<!--																<div class="datepicker__calendar__time">11:30 am</div>-->
																<!--																-->
																<!--																<div class="datepicker__calendar__time">12:00 pm</div>-->
																<!--																<div class="datepicker__calendar__time">12:30 pm</div>-->
																<!--																<div class="datepicker__calendar__time">13:00 pm</div>-->
																<!--																<div class="datepicker__calendar__time datepicker__calendar__time--unavailable">13:30 pm</div>-->
																<!--																<div class="datepicker__calendar__time datepicker__calendar__time--unavailable">14:00 pm</div>-->
																<!--																<div class="datepicker__calendar__time">14:30 pm</div>-->
																<!--																-->
															</div>
														
														</div>
													
													</div>
												
												<?php } ?>
											
											</div>
										
										<?php } ?>
									
									</div>
								
								</div>
								
								
								<!--<div class="js-datepicker"></div>
								<input type="text" name="dateslot" class="js-datepicker-selection"/>-->
							
							</div>
						
						</div>
						
						<div class="form-slider__page" data-id="2">
							
							<h2 class="title title__secondary form-slider__page__heading">Enter your details</h2>
							
							<!--                            <div class="form__select">-->
							<!--                                <select class="form-slider__page__field form__select__field" placeholder="Reason for Visit">-->
							<!--                                    <option selected>Reason for Visit</option>-->
							<!--                                    <option>Reason 1</option>-->
							<!--                                    <option>Reason 2</option>-->
							<!--                                    <option>Reason 3</option>-->
							<!--                                </select>-->
							<!--                            </div>-->
							<input type="text" class="form-slider__page__field form__field" name="name" placeholder="Name"/>
							<input type="text" class="form-slider__page__field form__field" name="company" placeholder="Company"/>
							<!--                            <input type="text" class="form-slider__page__field form__field" name="company_position" placeholder="Company Position" />-->
							<input type="email" class="form-slider__page__field form__field" name="company" placeholder="Email Address"/>
							<input type="tel" class="form-slider__page__field form__field" name="company_position" placeholder="Phone Number"/>
						
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
