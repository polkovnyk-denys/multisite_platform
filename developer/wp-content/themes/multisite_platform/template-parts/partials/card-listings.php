<?php

$post_id = $args['post_id'] ?? get_the_ID() ?? null;

if (empty($post_id)) {
    return;
}

$link  = get_permalink($post_id);
$title = get_the_title($post_id);
$thumbnail = get_the_post_thumbnail_url($post_id, 'full') ?? '';

$city  = get_field('city', $post_id);
$price = get_field('price', $post_id);
$rooms = get_field('rooms', $post_id);
$area  = get_field('area_m2', $post_id);

?>
<article class="listing-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
    <?php if (!empty($thumbnail)) : ?>
        <div class="listing-image h-48 bg-gray-200 overflow-hidden">
            <img src="<?php echo esc_url($thumbnail); ?>"
                class="w-full h-full object-cover"
                alt="<?php echo esc_attr($title); ?>"
                loading="lazy"
                width="300"
                height="200">
        </div>
    <?php endif; ?>

    <div class="listing-content p-4">
        <h3 class="text-xl font-bold mb-2">
            <a href="<?php echo esc_url($link); ?>"
                class="text-gray-900 hover:text-blue-600">
                <?php echo esc_html($title); ?>
            </a>
        </h3>

        <div class="listing-meta space-y-2 text-sm text-gray-600">
            <?php if (!empty($city)) : ?>
                <p class="flex items-center gap-2">
                    <span class="font-semibold">
                        <?php echo esc_html__('City:', 'platform'); ?>
                    </span>

                    <span>
                        <?php echo esc_html($city); ?>
                    </span>
                </p>
            <?php endif; ?>

            <?php if (!empty($price)) : ?>
                <p class="flex justify-end gap-2">
                    <span class="font-semibold text-lg text-blue-600">
                        $<?php echo esc_html(number_format($price)); ?>
                    </span>
                </p>
            <?php endif; ?>

            <div class="flex gap-4">
                <?php if (!empty($rooms)) : ?>
                    <span>
                        <?php echo esc_html($rooms); ?> <?php echo esc_html__('rooms', 'platform'); ?>
                    </span>
                <?php endif; ?>

                <?php if (!empty($area)) : ?>
                    <span>
                        <?php echo esc_html($area); ?> m²
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>