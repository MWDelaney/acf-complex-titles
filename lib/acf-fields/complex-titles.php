<?php
if( function_exists('acf_add_local_field_group') ):

    $args = array (
        'key' => 'group_567332edc8e48',
        'title' => 'Complex Titles',
        'fields' => array (
            array (
                'key' => 'field_5673328771366',
                'label' => 'Preview Placeholder',
                'name' => '',
                'type' => 'message',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'esc_html' => 0,
                'new_lines' => 'wpautop',
            ),
            array (
                'key' => 'field_5673330824dd5',
                'label' => 'Build Title',
                'name' => 'build_title',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => '',
                'max' => '',
                'layout' => 'block',
                'button_label' => 'Add Group',
                'sub_fields' => array (
                    array (
                        'key' => 'field_56f07d9857697',
                        'label' => 'Title',
                        'name' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ),
                    array (
                        'key' => 'field_56f05bf5f9da8',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'collapsed' => '',
                        'min' => '',
                        'max' => '',
                        'layout' => 'table',
                        'button_label' => 'Add Word',
                        'sub_fields' => array (),
                    ),
                    array (
                        'key' => 'field_56f07daf57698',
                        'label' => 'Layout',
                        'name' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ),
                    array (
                        'key' => 'field_56f07db857699',
                        'label' => 'Alignment',
                        'name' => 'alignment',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array (
                            'none' => 'None',
                            'left' => 'Left',
                            'right' => 'Right',
                            'center' => 'Center',
                        ),
                        'default_value' => array (
                        ),
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'placeholder' => '',
                        'disabled' => 0,
                        'readonly' => 0,
                    ),
                ),
            ),
        ),
        'location' => array (
            array (),
        ),
        'menu_order' => 0,
        'position' => 'acf_after_title',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    );

/*--------------------------------------------------------------------------------------
    *
    * Check for declared post types to attach fields to
    *
    * @author Michael W. Delaney
    * @since 1.0
    *
    * Default: page
    *
    * Declare theme support for specific post types:
    *   add_theme_support( 'complex-titles-location', array( 'page', 'post' ) );
    *
    *-------------------------------------------------------------------------------------*/
    //Check if theme support is explicitly defined. If so, enable all attachments declared in theme support.
    if( current_theme_supports( 'complex-titles-location' ) ) {
        $locations_supported    = get_theme_support( 'complex-titles-location' );
        $locations_enabled      = $locations_supported[0];
    } else {
        // If theme support is not explicitly defined, enable default attachments.
        $locations_enabled = array();
        $locations_enabled[] = 'page';
    }

    // Enable each location
    foreach ($locations_enabled as $location) {
        $location_array = array();
        $location_array['param']    = 'post_type';
        $location_array['operator'] = '==';
        $location_array['value'] = $location;

        $args['location'][][] = $location_array;

    }



  /*--------------------------------------------------------------------------------------
    *
    * Include all enabled fields
    *
    * @author Michael W. Delaney
    * @since 1.0
    *
    * Declare theme support for specific fields. Default is to include all fields: 
    *   add_theme_support( 'complex-title-fields', array( 'emphasize', 'alignment' ) );
    *
    *-------------------------------------------------------------------------------------*/

        
    //Check if theme support is explicitly defined. If so, only enable layouts declared in theme support.
    if( current_theme_supports( 'complex-title-fields' ) ) {
        $fields_supported = get_theme_support( 'complex-title-fields' );
        $fields_enabled = $fields_supported[0];
    } else {
        // If theme support is not explicitly defined, enable all fields as a fallback.
        $fields_enabled = array();
        foreach(glob(ACFCT_PLUGIN_DIR . 'lib/acf-fields/fields/*.php') as $field) {
            $fields_enabled[] = basename($field, '.php');
        }
    }

    // Enable each field
    $fields_array = array();
    foreach ($fields_enabled as $field) {
        include(ACFCT_PLUGIN_DIR . 'lib/acf-fields/fields/' . $field . '.php');
    }
    usort($fields_array, function ($a, $b) {
        if ($a['order'] == $b['order']) return 0;
        return $a['order'] < $b['order'] ? -1 : 1;
    });
    foreach ( $fields_array as $field) {
        $args['fields'][1]['sub_fields'][1]['sub_fields'][] = $field['field'];
    }



  /*--------------------------------------------------------------------------------------
    *
    * Add the local field group, with its layouts, to ACF
    *
    * @author Michael W. Delaney
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/

    //Create local field group with all enabled layouts.
    acf_add_local_field_group($args);

endif;