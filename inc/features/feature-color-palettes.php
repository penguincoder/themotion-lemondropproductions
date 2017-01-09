<?php
/**
 * Color Palette Customizer Controls
 *
 * @package themotion
 */

add_action( 'customize_register', 'themotion_color_palettes_customizer' );

/**
 * Customizer Controls for the Color Palette Control.
 *
 * @param class $wp_customize the wp_customize class.
 */
function themotion_color_palettes_customizer( $wp_customize ) {

	/* Color Palette Controls */
	$wp_customize->add_setting( 'themotion_palette_picker', array(
		'default'           => json_encode( 'p1' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'themotion_sanitize_pallete',
	) );

	$wp_customize->add_control( new Themotion_Palette( $wp_customize, 'themotion_palette_picker', array(
		'label'       => esc_html__( 'Change the color scheme', 'themotion' ),
		'section'     => 'colors',
		'description' => __( 'To create your own color palette select "Custom" option.', 'themotion' ),
		'priority'    => 1,
	) ) );

	$wp_customize->add_setting( 'themotion_custom_1', array(
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themotion_custom_1', array(
				'label'       => esc_html__( 'Color 1', 'themotion' ),
				'section'     => 'colors',
				'priority'    => 2,
				'description' => __( 'Color for sidebar titles and hovers (buttons, links etc.)', 'themotion' ),
	)   )   );

	$wp_customize->add_setting( 'themotion_custom_2', array(
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themotion_custom_2', array(
				'label'       => esc_html__( 'Color 2', 'themotion' ),
				'section'     => 'colors',
				'priority'    => 3,
				'description' => __( 'Main color ( section background, icons, links etc.)', 'themotion' ),
	)   )   );

	$wp_customize->add_setting( 'themotion_custom_3', array(
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themotion_custom_3',    array(
				'label'       => esc_html__( 'Color 3', 'themotion' ),
				'section'     => 'colors',
				'priority'    => 4,
				'description' => __( 'Sidebar background color', 'themotion' ),
	)   )    );

	$wp_customize->add_setting( 'themotion_custom_4', array(
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themotion_custom_4', array(
				'label'       => esc_html__( 'Color 4', 'themotion' ),
				'section'     => 'colors',
				'priority'    => 5,
				'description' => __( 'Background color of playlist on Home Page Option A template', 'themotion' ),
	)    )   );

	$wp_customize->add_setting( 'themotion_custom_5', array(
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themotion_custom_5', array(
				'label'       => esc_html__( 'Color 5', 'themotion' ),
				'section'     => 'colors',
				'priority'    => 6,
				'description' => __( 'Background color of playing video on Home Page Option A template', 'themotion' ),
	)   )  );
}

/**
 * Color Palette Sanitization
 */
function themotion_sanitize_pallete( $input ) {
	if ( ! empty( $input ) ) {
		$possible = array( 'p1','p2','p3','p4','p5','themotion_palette_custom' );
		$palette_name = json_decode( $input, true );
		if ( in_array( $palette_name, $possible ) ) {
			return $input;
		}
		return json_encode( 'p1' );
	}
	return '';
}

