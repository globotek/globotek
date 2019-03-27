<?php
do_action( 'chumly_before_content' )
?>

<!-- MESSAGE CENTRE LAYOUT STARTS -->
<div class="message-centre">
	
	<!--	<header class="headline">
		<h2 class="headline__heading"><?php /*the_title(); */ ?></h2>
	</header>
-->
	<div class="message-centre__feed">
		
		<div class="message-centre__feed__sidebar">
			
			<div class="search">
				
				<form class="search__form">
					<input type="text" id="find_recipient" class="search__form__input" placeholder="Find connections" autocomplete="off">
				</form>
				
				<div class="search__results">
					<!-- RESULTS FROM A RECIPIENT SEARCH INJECTED HERE -->
				</div>
				
				<div class="search__mask"></div>
			
			</div>
			
			<div class="message-centre__feed__recipients">
				<ol class="user-list">
					
					<?php $conversations = chumly_get_user_conversations(); ?>
					
					<?php $i = 0; ?>
					<?php foreach ( $conversations as $thread ) { ?>
						
						<?php
						//var_dump($thread->unread_messages);
						$notification = ( $thread->unread_messages == TRUE && $i > 0 && $thread->unread_messages != get_current_user_id() ? 'is-notification' : '' );
						$active       = '';
						
						if ( $i == 0 ) {
							$active         = 'is-active';
							$initial_thread = $thread;
						}
						//$timestamp = date( 'd/m/y \a\t H:i', $thread->thread_timestamp );
						?>
						
						<li class="user-list__item <?php echo $notification . ' ' . $active; ?>" receiver_id="<?php echo chumly_determine_user_id( $thread ); ?>" thread_id="<?php echo $thread->ID; ?>">
							<!-- IF UNREAD MESSAGES ADD (is-notification) CLASS -->
							<!-- REPLACE  with is-active if this is the current user we're chatting to -->
							<a href="#" class="user-list__item__inner user-list__item__inner--media-icon" role="button">
								
								<div class="user-list__item__media user-list__item__media--small">
									<figure class="avatar">
										<?php echo chumly_avatar( chumly_determine_user_id( $thread ) ); ?>
									</figure>
								</div>
								
								<div class="user-list__item__text">
									<span class="user-list__item__text--primary"><?php echo get_userdata( chumly_determine_user_id( $thread ) )->display_name; ?></span>
									<!--									<span class="user-list__item__text--secondary">--><?php //echo $timestamp; ?><!--</span>-->
								</div>
								
								<div class="user-list__item__icon">
									
									
									<?php if ( $thread->unread_messages == FALSE || $i == 0 || $thread->unread_messages == get_current_user_id() ) { ?>
										
										<!-- IF UNREAD MESSAGES SET ICON TO BE (right-arrow) -->
										<?php $state_read = 'is-visible'; ?>
										<?php $state_unread = 'is-hidden'; ?>
									
									<?php } else { ?>
										
										<!-- IF UNREAD MESSAGES SET ICON TO BE (circle) -->
										<?php $state_read = 'is-hidden'; ?>
										<?php $state_unread = 'is-visible'; ?>
									
									<?php } ?>
									
									<?php chumly_icon( 'angle-right', 'read_state ' . $state_read ); ?>
									<?php chumly_icon( 'circle', 'unread_state ' . $state_unread ); ?>
								
								</div>
							
							</a>
						</li>
						
						<?php $i ++; ?>
					
					<?php } ?>
				
				</ol>
			</div>
		
		</div>
		
		<div class="message-centre__feed__content">
			<div class="message-centre__feed__content__inner">
				
				<?php
				foreach ( chumly_load_conversation( $initial_thread->ID ) as $message ) {
					
					echo $message;
					
				} ?>
			
			</div>
		</div>
	
	</div>
	
	
	<div class="message-centre__editor">
		
		<div class="message-centre__editor__padding" aria-hidden="true"></div>
		<div class="message-centre__editor__window">
			
			<form class="messenger">
				
				<input type="hidden" id="recipient_id" name="recipient_id" value="<?php echo chumly_determine_user_id( $initial_thread ); ?>">
				<input type="hidden" id="thread_id" name="thread_id" value="<?php echo $initial_thread->ID; ?>">
				<textarea id="message_editor" class="editor__input" placeholder="Add your message"></textarea>
				
				<div class="editor__buttons">
					<div class="editor__icon-buttons">
						<div class="editor__icon-buttons__inner">
							
							<!--<label class="editor__icon-button" for="editor_image">
								<div class="editor__icon-button__inner">
									<div class="editor__icon-button__icon">
										<svg class="icon" aria-hidden="true">
											<use xmlns:xlink="http://www.w3.org/1999/xlink"
											     xlink:href="<?php /*echo plugin_dir_url( __DIR__ ) . '../images/icons/svg-symbols.svg#image' */ ?>"></use>
										</svg>
									</div>
									<div class="editor__icon-button__text">Add Image</div>
									<input class="editor__icon-button__input" id="editor_image" type="file"
									       accept="jpg,png"/>
								</div>
							</label>
							
							<label class="editor__icon-button" for="editor_other">
								<div class="editor__icon-button__inner">
									<div class="editor__icon-button__icon">
										<svg class="icon" aria-hidden="true">
											<use xmlns:xlink="http://www.w3.org/1999/xlink"
											     xlink:href="<?php /*echo plugin_dir_url( __DIR__ ) . '../images/icons/svg-symbols.svg#image'; */ ?>"></use>
										</svg>
									</div>
									<div class="editor__icon-button__text">Another Button For Whatever</div>
									<input class="editor__icon-button__input" id="editor_other" type="file"
									       accept="jpg,png"/>
								</div>
							</label>-->
						
						</div>
					</div>
					
					<div class="editor__post-buttons">
						
						<!-- USING BUTTON GROUP AGAIN FOR SCALABILITY -->
						<div class="button-group button-group--right">
							<div class="button-group__item">
								<button id="send_message" class="button button--positive">Post Message</button>
								<button id="poll_message" class="button button--positive">Poll Message</button>
							</div>
						</div>
					
					</div>
				
				</div>
			
			</form>
		
		</div>
	</div>

</div>
<!-- MESSAGE CENTRE LAYOUT STARTS -->

<div id="ajax_response"></div>

<?php do_action( 'chumly_after_content' ); ?>
