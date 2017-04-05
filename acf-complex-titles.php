<?php
/*
Plugin Name: ACF Complex Titles
Plugin URI:
Description: Complex titles for WordPress content using ACF Pro 5
Version: 1.0
Author: Michael W. Delaney
Author URI:
License: MIT
*/

namespace MWD\ComplexTitles;

/**
 * Set up autoloader
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * Define constants
 */

    define( 'ACFCT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
    define( 'ACFCT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );



/**
 * Require classes
 *
 * Require classes to load template files from site theme with fallback to plugin directory
 */

 $acfct_init = new \MWD\ComplexTitles\Init();
 $acfct_setup = new \MWD\ComplexTitles\Setup();
