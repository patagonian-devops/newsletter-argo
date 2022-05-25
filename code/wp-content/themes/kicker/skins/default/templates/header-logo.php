<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package KICKER
 * @since KICKER 1.0
 */

$kicker_args = get_query_var( 'kicker_logo_args' );

// Site logo
$kicker_logo_type   = isset( $kicker_args['type'] ) ? $kicker_args['type'] : '';
$kicker_logo_image  = kicker_get_logo_image( $kicker_logo_type );
$kicker_logo_text   = kicker_is_on( kicker_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$kicker_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $kicker_logo_image['logo'] ) || ! empty( $kicker_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $kicker_logo_image['logo'] ) ) {
			if ( empty( $kicker_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric( $kicker_logo_image['logo'] ) && $kicker_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$kicker_attr = kicker_getimagesize( $kicker_logo_image['logo'] );
				echo '<img src="' . esc_url( $kicker_logo_image['logo'] ) . '"'
						. ( ! empty( $kicker_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $kicker_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $kicker_logo_text ) . '"'
						. ( ! empty( $kicker_attr[3] ) ? ' ' . wp_kses_data( $kicker_attr[3] ) : '' )
						. '>';
			}
		} else {
			kicker_show_layout( kicker_prepare_macros( $kicker_logo_text ), '<span class="logo_text">', '</span>' );
			kicker_show_layout( kicker_prepare_macros( $kicker_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
