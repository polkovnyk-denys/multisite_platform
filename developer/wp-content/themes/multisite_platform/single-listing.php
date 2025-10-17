<?php

$post_id = get_queried_object_id();

get_header();

while (have_posts()) {
    the_post();
    $post_type = get_post_type();

    get_template_part(
        content_path("content-{$post_type}"),
        '',
        [
            'post_id' => $post_id,
        ]
    );
}


get_footer();
