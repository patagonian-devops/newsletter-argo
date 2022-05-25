<?php
/**
 * Generate custom CSS for theme hovers
 *
 * @package KICKER
 * @since KICKER 1.0
 */

// Theme init priorities:
// 3 - add/remove Theme Options elements
if ( ! function_exists( 'kicker_hovers_theme_setup3' ) ) {
	add_action( 'after_setup_theme', 'kicker_hovers_theme_setup3', 3 );
	function kicker_hovers_theme_setup3() {

		// Add 'Buttons hover' option
		kicker_storage_set_array_after(
			'options', 'border_radius', array(
				'button_hover' => array(
					'title'   => esc_html__( "Button hover", 'kicker' ),
					'desc'    => wp_kses_data( __( 'Select a hover effect for theme buttons', 'kicker' ) ),
					'std'     => 'default',
					'options' => array(
						'default'      => esc_html__( 'Fade', 'kicker' ),
						'slide_left'   => esc_html__( 'Slide from Left', 'kicker' ),
						'slide_right'  => esc_html__( 'Slide from Right', 'kicker' ),
						'slide_top'    => esc_html__( 'Slide from Top', 'kicker' ),
						'slide_bottom' => esc_html__( 'Slide from Bottom', 'kicker' ),
					),
					'type'    => 'hidden',
				),
				'image_hover'  => array(
					'title'    => esc_html__( "Image hover", 'kicker' ),
					'desc'     => wp_kses_data( __( 'Select a hover effect for theme images', 'kicker' ) ),
					'std'      => 'inherit',
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'kicker' ),
					),
					'options'  => kicker_get_list_hovers(),
					'type'     => 'select',
					'type'     => 'hidden',
				),
			)
		);
	}
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'kicker_hovers_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'kicker_hovers_theme_setup9', 9 );
	function kicker_hovers_theme_setup9() {
		add_action( 'wp_enqueue_scripts', 'kicker_hovers_frontend_scripts', 1100 );      // Priority 1100 -  after theme scripts (1000)
		add_action( 'wp_enqueue_scripts', 'kicker_hovers_frontend_styles', 1100 );       // Priority 1100 -  after theme/skin styles (1050)
		add_action( 'wp_enqueue_scripts', 'kicker_hovers_responsive_styles', 2100 );     // Priority 2100 -  after theme/skin responsive (2000)
		add_filter( 'kicker_filter_localize_script', 'kicker_hovers_localize_script' );
		add_filter( 'kicker_filter_merge_scripts', 'kicker_hovers_merge_scripts' );
		add_filter( 'kicker_filter_merge_styles', 'kicker_hovers_merge_styles' );
		add_filter( 'kicker_filter_merge_styles_responsive', 'kicker_hovers_merge_styles_responsive' );
	}
}

