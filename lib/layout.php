<?php

namespace MWD\ComplexTitles;

    class Layout {

		/**
		 *
		 * Layout Field: Alignment
		 *
		 * @author Michael W. Delaney
		 * @since 1.0
		 *
		 * Select
		 */
		public $alignment = array (
			'order' => '50',
			'field' => array (
				'key' => 'acfct_layout_alignment',
				'label' => 'Alignment',
				'name' => 'alignment',
				'type' => 'select',
				'choices' => array (
					'none' => 'None',
					'left' => 'Left',
					'right' => 'Right',
					'center' => 'Center',
				),
			)
		);
}
