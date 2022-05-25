<?php
/**
 * The "Style 5" template to display the post header of the single post or attachment:
 * featured image and title placed in the post header
 *
 * @package KICKER
 * @since KICKER 1.75.0
 */

if ( apply_filters( 'kicker_filter_single_post_header', is_singular( 'post' ) || is_singular( 'attachment' ) ) ) {
	$kicker_post_format = str_replace( 'post-format-', '', get_post_format() );
	ob_start();
	// Featured image
	kicker_show_post_featured_image( array(
		'thumb_bg'  => true,
		'popup'    => true,
		'class_avg' => in_array( $kicker_post_format, array( 'video' ) ) ? 'content_wrap' : '',
	) );
	$kicker_post_header = ob_get_contents();
	ob_end_clean();
	$kicker_with_featured_image = kicker_is_with_featured_image( $kicker_post_header );
	// Post title and meta
	ob_start(); ?>
	<div class="content_wrap"><?php
		do_action( 'kicker_action_before_post_header' );
		kicker_sc_layouts_showed('title', false);
		kicker_show_post_title_and_meta( array(
											'content_wrap'  => true,
											'author_avatar' => true,
											'show_labels'   => false,
											'add_spaces'    => true,
											)
										);	
		do_action( 'kicker_action_after_post_header' ); ?>
	</div><?php
	$kicker_post_header .= ob_get_contents();
	ob_end_clean();

	if ( strpos( $kicker_post_header, 'post_featured' ) !== false
		|| strpos( $kicker_post_header, 'post_title' ) !== false
		|| strpos( $kicker_post_header, 'post_meta' ) !== false
	) {
		?>
		<div class="post_header_wrap post_header_wrap_in_header post_header_wrap_style_<?php
			echo esc_attr( kicker_get_theme_option( 'single_style' ) );
			if ( $kicker_with_featured_image ) {
				echo ' with_featured_image';
			}
		?>">
			<?php
			kicker_show_layout( $kicker_post_header );
			?>
		</div>
		<?php
	}
}
