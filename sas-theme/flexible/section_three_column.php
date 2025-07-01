<div class="fc-section-columns">
  <?php get_template_part('flexible/section_header'); ?>
  <div class="row" data-equalizer>
    <?php if ( get_sub_field('column_style') === 'cards'): ?>
      <div class="small-12 columns">
        <div class="card-grid card-grid-3">
          <div class="card-cell">
            <div class="card-cell-content">
              <?php echo get_sub_field('column_1'); ?>
            </div>
          </div>
          <div class="card-cell">
            <div class="card-cell-content">
              <?php echo get_sub_field('column_2'); ?>
            </div>
          </div>
          <div class="card-cell">
            <div class="card-cell-content">
              <?php echo get_sub_field('column_3'); ?>
            </div>
          </div>
        </div>
      </div>
    <?php else: ?>
      <div class="small-12 medium-4 columns">
        <div class="content content-columns" data-equalizer-watch>
          <?php echo get_sub_field('column_1'); ?>
        </div>
      </div>
      <div class="small-12 medium-4 columns">
        <div class="content content-columns" data-equalizer-watch>
          <?php echo get_sub_field('column_2'); ?>
        </div>
      </div>
      <div class="small-12 medium-4 columns">
        <div class="content content-columns" data-equalizer-watch>
          <?php echo get_sub_field('column_3'); ?>
        </div>
      </div>
    <?php endif;?> 
  </div>
</div>