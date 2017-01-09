<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package themotion
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function themotion_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'themotion_body_classes' );


/**
 * Video Category Live Update Homepage B.
 */
function themotion_ajax_homeb( $themotion_video_category, $themotion_is_hidden ) {
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => '-1',
		'category_name'  => ! empty( $themotion_video_category ) && 'all' != $themotion_video_category ? esc_html( $themotion_video_category ) : '',
	);

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) { ?>

		<section id="videos"
		         class="home-section home-three-videos <?php if ( isset( $themotion_is_hidden ) && 'true' == $themotion_is_hidden ) {
						echo 'themotion-only-customizer';
} ?>">
			<div class="container">

				<?php
				$post_count = 0;
				while ( $the_query->have_posts() ) {
					$the_query->the_post();

					if ( 3 == $post_count ) {
						break;
					}
					$id = get_the_ID();
					if ( has_post_format( 'video', $id ) ) {
						$post    = get_post( $id );
						$content = apply_filters( 'the_content', $post->post_content );
						$embeds  = get_media_embedded_in_content( $content );

						if ( ! empty( $embeds ) ) { ?>
							<div class="home-three-videos-item">
								<?php
								echo themotion_escape_lightbox( $embeds[0] );
								$post_count ++; ?>
							</div>
							<?php
						}
					}
				} ?>

			</div>
		</section>
		<?php
	}
	wp_reset_postdata();
}

/**
 * Video Category Live Update Homepage A.
 */
function themotion_ajax_homea( $themotion_video_category ) {
	$args                     = array(
		'post_type'      => 'post',
		'posts_per_page' => '-1',
		'category_name'  => ! empty( $themotion_video_category ) && 'all' != $themotion_video_category ? esc_html( $themotion_video_category ) : '',
	);

	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) { ?>
		<div class="featured-video-wrap">
			<!-- Slider -->
			<div class="themotion-playlist" id="slider">
				<!-- Top part of the slider -->
				<div class="themotion-current-item" id="carousel-bounding-box">
					<div class="carousel slide" id="myCarousel">
						<!-- Carousel items -->
						<div class="carousel-inner">
							<?php
							$active_was_set = 'false';
							if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									$id = get_the_ID(); ?>
									<div class="item slide-number-<?php echo esc_attr( $id ); ?> <?php if ( 'false' == $active_was_set ) {echo 'active'; $active_was_set = 'true'; } ?>" >
										<?php
										if ( has_post_format( 'video',$id ) ) {
											$post = get_post( $id );
											$content = apply_filters( 'the_content', $post->post_content );
											$embeds = get_media_embedded_in_content( $content );
											if ( ! empty( $embeds ) ) {
												echo themotion_escape_lightbox( $embeds[0] );
											}
										} else {
											if ( has_post_thumbnail() ) {
												$thumb_id   = get_post_thumbnail_id();
												$thumb_meta = wp_get_attachment_metadata( $thumb_id );
												if ( ! empty( $thumb_id ) && 0 != $thumb_meta['width'] && 0 != $thumb_meta['height'] ) {
													if ( $thumb_meta['width'] / $thumb_meta['height'] > 1 ) {
														the_post_thumbnail( 'themotion-thumbnail-blog' );
													} else {
														the_post_thumbnail( 'themotion-thumbnail-blog-no-crop' );
													}
												}
											}
										} ?>
									</div>
									<?php
								}
							}
							wp_reset_postdata(); ?>
						</div><!-- Carousel nav -->
					</div>
				</div>

				<div class="themotion-playlist-tracks" id="slider-thumbs">
					<!-- Bottom switcher of slider -->
					<?php
					if ( $the_query->have_posts() ) {
						$first = 'true';
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							$id = get_the_ID();
							$attached_video = get_attached_media( 'video', $id );

							if ( ! empty( $attached_video ) ) {
								foreach ( $attached_video as $video ) {
									$video_id = $video->ID;
									$video_meta = wp_get_attachment_metadata( $video_id );
									$video_length = $video_meta['length_formatted'];
									break;
								}
							}?>

							<div class="themotion-playlist-item <?php if ( 'true' == $first ) {echo 'themotion-playlist-playing'; $first = 'false';}?>" id="carousel-selector-<?php echo esc_attr( $id ); ?>" data-id="<?php echo esc_attr( $id ); ?>">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'themotion-playlist-thumbnail' );
								} else { ?>
									<img src="<?php echo get_stylesheet_directory_uri() . '/images/small-empty-image.png'; ?>" alt="<?php esc_html_e( 'Placeholder image','themotion' );?>">
									<?php
								}?>
								<div class="themotion-playlist-caption">
									<span class="themotion-playlist-item-title"><?php the_title(); ?></span>
									<?php
									if ( ! empty( $video_length ) ) {  ?>
										<span class="themotion-video-time"><?php echo esc_html( $video_length ); ?></span>
										<?php
										$video_length = '';
									} ?>
								</div>
							</div>
							<?php
						}
					}
					wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
		<?php
	}
}


/**
 * Live Update About Us Page.
 */
