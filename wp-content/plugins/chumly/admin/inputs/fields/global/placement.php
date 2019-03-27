<tr>
	<td class="label"><label>Select Placement</label><?php echo $row->input_placement; ?></td>
	<td class="input-wrap">
		<select class="input" name="row_<?php echo $input_ID; ?>[placement]">
			<option value="grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole"
				<?php selected( $row->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole' ); ?>>
				Full Width
			</option>
			<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-quarter"
				<?php selected( $row->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-quarter' ); ?>>
				One Quarter
			</option>
			<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-half"
				<?php selected( $row->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-half' ); ?>>
				One Half
			</option>
			<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--three-quarters"
				<?php selected( $row->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--three-quarters' ); ?>>
				Three Quarters
			</option>
			<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-third"
				<?php selected( $row->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--one-third' ); ?>>
				One Third
			</option>
			<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--two-thirds"
				<?php selected( $row->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--two-thirds' ); ?>>
				Two Thirds
			</option>
			<option value="grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--three-tenths"
				<?php selected( $row->input_placement, 'grid__item--palm-one-whole grid__item--lap--one-half grid__item--desk--three-tenths' ); ?>>
				Three Tenths
			</option>
		</select>
	</td>
</tr>
