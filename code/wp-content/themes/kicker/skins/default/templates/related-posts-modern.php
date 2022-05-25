<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package KICKER
 * @since KICKER 1.0
 */

$kicker_link        = get_permalink();
$kicker_post_format = get_post_format();
$kicker_post_format = empty( $kicker_post_format ) ? 'standard' : str_replace( 'post-format-', '', $kicker_post_format );
?><div id="post-<?php the_ID(); ?>" <?php post_class( 'related_item post_format_' . esc_attr( $kicker_post_format ) ); ?> data-post-id="<?php the_ID(); ?>">
	<?php
	kicker_show_post_featured(
		array(
			'thumb_size'    => apply_filters( 'kicker_filter_related_thumb_size', kicker_get_thumb_size( (int) kicker_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'big' ) ),
			'post_info'     => '<div class="post_header entry-header">'
									. '<div class="post_categories">' . wp_kses( kicker_get_post_categories( '' ), 'kicker_kses_content' ) . '</div>'
									. '<h6 class="post_title entry-title"><a href="' . esc_url( $kicker_link ) . '">'
										. wp_kses_data( '' == get_the_title() ? esc_html__( '- No title -', 'kicker' ) : get_the_title() )
									. '</a></h6>'
									. ( in_array( get_post_type(), array( 'post', 'attachment' ) )
											? '<div class="post_meta"><a href="' . esc_url( $kicker_link ) . '" class="post_meta_item post_date">' . wp_kses_data( kicker_get_date() ) . '</a></div>'
											: '' )
								. '</div>',
		)
	);
	?>
</div>
