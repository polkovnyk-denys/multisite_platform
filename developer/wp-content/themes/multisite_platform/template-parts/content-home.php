<?php

/**
 * Home page layout
 */
?>

<section class="container">
    <?php
    get_template_part(
        sections_path('filter-listings'),
        '',
        [],
    );
    ?>
</section>