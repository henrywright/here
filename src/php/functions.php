<?php
/**
 * Function definitions
 *
 * @package Here
 * @subpackage Functions
 */

/**
 * Add stylesheets.
 *
 * @since 1.0.1
 */
function here_load_css() {

	// Add default styling.
	wp_enqueue_style( 'here', plugins_url( 'css/default.min.css', dirname( __FILE__ ) ) );

	$themes = array(
		'twentysixteen',
		'twentyfifteen',
		'twentyfourteen',
		'twentythirteen',
		'twentytwelve',
		'twentyeleven',
		'twentyten'
	);
	// Get the active theme.
	$theme = get_template();

	// Bail if the active theme isn't supported.
	if ( ! in_array( $theme, $themes ) ) {
		return;
	}
	// Add theme-specific styling.
	wp_enqueue_style( "here-{$theme}", plugins_url( "css/{$theme}.min.css", dirname( __FILE__ ) ), array( 'here' ) );
}

/**
 * Set a transient if a page is hit.
 *
 * @since 1.0.0
 */
function here_init() {
	$user = wp_get_current_user();
	$here = new Here( $user->user_email );
	$here->delete();
	$here->set();
}

/**
 * Set a transient if a comment is posted.
 *
 * @since 1.0.0
 *
 * @param int $id The comment ID.
 * @param object $comment The comment.
 */
function here_insert_comment( $id, $comment ) {
	$here = new Here( $comment->comment_author_email );
	$here->delete();
	$here->set();
}

/**
 * Add a dot to the user's profile image.
 *
 * @since 1.0.0
 *
 * @param string $avatar The avatar HTML.
 * @param mixed $id_or_email The ID or email.
 * @return string
 */
function here_filter_get_avatar( $avatar, $id_or_email ) {

	// Bail if this isn't a post or page.
	if ( ! is_single() && ! is_page() ) {
		return $avatar;
	}

	$email = $id_or_email;

	if ( is_object( $id_or_email ) ) {
		$email = $id_or_email->comment_author_email;
	}

	if ( is_numeric( $id_or_email ) ) {
		$user = get_userdata( (int) $id_or_email );
		$email = $user->user_email;
	}

	if ( $email === '' ) {
		return $avatar;
	}

	$here = new Here( $email );

	if ( false === $here->get() ) {
		return $avatar;
	}
	return '<span class="here"></span>' . $avatar;
}

/**
 * Remove here_filter_get_avatar().
 *
 * @since 1.0.0
 */
function here_filter_get_avatar_remove() {
	remove_filter( 'get_avatar', 'here_filter_get_avatar', 12, 2 );
}

/**
 * Add here_filter_get_avatar().
 *
 * @since 1.0.0
 */
function here_filter_get_avatar_add() {
	add_filter( 'get_avatar', 'here_filter_get_avatar', 12, 2 );
}
