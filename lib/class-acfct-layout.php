<?php
    class CTLayout {

		private $layout;
		private $repeater;

		function __construct($repeater = null) {
			$this->repeater = $repeater;
			$this->key 		= 'acfct-';
			$this->key 	   .= (isset($repeater)) ? 'repeater-' . $repeater : null;
        	$this->key     .= 'layoutfield-';
		}



		/**
		 *
		 * Layout Field: Alignment
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
						'key' => $this->key . __FUNCTION__,
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
}