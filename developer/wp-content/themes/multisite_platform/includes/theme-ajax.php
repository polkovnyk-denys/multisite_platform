<?php

/**
 * AJAX handler for filtering listings
 */
add_action('wp_ajax_filter_listings', 'ajax_filter_listings');
add_action('wp_ajax_nopriv_filter_listings', 'ajax_filter_listings');

function ajax_filter_listings(): void
{

    if (!wp_verify_nonce($_POST['nonce'] ?? '', 'filter_listings_nonce')) {
        wp_send_json_error([
            'message' => __('Security check failed', 'platform')
        ], 403);
        return;
    }

    // Get query params from request
    $query_params = get_query_params();

    // Get listings based on params
    $listings_query = listings_query($query_params);

    $listings_count = $listings_query->found_posts ?? 0;
    $listings_posts = $listings_query->posts ?? [];

    ob_start();

    // Render listings grid or empty state
    if (!empty($listings_posts)) {
        foreach ($listings_posts as $post_id) {
            get_template_part(
                get_partials_path('card-listings'),
                '',
                [
                    'post_id' => $post_id,
                ]
            );
        }
    } else {
        get_template_part('template-parts/content', 'none-listings');
    }

    $html = ob_get_clean();

    wp_send_json_success([
        'html' => $html,
        'count' => $listings_count,
    ]);
}
