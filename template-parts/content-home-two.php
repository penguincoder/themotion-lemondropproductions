<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themotion
 */ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'recently-item' ); ?>>
	<?php
	if ( has_post_format( 'video' ) ) {
		if ( has_post_thumbnail() ) { ?>
			<div class="themotion-home2-video-thumbnail">
			<?php
				the_post_thumbnail( 'themotion-thumbnail-blog' );
			?>
			<span class="themotion-video-play-button">
				<i class="mejs-overlay-button themotion-play-icon"></i>
			</span>
			</div>
		<?php
		}
		?>
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
		if ( has_post_thumbnail() ) { ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="recently-image-wrap">
				<?php
					the_post_thumbnail( 'themotion-thumbnail-blog' );  ?>
			</a>
		<?php
		}
	} ?>

	<div class="recently-content-wrap">
		<header class="entry-header">
			<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			$pos = strpos( $post->post_content, '<!--more-->' );
			if ( $pos <= 0 ) {
				the_excerpt();
			} else {
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Read more %s <span class="meta-nav">&rarr;</span>', 'themotion' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			}

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'themotion' ),
				'after'  => '</div>',
			) ); ?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
