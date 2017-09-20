<?php

namespace MWD\ComplexTitles;

/**
 * Main Complex Titles class
 */

    class Init {

        /**
         * Run filters and actions
         */

            function __construct() {

                //Initialize shortcodes
                add_action( 'init', array( $this, 'add_shortcodes' ) );

                // Maybe replace title with our complex title
                add_filter( 'the_title', array( $this, 'replace_title' ) );

                // Set up an action to include the actual display styles, easily hooked to add more
                add_action('admin_enqueue_scripts', array( $this, 'complex_titles_styles' ) );
                add_action('wp_enqueue_scripts', array( $this, 'complex_titles_styles' ) );
                add_action('complex_titles_css', array( $this, 'front_end_styles' ) );

                // Enqueue admin styles and scripts
                add_action('admin_enqueue_scripts', array( $this, 'admin_styles' ) );
                add_action('admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

                // Set up contextual data for templates
                add_action('acf-complex-titles-before-title', array( $this, 'title_context' ) );
                add_action('acf-complex-titles-before-group', array( $this, 'group_context' ) );
                add_action('acf-complex-titles-before-element', array( $this, 'element_context' ) );

                // Enqueue front-end styles
                add_action('wp_enqueue_scripts', array( $this, 'complex_titles_styles' ) );

                // Set default layout class name
                add_filter ('acfct_set_layout_class',  function() { return '\MWD\ComplexTitles\Layout'; });

                // Set default fields class name
                add_filter ('acfct_set_fields_class',  function() { return '\MWD\ComplexTitles\Fields'; });

                // Set default layout class name
                add_filter ('acfct_set_layout_class',  function() { return '\MWD\ComplexTitles\Layout'; });

                add_action( 'admin_init', '\MWD\ComplexTitles\Setup::create_titles' );
                if(!is_admin()) {
                  add_action( 'wp_loaded', '\MWD\ComplexTitles\Setup::create_titles' );
                }

            }


        /**
         * Set classname containing Complex Title fields
         */
         function fields_class($s) {
           return '\MWD\ComplexTitles\Fields';
         }

         /**
          * Set classname containing Complex Title fields
          */
          function layout_class($s) {
            return '\MWD\ComplexTitles\Layout';
          }

         /**
          * Create a new action so it's easier to include styles in a single action call
          */
         function complex_titles_styles() {
           do_action('complex_titles_css');
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

          function acfct_title($atts) {

            $atts = shortcode_atts( array(
              "id" => false,
            ), $atts );

            // Initialize the template loader
            $templates = new \MWD\ComplexTitles\Templates;

            ob_start();
            do_action('acf-complex-titles-before-title', $atts['id']);
            $templates->get_template_part( 'title', get_post_type() );
            do_action('acf-complex-titles-after-title', $atts['id']);
            return ob_get_clean();
          }


          /**
           * Set template context for 'title' template
           */

           function title_context($id) {

            // Initialize the templates class
            $templates = new \MWD\ComplexTitles\Templates;

            // Initialize the $context array
            $context = array();

            // Set template context to include the template loader so we can use it to call additional templates
            $context['template'] = $templates;
            $context['id'] = $id;

            // Set template context
            $templates->set_template_data( $context, 'context' );
          }

          /**
            * Set classes for a layout. These can be overridden or added to with a filter like the following:
            *
            * @return string string of classes
            */
            function group_context($id) {

              // Initialize the templates class
              $templates = new \MWD\ComplexTitles\Templates;

              // Set the default classes for groups
              $class_basename = 'complex-title-group';
              $classes    = array();
              $classes[]  = $class_basename;
              $classes[]  = (get_sub_field('alignment'))        ? ' ' . $class_basename . '-alignment-' . get_sub_field('alignment')   : '';

              // Apply filter to classes
              $classes = apply_filters( 'ct_set_group_classes', $classes );

              // Set up template context array
              $context  = array();
              $context['template'] = $templates;
              $context['classes'] = esc_attr(trim(implode(' ', $classes)));
              $context['id'] = $id;

              // Set template data
              $templates->set_template_data( $context, 'context' );

           }

           /**
             * Set classes for a title element. These can be overridden or added to with a filter like the following:
             *
             * @return string string of classes
             */
            function element_context($id) {
              // Initialize the templates class
              $templates = new \MWD\ComplexTitles\Templates;

              // Set the default classes for elements
              $class_basename = 'complex-title-element';
              $classes    = array();
              $classes[]  = $class_basename;
              $classes[]  = (get_sub_field('alignment'))        ? ' ' . $class_basename . '-alignment-' . get_sub_field('alignment')   : '';
              $classes[]  = (get_sub_field('emphasize'))        ? ' ' . $class_basename . '-emphasize' : '';
              $classes[]  = (get_sub_field('size'))             ? ' ' . $class_basename . '-size-' . get_sub_field('size')   : '';

              // Apply filter to classes
              $classes = apply_filters( 'ct_set_element_classes', $classes );

              // Set up template context array
              $context  = array();
              $context['template'] = $templates;
              $context['classes'] = esc_attr(trim(implode(' ', $classes)));
              $context['id'] = $id;

              // Set template data
              $templates->set_template_data( $context, 'context' );

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
                    if( sanitize_title($post->post_title) == sanitize_title($title) ) {
                        $complex_title = do_shortcode('[acfct-title]');
                        $title = $complex_title;
                    }
                }
                return $title;
            }

    }
