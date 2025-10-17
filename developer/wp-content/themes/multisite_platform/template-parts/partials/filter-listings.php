<?php

/**
 * Filter listings
 */
$list_cities = get_list_cities();
$query_params = get_query_params();
?>

<div class="filter-listings bg-gray-100 p-6 rounded-lg mb-6">
    <form method="GET" action="<?php echo esc_url(home_url('/')); ?>" class="flex flex-wrap gap-4">

        <div class="flex-1 min-w-[200px]">
            <label for="city" class="block text-sm font-medium mb-2">
                <?php echo esc_html__('City', 'platform'); ?>
            </label>

            <select
                name="city"
                id="city"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value=""><?php echo esc_html__('All cities', 'platform'); ?></option>
                <?php foreach ($list_cities as $city) : ?>
                    <option
                        value="<?php echo esc_attr($city); ?>"
                        <?php selected($query_params['city'] ?? '', $city); ?>>
                        <?php echo esc_html($city); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="flex-1 min-w-[150px]">
            <label for="price_min" class="block text-sm font-medium mb-2">
                <?php echo esc_html__('Price Min', 'platform'); ?>
            </label>
            <input
                type="number"
                name="price_min"
                id="price_min"
                min="0"
                step="1"
                value="<?php echo esc_attr($query_params['price_min'] ?? ''); ?>"
                placeholder="<?php echo esc_attr__('Min price', 'platform'); ?>"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="flex-1 min-w-[150px]">
            <label for="price_max" class="block text-sm font-medium mb-2">
                <?php echo esc_html__('Price Max', 'platform'); ?>
            </label>
            <input
                type="number"
                name="price_max"
                id="price_max"
                min="0"
                step="1"
                value="<?php echo esc_attr($query_params['price_max'] ?? ''); ?>"
                placeholder="<?php echo esc_attr__('Max price', 'platform'); ?>"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="flex items-end">
            <button
                type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                <?php echo esc_html__('Filter', 'platform'); ?>
            </button>
        </div>
        <input type="hidden" name="sort" value="<?php echo esc_attr($query_params['sort'] ?? 'date_desc'); ?>">
    </form>
</div>