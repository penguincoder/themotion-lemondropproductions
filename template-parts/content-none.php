<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themotion
 */

if ( is_page_template( 'page-templates/template-homepage-two.php' ) ) {
	themotion_template_two_posts_header(); ?>
	<article class="recently-item">
		<div class="recently-image-wrap">
			<img width="790" height="200" src="<?php echo get_template_directory_uri() . '/images/default-thumbnail.jpg'; ?>" class="attachment-post-thumbnail wp-post-image" alt="">
		</div>
		<div class="recently-content-wrap">
			<header class="entry-header">
				<h2 class="entry-title">
					<?php
					_e( 'Example  post','themotion' ); ?>
				</h2>
			</header>
			<div class="entry-content">
				<?php
				_e( 'This is an example post and it is displayed only for admins. To display this section on your website, please add a new post.','themotion' ); ?>
			</div>
		</div>
	</article>
	<?php
} else { ?>

	<section class="no-results not-found">
		<header class="page-header-search-nothing">
			<h1 class="page-title search-nothing-found"><?php esc_html_e( 'Sorry, nothing found!', 'themotion' ); ?></h1>
		</header><!-- .page-header -->

		<div class="page-content page-content-search">
			<?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'themotion' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php elseif ( is_search() ) : ?>

				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'themotion' ); ?></p>
				<?php
				get_search_form();
			else : ?>

				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'themotion' ); ?></p>
				<?php
				get_search_form();

			endif; ?>
		</div><!-- .page-content -->
	</section><!-- .no-results -->

	<?php
}
