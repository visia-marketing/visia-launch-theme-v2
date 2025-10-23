<?php

namespace Roots\Sage\Assets;

/**
 * JSON Manifest Handler for Asset Management
 * 
 * Manages versioned/hashed asset filenames from build tools like Webpack or Gulp.
 * Build tools often append hashes to filenames for cache-busting (e.g., main.abc123.css).
 * This class reads a JSON manifest file that maps original names to hashed versions.
 */
class JsonManifest {
  /**
   * @var array Parsed manifest data storing filename mappings
   */
  private $manifest;

  /**
   * Constructor
   * 
   * Loads and parses the JSON manifest file if it exists.
   * Falls back to empty array if file is not found.
   * 
   * @param string $manifest_path Full file system path to the manifest JSON file
   */
  public function __construct($manifest_path) {
    if (file_exists($manifest_path)) {
      // Parse the JSON file into an associative array
      $this->manifest = json_decode(file_get_contents($manifest_path), true);
    } else {
      // Initialize empty manifest if file doesn't exist
      $this->manifest = [];
    }
  }

  /**
   * Get the entire manifest array
   * 
   * Returns all asset mappings from the manifest file.
   * 
   * @return array Complete manifest data
   */
  public function get() {
    return $this->manifest;
  }

  /**
   * Get a specific path from the manifest using dot notation
   * 
   * Allows accessing nested values in the manifest using dot notation.
   * For example: 'scripts.main' would access $manifest['scripts']['main']
   * 
   * @param string $key Dot-notated key to search for (e.g., 'scripts.main')
   * @param mixed $default Default value to return if key is not found
   * @return mixed The value at the specified key, or default if not found
   */
  public function getPath($key = '', $default = null) {
    $collection = $this->manifest;
    
    // Return entire collection if no key specified
    if (is_null($key)) {
      return $collection;
    }
    
    // Direct key lookup (non-nested)
    if (isset($collection[$key])) {
      return $collection[$key];
    }
    
    // Handle dot notation for nested keys
    foreach (explode('.', $key) as $segment) {
      if (!isset($collection[$segment])) {
        // Key segment not found, return default
        return $default;
      } else {
        // Traverse deeper into the array
        $collection = $collection[$segment];
      }
    }
    
    return $collection;
  }
}

/**
 * Get the versioned/hashed URL for an asset file
 * 
 * This function handles cache-busting by using hashed filenames from the build process.
 * It checks the manifest file for the hashed version of the requested file.
 * 
 * Example usage:
 * - Input: asset_path('dist/styles/main.css')
 * - Output: http://example.com/wp-content/themes/theme/assets/dist/styles/main.abc123.css
 * 
 * The manifest.json might look like:
 * {
 *   "main.css": "main.abc123.css",
 *   "main.js": "main.def456.js"
 * }
 * 
 * @param string $filename Relative path to the asset file within the assets directory
 * @return string Full URL to the asset (versioned if in manifest, original if not)
 */
function asset_path($filename) {
  // Base URL for assets directory (e.g., http://example.com/wp-content/themes/theme/assets/)
  $dist_path = get_template_directory_uri() . '/assets/';
  
  // Extract directory path from filename (e.g., 'dist/styles/' from 'dist/styles/main.css')
  $directory = dirname($filename) . '/';
  
  // Extract just the filename (e.g., 'main.css' from 'dist/styles/main.css')
  $file = basename($filename);
  
  // Static variable to cache the manifest object (persists across function calls)
  static $manifest;

  /**
   * Load manifest file only once per request
   * Static caching prevents repeated file reads
   */
  if (empty($manifest)) {
    // Build full file system path to the manifest file
    $manifest_path = get_template_directory() . '/assets/' . 'assets.json';
    $manifest = new JsonManifest($manifest_path);
  }

  /**
   * Check if the requested file has a versioned/hashed equivalent in the manifest
   */
  if (array_key_exists($file, $manifest->get())) {
    // Return URL with hashed filename for cache-busting
    return $dist_path . $directory . $manifest->get()[$file];
  } else {
    // No manifest entry found, return original filename
    // This handles files not processed by the build tool
    return $dist_path . $directory . $file;
  }
}