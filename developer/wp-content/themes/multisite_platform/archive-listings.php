<?php

/**
 * Archive template for "listings"
 */
get_header(); ?>

<div class="container mx-auto px-4 w-full">
    <?php
    get_template_part(
        sections_path('section-queries')
    );
    ?>
</div>

<?php get_footer();
