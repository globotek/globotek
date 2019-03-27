<h1><?php esc_attr_e( 'Edit ' . ucwords( str_replace('_', ' ', $_GET['input_group'] ) ) . ' Fields' ); ?></h1>

<?php
$inputs_index = chumly_get_option( 'inputs_index' );
echo '<input type="hidden" id="inputs_index" name="inputs_index" value="' . $inputs_index . '">';
?>

<div class="wrap chumly">
	
	<div id="poststuff">
		
		<div id="post-body" class="metabox-holder columns-2">
			
			<!-- main content -->
			<div id="post-body-content">
				
				<div class="meta-box-sortables ui-sortable">
					
					<div class="postbox">
						
						<table class="widefat">
							<tr class="inputs-header">
								<th class="header-title"><?php esc_attr_e( 'Input Order' ); ?></th>
								<th class="header-title"><?php esc_attr_e( 'Input Label' ); ?></th>
								<th class="header-title"><?php esc_attr_e( 'Input Name' ); ?></th>
								<th class="header-title"><?php esc_attr_e( 'Input Type' ); ?></th>
							</tr>
						</table>
						
						<form id="group" class="inputs-list" data-input_group="<?php esc_attr_e( $_GET['input_group'] ); ?>">
							<?php $input_location = 'group'; ?>
							<?php require( 'inputs-list.php' ); ?>
						</form>
					
					</div>
					<!-- .postbox -->
				
				</div>
				<!-- .meta-box-sortables .ui-sortable -->
			
			</div>
			<!-- post-body-content -->
			
			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">
				
				<div class="meta-box-sortables">
					
					<div class="postbox">
						
						<h3><span><?php esc_attr_e( 'Publish' ); ?></span></h3>
						
						<div class="inside">
							
							<!--<input id="save-fields" class="button-primary" type="submit" name="submit" value="<?php //_e('Update'); ?>" />-->
							<!--<p id="save-fields" class="button-primary">Update</p>-->
							<input type="button" id="save-fields" class="button-primary" value="Save">
							<div class="spinner chumly"></div>
						</div>
						<!-- .inside -->
					
					</div>
					<!-- .postbox -->
				
				</div>
				<!-- .meta-box-sortables -->
			
			</div>
			<!-- #postbox-container-1 .postbox-container -->
		
		</div>
		<!-- #post-body .metabox-holder .columns-2 -->
		
		<br class="clear">
		
		<div id="ajax-response-fields"></div>
	
	</div>
	<!-- #poststuff -->

</div> <!-- .wrap -->