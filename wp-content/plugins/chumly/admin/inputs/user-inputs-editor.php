<h1><?php esc_attr_e( 'Edit ' . ucwords( str_replace('_', ' ', $_GET['input_group'] ) ) . ' Fields' ); ?></h1>

<?php $inputs_index = chumly_get_option( 'inputs_index' ); ?>
<?php echo '<input type="hidden" id="inputs_index" name="inputs_index" value="' . $inputs_index . '">'; ?>

<div id="tabs" class="chumly">
	<h2 class="nav-tab-wrapper">
		<ul>
			<li><a form-id="required" href="#required" class="nav-tab">Required Fields</a></li>
			<li><a form-id="registration" href="#registration" class="nav-tab">Registration Fields</a></li>
			<li><a form-id="new-user" href="#new-user" class="nav-tab">New User Fields</a></li>
			<li><a form-id="profile" href="#profile" class="nav-tab">Profile Fields</a></li>
		</ul>
	</h2>
	
	<div class="wrap">
		
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
							
							<form id="required" class="inputs-form" data-input_group="<?php esc_attr_e( $_GET['input_group'] ); ?>">
								<?php $input_location = 'required'; ?>
								<?php require( 'inputs-list.php' ); ?>
							</form>
							
							<form id="registration" class="inputs-form" data-input_group="<?php esc_attr_e( $_GET['input_group'] ); ?>">
								<?php $input_location = 'registration'; ?>
								<?php require( 'inputs-list.php' ); ?>
							</form>
							
							<form id="new-user" class="inputs-form" data-input_group="<?php esc_attr_e( $_GET['input_group'] ); ?>">
								<?php $input_location = 'new_user'; ?>
								<?php require( 'inputs-list.php' ); ?>
							</form>
							
							<form id="profile" class="inputs-form" data-input_group="<?php esc_attr_e( $_GET['input_group'] ); ?>">
								<?php $input_location = 'profile'; ?>
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

</div>
<!-- #tabs -->