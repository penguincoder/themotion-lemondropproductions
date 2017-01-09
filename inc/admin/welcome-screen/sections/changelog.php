<?php
/**
 * Changelog
 */

$themotion = wp_get_theme( 'themotion' );

?>
<div class="themotion-tab-pane" id="changelog">

	<div class="themotion-tab-pane-center">
	
		<h1>TheMotion <?php if ( ! empty( $themotion['Version'] ) ) :  ?> <sup id="themotion-theme-version"><?php echo esc_attr( $themotion['Version'] ); ?> </sup><?php endif; ?></h1>

	</div>

	<?php
	WP_Filesystem();
	global $wp_filesystem;
	$themotion_changelog = $wp_filesystem->get_contents( get_template_directory() . '/CHANGELOG.md' );
	$themotion_changelog_lines = explode( PHP_EOL, $themotion_changelog );
	foreach ( $themotion_changelog_lines as $themotion_changelog_line ) {
		if ( strpos( $themotion_changelog_line,'###' ) == 0 ) {
			echo '<hr /><h1>' . substr( $themotion_changelog_line,3 ) . '</h1>';
		} else {
			echo esc_html( $themotion_changelog_line ) . '<br/>';
		}
	}

	?>
	
</div>
