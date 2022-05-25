<?php
/**
 * The Header: Logo and main menu
 *
 * @package KICKER
 * @since KICKER 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js<?php
	// Class scheme_xxx need in the <html> as context for the <body>!
	echo ' scheme_' . esc_attr( kicker_get_theme_option( 'color_scheme' ) );
?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'kicker_action_before_body' );
	?>

	<div class="<?php echo esc_attr( apply_filters( 'kicker_filter_body_wrap_class', 'body_wrap' ) ); ?>" <?php do_action('kicker_action_body_wrap_attributes'); ?>>

		<?php do_action( 'kicker_action_before_page_wrap' ); ?>

		<div class="<?php echo esc_attr( apply_filters( 'kicker_filter_page_wrap_class', 'page_wrap' ) ); ?>" <?php do_action('kicker_action_page_wrap_attributes'); ?>>

			<?php do_action( 'kicker_action_page_wrap_start' ); ?>

			<?php
			$kicker_full_post_loading = ( kicker_is_singular( 'post' ) || kicker_is_singular( 'attachment' ) ) && kicker_get_value_gp( 'action' ) == 'full_post_loading';
			$kicker_prev_post_loading = ( kicker_is_singular( 'post' ) || kicker_is_singular( 'attachment' ) ) && kicker_get_value_gp( 'action' ) == 'prev_post_loading';

			// Don't display the header elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ! $kicker_full_post_loading && ! $kicker_prev_post_loading ) {

				// Short links to fast access to the content, sidebar and footer from the keyboard
				?>
				<a class="kicker_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to content", 'kicker' ); ?></a>
				<?php if ( kicker_sidebar_present() ) { ?>
				<a class="kicker_skip_link skip_to_sidebar_link" href="#sidebar_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to sidebar", 'kicker' ); ?></a>
				<?php } ?>
				<a class="kicker_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to footer", 'kicker' ); ?></a>

				<?php
				do_action( 'kicker_action_before_header' );

				// Header
				$kicker_header_type = kicker_get_theme_option( 'header_type' );
				if ( 'custom' == $kicker_header_type && ! kicker_is_layouts_available() ) {
					$kicker_header_type = 'default';
				}
				get_template_part( apply_filters( 'kicker_filter_get_template_part', "templates/header-" . sanitize_file_name( $kicker_header_type ) ) );

				// Side menu
				if ( in_array( kicker_get_theme_option( 'menu_side' ), array( 'left', 'right' ) ) ) {
					get_template_part( apply_filters( 'kicker_filter_get_template_part', 'templates/header-navi-side' ) );
				}

				// Mobile menu
				get_template_part( apply_filters( 'kicker_filter_get_template_part', 'templates/header-navi-mobile' ) );

				do_action( 'kicker_action_after_header' );

			}
			?>

			<?php do_action( 'kicker_action_before_page_content_wrap' ); ?>

			<div class="page_content_wrap<?php
				if ( kicker_is_off( kicker_get_theme_option( 'remove_margins' ) ) ) {
					if ( empty( $kicker_header_type ) ) {
						$kicker_header_type = kicker_get_theme_option( 'header_type' );
					}
					if ( 'custom' == $kicker_header_type && kicker_is_layouts_available() ) {
						$kicker_header_id = kicker_get_custom_header_id();
						if ( $kicker_header_id > 0 ) {
							$kicker_header_meta = kicker_get_custom_layout_meta( $kicker_header_id );
							if ( ! empty( $kicker_header_meta['margin'] ) ) {
								?> page_content_wrap_custom_header_margin<?php
							}
						}
					}
					$kicker_footer_type = kicker_get_theme_option( 'footer_type' );
					if ( 'custom' == $kicker_footer_type && kicker_is_layouts_available() ) {
						$kicker_footer_id = kicker_get_custom_footer_id();
						if ( $kicker_footer_id ) {
							$kicker_footer_meta = kicker_get_custom_layout_meta( $kicker_footer_id );
							if ( ! empty( $kicker_footer_meta['margin'] ) ) {
								?> page_content_wrap_custom_footer_margin<?php
							}
						}
					}
				}
				do_action( 'kicker_action_page_content_wrap_class', $kicker_prev_post_loading );
				?>"<?php
				if ( apply_filters( 'kicker_filter_is_prev_post_loading', $kicker_prev_post_loading ) ) {
					?> data-single-style="<?php echo esc_attr( kicker_get_theme_option( 'single_style' ) ); ?>"<?php
				}
				do_action( 'kicker_action_page_content_wrap_data', $kicker_prev_post_loading );
			?>>
				<?php
				do_action( 'kicker_action_page_content_wrap', $kicker_full_post_loading || $kicker_prev_post_loading );

				// Single posts banner
				if ( apply_filters( 'kicker_filter_single_post_header', kicker_is_singular( 'post' ) || kicker_is_singular( 'attachment' ) ) ) {
					if ( $kicker_prev_post_loading ) {
						if ( kicker_get_theme_option( 'posts_navigation_scroll_which_block' ) != 'article' ) {
							do_action( 'kicker_action_between_posts' );
						}
					}
					// Single post thumbnail and title
					$kicker_path = apply_filters( 'kicker_filter_get_template_part', 'templates/single-styles/' . kicker_get_theme_option( 'single_style' ) );
					if ( kicker_get_file_dir( $kicker_path . '.php' ) != '' ) {
						get_template_part( $kicker_path );
					}
				}

				// Widgets area above page
				$kicker_body_style   = kicker_get_theme_option( 'body_style' );
				$kicker_widgets_name = kicker_get_theme_option( 'widgets_above_page' );
				$kicker_show_widgets = ! kicker_is_off( $kicker_widgets_name ) && is_active_sidebar( $kicker_widgets_name );
				if ( $kicker_show_widgets ) {
					if ( 'fullscreen' != $kicker_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					kicker_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $kicker_body_style ) {
						?>
						</div>
						<?php
					}
				}

				// Content area
				do_action( 'kicker_action_before_content_wrap' );
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $kicker_body_style ? '_fullscreen' : ''; ?>">

					<div class="content">
						<?php
						do_action( 'kicker_action_page_content_start' );

						// Skip link anchor to fast access to the content from keyboard
						?>
						<a id="content_skip_link_anchor" class="kicker_skip_link_anchor" href="#"></a>
						<?php
						// Single posts banner between prev/next posts
						if ( ( kicker_is_singular( 'post' ) || kicker_is_singular( 'attachment' ) )
							&& $kicker_prev_post_loading 
							&& kicker_get_theme_option( 'posts_navigation_scroll_which_block' ) == 'article'
						) {
							do_action( 'kicker_action_between_posts' );
						}

						// Widgets area above content
						kicker_create_widgets_area( 'widgets_above_content' );

						do_action( 'kicker_action_page_content_start_text' );
