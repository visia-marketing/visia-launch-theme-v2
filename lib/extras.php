<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */

function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');



/**
 * Clean up the_excerpt()
 */

function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');



/**
 * Move Yoast to Bottom
 */

 function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio',  __NAMESPACE__ . '\\yoasttobottom');



/**
 * Obfuscate Email Address
 */
function obfuscate_email($email) {
  $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';
  $key = str_shuffle($character_set);
  $cipher_text = '';
  $id = 'e'.rand(1,999999999);

  for ($i = 0; $i < strlen($email); $i++) {
      $cipher_text .= $key[strpos($character_set, $email[$i])];
  }

  $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";';
  $script .= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';
  $script .= 'document.getElementById("'.$id.'").innerHTML="<a href=\\"mailto:"+d+"\\">"+d+"</a>"';

  $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'),$script)."\")";
  $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>';

  return '<span id="'.$id.'" class="">[protected email address]</span>'.$script;
}



/**
 * Obfuscate Phone
 */

function obfuscate_phone($phone) {
  $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';
  $key = str_shuffle($character_set);
  $cipher_text = '';
  $id = 'e'.rand(1,999999999);

  for ($i = 0; $i < strlen($phone); $i++) {
      $cipher_text .= $key[strpos($character_set, $phone[$i])];
  }

  $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";';
  $script .= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';
  $script .= 'document.getElementById("'.$id.'").innerHTML="<span>"+d+"</span>"';

  $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'),$script)."\")";
  $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>';

  return '<span id="'.$id.'" class="">[protected phone]</span>'.$script;
}

function obfuscate_phone_link($phone) {
  $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';
  $key = str_shuffle($character_set);
  $cipher_text = '';
  $id = 'e'.rand(1,999999999);

  for ($i = 0; $i < strlen($phone); $i++) {
      $cipher_text .= $key[strpos($character_set, $phone[$i])];
  }

  $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";';
  $script .= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';
  $script .= 'document.getElementById("'.$id.'").innerHTML="<a href=\\"tel:"+d+"\\">"+d+"</a>"';

  $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'),$script)."\")";
  $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>';

  return '<span id="'.$id.'" class="">[protected phone]</span>'.$script;
}



/**
 * SVG Arrow – Not sure we are still using this
 */

 function svg_arrow() {
  $html= '<svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">';
  $html .= '<path d="M1 11H31" stroke="#232323" stroke-linecap="round"/>';
  $html .= '<path d="M31 11L21 1" stroke="#232323" stroke-linecap="round"/>';
  $html .= '<path d="M31 11L21 21" stroke="#232323" stroke-linecap="round"/>';
  $html .= '</svg>';

  return $html;
  
}






/**
 * Set Akro in Action Gallery to be 20 per page
 */

function set_posts_per_page_for_akro_in_action($query) {
  // Check if it's the main query, not in the admin, and for the 'akro-in-action' post type archive
  if ($query->is_main_query() && !is_admin() && is_post_type_archive('akro-in-action')) {
      $query->set('posts_per_page', 20); // Set the number of posts per page to 20
  }
}
add_action('pre_get_posts', __NAMESPACE__ . '\\set_posts_per_page_for_akro_in_action');



/**
 * Loads the videos via AJAX in the modal windows
 */

function load_video_content() {
  // Verify nonce if needed (for security)
  $post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

  if ($post_id) {
      // Fetch the video content using ACF or any other logic
      $video_url = get_field('video_url', $post_id);

      if ($video_url) {
        echo $video_url;
      } else {
        echo '<p>No video found for this post.</p>';
      }
  } else {
      echo '<p>Invalid post ID.</p>';
  }

  wp_die(); // Important: terminate to return a proper response
}
add_action('wp_ajax_load_video_content', __NAMESPACE__ . '\\load_video_content');
add_action('wp_ajax_nopriv_load_video_content', __NAMESPACE__ . '\\load_video_content');