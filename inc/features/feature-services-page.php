<?php
/**
 * Services Page Customizer Controls
 *
 * @package themotion
 */

add_action( 'customize_register', 'themotion_services_page_customizer' );

/**
 * Customizer Controls for About Page.
 *
 * @param class $wp_customize the wp_customize class.
 */
function themotion_services_page_customizer( $wp_customize ) {

	/* === About page settings === */
	$wp_customize->add_panel( 'themotion_services', array(
		'priority'   => 65,
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'Services page', 'themotion' ),
	) );

	$wp_customize->add_section( 'themotion_services_header_settings', array(
		'title'    => esc_html__( 'Header Settings', 'themotion' ),
		'priority' => 1,
		'panel'    => 'themotion_services',
	) );

	/* Header Image	*/
	$wp_customize->add_setting( 'themotion_services_header_image', array(
		'default'           => esc_url( get_template_directory_uri() . '/images/about.jpg' ),
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themotion_services_header_image', array(
		'label'    => esc_html__( 'Header Image', 'themotion' ),
		'section'  => 'themotion_services_header_settings',
		'priority' => 1,
	) ) );

	/* Control for header text */
	$wp_customize->add_setting( 'themotion_services_header_text', array(
		'default'           => esc_html__( 'We are curators striving to help you Put Business In Motion', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_services_header_text', array(
		'label'    => esc_html__( 'Header text', 'themotion' ),
		'section'  => 'themotion_services_header_settings',
		'priority' => 2,
	) );

}
