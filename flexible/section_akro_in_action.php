<div class="fc-section-akro-in-action">
  <?php get_template_part('flexible/section_header'); ?>
  <div class="akro-in-action-slider-navigation">
    <div class="row columns">
      <button class="slider-next"><i class="fa-regular fa-chevron-right"></i></button>
      <button class="slider-prev"><i class="fa-regular fa-chevron-left"></i></button>
    </div>
  </div>
  <div class="row columns" data-equalizer>
    <div class="akro-in-action-slider">
      <?php
      $akros = get_sub_field('akro_posts'); // ACF post object field returning IDs
      if ($akros && is_array($akros)) : // Ensure it's an array
        foreach ($akros as $akro) :
          if (get_post_status($akro) === 'publish') :
            $title = get_the_title($akro);
            $post = get_post($akro);
            $content = isset($post->post_content) ? apply_filters('the_content', $post->post_content) : '';
            $permalink = get_permalink($akro);
            $thumbnail = get_the_post_thumbnail($akro, 'full', ['class' => '']);
            
            // Get the ACF fields
            $akro_type = get_field('product_or_category', $akro);
            $product_link = get_field('product', $akro); // Post Object field
            $category_link = get_field('category', $akro); // Taxonomy field
            ?>
            <div class="card-cell card-cell-akro-in-action" data-equalizer-watch>
              <div class="card-cell-image">
                <?php if ($thumbnail): ?>
                  <?php echo $thumbnail; ?>
                <?php endif; ?>
              </div>
              <div class="card-cell-content">
                <h6><?php echo esc_html($title); ?></h6>
                <?php echo $content; ?>
                
                <?php if ($akro_type === 'product' && $product_link): ?>
                  <a href="<?php echo esc_url(get_permalink($product_link)); ?>" class="card-cell-link">View Product</a>
                <?php elseif ($akro_type === 'category' && $category_link): ?>
                  <a href="<?php echo esc_url(get_term_link($category_link)); ?>" class="card-cell-link">View Category</a>
                <?php endif; ?>
              </div> 
            </div>
            <?php
          endif;
        endforeach;
      endif;
      ?>
    </div>
  </div>
</div>