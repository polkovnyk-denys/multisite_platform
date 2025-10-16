<?php

/**
 * Query for Listings Post Type.
 */
function listings_query(array $query_params = []): WP_Query
{
    $meta_query = [];

    // Parse query params
    $city      = $query_params['city'] ?? '';
    $price_min = $query_params['price_min'] ?? 0;
    $price_max = $query_params['price_max'] ?? 0;
    $sort      = $query_params['sort'] ?? 'date_desc';

    $meta_query_city  = meta_query_filter_city($city);
    $meta_query_price = meta_query_filter_price($price_min, $price_max);
    $sorting_args     = get_args_for_sorting($sort);

    // Base args for listings query. Move to func.
    $args = [
        'post_type'        => 'listings',
        'fields'           => 'ids',
        'posts_per_page'   => 12,
        'suppress_filters' => false,
        'paged'            => get_current_page_number(),
    ];

    if (!empty($meta_query_city)) {
        $meta_query[] = $meta_query_city; // Add city meta query
    }

    if (!empty($meta_query_price)) {
        $meta_query[] = $meta_query_price; // Add price meta query
    }

    if (count($meta_query) > 0) {
        $args['meta_query'] = $meta_query; // Add total meta query
    }

    $args = array_merge($args, $sorting_args);

    return new WP_Query($args);
}

/**
 * Get list of cities
 * @return array
 */
function get_list_cities(): array
{
    global $wpdb;

    $query = "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} WHERE meta_key = 'city' AND meta_value != '' ORDER BY meta_value ASC";
    $cities = $wpdb->get_col($query);
    return array_map('sanitize_text_field', $cities);
}
