<?php
/**
 * Welcome Screen Class
 */
class themotion_Welcome {

	/**
	 * Constructor for the welcome screen
	 */
	public function __construct() {

		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'themotion_welcome_register_menu' ) );

		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'themotion_activation_admin_notice' ) );

		/* enqueue script and style for welcome screen */
		add_action( 'admin_enqueue_scripts', array( $this, 'themotion_welcome_style_and_scripts' ) );

		/* enqueue script for customizer */
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'themotion_welcome_scripts_for_customizer' ) );

		/* load welcome screen */
		add_action( 'themotion_welcome', array( $this, 'themotion_welcome_getting_started' ), 	    10 );
		add_action( 'themotion_welcome', array( $this, 'themotion_welcome_actions_required' ),        20 );
		add_action( 'themotion_welcome', array( $this, 'themotion_welcome_changelog' ), 				50 );

		/* ajax callback for dismissable required actions */
		add_action( 'wp_ajax_themotion_dismiss_required_action', array( $this, 'themotion_dismiss_required_action_callback' ) );
		add_action( 'wp_ajax_nopriv_themotion_dismiss_required_action', array( $this, 'themotion_dismiss_required_action_callback' ) );

	}

	/**
	 * Creates the dashboard page
	 *
	 * @see  add_theme_page()
	 * @since 1.8.2.4
	 */
	public function themotion_welcome_register_menu() {
		add_theme_page( 'About TheMotion', 'About TheMotion', 'activate_plugins', 'themotion-welcome', array( $this, 'themotion_welcome_screen' ) );
	}

	/**
	 * Adds an admin notice upon successful activation.
	 *
	 * @since 1.8.2.4
	 */
	public function themotion_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'themotion_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 *
	 * @since 1.8.2.4
	 */
	public function themotion_welcome_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
				<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing TheMotion! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%1$s.', 'themotion' ), '<a href="' . esc_url( admin_url( 'themes.php?page=themotion-welcome' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=themotion-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with TheMotion', 'themotion' ); ?></a></p>
			</div>
		<?php
	}

	/**
	 * Load welcome screen css and javascript
	 *
	 * @since  1.8.2.4
	 */
	public function themotion_welcome_style_and_scripts( $hook_suffix ) {

		if ( 'appearance_page_themotion-welcome' == $hook_suffix ) {
			wp_enqueue_style( 'themotion-welcome-screen-css', get_template_directory_uri() . '/inc/admin/welcome-screen/css/welcome.css' );
			wp_enqueue_script( 'themotion-welcome-screen-js', get_template_directory_uri() . '/inc/admin/welcome-screen/js/welcome.js', array( 'jquery' ) );

			global $themotion_required_actions;

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

			wp_localize_script( 'themotion-welcome-screen-js', 'themotionLiteWelcomeScreenObject', array(
				'nr_actions_required' => $nr_actions_required,
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'no_required_actions_text' => __( 'Hooray! There are no required actions for you right now.','themotion' ),
			) );
		}
	}

	/**
	 * Load scripts for customizer page
	 *
	 * @since  1.8.2.4
	 */
	public function themotion_welcome_scripts_for_customizer() {

		wp_enqueue_style( 'themotion-welcome-screen-customizer-css', get_template_directory_uri() . '/inc/admin/welcome-screen/css/welcome_customizer.css' );
		wp_enqueue_script( 'themotion-welcome-screen-customizer-js', get_template_directory_uri() . '/inc/admin/welcome-screen/js/welcome_customizer.js', array( 'jquery' ), '20120206', true );

		global $themotion_required_actions;

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

		wp_localize_script( 'themotion-welcome-screen-customizer-js', 'themotionWelcomeScreenCustomizerObject', array(
			'nr_actions_required' => $nr_actions_required,
			'aboutpage' => esc_url( admin_url( 'themes.php?page=themotion-welcome#actions_required' ) ),
			'customizerpage' => esc_url( admin_url( 'customize.php#actions_required' ) ),
		) );
	}

	/**
	 * Dismiss required actions
	 *
	 * @since 1.8.2.4
	 */
	public function themotion_dismiss_required_action_callback() {

		global $themotion_required_actions;

		$themotion_dismiss_id = isset( $_GET['dismiss_id'] ) ? $_GET['dismiss_id'] : 0;

		echo esc_attr( $themotion_dismiss_id ); /* this is needed and it's the id of the dismissable required action */

		if ( ! empty( $themotion_dismiss_id ) ) {

			/* if the option exists, update the record for the specified id */
			if ( get_option( 'themotion_show_required_actions' ) ) {

				$themotion_show_required_actions = get_option( 'themotion_show_required_actions' );

				$themotion_show_required_actions[ $themotion_dismiss_id ] = false;

				update_option( 'themotion_show_required_actions', $themotion_show_required_actions );

				/* create the new option,with false for the specified id */
			} else {

				$themotion_show_required_actions_new = array();

				if ( ! empty( $themotion_required_actions ) ) {

					foreach ( $themotion_required_actions as $themotion_required_action ) {

						if ( $themotion_required_action['id'] == $themotion_dismiss_id ) {
							$themotion_show_required_actions_new[ $themotion_required_action['id'] ] = false;
						} else {
							$themotion_show_required_actions_new[ $themotion_required_action['id'] ] = true;
						}
}

					update_option( 'themotion_show_required_actions', $themotion_show_required_actions_new );

				}
}
}

		die(); // this is required to return a proper result
	}


	/**
	 * Welcome screen content
	 *
	 * @since 1.8.2.4
	 */
	public function themotion_welcome_screen() {

		require_once ABSPATH . 'wp-load.php';
		require_once ABSPATH . 'wp-admin/admin.php';
		require_once ABSPATH . 'wp-admin/admin-header.php';
		?>

		<ul class="themotion-nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#getting_started" aria-controls="getting_started" role="tab" data-toggle="tab"><?php esc_html_e( 'Getting started','themotion' ); ?></a></li>
			<li role="presentation" class="themotion-w-red-tab"><a href="#actions_required" aria-controls="actions_required" role="tab" data-toggle="tab"><?php esc_html_e( 'Actions required','themotion' ); ?></a></li>
			<li role="presentation"><a href="#changelog" aria-controls="changelog" role="tab" data-toggle="tab"><?php esc_html_e( 'Changelog','themotion' ); ?></a></li>
		</ul>

		<div class="themotion-tab-content">

			<?php
			/**
			 * @hooked themotion_welcome_getting_started - 10
			 * @hooked themotion_welcome_actions_required - 20
			 * @hooked themotion_welcome_child_themes - 30
			 * @hooked themotion_welcome_changelog - 50
			 * @hooked themotion_welcome_free_pro - 60
			 */
			do_action( 'themotion_welcome' ); ?>

		</div>
		<?php
	}

	/**
	 * Getting started
	 *
	 * @since 1.8.2.4
	 */
	public function themotion_welcome_getting_started() {
		require_once get_template_directory() . '/inc/admin/welcome-screen/sections/getting-started.php';
	}

	/**
	 * Actions required
	 *
	 * @since 1.8.2.4
	 */
	public function themotion_welcome_actions_required() {
		require_once get_template_directory() . '/inc/admin/welcome-screen/sections/actions-required.php';
	}


	/**
	 * Changelog
	 *
	 * @since 1.8.2.4
	 */
	public function themotion_welcome_changelog() {
		require_once get_template_directory() . '/inc/admin/welcome-screen/sections/changelog.php';
	}

}

$GLOBALS['themotion_Welcome'] = new themotion_Welcome();
