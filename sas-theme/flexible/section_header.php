<?php //$top_border = (get_sub_field('top_border') === 'yes') ? "top-border" : ""; ?>

<?php if ( get_sub_field('section_heading_title') || get_sub_field('section_heading_intro') ): ?>

        <div class="small-12 columns fc-section-header">

          <?php if ( get_sub_field('section_heading') ): ?>
            <p class="g-section-subtitle"><?php echo get_sub_field('section_heading'); ?></p>
          <?php endif; ?>

          <?php if ( get_sub_field('section_heading_title') ): ?>
            <h2><?php echo get_sub_field('section_heading_title'); ?></h2>
          <?php endif; ?>

          <?php if ( get_sub_field('section_heading_text') ): ?>
            <p class="g-medium-text"><?php echo get_sub_field('section_heading_text'); ?></p>
          <?php endif; ?>

        </div>

<?php endif; ?>