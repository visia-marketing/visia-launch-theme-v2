<?php $column_width = get_sub_field('column_width'); ?>
<div class="fc-section-columns">
  <?php get_template_part('flexible/section_header'); ?>
  <div class="row">
      <div class="small-12 <?php if ( get_sub_field('column_width') ): echo 'medium-'.$column_width; else: echo 'medium-'.$column_width; endif; ?> columns">
        <div class="content">
          <?php echo get_sub_field('column_1'); ?>
        </div>
      </div> 
  </div>
</div>