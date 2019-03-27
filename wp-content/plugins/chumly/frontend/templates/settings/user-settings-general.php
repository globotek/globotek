<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 27/6/18
 * Time: 10:48 AM
 */

$settings->output_radio_setting( array(
	'title'       => 'Example Radio Setting',
	'instruction' => 'Some information about the option. Some information about the option. Some information about the option. Some information about the option. Some information about the option. Some information about the option. ',
	'options'     => array(
		array(
			'label' => 'Test Option 1',
			'name'  => 'option_name_1',
			'value' => 'option_109'
		),
		array(
			'label' => 'Test Option 2',
			'name'  => 'option_name_1',
			'value' => 'option_2435'
		)
	)
) );

$timezone_options = array();

foreach ( timezone_identifiers_list() as $timezone ) {
	
	$timezone_options[] = array(
		'label' => $timezone,
		'value' => $timezone
	);
	
}

$settings->output_select_setting( array(
	'title'       => 'Your Timezone',
	'instruction' => 'Choose your current timezone',
	'name'        => 'user_timezone',
	'options'     => $timezone_options

) );