<div class="fc-section-tabs">
  <?php get_template_part('flexible/section_header'); ?>
  <?php if( have_rows('tabs') ): ?>
    <div class="row columns "> 
    <div class="row columns">
      <ul class="tabs" data-tabs id="tabs-1">
        <?php while( have_rows('tabs') ): the_row(); ?>
          <li class="tabs-title<?php echo (get_row_index() === 1) ? ' is-active' : ''; ?>">
            <a href="#tab-<?php echo get_row_index(); ?>">
              <?php echo get_sub_field('tab_name'); ?>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
      <div class="tabs-content" data-tabs-content="tabs-1">
        <?php while( have_rows('tabs') ): the_row(); ?>
          <div class="tabs-panel<?php echo (get_row_index() === 1) ? ' is-active' : ''; ?>" id="tab-<?php echo get_row_index(); ?>">
            <?php
              if (have_rows('tab_content')) {
                echo '<div class="fc-wrapper fc-wrapper-tabs" id="fc-wrapper-' . esc_attr(create_anchor(get_the_title())) . '">';
                while (have_rows('tab_content')) : the_row();
                  $layout = get_row_layout();
                  echo '<section class="fc-section fc-section-' . esc_attr(get_row_index()) . ' fc-section-' . esc_attr($background) . ' ' . esc_attr($class) . ' ' . esc_attr($justification) . ' ' . esc_attr($column_style) . '" id="' . esc_attr($id) . '">';
                  if ($background === 'image' && $background_image_id) {
                    echo wp_get_attachment_image($background_image_id, 'full', false, ['class' => 'fc-section-background-image']);
                  }
                  get_template_part('flexible/' . $layout);
                  echo '</section>';
                endwhile;
                echo '</div>';
              }
          ?>          
          </div>
        <?php endwhile; ?>
      </div>
    </div>
    </div>
  <?php endif; ?>
</div>