<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package themotion
 */

get_header(); ?>

	</div><!-- .container -->


	<div class="container">

		<div class="content-wrap">

			<div id="primary" class="content-area themotion404">
				<div id="content" class="site-content" role="main">


					<div class="page-wrapper">
						<div class="page-content">
							<h1><?php _e( 'Can&rsquo;t find what you&rsquo;re looking for?', 'themotion' ); ?></h1>
							<p><?php _e( 'Try using the search form below!', 'themotion' ); ?></p>

							<?php get_search_form(); ?>
						</div><!-- .page-content -->
					</div><!-- .page-wrapper -->

				</div><!-- #content -->
			</div><!-- #primary -->

		</div><!-- .content-wrap -->

<?php
get_footer();

