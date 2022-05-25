<?php
/**
 * The template to display the attachment
 *
 * @package KICKER
 * @since KICKER 1.0
 */


get_header();

while ( have_posts() ) {
	the_post();

	// Display post's content
	get_template_part( apply_filters( 'kicker_filter_get_template_part', 'templates/content', 'single-' . kicker_get_theme_option( 'single_style' ) ), 'single-' . kicker_get_theme_option( 'single_style' ) );

	// Parent post navigation.
	$kicker_posts_navigation = kicker_get_theme_option( 'posts_navigation' );
	if ( 'links' == $kicker_posts_navigation ) {
		?>
		<div class="nav-links-single<?php
			if ( ! kicker_is_off( kicker_get_theme_option( 'posts_navigation_fixed' ) ) ) {
				echo ' nav-links-fixed fixed';
			}
		?>">
			<?php
			the_post_navigation( apply_filters( 'kicker_filter_post_navigation_args', array(
					'prev_text' => '<span class="nav-arrow"></span>'
						. '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Published in', 'kicker' ) . '</span> '
						. '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'kicker' ) . '</span> '
						. '<h5 class="post-title">%title</h5>'
						. '<span class="post_date">%date</span>',
			), 'image' ) );
			?>
		</div>
		<?php
	}

	// Comments
	do_action( 'kicker_action_before_comments' );
	comments_template();
	do_action( 'kicker_action_after_comments' );
}

get_footer();
