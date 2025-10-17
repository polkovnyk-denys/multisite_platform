<?php

/**
 * Get the path to the partials directory
 */
function partials_path($part): string
{
    return "template-parts/partials/{$part}";
}

/**
 * Get the path to the sections directory
 */
function sections_path($part): string
{
    return "template-parts/sections/{$part}";
}

/**
 * Get the path to the partials directory
 */
function get_partials_path($part): string
{
    return "template-parts/partials/{$part}";
}

/**
 * Get the path to the micro-partials directory
 */
function micro_partials_path($part): string
{
    return "template-parts/micro-partials/{$part}";
}

/**
 * Get the path to the schema directory
 */
function schema_path($part): string
{
    return "template-parts/schema/{$part}";
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

    // $query_params = [];

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
