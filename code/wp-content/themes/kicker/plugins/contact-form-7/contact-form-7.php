<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'kicker_cf7_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'kicker_cf7_theme_setup9', 9 );
	function kicker_cf7_theme_setup9() {
		if ( kicker_exists_cf7() ) {
			add_action( 'wp_enqueue_scripts', 'kicker_cf7_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_cf7', 'kicker_cf7_frontend_scripts', 10, 1 );
			add_filter( 'kicker_filter_merge_styles', 'kicker_cf7_merge_styles' );
			add_filter( 'kicker_filter_merge_scripts', 'kicker_cf7_merge_scripts' );
		}
		if ( is_admin() ) {
			add_filter( 'kicker_filter_tgmpa_required_plugins', 'kicker_cf7_tgmpa_required_plugins' );
			add_filter( 'kicker_filter_theme_plugins', 'kicker_cf7_theme_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'kicker_cf7_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('kicker_filter_tgmpa_required_plugins',	'kicker_cf7_tgmpa_required_plugins');
	function kicker_cf7_tgmpa_required_plugins( $list = array() ) {
		if ( kicker_storage_isset( 'required_plugins', 'contact-form-7' ) && kicker_storage_get_array( 'required_plugins', 'contact-form-7', 'install' ) !== false ) {
			// CF7 plugin
			$list[] = array(
				'name'     => kicker_storage_get_array( 'required_plugins', 'contact-form-7', 'title' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			);
		}
		return $list;
	}
}

// Filter theme-supported plugins list
if ( ! function_exists( 'kicker_cf7_theme_plugins' ) ) {
	//Handler of the add_filter( 'kicker_filter_theme_plugins', 'kicker_cf7_theme_plugins' );
	function kicker_cf7_theme_plugins( $list = array() ) {
		return kicker_add_group_and_logo_to_slave( $list, 'contact-form-7', 'contact-form-7-' );
	}
}



// Check if cf7 installed and activated
if ( ! function_exists( 'kicker_exists_cf7' ) ) {
	function kicker_exists_cf7() {
		return class_exists( 'WPCF7' );
	}
}

// Enqueue custom scripts
if ( ! function_exists( 'kicker_cf7_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'kicker_cf7_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_cf7', 'kicker_cf7_frontend_scripts', 10, 1 );
	function kicker_cf7_frontend_scripts( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && kicker_need_frontend_scripts( 'cf7' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$kicker_url = kicker_get_file_url( 'plugins/contact-form-7/contact-form-7.css' );
			if ( '' != $kicker_url ) {
				wp_enqueue_style( 'kicker-contact-form-7', $kicker_url, array(), null );
			}
			$kicker_url = kicker_get_file_url( 'plugins/contact-form-7/contact-form-7.js' );
			if ( '' != $kicker_url ) {
				wp_enqueue_script( 'kicker-contact-form-7', $kicker_url, array( 'jquery' ), null, true );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'kicker_cf7_merge_styles' ) ) {
	//Handler of the add_filter('kicker_filter_merge_styles', 'kicker_cf7_merge_styles');
	function kicker_cf7_merge_styles( $list ) {
		$list[ 'plugins/contact-form-7/contact-form-7.css' ] = false;
		return $list;
	}
}

// Merge custom scripts
if ( ! function_exists( 'kicker_cf7_merge_scripts' ) ) {
	//Handler of the add_filter('kicker_filter_merge_scripts', 'kicker_cf7_merge_scripts');
	function kicker_cf7_merge_scripts( $list ) {
		$list[ 'plugins/contact-form-7/contact-form-7.js' ] = false;
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( kicker_exists_cf7() ) {
	require_once kicker_get_file_dir( 'plugins/contact-form-7/contact-form-7-style.php' );
}
