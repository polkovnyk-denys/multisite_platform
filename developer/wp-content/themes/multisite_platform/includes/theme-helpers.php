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
