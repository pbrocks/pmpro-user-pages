<?php
defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );
if ( class_exists( 'PMPro_Userpage_Settings' ) ) {
	new PMPro_Userpage_Settings();
}

class PMPro_Userpage_Settings {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'pmpro_userpage_settings_init' ) );
	}
	public function add_admin_menu() {

		add_options_page( __CLASS__, __CLASS__, 'manage_options', 'pmpro-userpage-settings.php', array( $this, 'options_page' ) );

	}

	public function pmpro_userpage_settings_init() {

		register_setting( 'pmpro_userpage_settings', 'pmpro_userpage_settings' );

		add_settings_section(
			'pmproPage_section',
			__( 'This is the description area given for a settings page', 'pmpro-userpage-settings' ),
			array( $this, 'pmpro_userpage_settings_section_callback' ),
			'pmpro_userpage_settings'
		);

		add_settings_field(
			'select_field_0',
			__( 'Describe the dropdown select in this field', 'pmpro-userpage-settings' ),
			array( $this, 'select_field_0_render' ),
			'pmpro_userpage_settings',
			'pmproPage_section'
		);

		add_settings_field(
			'text_field_0',
			__( 'Describe the text field in this field', 'pmpro-userpage-settings' ),
			array( $this, 'text_field_0_render' ),
			'pmpro_userpage_settings',
			'pmproPage_section'
		);

		add_settings_field(
			'checkbox_field_0',
			__( 'Describe the checkbox in this field', 'pmpro-userpage-settings' ),
			array( $this, 'checkbox_field_0_render' ),
			'pmpro_userpage_settings',
			'pmproPage_section'
		);

		add_settings_field(
			'textarea_field_0',
			__( 'Describe the textarea in this field', 'pmpro-userpage-settings' ),
			array( $this, 'textarea_field_0_render' ),
			'pmpro_userpage_settings',
			'pmproPage_section'
		);

		add_settings_field(
			'radio_field_0',
			__( 'Describe the radio button select in this field', 'pmpro-userpage-settings' ),
			array( $this, 'radio_field_0_render' ),
			'pmpro_userpage_settings',
			'pmproPage_section'
		);

	}

	public function select_field_0_render() {

		$options = get_option( 'pmpro_userpage_settings' );
		?>
		<select name='pmpro_userpage_settings[select_field_0]'>
		<option value='1' <?php selected( $options['select_field_0'], 1 ); ?>>Option 1</option>
		<option value='2' <?php selected( $options['select_field_0'], 2 ); ?>>Option 2</option>
		<option value='3' <?php selected( $options['select_field_0'], 3 ); ?>>Option 3</option>
		<option value='4' <?php selected( $options['select_field_0'], 4 ); ?>>Option 4</option>
		</select>

	<?php

	}

	public function text_field_0_render() {

		$options = get_option( 'pmpro_userpage_settings' );
		?>
		<input type='text' name='pmpro_userpage_settings[text_field_0]' value='<?php echo $options['text_field_0']; ?>'>
		<?php

	}

	public function checkbox_field_0_render() {

		$options = get_option( 'pmpro_userpage_settings' );
		?>
		<input type='checkbox' name='pmpro_userpage_settings[checkbox_field_0]' <?php checked( $options['checkbox_field_0'], 1 ); ?> value='1'>
		<?php

	}

	public function textarea_field_0_render() {

		$options = get_option( 'pmpro_userpage_settings' );
		?>
		<textarea cols='40' rows='5' name='pmpro_userpage_settings[textarea_field_0]'> 
		<?php echo $options['textarea_field_0']; ?>
	 </textarea>
		<?php

	}

	public function radio_field_0_render() {

		$options = get_option( 'pmpro_userpage_settings' );
		?>
		<label>Radio 1
		<input type='radio' name='pmpro_userpage_settings[radio_field_0]' <?php checked( $options['radio_field_0'], 1 ); ?> value='1'></label>
		<br>
		<label>Radio 2
		<input type='radio' name='pmpro_userpage_settings[radio_field_0]' <?php checked( $options['radio_field_0'], 2 ); ?> value='2'></label>
		<?php

	}

	public function pmpro_userpage_settings_section_callback() {

		echo __( '<em style="padding:1rem;">This description is found in this function <b>' . __FUNCTION__ . ' </b>and provides an paragraph-type area below the headings and above the individual settings.</em>', 'pmpro-userpage-settings' );

	}

	public function options_page() {
		?>
		<div class="wrap">
		<form action='options.php' method='post'>
			<h2>Built with: <?php echo  __FUNCTION__; ?> method in <?php echo __CLASS__; ?> Class</h2>
			<?php
				settings_fields( 'pmpro_userpage_settings' );
				do_settings_sections( 'pmpro_userpage_settings' );
				submit_button();
			?>

			</form>
		</div>
		<?php
		$this->pmpro_userpage_settings_render();
		$this->pmpro_userpage_settings_todo();
	}

	public function pmpro_userpage_settings_render() {
		$options = get_option( 'pmpro_userpage_settings' );
		echo '<pre>';
		print_r( $options );
		echo '</pre>';
	}

	public function pmpro_userpage_settings_todo() {
		echo '<h4>' . __FUNCTION__ . '</h4>';
		echo '<li>Should make sure the settings get deleted if uninstalled</li>';
	}
}
