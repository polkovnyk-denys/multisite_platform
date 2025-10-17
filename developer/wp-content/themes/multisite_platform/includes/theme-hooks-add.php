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

/**
 * Output the canonical link
 * @return void
 */
function output_canonical_link(): void
{
    $canonical = get_canonical_url();

    if (empty($canonical)) {
        return;
    }

    printf('<link rel="canonical" href="%s">', esc_url($canonical));
}
add_action('wp_head', 'output_canonical_link', 5);
