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
  'lib/class-tgm-plugin-activation.php', // Required and Recommended Plugins Class
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


/**
 * Recommended and Required Plugins
 */
function my_theme_register_required_plugins() {
  $plugins = array(
    


    array(
			'name'   => 'Advanced Custom Fields Pro',
      'slug'   => 'acf-pro',
			'source' => 'https://github.com/pronamic/advanced-custom-fields-pro/archive/refs/heads/main.zip',
      'required'     => true,
      'force_activation'  => true,
      'external_url' => 'https://github.com/pronamic/advanced-custom-fields-pro', // If set, overrides default API URL and points to an external URL.
		),
    array(
			'name'     => 'Classic Editor',
			'slug'     => 'classic-editor',
			'required' => true,
      'force_activation'  => true,
		),
    array(
			'name'     => 'SVG Support',
			'slug'     => 'svg-support',
			'required' => true,
		),
    array(
			'name'     => 'Classic Widgets',
			'slug'     => 'classic-widgets',
			'required' => true,
      'force_activation'  => true,
		),
    array(
			'name'     => 'Query Monitor',
			'slug'     => 'query-monitor',
			'required' => false,
		),
    array(
			'name'     => 'Wordfence',
			'slug'     => 'wordfence',
			'required' => false,
		),
    array(
			'name'     => 'Really Simple Security',
			'slug'     => 'really-simple-ssl',
			'required' => false,
		),
    array(
			'name'     => 'WP Fastest Cache',
			'slug'     => 'wp-fastest-cache',
			'required' => false,
		),
    array(
			'name'     => 'UpdraftPlus: WP Backup & Migration Plugin',
			'slug'     => 'updraftplus',
			'required' => false,
		),
    array(
			'name'     => 'WebP Express',
			'slug'     => 'webp-express',
			'required' => false,
		),
    array(
			'name'     => 'Disable Comments',
			'slug'     => 'disable-comments',
			'required' => false,
		),

  );

  $config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
    'strings'      => array(
      'page_title'  => __( 'Install Standard Plugins', 'theme-slug' ),
    )
  );

  tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );