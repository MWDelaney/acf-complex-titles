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

    require ACFCT_PLUGIN_DIR . 'lib/class-acfct-layout.php';
    require ACFCT_PLUGIN_DIR . 'lib/class-acfct-fields.php';

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
     * Set classes for a layout. These can be overridden or added to with a filter like the following:
     *     add_filter( 'ct_set_group_classes', 'custom_group_classes' );
     *     function custom_group_classes($classes) {
     *         if(is_page_template('template-landing-page.php') {
     *             $classes[]   = 'on-landing-page';
     *         }
     *         return $classes;
     *     }
     *         
     * @return string string of classes
     */
    function ct_group_classes() {
        $class_basename = 'complex-title-group';
        $classes    = array();
        $classes[]  = $class_basename;
        $classes[]  = (get_sub_field('alignment'))        ? ' ' . $class_basename . '-alignment-' . get_sub_field('alignment')   : '';

        
        $classes = array_filter(array_map('trim', $classes));
        echo trim(implode(' ', apply_filters( 'ct_set_group_classes', $classes )));
    }




   /**
     * Set classes for a title element. These can be overridden or added to with a filter like the following:
     *     add_filter( 'ct_set_element_classes', 'custom_element_classes' );
     *     function custom_element_classes($classes) {
     *         if(is_page_template('template-landing-page.php') {
     *             $classes[]   = 'on-landing-page';
     *         }
     *         return $classes;
     *     }
     *         
     * @return string string of classes
     */
    function ct_element_classes() {
        $class_basename = 'complex-title-element';
        $classes    = array();
        $classes[]  = $class_basename;
        $classes[]  = (get_sub_field('alignment'))        ? ' ' . $class_basename . '-alignment-' . get_sub_field('alignment')   : '';
        $classes[]  = (get_sub_field('emphasize'))        ? ' ' . $class_basename . '-emphasize' : '';
        $classes[]  = (get_sub_field('size'))             ? ' ' . $class_basename . '-size-' . get_sub_field('size')   : '';    
        
        $classes = array_filter(array_map('trim', $classes));
        echo trim(implode(' ', apply_filters( 'ct_set_element_classes', $classes )));
    }



/**
 * Main Complex Titles class
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
                add_action('admin_enqueue_scripts', array( $this, 'admin_styles' ) );
                add_action('admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
                
                // Enqueue front-end styles
                add_action('wp_enqueue_scripts', array( $this, 'front_end_styles' ) );


            }
                
        
        
        /**
         * Enqueue admin scripts and styles
         */
        
            function admin_styles() {
                wp_enqueue_style( 'acf-complex-titles-admin-style', ACFCT_PLUGIN_URL . 'assets/css/admin.css' );
            }

            function admin_scripts() {
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
                global $post;
                if( have_rows('build_title') && in_the_loop() ) {
                    
                    // Check whether the current post's title is the same as what's being passed to the filter. This prevents attempting to run the filter on content it won't work with.
                    if( $post->post_title == $title ) {
                        $title = do_shortcode('[acfct-title]');
                        return $title;
                    } else {
                        return $title;
                    }
                    
                } 
            }

    }


$acf_complex_titles = new ACFComplexTitles();
