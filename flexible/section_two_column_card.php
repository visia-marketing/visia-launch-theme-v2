<div class="fc-section-columns fc-section-two-column-card">
  <?php get_template_part('flexible/section_header'); ?>
  <div class="row">
    <div class="small-12 columns">
      <div class="card-grid card-grid-1">
        <div class="card-cell">
          <div class="card-cell-content">
            <div class="row" data-equalizer>
              <div class="small-12 medium-6 columns">
                <div class="content content-columns" data-equalizer-watch>
                  <?php echo get_sub_field('column_1'); ?>
                </div>
              </div>
              <div class="small-12 medium-6 columns">
                <div class="content content-columns" data-equalizer-watch>
                  <?php echo get_sub_field('column_2'); ?>
                </div>
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>