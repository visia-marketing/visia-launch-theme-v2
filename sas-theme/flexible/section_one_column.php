<?php

$pad_top = get_sub_field('padding_top') ?: 0;
$pad_bottom = get_sub_field('padding_bottom')  ?: 0;
?>

<div class="fc-section-columns">
  <?php get_template_part('flexible/section_header'); ?>
  <div class="row" style="padding-top: <?php echo $pad_top;?>rem; padding-bottom: <?php echo $pad_bottom;?>rem; ">

      <div class="small-12 medium-<?php echo get_sub_field('column_width'); ?> columns">
        <div class="content content-columns">
          <?php echo get_sub_field('column_1'); ?>
        </div>
      </div>

  </div>
</div>