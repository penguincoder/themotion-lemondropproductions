<?php
/**
 * Footer Content Customizer Controls
 *
 * @package themotion
 */
add_action( 'customize_register', 'themotion_footer_content_customizer' );

/**
 * Customizer Controls for the footer content.
 *
 * @param class $wp_customize the wp_customize class.
 */
function themotion_footer_content_customizer( $wp_customize ) {

	/* Footer Options */
	$wp_customize->add_panel( 'themotion_footer_section', array(
		'priority'    => 70,
		'title'       => esc_html__( 'Footer Options', 'themotion' ),
		'description' => esc_html__( 'The following settings affect the footer on all pages, see the Widgets > Main Widget Area panel to add the Helpful Links.', 'themotion' ),
	) );

	/* Featured Video */

	$wp_customize->add_section( 'themotion_featured_video_section', array(
		'title'    => esc_html__( 'Featured Video Settings', 'themotion' ),
		'panel'    => 'themotion_footer_section',
		'priority' => 1,
	) );

	/* Featured Video - header */

	$wp_customize->add_setting( 'themotion_featured_video_header', array(
		'sanitize_callback' => 'themotion_sanitize_text',
		'default'           => esc_html__( 'Learn More About Us By Watching', 'themotion' ),
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_featured_video_header', array(
		'label'    => esc_html__( 'Featured Video Header', 'themotion' ),
		'section'  => 'themotion_featured_video_section',
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'themotion_featured_video_link', array(
		'sanitize_callback' => 'themotion_sanitize_iframe',
		'default'           => esc_url( 'https://vimeo.com/146792328' ),
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_featured_video_link', array(
		'label'    => esc_html__( 'Featured Video', 'themotion' ),
		'section'  => 'themotion_featured_video_section',
		'priority' => 1,
		'type'     => 'textarea',
	) );

	/* Quick Contact Settings */

	$wp_customize->add_section( 'themotion_quick_contact', array(
		'priority' => 2,
		'title'    => esc_html__( 'Quick Contact Settings', 'themotion' ),
		'panel'    => 'themotion_footer_section',
	) );

	/* Quick Contact - header */

	$wp_customize->add_setting( 'themotion_quick_contact_header', array(
		'sanitize_callback' => 'themotion_sanitize_text',
		'default'           => esc_html__( 'Quick Contact', 'themotion' ),
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_quick_contact_header', array(
		'label'    => esc_html__( 'Quick Contact Header', 'themotion' ),
		'section'  => 'themotion_quick_contact',
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'themotion_footer_contact', array(
		'default'           => json_encode( array(
			array(
				'link' => 'mailto:start@themotion.com',
				'text' => esc_html__( 'start@themotion.com', 'themotion' ),
				'id'   => 'themotion_578ce05d84590',
			),
			array(
				'link' => 'tel:123-456-7890',
				'text' => esc_html__( '123-456-7890', 'themotion' ),
				'id'   => 'themotion_578ce05e84591',
			),
		) ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'themotion_sanitize_repeater',
	) );

	$wp_customize->add_control( new Themotion_General_Repeater( $wp_customize, 'themotion_footer_contact', array(
		'label'                  => esc_html__( 'Add new contact link', 'themotion' ),
		'section'                => 'themotion_quick_contact',
		'priority'               => 2,
		'themotion_link_control' => true,
		'themotion_text_control' => true,
	) ) );

	$wp_customize->add_section( 'themotion_footer_call_to_action', array(
		'title'    => esc_html__( 'Call To Action Settings', 'themotion' ),
		'panel'    => 'themotion_footer_section',
		'priority' => 3,
	) );

	/* Control for banner text */
	$wp_customize->add_setting( 'themotion_footer_call_to_action_title', array(
		'default'           => esc_html__( 'Videos Delivered', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_footer_call_to_action_title', array(
		'label'    => esc_html__( 'Title', 'themotion' ),
		'section'  => 'themotion_footer_call_to_action',
		'priority' => 1,
	) );

	/* Control for banner text */
	$wp_customize->add_setting( 'themotion_footer_call_to_action_text', array(
		'default'           => esc_html__( 'Videos delivered to your inbox the day we post.', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_footer_call_to_action_text', array(
		'label'    => esc_html__( 'Text', 'themotion' ),
		'section'  => 'themotion_footer_call_to_action',
		'priority' => 2,
	) );

	/* Control for button text on banner */
	$wp_customize->add_setting( 'themotion_footer_call_to_action_button_text', array(
		'default'           => esc_html__( 'Subscribe', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_footer_call_to_action_button_text', array(
		'label'    => esc_html__( 'Button Text', 'themotion' ),
		'section'  => 'themotion_footer_call_to_action',
		'priority' => 4,
	) );

	/* Control for button link on banner */
	$wp_customize->add_setting( 'themotion_footer_call_to_action_button_link', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_footer_call_to_action_button_link', array(
		'label'    => esc_html__( 'Button Link', 'themotion' ),
		'section'  => 'themotion_footer_call_to_action',
		'priority' => 5,
	) );
}


