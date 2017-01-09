<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package themotion
 */

if ( ! function_exists( 'themotion_top_area' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function themotion_top_area() {
		$header_image = get_header_image();
		$themotion_home_b_header_text = get_theme_mod( 'themotion_home_b_header_text', esc_html__( 'A collection of high quality videos focused on putting your business in motion.','themotion' ) );
		$themotion_home_b_button_text = get_theme_mod( 'themotion_home_b_button_text',esc_html__( 'See all videos','themotion' ) );
		$themotion_home_b_button_link = get_theme_mod( 'themotion_home_b_button_link' );

		if ( ! empty( $themotion_home_b_button_link ) && substr( $themotion_home_b_button_link, 0, 1 ) === '#' ) {
			$themotion_go_to = 'href="#" onclick="return false;" data-anchor="' . $themotion_home_b_button_link . '"';
		} else {
			$themotion_go_to = 'href="' . esc_url( $themotion_home_b_button_link ) . '"';
		}
		if ( ! empty( $themotion_home_b_header_text ) || ! empty( $themotion_home_b_button_text ) || ! empty( $header_image ) ) {  ?>
				<section id="top" class="home-section home-top-area">
				<?php
		} else {
			if ( is_customize_preview() ) {  ?>
					<section id="top" class="home-section home-top-area themotion-only-customizer">
					<?php
			}
		}

		if ( ! empty( $themotion_home_b_header_text ) || ! empty( $themotion_home_b_button_text ) || ! empty( $header_image ) || is_customize_preview() ) {  ?>
					<div class="container">
						<div class="home-top-area-inner">
							<?php
							if ( ! empty( $themotion_home_b_header_text ) ) {  ?>
								<h1><?php echo esc_html( $themotion_home_b_header_text ); ?></h1>
							<?php
							} else {
								if ( is_customize_preview() ) {  ?>
									<h1></h1>
								<?php
								}
							}

							if ( ! empty( $themotion_home_b_button_text ) ) {  ?>
								<a <?php if ( ! empty( $themotion_go_to ) ) {  echo esc_attr( $themotion_go_to ); } ?> class="btn themotion-scroll-to-section"><?php echo esc_html( $themotion_home_b_button_text ); ?></a>
							<?php
							} else {
								if ( is_customize_preview() ) {  ?>
									<a <?php if ( ! empty( $themotion_go_to ) ) {  echo esc_attr( $themotion_go_to ); } ?>></a>
								<?php
								}
							} ?>
						</div>
					</div>
				</section>
		<?php
		themotion_happy_three_videos();
		}
	}
endif;


/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function themotion_happy_three_videos() {
	$header_image = get_header_image();
	$themotion_show_videos = get_theme_mod( 'themotion_show_videos' );
	$themotion_video_category = get_theme_mod( 'themotion_video_category' );
	$themotion_home_b_header_text = get_theme_mod( 'themotion_home_b_header_text', esc_html__( 'A collection of high quality videos focused on putting your business in motion.','themotion' ) );
	$themotion_home_b_button_text = get_theme_mod( 'themotion_home_b_button_text',esc_html__( 'See all videos','themotion' ) );

	if ( isset( $themotion_show_videos ) && 1 != $themotion_show_videos ) {

		$args = array(
			'post_type'			=> 'post',
			'posts_per_page'	=> '-1',
			'category_name'		=> ! empty( $themotion_video_category ) && 'all' != $themotion_video_category ? esc_html( $themotion_video_category ) : '',
		);

		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() && ( ! empty( $themotion_home_b_header_text ) || ! empty( $themotion_home_b_button_text ) || ! empty( $header_image )) ) {
				?>
				<section id="videos" class="home-section home-three-videos">
				<?php
		} else {
			if ( is_customize_preview() ) {  ?>
				<section id="videos" class="home-section home-three-videos themotion-only-customizer">
					<?php
			}
		}

		if ( $the_query->have_posts() && ( ! empty( $themotion_home_b_header_text ) || ! empty( $themotion_home_b_button_text ) || ! empty( $header_image ) || is_customize_preview() ) ) {  ?>
				<div class="container">
					<?php
					$post_count = 0;
					while ( $the_query->have_posts() ) {
						$the_query->the_post();

						if ( 3 == $post_count ) {
							break;
						}
						if ( has_post_format( 'video' ) ) {
							if ( has_post_thumbnail() ) { ?>
								<div class="themotion-pageb-videos">
									<?php
									the_post_thumbnail( 'themotion-post-thumbnail' ); ?>
									<span class="themotion-video-play-button">
										<i class="mejs-overlay-button themotion-play-icon"></i>
									</span>
								</div>
								<div class="themotion-lightbox">
									<div class="themotion-lightbox-inner">
										<?php
										$post = get_post();
										$content = apply_filters( 'the_content', $post->post_content );
										$embeds = get_media_embedded_in_content( $content );
										if ( ! empty( $embeds ) ) {
											echo themotion_escape_lightbox( $embeds[0] );
										} ?>
									</div>
								</div>
								<?php
							} else {
								$id = get_the_ID();
								$post = get_post( $id );
								$content = apply_filters( 'the_content', $post->post_content );
								$embeds = get_media_embedded_in_content( $content );

								if ( ! empty( $embeds ) ) {  ?>
									<div class="themotion-pageb-videos home-three-videos-item">
										<?php
										echo themotion_escape_lightbox( $embeds[0] ); ?>
									</div>
								<?php
								}
							}
							$post_count++;
						}
					} ?>
				</div>
			</section>
		<?php
		}
		wp_reset_postdata();
	}
}

if ( ! function_exists( 'themotion_has_three_videos_section' ) ) :
	/**
	 * Check if the section with three videos on home B exist
	 *
	 * @return bool
	 */
	function themotion_has_three_videos_section() {
		$themotion_show_videos = get_theme_mod( 'themotion_show_videos', false );
		if ( isset( $themotion_show_videos ) && true !== $themotion_show_videos ) {
			$themotion_video_category = get_theme_mod( 'themotion_video_category' );
			$args = array(
			'post_type'			=> 'post',
			'posts_per_page'	=> '-1',
			'category_name'		=> ! empty( $themotion_video_category ) && 'all' !== $themotion_video_category ? esc_html( $themotion_video_category ) : '',
			);

			$the_query = new WP_Query( $args );

			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					if ( has_post_format( 'video' ) ) {
						return true;
						break;
					}
				}
			}
			wp_reset_postdata();
		}

		return false;
	}
