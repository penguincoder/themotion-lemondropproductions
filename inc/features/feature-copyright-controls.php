<?php
/**
 * Footer Copyright Controls
 *
 * @package themotion
 */

add_action( 'customize_register', 'themotion_copyright_customizer' );

/**
 * Customizer Controls for the footer Copyright line.
 *
 * @param class $wp_customize the wp_customize class.
 */
function themotion_copyright_customizer( $wp_customize ) {

	/* Control for banner text */
	$wp_customize->add_setting( 'themotion_footer_copyright', array(
		'default'           => sprintf(
			__( 'Proudly powered by  %1$s | Theme: themotion powered by %2$s', 'themotion' ),
			sprintf( '<a href="http://wordpress.org/" rel="nofollow">%s</a>', esc_html__( 'WordPress', 'themotion' ) ),
			sprintf( '<a href="https://themeisle.com/" rel="nofollow">%s</a>', esc_html__( 'Themeisle', 'themotion' ) )
		),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'themotion_footer_copyright', array(
		'label'    => esc_html__( 'Copyright', 'themotion' ),
		'section'  => 'title_tagline',
		'priority' => 60,
	) );
}
