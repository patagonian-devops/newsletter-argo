<?php

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'kicker_eu_opt_in_compliance_for_mailchimp_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'kicker_eu_opt_in_compliance_for_mailchimp_theme_setup9', 9 );
    function kicker_eu_opt_in_compliance_for_mailchimp_theme_setup9() {
        if ( is_admin() ) {
            add_filter( 'kicker_filter_tgmpa_required_plugins', 'kicker_eu_opt_in_compliance_for_mailchimp_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'kicker_eu_opt_in_compliance_for_mailchimp_tgmpa_required_plugins' ) ) {
    
    function kicker_eu_opt_in_compliance_for_mailchimp_tgmpa_required_plugins( $list = array() ) {
        if ( kicker_storage_isset( 'required_plugins', 'eu-opt-in-compliance-for-mailchimp' ) && kicker_storage_get_array( 'required_plugins', 'eu-opt-in-compliance-for-mailchimp', 'install' ) !== false ) {
            $list[] = array(
                'name'     => kicker_storage_get_array( 'required_plugins', 'eu-opt-in-compliance-for-mailchimp', 'title' ),
                'slug'     => 'eu-opt-in-compliance-for-mailchimp',
                'required' => false,
            );
        }
        return $list;
    }
}

// Check if plugin installed and activated
if ( ! function_exists( 'kicker_eu_opt_in_compliance_for_mailchimp' ) ) {
    function kicker_eu_opt_in_compliance_for_mailchimp() {
        return class_exists( 'Yikes_Inc_Easy_Mailchimp_EU_Law_Compliance_Extension' );
    }
}

// Set plugin's specific importer options
if ( !function_exists( 'kicker_eu_opt_in_compliance_for_mailchimp_importer_set_options' ) ) {
    if (is_admin()) add_filter( 'trx_addons_filter_importer_options',    'kicker_eu_opt_in_compliance_for_mailchimp_importer_set_options' );
    function kicker_eu_opt_in_compliance_for_mailchimp_importer_set_options($options=array()) {   
        if ( kicker_eu_opt_in_compliance_for_mailchimp() && in_array('eu-opt-in-compliance-for-mailchimp', $options['required_plugins']) ) {
            $options['additional_options'][]    = 'CookieLawInfo-0.9';                   
            $options['additional_options'][]    = 'cookielawinfo_%';                   
        }
        return $options;
    }
}
