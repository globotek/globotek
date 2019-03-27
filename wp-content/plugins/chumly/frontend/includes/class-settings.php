<?php

/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 26/6/18
 * Time: 5:34 PM
 */
class Chumly_Settings {
	
	protected $user_id;
	
	public function __construct() {
		
		add_filter( 'chumly_settings_pages', array( $this, 'core_settings_pages' ) );
		add_filter( 'chumly_settings_panels', array( $this, 'settings_panels' ) );
		
		$this->user_id = get_current_user_id();
		
	}
	
	public static function core_settings_pages( $pages ) {
		
		return array(
			array(
				'url'   => '/settings/general',
				'title' => 'General'
			),
			array(
				'url'   => '/settings/privacy',
				'title' => 'Privacy'
			),
			array(
				'url'   => '/settings/email',
				'title' => 'Email'
			)
		);
		
	}
	
	public function settings_panels( $panels ) {
		
		return array(
			array(
				'title'         => 'General',
				'icon'          => 'cog',
				'template_path' => plugin_dir_path( __DIR__ ) . 'templates/settings/user-settings-general.php',
				'url'           => trailingslashit( '/settings/general/' ),
			),
			array(
				'title'         => 'Privacy',
				'icon'          => 'ban',
				'template_path' => plugin_dir_path( __DIR__ ) . 'templates/settings/user-settings-privacy.php',
				'url'           => trailingslashit( '/settings/privacy/' ),
			),
			array(
				'title'         => 'Emails',
				'icon'          => 'inbox',
				'template_path' => plugin_dir_path( __DIR__ ) . 'templates/settings/user-settings-email.php',
				'url'           => trailingslashit( '/settings/email/' ),
			)
		);
		
	}
	
	/**
	 * @param array $options ['instruction']
	 * @param array $options ['options'] = array()
	 *
	 */
	public function output_radio_setting( $options = array() ) {
		
		$count = 0;
		
		echo '<div class="form__group">';
		
		echo '<h4 class="form__group__title">' . $options[ 'title' ] . '</h4>';
		
		echo '<div class="form__group__radio">';
		
		echo '<label class="form__group__label" for="option_1">' . $options[ 'instruction' ] . '</label>';
		
		echo '<div class="button-group button-group--narrow">';
		
		foreach ( $options[ 'options' ] as $option ) {
			
			if ( ! empty( $option ) ) {
				
				$saved_value = self::get_setting( $this->user_id, $option[ 'name' ] );
				
				echo '<div class="button-group__item">';
				
				echo '<label for="' . $option[ 'name' ] . '_' . $count . '" class="button  ' . ( $saved_value == $option[ 'value' ] ? 'button--primary' : '' ) . '">' . $option[ 'label' ];
				
				echo '<input 
							id="' . $option[ 'name' ] . '_' . $count . '" 
							class="' . ( $saved_value == $option[ 'value' ] ? 'active' : '' ) . '" 
							type="radio" 
							name="' . $option[ 'name' ] . '" 
							value="' . $option[ 'value' ] . '"' . checked( $saved_value, $option[ 'value' ], FALSE ) . '/>';
				
				echo '</label>';
				
				echo '</div>';
				
				$count ++;
				
			}
			
		}
		
		echo '</div>';
		
		echo '</div>';
		
		echo '</div>';
		
	}
	
	/**
	 * @param array $options ['instruction']
	 * @param array $options ['options'] = array()
	 *
	 */
	public function output_select_setting( $options = array() ) {
		
		$saved_value = self::get_setting( $this->user_id, $options[ 'name' ] );
		
		echo '<div class="form__group">';
		
		echo '<h4 class="form__group__title">' . $options[ 'title' ] . '</h4>';
		
		echo '<div class="form__group__inline">';
		
		echo '<label class="form__group__label" for="option_1">' . $options[ 'instruction' ] . '</label>';
		
		echo '<select class="form__group__select form__group__select--narrow form__group__select--big" name="' . $options[ 'name' ] . '">';
		
		foreach ( $options[ 'options' ] as $option ) {
			
			if ( ! empty( $option ) ) {
				
				echo '<option value="' . $option[ 'value' ] . '"' . selected( $saved_value, $option[ 'value' ], FALSE ) . '>' . $option[ 'label' ] . '</option>';
				
			}
			
		}
		
		echo '</select>';
		
		echo '</div>';
		
		echo '</div>';
		
	}
	
	public static function get_setting( $user_id, $setting_key ) {
		
		return get_user_meta( $user_id, $setting_key, TRUE );
		
	}
	
	public function save_settings() {
		
		foreach ( $_POST as $setting_key => $setting_value ) {
			
			update_user_meta( $this->user_id, $setting_key, $setting_value );
			
		}
		
	}
	
}