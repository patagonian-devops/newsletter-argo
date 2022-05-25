<?php
/* ThemeREX Popup support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'kicker_trx_popup_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'kicker_trx_popup_theme_setup9', 9 );
	function kicker_trx_popup_theme_setup9() {
		if ( kicker_exists_trx_popup() ) {
			add_action( 'wp_enqueue_scripts', 'kicker_trx_popup_frontend_scripts', 1100 );
			add_filter( 'kicker_filter_merge_styles', 'kicker_trx_popup_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'kicker_filter_tgmpa_required_plugins', 'kicker_trx_popup_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'kicker_trx_popup_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter( 'kicker_filter_tgmpa_required_plugins',	'kicker_trx_popup_tgmpa_required_plugins' );
	function kicker_trx_popup_tgmpa_required_plugins( $list = array() ) {
		if ( kicker_storage_isset( 'required_plugins', 'trx_popup' ) && kicker_storage_get_array( 'required_plugins', 'trx_popup', 'install' ) !== false && kicker_is_theme_activated() ) {
			$path = kicker_get_plugin_source_path( 'plugins/trx_popup/trx_popup.zip' );
			if ( ! empty( $path ) || kicker_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => kicker_storage_get_array( 'required_plugins', 'trx_popup', 'title' ),
					'slug'     => 'trx_popup',
					'source'   => ! empty( $path ) ? $path : 'upload://trx_popup.zip',
					'version'  => '1.0',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'kicker_exists_trx_popup' ) ) {
	function kicker_exists_trx_popup() {
		return defined( 'TRX_POPUP_URL' );
	}
}

// Enqueue custom scripts
if ( ! function_exists( 'kicker_trx_popup_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'kicker_trx_popup_frontend_scripts', 1100 );
	function kicker_trx_popup_frontend_scripts() {
		if ( kicker_is_on( kicker_get_theme_option( 'debug_mode' ) ) ) {
			$kicker_url = kicker_get_file_url( 'plugins/trx_popup/trx_popup.css' );
			if ( '' != $kicker_url ) {
				wp_enqueue_style( 'kicker-trx-popup', $kicker_url, array(), null );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'kicker_trx_popup_merge_styles' ) ) {
	//Handler of the add_filter('kicker_filter_merge_styles', 'kicker_trx_popup_merge_styles');
	function kicker_trx_popup_merge_styles( $list ) {
		$list[ 'plugins/trx_popup/trx_popup.css' ] = true;
		return $list;
	}
}

// Add plugin-specific colors and fonts to the custom CSS
if ( kicker_exists_trx_popup() ) {
	require_once kicker_get_file_dir( 'plugins/trx_popup/trx_popup-style.php' );
}
