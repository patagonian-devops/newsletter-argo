<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'kicker_trx_popup_get_css' ) ) {
	add_filter( 'kicker_filter_get_css', 'kicker_trx_popup_get_css', 10, 2 );
	function kicker_trx_popup_get_css( $css, $args ) {
		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS
CSS;
		}

		return $css;
	}
}

