<?php

/**
 * Register post type "listing"
 */
function register_post_type_listing(): void
{
    $labels = [
        'name'               => _x('Listing', 'post type general name', 'platform'),
        'singular_name'      => _x('Listing', 'post type singular name', 'platform'),
        'add_new'            => _x('Add listing', 'advice', 'platform'),
        'add_new_item'       => __('Add new listing', 'platform'),
        'edit_item'          => __('Edit listing', 'platform'),
        'new_item'           => __('New listing', 'platform'),
        'all_items'          => __('All listings', 'platform'),
        'view_item'          => __('Watch listing', 'platform'),
        'search_items'       => __('Search for listings', 'platform'),
        'not_found'          => __('No listing found', 'platform'),
        'not_found_in_trash' => __('No deleted listings', 'platform'),
        'parent_item_colon'  => '',
        'menu_name'          =>  __('Listing', 'platform')
    ];

    $args = [
        'labels'        => $labels,
        'description'   => 'Listing',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'listings'],
        'capability_type'    => 'post',
        'menu_position'      => 2,
        'taxonomies'         => ['category', 'post_tag'],
        'supports'           => ['title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'page-attributes', 'post-formats', 'revisions'],
        'has_archive'        => true,
    ];

    register_post_type('listings', $args);
}

add_action('init', 'register_post_type_listing');
