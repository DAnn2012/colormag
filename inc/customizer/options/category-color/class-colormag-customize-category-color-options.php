<?php
/**
 * Class to include Category Color customize options.
 *
 * Class ColorMag_Customize_Category_Color_Options
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
 * Class to include Category Color customize option.
 *
 * Class ColorMag_Customize_Category_Color_Options
 */
class ColorMag_Customize_Category_Color_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function customizer_options( $options, $wp_customize ) {

		$configs = array(

			/**
			 * Category color settings options.
			 */
			// Category color settings heading separator.
			array(
				'name'     => 'colormag_category_color_settings_heading',
				'type'     => 'control',
				'control'  => 'colormag-heading',
				'label'    => esc_html__( 'Category Color Settings', 'colormag' ),
				'section'  => 'colormag_category_color_section',
				'priority' => 105,
			),

		);



		return $options;

	}

}

return new ColorMag_Customize_Category_Color_Options();
