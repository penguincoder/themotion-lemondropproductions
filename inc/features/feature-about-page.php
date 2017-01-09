<?php
/**
 * About Page Customizer Controls
 *
 * @package themotion
 */

add_action( 'customize_register', 'themotion_about_page_customizer' );

/**
 * Customizer Controls for About Page.
 *
 * @param class $wp_customize the wp_customize class.
 */
function themotion_about_page_customizer( $wp_customize ) {

	/* === About page settings === */
	$wp_customize->add_panel( 'themotion_about', array(
		'priority'   => 60,
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'About page', 'themotion' ),
	) );

	$wp_customize->add_section( 'themotion_about_header_settings', array(
		'title'    => esc_html__( 'Header Settings', 'themotion' ),
		'priority' => 1,
		'panel'    => 'themotion_about',
	) );

	/* Header Image	*/
	$wp_customize->add_setting( 'themotion_about_header_image', array(
		'default'           => esc_url( get_template_directory_uri() . '/images/about.jpg' ),
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themotion_about_header_image', array(
		'label'    => esc_html__( 'Header Image', 'themotion' ),
		'section'  => 'themotion_about_header_settings',
		'priority' => 1,
	) ) );

	/* Control for header text */
	$wp_customize->add_setting( 'themotion_about_header_text', array(
		'default'           => esc_html__( 'We are curators striving to help you Put Business In Motion', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_about_header_text', array(
		'label'    => esc_html__( 'Header text', 'themotion' ),
		'section'  => 'themotion_about_header_settings',
		'priority' => 2,
	) );

	/* Control for button text*/
	$wp_customize->add_setting( 'themotion_about_button_text', array(
		'default'           => esc_html__( 'See all videos', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_about_button_text', array(
		'label'    => esc_html__( 'Button text', 'themotion' ),
		'section'  => 'themotion_about_header_settings',
		'priority' => 3,
	) );

	/* Control for button link*/
	$wp_customize->add_setting( 'themotion_about_button_link', array(
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_about_button_link', array(
		'label'    => esc_html__( 'Button URL', 'themotion' ),
		'section'  => 'themotion_about_header_settings',
		'priority' => 4,
	) );

	/*Content Area Settings*/
	$wp_customize->add_section( 'themotion_about_content_settings', array(
		'title'    => esc_html__( 'Content Area Settings', 'themotion' ),
		'priority' => 2,
		'panel'    => 'themotion_about',
	) );

	$wp_customize->add_setting( 'themotion_about_b1_title', array(
		'default'           => esc_html__( 'Our mission', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_about_b1_title', array(
		'label'    => esc_html__( 'Block One Headline', 'themotion' ),
		'section'  => 'themotion_about_content_settings',
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'themotion_about_b1_text', array(
		'default'           => esc_html__( 'We are a resource for creatives wanting to push their business forward. Using best practices and a keen eye, we curated this video feed for the business beginner and experienced alike.', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_about_b1_text', array(
		'label'    => esc_html__( ' Block One Paragraph', 'themotion' ),
		'type'     => 'textarea',
		'section'  => 'themotion_about_content_settings',
		'priority' => 2,
	) );

	$wp_customize->add_setting( 'themotion_about_b2_title', array(
		'default'           => esc_html__( 'Why the motion', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_about_b2_title', array(
		'label'    => esc_html__( 'Block Two Headline', 'themotion' ),
		'section'  => 'themotion_about_content_settings',
		'priority' => 3,
	) );

	$wp_customize->add_setting( 'themotion_about_b2_text', array(
		'default'           => esc_html__( 'Using best practices and a keen eye, we curated this video feed for the business beginner and experienced alike. We are a resource for creatives wanting to push their business forward.', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_about_b2_text', array(
		'label'    => esc_html__( ' Block Two Paragraph', 'themotion' ),
		'type'     => 'textarea',
		'section'  => 'themotion_about_content_settings',
		'priority' => 4,
	) );

	/* Stats settings */
	$wp_customize->add_section( 'themotion_about_stats_settings', array(
		'title'    => esc_html__( 'Stats Settings', 'themotion' ),
		'priority' => 3,
		'panel'    => 'themotion_about',
	) );

	$wp_customize->add_setting( 'themotion_show_stats', array(
		'transport'         => 'postMessage',
		'sanitize_callback' => 'themotion_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'themotion_show_stats', array(
		'type'        => 'checkbox',
		'label'       => __( 'Hide all statistics?', 'themotion' ),
		'description' => __( 'If you check this box, statistics will disappear from header.', 'themotion' ),
		'section'     => 'themotion_about_stats_settings',
		'priority'    => 1,
	) );

	$wp_customize->add_setting( 'themotion_about_stats_one_number', array(
		'default'           => '7247',
		'sanitize_callback' => 'themotion_sanitize_number',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_about_stats_one_number', array(
		'label'    => esc_html__( 'Stat one number', 'themotion' ),
		'type'     => 'number',
		'section'  => 'themotion_about_stats_settings',
		'priority' => 2,
	) );

	$wp_customize->add_setting( 'themotion_about_stats_one_text', array(
		'default'           => esc_html__( 'Users', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_about_stats_one_text', array(
		'label'    => esc_html__( 'Stat one text', 'themotion' ),
		'section'  => 'themotion_about_stats_settings',
		'priority' => 3,
	) );

	$wp_customize->add_setting( 'themotion_about_stats_two_number', array(
		'default'           => '645',
		'sanitize_callback' => 'themotion_sanitize_number',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_about_stats_two_number', array(
		'label'    => esc_html__( 'Stat one number', 'themotion' ),
		'type'     => 'number',
		'section'  => 'themotion_about_stats_settings',
		'priority' => 4,
	) );

	$wp_customize->add_setting( 'themotion_about_stats_two_text', array(
		'default'           => esc_html__( 'Videos', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_about_stats_two_text', array(
		'label'    => esc_html__( 'Stat two text', 'themotion' ),
		'section'  => 'themotion_about_stats_settings',
		'priority' => 5,
	) );

	$wp_customize->add_setting( 'themotion_about_stats_three_number', array(
		'default'           => '11582',
		'sanitize_callback' => 'themotion_sanitize_number',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_about_stats_three_number', array(
		'label'    => esc_html__( 'Stat three number', 'themotion' ),
		'type'     => 'number',
		'section'  => 'themotion_about_stats_settings',
		'priority' => 6,
	) );

	$wp_customize->add_setting( 'themotion_about_stats_three_text', array(
		'default'           => esc_html__( 'Likes', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_about_stats_three_text', array(
		'label'    => esc_html__( 'Stat three text', 'themotion' ),
		'section'  => 'themotion_about_stats_settings',
		'priority' => 7,
	) );

	$wp_customize->add_setting( 'themotion_about_stats_four_number', array(
		'default'           => '923',
		'sanitize_callback' => 'themotion_sanitize_number',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_about_stats_four_number', array(
		'label'    => esc_html__( 'Stat four number', 'themotion' ),
		'type'     => 'number',
		'section'  => 'themotion_about_stats_settings',
		'priority' => 8,
	) );

	$wp_customize->add_setting( 'themotion_about_stats_four_text', array(
		'default'           => esc_html__( 'Shares', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_about_stats_four_text', array(
		'label'    => esc_html__( 'Stat four text', 'themotion' ),
		'section'  => 'themotion_about_stats_settings',
		'priority' => 9,
	) );

	/*  Testimony */
	$wp_customize->add_section( 'themotion_testimony_settings', array(
		'title'    => esc_html__( 'Testimony Settings', 'themotion' ),
		'priority' => 4,
		'panel'    => 'themotion_about',
	) );

	$wp_customize->add_setting( 'themotion_show_testimony', array(
		'transport'         => 'postMessage',
		'sanitize_callback' => 'themotion_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'themotion_show_testimony', array(
		'type'        => 'checkbox',
		'label'       => __( 'Hide testimony?', 'themotion' ),
		'description' => __( 'If you check this box, Testimony section will disappear.', 'themotion' ),
		'section'     => 'themotion_testimony_settings',
		'priority'    => 1,
	) );

	/* Header Image	*/
	$wp_customize->add_setting( 'themotion_testimony_avatar', array(
		'default'           => get_template_directory_uri() . '/images/avatar.jpg',
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themotion_testimony_avatar', array(
		'label'    => esc_html__( 'Avatar', 'themotion' ),
		'section'  => 'themotion_testimony_settings',
		'priority' => 2,
	) ) );

	$wp_customize->add_setting( 'themotion_testimony_text', array(
		'default'           => esc_html__( 'In Motion has helped me grow my business by over 10% in the past month. The videos are helpful, easy to follow and are beautifully made. Overall this is a fantastic resource!', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_testimony_text', array(
		'label'    => esc_html__( 'Paragraph', 'themotion' ),
		'type'     => 'textarea',
		'section'  => 'themotion_testimony_settings',
		'priority' => 3,
	) );

	$wp_customize->add_setting( 'themotion_testimony_subtext', array(
		'default'           => esc_html__( 'ASH S. - SMALL BUSINESS OWNER', 'themotion' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_testimony_subtext', array(
		'label'    => esc_html__( 'Byline', 'themotion' ),
		'section'  => 'themotion_testimony_settings',
		'priority' => 4,
	) );

}
