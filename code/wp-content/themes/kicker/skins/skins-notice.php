<?php
/**
 * The template to display Admin notices
 *
 * @package KICKER
 * @since KICKER 1.0.64
 */

$kicker_skins_url  = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$kicker_skins_args = get_query_var( 'kicker_skins_notice_args' );
?>
<div class="kicker_admin_notice kicker_skins_notice notice notice-info is-dismissible" data-notice="skins">
	<?php
	// Theme image
	$kicker_theme_img = kicker_get_file_url( 'screenshot.jpg' );
	if ( '' != $kicker_theme_img ) {
		?>
		<div class="kicker_notice_image"><img src="<?php echo esc_url( $kicker_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'kicker' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="kicker_notice_title">
		<?php esc_html_e( 'New skins available', 'kicker' ); ?>
	</h3>
	<?php

	// Description
	$kicker_total      = $kicker_skins_args['update'];	// Store value to the separate variable to avoid warnings from ThemeCheck plugin!
	$kicker_skins_msg  = $kicker_total > 0
							// Translators: Add new skins number
							? '<strong>' . sprintf( _n( '%d new version', '%d new versions', $kicker_total, 'kicker' ), $kicker_total ) . '</strong>'
							: '';
	$kicker_total      = $kicker_skins_args['free'];
	$kicker_skins_msg .= $kicker_total > 0
							? ( ! empty( $kicker_skins_msg ) ? ' ' . esc_html__( 'and', 'kicker' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d free skin', '%d free skins', $kicker_total, 'kicker' ), $kicker_total ) . '</strong>'
							: '';
	$kicker_total      = $kicker_skins_args['pay'];
	$kicker_skins_msg .= $kicker_skins_args['pay'] > 0
							? ( ! empty( $kicker_skins_msg ) ? ' ' . esc_html__( 'and', 'kicker' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d paid skin', '%d paid skins', $kicker_total, 'kicker' ), $kicker_total ) . '</strong>'
							: '';
	?>
	<div class="kicker_notice_text">
		<p>
			<?php
			// Translators: Add new skins info
			echo wp_kses_data( sprintf( __( "We are pleased to announce that %s are available for your theme", 'kicker' ), $kicker_skins_msg ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="kicker_notice_buttons">
		<?php
		// Link to the theme dashboard page
		?>
		<a href="<?php echo esc_url( $kicker_skins_url ); ?>" class="button button-primary"><i class="dashicons dashicons-update"></i> 
			<?php
			// Translators: Add theme name
			esc_html_e( 'Go to Skins manager', 'kicker' );
			?>
		</a>
	</div>
</div>
