<?php

/**
 * Add schema to the head
 */

function add_schema_article(): void
{
    if (is_singular('listings')) {
        $items = get_breadcrumb_items();

        get_template_part(
            schema_path("breadcrumb-list"),
            '',
            [
                'items' => $items,
            ]
        );
    }
}
add_action('wp_head', 'add_schema_article');
