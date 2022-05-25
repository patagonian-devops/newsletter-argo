<?php
/**
 * The template to display single post
 *
 * @package KICKER
 * @since KICKER 1.0
 */

// Full post loading
$full_post_loading          = kicker_get_value_gp( 'action' ) == 'full_post_loading';

// Prev post loading
$prev_post_loading          = kicker_get_value_gp( 'action' ) == 'prev_post_loading';
$prev_post_loading_type     = kicker_get_theme_option( 'posts_navigation_scroll_which_block' );

// Position of the related posts
$kicker_related_position   = kicker_get_theme_option( 'related_position' );

// Type of the prev/next post navigation
$kicker_posts_navigation   = kicker_get_theme_option( 'posts_navigation' );
$kicker_prev_post          = false;
$kicker_prev_post_same_cat = kicker_get_theme_option( 'posts_navigation_scroll_same_cat' );

// Rewrite style of the single post if current post loading via AJAX and featured image and title is not in the content
if ( ( $full_post_loading 
		|| 
		( $prev_post_loading && 'article' == $prev_post_loading_type )
	) 
	&& 
	! in_array( kicker_get_theme_option( 'single_style' ), array( 'style-6' ) )
) {
	kicker_storage_set_array( 'options_meta', 'single_style', 'style-6' );
}

do_action( 'kicker_action_prev_post_loading', $prev_post_loading, $prev_post_loading_type );

get_header();

while ( have_posts() ) {

	the_post();

	// Type of the prev/next post navigation
	if ( 'scroll' == $kicker_posts_navigation ) {
		$kicker_prev_post = get_previous_post( $kicker_prev_post_same_cat );  // Get post from same category
		if ( ! $kicker_prev_post && $kicker_prev_post_same_cat ) {
			$kicker_prev_post = get_previous_post( false );                    // Get post from any category
		}
		if ( ! $kicker_prev_post ) {
			$kicker_posts_navigation = 'links';
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $kicker_prev_post ) ) {
		kicker_sc_layouts_showed( 'featured', false );
		kicker_sc_layouts_showed( 'title', false );
		kicker_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $kicker_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'kicker_filter_get_template_part', 'templates/content', 'single-' . kicker_get_theme_option( 'single_style' ) ), 'single-' . kicker_get_theme_option( 'single_style' ) );

	// If related posts should be inside the content
	if ( strpos( $kicker_related_position, 'inside' ) === 0 ) {
		$kicker_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'kicker_action_related_posts' );
		$kicker_related_content = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $kicker_related_content ) ) {
			$kicker_related_position_inside = max( 0, min( 9, kicker_get_theme_option( 'related_position_inside' ) ) );
			if ( 0 == $kicker_related_position_inside ) {
				$kicker_related_position_inside = mt_rand( 1, 9 );
			}

			$kicker_p_number         = 0;
			$kicker_related_inserted = false;
			$kicker_in_block         = false;
			$kicker_content_start    = strpos( $kicker_content, '<div class="post_content' );
			$kicker_content_end      = strrpos( $kicker_content, '</div>' );

			for ( $i = max( 0, $kicker_content_start ); $i < min( strlen( $kicker_content ) - 3, $kicker_content_end ); $i++ ) {
				if ( $kicker_content[ $i ] != '<' ) {
					continue;
				}
				if ( $kicker_in_block ) {
					if ( strtolower( substr( $kicker_content, $i + 1, 12 ) ) == '/blockquote>' ) {
						$kicker_in_block = false;
						$i += 12;
					}
					continue;
				} else if ( strtolower( substr( $kicker_content, $i + 1, 10 ) ) == 'blockquote' && in_array( $kicker_content[ $i + 11 ], array( '>', ' ' ) ) ) {
					$kicker_in_block = true;
					$i += 11;
					continue;
				} else if ( 'p' == $kicker_content[ $i + 1 ] && in_array( $kicker_content[ $i + 2 ], array( '>', ' ' ) ) ) {
					$kicker_p_number++;
					if ( $kicker_related_position_inside == $kicker_p_number ) {
						$kicker_related_inserted = true;
						$kicker_content = ( $i > 0 ? substr( $kicker_content, 0, $i ) : '' )
											. $kicker_related_content
											. substr( $kicker_content, $i );
					}
				}
			}
			if ( ! $kicker_related_inserted ) {
				if ( $kicker_content_end > 0 ) {
					$kicker_content = substr( $kicker_content, 0, $kicker_content_end ) . $kicker_related_content . substr( $kicker_content, $kicker_content_end );
				} else {
					$kicker_content .= $kicker_related_content;
				}
			}
		}

		kicker_show_layout( $kicker_content );
	}

	// Comments
	do_action( 'kicker_action_before_comments' );
	comments_template();
	do_action( 'kicker_action_after_comments' );

	// Related posts
	if ( 'below_content' == $kicker_related_position
		&& ( 'scroll' != $kicker_posts_navigation || kicker_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || kicker_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'kicker_action_related_posts' );
	}

	// Post navigation: type 'scroll'
	if ( 'scroll' == $kicker_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $kicker_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $kicker_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $kicker_prev_post ) ); ?>"
			<?php do_action( 'kicker_action_nav_links_single_scroll_data', $kicker_prev_post ); ?>
		></div>
		<?php
	}
}

get_footer();
