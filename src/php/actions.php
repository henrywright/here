<?php
/**
 * Action hooks
 *
 * @package Here
 * @subpackage Actions
 */

add_action( 'wp_enqueue_scripts', 'here_load_css',                 10    );
add_action( 'init',               'here_init'                            );
add_action( 'wp_insert_comment',  'here_insert_comment',           10, 2 );
add_action( 'admin_bar_menu',     'here_filter_get_avatar_remove', 0     );
add_action( 'admin_bar_menu',     'here_filter_get_avatar_add',    8     );
