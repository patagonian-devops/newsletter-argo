<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package KICKER
 * @since KICKER 1.0.50
 */

$kicker_template_args = get_query_var( 'kicker_template_args' );
if ( is_array( $kicker_template_args ) ) {
	$kicker_columns       = empty( $kicker_template_args['columns'] ) ? 2 : max( 1, $kicker_template_args['columns'] );
	$kicker_blog_style    = array( $kicker_template_args['type'], $kicker_columns );
	$kicker_columns_class = kicker_get_column_class( 1, $kicker_columns, ! empty( $kicker_template_args['columns_tablet']) ? $kicker_template_args['columns_tablet'] : '', ! empty($kicker_template_args['columns_mobile']) ? $kicker_template_args['columns_mobile'] : '' );
} else {
	$kicker_blog_style    = explode( '_', kicker_get_theme_option( 'blog_style' ) );
	$kicker_columns       = empty( $kicker_blog_style[1] ) ? 2 : max( 1, $kicker_blog_style[1] );
	$kicker_columns_class = kicker_get_column_class( 1, $kicker_columns );
}
$kicker_blog_id       = kicker_get_custom_blog_id( join( '_', $kicker_blog_style ) );
$kicker_blog_style[0] = str_replace( 'blog-custom-', '', $kicker_blog_style[0] );
$kicker_expanded      = ! kicker_sidebar_present() && kicker_get_theme_option( 'expand_content' ) == 'expand';
$kicker_components    = ! empty( $kicker_template_args['meta_parts'] )
							? ( is_array( $kicker_template_args['meta_parts'] )
								? join( ',', $kicker_template_args['meta_parts'] )
								: $kicker_template_args['meta_parts']
								)
							: kicker_array_get_keys_by_value( kicker_get_theme_option( 'meta_parts' ) );
$kicker_post_format   = get_post_format();
$kicker_post_format   = empty( $kicker_post_format ) ? 'standard' : str_replace( 'post-format-', '', $kicker_post_format );

$kicker_blog_meta     = kicker_get_custom_layout_meta( $kicker_blog_id );
$kicker_custom_style  = ! empty( $kicker_blog_meta['scripts_required'] ) ? $kicker_blog_meta['scripts_required'] : 'none';

if ( ! empty( $kicker_template_args['slider'] ) || $kicker_columns > 1 || ! kicker_is_off( $kicker_custom_style ) ) {
	?><div class="<?php
		if ( ! empty( $kicker_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo esc_attr( kicker_is_off( $kicker_custom_style )
							? $kicker_columns_class
							: sprintf( '%1$s_item %1$s_item-1_%2$d', $kicker_custom_style, $kicker_columns )
							);
		}
	?>">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_item_container post_format_' . esc_attr( $kicker_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $kicker_columns )
					. ' post_layout_' . esc_attr( $kicker_blog_style[0] )
					. ' post_layout_' . esc_attr( $kicker_blog_style[0] ) . '_' . esc_attr( $kicker_columns )
					. ( ! kicker_is_off( $kicker_custom_style )
						? ' post_layout_' . esc_attr( $kicker_custom_style )
							. ' post_layout_' . esc_attr( $kicker_custom_style ) . '_' . esc_attr( $kicker_columns )
						: ''
						)
		);
	kicker_add_blog_animation( $kicker_template_args );
	?>
>
	<?php
	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}
	// Custom layout
	do_action( 'kicker_action_show_layout', $kicker_blog_id, get_the_ID() );
	?>
</article><?php
if ( ! empty( $kicker_template_args['slider'] ) || $kicker_columns > 1 || ! kicker_is_off( $kicker_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
