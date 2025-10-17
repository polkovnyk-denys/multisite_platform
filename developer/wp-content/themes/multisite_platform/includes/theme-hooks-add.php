<?php

/**
 * Add schema to the head
 */

function add_schemas_to_head(): void
{
    $post_id = get_the_ID();

    if (is_singular('listings')) {
        $items = get_breadcrumb_items();

        get_template_part(
            schema_path("breadcrumb-list"),
            '',
            [
                'items' => $items,
            ]
        );

        get_template_part(
            schema_path("offer"),
            '',
            [
                'post_id' => $post_id,
            ]
        );
    }
}
add_action('wp_head', 'add_schemas_to_head');

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