// Enqueue hover styles and scripts
if ( ! function_exists( 'kicker_hovers_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'kicker_hovers_frontend_scripts', 1100 );
	function kicker_hovers_frontend_scripts() {
		if ( kicker_is_on( kicker_get_theme_option( 'debug_mode' ) ) ) {
			$kicker_url = kicker_get_file_url( 'theme-specific/theme-hovers/theme-hovers.js' );
			if ( '' != $kicker_url ) {
				wp_enqueue_script( 'kicker-hovers', $kicker_url, array( 'jquery' ), null, true );
			}
		}
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'kicker_hovers_frontend_styles' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'kicker_hovers_frontend_styles', 1100 );
	function kicker_hovers_frontend_styles() {
		if ( kicker_is_on( kicker_get_theme_option( 'debug_mode' ) ) ) {
			$kicker_url = kicker_get_file_url( 'theme-specific/theme-hovers/theme-hovers.css' );
			if ( '' != $kicker_url ) {
				wp_enqueue_style( 'kicker-hovers', $kicker_url, array(), null );
			}
		}
	}
}

// Enqueue responsive styles for frontend
if ( ! function_exists( 'kicker_hovers_responsive_styles' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'kicker_hovers_responsive_styles', 2100 );
	function kicker_hovers_responsive_styles() {
		if ( kicker_is_on( kicker_get_theme_option( 'debug_mode' ) ) ) {
			$kicker_url = kicker_get_file_url( 'theme-specific/theme-hovers/theme-hovers-responsive.css' );
			if ( '' != $kicker_url ) {
				wp_enqueue_style( 'kicker-hovers-responsive', $kicker_url, array(), null, kicker_media_for_load_css_responsive( 'hovers' ) );
			}
		}
	}
}

// Merge hover effects into single css
if ( ! function_exists( 'kicker_hovers_merge_styles' ) ) {
	//Handler of the add_filter( 'kicker_filter_merge_styles', 'kicker_hovers_merge_styles' );
	function kicker_hovers_merge_styles( $list ) {
		$list[] = 'theme-specific/theme-hovers/theme-hovers.css';
		return $list;
	}
}

// Merge hover effects to the single css (responsive)
if ( ! function_exists( 'kicker_hovers_merge_styles_responsive' ) ) {
	//Handler of the add_filter( 'kicker_filter_merge_styles_responsive', 'kicker_hovers_merge_styles_responsive' );
	function kicker_hovers_merge_styles_responsive( $list ) {
		$list[] = 'theme-specific/theme-hovers/theme-hovers-responsive.css';
		return $list;
	}
}

// Add hover effect's vars to the localize array
if ( ! function_exists( 'kicker_hovers_localize_script' ) ) {
	//Handler of the add_filter( 'kicker_filter_localize_script','kicker_hovers_localize_script' );
	function kicker_hovers_localize_script( $arr ) {
		$arr['button_hover'] = kicker_get_theme_option( 'button_hover' );
		return $arr;
	}
}

// Merge hover effects to the single js
if ( ! function_exists( 'kicker_hovers_merge_scripts' ) ) {
	//Handler of the add_filter( 'kicker_filter_merge_scripts', 'kicker_hovers_merge_scripts' );
	function kicker_hovers_merge_scripts( $list ) {
		$list[] = 'theme-specific/theme-hovers/theme-hovers.js';
		return $list;
	}
}

// Add hover icons on the featured image
if ( ! function_exists( 'kicker_hovers_add_icons' ) ) {
	function kicker_hovers_add_icons( $hover, $args = array() ) {
		// Reviews
		if ( ( !kicker_exists_woocommerce() || ( kicker_exists_woocommerce() && !is_woocommerce() ) ) && 'shop_buttons' != $hover && 'shop' != $hover) {
			if ( kicker_exists_trx_addons() && in_array('rating', $args['meta_parts']) ) {
				$trx_addons_meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
				if ( ! empty( $trx_addons_meta['reviews_mark'] ) ) { 
					$trx_addons_reviews_max  = trx_addons_get_option('reviews_mark_max');
					$trx_addons_reviews_decimals = trx_addons_get_option('reviews_mark_decimals');
					$trx_addons_reviews_mark = trx_addons_reviews_mark2show( $trx_addons_meta['reviews_mark'], $trx_addons_reviews_max ); ?>
					<div class="post_hover_rating">
						<div class="trx_addons_reviews_block_mark">
							<canvas id="sc_reviews_<?php echo esc_attr(get_the_ID()); ?>_mark" 
								width="56" height="56" 
								data-max-value="<?php echo esc_attr($trx_addons_reviews_max); ?>" 
								data-decimals="<?php echo esc_attr($trx_addons_reviews_decimals); ?>"
								data-value="<?php echo esc_attr($trx_addons_reviews_mark); ?>" 
								data-color="<?php echo esc_attr( apply_filters('trx_addons_filter_get_theme_accent_color', '#efa758') ); ?>"></canvas>					
							<span class="trx_addons_reviews_block_mark_value" data-max-value="<?php echo esc_attr($trx_addons_reviews_max); ?>"  data-decimals="<?php echo esc_attr($trx_addons_reviews_decimals); ?>"><?php
								echo esc_html( $trx_addons_reviews_mark );
							?></span>
							<span class="trx_addons_reviews_block_mark_progress"></span>
						</div>
					</div><?php
				}			
			}			
		}
		// Additional parameters
		$args = array_merge(
			array(
				'cat'        => '',
				'image'      => null,
				'no_links'   => false,
				'link'       => '',
				'post_info'  => '',
				'meta_parts' => ''
			), $args
		);

		$post_link = empty( $args['no_links'] )
						? ( ! empty( $args['link'] )
							? $args['link']
							: apply_filters( 'kicker_filter_get_post_link', get_permalink() )
							)
						: '';
		$no_link   = 'javascript:void(0)';
		$target    = ! empty( $post_link ) && false === strpos( $post_link, home_url() )
						? ' target="_blank" rel="nofollow"'
						: '';

		if ( in_array( $hover, array( 'icons', 'zoom' ) ) ) {
			// Hover style 'Icons and 'Zoom'
			if ( $args['image'] ) {
				$large_image = $args['image'];
			} else {
				$attachment = wp_get_attachment_image_src( get_post_thumbnail_id(), 'masonry-big' );
				if ( ! empty( $attachment[0] ) ) {
					$large_image = $attachment[0];
				}
			}
			?>
			<div class="icons">
				<a href="<?php echo ! empty( $post_link ) ? esc_url( $post_link ) : esc_attr( $no_link ); ?>" <?php kicker_show_layout($target); ?> aria-hidden="true" class="icon-link
									<?php
									if ( empty( $large_image ) ) {
										echo ' single_icon';
									}
									?>
				"></a>
				<?php if ( ! empty( $large_image ) ) { ?>
				<a href="<?php echo esc_url( $large_image ); ?>" aria-hidden="true" class="icon-search" title="<?php the_title_attribute( '' ); ?>"></a>
				<?php } ?>
			</div>
			<?php

		} elseif ( 'shop' == $hover || 'shop_buttons' == $hover ) {
			// Hover style 'Shop'
			global $product;
			?>
			<div class="icons">
				<a href="<?php echo esc_url( is_object( $args['cat'] ) ? get_term_link( $args['cat']->slug, 'product_cat' ) : get_permalink() ); ?>" aria-hidden="true" class="shop_link button icon-link">
				<?php
				if ( 'shop_buttons' == $hover ) {
					if ( is_object( $args['cat'] ) ) {
						esc_html_e( 'View products', 'kicker' );
					} else {
						esc_html_e( 'Details', 'kicker' );
					}
				}
				?>
				</a>
				<?php
				if ( ! is_object( $args['cat'] ) ) {
					kicker_show_layout(
						apply_filters(
							'woocommerce_loop_add_to_cart_link',
							'<a rel="nofollow" href="' . esc_url( $product->add_to_cart_url() ) . '" 
														aria-hidden="true" 
														data-quantity="1" 
														data-product_id="' . esc_attr( $product->is_type( 'variation' ) ? $product->get_parent_id() : $product->get_id() ) . '"
														data-product_sku="' . esc_attr( $product->get_sku() ) . '"
														class="shop_cart icon-cart-2 button add_to_cart_button'
																. ' product_type_' . $product->get_type()
																. ' product_' . ( $product->is_purchasable() && $product->is_in_stock() ? 'in' : 'out' ) . '_stock'
																. ( $product->supports( 'ajax_add_to_cart' ) ? ' ajax_add_to_cart' : '' )
																. '">'
											. ( 'shop_buttons' == $hover ? ( $product->is_type( 'variable' ) ? esc_html__( 'Select options', 'kicker' ) : esc_html__( 'Buy now', 'kicker' ) ) : '' )
										. '</a>',
							$product
						)
					);
				}
				?>				
			</div>
			<?php

		} elseif ( 'icon' == $hover ) {
			// Hover style 'Icon'
			?>
			<div class="icons"><a href="<?php echo ! empty( $post_link ) ? esc_url( $post_link ) : esc_attr( $no_link ); ?>" <?php kicker_show_layout($target); ?> aria-hidden="true" class="icon-search-alt"></a></div>
			<?php

		} elseif ( 'dots' == $hover ) {
			// Hover style 'Dots'
			?>
			<a href="<?php echo ! empty( $post_link ) ? esc_url( $post_link ) : esc_attr( $no_link ); ?>" <?php kicker_show_layout($target); ?> aria-hidden="true" class="icons"><span></span><span></span><span></span></a>
			<?php

		} elseif ( 'info' == $hover ) {
			// Hover style 'Info'
			if ( ! empty( $args['post_info'] ) ) {
				kicker_show_layout( $args['post_info'] );
			} else {
				$kicker_components = empty( $args['meta_parts'] )
										? kicker_array_get_keys_by_value( kicker_get_theme_option( 'meta_parts' ) )
										: ( is_array( $args['meta_parts'] )
											? $args['meta_parts']
											: explode( ',', $args['meta_parts'] )
											);
				?>
				<div class="post_info">
					<?php
					if ( in_array( 'categories', $kicker_components ) ) {
						if ( apply_filters( 'kicker_filter_show_blog_categories', true, array( 'categories' ) ) ) {
							?>
							<div class="post_category">
								<?php
								$categories = kicker_show_post_meta( apply_filters(
																	'kicker_filter_post_meta_args',
																	array(
																		'components' => 'categories',
																		'seo'        => false,
																		'echo'       => false,
																		),
																	'hover_' . $hover, 1
																	)
													);
								kicker_show_layout( str_replace( ', ', '', $categories ) );
								?>
							</div>
							<?php
						}
						$kicker_components = kicker_array_delete_by_value( $kicker_components, 'categories' );
					}
					if ( apply_filters( 'kicker_filter_show_blog_title', true ) ) {
						?>
						<h4 class="post_title">
							<?php
							if ( ! empty( $post_link ) ) {
								?>
								<a href="<?php echo esc_url( $post_link ); ?>" <?php kicker_show_layout($target); ?>>
								<?php
							}
							the_title();
							if ( ! empty( $post_link ) ) {
								?>
								</a>
								<?php
							}
							?>
						</h4>
						<?php
					}
					?>
					<div class="post_descr">
						<?php
						if ( ! empty( $kicker_components ) && count( $kicker_components ) > 0 ) {
							if ( apply_filters( 'kicker_filter_show_blog_meta', true, $kicker_components ) ) {
								kicker_show_post_meta(
									apply_filters(
										'kicker_filter_post_meta_args', array(
											'components' => join( ',', $kicker_components ),
											'seo'        => false,
											'echo'       => true,
										), 'hover_' . $hover, 1
									)
								);
							}
						}
						?>
					</div>
					<?php
					if ( ! empty( $post_link ) ) {
						?>
						<a class="post_link" href="<?php echo esc_url( $post_link ); ?>" <?php kicker_show_layout($target); ?>></a>
						<?php
					}
					?>
				</div>
				<?php
			}

		} elseif ( in_array( $hover, array( 'fade', 'pull', 'slide', 'border', 'excerpt' ) ) ) {
			// Hover style 'Fade', 'Slide', 'Pull', 'Border', 'Excerpt'
			if ( ! empty( $args['post_info'] ) ) {
				kicker_show_layout( $args['post_info'] );
			} else {
				?>
				<div class="post_info">
					<div class="post_info_back">
						<?php
						if ( apply_filters( 'kicker_filter_show_blog_title', true ) ) {
							?>
							<h4 class="post_title">
								<?php
								if ( ! empty( $post_link ) ) {
									?>
									<a href="<?php echo esc_url( $post_link ); ?>" <?php kicker_show_layout($target); ?>>
									<?php
								}
								the_title();
								if ( ! empty( $post_link ) ) {
									?>
									</a>
									<?php
								}
								?>
							</h4>
							<?php
						}
						?>
						<div class="post_descr">
							<?php
							if ( 'excerpt' != $hover ) {
								$kicker_components = empty( $args['meta_parts'] )
														? kicker_array_get_keys_by_value( kicker_get_theme_option( 'meta_parts' ) )
														: ( is_array( $args['meta_parts'] )
															? $args['meta_parts']
															: explode( ',', $args['meta_parts'] )
															);
								if ( ! empty( $kicker_components ) ) {
									if ( apply_filters( 'kicker_filter_show_blog_meta', true, $kicker_components ) ) {
										kicker_show_post_meta(
											apply_filters(
												'kicker_filter_post_meta_args', array(
													'components' => $kicker_components,
													'seo'        => false,
													'echo'       => true,
												), 'hover_' . $hover, 1
											)
										);
									}
								}
							}
							// Remove the condition below if you want display excerpt
							if ( 'excerpt' == $hover ) {
								if ( apply_filters( 'kicker_filter_show_blog_excerpt', true ) ) {
									?>
									<div class="post_excerpt"><?php
										kicker_show_layout( get_the_excerpt() );
									?></div>
									<?php
								}
							}
							?>
						</div>
						<?php
						if ( ! empty( $post_link ) ) {
							?>
							<a class="post_link" href="<?php echo esc_url( $post_link ); ?>" <?php kicker_show_layout($target); ?>></a>
							<?php
						}
						?>
					</div>
					<?php
					if ( ! empty( $post_link ) ) {
						?>
						<a class="post_link" href="<?php echo esc_url( $post_link ); ?>" <?php kicker_show_layout($target); ?>></a>
						<?php
					}
					?>
				</div>
				<?php
			}

		} elseif ( ! empty( $post_link ) ) {
			// Hover style empty
			?>
			<a href="<?php echo esc_url( $post_link ); ?>" <?php kicker_show_layout($target); ?> aria-hidden="true" class="icons"></a>
			<?php
		}
	}
}
