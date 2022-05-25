<?php
/**
 * The template to display default site header
 *
 * @package KICKER
 * @since KICKER 1.0
 */

$kicker_header_css   = '';
$kicker_header_image = get_header_image();
$kicker_header_video = kicker_get_header_video();
if ( ! empty( $kicker_header_image ) && kicker_trx_addons_featured_image_override( is_singular() || kicker_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$kicker_header_image = kicker_get_current_mode_image( $kicker_header_image );
}
?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $kicker_header_image ) || ! empty( $kicker_header_video ) ? ' with_bg_image' : ' without_bg_image';
	if ( '' != $kicker_header_video ) {
		echo ' with_bg_video';
	}
	if ( '' != $kicker_header_image ) {
		echo ' ' . esc_attr( kicker_add_inline_css_class( 'background-image: url(' . esc_url( $kicker_header_image ) . ');' ) );
	}
	if ( is_singular() && has_post_thumbnail() ) {
		echo ' with_featured_image';
	}
	if ( kicker_is_on( kicker_get_theme_option( 'header_fullheight' ) ) ) {
		echo ' header_fullheight kicker-full-height';
	}
	$kicker_header_scheme = kicker_get_theme_option( 'header_scheme' );
	if ( ! empty( $kicker_header_scheme ) && ! kicker_is_inherit( $kicker_header_scheme  ) ) {
		echo ' scheme_' . esc_attr( $kicker_header_scheme );
	}
	?>
">
	<?php

	// Background video
	if ( ! empty( $kicker_header_video ) ) {
		get_template_part( apply_filters( 'kicker_filter_get_template_part', 'templates/header-video' ) );
	}

	// Main menu
	get_template_part( apply_filters( 'kicker_filter_get_template_part', 'templates/header-navi' ) );

	// Mobile header
	if ( kicker_is_on( kicker_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'kicker_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Page title and breadcrumbs area
	if ( ! is_single() ) {
		get_template_part( apply_filters( 'kicker_filter_get_template_part', 'templates/header-title' ) );
	}

	// Header widgets area
	get_template_part( apply_filters( 'kicker_filter_get_template_part', 'templates/header-widgets' ) );
	?>
</header>
