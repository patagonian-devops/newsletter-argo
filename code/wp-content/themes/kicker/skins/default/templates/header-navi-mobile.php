<?php
/**
 * The template to show mobile menu (used only header_style == 'default')
 *
 * @package KICKER
 * @since KICKER 1.0
 */
?>
<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr( kicker_get_theme_option( 'menu_mobile_fullscreen' ) > 0 ? 'fullscreen' : 'narrow' ); ?> scheme_dark">
	<div class="menu_mobile_inner">
		<a class="menu_mobile_close theme_button_close" tabindex="0"><span class="theme_button_close_icon"></span></a>
		<?php

		// Logo
		set_query_var( 'kicker_logo_args', array( 'type' => 'mobile' ) );
		get_template_part( apply_filters( 'kicker_filter_get_template_part', 'templates/header-logo' ) );
		set_query_var( 'kicker_logo_args', array() );

		// Mobile menu
		$kicker_menu_mobile = kicker_skin_get_nav_menu( 'menu_mobile' );
		if ( empty( $kicker_menu_mobile ) ) {
			$kicker_menu_mobile = apply_filters( 'kicker_filter_get_mobile_menu', '' );
			if ( empty( $kicker_menu_mobile ) ) {
				$kicker_menu_mobile = kicker_skin_get_nav_menu( 'menu_main' );
				if ( empty( $kicker_menu_mobile ) ) {
					$kicker_menu_mobile = kicker_get_nav_menu();
				}
			}
		}
		if ( ! empty( $kicker_menu_mobile ) ) {
			// Change attribute 'id' - add prefix 'mobile-' to prevent duplicate id on the page
			$kicker_menu_mobile = preg_replace( '/([\s]*id=")/', '${1}mobile-', $kicker_menu_mobile );
			// Change main menu classes
			$kicker_menu_mobile = str_replace(
				array( 'menu_main',   'sc_layouts_menu_nav', 'sc_layouts_menu ' ),	
				array( 'menu_mobile', '',                    ' ' ),					
				$kicker_menu_mobile
			);
			// Wrap menu to the <nav> if not present
			if ( strpos( $kicker_menu_mobile, '<nav ' ) !== 0 ) {	// condition !== false is not allowed, because menu can contain inner <nav> elements (in the submenu layouts)
				$kicker_menu_mobile = sprintf( '<nav class="menu_mobile_nav_area" itemscope="itemscope" itemtype="%1$s//schema.org/SiteNavigationElement">%2$s</nav>', esc_attr( kicker_get_protocol( true ) ), $kicker_menu_mobile );
			}
			// Show menu
			kicker_show_layout( apply_filters( 'kicker_filter_menu_mobile_layout', $kicker_menu_mobile ) );
		}

		// Search field
		if ( kicker_get_theme_option( 'menu_mobile_search' ) > 0 ) {
			do_action(
				'kicker_action_search',
				array(
					'style' => 'normal',
					'class' => 'search_mobile',
					'ajax'  => false
				)
			);
		}

		// Social icons
		if ( kicker_get_theme_option( 'menu_mobile_socials' ) > 0 ) {
			kicker_show_layout( kicker_get_socials_links(), '<div class="socials_mobile">', '</div>' );
		}
		?>
	</div>
</div>
