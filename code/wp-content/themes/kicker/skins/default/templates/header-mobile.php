<?php
/**
 * The template to show mobile header (used only header_style == 'default')
 *
 * @package KICKER
 * @since KICKER 1.0.39
 */

// Additional info
if ( kicker_is_off( kicker_get_theme_option( 'header_mobile_hide_info' ) ) ) {
	$kicker_info = kicker_get_theme_option( 'header_mobile_additional_info' );
	if ( '' != $kicker_info ) {
		?><div class="top_panel_mobile_info sc_layouts_row sc_layouts_row_type_compact sc_layouts_row_delimiter sc_layouts_hide_on_large sc_layouts_hide_on_desktop sc_layouts_hide_on_notebook sc_layouts_hide_on_tablet">
			<div class="content_wrap">
				<div class="columns_wrap">
					<div class="sc_layouts_column sc_layouts_column_align_center sc_layouts_column_icons_position_left column-1_1"><div class="sc_layouts_item">
						<?php
						kicker_show_layout( $kicker_info );
						?>
						</div><!-- /.sc_layouts_item -->
					</div><!-- /.sc_layouts_column -->
				</div><!-- /.columns_wrap -->
			</div><!-- /.content_wrap -->
		</div><!-- /.sc_layouts_row -->
		<?php
	}
}

// Logo, menu and buttons
?>
<div class="top_panel_mobile_navi sc_layouts_row sc_layouts_row_type_compact sc_layouts_row_delimiter sc_layouts_row_fixed sc_layouts_row_fixed_always sc_layouts_hide_on_large sc_layouts_hide_on_desktop sc_layouts_hide_on_notebook sc_layouts_hide_on_tablet">
	<div class="content_wrap">
		<div class="columns_wrap columns_fluid">
			<div class="sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left sc_layouts_column_fluid column-1_3">
				<?php
				// Logo
				if ( kicker_is_off( kicker_get_theme_option( 'header_mobile_hide_logo' ) ) ) {
					?>
					<div class="sc_layouts_item">
						<?php
						set_query_var( 'kicker_logo_args', array( 'type' => 'mobile_header' ) );
						get_template_part( apply_filters( 'kicker_filter_get_template_part', 'templates/header-logo' ) );
						set_query_var( 'kicker_logo_args', array() );
						?>
					</div>
					<?php
				}
				?>
			</div><div class="sc_layouts_column sc_layouts_column_align_right sc_layouts_column_icons_position_left sc_layouts_column_fluid  column-2_3">
				<?php
				if ( kicker_exists_trx_addons() ) {
					// Display login/logout
					if ( kicker_is_off( kicker_get_theme_option( 'header_mobile_hide_login' ) ) ) {
						ob_start();
						do_action(
							'kicker_action_login', array(
								'text_login'  => false,
								'text_logout' => false,
							)
						);
						$kicker_action_output = ob_get_contents();
						ob_end_clean();
						if ( ! empty( $kicker_action_output ) ) {
							?>
								<div class="sc_layouts_item sc_layouts_menu sc_layouts_menu_default">
										<?php
										kicker_show_layout( $kicker_action_output );
										?>
								</div>
										<?php
						}
					}
					// Display cart button
					if ( kicker_is_off( kicker_get_theme_option( 'header_mobile_hide_cart' ) ) ) {
						ob_start();
						do_action( 'kicker_action_cart' );
						$kicker_action_output = ob_get_contents();
						ob_end_clean();
						if ( ! empty( $kicker_action_output ) ) {
							?>
								<div class="sc_layouts_item">
								<?php
								kicker_show_layout( $kicker_action_output );
								?>
								</div>
								<?php
						}
					}
					// Display search field
					if ( kicker_is_off( kicker_get_theme_option( 'header_mobile_hide_search' ) ) ) {
						ob_start();
						do_action(
							'kicker_action_search',
							array(
								'style' => 'fullscreen',
								'class' => 'header_mobile_search',
								'ajax'  => false
							)
						);
						$kicker_action_output = ob_get_contents();
						ob_end_clean();
						if ( ! empty( $kicker_action_output ) ) {
							?>
								<div class="sc_layouts_item">
								<?php
								kicker_show_layout( $kicker_action_output );
								?>
								</div>
								<?php
						}
					}
				}

				// Mobile menu button
				?>
				<div class="sc_layouts_item">
					<div class="sc_layouts_iconed_text sc_layouts_menu_mobile_button">
						<a class="sc_layouts_item_link sc_layouts_iconed_text_link" href="#">
							<span class="sc_layouts_item_icon sc_layouts_iconed_text_icon trx_addons_icon-menu"></span>
						</a>
					</div>
				</div>
			</div><!-- /.sc_layouts_column -->
		</div><!-- /.columns_wrap -->
	</div><!-- /.content_wrap -->
</div><!-- /.sc_layouts_row -->
