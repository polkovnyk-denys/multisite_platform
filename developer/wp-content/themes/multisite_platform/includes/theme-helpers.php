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
