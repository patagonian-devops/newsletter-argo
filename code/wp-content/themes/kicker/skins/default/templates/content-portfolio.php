<?php
/**
 * The Portfolio template to display the content
 *
 * Used for index/archive/search.
 *
 * @package KICKER
 * @since KICKER 1.0
 */

$kicker_template_args = get_query_var( 'kicker_template_args' );
if ( is_array( $kicker_template_args ) ) {
	$kicker_columns    = empty( $kicker_template_args['columns'] ) ? 2 : max( 1, $kicker_template_args['columns'] );
	$kicker_blog_style = array( $kicker_template_args['type'], $kicker_columns );
	$kicker_columns_class = kicker_get_column_class( 1, $kicker_columns, ! empty( $kicker_template_args['columns_tablet']) ? $kicker_template_args['columns_tablet'] : '', ! empty($kicker_template_args['columns_mobile']) ? $kicker_template_args['columns_mobile'] : '' );
} else {
	$kicker_blog_style = explode( '_', kicker_get_theme_option( 'blog_style' ) );
	$kicker_columns    = empty( $kicker_blog_style[1] ) ? 2 : max( 1, $kicker_blog_style[1] );
	$kicker_columns_class = kicker_get_column_class( 1, $kicker_columns );
}

$kicker_post_format = get_post_format();
$kicker_post_format = empty( $kicker_post_format ) ? 'standard' : str_replace( 'post-format-', '', $kicker_post_format );

$kicker_post_link = get_permalink();
$kicker_post_info = '';

?><div class="<?php
if ( ! empty( $kicker_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( kicker_is_blog_style_use_masonry( $kicker_blog_style[0] )
			? 'masonry_item masonry_item-1_' . esc_attr( $kicker_columns )
			: esc_attr( $kicker_columns_class )
			);
}
?>"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $kicker_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $kicker_columns )
		. ( 'portfolio' != $kicker_blog_style[0] ? ' ' . esc_attr( $kicker_blog_style[0] )  . '_' . esc_attr( $kicker_columns ) : '' )
	);
	kicker_add_blog_animation( $kicker_template_args );
	?>
>
<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$kicker_hover   = ! empty( $kicker_template_args['hover'] ) && ! kicker_is_inherit( $kicker_template_args['hover'] )
								? $kicker_template_args['hover']
								: kicker_get_theme_option( 'image_hover' );

	if ( 'dots' == $kicker_hover ) {
		$kicker_post_link = empty( $kicker_template_args['no_links'] )
								? ( ! empty( $kicker_template_args['link'] )
									? $kicker_template_args['link']
									: get_permalink()
									)
								: '';
		$kicker_target    = ! empty( $kicker_post_link ) && false === strpos( $kicker_post_link, home_url() )
								? ' target="_blank" rel="nofollow"'
								: '';
	}
	
	// Meta parts
	$kicker_components = ! empty( $kicker_template_args['meta_parts'] )
							? ( is_array( $kicker_template_args['meta_parts'] )
								? $kicker_template_args['meta_parts']
								: explode( ',', $kicker_template_args['meta_parts'] )
								)
							: kicker_array_get_keys_by_value( kicker_get_theme_option( 'meta_parts' ) );
	$kicker_show_meta  = count( $kicker_components ) > 0 && ! in_array( $kicker_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );


	ob_start();

	// Categories
	if ( apply_filters( 'kicker_filter_show_blog_categories', $kicker_show_meta && in_array( 'categories', $kicker_components ), array( 'categories' ), 'portfolio' ) ) {
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
	if ( apply_filters( 'kicker_filter_show_blog_title', true, 'portfolio' ) ) {
		do_action( 'kicker_action_before_post_title' );
		if ( empty( $kicker_template_args['no_links'] ) ) {
			the_title( sprintf( '<h5 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
		} else {
			the_title( '<h5 class="post_title entry-title">', '</h5>' );
		}
		do_action( 'kicker_action_after_post_title' );
	}

	// Post meta
	if ( apply_filters( 'kicker_filter_show_blog_meta', $kicker_show_meta, $kicker_components, 'portfolio' ) ) {
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

	$kicker_post_info = ob_get_contents();
	ob_end_clean();
							
	// Featured image
	kicker_show_post_featured( apply_filters( 'kicker_filter_args_featured', 
		array(
			'hover'         => $kicker_hover,
			'no_links'      => ! empty( $kicker_template_args['no_links'] ),
			'thumb_size'    => kicker_get_thumb_size(
									kicker_is_blog_style_use_masonry( $kicker_blog_style[0] )
										? (	strpos( kicker_get_theme_option( 'body_style' ), 'full' ) !== false || $kicker_columns < 3
											? 'masonry-big'
											: ( in_array($kicker_post_format, array('gallery', 'audio', 'video')) ? 'med' : 'masonry')
											)
										: (	strpos( kicker_get_theme_option( 'body_style' ), 'full' ) !== false || $kicker_columns < 3
											? 'big'
											: 'med'
											)
								),
    		'thumb_ratio' 	=> $kicker_post_format == 'gallery' ? '1:1' : '',
			'show_no_image' => true,
			'meta_parts'    => $kicker_components,
			'class'         => 'dots' == $kicker_hover ? 'hover_with_info' : '',
			'post_info'     => '<div class="post_info">' . $kicker_post_info . '</div>',
		),
		'content-portfolio',
		$kicker_template_args
	) );
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!