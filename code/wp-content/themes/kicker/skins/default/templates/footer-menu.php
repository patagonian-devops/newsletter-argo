<?php
/**
 * The template to display menu in the footer
 *
 * @package KICKER
 * @since KICKER 1.0.10
 */

// Footer menu
$kicker_menu_footer = kicker_skin_get_nav_menu( 'menu_footer' );
if ( ! empty( $kicker_menu_footer ) ) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php
			kicker_show_layout(
				$kicker_menu_footer,
				'<nav class="menu_footer_nav_area sc_layouts_menu sc_layouts_menu_default"'
					. ' itemscope="itemscope" itemtype="' . esc_attr( kicker_get_protocol( true ) ) . '//schema.org/SiteNavigationElement"'
					. '>',
				'</nav>'
			);
			?>
		</div>
	</div>
	<?php
}
