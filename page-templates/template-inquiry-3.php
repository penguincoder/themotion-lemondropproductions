<?php
/**
 * Template Name: Inquiry 3
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themotion
 */

get_header(); ?>

	</div><!-- .container -->

	<?php

		themotion_inquiry_3_top();

	?>

	<div class="content-wrap-inquiry-3">

		<div class="container">

			<div class="content-wrap">

				<div id="primary" class="content-area full-width">
					<main id="main" class="site-main">

						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'page' );

						endwhile; // End of the loop.
						?>

					</main><!-- #main -->
				</div><!-- #primary -->

			</div><!-- .content-wrap -->

<?php
get_footer();
