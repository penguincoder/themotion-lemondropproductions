<?php
/**
 * Search Icon Controls
 *
 * @package themotion
 */
add_action( 'customize_register', 'themotion_search_toggle_customizer' );
/**
 * Customizer Controls for the Search Icon.
 *
 * @param class $wp_customize the wp_customize class.
 */
function themotion_search_toggle_customizer( $wp_customize ) {

	/* Control for hiding search icon*/
	$wp_customize->add_setting( 'themotion_show_search', array(
		'transport'         => 'postMessage',
		'sanitize_callback' => 'themotion_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'themotion_show_search', array(
		'type'        => 'checkbox',
		'label'       => __( 'Hide search icon?', 'themotion' ),
		'description' => __( 'If you check this box, the search icon will disappear from header.', 'themotion' ),
		'section'     => 'title_tagline',
		'priority'    => 1,
	) );

}
