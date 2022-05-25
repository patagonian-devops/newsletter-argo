<div class="front_page_section front_page_section_contacts<?php
	$kicker_scheme = kicker_get_theme_option( 'front_page_contacts_scheme' );
	if ( ! empty( $kicker_scheme ) && ! kicker_is_inherit( $kicker_scheme ) ) {
		echo ' scheme_' . esc_attr( $kicker_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( kicker_get_theme_option( 'front_page_contacts_paddings' ) );
	if ( kicker_get_theme_option( 'front_page_contacts_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$kicker_css      = '';
		$kicker_bg_image = kicker_get_theme_option( 'front_page_contacts_bg_image' );
		if ( ! empty( $kicker_bg_image ) ) {
			$kicker_css .= 'background-image: url(' . esc_url( kicker_get_attachment_url( $kicker_bg_image ) ) . ');';
		}
		if ( ! empty( $kicker_css ) ) {
			echo ' style="' . esc_attr( $kicker_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$kicker_anchor_icon = kicker_get_theme_option( 'front_page_contacts_anchor_icon' );
	$kicker_anchor_text = kicker_get_theme_option( 'front_page_contacts_anchor_text' );
if ( ( ! empty( $kicker_anchor_icon ) || ! empty( $kicker_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_contacts"'
									. ( ! empty( $kicker_anchor_icon ) ? ' icon="' . esc_attr( $kicker_anchor_icon ) . '"' : '' )
									. ( ! empty( $kicker_anchor_text ) ? ' title="' . esc_attr( $kicker_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_contacts_inner
	<?php
	if ( kicker_get_theme_option( 'front_page_contacts_fullheight' ) ) {
		echo ' kicker-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$kicker_css      = '';
			$kicker_bg_mask  = kicker_get_theme_option( 'front_page_contacts_bg_mask' );
			$kicker_bg_color_type = kicker_get_theme_option( 'front_page_contacts_bg_color_type' );
			if ( 'custom' == $kicker_bg_color_type ) {
				$kicker_bg_color = kicker_get_theme_option( 'front_page_contacts_bg_color' );
			} elseif ( 'scheme_bg_color' == $kicker_bg_color_type ) {
				$kicker_bg_color = kicker_get_scheme_color( 'bg_color', $kicker_scheme );
			} else {
				$kicker_bg_color = '';
			}
			if ( ! empty( $kicker_bg_color ) && $kicker_bg_mask > 0 ) {
				$kicker_css .= 'background-color: ' . esc_attr(
					1 == $kicker_bg_mask ? $kicker_bg_color : kicker_hex2rgba( $kicker_bg_color, $kicker_bg_mask )
				) . ';';
			}
			if ( ! empty( $kicker_css ) ) {
				echo ' style="' . esc_attr( $kicker_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$kicker_caption     = kicker_get_theme_option( 'front_page_contacts_caption' );
			$kicker_description = kicker_get_theme_option( 'front_page_contacts_description' );
			if ( ! empty( $kicker_caption ) || ! empty( $kicker_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				// Caption
				if ( ! empty( $kicker_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo ! empty( $kicker_caption ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( $kicker_caption, 'kicker_kses_content' );
					?>
					</h2>
					<?php
				}

				// Description
				if ( ! empty( $kicker_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo ! empty( $kicker_description ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( wpautop( $kicker_description ), 'kicker_kses_content' );
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$kicker_content = kicker_get_theme_option( 'front_page_contacts_content' );
			$kicker_layout  = kicker_get_theme_option( 'front_page_contacts_layout' );
			if ( 'columns' == $kicker_layout && ( ! empty( $kicker_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ( ( ! empty( $kicker_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo ! empty( $kicker_content ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $kicker_content, 'kicker_kses_content' );
					?>
				</div>
				<?php
			}

			if ( 'columns' == $kicker_layout && ( ! empty( $kicker_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div><div class="column-2_3">
				<?php
			}

			// Shortcode output
			$kicker_sc = kicker_get_theme_option( 'front_page_contacts_shortcode' );
			if ( ! empty( $kicker_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo ! empty( $kicker_sc ) ? 'filled' : 'empty'; ?>">
					<?php
					kicker_show_layout( do_shortcode( $kicker_sc ) );
					?>
				</div>
				<?php
			}

			if ( 'columns' == $kicker_layout && ( ! empty( $kicker_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>

		</div>
	</div>
</div>
