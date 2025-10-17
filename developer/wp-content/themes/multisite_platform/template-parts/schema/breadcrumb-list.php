<?php

$items = $args['items'] ?? [];

if (empty($items) || count($items) < 2) {
    return;
}

$item_list = [];
$position  = 1;

foreach ($items as $item) {
    $name = $item['name'] ?? '';
    $url  = $item['url'] ?? '';

    if ($name === '') {
        continue;
    }

    $list_item = [
        '@type'    => 'ListItem',
        'position' => $position++,
        'item'     => [
            'name' => $name,
        ],
    ];

    if ($url !== '') {
        $listItem['item']['@id'] = $url;
    }

    $item_list[] = $list_item;
}

if (count($item_list) < 2) {
    return;
}

$schema = [
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => $item_list,
];

printf(
    '<script type="application/ld+json">%s</script>',
    wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
);
