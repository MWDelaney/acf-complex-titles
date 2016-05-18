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

    require ACFCT_PLUGIN_DIR . 'lib/class-gamajo-template-loader.php';
    require ACFCT_PLUGIN_DIR . 'lib/class-acfct-template-loader.php';



/**
 * Template wrapper
 *
 * @param string $slug The slug name for the generic template.
 * @param string $load The name of the specialised template.
 */

    function ct_template($slug, $load = null) {
        $acfct_templates = new ACFCT_Template_Loader; 
        $acfct_templates->get_template_part( $slug, $load );
    }



/**
 * Main Complex a Titles class
 */

    class ACFComplexTitles {
        
        /**
         * Run filters and actions
         */

            function __construct() {

                //Initialize shortcodes
                add_action( 'init', array( $this, 'add_shortcodes' ) );

                //Initialize ACF fields
                add_action( 'init', array( $this, 'create_acf_fields' ) );	  

                // Maybe replace title with our complex title
                add_filter( 'the_title', array( $this, 'replace_title' ) );

                // Enqueue admin styles and scripts
                add_action('admin_enqueue_scripts', array( $this, 'admin_styles_scripts' ) );
                
                // Enqueue front-end styles
                add_action('wp_enqueue_scripts', array( $this, 'front_end_styles' ) );


            }
                
        
        
        /**
         * Enqueue admin scripts and styles
         */
        
            function admin_styles_scripts() {
                wp_enqueue_style( 'acf-complex-titles-admin-style', ACFCT_PLUGIN_URL . 'assets/css/admin.css' );
                wp_enqueue_script( 'acf-complex-titles-admin-script', ACFCT_PLUGIN_URL . 'assets/js/admin-script.js' );
            }
                
        
        
        /**
         * Enqueue front-end scripts and styles
         */
        
            function front_end_styles() {
                wp_enqueue_style( 'acf-complex-titles-style', ACFCT_PLUGIN_URL . 'assets/css/styles.css' );
            }
        
        

        /**
         * Add 'acfct_title' shortcode
         *
         * @uses acfct_title Function to build the shorcode
         */

            function add_shortcodes() {
                  add_shortcode( 'acfct-title', array($this, 'acfct_title'));
            }

        /**
         * Build the shortcode, call templates
         */

            function acfct_title() { 
                ob_start();
                ct_template( 'group', get_post_type() );
                return ob_get_clean();
            }


        
        /**
         * Add the ACF fields
         */

            function create_acf_fields() {
                $acf_includes = [
                  'lib/acf-fields/complex-titles.php'
                ];

                foreach ($acf_includes as $file) {
                  require_once ACFCT_PLUGIN_DIR . $file;
                }
            }


        /**
         * Replace the WordPress title with our complex title
         * 
         * @param string $title The original WordPress title
         * @return string
         */
            function replace_title($title) {
                if( have_rows('build_title') && in_the_loop() ) {
                    $title = do_shortcode('[acfct_title]');
                    return $title;
                } else {
                    return $title;
                }
            }

    }


$acf_complex_titles = new ACFComplexTitles();
