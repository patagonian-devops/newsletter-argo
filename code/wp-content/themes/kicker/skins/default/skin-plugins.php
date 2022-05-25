<?php
/**
 * Required plugins
 *
 * @package KICKER
 * @since KICKER 1.76.0
 */

// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$kicker_theme_required_plugins_groups = array(
	'core'          => esc_html__( 'Core', 'kicker' ),
	'page_builders' => esc_html__( 'Page Builders', 'kicker' ),
	'ecommerce'     => esc_html__( 'E-Commerce & Donations', 'kicker' ),
	'socials'       => esc_html__( 'Socials and Communities', 'kicker' ),
	'events'        => esc_html__( 'Events and Appointments', 'kicker' ),
	'content'       => esc_html__( 'Content', 'kicker' ),
	'other'         => esc_html__( 'Other', 'kicker' ),
);
$kicker_theme_required_plugins        = array(
	'trx_addons'                 => array(
		'title'       => esc_html__( 'ThemeREX Addons', 'kicker' ),
		'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'kicker' ),
		'required'    => true,
		'logo'        => 'trx_addons.png',
		'group'       => $kicker_theme_required_plugins_groups['core'],
	),
	'elementor'                  => array(
		'title'       => esc_html__( 'Elementor', 'kicker' ),
		'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'kicker' ),
		'required'    => false,
		'logo'        => 'elementor.png',
		'group'       => $kicker_theme_required_plugins_groups['page_builders'],
	),
	'gutenberg'                  => array(
		'title'       => esc_html__( 'Gutenberg', 'kicker' ),
		'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'kicker' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gutenberg.png',
		'group'       => $kicker_theme_required_plugins_groups['page_builders'],
	),
	'woocommerce'                => array(
		'title'       => esc_html__( 'WooCommerce', 'kicker' ),
		'description' => esc_html__( "Connect the store to your website and start selling now", 'kicker' ),
		'required'    => false,
		'logo'        => 'woocommerce.png',
		'group'       => $kicker_theme_required_plugins_groups['ecommerce'],
	),
	'elegro-payment'             => array(
		'title'       => esc_html__( 'Elegro Crypto Payment', 'kicker' ),
		'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'kicker' ),
		'required'    => false,
		'logo'        => 'elegro-payment.png',
		'group'       => $kicker_theme_required_plugins_groups['ecommerce'],
	),
	'advanced-product-labels-for-woocommerce'             => array(
		'title'       => esc_html__( 'Advanced Product Labels For Woocommerce', 'kicker' ),
		'description' => esc_html__( "With Advanced Product Labels plugin you can create labels easily and quickly", 'kicker' ),
		'required'    => false,
		'logo'        => kicker_get_file_url( kicker_skins_get_current_skin_dir() . 'plugins/advanced-product-labels-for-woocommerce/advanced-product-labels-for-woocommerce.png' ),
		'group'       => $kicker_theme_required_plugins_groups['ecommerce'],
	),
	'mailchimp-for-wp'           => array(
		'title'       => esc_html__( 'MailChimp for WP', 'kicker' ),
		'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'kicker' ),
		'required'    => false,
		'logo'        => 'mailchimp-for-wp.png',
		'group'       => $kicker_theme_required_plugins_groups['socials'],
	),
	'contact-form-7'             => array(
		'title'       => esc_html__( 'Contact Form 7', 'kicker' ),
		'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'kicker' ),
		'required'    => false,
		'logo'        => 'contact-form-7.png',
		'group'       => $kicker_theme_required_plugins_groups['content'],
	),
	'yikes-inc-easy-mailchimp-extender'             => array(
		'title'       => esc_html__( 'Easy Forms for Mailchimp', 'kicker' ),
		'description' => esc_html__( "Easy Forms for Mailchimp allows you to add unlimited Mailchimp sign up forms to your WordPress site", 'kicker' ),
		'required'    => false,
		'logo'        => kicker_get_file_url( kicker_skins_get_current_skin_dir() . 'plugins/yikes-inc-easy-mailchimp-extender/yikes-inc-easy-mailchimp-extender.png' ),
		'group'       => $kicker_theme_required_plugins_groups['content'],
	),
	'eu-opt-in-compliance-for-mailchimp'             => array(
		'title'       => esc_html__( 'GDPR Compliance for Mailchimp', 'kicker' ),
		'description' => esc_html__( "This addon creates an additional section on the Easy Forms for Mailchimp form builder called ‘EU Law Compliance.’", 'kicker' ),
		'required'    => false,
		'logo'        => kicker_get_file_url( kicker_skins_get_current_skin_dir() . 'plugins/eu-opt-in-compliance-for-mailchimp/eu-opt-in-compliance-for-mailchimp.png' ),
		'group'       => $kicker_theme_required_plugins_groups['content'],
	),
	'sitepress-multilingual-cms' => array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'kicker' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'kicker' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'sitepress-multilingual-cms.png',
		'group'       => $kicker_theme_required_plugins_groups['content'],
	),
	'accelerated-mobile-pages'         => array(
		'title'       => esc_html__( 'AMP for WP – Accelerated Mobile Pages', 'kicker' ),
		'description' => esc_html__( "AMP makes your website faster for Mobile visitors", 'kicker' ),
		'required'    => false,
		'logo'        => kicker_get_file_url( kicker_skins_get_current_skin_dir() . 'plugins/accelerated-mobile-pages/accelerated-mobile-pages.png' ),
		'group'       => $kicker_theme_required_plugins_groups['other'],
	),
	'wp-gdpr-compliance'         => array(
		'title'       => esc_html__( 'WP GDPR Compliance', 'kicker' ),
		'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'kicker' ),
		'required'    => false,
		'logo'        => 'wp-gdpr-compliance.png',
		'group'       => $kicker_theme_required_plugins_groups['other'],
	),
	'trx_updater'                => array(
		'title'       => esc_html__( 'ThemeREX Updater', 'kicker' ),
		'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'kicker' ),
		'required'    => false,
		'logo'        => 'trx_updater.png',
		'group'       => $kicker_theme_required_plugins_groups['other'],
	),
	'trx_popup'                  => array(
		'title'       => esc_html__( 'ThemeREX Popup', 'kicker' ),
		'description' => esc_html__( "Add popup to your site.", 'kicker' ),
		'required'    => false,
		'logo'        => 'trx_popup.png',
		'group'       => $kicker_theme_required_plugins_groups['other'],
	),
	'advanced-popups'                  => array(
		'title'       => esc_html__( 'Advanced Popups', 'kicker' ),
		'required'    => false,
		'logo'        => kicker_get_file_url( kicker_skins_get_current_skin_dir() . 'plugins/advanced-popups/advanced-popups.jpg' ),
		'group'       => $kicker_theme_required_plugins_groups['other'],
	),
	'powerkit'              => array(
		'title'       => esc_html__( 'Powerkit', 'kicker' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'powerkit.png',
		'group'       => $kicker_theme_required_plugins_groups['other'],
	),
	'kadence-blocks'		=> array(
		'title'       => esc_html__( 'Kadence Blocks', 'kicker' ),
		'description' => '',
		'required'    => false,
		'logo'        => kicker_get_file_url( kicker_skins_get_current_skin_dir() . 'plugins/kadence-blocks/kadence-blocks.png' ),
		'group'       => $kicker_theme_required_plugins_groups['other'],
	),
	'limit-modified-date'		=> array(
		'title'       => esc_html__( 'Limit Modified Date', 'kicker' ),
		'description' => '',
		'required'    => false,
		'logo'        => kicker_get_file_url( kicker_skins_get_current_skin_dir() . 'plugins/limit-modified-date/limit-modified-date.png' ),
		'group'       => $kicker_theme_required_plugins_groups['other'],
	),
	'cookie-law-info'         => array(
		'title'       => esc_html__( 'GDPR Cookie Consent', 'kicker' ),
		'description' => esc_html__( "The CookieYes GDPR Cookie Consent & Compliance Notice plugin will assist you in making your website GDPR (RGPD, DSVGO) compliant.", 'kicker' ),
		'required'    => false,
		'logo'        => kicker_get_file_url( kicker_skins_get_current_skin_dir() . 'plugins/cookie-law-info/cookie-law-info.png'),
		'group'       => $kicker_theme_required_plugins_groups['other'],
	)
);

