<?php
/**
 * Template Name: About page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themotion
 */

get_header(); ?>

	</div><!-- .container -->

	<div class="about-us-page-wrap">

<?php
themotion_about_top();
themotion_info_block();
themotion_stats();
themotion_testimonial();
$themotion_show_latest = get_theme_mod( 'themotion_show_latest' );
$themotion_latest_posts_title = get_theme_mod( 'themotion_latest_posts_title', esc_html__( 'Recently Posted','themotion' ) );
if ( isset( $themotion_show_latest ) && $themotion_show_latest != 1 ) { ?>
	<div class="container themotion-about-latest-posts">
	<?php
} else {
	if ( is_customize_preview() ) { ?>
		<div class="container themotion-about-latest-posts themotion-only-customizer">
		<?php
	}
}

if ( ( isset( $themotion_show_latest ) && $themotion_show_latest != 1 ) || is_customize_preview() ) {
	?>
	<div class="content-wrap content-wrap-about-us">

		<div id="primary" class="content-area about-us-page">
			<main id="main" class="site-main">

				<div class="recently-posts-about-page">
					<?php
					if ( ! empty( $themotion_latest_posts_title ) ) { ?>
						<h3 class="recently-posted-title"><?php echo wp_kses_post( force_balance_tags( $themotion_latest_posts_title ) ); ?></h3>
						<?php
					} else {
						if ( is_customize_preview() ) { ?>
							<h3 class="recently-posted-title"></h3>
							<?php
						}
					}
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="see-all-posts"><?php echo __( 'See All Posts >', 'themotion' ); ?></a>
				</div>

				<div class="recently-posted-wrap">
					<?php
					$themotion_latest_posts_category = get_theme_mod( 'themotion_latest_posts_category' );
					$themotion_cat = ( ! empty( $themotion_latest_posts_category ) && $themotion_latest_posts_category != 'all' ? $themotion_latest_posts_category : '' );
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

					if ( $the_query->have_posts() ) : ?>

						<?php
						/* Start the Loop */
						while ( $the_query->have_posts() ) : $the_query->the_post();

							/*
                            * Include the Post-Format-specific template for the content.
                            * If you want to override this in a child theme, then include a file
                            * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							*/
							get_template_part( 'template-parts/content', 'about' );

						endwhile;

						the_posts_navigation( array(
							'prev_text' => sprintf( '&#8592; %s', __( 'Older Posts', 'themotion' ) ),
							'next_text' => sprintf( '%s &#8594;', __( 'Newer Posts', 'themotion' ) ),
							)
						);

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;

					/* Restore original Post Data */
					wp_reset_postdata();

					?>

				</div>
				<?php edit_post_link( __( 'Edit', 'themotion' ), '<span class="edit-link">', '</span>' ); ?>
			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .content-wrap -->

	</div><!-- .container -->
	<?php
}
?>
	</div><!-- .homepage-two-wrap -->

	<div class="container">

<?php
get_footer();
