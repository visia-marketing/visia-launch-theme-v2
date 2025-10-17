<?php

                                // Layout name (e.g., 'hero', 'text_block')
$id = get_sub_field('id') ?: 'fc-section-' . get_row_index(); // Custom ID or auto-generated fallback
$class = get_sub_field('class') ?: '';                        // Optional custom CSS classes
$border = get_sub_field('border') ?: '';                      // Border style classes   
$background = get_sub_field('background') ?: '';              // Background type (color/image/etc)
$background_image_id = get_sub_field('background_image');     // Background image attachment ID


$top_padding = get_sub_field('top_padding') ?: '';
$bottom_padding = get_sub_field('bottom_padding') ?: '';
$content_spacing = get_sub_field('content_spacing') ?: '';
$vertical_align = get_sub_field('vertical_align') ?: '';
$horizontal_align = get_sub_field('horizontal_align') ?: '';


?>