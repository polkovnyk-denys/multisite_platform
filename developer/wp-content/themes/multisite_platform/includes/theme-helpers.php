<?php

/**
 * Get the current page number
 */
function get_current_page_number(): int
{
    $paged = get_query_var('paged') ?: get_query_var('page');
    return $paged ? absint($paged) : 1;
}

/**
 * Get sort options
 */
function get_sort_options(): array
{
    return [
        'price_asc' => __('Price: Low to High', 'platform'),
        'price_desc' => __('Price: High to Low', 'platform'),
        'date_desc' => __('Newest First', 'platform'),
    ];
}

/**
 * Get breadcrumb items based on current context
 */
function get_breadcrumb_items(): array
{
    $items   = [];
    $items[] = [
        'name' => esc_html__('Home', 'platform'),
        'url'  => home_url('/'),
    ];

    if (is_front_page() || is_home()) {
        return $items;
    }

    if (is_archive()) {
        $items[] = [
            'name' => wp_strip_all_tags(get_the_archive_title()),
            'url'  => '',
        ];

        return $items;
    }

    if (is_singular()) {
        $post = get_post();

        if ($post) {
            if ($post->post_type !== 'page') {
                $post_type_object = get_post_type_object($post->post_type);
                $post_type_name = $post_type_object->labels->name ?? '';
                $archive_link = function_exists('get_post_type_archive_link') ? get_post_type_archive_link($post->post_type) : '';

                if (!empty($post_type_name) && !empty($archive_link)) {
                    $items[] = [
                        'name' => $post_type_name,
                        'url'  => $archive_link,
                    ];
                } else if (empty($archive_link)) {
                    $items[] = [
                        'name' => get_the_title($post),
                        'url'  => get_permalink($post),
                    ];
                }
            } else {
                $ancestors = array_reverse(get_post_ancestors($post));

                foreach ($ancestors as $ancestor_id) {
                    $items[] = [
                        'name' => get_the_title($ancestor_id),
                        'url'  => get_permalink($ancestor_id),
                    ];
                }
            }

            $items[] = [
                'name' => get_the_title($post),
                'url'  => '',
            ];
        }
    }

    return $items;
}

/**
 * Create the canonical URL based on the current page
 */
function get_canonical_url(): string
{
    if (is_search()) {
        return '';
    }

    if (is_singular()) {
        return get_permalink();
    }

    $paged = get_current_page_number();
    $base  = get_pagenum_link($paged > 0 ? $paged : 1);
    $base  = strtok($base, '?');

    $allowed_keys = get_query_params();

    $noise = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'gclid', 'fbclid', '_ga', '_gl', 'ref'];
    $base  = remove_query_arg($noise, $base);
    $canonical = !empty($allowed_keys) ? add_query_arg($allowed_keys, $base) : $base;

    return $canonical;
}

/**
 * Get the query params from the GET request
 */
function get_query_params(): array
{
    // Allowed params
    $allowed_params = [
        'city'      => 'sanitize_text_field',
        'price_min' => 'absint',
        'price_max' => 'absint',
        'sort'      => 'sanitize_text_field',
    ];

    if (defined('DOING_AJAX') && DOING_AJAX) {
        $query_method = $_POST;
    } else {
        $query_method = $_GET;
    }

    foreach ($allowed_params as $param => $sanitize_function) {
        if (!empty($query_method[$param])) {
            $query_params[$param] = $sanitize_function($query_method[$param]);
        } else {
            $query_params[$param] = $sanitize_function(''); // Default value for empty params
        }
    }

    return $query_params;
}
