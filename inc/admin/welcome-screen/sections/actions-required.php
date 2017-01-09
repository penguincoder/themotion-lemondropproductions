<?php
/**
 * Actions required
 */
?>

<div id="actions_required" class="themotion-tab-pane">

	<h1><?php esc_html_e( 'Keep up with TheMotion\'s latest news' ,'themotion' ); ?></h1>

	<!-- NEWS -->
	<hr />

	<?php
	global $themotion_required_actions;

	if ( ! empty( $themotion_required_actions ) ) :

		/* themotion_show_required_actions is an array of true/false for each required action that was dismissed */
		$themotion_show_required_actions = get_option( 'themotion_show_required_actions' );

		foreach ( $themotion_required_actions as $themotion_required_action_key => $themotion_required_action_value ) :
			if ( @$themotion_show_required_actions[ $themotion_required_action_value['id'] ] == false ) {
				continue;
			}
			if ( @$themotion_required_action_value['check'] ) {
				continue;
			}
			?>
			<div class="themotion-action-required-box">
				<span class="dashicons dashicons-no-alt themotion-dismiss-required-action" id="<?php echo esc_attr( $themotion_required_action_value['id'] ); ?>"></span>
				<h4><?php echo intval( $themotion_required_action_key + 1 ); ?>. <?php if ( ! empty( $themotion_required_action_value['title'] ) ) :  echo esc_html( $themotion_required_action_value['title'] ); endif; ?></h4>
				<p><?php if ( ! empty( $themotion_required_action_value['description'] ) ) :  echo esc_html( $themotion_required_action_value['description'] ); endif; ?></p>
				<?php
					if ( ! empty( $themotion_required_action_value['plugin_slug'] ) ) :
					?><p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $themotion_required_action_value['plugin_slug'] ), 'install-plugin_' . $themotion_required_action_value['plugin_slug'] ) ); ?>" class="button button-primary"><?php if ( ! empty( $themotion_required_action_value['title'] ) ) :  echo esc_html( $themotion_required_action_value['title'] ); endif; ?></a></p><?php
					endif;
				?>

				<hr />
			</div>
			<?php
		endforeach;
	endif;

	$nr_actions_required = 0;

	/* get number of required actions */
	if ( get_option( 'themotion_show_required_actions' ) ) {
		$themotion_show_required_actions = get_option( 'themotion_show_required_actions' );
	} else {
		$themotion_show_required_actions = array();
	}


	if ( ! empty( $themotion_required_actions ) ) {
		foreach ( $themotion_required_actions as $themotion_required_action_value ) {
			if ( ( ! isset( $themotion_required_action_value['check'] ) || ( isset( $themotion_required_action_value['check'] ) && ( $themotion_required_action_value['check'] == false ) ) ) && ( ( isset( $themotion_show_required_actions[ $themotion_required_action_value['id'] ] ) && ( $themotion_show_required_actions[ $themotion_required_action_value['id'] ] == true ) ) || ! isset( $themotion_show_required_actions[ $themotion_required_action_value['id'] ] ) ) ) {
				$nr_actions_required ++;
			}
		}
	}

	if ( $nr_actions_required == 0 ) {
		echo '<p>' . __( 'Hooray! There are no required actions for you right now.', 'themotion' ) . '</p>';
	} ?>

</div>
