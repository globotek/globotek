<?php
$charset_collate = 'DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci';

$create_options_table = "CREATE TABLE $options_table (
		option_id INT NOT NULL AUTO_INCREMENT,
		option_name VARCHAR (255),
		option_value VARCHAR(255),
		PRIMARY KEY  (option_id)
	) $charset_collate;";


/*
 * ID = Auto Increment Row ID.
 * input_id = Input's location (default, registration, new_user etc) + auto generated number (row number on creation).
 * input_order = The order number for the input, where it appears in the list.
 * input_name = Lowercase underscored input name. Used for getting the field.
 * input_label = Human friendly name for the field, used on the frontend.
 * input_type = The input type - text, textarea, number etc.
 * input_required = If the input has to be filled before the form will submit.
 * input_instructions = Instructions to users on the frontend when editing.
 * input_data = Empty on install but this is the serialized array of all the input's data such as placement, type etc.
 * input_location = Which forms and where in the registration process the input is active. Default, registration, profile etc.
 * input_group = Which group of inputs the group belongs to. All default on install.
 * input_active = If the input should be visible on the front end on the profile page and forms. Default fields are always available on edit forms, deactivating hides from profile page.
 * input_placement = Full Width on install but is the CSS class for laying out the profile pages etc.
 * user_type = If the field is for a user or a group, initially. Can be extended to mark fields for different types of entity such as for a listings site, fields can be listing info.
 */
$create_inputs_table = "CREATE TABLE $inputs_table (
		ID INT AUTO_INCREMENT,
		input_id VARCHAR(25),
		input_order INT,
		input_name VARCHAR(255),
		input_label VARCHAR(255),
		input_type VARCHAR(50),
		input_required BOOLEAN,
		input_instructions TEXT,
		input_data TEXT,
		input_location VARCHAR(50),
		input_group VARCHAR(255),
		input_permanent BOOLEAN,
		input_active BOOLEAN,
		input_placement TEXT,
		user_type VARCHAR(50),
		PRIMARY KEY  (ID)
	) $charset_collate;";


$create_input_groups_table = "CREATE TABLE $input_groups_table (
		ID INT AUTO_INCREMENT,
		input_group_name VARCHAR(255),
		user_type VARCHAR(255),
		user_role TEXT,
		admin_approval INT,
		dashboard_access INT,
		required INT,
		wp_user_role VARCHAR(255),
		wp_capabilities TEXT,
		PRIMARY KEY  (ID)
) $charset_collate;";


$create_friends_table = "CREATE TABLE $friends_table (
	ID INT AUTO_INCREMENT,
	request_sender_id INT(7),
	request_receiver_id INT(7),
	connection_status VARCHAR(15),
	connection_date INT(12),
	PRIMARY KEY  (ID)
) $charset_collate;";


$create_conversations_table = "CREATE TABLE $conversations_table (
	ID INT AUTO_INCREMENT,
	sender_id INT,
	receiver_id INT,
	thread_subject VARCHAR(255),
	thread_timestamp INT,
	unread_messages BOOLEAN,
	PRIMARY KEY  (ID)
) $charset_collate;";


$create_messages_table = "CREATE TABLE $messages_table (
	ID INT AUTO_INCREMENT,
	sender_id INT,
	receiver_id INT,
	thread_id INT,
	message_content TEXT,
	message_timestamp INT,
	PRIMARY KEY  (ID)
) $charset_collate;";


$create_groups_table = "CREATE TABLE $groups_table (
	ID INT AUTO_INCREMENT,
	title TEXT,
	name VARCHAR(200),
	wp_post_id INT,
	is_public INT,
	is_private INT,
	is_secret INT,
	privacy VARCHAR(25),
	group_data TEXT,
	group_timestamp INT,
	PRIMARY KEY  (ID)
) $charset_collate;";


$create_group_members_table = "CREATE TABLE $group_members_table (
	ID INT AUTO_INCREMENT,
	group_id INT,
	user_id INT,
	first_name TEXT,
	last_name TEXT,
	membership VARCHAR(100),
	banned BOOLEAN,
	join_timestamp INT,
	PRIMARY KEY  (ID)
) $charset_collate;";


$create_notifications_table = "CREATE TABLE $notifications_table (
	ID INT AUTO_INCREMENT,
	user_id INT,
	viewed INT,
	link VARCHAR(255),
	message TEXT,
	type VARCHAR(100),
	source VARCHAR(100),
	sender_id INT,
	timestamp INT,
	PRIMARY KEY  (ID)
) $charset_collate;";