<?php

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'kicker_cookie_law_info_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'kicker_cookie_law_info_theme_setup9', 9 );
    function kicker_cookie_law_info_theme_setup9() {     
        if ( is_admin() ) {
            add_filter( 'kicker_filter_tgmpa_required_plugins', 'kicker_cookie_law_info_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'kicker_cookie_law_info_tgmpa_required_plugins' ) ) {
    function kicker_cookie_law_info_tgmpa_required_plugins( $list = array() ) {
        if ( kicker_storage_isset( 'required_plugins', 'cookie-law-info' ) && kicker_storage_get_array( 'required_plugins', 'cookie-law-info', 'install' ) !== false ) {
            $list[] = array(
                'name'     => kicker_storage_get_array( 'required_plugins', 'cookie-law-info', 'title' ),
                'slug'     => 'cookie-law-info',
                'required' => false,
            );
        }
        return $list;
    }
}

// Check if plugin installed and activated
if ( ! function_exists( 'kicker_exists_cookie_law_info' ) ) {
    function kicker_exists_cookie_law_info() {
        return class_exists( 'Cookie_Law_Info' );
    }
}