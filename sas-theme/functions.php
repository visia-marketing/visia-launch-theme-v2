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
    trigger_error(sprintf(__('Error locating %s for inclusion', 'visia_starter_theme'), $file), E_USER_ERROR);
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
      'slug'   => 'advanced-custom-fields-pro',
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
		'parent_slug'  => 'plugins.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
    'strings'      => array(
      'page_title'  => __( 'Install Standard Plugins', 'visia' ),
      'menu_title'  => __( 'Standard Plugins', 'visia' ),
    )
  );

  tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );





function sas_card_shortcode($atts) {
    // Define default attributes
    $atts = shortcode_atts(array(
        'title' => '',
        'text' => '',
        'image_id' => '',
        'link' => ''
    ), $atts, 'sas_card');
    
    // Sanitize attributes
    $title = sanitize_text_field($atts['title']);
    $text = wp_kses_post($atts['text']);
    $image_id = intval($atts['image_id']);
    $link = esc_url($atts['link']);
    
    // Get image URL if image_id is provided
    $image_html = '';
    if ($image_id) {
        $image_url = wp_get_attachment_image_url($image_id, 'medium');
        if ($image_url) {
            $image_html = '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($title) . '" class="sas-card-image">';
        }
    }
    
    // Build the card HTML
    $output = '<div class="sas-card">';
    
    // Add image if available
    if ($image_html) {
        $output .= '<div class="sas-card-image-wrapper">' . $image_html . '</div>';
    }
    
    // Add content wrapper
    $output .= '<div class="sas-card-content">';
    
    // Add title if provided
    if ($title) {
        $output .= '<h3 class="sas-card-title">' . esc_html($title) . '</h3>';
    }
    
    // Add text if provided
    if ($text) {
        $output .= '<div class="sas-card-text">' . $text . '</div>';
    }
    
    // Add link if provided
    if ($link) {
        $output .= '<div class="sas-card-link-wrapper">';
        $output .= '  <a href="' . $link . '" class="sas-card-link" title="Read More">';
        $output .= '    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none"><circle cx="25" cy="25" r="24" stroke="#86AB3C" stroke-width="2"/><path d="M25.4775 17.2881C25.869 16.8988 26.4973 16.9047 26.8809 17.3018L33.709 24.375C34.0923 24.7724 34.0858 25.4105 33.6943 25.7998L26.7295 32.7266C26.338 33.1159 25.7098 33.1098 25.3262 32.7129C24.9426 32.3156 24.9492 31.6776 25.3408 31.2881L30.7744 25.8838H18C17.4477 25.8838 17 25.4361 17 24.8838C17 24.3315 17.4477 23.8838 18 23.8838H30.4551L25.4629 18.7129C25.0793 18.3156 25.086 17.6776 25.4775 17.2881Z" fill="#86AB3C"/></svg>';
        $output .= '  </a>';
        $output .= '</div>';
    }
    
    $output .= '</div>'; // Close content wrapper
    $output .= '</div>'; // Close card wrapper
    
    return $output;
}

// Register the shortcode
add_shortcode('sas_card', 'sas_card_shortcode');

