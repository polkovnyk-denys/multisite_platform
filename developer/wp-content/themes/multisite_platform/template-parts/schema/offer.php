<?php

$post_id = $args['post_id'] ?? get_the_ID();

if (empty($post_id)) {
    return;
}

$name     = get_the_title($post_id);
$price    = get_field('price', $post_id) ?: 0;
$description = get_the_excerpt($post_id) ?: wp_trim_words(get_post_field('post_content', $post_id), 30, '');
$thumbnail   = get_the_post_thumbnail_url($post_id, 'full') ?: '';
$url         = get_permalink($post_id);
$currency    = 'USD';
$availability = 'https://schema.org/InStock';
$valid_from = '';
$price_valid_until = '';
$seller_name = get_bloginfo('name');
$seller_type = 'Organization';


// Если нет цены — не выводим Offer
if (absint($price) <= 0) {
    return;
}

$schema = [
    '@context'       => 'https://schema.org',
    '@type'          => 'Offer',
    'url'            => $url,
    'price'          => number_format((float) $price, 2, '.', ''),
    'priceCurrency'  => $currency,
    'availability'   => $availability,
    'itemOffered'    => array_filter([
        '@type'       => 'Product',
        'name'        => $name ?: null,
        'description' => $description ?: null,
        'image'       => $thumbnail ?: null,
    ]),
    'seller'         => array_filter([
        '@type' => $seller_type,
        'name'  => $seller_name,
    ]),
];

printf(
    '<script type="application/ld+json">%s</script>',
    wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
);
