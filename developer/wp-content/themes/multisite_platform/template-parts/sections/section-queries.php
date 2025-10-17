<?php

$query_params         = get_query_params();
$listings_query       = listings_query($query_params);

$listings_count = $listings_query->found_posts ?? 0;
$listings_posts = $listings_query->posts ?? [];
?>

<div class="listings-section py-8">
    <?php
    get_template_part(get_partials_path('filter-listings'));

    get_template_part(get_partials_path('sort-listings'));

    get_template_part(
        get_partials_path('counter-listings'),
        '',
        [
            'listings_count' => $listings_count,
        ]
    );
    ?>

    <div class="listings-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
        if (empty($listings_posts)) {
            get_template_part('template-parts/content', 'none-listings');
        } else {
            foreach ($listings_posts as $post_id) :
                get_template_part(
                    get_partials_path('card-listings'),
                    '',
                    [
                        'post_id' => $post_id,
                    ]
                );
            endforeach;
        }
        ?>
    </div>

    <?php if ($listings_count > 0) {
        get_template_part(
            get_partials_path('paginate'),
            '',
            [
                'max_num_pages' => $listings_query->max_num_pages,
            ]
        );
    }
    ?>
</div>