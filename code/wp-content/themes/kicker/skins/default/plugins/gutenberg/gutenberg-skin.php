<?php
/* Gutenberg support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'kicker_gutenberg_blocks_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'kicker_gutenberg_blocks_theme_setup9', 9 );
    function kicker_gutenberg_blocks_theme_setup9() {        
        if ( kicker_is_off( kicker_get_theme_option( 'debug_mode' ) ) ) {
            remove_action( 'kicker_filter_merge_styles', 'kicker_skin_gutenberg_merge_styles' );
            remove_action( 'kicker_filter_merge_styles', 'kicker_gutenberg_merge_styles' );
        }
    }
}

// Load required styles and scripts for Gutenberg Editor mode
if ( ! function_exists( 'kicker_gutenberg_editor_scripts' ) ) {
    add_action( 'enqueue_block_editor_assets', 'kicker_gutenberg_editor_scripts');
    function kicker_gutenberg_editor_scripts() {
        // Editor styles 
        wp_enqueue_style( 'kicker-gutenberg', kicker_get_file_url( kicker_skins_get_current_skin_dir() . 'plugins/gutenberg/gutenberg.css' ), array(), null );
    }
}