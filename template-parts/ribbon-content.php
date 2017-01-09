<?php
/**
 * Homepage A Ribbon Content Output
 *
 * @package themotion
 */
$themotion_show_home_a_ribbon        = get_theme_mod( 'themotion_home_a_show_banner' );
$themotion_home_a_ribbon_text        = get_theme_mod( 'themotion_home_a_banner_text', esc_html__( 'A collection of high quality videos focused on putting your business in motion.', 'themotion' ) );
$themotion_home_a_banner_button_text = get_theme_mod( 'themotion_home_a_banner_button_text', esc_html__( 'Subscribe', 'themotion' ) );
$themotion_home_a_banner_button_link = get_theme_mod( 'themotion_home_a_banner_button_link' );
if ( ! empty( $themotion_home_a_banner_button_link ) && strpos( $themotion_home_a_banner_button_link, '#' ) === 0 ) {
	$themotion_go_to = 'href="#" onclick="return false;" data-anchor="' . $themotion_home_a_banner_button_link . '"';
} else {
	$themotion_go_to = 'href="' . esc_url( $themotion_home_a_banner_button_link ) . '"';
}

if ( isset( $themotion_show_home_a_ribbon ) && 1 != $themotion_show_home_a_ribbon ) { ?>
<section id="ribbon"
		 class="home-section home-ribbon <?php if ( empty( $themotion_home_a_banner_button_text ) && empty( $themotion_home_a_ribbon_text ) ) {
				echo 'themotion-only-customizer';
} ?>">
	<div class="container">
		<div class="home-ribbon-inner">
			<div class="home-ribbon-text">
				<?php
				if ( ! empty( $themotion_home_a_ribbon_text ) ) { ?>
					<h2><?php echo esc_html( $themotion_home_a_ribbon_text ); ?></h2>
					<?php
				} else {
					if ( is_customize_preview() ) { ?>
						<h2 class="themotion-only-customizer"></h2>
						<?php
					}
				} ?>
			</div>
			<div class="home-ribbon-btn">
				<?php
				if ( ! empty( $themotion_home_a_banner_button_text ) ) { ?>
					<a <?php if ( ! empty( $themotion_go_to ) ) {
						echo esc_attr( $themotion_go_to );
} ?> class="btn themotion-scroll-to-section">
						<?php echo esc_html( $themotion_home_a_banner_button_text ); ?>
					</a>
					<?php
				} else {
					if ( is_customize_preview() ) { ?>
						<a class="btn themotion-scroll-to-section themotion-only-customizer"></a>
						<?php
					}
				} ?>
			</div>
		</div>
	</div>
</section>
<?php
} else {
	if ( is_customize_preview() ) { ?>
		<section id="ribbon" class="home-section home-ribbon themotion-only-customizer">
			<div class="container">
				<div class="home-ribbon-inner">
					<div class="home-ribbon-text">
						<?php
						if ( ! empty( $themotion_home_a_ribbon_text ) ) { ?>
							<h2><?php echo esc_html( $themotion_home_a_ribbon_text ); ?></h2>
							<?php
						} else { ?>
							<h2 class="themotion-only-customizer"></h2>
							<?php
						} ?>
					</div>
					<div class="home-ribbon-btn">
						<?php
						if ( ! empty( $themotion_home_a_banner_button_text ) ) { ?>
							<a <?php if ( ! empty( $themotion_go_to ) ) {
								echo esc_attr( $themotion_go_to );
} ?> class="btn themotion-scroll-to-section">
								<?php echo esc_html( $themotion_home_a_banner_button_text ); ?>
							</a>
							<?php
						} else { ?>
							<a class="btn themotion-scroll-to-section themotion-only-customizer"></a>
							<?php
						} ?>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
