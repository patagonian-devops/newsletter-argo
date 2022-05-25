<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package KICKER
 * @since KICKER 1.0
 */

// Page (category, tag, archive, author) title

if ( kicker_need_page_title() ) {
	kicker_sc_layouts_showed( 'title', true );
	kicker_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								kicker_show_post_meta(
									apply_filters(
										'kicker_filter_post_meta_args', array(
											'components' => join( ',', kicker_array_get_keys_by_value( kicker_get_theme_option( 'meta_parts' ) ) ),
											'counters'   => join( ',', kicker_array_get_keys_by_value( kicker_get_theme_option( 'counters' ) ) ),
											'seo'        => kicker_is_on( kicker_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$kicker_blog_title           = kicker_get_blog_title();
							$kicker_blog_title_text      = '';
							$kicker_blog_title_class     = '';
							$kicker_blog_title_link      = '';
							$kicker_blog_title_link_text = '';
							if ( is_array( $kicker_blog_title ) ) {
								$kicker_blog_title_text      = $kicker_blog_title['text'];
								$kicker_blog_title_class     = ! empty( $kicker_blog_title['class'] ) ? ' ' . $kicker_blog_title['class'] : '';
								$kicker_blog_title_link      = ! empty( $kicker_blog_title['link'] ) ? $kicker_blog_title['link'] : '';
								$kicker_blog_title_link_text = ! empty( $kicker_blog_title['link_text'] ) ? $kicker_blog_title['link_text'] : '';
							} else {
								$kicker_blog_title_text = $kicker_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $kicker_blog_title_class ); ?>">
								<?php
								$kicker_top_icon = kicker_get_term_image_small();
								if ( ! empty( $kicker_top_icon ) ) {
									$kicker_attr = kicker_getimagesize( $kicker_top_icon );
									?>
									<img src="<?php echo esc_url( $kicker_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'kicker' ); ?>"
										<?php
										if ( ! empty( $kicker_attr[3] ) ) {
											kicker_show_layout( $kicker_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $kicker_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $kicker_blog_title_link ) && ! empty( $kicker_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $kicker_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $kicker_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( ! is_paged() && ( is_category() || is_tag() || is_tax() ) ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						ob_start();
						do_action( 'kicker_action_breadcrumbs' );
						$kicker_breadcrumbs = ob_get_contents();
						ob_end_clean();
						kicker_show_layout( $kicker_breadcrumbs, '<div class="sc_layouts_title_breadcrumbs">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
