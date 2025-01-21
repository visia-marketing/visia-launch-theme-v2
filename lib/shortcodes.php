<?php

namespace Roots\Sage\Shortcodes;

use Roots\Sage\Setup;



/**
 * Add custom colors
 */

 




/**
 * Social UL
 */

 function social_shortcode($atts) {
  // Parse shortcode attributes
  $atts = shortcode_atts(
      array(
          'class' => '', // Default value for class attribute
      ),
      $atts,
      'social'
  );

  // Get the ACF repeater field as an option
  if (have_rows('social_media', 'options')) {
      $output = '<ul class="' . esc_attr($atts['class']) . '">';
      
      // Loop through repeater rows
      while (have_rows('social_media', 'options')) {
          the_row();
          $icon = get_sub_field('fa_icon_code'); // Field for Font Awesome icon code
          $url = get_sub_field('social_url'); // Field for social media URL
          
          if ($icon && $url) {
              $output .= '<li><a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer">';
              $output .= $icon;
              $output .= '</a></li>';
          }
      }

      $output .= '</ul>';
      return $output;
  }

  // Return empty if no repeater rows
  return '';
}
add_shortcode('social',  __NAMESPACE__ . '\\social_shortcode');