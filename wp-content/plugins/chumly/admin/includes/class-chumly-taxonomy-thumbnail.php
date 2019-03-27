<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 30/01/2019
 * Time: 14:17
 */

if( ! class_exists( 'Chumly_Taxonomy_Thumbnail' ) ) {
	class Chumly_Taxonomy_Thumbnail {
		
		public function __construct() {
			//
		}
		
		/**
		 * Initialize the class and start calling our hooks and filters
		 */
		public function init() {
			// Image actions
			add_action( 'chumly_subject_add_form_fields', array( $this, 'add_category_image' ), 10, 2 );
			add_action( 'created_chumly_subject', array( $this, 'save_category_image' ), 10, 2 );
			add_action( 'chumly_subject_edit_form_fields', array( $this, 'update_category_image' ), 10, 2 );
			add_action( 'edited_chumly_subject', array( $this, 'updated_category_image' ), 10, 2 );
			add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
			add_action( 'admin_footer', array( $this, 'add_script' ) );
		}
		
		public function load_media() {
			if( ! isset( $_GET['taxonomy'] ) || $_GET['taxonomy'] != 'chumly_subject' ) {
				return;
			}
			wp_enqueue_media();
		}
		
		/**
		 * Add a form field in the new category page
		 * @since 1.0.0
		 */
		
		public function add_category_image( $taxonomy ) { ?>
			<div class="form-field term-group">
				<label for="chumly-taxonomy-image-id"><?php _e( 'Image', 'chumly' ); ?></label>
				<input type="hidden" id="chumly-taxonomy-image-id" name="chumly-taxonomy-image-id" class="custom_media_url" value="">
				<div id="category-image-wrapper"></div>
				<p>
					<input type="button" class="button button-secondary chumly_tax_media_button" id="chumly_tax_media_button" name="chumly_tax_media_button" value="<?php _e( 'Add Image', 'chumly' ); ?>" />
					<input type="button" class="button button-secondary chumly_tax_media_remove" id="chumly_tax_media_remove" name="chumly_tax_media_remove" value="<?php _e( 'Remove Image', 'chumly' ); ?>" />
				</p>
			</div>
		<?php }
		
		/**
		 * Save the form field
		 * @since 1.0.0
		 */
		public function save_category_image( $term_id, $tt_id ) {
			if( isset( $_POST['chumly-taxonomy-image-id'] ) && '' !== $_POST['chumly-taxonomy-image-id'] ){
				add_term_meta( $term_id, 'chumly-taxonomy-thumbnail', absint( $_POST['chumly-taxonomy-image-id'] ), true );
			}
		}
		
		/**
		 * Edit the form field
		 * @since 1.0.0
		 */
		public function update_category_image( $term, $taxonomy ) { ?>
			<tr class="form-field term-group-wrap">
				<th scope="row">
					<label for="chumly-taxonomy-image-id"><?php _e( 'Image', 'chumly' ); ?></label>
				</th>
				<td>
					<?php $image_id = get_term_meta( $term->term_id, 'chumly-taxonomy-thumbnail', true ); ?>
					<input type="hidden" id="chumly-taxonomy-image-id" name="chumly-taxonomy-image-id" value="<?php echo esc_attr( $image_id ); ?>">
					<div id="category-image-wrapper">
						<?php if( $image_id ) { ?>
							<?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
						<?php } ?>
					</div>
					<p>
						<input type="button" class="button button-secondary chumly_tax_media_button" id="chumly_tax_media_button" name="chumly_tax_media_button" value="<?php _e( 'Add Image', 'chumly' ); ?>" />
						<input type="button" class="button button-secondary chumly_tax_media_remove" id="chumly_tax_media_remove" name="chumly_tax_media_remove" value="<?php _e( 'Remove Image', 'chumly' ); ?>" />
					</p>
				</td>
			</tr>
		<?php }
		
		/**
		 * Update the form field value
		 * @since 1.0.0
		 */
		public function updated_category_image( $term_id, $tt_id ) {
			if( isset( $_POST['chumly-taxonomy-image-id'] ) && '' !== $_POST['chumly-taxonomy-image-id'] ){
				update_term_meta( $term_id, 'chumly-taxonomy-thumbnail', absint( $_POST['chumly-taxonomy-image-id'] ) );
			} else {
				update_term_meta( $term_id, 'chumly-taxonomy-thumbnail', '' );
			}
		}
		
		/**
		 * Enqueue styles and scripts
		 * @since 1.0.0
		 */
		public function add_script() {
			if( ! isset( $_GET['taxonomy'] ) || $_GET['taxonomy'] != 'chumly_subject' ) {
				return;
			} ?>
			<script> jQuery(document).ready( function($) {
					_wpMediaViewsL10n.insertIntoPost = '<?php _e( "Insert", "chumly" ); ?>';
					function ct_media_upload(button_class) {
						var _custom_media = true, _orig_send_attachment = wp.media.editor.send.attachment;
						$('body').on('click', button_class, function(e) {
							var button_id = '#'+$(this).attr('id');
							var send_attachment_bkp = wp.media.editor.send.attachment;
							var button = $(button_id);
							_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
								if( _custom_media ) {
									$('#chumly-taxonomy-image-id').val(attachment.id);
									$('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
									$( '#category-image-wrapper .custom_media_image' ).attr( 'src',attachment.url ).css( 'display','block' );
								} else {
									return _orig_send_attachment.apply( button_id, [props, attachment] );
								}
							}
							wp.media.editor.open(button); return false;
						});
					}
					ct_media_upload('.chumly_tax_media_button.button');
					$('body').on('click','.chumly_tax_media_remove',function(){
						$('#chumly-taxonomy-image-id').val('');
						$('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
					});
					// Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
					$(document).ajaxComplete(function(event, xhr, settings) {
						var queryStringArr = settings.data.split('&');
						if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
							var xml = xhr.responseXML;
							$response = $(xml).find('term_id').text();
							if($response!=""){
								// Clear the thumb image
								$('#category-image-wrapper').html('');
							}
						}
					});
				});
			</script>
		<?php }
	}
	$chumly_taxonomy_thumbnail = new Chumly_Taxonomy_Thumbnail();
	$chumly_taxonomy_thumbnail->init(); }