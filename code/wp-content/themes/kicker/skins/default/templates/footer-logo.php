<?php
/**
 * The template to display the site logo in the footer
 *
 * @package KICKER
 * @since KICKER 1.0.10
 */

// Logo
if ( kicker_is_on( kicker_get_theme_option( 'logo_in_footer' ) ) ) {
	$kicker_logo_image = kicker_get_logo_image( 'footer' );
	$kicker_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $kicker_logo_image['logo'] ) || ! empty( $kicker_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $kicker_logo_image['logo'] ) ) {
					$kicker_attr = kicker_getimagesize( $kicker_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $kicker_logo_image['logo'] ) . '"'
								. ( ! empty( $kicker_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $kicker_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'kicker' ) . '"'
								. ( ! empty( $kicker_attr[3] ) ? ' ' . wp_kses_data( $kicker_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $kicker_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $kicker_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
