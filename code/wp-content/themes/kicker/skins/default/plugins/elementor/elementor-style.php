<?php
// Add theme-specific CSS-animations
if ( ! function_exists( 'kicker_elm_add_theme_animations' ) ) {
	add_filter( 'elementor/controls/animations/additional_animations', 'kicker_elm_add_theme_animations' );
	function kicker_elm_add_theme_animations( $animations ) {
		/* To add a theme-specific animations to the list:
			1) Merge to the array 'animations': array(
													esc_html__( 'Theme Specific', 'kicker' ) => array(
														'ta_custom_1' => esc_html__( 'Custom 1', 'kicker' )
													)
												)
			2) Add a CSS rules for the class '.ta_custom_1' to create a custom entrance animation
		*/
		$animations = array_merge(
						$animations,
						array(
							esc_html__( 'Theme Specific', 'kicker' ) => array(
																			'ta_fadeinup'     => esc_html__( 'Fade In Up (Short)', 'kicker' ),
																			'ta_fadeinright'  => esc_html__( 'Fade In Right (Short)', 'kicker' ),
																			'ta_fadeinleft'   => esc_html__( 'Fade In Left (Short)', 'kicker' ),
																			'ta_fadeindown'   => esc_html__( 'Fade In Down (Short)', 'kicker' ),
																			'ta_fadein'       => esc_html__( 'Fade In (Short)', 'kicker' ),
																			'ta_under_strips' => esc_html__( 'Under strips', 'kicker' ),
																			'ta_mouse_wheel' => esc_html__( 'Mouse Wheel', 'kicker' ),
																			'blogger_coverbg_parallax' => esc_html__( 'Only Blogger cover image parallax', 'kicker' ),
																			)
							)
						);
		return $animations;
	}
}
