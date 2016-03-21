<?php
/**
 * Function definitions
 *
 * @package Here
 * @subpackage Functions
 */

/**
 * Load the stylesheet.
 *
 * @since 1.0.1
 */
function here_load_css() {
	wp_enqueue_style( 'here', plugins_url( 'css/style.min.css', dirname( __FILE__ ) ) );
}

/**
 * Load the plugin textdomain.
 *
 * @since 1.1.0
 */
function here_i18n() {
	load_plugin_textdomain( 'here' );
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
 * Filter the comment author.
 *
 * @since 1.0.0
 *
 * @param string $author The comment author name.
 * @param int $comment_id The comment ID.
 * @param object $comment The comment.
 */
function here_comment_author( $author, $comment_id, $comment ) {

	if ( empty( $comment->comment_author_email ) ) {
		return $author;
	}

	$here = new Here( $comment->comment_author_email );

	if ( false === $here->get() ) {
		return $author;
	}

	return $author . '<img src="' . plugins_url( 'images/dot.png', dirname( __FILE__ ) ) . '" class="here" alt="">';
}
