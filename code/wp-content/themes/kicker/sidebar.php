<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package KICKER
 * @since KICKER 1.0
 */

if ( kicker_sidebar_present() ) {
	
	$kicker_sidebar_type = kicker_get_theme_option( 'sidebar_type' );
	if ( 'custom' == $kicker_sidebar_type && ! kicker_is_layouts_available() ) {
		$kicker_sidebar_type = 'default';
	}
	
	// Catch output to the buffer
	ob_start();
	if ( 'default' == $kicker_sidebar_type ) {
		// Default sidebar with widgets
		$kicker_sidebar_name = kicker_get_theme_option( 'sidebar_widgets' );
		kicker_storage_set( 'current_sidebar', 'sidebar' );
		if ( is_active_sidebar( $kicker_sidebar_name ) ) {
			dynamic_sidebar( $kicker_sidebar_name );
		}
	} else {
		// Custom sidebar from Layouts Builder
		$kicker_sidebar_id = kicker_get_custom_sidebar_id();
		do_action( 'kicker_action_show_layout', $kicker_sidebar_id );
	}
	$kicker_out = trim( ob_get_contents() );
	ob_end_clean();
	
	// If any html is present - display it
	if ( ! empty( $kicker_out ) ) {
		$kicker_sidebar_position    = kicker_get_theme_option( 'sidebar_position' );
		$kicker_sidebar_position_ss = kicker_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $kicker_sidebar_position );
			echo ' sidebar_' . esc_attr( $kicker_sidebar_position_ss );
			echo ' sidebar_' . esc_attr( $kicker_sidebar_type );

			if ( 'float' == $kicker_sidebar_position_ss ) {
				echo ' sidebar_float';
			}
			$kicker_sidebar_scheme = kicker_get_theme_option( 'sidebar_scheme' );
			if ( ! empty( $kicker_sidebar_scheme ) && ! kicker_is_inherit( $kicker_sidebar_scheme ) ) {
				echo ' scheme_' . esc_attr( $kicker_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php

			// Skip link anchor to fast access to the sidebar from keyboard
			?>
			<a id="sidebar_skip_link_anchor" class="kicker_skip_link_anchor" href="#"></a>
			<?php

			do_action( 'kicker_action_before_sidebar_wrap', 'sidebar' );

			// Button to show/hide sidebar on mobile
			if ( in_array( $kicker_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$kicker_title = apply_filters( 'kicker_filter_sidebar_control_title', 'float' == $kicker_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'kicker' ) : '' );
				$kicker_text  = apply_filters( 'kicker_filter_sidebar_control_text', 'above' == $kicker_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'kicker' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $kicker_title ); ?>"><?php echo esc_html( $kicker_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'kicker_action_before_sidebar', 'sidebar' );
				kicker_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $kicker_out ) );
				do_action( 'kicker_action_after_sidebar', 'sidebar' );
				?>
			</div>
			<?php

			do_action( 'kicker_action_after_sidebar_wrap', 'sidebar' );

			?>
		</div>
		<div class="clearfix"></div>
		<?php
	}
}
