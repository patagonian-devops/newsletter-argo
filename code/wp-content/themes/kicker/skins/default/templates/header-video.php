<?php
/**
 * The template to display the background video in the header
 *
 * @package KICKER
 * @since KICKER 1.0.14
 */
$kicker_header_video = kicker_get_header_video();
$kicker_embed_video  = '';
if ( ! empty( $kicker_header_video ) && ! kicker_is_from_uploads( $kicker_header_video ) ) {
	if ( kicker_is_youtube_url( $kicker_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $kicker_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php kicker_show_layout( kicker_get_embed_video( $kicker_header_video ) ); ?></div>
		<?php
	}
}
