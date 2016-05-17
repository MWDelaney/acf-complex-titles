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


// ======================================================================== //		
// Include necessary functions and files
// ======================================================================== //

    define( 'ACFCT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
    define( 'ACFCT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

    require ACFCT_PLUGIN_DIR . 'lib/class-gamajo-template-loader.php';
    require ACFCT_PLUGIN_DIR . 'lib/class-acfct-template-loader.php';


// ======================================================================== //



// ======================================================================== //		
// Wrapper for get_template_part() to check the plugin's template first
// ======================================================================== //

    function ct_template($slug, $load = null) {
        $acfct_templates = new ACFCT_Template_Loader; 
        $acfct_templates->get_template_part( $slug, $load );
    }

// ======================================================================== //



// ======================================================================== //		
// Class for other functionality
// ======================================================================== //

    class ACFCompelexTitles {
        
        // ======================================================================== //		
        // Initialize shortcodes and conditionally include opt-in Bootstrap scripts
        // ======================================================================== //

            function __construct() {

                //Initialize shortcodes
                add_action( 'init', array( $this, 'add_shortcodes' ) );

                //Initialize ACF fields
                add_action( 'init', array( $this, 'create_acf_fields' ) );	  

                // Append shortcode to the_content
                add_filter( 'the_title', array( $this, 'replace_title' ) );

                // Enqueue admin styles and scripts
                add_action('admin_enqueue_scripts', array( $this, 'admin_styles_scripts' ) );
                
                // Enqueue front-end styles
                add_action('wp_enqueue_scripts', array( $this, 'front_end_styles' ) );


            }
        
        // ======================================================================== //
        
        
        
        // ======================================================================== //		
        // Function to enqueue admin styles and scripts
        // ======================================================================== //
        
            function admin_styles_scripts() {
                wp_enqueue_style( 'acf-complex-titles-admin-style', ACFCT_PLUGIN_URL . 'assets/css/admin.css' );
                wp_enqueue_script( 'acf-complex-titles-admin-script', ACFCT_PLUGIN_URL . 'assets/js/admin-script.js' );
            }
        
        // ======================================================================== //
        
        
        
        // ======================================================================== //		
        // Function to enqueue admin styles and scripts
        // ======================================================================== //
        
            function front_end_styles() {
                wp_enqueue_style( 'acf-complex-titles-style', ACFCT_PLUGIN_URL . 'assets/css/styles.css' );
            }
        
        // ======================================================================== //

        

        // ======================================================================== //		
        // Add a shortcode so we can more easily append it to the_content()
        // ======================================================================== //

            function add_shortcodes() {
                  add_shortcode( 'acfct_title', array($this, 'acfct_title'));
            }

            function acfct_title() { 
                ob_start();
                ct_template( 'group', get_post_type() );
                return ob_get_clean();
            }

        // ======================================================================== //

        
        // ======================================================================== //		
        // Create ACF Fields
        // ======================================================================== //

            function create_acf_fields() {
                $acf_includes = [
                  'lib/acf-fields/complex-titles.php'                  // Complex Titles
                ];

                foreach ($acf_includes as $file) {
                  require_once ACFCT_PLUGIN_DIR . $file;
                }
            }

        // ======================================================================== //



        // ======================================================================== //		
        // Replace the title with our complex title
        // ======================================================================== //
            function replace_title($title) {
                if( have_rows('build_title') && in_the_loop() ) {
                    $title = do_shortcode('[acfct_title]');
                    return $title;
                } else {
                    return $title;
                }
            }

        // ======================================================================== //

    }

// ======================================================================== //

new ACFCompelexTitles();