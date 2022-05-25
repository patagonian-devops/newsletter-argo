<?php
/**
 * The template to display default site footer
 *
 * @package KICKER
 * @since KICKER 1.0.10
 */

$kicker_footer_id = kicker_get_custom_footer_id();
$kicker_footer_meta = kicker_get_custom_layout_meta( $kicker_footer_id );
if ( ! empty( $kicker_footer_meta['margin'] ) ) {
	kicker_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( kicker_prepare_css_value( $kicker_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $kicker_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $kicker_footer_id ) ) ); ?>
						<?php
						$kicker_footer_scheme = kicker_get_theme_option( 'footer_scheme' );
						$kicker_footer_scheme = kicker_is_woocommerce_page() ? 
													( ( empty(kicker_get_theme_option( 'woo_footer_scheme' ) ) || kicker_get_theme_option( 'woo_footer_scheme' ) === 'inherit') ? 
														$kicker_footer_scheme 
														: kicker_get_theme_option( 'woo_footer_scheme' ) ) 
													: $kicker_footer_scheme;
						if ( ! empty( $kicker_footer_scheme ) && ! kicker_is_inherit( $kicker_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $kicker_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'kicker_action_show_layout', $kicker_footer_id );
	?>
</footer><!-- /.footer_wrap -->
