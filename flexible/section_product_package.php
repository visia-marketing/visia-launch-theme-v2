<?php
$cards_per_row = get_sub_field('cards_per_row');
//$top_border = (get_sub_field('top_border') === 'yes') ? "top-border" : "";
//$anchor = get_sub_field('section_heading') ? create_anchor(get_sub_field('section_heading')) : '';
?>

<div class="fc-section-cards" id="<?php //echo $anchor;?>">
  <?php get_template_part('flexible/section_header'); ?>
  <div class="row columns">
    <div class="card-grid card-grid-package" data-equalizer>
              
      <?php
      // Get the main product ID
      $main_product_id = get_sub_field('product'); // Replace with your ACF field for the single product

      if ($main_product_id && get_post_status($main_product_id) === 'publish') : // Ensure it's a valid and published product
        // Fetch main product details
        $main_title = get_the_title($main_product_id);
        $main_permalink = get_permalink($main_product_id);
        $main_thumbnail = get_the_post_thumbnail($main_product_id, 'medium', ['class' => 'card-cell-header-image']);
        $is_package = get_field('package', $main_product_id); // Check if package field is true

        ?>
        <div class="grid-column-1-3">
          <div class="card-cell card-cell-product">
            <div class="card-cell-header">
                <?php if ($main_thumbnail): ?>
                    <?php echo $main_thumbnail; ?>
                <?php endif; ?>
                <h3><?php echo esc_html($main_title); ?></h3>
            </div>
          </div>
        </div>
        <div class="grid-column-2-3">
          <?php
          if ($is_package) :
            $additional_products = get_field('additional_products', $main_product_id); // ACF post object or array of IDs
            if ($additional_products && is_array($additional_products)) :
              foreach ($additional_products as $product_id) :
                  if (get_post_status($product_id) === 'publish') : // Ensure it's a published post
                      $title = get_the_title($product_id);
                      $thumbnail = get_the_post_thumbnail($product_id, 'medium', ['class' => 'card-cell-header-image']);
                      ?>
                      <div class="card-cell card-cell-product">
                          <div class="card-cell-header">
                              <?php if ($thumbnail): ?>
                                  <?php echo $thumbnail; ?>
                              <?php endif; ?>
                              <h3><?php echo esc_html($title); ?></h3>
                          </div>
                      </div>
                      <?php
                  endif;
              endforeach;
            endif;
          endif;
          ?>
        </div>
      <?php endif; ?>
      <div class="grid-column-full">
        <a href="<?php echo get_the_permalink($main_product_id); ?>">Purchase Package</a>
      </div>
    </div>
  </div>
</div>