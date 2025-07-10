<?php
$justify_y_1 = get_sub_field('column_1_vertical_justify');
$justify_x_1 = get_sub_field('column_1_horizontal_justify');


$justify_y_2 = get_sub_field('column_2_vertical_justify');
$justify_x_2 = get_sub_field('column_2_horizontal_justify');

if( array_key_exists('flex_id', $args) ){
  $flex_id = $args['flex_id'];

  $style = "<style>";
  if( $justify_x_1 ){
    $style .= "#$flex_id .flex-column-1--content { align-items: $justify_x_1; }";
  }
  if( $justify_y_1 ){
    $style .= "#$flex_id .flex-column-1--content { justify-content: $justify_y_1; }";
  }
  if( $justify_x_2 ){
    $style .= "#$flex_id .flex-column-2--content { align-items: $justify_x_2; }";
  }
  if( $justify_y_2 ){
    $style .= "#$flex_id .flex-column-2--content { justify-content: $justify_y_2; }";
  }
  $style .= "</style>";

  echo $style;

}
?>

<div class="fc-section-columns">

  <div class="row padding-row" data-equalizer>
      <?php get_template_part('flexible/section_header'); ?>  
      <div class="small-12 medium-6 columns flex-column-1 small-order-2 large-order-1">
        <div class="content content-columns flex-column-1--content" data-equalizer-watch>
          <?php echo get_sub_field('column_1'); ?>
        </div>
      </div>
      <div class="small-12 medium-6 columns flex-column-2  small-order-1 large-order-2">
        <div class="content content-columns flex-column-2--content" data-equalizer-watch>
          <?php echo get_sub_field('column_2'); ?>
        </div>
      </div>
  
  </div>
</div>