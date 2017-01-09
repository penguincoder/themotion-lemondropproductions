<?php
/**
 * Template Name: Left Sidebar
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themotion
 */

get_header();
?>

	</div><!-- .container -->

	<?php
	themotion_page_header(); ?>


	<div class="container">

		<div class="content-wrap content-area-left-sidebar">

			<?php
				get_sidebar();
			?>

			<div id="primary" class="content-area sidebar-left">
				<main id="main" class="site-main">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

					?>

				</main><!-- #main -->
			</div><!-- #primary -->

		</div><!-- .content-wrap -->
		<div class="content-wrap content-comment-wrap">

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			endwhile; // End of the loop.
			?>

		</div><!-- .content-wrap -->

<?php
get_footer();
