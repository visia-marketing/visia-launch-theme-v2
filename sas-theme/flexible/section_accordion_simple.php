<?php
//$top_border = (get_sub_field('top_border') === 'yes') ? "top-border" : "";
//$anchor = get_sub_field('section_heading') ? create_anchor(get_sub_field('section_heading')) : '';
$layout = get_sub_field('accordion_layout');
?>

<div class="fc-section-accordion-simple" id="<?php //echo $anchor;?>">
  <?php get_template_part('flexible/section_header'); ?>
  <?php if( have_rows('accordion') ): ?>
  <div class="row columns "> 
    <div class="row columns">
      <div class="accordion <?php if ( $layout  === 'separated'): echo 'separated'; endif; ?>">
      <?php while ( have_rows('accordion' ) ): the_row(); ?>
          <div class="accordion-item">
            <div class="accordion-topic"><h4><?php echo get_sub_field('heading');?></h4><div class="accordion-arrow"><i class="fa-thin fa-chevron-right"></i></div></div>
            <div class="accordion-response"><?php echo get_sub_field('content');?></div>
          </div>
      <?php endwhile; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>