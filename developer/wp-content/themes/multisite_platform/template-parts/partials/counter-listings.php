<?php
$listings_count = $args['listings_count'] ?? 0;
?>

<div class="listings-count mb-4">
    <p class="text-gray-600">
        <?php
        printf(
            esc_html__('Found %s listings', 'platform'),
            '<strong>' . esc_html($listings_count) . '</strong>'
        );
        ?>
    </p>
</div>