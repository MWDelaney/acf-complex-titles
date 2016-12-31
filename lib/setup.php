<?php

namespace MWD\ComplexTitles;

class Setup {

	/**
	 * Variable holding the ACF fields definition to be automatically created
	 */
	private static $args = array (
			'key' => 'acf_complex_titles',
			'title' => 'Complex Titles',
			'fields' => array (
					array (
							'key' => 'acfct_placeholder',
							'label' => 'Preview Placeholder',
							'type' => 'message',
					),
					array (
							'key' => 'acfct_build_title',
							'label' => 'Build Title',
							'name' => 'build_title',
							'type' => 'repeater',
							'layout' => 'block',
							'button_label' => 'Add Group',
							'sub_fields' => array (
									array (
											'key' => 'acfct_tab_title',
											'label' => 'Title',
											'type' => 'tab',
									),
									array (
											'key' => 'acfct_title_group',
											'label' => 'Title Group',
											'name' => 'title',
											'type' => 'repeater',
											'layout' => 'table',
											'button_label' => 'Add Word',
											'sub_fields' => array (),
									),
									array (
											'key' => 'acfct_tab_layout',
											'label' => 'Layout',
											'type' => 'tab',
									),
							),
					),
			),
		'location' => array (),
			'menu_order' => 0,
			'position' => 'acf_after_title',
	);


	public static function create_titles() {
		if( function_exists('acf_add_local_field_group') ):

		/**
		* Check for declared post types to attach fields to
		*
		* @author Michael W. Delaney
		* @since 1.0
		*
		* Default: post_type == page
		*
		* Declare theme support for specific post types:
		* $landing_page_templates = array(
		* 	array (
		* 		array (
		* 			'param' => 'post_type',
		* 			'operator' => '==',
		* 			'value' => 'page',
		* 		),
		* 		array (
		* 			'param' => 'page_template',
		* 			'operator' => '!=',
		* 			'value' => 'template-no-header-image.php',
		* 		),
		*	),
		* );
		* add_theme_support( 'complex-titles-location', $landing_page_templates );
		*/

		//Check if theme support is explicitly defined. If so, enable all attachments declared in theme support.
		if( current_theme_supports( 'complex-titles-location' ) ) {
				$locations_supported    = get_theme_support( 'complex-titles-location' );
				$locations_enabled      = $locations_supported[0];

		} else {
				// If theme support is not explicitly defined, enable default attachments.
				$locations_enabled = array(
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'page',
						)
					)
				);
		}
		// Insert each location into the $args array
		self::$args['location'] = $locations_enabled;


		/**
		* Include all enabled layout fields
		*
		* @author Michael W. Delaney
		* @since 1.0
		*
		* Declare theme support for specific layout fields. Default is to include all layout fields:
		*   add_theme_support( 'complex-titles-layout', array( 'alignment' ) );
		*
		* Pass an empty array to disable alignment fields altogether:
		*   add_theme_support( 'complex-titles-layout', array() );
		*/
		$layout_class = null;
		$layout_class = apply_filters('acfct_set_layout_class', $layout_class);

		//Check if theme support is explicitly defined. If so, only enable layouts declared in theme support.
		if( current_theme_supports( 'complex-titles-layout' ) ) {
				$layout_fields_supported = get_theme_support( 'complex-titles-layout' );
				$layout_fields_enabled = $layout_fields_supported[0];
		} else {
				// If theme support is not explicitly defined, enable all fields as a fallback.
				$layout_fields_enabled = array();
				foreach(get_class_vars($layout_class) as $name => $value) {
					$layout_fields_enabled[] = $name;
				}
		}
		// Enable each layout field
		// If no layout fields are enabled, remove the tabs to avoid clutter
		if( count( $layout_fields_enabled ) <= 0 ) {
				unset(self::$args['fields'][1]['sub_fields'][2]);
				unset(self::$args['fields'][1]['sub_fields'][0]);
		} else {

				// Enable each layout field
				$CTLayouts      = new $layout_class;
				$layout_fields_array  = array();
				foreach ($layout_fields_enabled as $name) {
					$layout_fields_array[] = $CTLayouts->$name;
				}
				// Sort layout fields by the 'order' element
				usort($layout_fields_array, function ($a, $b) {
						if ($a['order'] == $b['order']) return 0;
						return $a['order'] < $b['order'] ? -1 : 1;
				});
				// Insert each layout field into the $args array
				foreach ( $layout_fields_array as $layout_field) {
						self::$args['fields'][1]['sub_fields'][] = $layout_field['field'];
				}
		}



		/**
		*
		* Include all enabled fields
		*
		* @author Michael W. Delaney
		* @since 1.0
		*
		* Declare theme support for specific fields. Default is to include all fields:
		*   add_theme_support( 'complex-titles-fields', array( 'emphasize', 'alignment' ) );
		*
		*/

		$fields_class = null;
		$fields_class = apply_filters('acfct_set_fields_class', $fields_class);

		//Check if theme support is explicitly defined. If so, only enable fields declared in theme support.
		if( current_theme_supports( 'complex-titles-fields' ) ) {
				$fields_supported = get_theme_support( 'complex-titles-fields' );
				$fields_enabled = $fields_supported[0];
		} else {
				// If theme support is not explicitly defined, enable all fields as a fallback.
				$fields_enabled = array();
				foreach(get_class_vars($fields_class) as $name => $value) {
					$fields_enabled[] = $name;
				}
		}

		// Enable each layout field

		$CTFields      = new $fields_class;
		$fields_array  = array();
		foreach ($fields_enabled as $name) {
				$fields_array[]	= $CTFields->$name;
		}
		// Sort layout fields by the 'order' element
		usort($fields_array, function ($a, $b) {
				if ($a['order'] == $b['order']) return 0;
				return $a['order'] < $b['order'] ? -1 : 1;
		});
		// Insert each layout field into the $args array
		foreach ( $fields_array as $field) {
				self::$args['fields'][1]['sub_fields'][1]['sub_fields'][] = $field['field'];
		}



		/**
		* Add the local field group, with its layouts, to ACF
		*
		* @author Michael W. Delaney
		* @since 1.0
		*
		*/

		acf_add_local_field_group(self::$args);

		endif;
	}

}
