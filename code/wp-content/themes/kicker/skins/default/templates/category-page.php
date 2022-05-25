<?php
/**
 * The template to display the category's image, description on the Category page
 *
 * @package KICKER
 * @since KICKER 1.71.0
 */
?>

<div class="category_page category"><?php
	
	$kicker_cat = get_queried_object();
	$kicker_cat_img = kicker_get_term_image_small($kicker_cat->term_id, $kicker_cat->taxonomy);
	$kicker_cat_icon = '';
	if ( empty($kicker_cat_img) && function_exists('trx_addons_get_term_icon') ) {
		$kicker_cat_icon = trx_addons_get_term_icon($kicker_cat->term_id, $kicker_cat->taxonomy);
		if ( empty($kicker_cat_icon) || kicker_is_off($kicker_cat_icon) ) {
			$kicker_cat_img = kicker_get_term_image($kicker_cat->term_id, $kicker_cat->taxonomy);
		}
	}
	?><div class="category_image"><?php
		if ( !empty($kicker_cat_icon) && !kicker_is_off($kicker_cat_icon) ) {
			?><span class="category_icon <?php echo esc_attr($kicker_cat_icon); ?>"></span><?php
		} else {
			$src = empty($kicker_cat_img)
						? kicker_get_no_image() 
						: kicker_add_thumb_size( $kicker_cat_img, kicker_get_thumb_size('masonry') );
			if ( $src ) {				
				$attr = kicker_getimagesize($src);
				?><img src="<?php echo esc_url($src); ?>" <?php if (!empty($attr[3])) kicker_show_layout($attr[3]); ?> alt="<?php esc_attr_e('Category image', 'kicker'); ?>"><?php
			}
		}
	?></div><!-- .category_image -->

	<h4 class="category_title"><span class="fn"><?php echo esc_html($kicker_cat->name); ?></span></h4>

	<?php
	$kicker_cat_desc = $kicker_cat->description;
	if ( ! empty( $kicker_cat_desc ) ) {
		?>
		<div class="category_desc"><?php echo wp_kses( wpautop( $kicker_cat_desc ), 'kicker_kses_content' ); ?></div>
		<?php
	}
	?>

</div><!-- .category_page -->
