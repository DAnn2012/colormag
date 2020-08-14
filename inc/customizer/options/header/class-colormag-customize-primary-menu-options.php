<?php
/**
 * Class to include Header Primary Menu customize options.
 *
 * Class ColorMag_Customize_Primary_Menu_Options
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
 * Class ColorMag_Customize_Primary_Menu_Options
 */
class ColorMag_Customize_Primary_Menu_Options extends ColorMag_Customize_Base_Option {

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
			 * Sticky menu options.
			 */
			// Sticky menu heading separator.
			array(
				'name'     => 'colormag_primary_sticky_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-heading',
				'label'    => esc_html__( 'Sticky Menu', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 5,
			),

			// Primary sticky menu enable/disable option.
			array(
				'name'     => 'colormag_primary_sticky_menu',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 10,
			),

			/**
			 * Home icon options.
			 */
			// Home icon in menu heading separator.
			array(
				'name'     => 'colormag_home_icon_display_heading',
				'type'     => 'control',
				'control'  => 'colormag-heading',
				'label'    => esc_html__( 'Show Home Icon', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 105,
			),

			// Home icon in menu display option.
			array(
				'name'      => 'colormag_home_icon_display',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Enable', 'colormag' ),
				'section'   => 'colormag_primary_menu_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector' => '.home-icon',
				),
				'priority'  => 110,
			),

			/**
			 * Search icon options.
			 */
			// Search icon in menu heading separator.
			array(
				'name'     => 'colormag_search_icon_in_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-heading',
				'label'    => esc_html__( 'Search Icon', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 205,
			),

			// Search icon in menu display option.
			array(
				'name'     => 'colormag_search_icon_in_menu',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 210,
			),

			/**
			 * Random posts icon options.
			 */
			// Random posts icon in menu heading separator.
			array(
				'name'     => 'colormag_random_post_in_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-heading',
				'label'    => esc_html__( 'Random Post', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 305,
			),

			// Random posts icon in menu display option.
			array(
				'name'      => 'colormag_random_post_in_menu',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Enable', 'colormag' ),
				'section'   => 'colormag_primary_menu_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.random-post',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_random_post',
					),
				),
				'priority'  => 310,
			),

			/**
			 * Responsive menu options.
			 */
			// Responsive menu heading separator.
			array(
				'name'     => 'colormag_responsive_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-heading',
				'label'    => esc_html__( 'Responsive Menu Style', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 405,
			),

			// New responsive menu enable/disable option.
			array(
				'name'     => 'colormag_responsive_menu',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 410,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Primary_Menu_Options();
