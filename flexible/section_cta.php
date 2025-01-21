<div class="fc-section-cta">
  <div class="row">
    <div class="small-12 columns">
      <div class="flex">
        <!-- First div with h6 and cta_text ACF field -->
        <div class="cta-text">
          <h6><?php echo get_sub_field('cta_text'); ?></h6>
        </div>
        <?php 
        $cta_button = get_sub_field('cta_button'); 
        if ($cta_button): 
        ?>
        <div class="cta-button">
          <a href="<?php echo esc_url($cta_button['url']); ?>" target="<?php echo esc_attr($cta_button['target']); ?>" class="button button-arrow">
            <?php echo esc_html($cta_button['title']); ?>
          </a>
        </div>
      <?php endif; ?>
      </div>
    </div>
  </div>
</div>