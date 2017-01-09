<?php
/**
 * Template part for displaying single downloads.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themotion
 */
?>
<div class="themotion-footer-template">
	<?php
	$themotion_featured_video_header = get_theme_mod( 'themotion_featured_video_header', esc_html__( 'Learn More About Us By Watching', 'themotion' ) );
	$themotion_featured_video        = get_theme_mod( 'themotion_featured_video_link', esc_url( 'https://vimeo.com/146792328' ) );

	if ( ! empty( $themotion_featured_video_header ) || ! empty( $themotion_featured_video ) ) {
	?>
	<div class="col-sm-12 col-md-12 col-lg-4 themotion-featured-video">
		<?php
	} elseif ( is_customize_preview() ) { ?>
		<div class="col-sm-12 col-md-12 col-lg-4 themotion-featured-video themotion-only-customizer">
			<?php
	}
	if ( ! empty( $themotion_featured_video_header ) || ! empty( $themotion_featured_video ) || is_customize_preview() ) {
		if ( ! empty( $themotion_featured_video_header ) ) { ?>
															<h3 class="widget-title"><?php echo wp_kses_post( $themotion_featured_video_header ); ?></h3>
															<?php
		} elseif ( is_customize_preview() ) { ?>
				<h3 class="widget-title themotion-only-customizer"></h3>
				<?php
		}

		if ( ! empty( $themotion_featured_video ) ) { ?>
													<div class="themotion-video">
													<?php
													if ( strlen( strstr( $themotion_featured_video, 'iframe' ) ) > 0 ) {
														echo html_entity_decode( $themotion_featured_video );
													} else {
														if ( preg_match( '/(\.mp4|\.avi|\.mov)$/', strtolower( $themotion_featured_video ) ) ) { ?>
															<video controls src='<?php echo esc_url( $themotion_featured_video ); ?>'></video>
															<?php
														} elseif ( strpos( $themotion_featured_video, 'youtube.com' ) != false ) {
															parse_str( parse_url( $themotion_featured_video, PHP_URL_QUERY ), $url_vars ); ?>
																<iframe width="420" height="240"
																		src="https://www.youtube.com/embed/<?php echo esc_html( $url_vars['v'] ); ?>"
																		frameborder="0" allowfullscreen></iframe>
																<?php
														} elseif ( strpos( $themotion_featured_video, 'vimeo.com' ) != false ) {
															$vimeo_id = (int) substr( parse_url( $themotion_featured_video, PHP_URL_PATH ), 1 ); ?>
																<iframe src="https://player.vimeo.com/video/<?php echo esc_html( $vimeo_id ); ?>"
																		width="420" height="240" frameborder="0" allowfullscreen></iframe>
																<?php
														}
													} ?>
															</div>
															<?php
		} else {
			if ( is_customize_preview() ) { ?>
					<div class="themotion-video themotion-only-customizer"></div>
					<?php
			}
		} ?>
		</div>
	<?php
	} ?>

		<div
			class="col-sm-12 col-md-12 <?php if ( ! empty( $themotion_featured_video_header ) || ! empty( $themotion_featured_video ) ) {
				echo 'col-lg-8';
} else {
	echo 'col-lg-12';
} ?> themotion-footer-right-side">
			<?php
			$themotion_quick_contact_header = get_theme_mod( 'themotion_quick_contact_header', esc_html__( 'Quick Contact', 'themotion' ) );
			$themotion_footer_contact       = get_theme_mod( 'themotion_footer_contact', json_encode( array(
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
			) ) );

			if ( ! empty( $themotion_quick_contact_header ) || ! empty( $themotion_footer_contact ) || is_active_sidebar( 'footer-widget-area' ) ) { ?>
			<div class="row themotion-footer-first-row">
				<?php
			} else {
				if ( is_customize_preview() ) { ?>
				<div class="row themotion-footer-first-row themotion-only-customizer">
					<?php
				}
			}

			if ( ! empty( $themotion_quick_contact_header ) || ! empty( $themotion_footer_contact ) || is_active_sidebar( 'footer-widget-area' ) || is_customize_preview() ) {

				if ( ! empty( $themotion_quick_contact_header ) || ! empty( $themotion_footer_contact ) ) { ?>
							<div class="col-sm-6 col-md-6 col-lg-6 themotion-footer-contact">
							<?php
				} else {
					if ( is_customize_preview() ) { ?>
								<div class="col-sm-6 col-md-6 col-lg-6 themotion-footer-contact themotion-only-customizer">
								<?php
					}
				}
				if ( ! empty( $themotion_quick_contact_header ) || ! empty( $themotion_footer_contact ) || is_customize_preview() ) {
					if ( ! empty( $themotion_quick_contact_header ) ) { ?>
							<h3 class="widget-title"><?php echo wp_kses_post( $themotion_quick_contact_header ); ?></h3>
							<?php
					} else {
						if ( is_customize_preview() ) { ?>
								<h3 class="widget-title themotion-only-customizer"></h3>
								<?php
						}
					}

					if ( ! empty( $themotion_footer_contact ) ) {
						$themotion_footer_contact_decoded = json_decode( $themotion_footer_contact, true ); ?>
							<ul class="menu-social-footer">
								<?php
								foreach ( $themotion_footer_contact_decoded as $themotion_footer_links ) {
									if ( ! empty( $themotion_footer_links['link'] ) && ! empty( $themotion_footer_links['text'] ) ) { ?>
										<li class="themotion-footer-link">
											<a href="<?php echo esc_url( $themotion_footer_links['link'] ); ?>"><?php echo wp_kses_post( $themotion_footer_links['text'] ); ?></a>
										</li>
										<?php
									}
								} ?>
							</ul>
							<?php
					} else {
						if ( is_customize_preview() ) { ?>
								<ul class="menu-social-footer themotion-only-customizer"></ul>
								<?php
						}
					} ?>

							</div> <!-- end .themotion-footer-contact -->
							<?php
				} ?>

						<div
					class="col-sm-6 col-md-6 <?php if ( ! empty( $themotion_quick_contact_header ) || ! empty( $themotion_footer_contact ) ) {
								echo 'col-lg-6';
} else {
	echo 'col-lg-12';
} ?> themotion-footer-sidebar">
	<?php
	if ( is_active_sidebar( 'footer-widget-area' ) ) {
		dynamic_sidebar( 'footer-widget-area' ); ?>
								<?php
	} else {
		if ( current_user_can( 'edit_theme_options' ) ) {
					the_widget( 'WP_Widget_Text',
						array(
							'title' => esc_html__( 'Default widget', 'themotion' ),
							'text'  => ( is_customize_preview() ?
								esc_html__( 'To change this, add your widget in Customize -> Widgets -> Footer Single Widget Area', 'themotion' ) :
								sprintf( __( 'To change this, add your widget in <a class="link-to-customizer" href="%s">Customize -> Widgets</a> -> Footer Single Widget Area .', 'themotion' ),
								admin_url( 'customize.php?autofocus[panel]=widgets' ) )
							),
						),
						array(
							'before_widget' => '<section class="widget">',
							'after_widget'  => '</section>',
							'before_title'  => '<h2 class="widget-title">',
							'after_title'   => '</h2>',
						)
					);
		}
	}
	?>
