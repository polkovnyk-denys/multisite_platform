<?php

/**
 * Meta query for filtering by city
 */
function meta_query_filter_city(string $filter_city): array
{
    if (!empty($filter_city)) {
        $meta_query = ['relation' => 'AND'];

        $meta_query[] = [
            'key' => 'city',
            'value' => $filter_city,
            'compare' => '='
        ];

        return $meta_query;
    }

    return [];
}

/**
 * Meta query for filtering by price
 */
function meta_query_filter_price(int $price_min = 0, int $price_max = 0): array
{
    if ($price_min > 0 || $price_max > 0) {
        $price_query = [
            'key' => 'price',
            'type' => 'NUMERIC',
        ];

        if ($price_min > 0 && $price_max > 0) {
            $price_query['value'] = [$price_min, $price_max];
            $price_query['compare'] = 'BETWEEN';
        } elseif ($price_min > 0) {
            $price_query['value'] = $price_min;
            $price_query['compare'] = '>=';
        } else {
            $price_query['value'] = $price_max;
            $price_query['compare'] = '<=';
        }

        return $price_query;
    }

    return [];
}

/**
 * Whitelist for sorting
 */
function whitelist_for_sorting(): array
{
    return ['price_asc', 'price_desc', 'date_desc'];
}

/**
 * Sorting By Price(ASC or DESC) or Date(DESC)
 */
function sorting_by(string $sort = 'date_desc'): string
{
    $allowed_sorts = whitelist_for_sorting();

    if (!in_array($sort, $allowed_sorts, true)) {
        $sort = 'date_desc';
    }

    return $sort;
}

/**
 * Get args for sorting Listings
 */
function get_args_for_sorting(string $sort): array
{
    $sort = sorting_by($sort);

    if ($sort === 'price_asc') {
        return [
            'orderby' => 'meta_value_num',
            'meta_key' => 'price',
            'order' => 'ASC'
        ];
    } elseif ($sort === 'price_desc') {
        return [
            'orderby' => 'meta_value_num',
            'meta_key' => 'price',
            'order' => 'DESC'
        ];
    } else {
        return [
            'orderby' => 'date',
            'order' => 'DESC'
        ];
    }
}
