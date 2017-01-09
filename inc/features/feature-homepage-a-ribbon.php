<?php
/**
 * Homepage A Ribbon Customizer Controls
 *
 * @package themotion
 */

add_action( 'customize_register', 'themotion_home_a_ribbon_customizer' );

/**
 * Customizer Controls for the Homepage A Ribbon.
 *
 * @param class $wp_customize the wp_customize class.
 */
function themotion_home_a_ribbon_customizer( $wp_customize ) {

	/* Control for hiding homepage A banner*/
	$wp_customize->add_setting( 'themotion_home_a_show_banner', array(
		'transport'         => 'postMessage',
		'sanitize_callback' => 'themotion_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'themotion_home_a_show_banner', array(
		'type'        => 'checkbox',
		'label'       => __( 'Hide ribbon on Homepage A?', 'themotion' ),
		'description' => __( 'If you check this box, the banner from Homepage A will disappear.', 'themotion' ),
		'section'     => 'themotion_home_a',
		'priority'    => 2,
	) );

	/* Control for banner text */
	$wp_customize->add_setting( 'themotion_home_a_banner_text', array(
		'default'           => esc_html__( 'A collection of high quality videos focused on putting your business in motion.', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_home_a_banner_text', array(
		'label'    => esc_html__( 'Banner Headline', 'themotion' ),
		'section'  => 'themotion_home_a',
		'priority' => 3,
	) );

	/* Control for button text on banner */
	$wp_customize->add_setting( 'themotion_home_a_banner_button_text', array(
		'default'           => esc_html__( 'Subscribe', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_home_a_banner_button_text', array(
		'label'    => esc_html__( 'Button Text', 'themotion' ),
		'section'  => 'themotion_home_a',
		'priority' => 4,
	) );

	/* Control for button link on banner */
	$wp_customize->add_setting( 'themotion_home_a_banner_button_link', array(
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_home_a_banner_button_link', array(
		'label'    => esc_html__( 'Button Link', 'themotion' ),
		'section'  => 'themotion_home_a',
		'priority' => 5,
	) );

}
