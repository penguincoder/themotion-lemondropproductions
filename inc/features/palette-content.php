<?php
/**
 * Output for the color palette
 *
 * @package themotion
 */


/**
 * Color Palette Content
 */
function color_palettes_output() {
	$palette                  = '<style>';
	$themotion_palette_picker = get_theme_mod( 'themotion_palette_picker', json_encode( 'p1' ) );
	$palette_name             = json_decode( $themotion_palette_picker );
	if ( 'themotion_palette_custom' == $palette_name ) {
		$themotion_custom_1 = get_theme_mod( 'themotion_custom_1' );
		$themotion_custom_2 = get_theme_mod( 'themotion_custom_2' );
		$themotion_custom_3 = get_theme_mod( 'themotion_custom_3' );
		$themotion_custom_4 = get_theme_mod( 'themotion_custom_4' );
		$themotion_custom_5 = get_theme_mod( 'themotion_custom_5' );

		if ( ! empty( $themotion_custom_1 ) ) {

			$palette .= '

        #pirate-forms-contact-submit:hover, .more-link:hover ,.home-ribbon-intro .btn:hover, .home-ribbon .btn, .home-top-area-inner .btn:hover, .about-top-area-inner .btn:hover{
			border-color: ' . $themotion_custom_1 . ';
        }

        .themotion-playlist-item:hover{
			border-right-color: ' . $themotion_custom_1 . ';
        }

        #pirate-forms-contact-submit:hover, .more-link:hover ,.home-ribbon-intro .btn:hover,.home-ribbon .btn, .home-top-area-inner .btn:hover, .about-top-area-inner .btn:hover {
			background-color: ' . $themotion_custom_1 . ';
        }

        .recently-item h2.entry-title a:hover, post-edit-link:hover, .search-page .entry-title a:hover, .widget-title, .contact-link a:hover, a:hover,.search-opt:hover,.social-media-icons a:hover,.home-ribbon .btn:hover {
			color: ' . $themotion_custom_1 . ';
        }
        .site-footer .themotion-footer-call-to-action a:hover{
            color:#ffffff;
        }
		';
		}

		if ( ! empty( $themotion_custom_2 ) ) {

			$palette .= '
        .contact-link a:before, .menu-social-footer li a:before, .search-page .entry-title a, .sticky .entry-title-blog a, .themotion-footer-call-to-action a, .contact-link .fa, a,.search-opt,.social-media-icons a,.site-title a, .home-ribbon-intro .btn, .post-navigation .nav-links a:hover, .menu-toggle:hover, .menu-toggle:focus, .site-footer a:hover, #menu-social-footer a:before, .stat-number, .more-link  {
			color: ' . $themotion_custom_2 . ';
        }
        .themotion-footer-call-to-action a:hover, #pirate-forms-contact-submit, .btn, .home-ribbon-intro .btn, .post-navigation .nav-previous:hover, .post-navigation .nav-next:hover, blockquote {
			border-color: ' . $themotion_custom_2 . ';
        }
        .themotion-playlist-playing{
			border-right-color: ' . $themotion_custom_2 . ';
        }
        .themotion-footer-call-to-action a:hover, #pirate-forms-contact-submit, .home-ribbon, .btn, .btn:hover , .homepage-two .recently-posted-title, input[type="submit"], .testimonial-area, .page-header-search{
			background-color: ' . $themotion_custom_2 . ';
        }
        .widget_origin_call-to-action .origin-widget-button a{
			color: ' . $themotion_custom_2 . '!important;
			border-color: ' . $themotion_custom_2 . '!important;
        }
        @media screen and (max-width: 991px){
            .main-navigation{
				background-color: ' . $themotion_custom_2 . ';
            }
		}';
		}

		if ( ! empty( $themotion_custom_3 ) ) {
			$palette .= '
        .widget-area .widget {
			background: ' . $themotion_custom_3 . ';
        }
		';
		}

		if ( ! empty( $themotion_custom_4 ) ) {
			$palette .= '
        .themotion-playlist-tracks{
			background: ' . $themotion_custom_4 . ';
        }
		';
		}

		if ( ! empty( $themotion_custom_5 ) ) {
			$palette .= '
        .themotion-playlist-item:hover, .themotion-playlist-playing{
			background: ' . $themotion_custom_5 . ';
        }

        .themotion-playlist-item:hover, .themotion-playlist-item{
			border-top-color: ' . $themotion_custom_5 . ';
        }';
		}
		$palette .= '</style>';
		wp_add_inline_style( 'themotion-style', $palette );
	}
}

add_action( 'wp_enqueue_scripts', 'color_palettes_output' );


/**
 * Function to enqueue the color palette styles
 */
function themotion_palette_styles() {
	$themotion_palette_picker = get_theme_mod( 'themotion_palette_picker', json_encode( 'p1' ) );
	$palette_name = json_decode( $themotion_palette_picker );
	if ( ! empty( $palette_name ) && is_string( $palette_name ) && 'themotion_palette_custom' != $palette_name ) {
		wp_enqueue_style( 'themotion_' . $palette_name, get_template_directory_uri() . '/css/themotion_' . $palette_name . '.css', array(), '1.0.1' );
	}
}
add_action( 'wp_enqueue_scripts', 'themotion_palette_styles' );
