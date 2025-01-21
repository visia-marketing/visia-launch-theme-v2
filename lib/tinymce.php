<?php

namespace Roots\Sage\Tinymce;

use Roots\Sage\Setup;

/**
 * Add custom colors
 */

function my_mce_color_options($init) {
  $default_colors = ' "000000", "Black",
                      "993300", "Burnt orange",
                      "333300", "Dark olive",
                      "003300", "Dark green",
                      "003366", "Dark azure",
                      "000080", "Navy Blue",
                      "333399", "Indigo",
                      "333333", "Very dark gray",
                      "800000", "Maroon",
                      "FF6600", "Orange",
                      "808000", "Olive",
                      "008000", "Green",
                      "008080", "Teal",
                      "0000FF", "Blue",
                      "666699", "Grayish blue",
                      "808080", "Gray",
                      "FF0000", "Red",
                      "FF9900", "Amber",
                      "99CC00", "Yellow green",
                      "339966", "Sea green",
                      "33CCCC", "Turquoise",
                      "3366FF", "Royal blue",
                      "800080", "Purple",
                      "999999", "Medium gray",
                      "FF00FF", "Magenta",
                      "FFCC00", "Gold",
                      "FFFF00", "Yellow",
                      "00FF00", "Lime",
                      "00FF00", "Lime",
                      "00FFFF", "Aqua",
                      "00CCFF", "Sky blue",
                      "993366", "Red violet",
                      "FFFFFF", "White",
                      "FF99CC", "Pink",
                      "FFCC99", "Peach",
                      "FFFF99", "Light yellow",
                      "CCFFCC", "Pale green",
                      "CCFFFF", "Pale cyan",
                      "99CCFF", "Light sky blue",
                      "CC99FF", "Plum"';

  $custom_colors =   '"232323", "Black",
                      "D51F2A", "Red",
                      "2B60A2", "Dark blue",
                      "7AA2D5", "Blue",
                      "6E6F72", "Grey"';

  // build colour grid default+custom colors
  $init['textcolor_map'] = '['.$default_colors.','.$custom_colors.']';

  // enable 6th row for custom colours in grid
  $init['textcolor_rows'] = 7;

  return $init;
}
add_filter('tiny_mce_before_init', __NAMESPACE__ . '\\my_mce_color_options');



/**
 * Add styles to TinyMCE
 */

 function wpb_mce_buttons_2($buttons) {
  array_unshift($buttons, 'styleselect');
  return $buttons;
}
add_filter('mce_buttons_2', __NAMESPACE__ . '\\wpb_mce_buttons_2');



/*
* Callback function to filter the MCE settings
*/

function my_mce_before_init_insert_formats( $init_array ) {  

// Define the style_formats array

$style_formats = array(  

  array(  
    'title' => 'Section Subtitle',  
    'inline' => 'span',  
    'classes' => 'g-section-subtitle',
    'wrapper' => true,
     
  ),
  array(  
    'title' => 'Section Title',  
    'inline' => 'span',  
    'classes' => 'g-section-title',
    'wrapper' => true,
     
  ),
  array(  
    'title' => 'Large Number - Red',  
    'inline' => 'span',  
    'classes' => 'g-section-large-numbers',
    'wrapper' => true,
     
  ),
  array(  
    'title' => 'Button with Arrow',  
    'selector' => 'a',  
    'classes' => 'button button-arrow',
  ),
);  
  
// Insert the array, JSON ENCODED, into 'style_formats'
$init_array['style_formats'] = json_encode( $style_formats );  
 
return $init_array;  
 
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', __NAMESPACE__ . '\\my_mce_before_init_insert_formats' ); 

