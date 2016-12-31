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


/**
 * Template wrapper
 *
 * @param string $slug The slug name for the generic template.
 * @param string $load The name of the specialised template.
 */

 function template($slug, $load = null) {
	 $a = ($load) ? '-' . $load : null;
	 $s = ($slug) ? '-' . $slug : null;
	 $t = new \MWD\ComplexTitles\Templates;
	 do_action('acf-complex-titles-before' . $s);
	 do_action('acf-complex-titles-before' . $a);
	 $t->get_template_part( $slug, $load );
	 do_action('acf-complex-titles-after' . $a);
	 do_action('acf-complex-titles-after' . $s);
 }
 function template_data($data, $name) {
	 $d = new \MWD\ComplexTitles\Templates;
	 $d->set_template_data( $data, $name );
 }
