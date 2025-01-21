<?php
$categories_or_products = get_sub_field('categories_or_products'); // ACF field to determine display type
$show_category_descriptions = get_sub_field('show_category_descriptions');
?>

<div class="fc-section-product-cards hide-for-medium">
  <?php get_template_part('flexible/section_header'); ?>
  <div class="row columns">
    <div class="wc-slider">

      <?php if ($categories_or_products === 'categories') : ?>
        <?php
        $category_ids = get_sub_field('categories'); // ACF taxonomy field returning IDs

        if ($category_ids && is_array($category_ids)) :
          foreach ($category_ids as $category_id) :
            $category = get_term($category_id);
            if ($category && !is_wp_error($category)) :
              $category_name = $category->name;
              $category_link = get_term_link($category);
              $thumbnail_id = get_term_meta($category_id, 'thumbnail_id', true); // Get the taxonomy's featured image ID
              $thumbnail_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : '';
        ?>
            <div class="wc-card wc-card-categories">
              <div class="wc-card-image">
                <?php if ($thumbnail_url) : ?>
                  <img src="<?php echo esc_url($thumbnail_url); ?>" class="card-cell-header-image" alt="<?php echo esc_attr($category_name); ?>">
                <?php endif; ?>
              </div>
              <div class="wc-card-content">
                <h3 class="wc-card-title"><?php echo esc_html($category_name); ?></h3>
                <?php
                $term = get_queried_object(); // Get the current taxonomy term object
                $short_description = get_field('short_description', $category);
                
                // Check if the field has a value and display it
                if ($short_description && ( $show_category_descriptions === 'yes') ) {
                    echo '<p class="wc-card-description">' . esc_html($short_description) . '</p>';
                }
                ?>
                <a href="<?php echo esc_url($category_link); ?>" class="button grey wc-card-button">View Category <i class="fa-duotone fa-light fa-arrow-right-long"></i></a>
              </div>
            </div>
        <?php
            endif;
          endforeach;
        endif;
        ?>

      <?php elseif ($categories_or_products === 'products') : ?>

        <?php
        $product_ids = get_sub_field('products'); // ACF post object field returning IDs

        if ($product_ids && is_array($product_ids)) :
          foreach ($product_ids as $product_id) :
            if (get_post_status($product_id) === 'publish') :
              $title = get_the_title($product_id);
              $permalink = get_permalink($product_id);
              $thumbnail = get_the_post_thumbnail($product_id, 'medium', ['class' => 'card-cell-header-image']);
              $summary = get_field('product_summary', $product_id);
        ?>
            <div class="wc-card wc-card-product">
              <div class="wc-card-image">
                <?php if ($thumbnail) : ?>
                  <?php echo $thumbnail; ?>
                <?php endif; ?>
              </div>
              <div class="wc-card-content"h>
                <h3 class="wc-card-title"><?php echo esc_html($title); ?></h3>
                <a href="<?php echo esc_url($permalink); ?>" class="button grey">View Product <i class="fa-duotone fa-light fa-arrow-right-long"></i></a>
              </div>
            </div>
        <?php
            endif;
          endforeach;
        endif;
        ?>

      <?php endif; ?>

    </div>
  </div>
</div>

<div class="fc-section-product-cards show-for-medium">
  <?php get_template_part('flexible/section_header'); ?>
  <div class="row columns">
    <div class="wc-grid" data-equalizer>

      <?php if ($categories_or_products === 'categories') : ?>
        <?php
        $category_ids = get_sub_field('categories'); // ACF taxonomy field returning IDs

        if ($category_ids && is_array($category_ids)) :
          foreach ($category_ids as $category_id) :
            $category = get_term($category_id);
            if ($category && !is_wp_error($category)) :
              $category_name = $category->name;
              $category_link = get_term_link($category);
              $thumbnail_id = get_term_meta($category_id, 'thumbnail_id', true); // Get the taxonomy's featured image ID
              $thumbnail_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : '';
        ?>
            <div class="wc-card wc-card-categories">
              <div class="wc-card-image">
                <?php if ($thumbnail_url) : ?>
                  <a href="<?php echo esc_url($category_link); ?>">
                    <img src="<?php echo esc_url($thumbnail_url); ?>" class="card-cell-header-image" alt="<?php echo esc_attr($category_name); ?>">
                  </a>
                <?php endif; ?>
              </div>
              <div class="wc-card-content" data-equalizer-watch>
                <h3 class="wc-card-title"><a href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($category_name); ?></a></h3>
                <?php
                $term = get_queried_object(); // Get the current taxonomy term object
                $short_description = get_field('short_description', $category);
                
                // Check if the field has a value and display it
                if ($short_description && ( $show_category_descriptions === 'yes') ) {
                    echo '<a href="<?php echo esc_url($permalink); ?>"><p class="wc-card-description">' . esc_html($short_description) . '</p></a>';
                }
                ?>
                <a href="<?php echo esc_url($category_link); ?>" class="button grey wc-card-button">View Category <i class="fa-duotone fa-light fa-arrow-right-long"></i></a>
              </div>
            </div>
        <?php
            endif;
          endforeach;
        endif;
        ?>

      <?php elseif ($categories_or_products === 'products') : ?>

        <?php
        $product_ids = get_sub_field('products'); // ACF post object field returning IDs

        if ($product_ids && is_array($product_ids)) :
          foreach ($product_ids as $product_id) :
            if (get_post_status($product_id) === 'publish') :
              $title = get_the_title($product_id);
              $permalink = get_permalink($product_id);
              $thumbnail = get_the_post_thumbnail($product_id, 'medium', ['class' => 'card-cell-header-image']);
              $summary = get_field('product_summary', $product_id);
        ?>
            <div class="wc-card wc-card-product">
              <div class="wc-card-image">
                <?php if ($thumbnail) : ?>
                  <a href="<?php echo esc_url($permalink); ?>">
                    <?php echo $thumbnail; ?>
                  </a>
                <?php endif; ?>
              </div>
              <div class="wc-card-content" data-equalizer-watch>
                <h3 class="wc-card-title"><a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a></h3>
                <a href="<?php echo esc_url($permalink); ?>" class="button grey">View Product <i class="fa-duotone fa-light fa-arrow-right-long"></i></a>
              </div>
            </div>
        <?php
            endif;
          endforeach;
        endif;
        ?>

      <?php endif; ?>

    </div>
  </div>
</div>