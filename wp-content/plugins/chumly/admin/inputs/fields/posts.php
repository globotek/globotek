<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 13/12/18
 * Time: 12:30 PM
 */
function posts_admin_markup() {
	
	$input_ID = str_replace( 'item_', NULL, $_REQUEST[ 'row_id' ] );
	$input_data = chumly_unserialize( $_REQUEST[ 'input_data' ] ); ?>
	
	<tr class="field-type-anchor"></tr>
	
	<tr class="input-data">
		<td class="label">
			<label>Placeholder Text</label>
			<p>Appears within the input</p>
		</td>
		
		<td class="input-wrap">
			<input type="text" class="input" name="input_<?php echo $input_ID; ?>[input_data][placeholder]" value="<?php echo $input_data[ 'placeholder' ]; ?>"/>
		</td>
	</tr>
	
	<tr class="input-data">
		<td class="label">
			<label>Post Type</label>
		</td>
		
		<td class="input-wrap">
			
			<?php $post_types = get_post_types(); ?>
			
			<select name="input_<?php echo $input_ID; ?>[input_data][post_type]">
				
				<?php foreach ( $post_types as $post_type ) { ?>
					
					<option value="<?php echo $post_type; ?>" <?php selected( $post_type, $input_data[ 'post_type' ] ); ?>><?php echo ucwords( str_replace( array(
							'_',
							'-'
						), ' ', $post_type ) ); ?></option>
				
				<?php } ?>
			
			</select>
		
		</td>
	</tr>
	
	<tr class="input-data">
		<td class="label">
			<label>Taxonomy</label>
		</td>
		
		<td class="input-wrap">
			
			<?php $taxonomies = get_taxonomies(); ?>

			<select name="input_<?php echo $input_ID; ?>[input_data][taxonomy]">
				
				<?php foreach ( $taxonomies as $taxonomy ) { ?>
					
					<option value="<?php echo $taxonomy; ?>" <?php selected( $taxonomy, $input_data[ 'taxonomy' ] ); ?>><?php echo ucwords( str_replace( array(
							'_',
							'-'
						), ' ', $taxonomy ) ); ?></option>
				
				<?php } ?>
			
			</select>
		
		</td>
	</tr>
	
	<tr class="input-data">
		<td class="label">
			<label>Terms</label>
		</td>
		
		<!--<td class="input-wrap">
			
			<?php /*$taxonomies = get_terms(); */?>

			<select name="row_<?php /*echo $i; */?>[input_data][taxonomy]">
				
				<?php /*foreach ( $taxonomies as $taxonomy ) { */?>
					
					<option value="<?php /*echo $taxonomy; */?>" <?php /*selected( $taxonomy, $input_data[ 'taxonomy' ] ); */?>><?php /*echo ucwords( str_replace( array(
							'_',
							'-'
						), ' ', $taxonomy ) ); */?></option>
				
				<?php /*} */?>
			
			</select>
		
		</td>-->
		
		<td class="input-wrap">
			
			<input type="text" name="input_<?php echo $input_ID; ?>[input_data][term_variable]" value="<?php echo $input_data['term_variable']; ?>" placeholder="$_GET parameter populate from URL" />
		
		</td>
		
	</tr>
	
<!--	<tr class="input-date">
		<td class="label"><label>Output Style</label></td>
		
		<td class="input-wrap">
			
			<select name="row_<?php /*echo $i; */?>[input_data][output_style]">
				
				<option value="checkbox" <?php /*selected( $post_type_value, $input_data[ 'post_type' ] ); */?>>Checkbox</option>
				<option value="select" <?php /*selected( $post_type_value, $input_data[ 'post_type' ] ); */?> disabled>
					<i>Select - Coming Soon!</i></option>
			
			</select>
		
		</td>
	</tr>
-->
	<?php wp_die();
}

add_action( 'wp_ajax_posts_admin_markup', 'posts_admin_markup' );