endif;

if ( ! function_exists( 'themotion_template_two_posts_header' ) ) :

	/**
	 * Function to display the header of posts on home template two]
	 */
	function themotion_template_two_posts_header() {
		$themotion_bottom_posts_title = get_theme_mod( 'themotion_bottom_posts_title', esc_html__( 'Recently Posted', 'themotion' ) );
		if ( ! empty( $themotion_bottom_posts_title ) ) { ?>
			<h3 class="recently-posted-title"><?php echo wp_kses_post( $themotion_bottom_posts_title ); ?></h3>
			<?php
		} else {
			if ( is_customize_preview() ) { ?>
				<h3 class="recently-posted-title themotion-only-customizer"></h3>
				<?php
			}
		}
	}
endif;


if ( ! function_exists( 'themotion_ribbon_intro' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function themotion_ribbon_intro() {

		$themotion_call_to_action_title = get_theme_mod( 'themotion_call_to_action_title', esc_html__( 'A CREATIVE + HELPFUL RESOURCE', 'themotion' ) );
		$themotion_call_to_action_text = get_theme_mod( 'themotion_call_to_action_text', esc_html__( 'We are a resource for creatives wanting to push their business forward. Using best practices and a keen eye, we curate this video feed for the business beginner and experienced alike.', 'themotion' ) );
		$themotion_call_to_action_button_text = get_theme_mod( 'themotion_call_to_action_button_text', esc_html__( 'Subscribe', 'themotion' ) );
		$themotion_call_to_action_button_link = get_theme_mod( 'themotion_call_to_action_button_link', '#' );

		if ( ! empty( $themotion_call_to_action_button_link ) && strpos( $themotion_call_to_action_button_link, '#' ) == 0 ) {
			$themotion_go_to = 'href="#" onclick="return false;" data-anchor="' . $themotion_call_to_action_button_link . '"';
		} else {
			$themotion_go_to = 'href="' . esc_url( $themotion_call_to_action_button_link ) . '"';
		} ?>

				<section id="ribbon" class="home-section home-ribbon-intro">
				<div class="container">
				<div class="home-ribbon-intro-inner-wrap">
				<div class="home-ribbon-intro-inner">
					<?php
					if ( ! empty( $themotion_call_to_action_title ) ) {  ?>
						<h2><?php echo esc_html( $themotion_call_to_action_title ); ?></h2>
						<?php
					} else {
						if ( is_customize_preview() ) { ?>
							<h2 class="themotion-only-customizer"></h2>
							<?php
						}
					}

					if ( ! empty( $themotion_call_to_action_text ) ) {  ?>
							<div class="home-ribbon-intro-container">
								<p><?php echo esc_html( $themotion_call_to_action_text ); ?></p>
							</div>
							<?php
					} else {
						if ( is_customize_preview() ) { ?>
								<div class="home-ribbon-intro-container themotion-only-customizer">
									<p></p>
								</div>
								<?php
						}
					} ?>
							</div>
				
							<?php
							if ( ! empty( $themotion_call_to_action_button_text ) && ! empty( $themotion_call_to_action_button_link ) ) {  ?>
								<div class="home-ribbon-intro-btn">
									<a href = "<?php if ( ! empty( $themotion_go_to ) ) {  echo esc_attr( $themotion_go_to ); } ?>" class="btn outlined themotion-scroll-to-section"><?php echo esc_html( $themotion_call_to_action_button_text ); ?></a>
								</div>
								<?php
							} else {
								if ( is_customize_preview() ) { ?>
									<div class="home-ribbon-intro-btn themotion-only-customizer">
										<a <?php if ( ! empty( $themotion_go_to ) ) {  echo esc_attr( $themotion_go_to ); } else { echo 'href="#"'; } ?> class="btn outlined themotion-scroll-to-section">
											<?php echo esc_html( $themotion_call_to_action_button_text ); ?>
										</a>
									</div>
									<?php
								}
							} ?>
									</div>
									</div>
									</section>
									<?php
	}
endif;



if ( ! function_exists( 'themotion_about_top' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function themotion_about_top() {

		$themotion_about_header_image = get_theme_mod( 'themotion_about_header_image', esc_url( get_template_directory_uri() . '/images/about.jpg' ) );
		$themotion_about_header_text = get_theme_mod( 'themotion_about_header_text', esc_html__( 'We are curators striving to help you Put Business In Motion','themotion' ) );
		$themotion_about_button_text = get_theme_mod( 'themotion_about_button_text',esc_html__( 'See all videos','themotion' ) );
		$themotion_about_button_link = get_theme_mod( 'themotion_about_button_link' );
		if ( ! empty( $themotion_about_button_link ) && strpos( $themotion_about_button_link, '#' ) == 0 ) {
			$themotion_go_to = 'href="#" onclick="return false;" data-anchor="' . $themotion_about_button_link . '"';
		} else {
			$themotion_go_to = 'href="' . esc_url( $themotion_about_button_link ) . '"';
		}

		if ( ! empty( $themotion_about_header_image ) || ! empty( $themotion_about_header_text ) || ! empty( $themotion_about_button_text ) ) {  ?>
				<section id="top" class="about-section about-top-area" <?php echo ( ! empty( $themotion_about_header_image ) ? 'style="background-image: url(' . esc_url( $themotion_about_header_image ) . ');"' : '' ) ?>>
				<?php
		} else {
			if ( is_customize_preview() ) { ?>
					<section id="top" class="about-section about-top-area themotion-only-customizer">
					<?php
			}
		}
		if ( ! empty( $themotion_about_header_image ) || ! empty( $themotion_about_header_text ) || ! empty( $themotion_about_button_text ) || is_customize_preview() ) {  ?>
					<div class="container">
						<div class="about-top-area-inner">
							<?php
							if ( ! empty( $themotion_about_header_text ) ) {  ?>
								<h1><?php echo esc_html( $themotion_about_header_text ); ?></h1>
								<?php
							} else {
								if ( is_customize_preview() ) {  ?>
									<h1></h1>
									<?php
								}
							}

							if ( ! empty( $themotion_about_button_text ) ) {  ?>
								<a <?php if ( ! empty( $themotion_go_to ) ) {  echo esc_attr( $themotion_go_to ); } ?> class="btn themotion-scroll-to-section"><?php echo esc_html( $themotion_about_button_text ); ?></a>
								<?php
							} else {
								if ( is_customize_preview() ) {  ?>
									<a <?php if ( ! empty( $themotion_go_to ) ) {  echo esc_attr( $themotion_go_to ); } ?>></a>
									<?php
								}
							} ?>
						</div>
					</div>
				</section>
	
		<?php
		}
	}
endif;


/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function themotion_info_block() {
	$themotion_about_b1_title = get_theme_mod( 'themotion_about_b1_title', esc_html__( 'Our mission', 'themotion' ) );
	$themotion_about_b1_text  = get_theme_mod( 'themotion_about_b1_text', esc_html__( 'We are a resource for creatives wanting to push their business forward. Using best practices and a keen eye, we curated this video feed for the business beginner and experienced alike.', 'themotion' ) );
	$themotion_about_b2_title = get_theme_mod( 'themotion_about_b2_title', esc_html__( 'Why the motion', 'themotion' ) );
	$themotion_about_b2_text  = get_theme_mod( 'themotion_about_b2_text', esc_html__( 'Using best practices and a keen eye, we curated this video feed for the business beginner and experienced alike. We are a resource for creatives wanting to push their business forward.', 'themotion' ) ); ?>

		<section id="block" class="about-section info-block <?php if ( empty( $themotion_about_b1_title ) && empty( $themotion_about_b1_text ) && empty( $themotion_about_b2_title ) && empty( $themotion_about_b2_text ) ) { echo 'themotion-only-customizer'; } ?>">
			<div class="container">

				<div class="info-block-item-wrap">
					<div class="col-md-6 info-block-item block-left">
						<?php
						if ( ! empty( $themotion_about_b1_title ) ) { ?>
							<h3 class="info-block-title"><?php echo wp_kses_post( $themotion_about_b1_title ); ?></h3>
							<?php
						} else {
							if ( is_customize_preview() ) { ?>
								<h3 class="info-block-title themotion-only-customizer"></h3>
								<?php
							}
						}

						if ( ! empty( $themotion_about_b1_text ) ) { ?>
							<div class="info-block-content">
								<p><?php echo wp_kses_post( $themotion_about_b1_text ); ?></p>
							</div>
							<?php
						} else {
							if ( is_customize_preview() ) { ?>
								<div class="info-block-content themotion-only-customizer">
									<p></p>
								</div>
								<?php
							}
						} ?>
					</div>

					<div class="col-md-6 info-block-item block-right">
						<?php
						if ( ! empty( $themotion_about_b2_title ) ) { ?>
							<h3 class="info-block-title"><?php echo wp_kses_post( $themotion_about_b2_title ); ?></h3>
							<?php
						} else {
							if ( is_customize_preview() ) { ?>
								<h3 class="info-block-title themotion-only-customizer"></h3>
								<?php
							}
						}
						if ( ! empty( $themotion_about_b2_text ) ) { ?>
							<div class="info-block-content">
								<p><?php echo wp_kses_post( $themotion_about_b2_text ); ?></p>
							</div>
							<?php
						} else {
							if ( is_customize_preview() ) { ?>
								<div class="info-block-content themotion-only-customizer">
									<p></p>
								</div>
								<?php
							}
						} ?>
					</div>
				</div>

			</div>
		</section>
		<?php
}




if ( ! function_exists( 'themotion_stats' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function themotion_stats() {
		$themotion_show_stats = get_theme_mod( 'themotion_show_stats' );
		$themotion_about_stats_one_number = get_theme_mod( 'themotion_about_stats_one_number','7247' );
		$themotion_about_stats_one_text = get_theme_mod( 'themotion_about_stats_one_text', esc_html__( 'Users', 'themotion' ) );
		$themotion_about_stats_two_number = get_theme_mod( 'themotion_about_stats_two_number','654' );
		$themotion_about_stats_two_text = get_theme_mod( 'themotion_about_stats_two_text',esc_html__( 'Videos','themotion' ) );
		$themotion_about_stats_three_number = get_theme_mod( 'themotion_about_stats_three_number','11582' );
		$themotion_about_stats_three_text = get_theme_mod( 'themotion_about_stats_three_text',esc_html__( 'Likes','themotion' ) );
		$themotion_about_stats_four_number = get_theme_mod( 'themotion_about_stats_four_number','923' );
		$themotion_about_stats_four_text = get_theme_mod( 'themotion_about_stats_four_text',esc_html__( 'Shares','themotion' ) );
		if ( isset( $themotion_show_stats ) && 1 != $themotion_show_stats ) { ?>
			<section id="stats" class="about-section stats">
			<?php
		} else {
			if ( is_customize_preview() ) { ?>
				<section id="stats" class="about-section stats themotion-only-customizer">
				<?php
			}
		}
		if ( (isset( $themotion_show_stats ) && 1 != $themotion_show_stats ) || is_customize_preview() ) {?>
				<div class="container">

					<div class="statistics">
						<?php
						/*Stats ONE*/
						if ( ! empty( $themotion_about_stats_one_number ) || ! empty( $themotion_about_stats_one_text ) ) { ?>
							<div class="stat-item stat-1">
							<?php
						} else {
							if ( is_customize_preview() ) { ?>
								<div class="stat-item stat-1 themotion-only-customizer">
								<?php
							}
						}

						if ( ! empty( $themotion_about_stats_one_number ) || ! empty( $themotion_about_stats_one_text ) || is_customize_preview() ) { ?>
							<p>
								<span class="stat-number">
									<?php
									if ( ! empty( $themotion_about_stats_one_number ) ) {
										echo esc_attr( number_format( $themotion_about_stats_one_number ) );
									} ?>
								</span>
								<span class="stat-text">
									<?php
									if ( ! empty( $themotion_about_stats_one_text ) ) {
										echo wp_kses_post( $themotion_about_stats_one_text );
									} ?>
								</span>
							</p>
							</div>
							<?php
						}

						/*Stats TWO*/
						if ( ! empty( $themotion_about_stats_two_number ) || ! empty( $themotion_about_stats_two_text ) ) { ?>
							<div class="stat-item stat-2">
								<?php
						} else {
							if ( is_customize_preview() ) { ?>
								<div class="stat-item stat-2 themotion-only-customizer">
								<?php
							}
						}

						if ( ! empty( $themotion_about_stats_two_number ) || ! empty( $themotion_about_stats_two_text ) || is_customize_preview() ) { ?>
							<p>
								<span class="stat-number">
									<?php
									if ( ! empty( $themotion_about_stats_two_number ) ) {
										echo esc_attr( number_format( $themotion_about_stats_two_number ) );
									} ?>
								</span>
								<span class="stat-text">
									<?php
									if ( ! empty( $themotion_about_stats_two_text ) ) {
										echo wp_kses_post( $themotion_about_stats_two_text );
									} ?>
								</span>
							</p>
							</div>
							<?php
						}

						/*Stats THREE*/
						if ( ! empty( $themotion_about_stats_three_number ) || ! empty( $themotion_about_stats_three_text ) ) { ?>
							<div class="stat-item stat-3">
							<?php
						} else {
							if ( is_customize_preview() ) { ?>
								<div class="stat-item stat-3 themotion-only-customizer">
								<?php
							}
						}

						if ( ! empty( $themotion_about_stats_three_number ) || ! empty( $themotion_about_stats_three_text ) || is_customize_preview() ) { ?>
							<p>
								<span class="stat-number">
									<?php
									if ( ! empty( $themotion_about_stats_three_number ) ) {
										echo esc_attr( number_format( $themotion_about_stats_three_number ) );
									} ?>
								</span>
								<span class="stat-text">
									<?php
									if ( ! empty( $themotion_about_stats_three_text ) ) {
										echo wp_kses_post( $themotion_about_stats_three_text );
									} ?>
								</span>
							</p>
							</div>
							<?php
						}

						/*Stats FOUR*/
						if ( ! empty( $themotion_about_stats_four_number ) || ! empty( $themotion_about_stats_four_text ) ) { ?>
							<div class="stat-item stat-4">
							<?php
						} else {
							if ( is_customize_preview() ) { ?>
								<div class="stat-item stat-4 themotion-only-customizer">
							<?php
							}
						}

						if ( ! empty( $themotion_about_stats_four_number ) || ! empty( $themotion_about_stats_four_text ) || is_customize_preview() ) { ?>
							<p>
								<span class="stat-number">
									<?php
									if ( ! empty( $themotion_about_stats_four_number ) ) {
										echo esc_attr( number_format( $themotion_about_stats_four_number ) );
									} ?>
								</span>
								<span class="stat-text">
									<?php
									if ( ! empty( $themotion_about_stats_four_text ) ) {
										echo wp_kses_post( $themotion_about_stats_four_text );
									} ?>
								</span>
							</p>
							</div>
							<?php
						} ?>
					</div>
				</div>
			</section>
		<?php
		}
	}
endif;



if ( ! function_exists( 'themotion_testimonial' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function themotion_testimonial() {
		$themotion_show_testimony = get_theme_mod( 'themotion_show_testimony' );
		$themotion_testimony_avatar = get_theme_mod( 'themotion_testimony_avatar',get_template_directory_uri() . '/images/avatar.jpg' );
		$themotion_testimony_text = get_theme_mod( 'themotion_testimony_text',esc_html__( 'In Motion has helped me grow my business by over 10% in the past month. The videos are helpful, easy to follow and are beautifully made. Overall this is a fantastic resource!','themotion' ) );
		$themotion_testimony_subtext = get_theme_mod( 'themotion_testimony_subtext',esc_html__( 'ASH S. - SMALL BUSINESS OWNER','themotion' ) );

		if ( isset( $themotion_show_testimony ) && 1 != $themotion_show_testimony ) { ?>
			<section id="testimonial" class="about-section testimonial-area <?php if ( empty( $themotion_testimony_avatar ) && empty( $themotion_testimony_text ) && empty( $themotion_testimony_subtext ) ) { echo 'themotion-only-customizer'; } ?>">
		<?php
		} else {
			if ( is_customize_preview() ) { ?>
				<section id="testimonial" class="about-section testimonial-area themotion-only-customizer">
				<?php
			}
		}

		if ( (isset( $themotion_show_testimony ) && 1 != $themotion_show_testimony ) || is_customize_preview() ) { ?>
			<div class="container">
				<?php
				if ( ! empty( $themotion_testimony_avatar ) ) {  ?>
					<div class="testimonial-avatar" style="background-image: url(<?php echo esc_url( $themotion_testimony_avatar ); ?>);"></div>
					<?php
				} else {
					if ( is_customize_preview() ) { ?>
					   <div class="testimonial-avatar themotion-only-customizer" style=""></div>
					<?php
					}
				}

				if ( ! empty( $themotion_testimony_text ) ) {  ?>
					<div class="testimonial-content">
						<?php echo wp_kses_post( $themotion_testimony_text ); ?>
					</div>
					<?php
				} else {
					if ( is_customize_preview() ) { ?>
						<div class="testimonial-content themotion-only-customizer"></div>
					<?php
					}
				}

				if ( ! empty( $themotion_testimony_subtext ) ) {  ?>
					<h3 class="testimonial-author">
						<?php echo wp_kses_post( $themotion_testimony_subtext ); ?>
					</h3>
					<?php
				} else {
					if ( is_customize_preview() ) { ?>
						<h3 class="testimonial-author themotion-only-customizer"></h3>
						<?php
					}
				} ?>
			</div>
		</section>
	<?php
		}
	}
endif;


if ( ! function_exists( 'themotion_contact_top' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function themotion_contact_top() {

		$themotion_contact_header_image = get_theme_mod( 'themotion_contact_header_image', esc_url( get_template_directory_uri() . '/images/contact.jpg' ) );
		$themotion_contact_header_text = get_theme_mod( 'themotion_contact_header_text', esc_html__( 'FEEL FREE TO CONTACT US WITH ANY QUESTIONS OR COMMENTS','themotion' ) );
		$themotion_contact_button_text = get_theme_mod( 'themotion_contact_button_text', esc_html__( 'Send us an email','themotion' ) );
		$themotion_contact_button_link = get_theme_mod( 'themotion_contact_button_link' );
		if ( ! empty( $themotion_contact_button_link ) && strpos( $themotion_contact_button_link, '#' ) == 0 ) {
			$themotion_go_to = 'href="#" onclick="return false;" data-anchor="' . $themotion_contact_button_link . '"';
		} else {
			$themotion_go_to = 'href="' . esc_url( $themotion_contact_button_link ) . '"';
		}
		if ( ! empty( $themotion_contact_header_image ) || ! empty( $themotion_contact_header_text ) || ! empty( $themotion_contact_button_text ) ) { ?>
				<section id="top" class="contact-section about-top-area" <?php echo ( ! empty( $themotion_contact_header_image ) ? 'style="background-image: url(' . esc_url( $themotion_contact_header_image ) . ');"' : '' ) ?>>
				<?php
		} else {
			if ( is_customize_preview() ) { ?>
					<section id="top" class="contact-section about-top-area themotion-only-customizer">
					<?php
			}
		}

		if ( ! empty( $themotion_contact_header_image ) || ! empty( $themotion_contact_header_text ) || ! empty( $themotion_contact_button_text ) || is_customize_preview() ) {  ?>
				<div class="container">
					<div class="about-top-area-inner">
						<?php
						if ( ! empty( $themotion_contact_header_text ) ) {  ?>
							<h1><?php echo esc_html( $themotion_contact_header_text ); ?></h1>
							<?php
						} else {
							if ( is_customize_preview() ) {  ?>
								<h1></h1>
								<?php
							}
						}

						if ( ! empty( $themotion_contact_button_text ) ) {  ?>
							<a <?php if ( ! empty( $themotion_go_to ) ) {  echo esc_attr( $themotion_go_to ); } ?> class="btn themotion-scroll-to-section"><?php echo esc_html( $themotion_contact_button_text ); ?></a>
							<?php
						} else {
							if ( is_customize_preview() ) {  ?>
								<a <?php if ( ! empty( $themotion_go_to ) ) {  echo esc_attr( $themotion_go_to ); } ?>></a>
								<?php
							}
						} ?>
					</div>
				</div>
			</section>
		<?php
		}
	}
endif;



if ( ! function_exists( 'themotion_contact_block' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function themotion_contact_block() {

		$themotion_contact_cl_title = get_theme_mod( 'themotion_contact_cl_title', esc_html__( 'Why the.motion','themotion' ) );
		$themotion_contact_cl_text = get_theme_mod( 'themotion_contact_cl_text', esc_html__( 'Using best practices and a keen eye, we curated this video feed for the business beginner and experienced alike. We are a resource for creatives wanting to push their business forward.','themotion' ) );
		$themotion_contact_cr_title = get_theme_mod( 'themotion_contact_cr_title', esc_html__( 'Get in touch','themotion' ) );
		$themotion_contact_cr_b1_title = get_theme_mod( 'themotion_contact_cr_b1_title', esc_html__( 'The.Motion Headquarters','themotion' ) );
		$themotion_contact_cr_b1_text = get_theme_mod( 'themotion_contact_cr_b1_text', esc_html__( '329 South Street Court - Albany, NY 83741','themotion' ) );
		$themotion_contact_cr_b1_email = get_theme_mod( 'themotion_contact_cr_b1_email', esc_html__( 'start@themotion.com','themotion' ) );
		$themotion_contact_cr_b1_phone = get_theme_mod( 'themotion_contact_cr_b1_phone', esc_html__( '(432) 203-3321','themotion' ) );
		$themotion_contact_cr_b2_title = get_theme_mod( 'themotion_contact_cr_b2_title', esc_html__( 'THE.MOTION VIDEO RECORDING','themotion' ) );
		$themotion_contact_cr_b2_text = get_theme_mod( 'themotion_contact_cr_b2_text', esc_html__( '153 East Fifth Avenue - New York, NY 83741','themotion' ) );
		$themotion_contact_cr_b2_email = get_theme_mod( 'themotion_contact_cr_b2_email', esc_html__( 'recording@themotion.com','themotion' ) );
		$themotion_contact_cr_b2_phone = get_theme_mod( 'themotion_contact_cr_b2_phone', esc_html__( '(324) 923-8321','themotion' ) );
		$themotion_contact_hide_socials = get_theme_mod( 'themotion_contact_hide_socials' );
	?>

		<section id="contact" class="contact-section contact-block">
			<div class="container">


				<div class="contact-block-item-wrap">
					<?php
					if ( ! empty( $themotion_contact_cr_title ) || ! empty( $themotion_contact_cr_b1_title ) || ! empty( $themotion_contact_cr_b1_text )
								|| ! empty( $themotion_contact_cr_b1_email ) || ! empty( $themotion_contact_cr_b1_phone ) || ! empty( $themotion_contact_cr_b2_title )
								|| ! empty( $themotion_contact_cr_b2_text ) || ! empty( $themotion_contact_cr_b2_email ) || ! empty( $themotion_contact_cr_b2_phone ) ) {
									$class_to_add = 'col-md-6';
					} else {
						$class_to_add = 'col-md-12';
					}
					if ( ! isset( $themotion_contact_hide_socials ) || 1 != $themotion_contact_hide_socials || ! empty( $themotion_contact_cl_title ) || ! empty( $themotion_contact_cl_text ) ) {  ?>
						<div class="<?php echo esc_attr( $class_to_add ); ?> contact-block-item contact-block-left">
							<?php
							if ( ! empty( $themotion_contact_cl_title ) ) {  ?>
								<h3 class="contact-block-title"><?php echo wp_kses_post( $themotion_contact_cl_title ); ?></h3>
								<?php
							} else {
								if ( is_customize_preview() ) { ?>
									<h3 class="contact-block-title themotion-only-customizer"></h3>
									<?php
								}
							}?>

							<div class="contact-block-content">
								<?php
								if ( ! empty( $themotion_contact_cl_text ) ) { ?>
									<p><?php echo wp_kses_post( $themotion_contact_cl_text ); ?></p>
									<?php
								} else {
									if ( is_customize_preview() ) {  ?>
										<p class="themotion-only-customizer"></p>
										<?php
									}
								}

								if ( ! isset( $themotion_contact_hide_socials ) || 1 != $themotion_contact_hide_socials ) { ?>
									<ul class="social-media-icons" >
								<?php
								} else {
									if ( is_customize_preview() ) { ?>
										<ul class="social-media-icons themotion-only-customizer">
										<?php
									}
								}
								if ( ! isset( $themotion_contact_hide_socials ) || 1 != $themotion_contact_hide_socials || is_customize_preview() ) {
									themotion_social_icons(); ?>
									</ul>
									<?php
								} ?>
							</div>
						</div>
					<?php
					} else {
						if ( is_customize_preview() ) {  ?>
							<div class="<?php echo esc_attr( $class_to_add ); ?> contact-block-item contact-block-left themotion-only-customizer">
								<h3 class="contact-block-title"></h3>
								<div class="contact-block-content">
									<p></p>
									<ul class="social-media-icons"></ul>
								</div>
							</div>
							<?php
						}
					}

					if ( ! isset( $themotion_contact_hide_socials ) || 1 != $themotion_contact_hide_socials || ! empty( $themotion_contact_cl_text ) || ! empty( $themotion_contact_cl_title ) ) {
						$class_to_add = 'col-md-6';
					} else {
						$class_to_add = 'col-md-12';
					}
					if ( ! empty( $themotion_contact_cr_title ) || ! empty( $themotion_contact_cr_b1_title ) || ! empty( $themotion_contact_cr_b1_text )
								|| ! empty( $themotion_contact_cr_b1_email ) || ! empty( $themotion_contact_cr_b1_phone ) || ! empty( $themotion_contact_cr_b2_title )
								|| ! empty( $themotion_contact_cr_b2_text ) || ! empty( $themotion_contact_cr_b2_email ) || ! empty( $themotion_contact_cr_b2_phone ) ) {  ?>

						<div class="<?php echo esc_attr( $class_to_add ); ?> contact-block-item contact-block-right">
							<?php
							if ( ! empty( $themotion_contact_cr_title ) ) {  ?>
								<h3 class="contact-block-title"><?php echo wp_kses_post( $themotion_contact_cr_title ); ?></h3>
								<?php
							} else {
								if ( is_customize_preview() ) {  ?>
									<h3 class="contact-block-title themotion-only-customizer"></h3>
									<?php
								}
							} ?>


							<div class="contact-block-content-wrap">

								<div class="col-md-6 contact-block-content themotion-block-left">
									<?php
									if ( ! empty( $themotion_contact_cr_b1_title ) ) {  ?>
										<h6 class="contact-second-title"><?php echo wp_kses_post( $themotion_contact_cr_b1_title ); ?></h6>
										<?php
									} else {
										if ( is_customize_preview() ) {  ?>
											<h6 class="contact-second-title themotion-only-customizer"></h6>
											<?php
										}
									}

									if ( ! empty( $themotion_contact_cr_b1_text ) ) {  ?>
										<p class="themotion_contact_left"><?php echo wp_kses_post( $themotion_contact_cr_b1_text ); ?></p>
										<?php
									} else {
										if ( is_customize_preview() ) {  ?>
											<p class="themotion_contact_left themotion-only-customizer"></p>
											<?php
										}
									}

									if ( ! empty( $themotion_contact_cr_b1_email ) ) {  ?>
										<p class="contact-link contact-left-email"><a href="mailto:<?php echo wp_kses_post( $themotion_contact_cr_b1_email ); ?>"><?php echo wp_kses_post( $themotion_contact_cr_b1_email ); ?></a></p>
										<?php
									} else {
										if ( is_customize_preview() ) {  ?>
											<p class="contact-link contact-left-email themotion-only-customizer"><a href=""></a></p>
											<?php
										}
									}

									if ( ! empty( $themotion_contact_cr_b1_phone ) ) {  ?>
										<p class="contact-link contact-left-phone"><a href="tel:<?php echo wp_kses_post( $themotion_contact_cr_b1_phone ); ?>"><?php echo wp_kses_post( $themotion_contact_cr_b1_phone ); ?></a></p>
										<?php
									} else {
										if ( is_customize_preview() ) {  ?>
											<p class="contact-link contact-left-phone themotion-only-customizer"><a href=""></a></p>
											<?php
										}
									}
									?>
								</div>

								<div class="col-md-6 contact-block-content contact-block-content-second">
									<?php
									if ( ! empty( $themotion_contact_cr_b2_title ) ) {  ?>
										<h6 class="contact-second-title"><?php echo wp_kses_post( $themotion_contact_cr_b2_title ); ?></h6>
										<?php
									} else {
										if ( is_customize_preview() ) {  ?>
											<h6 class="contact-second-title themotion-only-customizer"></h6>
											<?php
										}
									}

									if ( ! empty( $themotion_contact_cr_b2_text ) ) {  ?>
										<p class="themotion_contact_right"><?php echo wp_kses_post( $themotion_contact_cr_b2_text ); ?></p>
										<?php
									} else {
										if ( is_customize_preview() ) {  ?>
											<p class="themotion_contact_right themotion-only-customizer"></p>
											<?php
										}
									}

									if ( ! empty( $themotion_contact_cr_b2_email ) ) {  ?>
										<p class="contact-link  contact-right-email"><a href="mailto:<?php echo wp_kses_post( $themotion_contact_cr_b2_email ); ?>"><?php echo wp_kses_post( $themotion_contact_cr_b2_email ); ?></a></p>
										<?php
									} else {
										if ( is_customize_preview() ) {  ?>
											<p class="contact-link contact-right-email themotion-only-customizer"><a href=""></a></p>
											<?php
										}
									}

									if ( ! empty( $themotion_contact_cr_b2_phone ) ) {  ?>
										<p class="contact-link contact-right-phone"><a href="tel:<?php echo wp_kses_post( $themotion_contact_cr_b2_phone ); ?>"><?php echo wp_kses_post( $themotion_contact_cr_b2_phone ); ?></a></p>
										<?php
									} else {
										if ( is_customize_preview() ) {  ?>
											<p class="contact-link contact-right-phone themotion-only-customizer"><a href=""></a></p>
											<?php
										}
									} ?>
								</div>
							</div>
						</div>
						<?php
					} else {
						if ( is_customize_preview() ) {  ?>
							<div class="<?php echo esc_attr( $class_to_add );?> contact-block-item contact-block-right themotion-only-customizer">
								<h3 class="contact-block-title"></h3>
								<div class="contact-block-content-wrap">
									<div class="col-md-6 contact-block-content themotion-block-left">
										<h6 class="contact-second-title"></h6>
										<p class="themotion_contact_left"></p>
										<p class="contact-link contact-left-email"><a href=""></a></p>
										<p class="contact-link contact-left-phone"><a href=""></a></p>
									</div>

									<div class="col-md-6 contact-block-content contact-block-content-second">
										<h6 class="contact-second-title"></h6>
										<p class="themotion_contact_right"></p>
										<p class="contact-link  contact-right-email"><a href=""></a></p>
										<p class="contact-link contact-right-phone"><a href=""></a></p>
									</div>
								</div>
							</div>
							<?php
						}
					}?>
				</div>
			</div>
		</section>

	<?php
	}
}

if ( ! function_exists( 'themotion_calendar_top' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function themotion_calendar_top() {

		$themotion_calendar_header_image = get_theme_mod( 'themotion_calendar_header_image', esc_url( get_template_directory_uri() . '/images/contact.jpg' ) );
		$themotion_calendar_header_text = get_theme_mod( 'themotion_calendar_header_text', esc_html__( 'FEEL FREE TO CONTACT US WITH ANY QUESTIONS OR COMMENTS','themotion' ) );
		if ( ! empty( $themotion_calendar_header_image ) || ! empty( $themotion_calendar_header_text ) || ! empty( $themotion_calendar_header_text ) ) { ?>
				<section id="top" class="contact-section about-top-area" <?php echo ( ! empty( $themotion_calendar_header_image ) ? 'style="background-image: url(' . esc_url( $themotion_calendar_header_image ) . ');"' : '' ) ?>>
				<?php
		} else {
			if ( is_customize_preview() ) { ?>
					<section id="top" class="contact-section about-top-area themotion-only-customizer">
					<?php
			}
		}

		if ( ! empty( $themotion_calendar_header_image ) || ! empty( $themotion_calendar_header_text ) || is_customize_preview() ) {  ?>
				<div class="container">
					<div class="about-top-area-inner">
						<?php
						if ( ! empty( $themotion_calendar_header_text ) ) {  ?>
							<h1><?php echo esc_html( $themotion_calendar_header_text ); ?></h1>
							<?php
						} else {
							if ( is_customize_preview() ) {  ?>
								<h1></h1>
								<?php
							}
						} ?>
					</div>
				</div>
			</section>
		<?php
		}
	}
endif;

if ( ! function_exists( 'themotion_inquiry_1_top' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function themotion_inquiry_1_top() {

		$themotion_inquiry_1_header_image = get_theme_mod( 'themotion_inquiry_1_header_image', esc_url( get_template_directory_uri() . '/images/contact.jpg' ) );
		$themotion_inquiry_1_header_text = get_theme_mod( 'themotion_inquiry_1_header_text', esc_html__( 'FEEL FREE TO CONTACT US WITH ANY QUESTIONS OR COMMENTS','themotion' ) );
		if ( ! empty( $themotion_inquiry_1_header_image ) || ! empty( $themotion_inquiry_1_header_text ) || ! empty( $themotion_inquiry_1_header_text ) ) { ?>
				<section id="top" class="contact-section about-top-area" <?php echo ( ! empty( $themotion_inquiry_1_header_image ) ? 'style="background-image: url(' . esc_url( $themotion_inquiry_1_header_image ) . ');"' : '' ) ?>>
				<?php
		} else {
			if ( is_customize_preview() ) { ?>
					<section id="top" class="contact-section about-top-area themotion-only-customizer">
					<?php
			}
		}

		if ( ! empty( $themotion_inquiry_1_header_image ) || ! empty( $themotion_inquiry_1_header_text ) || is_customize_preview() ) {  ?>
				<div class="container">
					<div class="about-top-area-inner">
						<?php
						if ( ! empty( $themotion_inquiry_1_header_text ) ) {  ?>
							<h1><?php echo esc_html( $themotion_inquiry_1_header_text ); ?></h1>
							<?php
						} else {
							if ( is_customize_preview() ) {  ?>
								<h1></h1>
								<?php
							}
						} ?>
					</div>
				</div>
			</section>
		<?php
		}
	}
endif;

if ( ! function_exists( 'themotion_inquiry_2_top' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function themotion_inquiry_2_top() {

		$themotion_inquiry_2_header_image = get_theme_mod( 'themotion_inquiry_2_header_image', esc_url( get_template_directory_uri() . '/images/contact.jpg' ) );
		$themotion_inquiry_2_header_text = get_theme_mod( 'themotion_inquiry_2_header_text', esc_html__( 'FEEL FREE TO CONTACT US WITH ANY QUESTIONS OR COMMENTS','themotion' ) );
		if ( ! empty( $themotion_inquiry_2_header_image ) || ! empty( $themotion_inquiry_2_header_text ) || ! empty( $themotion_inquiry_2_header_text ) ) { ?>
				<section id="top" class="contact-section about-top-area" <?php echo ( ! empty( $themotion_inquiry_2_header_image ) ? 'style="background-image: url(' . esc_url( $themotion_inquiry_2_header_image ) . ');"' : '' ) ?>>
				<?php
		} else {
			if ( is_customize_preview() ) { ?>
					<section id="top" class="contact-section about-top-area themotion-only-customizer">
					<?php
			}
		}

		if ( ! empty( $themotion_inquiry_2_header_image ) || ! empty( $themotion_inquiry_2_header_text ) || is_customize_preview() ) {  ?>
				<div class="container">
					<div class="about-top-area-inner">
						<?php
						if ( ! empty( $themotion_inquiry_2_header_text ) ) {  ?>
							<h1><?php echo esc_html( $themotion_inquiry_2_header_text ); ?></h1>
							<?php
						} else {
							if ( is_customize_preview() ) {  ?>
								<h1></h1>
								<?php
							}
						} ?>
					</div>
				</div>
			</section>
		<?php
		}
	}
endif;

if ( ! function_exists( 'themotion_inquiry_3_top' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function themotion_inquiry_3_top() {

		$themotion_inquiry_3_header_image = get_theme_mod( 'themotion_inquiry_3_header_image', esc_url( get_template_directory_uri() . '/images/contact.jpg' ) );
		$themotion_inquiry_3_header_text = get_theme_mod( 'themotion_inquiry_3_header_text', esc_html__( 'FEEL FREE TO CONTACT US WITH ANY QUESTIONS OR COMMENTS','themotion' ) );
		if ( ! empty( $themotion_inquiry_3_header_image ) || ! empty( $themotion_inquiry_3_header_text ) || ! empty( $themotion_inquiry_3_header_text ) ) { ?>
				<section id="top" class="contact-section about-top-area" <?php echo ( ! empty( $themotion_inquiry_3_header_image ) ? 'style="background-image: url(' . esc_url( $themotion_inquiry_3_header_image ) . ');"' : '' ) ?>>
				<?php
		} else {
			if ( is_customize_preview() ) { ?>
					<section id="top" class="contact-section about-top-area themotion-only-customizer">
					<?php
			}
		}

		if ( ! empty( $themotion_inquiry_3_header_image ) || ! empty( $themotion_inquiry_3_header_text ) || is_customize_preview() ) {  ?>
				<div class="container">
					<div class="about-top-area-inner">
						<?php
						if ( ! empty( $themotion_inquiry_3_header_text ) ) {  ?>
							<h1><?php echo esc_html( $themotion_inquiry_3_header_text ); ?></h1>
							<?php
						} else {
							if ( is_customize_preview() ) {  ?>
								<h1></h1>
								<?php
							}
						} ?>
					</div>
				</div>
			</section>
		<?php
		}
	}
endif;


if ( ! function_exists( 'themotion_services_top' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function themotion_services_top() {

		$themotion_services_header_image = get_theme_mod( 'themotion_services_header_image', esc_url( get_template_directory_uri() . '/images/contact.jpg' ) );
		$themotion_services_header_text = get_theme_mod( 'themotion_services_header_text', esc_html__( 'FEEL FREE TO CONTACT US WITH ANY QUESTIONS OR COMMENTS','themotion' ) );
		if ( ! empty( $themotion_services_header_image ) || ! empty( $themotion_services_header_text ) || ! empty( $themotion_services_header_text ) ) { ?>
				<section id="top" class="contact-section about-top-area" <?php echo ( ! empty( $themotion_services_header_image ) ? 'style="background-image: url(' . esc_url( $themotion_services_header_image ) . ');"' : '' ) ?>>
				<?php
		} else {
			if ( is_customize_preview() ) { ?>
					<section id="top" class="contact-section about-top-area themotion-only-customizer">
					<?php
			}
		}

		if ( ! empty( $themotion_services_header_image ) || ! empty( $themotion_services_header_text ) || ! empty( $themotion_calendar_button_text ) || is_customize_preview() ) {  ?>
				<div class="container">
					<div class="about-top-area-inner">
						<?php
						if ( ! empty( $themotion_services_header_text ) ) {  ?>
							<h1><?php echo esc_html( $themotion_services_header_text ); ?></h1>
							<?php
						} else {
							if ( is_customize_preview() ) {  ?>
								<h1></h1>
								<?php
							}
						} ?>
					</div>
				</div>
			</section>
		<?php
		}
	}
endif;

if ( ! function_exists( 'themotion_post_info' ) ) {
	/**
	 * Get post info.
	 */
	function themotion_post_info( $type, $post_id ) {
		if ( 'categories' == $type ) {
			$array_list = get_the_category( $post_id );
		} elseif ( 'tags' == $type ) {
			$array_list = wp_get_post_tags( $post_id );
		} elseif ( 'download_categories' == $type ) {
			$array_list = wp_get_post_terms( $post_id, 'download_category' );
		} elseif ( 'download_tags' == $type ) {
			$array_list = wp_get_post_terms( $post_id, 'download_tag' );
		}
		if ( ! empty( $array_list ) ) { ?>
			<div class="<?php if ( ( 'categories' == $type ) || ( 'download_categories' == $type ) ) { echo 'categories-links'; } elseif ( ( 'tags' == $type ) || ( 'download_tags' == $type ) ) { echo 'tags-links'; } ?>">
				<?php
				$i = 0;
				$len = count( $array_list );
				if ( ! empty( $array_list ) ) {
					foreach ( $array_list as $item ) {
						if ( 'categories' == $type ) {
							$label_link = get_category_link( $item->term_id );
						} else {
							$label_link = get_tag_link( $item->term_id );
						}
						if ( $i < 2 || $i > 2 ) { ?>
							<a href="<?php echo esc_url( $label_link ); ?>" rel="<?php if ( 'categories' == $type ) {  echo 'category'; } else { echo 'tag'; } ?>">
								<?php
								echo esc_html( $item->name ); ?>
							</a>
							<?php
							if ( $i != $len -1 && $i != 1 ) {
								echo esc_html__( ',', 'themotion' );
							}
						}

						if ( $i == 2 ) { ?>
							<span class="themotion-show-on-click" title="<?php esc_html_e( 'Show more categories','themotion' ); ?>">
							<?php esc_html_e( '...','themotion' ); ?>
						</span>
							<span class="themotion-cat-show-on-click">
							<?php
						}

						if ( $i == $len -1 ) { ?>
							</span>
							<?php
						}
						$i++;
					}
				} ?>
			</div>
	<?php
		}
	}
}

/**
 * Display the page header.
 */
function themotion_page_header() {

		$themotion_page_header    = get_the_post_thumbnail_url();
                $themotion_palette_picker = get_theme_mod( 'themotion_palette_picker', json_encode( 'p1' ) );

	if ( ! empty( $themotion_palette_picker ) ) {
		$palette_name = json_decode( $themotion_palette_picker );

		if ( $palette_name == 'themotion_palette_custom' ) {
			$background_color = get_theme_mod( 'themotion_custom_2' );
		}
	}   ?>

	<header class="page-main-header" <?php if ( ! empty( $themotion_page_header ) ) {  echo 'style="background-image:url(' . esc_url( $themotion_page_header ) . ')"'; } else { if ( isset( $background_color ) && ! empty( $background_color ) ) { echo 'style="background: ' . $background_color . '"'; }
}   ?>>
		<div class="container">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	</header><!-- .entry-header -->  
<?php }
