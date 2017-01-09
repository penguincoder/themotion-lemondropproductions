<?php
/**
 * Template Name: Home Page Option B
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themotion
 */

get_header(); ?>

	</div><!-- .container -->

	<div class="homepage-two-wrap">

		<?php

			themotion_top_area();
			themotion_ribbon_intro();

		?>

		<div class="container">

			<div class="content-wrap">
				<?php
				$themotion_bottom_posts_category = get_theme_mod( 'themotion_bottom_posts_category' );
				$args = array(
					'post_type' 		=> 'post',
					'post_status' 		=> 'publish',
					'posts_per_page' 	=> 3,
					'ignore_sticky_posts' => 1,
				);
				if ( ! empty( $themotion_bottom_posts_category ) && $themotion_bottom_posts_category !== 'all' ) {
					$args['category_name'] = $themotion_bottom_posts_category;
				}

				$the_query = new WP_Query( $args ); ?>
				<div id="primary" class="content-area homepage-two">
					<main id="main" class="site-main">
						<?php
						if ( $the_query->have_posts() ) {
							themotion_template_two_posts_header(); ?>

							<div class="recently-posted-wrap">


								<?php
								/* Start the Loop */
								while ( $the_query->have_posts() ) : $the_query->the_post();

									/*
									* Include the Post-Format-specific template for the content.
									* If you want to override this in a child theme, then include a file
									* called content-___.php (where ___ is the Post Format name) and that will be used instead.
									*/
									get_template_part( 'template-parts/content', 'home-two' );

								endwhile;

								the_posts_navigation( array(
										'prev_text' => sprintf( '&#8592; %s', __( 'Older Posts', 'themotion' ) ),
										'next_text' => sprintf( '%s &#8594;', __( 'Newer Posts', 'themotion' ) ),
									)
								); ?>

							</div>
							<?php
							edit_post_link( __( 'Edit', 'themotion' ), '<span class="edit-link">', '</span>' );
						} else {
							if ( is_customize_preview() ) {
								get_template_part( 'template-parts/content', 'none' );
							}
						}
						/* Restore original Post Data */
						wp_reset_postdata(); ?>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div><!-- .content-wrap -->

		</div><!-- .container -->

	</div><!-- .homepage-two-wrap -->

	<div class="container">

<?php
get_footer();
