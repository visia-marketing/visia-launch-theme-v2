<?php

//namespace Roots\Sage\Acf;

/**
 * Collapse ACF Fields
 */

 add_action('acf/input/admin_head','my_acf_admin_head');
 function my_acf_admin_head() { ?>
   <script type="text/javascript">
   jQuery(document).ready(function($) {
     $('.layout').not('.clones .layout').addClass('-collapsed');
   });
   </script>
   <?php
 }



/**
 * Convers a string to a usable anchor in if field Example String -> example-string
 */

 function create_anchor($string) {
  $string = strtolower($string);
  $string = preg_replace('/[^a-z0-9]+/', ' ', $string);
  $string = trim($string);
  $string = str_replace(' ', '-', $string);
  return $string;
}



/**
 * ACF Flexible Content
 */ 

 function get_flexible_content() {
  if (have_rows('flexible_content')) {
    echo '<div class="fc-wrapper" id="fc-wrapper-' . esc_attr(create_anchor(get_the_title())) . '">';
    
    while (have_rows('flexible_content')) : the_row();
      $layout = get_row_layout();
      $id = get_sub_field('id') ?: 'fc-section-' . get_row_index();
      $class = get_sub_field('class') ?: '';
      $justification = get_sub_field('justification') ?: '';
      $column_style = get_sub_field('column_style') ?: '';
      $background = get_sub_field('background') ?: '';
      $background_image_id = get_sub_field('background_image');

      echo '<section class="fc-section fc-section-' . esc_attr(get_row_index()) . ' fc-section-' . esc_attr($background) . ' ' . esc_attr($class) . ' ' . esc_attr($justification) . ' ' . esc_attr($column_style) . '" id="' . esc_attr($id) . '">';

      // Display the background image if the background type is 'image' and an image ID exists
      if ($background === 'image' && $background_image_id) {
        echo wp_get_attachment_image($background_image_id, 'full', false, ['class' => 'fc-section-background-image']);
      }

      get_template_part('flexible/' . $layout);
      echo '</section>';

    endwhile;

    echo '</div>';
  }
}



/**
 * ACF Helper functions - Not using these but save just in case
 */


//Torch Image attachement
function acf_attachment_img($image, $size = 'full', $class = 'nc'){
  if( $image ) {
      echo wp_get_attachment_image( $image, $size,'', array( "class" => $class ) );
  }
}

//Wrap ACF content
function acf_field($field, $element = 'div', $class='nc'){
  if( !$field ){ return; }
  echo '<' . $element . ' class="' . $class . '">' . $field . '</' . $element . '>';
}

//ACF button
function acf_button($link, $has_arrow=false, $class='nc', $attr=false){
  if( !$link ) return;
  $link['target'] = $link['target'] ?: '_self'; ?>

  <a href="<?= esc_url($link['url']); ?>" target="<?= $link['target'] ?>" class="btn <?= $class ?>"<?php if($attr) echo ' ' . $attr ?>>
    <?= $link['title']; ?>
    <?php if($has_arrow){ echo '<i class="fa-solid fa-angle-right"></i>'; }; ?>
  </a>
  <?php
}