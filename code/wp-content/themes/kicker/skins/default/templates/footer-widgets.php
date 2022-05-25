<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package KICKER
 * @since KICKER 1.0.10
 */

// Footer sidebar
$kicker_footer_name    = kicker_get_theme_option( 'footer_widgets' );
$kicker_footer_present = ! kicker_is_off( $kicker_footer_name ) && is_active_sidebar( $kicker_footer_name );
if ( $kicker_footer_present ) {
	kicker_storage_set( 'current_sidebar', 'footer' );
	$kicker_footer_wide = kicker_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $kicker_footer_name ) ) {
		dynamic_sidebar( $kicker_footer_name );
	}
	$kicker_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $kicker_out ) ) {
		$kicker_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $kicker_out );
		$kicker_need_columns = true;  
		if ( $kicker_need_columns ) {
			$kicker_columns = max( 0, (int) kicker_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $kicker_columns ) {
				$kicker_columns = min( 4, max( 1, kicker_tags_count( $kicker_out, 'aside' ) ) );
			}
			if ( $kicker_columns > 1 ) {
				$kicker_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $kicker_columns ) . ' widget', $kicker_out );
			} else {
				$kicker_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $kicker_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<?php do_action( 'kicker_action_before_sidebar_wrap', 'footer' ); ?>
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $kicker_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $kicker_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'kicker_action_before_sidebar', 'footer' );
				kicker_show_layout( $kicker_out );
				do_action( 'kicker_action_after_sidebar', 'footer' );
				if ( $kicker_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $kicker_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
			<?php do_action( 'kicker_action_after_sidebar_wrap', 'footer' ); ?>
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
