<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package KICKER
 * @since KICKER 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$kicker_copyright_scheme = kicker_get_theme_option( 'copyright_scheme' );
if ( ! empty( $kicker_copyright_scheme ) && ! kicker_is_inherit( $kicker_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $kicker_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$kicker_copyright = kicker_get_theme_option( 'copyright' );
			if ( ! empty( $kicker_copyright ) ) {
				$kicker_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $kicker_copyright );
				$kicker_copyright = kicker_prepare_macros( $kicker_copyright );
				// Display copyright
				echo wp_kses( nl2br( $kicker_copyright ), 'kicker_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
