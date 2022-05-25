<?php

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'kicker_limit_modified_date_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'kicker_limit_modified_date_theme_setup9', 9 );
    function kicker_limit_modified_date_theme_setup9() {
        if ( is_admin() ) {
            add_filter( 'kicker_filter_tgmpa_required_plugins', 'kicker_limit_modified_date_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'kicker_limit_modified_date_tgmpa_required_plugins' ) ) {    
    function kicker_limit_modified_date_tgmpa_required_plugins( $list = array() ) {
        if ( kicker_storage_isset( 'required_plugins', 'limit-modified-date' ) && kicker_storage_get_array( 'required_plugins', 'limit-modified-date', 'install' ) !== false ) {
            $list[] = array(
                'name'     => kicker_storage_get_array( 'required_plugins', 'limit-modified-date', 'title' ),
                'slug'     => 'limit-modified-date',
                'required' => false,
            );
        }
        return $list;
    }
}