<div class="chumly">
	<div class="wrapper">
		<section class="message-center">
		
			<!-- HEADLINE COMPONENT -->

			<header class="headline">
				<h1 class="headline__heading">
					<i class="fa fa-comment-o headline__icon"></i>
					<strong><?php the_title(); ?></strong>
				</h1>
			</header>
			
			<aside class="message-center__search">
				<h3 class="message-center__search__heading">New Message</h3>
				<div class="message-center__search__form">
					<form class="form">
						<div class="form__group">
							<input type="text" id="find_recipient" class="form__field" placeholder="Start typing to find connections" autocomplete="off">
						</div>
					</form>
					<div id="find_recipient_response" class="message-center__search__results"></div>
				</div>
			</aside>
			
			<?php if(isset($_GET['thread_id']) && $_GET['thread_id'] == 'new_thread'){
				chumly_create_conversation(get_current_user_id(), $_GET['receiver_id']);;
			} ?>
			
			<script>
			jQuery(document).ready(function($){
				$('#find_recipient').on('keyup', function(){
					var query_string = $(this).val();
					
					$.ajax({
						url: chumly_ajax_variables.chumly_ajax_url,
						type: 'POST',
						data: {
							action: 'chumly_search_members',
							query: query_string,
							query_type: 'new_conversation'
						},
						success: function(data){
							$('#find_recipient_response').html(data)
						}
					});
				});
			});
			</script>
			
			
			<div id="new_convo"></div>
			
			<!-- HEADLINE COMPONENT -->

			<div class="message-center__inner" data-module="message-center">
				<!-- USER SIDEBAR -->

				<div class="message-center__users">
					<ol class="message-center__users__list">
						
						<?php
						global $wpdb;
						$current_user = get_current_user_id();
						
						$conversations = $wpdb->get_results("
									SELECT * FROM " . $wpdb->prefix . "chumly_conversations
									WHERE receiver_id = " . $current_user . " 
									OR sender_id = " . $current_user . "
									ORDER BY thread_timestamp DESC",
									OBJECT);
						
						?>
						
						<?php foreach($conversations as $conversation){ ?>
							
							<?php
							if($current_user == $conversation->sender_id){
								$user_id = $conversation->receiver_id;
							} else {
								$user_id = $conversation->sender_id;
							}
							?>

							<!-- ITEM -->

							<li class="message-center__users__item<?php echo ($i == 1 ? ' is-active' : ''); ?>" thread-id="<?php echo $conversation->ID; ?>" sender-id="<?php echo $conversation->sender_id; ?>" receiver-id="<?php echo $conversation->receiver_id; ?>">
								<a class="message-center__users__inner">
									<div class="message-center__users__image">
										<?php chumly_avatar($user_id); ?>
									</div>
									<div class="message-center__users__content">
										<?php $user_data = get_userdata($user_id); ?>
										<h3><?php echo $user_data->first_name . ' ' . $user_data->last_name; ?></h3>
									</div>
								</a>
							</li>

							<!-- ITEM -->

						<?php } ?>

					</ol>
				</div>

				<!-- USER SIDEBAR -->
				<?php if(isset($_GET['thread_id']) && $_GET['thread_id'] != 'new_thread'){ ?>
					
					<script>
					jQuery(document).ready(function($){
						var receiver_id = $('.message-center__users__list li[thread-id=<?php echo $_GET['thread_id']; ?>]').attr('receiver-id');
						console.log(receiver_id);
						$.ajax({
							url: chumly_ajax_variables.chumly_ajax_url,
							type: 'POST',
							data: {
								action: 'chumly_load_conversation',
								thread_id: '<?php echo $_GET['thread_id']; ?>',
								receiver_id: receiver_id
							},
							success: function(data){
								$('.message-center__chat__items').html(data);
								$('.message-center__chat__items').scrollTop($('.message-center__chat__items').prop("scrollHeight"));
							}
						});
					});
					</script>
					
				<?php } else { ?>
				
					<script>
					jQuery(document).ready(function($){
						$('.message-center__users__list li').on('click', function(e){
							<?php unset($_GET); ?>
							console.log('click');
							$('.message-center__users__list li').css('background', 'none');
							$(this).css('background', '#D6E1E5');
							
							$.ajax({
								url: chumly_ajax_variables.chumly_ajax_url,
								type: 'POST',
								data: {
									action: 'chumly_load_conversation',
									thread_id: $(this).attr('thread-id'),
									receiver_id: $(this).attr('receiver-id')
								},
								success: function(data){
									$('.message-center__chat__items').html(data);
									$('.message-center__chat__items').scrollTop($('.message-center__chat__items').prop("scrollHeight"));
									console.log('Success');
								}
							});
						});
					});
					</script>
				
				<?php } ?>
					
				<script>
				jQuery(document).ready(function($){
					setInterval(function(){
						var last_loaded_message = $('.message-center__chat__item').last().attr('timestamp'),
							message_container = $('.message-center__chat__items');
						//console.log('polling');
						$.ajax({
							url: chumly_ajax_variables.chumly_ajax_url,
							type: 'POST',
							data: {
								action: 'chumly_poll_new_message',
								last_message: last_loaded_message,
								receiver_id: $('#send_message').attr('recipient-id'),
								thread_id: $('#send_message').attr('thread-id')
							},
							success: function(data){
								$('.message-center__chat__item').last().after(data);
								//console.log($('.message-center__chat__item').last().height());
								//if(message_container[0].scrollHeight - message_container.scrollTop() == message_container.height()){
									//console.log('Bottom');
									$('.message-center__chat__items').scrollTop($('.message-center__chat__items').prop("scrollHeight"));
								//}
							}
						});
	
					}, 1500);
				});
				</script>
				
				<!-- CONVERSATION -->

				<div class="message-center__chat">
					<div class="message-center__chat__inner">
						<ol class="message-center__chat__items">
							<p>Start the conversation</p>
						</ol>

						<div class="message-center__chat__box">
							<div class="form__group">
								<textarea id="message_content" class="form__field form__field--multiline" placeholder="Write a reply..."></textarea>
							</div>
							<div class="form__group form__group--right">
								<!--<button id="delete_message" class="button button--error form__delete-button">Delete Message</button> -->
								<button id="send_message" class="button button--success">Send</button>
							</div>
						</div>
					</div>
				</div>
				
				
				<!-- CONVERSATION -->
				<script>
				jQuery(document).ready(function($){
					$('#message_content').keypress(function (event){
						
						if(event.keyCode == 13 && event.shiftKey){
							var content = this.value;
							var caret = getCaret(this);
							
							this.value = content.substring(0, caret);
							event.stopPropagation();
							   
						} else if(event.keyCode == 13){
							  
							$('#send_message').click();
							return false;
						  
						}
						
					});
					
					function getCaret(el){ 
						if(el.selectionStart){ 
							
							return el.selectionStart; 
					  	
						} else if(document.selection){ 
							
							el.focus(); 
							var r = document.selection.createRange(); 
							
							if(r == null){ 
						  	
								return 0; 
							
							} 
					
							var re = el.createTextRange(), 
								rc = re.duplicate(); 
						
							re.moveToBookmark(r.getBookmark()); 
							rc.setEndPoint('EndToStart', re); 
					
							return rc.text.length; 
					  	}  
					 	
						return 0; 
					}
					
					$('#send_message').on('click', function(){
						if($.trim($('#message_content').val())){
							$.ajax({
								url: chumly_ajax_variables.chumly_ajax_url,
								type: 'POST',
								data: {
									action: 'chumly_send_message',
									message_content: $('#message_content').val(),
									receiver_id: $('#send_message').attr('recipient-id'),
									thread_id: $('#send_message').attr('thread-id')
								},
								success: function(data){
									//$('#message_ajax').html(data);
									$('#message_content').val('');
								}
							});
						}
					});
				});
				</script>
			</div>
			
			<div id="message_ajax"></div>

		</section>
	</div>
</div>