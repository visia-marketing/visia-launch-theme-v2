<?php //$top_border = (get_sub_field('top_border') === 'yes') ? "top-border" : ""; ?>

<?php if ( get_sub_field('section_heading_title') || get_sub_field('section_heading_intro') ): ?>

        <div class="small-12 columns">
          <?php if ( get_sub_field('section_heading_title') ): ?>
            <h2 class="section-h2"><?php echo get_sub_field('section_heading_title'); ?></h2>
          <?php endif; ?>
          
          <?php if ( get_sub_field('section_heading_intro') ): ?>
            <p class="section-p"><?php echo get_sub_field('section_heading_intro'); ?></p>
          <?php endif; ?>
        </div>

<?php endif; ?>