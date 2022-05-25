<?php
/**
 * The default template to display the content of the single post or attachment
 *
 * @package KICKER
 * @since KICKER 1.0
 */
?>
<article id="post-<?php the_ID(); ?>"
	<?php
	post_class( 'post_item_single'
		. ' post_type_' . esc_attr( get_post_type() ) 
		. ' post_format_' . esc_attr( str_replace( 'post-format-', '', get_post_format() ) )
	);
	kicker_add_seo_itemprops();
	?>
>
<?php

	do_action( 'kicker_action_before_post_data' );
	kicker_add_seo_snippets();
	do_action( 'kicker_action_after_post_data' );

	do_action( 'kicker_action_before_post_content' );

	// Post content
	$kicker_content_single = kicker_get_theme_option( 'expand_content' );
	$kicker_sidebar_position = kicker_get_theme_option( 'sidebar_position' );
	$kicker_vertical_content = ( 'narrow' == $kicker_content_single && 'hide' == $kicker_sidebar_position ? kicker_get_theme_option( 'post_vertical_content' ) : '');
	$kicker_share_position = kicker_array_get_keys_by_value( kicker_get_theme_option( 'share_position' ) );
	?>
	<div class="post_content post_content_single entry-content<?php
		if ( in_array( 'left', $kicker_share_position ) ) {
			echo ' post_info_vertical_present' . ( in_array( 'top', $kicker_share_position ) ? ' post_info_vertical_hide_on_mobile' : '' );
		}
	?>" itemprop="mainEntityOfPage">
		<?php
		if ( in_array( 'left', $kicker_share_position ) || !empty($kicker_vertical_content) ) {
			?><div class="post_info_vertical"><?php
				if ( in_array( 'left', $kicker_share_position ) && kicker_exists_trx_addons() ) {
					?><div class="post_info_vertical_share"><?php
						echo '<h5 class="post_share_label">' . esc_html__('Share This Article', 'kicker') . '</h5>';	
						kicker_show_post_meta(
							apply_filters(
								'kicker_filter_post_meta_args',
								array(
									'components'      => 'share',
									'class'           => 'post_share_horizontal',
									'share_type'      => 'block',
									'share_direction' => 'horizontal',
								),
								'single',
								1
							)
						); ?>
					</div><?php
				}
				if ( !empty($kicker_vertical_content) ) {
					?><div class="post_info_vertical_content"><?php
						kicker_show_layout($kicker_vertical_content);
					?></div><?php
				}
			?></div><?php
		}
		the_content();
		?>
	</div><!-- .entry-content -->
	<?php

	do_action( 'kicker_action_after_post_content' );
	
	// Post footer: Tags, likes, share, author, prev/next links and comments
	do_action( 'kicker_action_before_post_footer' );
	?>
	<div class="post_footer post_footer_single entry-footer">
		<?php
		kicker_show_post_pagination();
		if ( is_single() && ! is_attachment() ) {
			kicker_show_post_footer();
		}
		?>
	</div>
	<?php
	do_action( 'kicker_action_after_post_footer' );
	?>
</article>
