<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 27/6/18
 * Time: 10:49 AM
 */

$settings->output_radio_setting( array(
	'title'       => 'Profile Privacy',
	'instruction' => 'Who can see your future posts on your profile?',
	'input_name'  => 'profile_privacy',
	'options'     => array(
		array(
			'label' => 'Everyone',
			'name'  => 'profile_post_privacy',
			'value' => 1
		),
		array(
			'label' => 'Friends Only',
			'name'  => 'profile_post_privacy',
			'value' => 0
		)
	)
) );

$settings->output_radio_setting( array(
	'title'       => 'Friend Requests',
	'instruction' => 'Who is able to send you friend requests?',
	'input_name'  => 'public_connections',
	'options'     => array(
		array(
			'label' => 'Anyone',
			'name'  => 'public_connections',
			'value' => 1
		),
		array(
			'label' => 'Nobody',
			'name'  => 'public_connections',
			'value' => 0
		)
	)
) );
