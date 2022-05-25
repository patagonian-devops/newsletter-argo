<?php
/**
 * The template to display the widgets area in the header
 *
 * @package KICKER
 * @since KICKER 1.0
 */

// Header sidebar
$kicker_header_name    = kicker_get_theme_option( 'header_widgets' );
$kicker_header_present = ! kicker_is_off( $kicker_header_name ) && is_active_sidebar( $kicker_header_name );
if ( $kicker_header_present ) {
	kicker_storage_set( 'current_sidebar', 'header' );
	$kicker_header_wide = kicker_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $kicker_header_name ) ) {
		dynamic_sidebar( $kicker_header_name );
	}
	$kicker_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $kicker_widgets_output ) ) {
		$kicker_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $kicker_widgets_output );
		$kicker_need_columns   = strpos( $kicker_widgets_output, 'columns_wrap' ) === false;
		if ( $kicker_need_columns ) {
			$kicker_columns = max( 0, (int) kicker_get_theme_option( 'header_columns' ) );
			if ( 0 == $kicker_columns ) {
				$kicker_columns = min( 6, max( 1, kicker_tags_count( $kicker_widgets_output, 'aside' ) ) );
			}
			if ( $kicker_columns > 1 ) {
				$kicker_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $kicker_columns ) . ' widget', $kicker_widgets_output );
			} else {
				$kicker_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $kicker_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<?php do_action( 'kicker_action_before_sidebar_wrap', 'header' ); ?>
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $kicker_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $kicker_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'kicker_action_before_sidebar', 'header' );
				kicker_show_layout( $kicker_widgets_output );
				do_action( 'kicker_action_after_sidebar', 'header' );
				if ( $kicker_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $kicker_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
			<?php do_action( 'kicker_action_after_sidebar_wrap', 'header' ); ?>
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
