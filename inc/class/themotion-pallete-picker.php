<?php
/**
 * Palette customizer control.
 *
 * @package themotion
 */



/**
 * A class to create a dropdown for theme colors
 */
class Themotion_Palette extends WP_Customize_Control {

	/**
	 * Render the content of the category dropdown
	 */
	public function render_content() {

		$values = json_decode( $this->value() );

		$themotion_palette = array(
			array( 'p1','#628D7C','#5bc19a','#F6F6F6','#575756','#323231' ),
			array( 'p2','#BE614D','#F5876F','#F6F6F6','#FFFFFF','#E3E1E2' ),
			array( 'p3','#8db73c','#96CA2D','#EDF7F2','#263432','#2b5f65' ),
			array( 'p4','#F59F4C','#FFC154','#FAFAFA','#1f1f1f','#333333' ),
			array( 'p5','#333331','#C2A26F','#F6F6F6','#0f1b27','#3b3b3b' ),
		);
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		</label>
		<div class="themotion_palette_selected">
			<div class="themotion_palette_input">
				<?php
				$is_empty_flag = true;
				foreach ( $themotion_palette as $palette_iterator ) {
					if ( $palette_iterator[0] == $values ) {
						$is_empty_flag = false;
						for ( $i = 1; $i < 6; $i++ ) {
							echo '<span style="background-color:' . $palette_iterator[ $i ] . '"></span>';
						}
						break;
					}
				}
				if ( true == $is_empty_flag ) {
					echo esc_html__( 'Custom', 'themotion' );
				}
				?>
			</div>
			<div class="themotion_dropdown">&#x25BC;</div>
		</div>
		<ul class="themotion_palette_picker">
			<?php

			foreach ( $themotion_palette as $pallete ) {
				echo '<li class="' . $pallete[0] . '">';
				for ( $i = 1; $i < 6; $i++ ) {
					echo '<span style="background-color:' . $pallete[ $i ] . '"></span>';
				}
				echo '</li>';
			}
			echo '<li class="themotion_palette_custom">';
			esc_html_e( 'Custom','themotion' );
			echo '</li>';
			?>
		</ul>
		<input type='hidden' class='themotion_palette_colector' value='<?php echo esc_attr( $this->value() ); ?>' <?php $this->link(); ?> />
		<?php
	}
}

?>