if ( KICKER_THEME_FREE ) {
	unset( $kicker_theme_required_plugins['js_composer'] );
	unset( $kicker_theme_required_plugins['vc-extensions-bundle'] );
	unset( $kicker_theme_required_plugins['easy-digital-downloads'] );
	unset( $kicker_theme_required_plugins['give'] );
	unset( $kicker_theme_required_plugins['bbpress'] );
	unset( $kicker_theme_required_plugins['booked'] );
	unset( $kicker_theme_required_plugins['content_timeline'] );
	unset( $kicker_theme_required_plugins['mp-timetable'] );
	unset( $kicker_theme_required_plugins['learnpress'] );
	unset( $kicker_theme_required_plugins['the-events-calendar'] );
	unset( $kicker_theme_required_plugins['calculated-fields-form'] );
	unset( $kicker_theme_required_plugins['essential-grid'] );
	unset( $kicker_theme_required_plugins['revslider'] );
	unset( $kicker_theme_required_plugins['ubermenu'] );
	unset( $kicker_theme_required_plugins['sitepress-multilingual-cms'] );
	unset( $kicker_theme_required_plugins['envato-market'] );
	unset( $kicker_theme_required_plugins['trx_updater'] );
	unset( $kicker_theme_required_plugins['trx_popup'] );
}

// Add plugins list to the global storage
kicker_storage_set( 'required_plugins', $kicker_theme_required_plugins );
