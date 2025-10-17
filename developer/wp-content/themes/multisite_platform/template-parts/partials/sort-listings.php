<?php

/**
 * Sort listings
 */
$query_params = get_query_params();
$sort_options = get_sort_options();
?>

<div class="sort-listings mb-6 flex justify-end items-center">
    <div class="flex items-center gap-4">
        <label for="sort" class="text-sm font-medium">
            <?php echo esc_html__('Sort by:', 'platform'); ?>
        </label>

        <select
            name="sort"
            id="sort"
            class="px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <?php foreach ($sort_options as $value => $label) : ?>
                <option
                    value="<?php echo esc_attr($value); ?>"
                    <?php selected($query_params['sort'] ?? '', $value); ?>>
                    <?php echo esc_html($label); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>