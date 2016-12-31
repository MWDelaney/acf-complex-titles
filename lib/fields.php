<?php

namespace MWD\ACF\ComplexTitles;

  class Fields {

		private $layout;
		private $repeater;

		function __construct($repeater = null) {
			$this->repeater = $repeater;
			$this->key 		= 'acfct-';
			$this->key 	   .= (isset($repeater)) ? '-repeater-' . $repeater : null;
			$this->key     .= '-field-';
		}


		/**
		 * Field: Word or Phrase
		 *
		 * @author Michael W. Delaney
		 * @since 1.0
		 *
		 * Text
		 */
		function word_or_phrase() {
			return(
			    array ( 'order' => '0',
			        'field' => array (
			            'key' => 'field_5673331424dd6',
			            'label' => 'Word or Phrase',
			            'name' => 'word_or_phrase',
			            'type' => 'text',
			            'instructions' => '',
			            'required' => 0,
			            'conditional_logic' => 0,
			            'wrapper' => array (
			                'width' => '',
			                'class' => '',
			                'id' => '',
			            ),
			            'default_value' => '',
			            'placeholder' => '',
			            'prepend' => '',
			            'append' => '',
			            'maxlength' => '',
			            'readonly' => 0,
			            'disabled' => 0,
			        )
			    )
			);
		}



		/**
		 * Field: Alignment
		 *
		 * @author Michael W. Delaney
		 * @since 1.0
		 *
		 * Select
		 */
		function alignment() {
			return(
			    array ( 'order' => '50',
			        'field' => array (
			            'key' => 'field_56f056b90e0a7',
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
			        )
			    )
			);
		}



		/**
		 * Field: Emphasize
		 *
		 * @author Michael W. Delaney
		 * @since 1.0
		 *
		 * Checkbox
		 */
		function emphasize() {
			return(
			    array ( 'order' => '10',
			        'field' => array (
			            'key' => 'field_5673332224dd7',
			            'label' => 'Emphasize',
			            'name' => 'emphasize',
			            'type' => 'true_false',
			            'instructions' => '',
			            'required' => 0,
			            'conditional_logic' => 0,
			            'wrapper' => array (
			                'width' => '',
			                'class' => '',
			                'id' => '',
			            ),
			            'message' => '',
			            'default_value' => 0,
			        )
			    )
			);
		}



		/**
		 * Field: Size
		 *
		 * @author Michael W. Delaney
		 * @since 1.0
		 *
		 * Select
		 */
		function size() {
			return(
			    array ( 'order' => '30',
			        'field' => array (
			            'key' => 'field_56f143ff070bc',
			            'label' => 'Size',
			            'name' => 'size',
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
			                'md' => 'Medium',
			                'sm' => 'Small',
			                'lg' => 'Large',
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
			        )
			     )
			);
		}

	}
