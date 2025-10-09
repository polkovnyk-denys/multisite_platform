<?php
/*
Plugin Name: Must have hooks for adding functionality.
Plugin URI: https://github.com/polkovnyk-denys
Description: Must have hooks for adding functionality.
Version: 1.0.0
Author: Polkovnyk Denys
Author URI: https://github.com/polkovnyk-denys
*/


/* ***************** Comments **************** */
// Close comments on the back-end.
add_action('admin_init', function () {
    // Redirect any user trying to access comments page.
    global $pagenow;

    if ('edit-comments.php' === $pagenow) {
        wp_safe_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard.
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types.
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});
