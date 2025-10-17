<?php

$items = $args['items'] ?? [];

if (empty($items)) {
    return;
}

?>

<div class="breadcrumbs">
    <ul>
        <?php foreach ($items as $index => $item) : ?>
            <li>
                <?php if (!empty($item['url'])) : ?>
                    <a href="<?php echo esc_url($item['url']); ?>">
                        <?php echo esc_html($item['name']); ?>
                    </a>
                <?php else : ?>
                    <span>
                        <?php echo esc_html($item['name']); ?>
                    </span>
                <?php endif; ?>
            </li>

            <?php if ($index < count($items) - 1) : ?>
                <li>
                    <span>&gt;</span>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>

<?php
