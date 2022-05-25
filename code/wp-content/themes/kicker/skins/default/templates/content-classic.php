<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package KICKER
 * @since KICKER 1.0
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
$kicker_expanded   = ! kicker_sidebar_present() && kicker_get_theme_option( 'expand_content' ) == 'expand';

$kicker_post_format = get_post_format();
$kicker_post_format = empty( $kicker_post_format ) ? 'standard' : str_replace( 'post-format-', '', $kicker_post_format );

?><div class="<?php
	if ( ! empty( $kicker_template_args['slider'] ) ) {
		echo ' slider-slide swiper-slide';
	} else {
		echo ( kicker_is_blog_style_use_masonry( $kicker_blog_style[0] )
			? 'masonry_item masonry_item-1_' . esc_attr( $kicker_columns )
			: esc_attr( $kicker_columns_class )
			);
	}
?>"><article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $kicker_post_format )
				. ' post_layout_classic post_layout_classic_' . esc_attr( $kicker_columns )
				. ' post_layout_' . esc_attr( $kicker_blog_style[0] )
				. ' post_layout_' . esc_attr( $kicker_blog_style[0] ) . '_' . esc_attr( $kicker_columns )
	);
	kicker_add_blog_animation( $kicker_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$kicker_hover      = ! empty( $kicker_template_args['hover'] ) && ! kicker_is_inherit( $kicker_template_args['hover'] )
							? $kicker_template_args['hover']
							: kicker_get_theme_option( 'image_hover' );

	$kicker_components = ! empty( $kicker_template_args['meta_parts'] )
							? ( is_array( $kicker_template_args['meta_parts'] )
								? $kicker_template_args['meta_parts']
								: explode( ',', $kicker_template_args['meta_parts'] )
								)
							: kicker_array_get_keys_by_value( kicker_get_theme_option( 'meta_parts' ) );

	kicker_show_post_featured( apply_filters( 'kicker_filter_args_featured',
		array(
			'thumb_size' => kicker_get_thumb_size(
				'classic' == $kicker_blog_style[0]
						? ( strpos( kicker_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $kicker_columns > 2 ? 'big' : 'huge' )
								: ( $kicker_columns > 2
									? ( $kicker_expanded ? 'med' : 'small' )
									: ( $kicker_expanded ? 'big' : 'med' )
									)
							)
						: ( strpos( kicker_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $kicker_columns > 2 ? 'masonry-big' : 'full' )
								: ( $kicker_columns <= 2 && $kicker_expanded ? 'masonry-big' : 'masonry' )
							)
			),
			'hover'      => $kicker_hover,
			'meta_parts' => $kicker_components,
			'no_links'   => ! empty( $kicker_template_args['no_links'] ),
		),
		'content-classic',
		$kicker_template_args
	) );

	// Title and post meta
	$kicker_show_title = get_the_title() != '';
	$kicker_show_meta  = count( $kicker_components ) > 0 && ! in_array( $kicker_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $kicker_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Categories
			if ( apply_filters( 'kicker_filter_show_blog_categories', $kicker_show_meta && in_array( 'categories', $kicker_components ), array( 'categories' ), 'classic' ) ) {
				do_action( 'kicker_action_before_post_category' );
				?>
				<div class="post_category">
					<?php
					kicker_show_post_meta( apply_filters(
														'kicker_filter_post_meta_args',
														array(
															'components' => 'categories',
															'seo'        => false,
															'echo'       => true,
															),
														'hover_' . $kicker_hover, 1
														)
										);
					?>
				</div>
				<?php
				$kicker_components = kicker_array_delete_by_value( $kicker_components, 'categories' );
				do_action( 'kicker_action_after_post_category' );
			}
			// Post title
			if ( apply_filters( 'kicker_filter_show_blog_title', true, 'classic' ) ) {
				do_action( 'kicker_action_before_post_title' );
				if ( empty( $kicker_template_args['no_links'] ) ) {
					the_title( sprintf( '<h5 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
				} else {
					the_title( '<h5 class="post_title entry-title">', '</h5>' );
				}
				do_action( 'kicker_action_after_post_title' );
			}
			?>
		</div><!-- .entry-header -->
		<?php
	}

	// Post content
	ob_start();
	if ( apply_filters( 'kicker_filter_show_blog_excerpt', empty( $kicker_template_args['hide_excerpt'] ) && kicker_get_theme_option( 'excerpt_length' ) > 0, 'classic' ) ) {
		kicker_show_post_content( $kicker_template_args, '<div class="post_content_inner">', '</div>' );
	}
	$kicker_content = ob_get_contents();
	ob_end_clean();

	kicker_show_layout( $kicker_content, '<div class="post_content entry-content">', '</div><!-- .entry-content -->' );

	// Post meta
	if ( apply_filters( 'kicker_filter_show_blog_meta', $kicker_show_meta, $kicker_components, 'classic' ) ) {
		if ( count( $kicker_components ) > 0 ) {
			do_action( 'kicker_action_before_post_meta' );
			kicker_show_post_meta(
				apply_filters(
					'kicker_filter_post_meta_args', array(
						'components' => join( ',', $kicker_components ),
						'seo'        => false,
						'echo'       => true,
						'author_avatar'   => false,
					), $kicker_blog_style[0], $kicker_columns
				)
			);
			do_action( 'kicker_action_after_post_meta' );
		}
	}
		
	// More button
	if ( apply_filters( 'kicker_filter_show_blog_readmore', ! $kicker_show_title || ! empty( $kicker_template_args['more_button'] ), 'classic' ) ) {
		if ( empty( $kicker_template_args['no_links'] ) ) {
			do_action( 'kicker_action_before_post_readmore' );
			kicker_show_post_more_link( $kicker_template_args, '<p>', '</p>' );
			do_action( 'kicker_action_after_post_readmore' );
		}
	}
	?>

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
