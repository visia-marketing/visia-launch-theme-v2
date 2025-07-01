<div class="fc-section-columns">
  <?php get_template_part('flexible/section_header'); ?>
  <div class="row">
    <?php if ( get_sub_field('column_style') === 'cards'): ?>
      <div class="small-12 columns">
        <div class="card-grid card-grid-1">
          <div class="card-cell">
            <div class="card-cell-content <?php if ( get_sub_field('justification') === 'center' ): echo 'center'; endif; ?>">
              <?php echo get_sub_field('column_1'); ?>
            </div>
          </div>
        </div>
      </div>
    <?php else: ?>
      <div class="small-12 <?php if ( get_sub_field('justification') === 'center' ): echo 'medium-8 medium-centered large-7'; else: echo 'medium-9'; endif; ?> columns">
        <div class="content content-columns">
          <?php echo get_sub_field('column_1'); ?>
        </div>
      </div>
    <?php endif;?>   
  </div>
</div>