function themotion_ajax_about( $themotion_video_category ) {
	$themotion_cat = ( ! empty( $themotion_video_category ) && 'all' != $themotion_video_category ? $themotion_video_category : '');
	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 3,
		'ignore_sticky_posts' => 1,
	);
	if ( ! empty( $themotion_cat ) ) {
		$args['category_name'] = $themotion_cat;
	}
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) { ?>
		<style>
			.wp-video-shortcode video, video.wp-video-shortcode {
				height: 215px;
			}

			@media screen and (min-width: 768px) {
				.recently-posted-wrap .recently-posted-about,
				.recently-posted-wrap .recently-posted-about:nth-child(3n+1),
				.recently-posted-wrap .recently-posted-about:nth-child(3n+3) {
					padding: 0 8.3px;
				}
			}

		</style>
		<?php
		/* Start the Loop */
		while ( $the_query->have_posts() ) {
			$the_query->the_post();

			/*
            * Include the Post-Format-specific template for the content.
            * If you want to override this in a child theme, then include a file
            * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			*/
			get_template_part( 'template-parts/content', 'about' );

		}

		the_posts_navigation( array(
				'prev_text' => sprintf( '&#8592; %s', __( 'Older Posts', 'themotion' ) ),
				'next_text' => sprintf( '%s &#8594;', __( 'Newer Posts', 'themotion' ) ),
			)
		);

	} else {

		get_template_part( 'template-parts/content', 'none' );

	}

	/* Restore original Post Data */
	wp_reset_postdata();
}

/**
 * Live Update Bottom of Home A.
 */
function themotion_ajax_homea_bottom( $themotion_video_category ) {
	$themotion_cat = ( ! empty( $themotion_video_category ) &&  'all' != $themotion_video_category ? $themotion_video_category : '');
	$args = array(
		'post_type' 		=> 'post',
		'post_status' 		=> 'publish',
		'posts_per_page' 	=> 6,
		'ignore_sticky_posts' => 1,
	);
	if ( ! empty( $themotion_cat ) ) {
		$args['category_name'] = $themotion_cat;
	}
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) { ?>

		<?php
		/* Start the Loop */
		while ( $the_query->have_posts() ) {
			$the_query->the_post();

			/*
            * Include the Post-Format-specific template for the content.
            * If you want to override this in a child theme, then include a file
            * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			*/
			get_template_part( 'template-parts/content', 'home-one' );

		}

		the_posts_navigation( array(
				'prev_text' => sprintf( '&#8592; %s', __( 'Older Posts', 'themotion' ) ),
				'next_text' => sprintf( '%s &#8594;', __( 'Newer Posts', 'themotion' ) ),
			)
		);

	} else {

		get_template_part( 'template-parts/content', 'none' );

	}

	/* Restore original Post Data */
	wp_reset_postdata();
}

/**
 * Live Update Bottom of Home B.
 */
function themotion_ajax_homeb_bottom( $themotion_video_category ) {
	$themotion_cat = ( ! empty( $themotion_video_category ) && 'all' != $themotion_video_category ? $themotion_video_category : '');
	$args = array(
		'post_type' 		=> 'post',
		'post_status' 		=> 'publish',
		'posts_per_page' 	=> 3,
		'ignore_sticky_posts' => 1,
	);
	if ( ! empty( $themotion_cat ) ) {
		$args['category_name'] = $themotion_cat;
	}
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) { ?>

		<?php
		/* Start the Loop */
		while ( $the_query->have_posts() ) {
			$the_query->the_post();

			/*
            * Include the Post-Format-specific template for the content.
            * If you want to override this in a child theme, then include a file
            * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			*/
			get_template_part( 'template-parts/content', 'home-two' );

		}

		the_posts_navigation( array(
				'prev_text' => sprintf( '&#8592; %s', __( 'Older Posts', 'themotion' ) ),
				'next_text' => sprintf( '%s &#8594;', __( 'Newer Posts', 'themotion' ) ),
			)
		);

	} else {

		get_template_part( 'template-parts/content', 'none' );

	}

	/* Restore original Post Data */
	wp_reset_postdata();
}
add_action( 'wp_ajax_nopriv_request_post', 'themotion_requestpost' );
add_action( 'wp_ajax_request_post', 'themotion_requestpost' );


/**
 * Post Request.
 */
function themotion_requestpost() {
	$themotion_page = $_POST['page'];
	if ( 'homeb' == $themotion_page ) {
		$themotion_video_category = $_POST['category'];
		$themotion_is_hidden      = $_POST['is_hidden'];
		themotion_ajax_homeb( $themotion_video_category, $themotion_is_hidden );

	} elseif ( 'homea' == $themotion_page ) {

		$themotion_video_category = $_POST['category'];
		themotion_ajax_homea( $themotion_video_category );

	} elseif ( 'about' == $themotion_page ) {
		$themotion_video_category = $_POST['category'];
		themotion_ajax_about( $themotion_video_category );

	} elseif ( 'homea_bottom' == $themotion_page ) {

		$themotion_video_category = $_POST['category'];
		themotion_ajax_homea_bottom( $themotion_video_category );

	} elseif ( 'homeb_bottom' == $themotion_page ) {
		$themotion_video_category = $_POST['category'];
		themotion_ajax_homeb_bottom( $themotion_video_category );
	}
	die();
}
