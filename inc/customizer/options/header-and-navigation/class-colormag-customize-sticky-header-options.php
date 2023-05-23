<?php
/**
 * Class to include Header Primary Menu customize options.
 *
 * Class ColorMag_Customize_Sticky_Header_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to include Header Primary Menu customize options.
 *
 * Class ColorMag_Customize_Sticky_Header_Options
 */
class ColorMag_Customize_Sticky_Header_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		// Customize transport postMessage variable to set `postMessage` or `refresh` as required.
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$configs = array(

			/**
			 * Sticky Menu.
			 */
			// Sticky menu heading separator.
			array(
				'name'     => 'colormag_sticky_header_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Sticky Header', 'colormag' ),
				'section'  => 'colormag_sticky_header_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_sticky_header_general_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'General', 'colormag' ),
				'section'  => 'colormag_sticky_header_section',
				'priority' => 20,
			),

			array(
				'name'        => 'colormag_enable_sticky_menu',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'colormag-toggle',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to enable the sticky behavior of the primary menu', 'colormag' ),
				'section'     => 'colormag_sticky_header_section',
				'priority'    => 30,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}
}

return new ColorMag_Customize_Sticky_Header_Options();
