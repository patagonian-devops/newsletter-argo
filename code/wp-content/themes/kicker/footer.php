<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package KICKER
 * @since KICKER 1.0
 */

							do_action( 'kicker_action_page_content_end_text' );
							
							// Widgets area below the content
							kicker_create_widgets_area( 'widgets_below_content' );
						
							do_action( 'kicker_action_page_content_end' );
							?>
						</div>
						<?php

						// Show main sidebar
						get_sidebar();
						?>
					</div>
					<?php

					do_action( 'kicker_action_after_content_wrap' );

					// Widgets area below the page and related posts below the page
					$kicker_body_style = kicker_get_theme_option( 'body_style' );
					$kicker_widgets_name = kicker_get_theme_option( 'widgets_below_page' );
					$kicker_show_widgets = ! kicker_is_off( $kicker_widgets_name ) && is_active_sidebar( $kicker_widgets_name );
					$kicker_show_related = kicker_is_single() && kicker_get_theme_option( 'related_position' ) == 'below_page';
					if ( $kicker_show_widgets || $kicker_show_related ) {
						if ( 'fullscreen' != $kicker_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $kicker_show_related ) {
							do_action( 'kicker_action_related_posts' );
						}

						// Widgets area below page content
						if ( $kicker_show_widgets ) {
							kicker_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $kicker_body_style ) {
							?>
							</div>
							<?php
						}
					}
					do_action( 'kicker_action_page_content_wrap_end' );
					?>
			</div>
			<?php
			do_action( 'kicker_action_after_page_content_wrap' );

			// Don't display the footer elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ( ! kicker_is_singular( 'post' ) && ! kicker_is_singular( 'attachment' ) ) || ! in_array ( kicker_get_value_gp( 'action' ), array( 'full_post_loading', 'prev_post_loading' ) ) ) {
				
				// Skip link anchor to fast access to the footer from keyboard
				?>
				<a id="footer_skip_link_anchor" class="kicker_skip_link_anchor" href="#"></a>
				<?php

				do_action( 'kicker_action_before_footer' );

				// Footer
				$kicker_footer_type = kicker_get_theme_option( 'footer_type' );
				if ( 'custom' == $kicker_footer_type && ! kicker_is_layouts_available() ) {
					$kicker_footer_type = 'default';
				}
				get_template_part( apply_filters( 'kicker_filter_get_template_part', "templates/footer-" . sanitize_file_name( $kicker_footer_type ) ) );

				do_action( 'kicker_action_after_footer' );

			}
			?>

			<?php do_action( 'kicker_action_page_wrap_end' ); ?>

		</div>

		<?php do_action( 'kicker_action_after_page_wrap' ); ?>

	</div>

	<?php do_action( 'kicker_action_after_body' ); ?>

	<?php wp_footer(); ?>

</body>
</html>