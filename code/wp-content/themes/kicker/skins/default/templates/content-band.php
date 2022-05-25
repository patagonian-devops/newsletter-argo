<?php
/**
 * 'Band' template to display the content
 *
 * Used for index/archive/search.
 *
 * @package KICKER
 * @since KICKER 1.71.0
 */

$kicker_template_args = get_query_var( 'kicker_template_args' );

$kicker_columns       = 1;

$kicker_expanded      = ! kicker_sidebar_present() && kicker_get_theme_option( 'expand_content' ) == 'expand';

$kicker_post_format   = get_post_format();
$kicker_post_format   = empty( $kicker_post_format ) ? 'standard' : str_replace( 'post-format-', '', $kicker_post_format );

if ( is_array( $kicker_template_args ) ) {
	$kicker_columns    = empty( $kicker_template_args['columns'] ) ? 1 : max( 1, $kicker_template_args['columns'] );
	$kicker_blog_style = array( $kicker_template_args['type'], $kicker_columns );
	if ( ! empty( $kicker_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide"><?php
	} elseif ( $kicker_columns > 1 ) {
		$kicker_columns_class = kicker_get_column_class( 1, $kicker_columns, ! empty( $kicker_template_args['columns_tablet']) ? $kicker_template_args['columns_tablet'] : '', ! empty($kicker_template_args['columns_mobile']) ? $kicker_template_args['columns_mobile'] : '' );
		?><div class="<?php echo esc_attr( $kicker_columns_class ); ?>"><?php
	}
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_band post_format_' . esc_attr( $kicker_post_format ) );
	kicker_add_blog_animation( $kicker_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$kicker_hover      = ! empty( $kicker_template_args['hover'] ) && ! kicker_is_inherit( $kicker_template_args['hover'] )
							? $kicker_template_args['hover']
							: kicker_get_theme_option( 'image_hover' );
	$kicker_components = ! empty( $kicker_template_args['meta_parts'] )
							? ( is_array( $kicker_template_args['meta_parts'] )
								? $kicker_template_args['meta_parts']
								: array_map( 'trim', explode( ',', $kicker_template_args['meta_parts'] ) )
								)
							: kicker_array_get_keys_by_value( kicker_get_theme_option( 'meta_parts' ) );

	$kicker_show_title = get_the_title() != '';
	$kicker_show_meta  = count( $kicker_components ) > 0 && ! in_array( $kicker_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	// Post date
	if ( $kicker_show_meta && in_array( 'date', $kicker_components ) ) {
		?>
		<div class="post_date_wrap">
			<div class="day"><?php echo esc_html(get_the_date('d')); ?></div>
			<?php			
			kicker_show_post_meta( apply_filters(
												'kicker_filter_post_meta_args',
												array(
													'components' => 'date',
													'date_format' => 'M Y',
													'seo'        => false,
													'echo'       => true,
													),
												'band', 0
												)
								);
			?>
		</div>
		<?php
		$kicker_components = kicker_array_delete_by_value( $kicker_components, 'date' );
	}

	// Featured image
	kicker_show_post_featured( apply_filters( 'kicker_filter_args_featured', 
		array(
			'no_links'   => ! empty( $kicker_template_args['no_links'] ),
			'hover'      => $kicker_hover,
			'meta_parts' => $kicker_components,
			'thumb_bg'   => true,
			'thumb_ratio' => $kicker_post_format == 'image' ? '16:9' : '1:1',
			'thumb_size' => kicker_get_thumb_size( 'big' )
		),
		'content-band',
		$kicker_template_args
	) );

	?><div class="post_content_wrap"><?php
		// Title and post meta
		if ( $kicker_show_title ) {
			?>
			<div class="post_header entry-header">
				<?php
				// Categories
				if ( apply_filters( 'kicker_filter_show_blog_categories', $kicker_show_meta && in_array( 'categories', $kicker_components ), array( 'categories' ), 'band' ) ) {
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
				if ( apply_filters( 'kicker_filter_show_blog_title', true, 'band' ) ) {
					do_action( 'kicker_action_before_post_title' );
					$kicker_title_tag = $kicker_post_format == 'image' && !is_archive() && !is_home() ? 'h3' : 'h4';
					if ( empty( $kicker_template_args['no_links'] ) ) {
						the_title( sprintf( '<'.esc_html($kicker_title_tag).' class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></'.esc_html($kicker_title_tag).'>' );
					} else {
						the_title( '<'.esc_html($kicker_title_tag).' class="post_title entry-title">', '</'.esc_html($kicker_title_tag).'>' );
					}
					do_action( 'kicker_action_after_post_title' );
				}
				?>
			</div><!-- .post_header -->
			<?php
		}

		// Post content
		if ( ! isset( $kicker_template_args['excerpt_length'] ) && ! in_array( $kicker_post_format, array( 'gallery', 'audio', 'video' ) ) ) {
			$kicker_template_args['excerpt_length'] = 30;
		}
		if ( apply_filters( 'kicker_filter_show_blog_excerpt', empty( $kicker_template_args['hide_excerpt'] ) && kicker_get_theme_option( 'excerpt_length' ) > 0, 'band' ) ) {
			?>
			<div class="post_content entry-content">
				<?php
				// Post content area
				kicker_show_post_content( $kicker_template_args, '<div class="post_content_inner">', '</div>' );
				?>
			</div><!-- .entry-content -->
			<?php
		}
		// Post meta
		if ( false && apply_filters( 'kicker_filter_show_blog_meta', $kicker_show_meta, $kicker_components, 'band' ) ) {
			if ( count( $kicker_components ) > 0 ) {
				do_action( 'kicker_action_before_post_meta' );
				kicker_show_post_meta(
					apply_filters(
						'kicker_filter_post_meta_args', array(
							'components' => join( ',', $kicker_components ),
							'seo'        => false,
							'echo'       => true,
						), 'band', 1
					)
				);
				do_action( 'kicker_action_after_post_meta' );
			}
		}
		// More button
		if ( apply_filters( 'kicker_filter_show_blog_readmore', true, 'band' ) ) {
			if ( empty( $kicker_template_args['no_links'] ) ) {
				do_action( 'kicker_action_before_post_readmore' ); ?>
				<a class="sc_button sc_button_simple color_style_1" href="<?php echo esc_url( get_permalink() ); ?>">
					<span class="icon"></span>
				</a><?php
				do_action( 'kicker_action_after_post_readmore' );
			}
		}
		?>
	</div>
</article>
<?php

if ( is_array( $kicker_template_args ) ) {
	if ( ! empty( $kicker_template_args['slider'] ) || $kicker_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
