<?php

/**
 * Paginate listings
 */
$max_num_pages = absint($args['max_num_pages']) ?? 0;
$query_params = get_query_params();
$current_page_number = get_current_page_number() ?? 1;

if ($max_num_pages > 1) : ?>
    <div class="listings-pagination mt-8">
        <?php
        echo paginate_links([
            'total' => $max_num_pages,
            'current' => $current_page_number,
            'prev_text' => '&laquo; ' . __('Previous', 'platform'),
            'next_text' => __('Next', 'platform') . ' &raquo;',
            'type' => 'list',
            'add_args' => array_filter($query_params),
        ]);
        ?>
    </div>
<?php endif;
