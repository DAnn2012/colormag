<?php
/**
 * ColorMag customizer base control class for theme customize options.
 *
 * Class ColorMag_Customize_Base_Option
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ColorMag customizer base control class.
 *
 * Class ColorMag_Customize_Base_Control
 */
class ColorMag_Customize_Base_Control {

	/**
	 * Registered Controls.
	 *
	 * @var array
	 */
	public static $controls;

	/**
	 * Customizer base control constructor.
	 *
	 * ColorMag_Customize_Base_Control constructor.
	 */
	public function __construct() {

		// Enqueue the required scripts for the custom customize controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_customize_controls' ) );

		// Localize the scripts for custom customize controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'localize_enqueued_scripts' ) );

	}

	/**
	 * Enqueue custom scripts for customize controls.
	 */
	public function enqueue_customize_controls() {

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		/**
		 * Enqueue required Customize Controls CSS files.
		 */
		// SelectWoo CSS library file.
		wp_enqueue_style(
			'selectWoo',
			COLORMAG_CUSTOMIZER_URL . '/custom-controls/assets/css/selectWoo' . $suffix . '.css',
			array(),
			COLORMAG_THEME_VERSION
		);

		// Main CSS file.
		wp_enqueue_style(
			'colormag-customize-controls',
			COLORMAG_CUSTOMIZER_URL . '/custom-controls/assets/css/customize-controls' . $suffix . '.css',
			array(),
			COLORMAG_THEME_VERSION
		);

		/**
		 * Enqueue required Customize Controls JS files.
		 */
		// SelectWoo JS library file.
		wp_enqueue_script(
			'selectWoo',
			COLORMAG_CUSTOMIZER_URL . '/custom-controls/assets/js/selectWoo' . $suffix . '.js',
			array(),
			COLORMAG_THEME_VERSION,
			true
		);

		// WP Color Picker Alpha JS library file.
		wp_enqueue_script(
			'wp-color-picker-alpha',
			COLORMAG_CUSTOMIZER_URL . '/custom-controls/assets/js/wp-color-picker-alpha' . $suffix . '.js',
			array(
				'wp-color-picker',
			),
			COLORMAG_THEME_VERSION,
			true
		);

		// Main JS file.
		wp_enqueue_script(
			'colormag-customize-controls',
			COLORMAG_CUSTOMIZER_URL . '/custom-controls/assets/js/customize-controls' . $suffix . '.js',
			array(
				'jquery',
			),
			COLORMAG_THEME_VERSION,
			true
		);

	}

	/**
	 * Localize the scripts for custom customize controls.
	 */
	public function localize_enqueued_scripts() {

		// Localize background scripts.
		$this->localize_background_scripts();

		// Localize fonts scripts.
		$this->localize_fonts_scripts();

	}

	/**
	 * Localize background scripts.
	 */
	public function localize_background_scripts() {

		wp_localize_script(
			'colormag-customize-controls',
			'ColorMagCustomizerControlBackground',
			array(
				'placeholder' => esc_html__( 'No file selected', 'colormag' ),
			)
		);

	}

	/**
	 * Localize fonts scripts.
	 */
	public function localize_fonts_scripts() {

		$standard_fonts   = ColorMag_Fonts::get_system_fonts();
		$google_fonts     = ColorMag_Fonts::get_google_fonts();
		$custom_fonts     = ColorMag_Fonts::get_custom_fonts();
		$localize_scripts = array(
			'standardfontslabel' => esc_html__( 'Standard Fonts', 'colormag' ),
			'googlefontslabel'   => esc_html__( 'Google Fonts', 'colormag' ),
			'standard'           => $standard_fonts,
			'google'             => $google_fonts,
		);

		// If custom fonts is available,then add it for localization.
		if ( ! empty( $custom_fonts ) ) {
			$localize_scripts['customfontslabel'] = esc_html__( 'Custom Fonts', 'colormag' );
			$localize_scripts['custom']           = $custom_fonts;
		}

		wp_localize_script(
			'colormag-customize-controls',
			'ColorMagCustomizerControlTypography',
			$localize_scripts
		);

	}

	/**
	 * Add Control to self::$controls and register custom controls to WordPress Customizer.
	 *
	 * @param string $name       Slug for the control.
	 * @param array  $attributes Control Attributes.
	 *
	 * @return void
	 */
	public static function add_control( $name, $attributes ) {

		global $wp_customize;
		self::$controls[ $name ] = $attributes;

		if ( isset( $attributes['callback'] ) ) {
			$wp_customize->register_control_type( $attributes['callback'] );
		}

	}

	/**
	 * Returns control instance.
	 *
	 * @param string $control_type Control type.
	 *
	 * @return string
	 */
	public static function get_control_instance( $control_type ) {

		$control_class = self::get_control( $control_type );

		if ( isset( $control_class['callback'] ) ) {
			return class_exists( $control_class['callback'] ) ? $control_class['callback'] : false;
		}

		return false;

	}

	/**
	 * Returns control and its attributes.
	 *
	 * @param string $control_type Control type.
	 *
	 * @return array
	 */
	public static function get_control( $control_type ) {

		if ( isset( self::$controls[ $control_type ] ) ) {
			return self::$controls[ $control_type ];
		}

		return array();

	}

	/**
	 * Returns santize callback for control.
	 *
	 * @param string $control Control type for customize option.
	 *
	 * @return string
	 */
	public static function get_sanitize_callback( $control ) {

		if ( isset( self::$controls[ $control ]['sanitize_callback'] ) ) {
			return self::$controls[ $control ]['sanitize_callback'];
		}

		return false;

	}

}

return new ColorMag_Customize_Base_Control();
