<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themotion
 */?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-sm-12 col-md-6  recently-posted-item' ); ?>>
	<header class="entry-header">
		<span class="post-image-container">
			<?php
			if ( has_post_format( 'video' ) ) {
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'themotion-post-thumbnail' );
				} else { ?>
					<img width="790" height="200" src="<?php echo get_template_directory_uri() . '/images/default-thumbnail.jpg'; ?>" class="attachment-post-thumbnail wp-post-image" alt="">
					<?php
				}?>
				<span class="themotion-video-play-button">
					<i class="mejs-overlay-button themotion-play-icon"></i>
				</span>
				<?php
			} else { ?>
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'themotion-post-thumbnail' );
					} else { ?>
						<img width="790" height="200" src="<?php echo get_template_directory_uri() . '/images/default-thumbnail.jpg'; ?>" class="attachment-post-thumbnail wp-post-image" alt="">
						<?php
					}?>
				</a>
				<?php
			} ?>
		</span>
		<?php
		if ( has_post_format( 'video' ) ) { ?>
			<div class="themotion-lightbox">
				<div class="themotion-lightbox-inner">
					<?php
					$post    = get_post();
					$content = apply_filters( 'the_content', $post->post_content );
					$embeds  = get_media_embedded_in_content( $content );
					if ( ! empty( $embeds ) ) {
						echo themotion_escape_lightbox( $embeds[0] );
					} ?>
				</div>
			</div>
			<?php
		} ?>
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<?php the_title( '<span class="home-entry-title">', '</span>' ); ?>
		</a>

		<div class="infowrap">
			<?php
			if ( function_exists( 'the_views' ) ) {
				echo '<a class="the-views-wrap">';
				the_views();
				echo '</a>';
			}
			if ( function_exists( 'dot_irecommendthis' ) ) { dot_irecommendthis();
			}
			?>
		</div>

	</header><!-- .entry-header -->
</article><!-- #post-## -->
