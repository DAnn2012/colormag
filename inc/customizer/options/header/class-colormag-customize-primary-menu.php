<?php
/**
 * Class to include Header Primary Menu customize options.
 *
 * Class ColorMag_Customize_Primary_Menu
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
 * Class to include Header Primary Menu customize options.
 *
 * Class ColorMag_Customize_Primary_Menu
 */
class ColorMag_Customize_Primary_Menu  extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function customizer_options( $options, $wp_customize ) {

		// Customize transport postMessage variable to set `postMessage` or `refresh` as required.
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$configs = array(

			/**
			 * Home icon options.
			 */
			// Home icon in menu heading separator.
			array(
				'name'     => 'colormag_home_icon_display_heading',
				'type'     => 'control',
				'control'  => 'colormag-heading',
				'label'    => esc_html__( 'Show Home Icon', 'colormag' ),
				'section'  => 'colormag_header_primary_menu_section',
				'priority' => 5,
			),

			// Home icon in menu display option.
			array(
				'name'      => 'colormag_home_icon_display',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Check to show the home icon in the primary menu', 'colormag' ),
				'section'   => 'colormag_header_primary_menu_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector' => '.home-icon',
				),
				'priority'  => 10,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Primary_Menu();
