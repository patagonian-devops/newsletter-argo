<?php
/**
 * The template to display default site footer
 *
 * @package KICKER
 * @since KICKER 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$kicker_footer_scheme = kicker_get_theme_option( 'footer_scheme' );
$kicker_footer_scheme = kicker_is_woocommerce_page() ? kicker_get_theme_option( 'woo_footer_scheme' ) : $kicker_footer_scheme;
if ( ! empty( $kicker_footer_scheme ) && ! kicker_is_inherit( $kicker_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $kicker_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'kicker_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'kicker_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'kicker_filter_get_template_part', 'templates/footer-socials' ) );

	// Menu
	get_template_part( apply_filters( 'kicker_filter_get_template_part', 'templates/footer-menu' ) );

	// Copyright area
	get_template_part( apply_filters( 'kicker_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
