<?php
/**
 * The template to display the socials in the footer
 *
 * @package KICKER
 * @since KICKER 1.0.10
 */


// Socials
if ( kicker_is_on( kicker_get_theme_option( 'socials_in_footer' ) ) ) {
	$kicker_output = kicker_get_socials_links();
	if ( '' != $kicker_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php kicker_show_layout( $kicker_output ); ?>
			</div>
		</div>
		<?php
	}
}
