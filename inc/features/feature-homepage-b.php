<?php
/**
 * Homepage B Customizer Controls
 *
 * @package themotion
 */
add_action( 'customize_register', 'themotion_homepage_b_customizer' );
/**
 * Customizer Controls for Homepage B.
 *
 * @param class $wp_customize the wp_customize class.
 */
function themotion_homepage_b_customizer( $wp_customize ) {

	/* === Homepage B settings === */
	$wp_customize->add_panel( 'themotion_home_b', array(
		'priority'   => 55,
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'Home Page Option B', 'themotion' ),
	) );

	$wp_customize->add_section( 'themotion_header_settings', array(
		'title'    => esc_html__( 'Header Settings', 'themotion' ),
		'priority' => 1,
		'panel'    => 'themotion_home_b',
	) );

	/* Control for header text */
	$wp_customize->add_setting( 'themotion_home_b_header_text', array(
		'default'           => esc_html__( 'A collection of high quality videos focused on putting your business in motion.', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_home_b_header_text', array(
		'label'    => esc_html__( 'Header text', 'themotion' ),
		'section'  => 'themotion_header_settings',
		'priority' => 2,
	) );

	/* Control for button text*/
	$wp_customize->add_setting( 'themotion_home_b_button_text', array(
		'default'           => esc_html__( 'See all videos', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_home_b_button_text', array(
		'label'    => esc_html__( 'Button text', 'themotion' ),
		'section'  => 'themotion_header_settings',
		'priority' => 3,
	) );

	/* Control for button link*/
	$wp_customize->add_setting( 'themotion_home_b_button_link', array(
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_home_b_button_link', array(
		'label'    => esc_html__( 'Button URL', 'themotion' ),
		'section'  => 'themotion_header_settings',
		'priority' => 4,
	) );

	$wp_customize->add_section( 'themotion_featured_video', array(
		'title'    => esc_html__( 'Featured Video', 'themotion' ),
		'priority' => 2,
		'panel'    => 'themotion_home_b',
	) );

	/* Control for hiding videos */
	$wp_customize->add_setting( 'themotion_show_videos', array(
		'sanitize_callback' => 'themotion_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'themotion_show_videos', array(
		'type'        => 'checkbox',
		'label'       => __( 'Hide videos on Homepage B?', 'themotion' ),
		'description' => __( 'If you check this box, videos from Homepage B will disappear.', 'themotion' ),
		'section'     => 'themotion_featured_video',
		'priority'    => 1,
	) );

	$wp_customize->add_setting( 'themotion_video_category', array(
		'default'           => 'all',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'themotion_sanitize_category_dropdown',
	) );

	$wp_customize->add_control( new ThemotionCategorySelector( $wp_customize, 'themotion_video_category', array(
		'label'    => esc_html__( 'Category', 'themotion' ),
		'section'  => 'themotion_featured_video',
		'priority' => 2,
	) ) );

	$wp_customize->add_section( 'themotion_call_to_action', array(
		'title'    => esc_html__( 'Call To Action', 'themotion' ),
		'priority' => 3,
		'panel'    => 'themotion_home_b',
	) );

	$wp_customize->add_setting( 'themotion_call_to_action_title', array(
		'default'           => esc_html__( 'A CREATIVE + HELPFUL RESOURCE', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_call_to_action_title', array(
		'label'    => esc_html__( 'Headline', 'themotion' ),
		'section'  => 'themotion_call_to_action',
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'themotion_call_to_action_text', array(
		'default'           => esc_html__( 'We are a resource for creatives wanting to push their business forward. Using best practices and a keen eye, we curate this video feed for the business beginner and experienced alike.', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_call_to_action_text', array(
		'label'    => esc_html__( 'Paragraph', 'themotion' ),
		'section'  => 'themotion_call_to_action',
		'priority' => 2,
	) );

	/* Control for button text on banner */
	$wp_customize->add_setting( 'themotion_call_to_action_button_text', array(
		'default'           => esc_html__( 'Subscribe', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_call_to_action_button_text', array(
		'label'    => esc_html__( 'Button Text', 'themotion' ),
		'section'  => 'themotion_call_to_action',
		'priority' => 3,
	) );

	/* Control for button link on banner */
	$wp_customize->add_setting( 'themotion_call_to_action_button_link', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_call_to_action_button_link', array(
		'label'    => esc_html__( 'Button URL', 'themotion' ),
		'section'  => 'themotion_call_to_action',
		'priority' => 4,
	) );

	$wp_customize->add_section( 'themotion_bottom_posts', array(
		'title'    => esc_html__( 'Bottom Posts', 'themotion' ),
		'priority' => 4,
		'panel'    => 'themotion_home_b',
	) );

	$wp_customize->add_setting( 'themotion_bottom_posts_title', array(
		'default'           => esc_html__( 'Recently Posted', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_bottom_posts_title', array(
		'label'    => esc_html__( 'Title', 'themotion' ),
		'section'  => 'themotion_bottom_posts',
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'themotion_bottom_posts_category', array(
		'default'           => 'all',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'themotion_sanitize_category_dropdown',
	) );

	$wp_customize->add_control( new ThemotionCategorySelector( $wp_customize, 'themotion_bottom_posts_category', array(
		'label'    => esc_html__( 'Category', 'themotion' ),
		'section'  => 'themotion_bottom_posts',
		'priority' => 2,
	) ) );

}
