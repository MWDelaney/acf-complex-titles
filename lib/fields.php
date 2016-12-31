<?php

namespace MWD\ComplexTitles;

	class Fields {


		/**
		 * Field: Word or Phrase
		 *
		 * @author Michael W. Delaney
		 * @since 1.0
		 *
		 * Text
		 */
		public $word_or_phrase = array (
			'order' => '0',
			'field' => array (
				'key' => 'acfct_word_or_phrase',
				'label' => 'Word or Phrase',
				'name' => 'word_or_phrase',
				'type' => 'text',
			)
		);



		/**
		 * Field: Alignment
		 *
		 * @author Michael W. Delaney
		 * @since 1.0
		 *
		 * Select
		 */
		public $alignment = array (
			'order' => '50',
			'field' => array (
				'key' => 'acfct_alignment',
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



		/**
		 * Field: Emphasize
		 *
		 * @author Michael W. Delaney
		 * @since 1.0
		 *
		 * Checkbox
		 */
		public $emphasize = array (
			'order' => '10',
			'field' => array (
				'key' => 'acfct_emphasize',
				'label' => 'Emphasize',
				'name' => 'emphasize',
				'type' => 'true_false',
			)
		);



		/**
		 * Field: Size
		 *
		 * @author Michael W. Delaney
		 * @since 1.0
		 *
		 * Select
		 */
		public $size = array (
			'order' => '30',
			'field' => array (
				'key' => 'acfct_size',
				'label' => 'Size',
				'name' => 'size',
				'type' => 'select',
				'choices' => array (
					'md' => 'Medium',
					'sm' => 'Small',
					'lg' => 'Large',
				)
			)
		);

}
