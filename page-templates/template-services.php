<?php
/**
 * Template Name: Services
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themotion
 */

get_header(); ?>

	</div><!-- .container -->

	<?php

		themotion_services_top();

	?>

	<div class="content-wrap-services">

		<div class="container">

			<div class="content-wrap">

				<div id="primary" class="content-area full-width">
					<main id="main" class="site-main">

						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>

					</main><!-- #main -->
				</div><!-- #primary -->

			</div><!-- .content-wrap -->

<?php
get_footer();
