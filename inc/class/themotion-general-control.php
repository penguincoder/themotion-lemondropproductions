<?php
/**
 * Repeater customizer control.
 *
 * @package themotion
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Repeater Customizer Control Class
 */
class Themotion_General_Repeater extends WP_Customize_Control {
	/**
	 * Options for the Repeater customizer control
	 *
	 * @var array
	 */
	private $options = array();

	/**
	 * Construct function for the Repeater control
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		$this->options = $args;
	}
	/**
	 * Render the Repeater control
	 */
	public function render_content() {

		$it = 0;

		$this_default = json_decode( $this->setting->default );

		$values = $this->value();

		$json = json_decode( $values );

		if ( ! is_array( $json ) ) {
			$json = array( $values );
		}

		$options = $this->options;

		if ( ! empty( $options['themotion_link_control'] ) ) {
			$themotion_link_control = $options['themotion_link_control'];
		} else {
			$themotion_link_control = false;
		}

		if ( ! empty( $options['themotion_text_control'] ) ) {
			$themotion_text_control = $options['themotion_text_control'];
		} else {
			$themotion_text_control = false;
		}
		?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<div class="themotion_general_control_repeater themotion_general_control_droppable">
			<?php
			if ( empty( $json ) ) {

				?>
				<div class="themotion_general_control_repeater_container">
					<div class="themotion-customize-control-title"><?php esc_html_e( 'TheMotion', 'themotion' ) ?></div>
					<div class="themotion-box-content-hidden">

						<?php
						if ( true == $themotion_text_control ) { ?>
							<span class="customize-control-title"><?php esc_html_e( 'Text','themotion' )?></span>
							<input type="text" class="themotion_text_control" placeholder="<?php esc_html_e( 'Text','themotion' ); ?>"/>
							<?php
						}

						if ( true == $themotion_link_control ) {  ?>
							<span class="customize-control-title"><?php esc_html_e( 'Link', 'themotion' ) ?></span>
							<input type="text" class="themotion_link_control"
						       placeholder="<?php esc_html_e( 'Link', 'themotion' ); ?>"/>
						<?php
						} ?>
						<input type="hidden" class="themotion_box_id">
						<button type="button" class="themotion_general_control_remove_field button"
						        style="display:none;"><?php esc_html_e( 'Delete field', 'themotion' ); ?></button>
					</div>
				</div>
				<?php
			} else {

				if ( ! empty( $this_default ) && empty( $json ) ) {
					foreach ( $this_default as $icon ) { ?>
						<div class="themotion_general_control_repeater_container themotion_draggable">
							<div
								class="themotion-customize-control-title"><?php esc_html_e( 'TheMotion', 'themotion' ) ?></div>
							<div class="themotion-box-content-hidden">

								<?php
								if ( true == $themotion_text_control ) {  ?>
									<span class="customize-control-title"><?php esc_html_e( 'Text','themotion' )?></span>
									<input type="text" value="<?php if ( ! empty( $icon->text ) ) { echo esc_attr( $icon->text ); } ?>" class="themotion_text_control" placeholder="<?php esc_html_e( 'Text','themotion' ); ?>"/>
									<?php
								}

								if ( true == $themotion_link_control ) {  ?>
									<span class="customize-control-title"><?php esc_html_e( 'Link', 'themotion' ) ?></span>
									<input type="text" value="<?php if ( ! empty( $icon->link ) ) {
										echo esc_url( $icon->link );
} ?>" class="themotion_link_control"
									       placeholder="<?php esc_html_e( 'Link', 'themotion' ); ?>"/>
									<?php
								} ?>

								<input type="hidden" class="themotion_box_id" value="<?php if ( ! empty( $icon->id ) ) {
									echo esc_attr( $icon->id );
} ?>">
								<button type="button" class="themotion_general_control_remove_field button" <?php
								if ( 0 == $it ) {
									echo 'style="display:none;"';
								} ?>><?php esc_html_e( 'Delete field', 'themotion' ); ?></button>
							</div>

						</div>
						<?php
						$it ++;

					}
				} else {
					foreach ( $json as $icon ) {

						?>
						<div class="themotion_general_control_repeater_container themotion_draggable">
							<div
								class="themotion-customize-control-title"><?php esc_html_e( 'TheMotion', 'themotion' ) ?></div>
							<div class="themotion-box-content-hidden">

								<?php
								if ( true == $themotion_text_control ) {  ?>
									<span class="customize-control-title"><?php esc_html_e( 'Text','themotion' )?></span>
									<input type="text" value="<?php if ( ! empty( $icon->text ) ) { echo esc_attr( $icon->text ); } ?>" class="themotion_text_control" placeholder="<?php esc_html_e( 'Text','themotion' ); ?>"/>
									<?php
								}

								if ( true == $themotion_link_control ) {  ?>
									<span class="customize-control-title"><?php esc_html_e( 'Link', 'themotion' ) ?></span>
									<input type="text" value="<?php if ( ! empty( $icon->link ) ) {
										echo esc_url( $icon->link );
} ?>" class="themotion_link_control"
									       placeholder="<?php esc_html_e( 'Link', 'themotion' ); ?>"/>
									<?php
								} ?>

								<input type="hidden" class="themotion_box_id" value="<?php if ( ! empty( $icon->id ) ) {
									echo esc_attr( $icon->id );
} ?>">
								<button type="button" class="themotion_general_control_remove_field button" <?php
								if ( 0 == $it ) {
									echo 'style="display:none;"';
								} ?>><?php esc_html_e( 'Delete field', 'themotion' ); ?></button>
							</div>

						</div>
						<?php
						$it ++;

					}
				}
			} ?>


			<input type="hidden"
			       id="themotion_<?php echo esc_attr( $options['section'] ); ?>_repeater_colector" <?php $this->link(); ?>
			       class="themotion_repeater_colector" value="<?php echo esc_textarea( $this->value() ); ?>"/>

		</div>

		<button type="button" class="button add_field themotion_general_control_new_field"

		><?php esc_html_e( 'Add new field', 'themotion' ); ?></button>

		<?php

	}

}