</div>
</div> <!-- end .themotion-footer-first-row -->
<?php
			} ?>

					<?php
					$themotion_footer_call_to_action_title       = get_theme_mod( 'themotion_footer_call_to_action_title', esc_html__( 'Videos Delivered', 'themotion' ) );
					$themotion_footer_call_to_action_text        = get_theme_mod( 'themotion_footer_call_to_action_text', esc_html__( 'Videos delivered to your inbox the day we post.', 'themotion' ) );
					$themotion_footer_call_to_action_button_text = get_theme_mod( 'themotion_footer_call_to_action_button_text', esc_html__( 'Subscribe', 'themotion' ) );
					$themotion_footer_call_to_action_button_link = get_theme_mod( 'themotion_footer_call_to_action_button_link', '#' );
					if ( ! empty( $themotion_footer_call_to_action_button_link ) && strpos( $themotion_footer_call_to_action_button_link, '#' ) === 0 ) {
						$themotion_go_to = 'href="#" onclick="return false;" data-anchor="' . $themotion_footer_call_to_action_button_link . '"';
					} else {
						$themotion_go_to = 'href="' . esc_url( $themotion_footer_call_to_action_button_link ) . '"';
					}

					if ( ! empty( $themotion_footer_call_to_action_title ) || ! empty( $themotion_footer_call_to_action_text ) || ! empty( $themotion_footer_call_to_action_button_text ) ) { ?>
					<div class="row themotion-footer-second-row">
						<?php
					} elseif ( is_customize_preview() ) { ?>
						<div class="row themotion-footer-second-row themotion-only-customizer">
							<?php
					}
					if ( ! empty( $themotion_footer_call_to_action_title ) || ! empty( $themotion_footer_call_to_action_text ) || ! empty( $themotion_footer_call_to_action_button_text ) || is_customize_preview() ) { ?>

							<div class="col-sm-12 col-md-12 col-lg-12 themotion-footer-call-to-action">
								<div class="footer-cta-text-wrapper">
									<?php
									if ( ! empty( $themotion_footer_call_to_action_title ) ) { ?>
										<h3 class="widget-title"><?php echo wp_kses_post( $themotion_footer_call_to_action_title ); ?></h3>
										<?php
									} elseif ( is_customize_preview() ) { ?>
										<h3 class="widget-title themotion-only-customizer"></h3>
										<?php
									}

									if ( ! empty( $themotion_footer_call_to_action_text ) ) { ?>
										<p><?php echo wp_kses_post( $themotion_footer_call_to_action_text ); ?></p>
										<?php
									} elseif ( is_customize_preview() ) { ?>
										<p class="themotion-only-customizer"></p>
										<?php
									} ?>
								</div>
								<?php
								if ( ! empty( $themotion_footer_call_to_action_button_text ) && ! empty( $themotion_footer_call_to_action_button_link ) ) { ?>
									<a <?php echo esc_attr( $themotion_go_to ); ?>
										class="btn outlined"><?php echo wp_kses_post( $themotion_footer_call_to_action_button_text ); ?></a>
									<?php
								} elseif ( is_customize_preview() ) { ?>
									<a class="btn outlined themotion-only-customizer"></a>
									<?php
								} ?>

							</div>
						</div>
					<?php
					} ?>
					</div> <!-- end .themotion-footer-right-side -->
				</div><!-- end .row -->
