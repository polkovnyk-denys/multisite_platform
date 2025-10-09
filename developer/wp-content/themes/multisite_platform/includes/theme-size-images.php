<?php

set_post_thumbnail_size(792, 528); // Enable support for Post Thumbnails on posts and pages.

// 1x1 ratio
add_image_size('thumbnail-small', 150, 150, true); // Create the thumbnail size
add_image_size('thumbnail-medium', 300, 300, true); // Create the medium size
add_image_size('thumbnail-large', 1024, 1024, true); // Create the large size
add_image_size('thumbnail-xlarge', 1920, 1920, true); // Create the xlarge size