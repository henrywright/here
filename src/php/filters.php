<?php
/**
 * Filter hooks
 *
 * @package Here
 * @subpackage Filters
 */

add_filter( 'the_author',         'here_post_author'           );
add_filter( 'get_comment_author', 'here_comment_author', 10, 3 );
