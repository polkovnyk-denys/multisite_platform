<?php
$post_id = $args['post_id'] ?? get_the_ID();

if (empty($post_id)) {
    return;
}

$title     = get_the_title($post_id);
$thumbnail = get_the_post_thumbnail_url($post_id, 'full') ?: '';
$city      = get_field('city', $post_id);
$price     = get_field('price', $post_id);
$rooms     = get_field('rooms', $post_id);
$area      = get_field('area_m2', $post_id);
$content   = apply_filters('the_content', get_post_field('post_content', $post_id));
$items     = get_breadcrumb_items();
?>

<section class="container mx-auto px-4 py-8 max-w-6xl w-full">

    <?php
    get_template_part(
        get_partials_path('breadcrumbs'),
        '',
        [
            'items' => $items,
        ]
    );
    ?>

    <div class="mb-4">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3">
            <?php echo esc_html($title); ?>
        </h1>
    </div>

    <div class="grid container-listings mb-8">
        <div class="container-listings__content">
            <div>
                <?php echo wp_kses_post($content); ?>
            </div>

        </div>

        <?php if ($thumbnail) : ?>
            <div class="container-listings__thumbnail">
                <img
                    src="<?php echo esc_url($thumbnail); ?>"
                    alt="<?php echo esc_attr($title); ?>"
                    class="w-full h-full object-cover"
                    loading="eager">
            </div>
        <?php endif; ?>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        <div class="info-listings h-full col-span-2 rounded-xl shadow-lg p-6 border sticky">
            <?php if (!empty($city)) : ?>
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium"><?php echo esc_html__('City', 'platform'); ?>:</span>
                    <span class="text-sm"><?php echo esc_html($city); ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($rooms)) : ?>
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium"><?php echo esc_html__('Rooms', 'platform'); ?>:</span>
                    <span class="text-sm"><?php echo esc_html($rooms); ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($area)) : ?>
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium">m²:</span>
                    <span class="text-sm"><?php echo esc_html($area); ?></span>
                </div>
            <?php endif; ?>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border">
            <?php if (!empty($price)) : ?>
                <div class="mb-4">
                    <p class="text-gray-500 text-sm mb-1"><?php echo esc_html__('Price', 'platform'); ?></p>
                    <p class="text-2xl font-bold text-blue-600">$<?php echo esc_html(number_format((float) $price)); ?></p>
                </div>
            <?php endif; ?>

            <div class="flex flex-col gap-3">
                <a href="#"
                    class="inline-flex justify-center items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                    <?php echo esc_html__('Book now', 'platform'); ?>
                </a>
                <a href="tel:+0000000000"
                    class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 hover:bg-gray-50 text-gray-700 rounded-md">
                    <?php echo esc_html__('Contact', 'platform'); ?>
                </a>
            </div>
        </div>
    </div>

    <?php
    $similar_listings = get_similar_listings_by_city($post_id, $city);
    $similar_posts = $similar_listings->posts ?? [];

    if (!empty($similar_posts)) : ?>
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6"><?php echo esc_html__('Similar listings', 'platform'); ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($similar_posts as $similar_post) :
                    get_template_part(
                        get_partials_path('card-listings'),
                        '',
                        ['post_id' => $similar_post]
                    );
                endforeach;
                ?>
            </div>
        </div>
    <?php endif; ?>
</section>