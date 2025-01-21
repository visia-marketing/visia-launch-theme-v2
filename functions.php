<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/acf.php',       // Everything ACF
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/nav.php',       // Nav setup - from foundationpress
  'lib/setup.php',     // Theme setup
  'lib/shortcodes.php',// Shortcodes
  'lib/tinymce.php',   // Tiny MCE
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);



/**
 * I would consider moving these
 */

/***************************************************************************
 * M I S C  S T U F F 
 ***************************************************************************/


/**
 * Used for download monitor - used on most sites
 */

add_filter( 'dlm_do_xhr', '__return_false' );



/**
 * Security Headers - hardens site a little - could replace with simple ssl plugin
 */

add_action('send_headers', 'add_security_headers');
function add_security_headers() {
    $nonce = base64_encode(random_bytes(16)); // Generate a unique nonce for each request
    header("Cache-Control: no-cache, must-revalidate");
    header("Content-Security-Policy: default-src 'self' https:; script-src 'self' 'unsafe-inline' https: http:;style-src 'self' https: 'unsafe-inline';font-src 'self' https: data:;img-src 'self' https: data:;frame-src https:;connect-src 'self' https:;object-src 'none';base-uri 'self';form-action 'self';");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: SAMEORIGIN");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Permissions-Policy: geolocation=(), microphone=()");
    header("Expect-CT: max-age=86403, enforce");

    // Store the nonce for use in inline scripts
    global $csp_nonce;
    $csp_nonce = $nonce;

}

add_filter('script_loader_tag', 'add_nonce_to_scripts', 10, 3);
function add_nonce_to_scripts($tag, $handle, $src) {
    global $csp_nonce;
    if (!empty($csp_nonce)) {
        // Add nonce attribute to the script tag
        $tag = str_replace('<script ', "<script nonce=\"$csp_nonce\" ", $tag);
    }
    return $tag;
}