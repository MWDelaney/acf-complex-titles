<?php

namespace MWD\ComplexTitles;


/**
 * Template loader for ACF Flexible Content Blocks.
 *
 * Only need to specify class properties here.
 *
 */
class Templates extends \Gamajo_Template_Loader {

	/**
	 * Prefix for filter names.
	 *
	 * @since 1.0.0
	 * @type string
	 */
	protected $filter_prefix = 'acfct';

	/**
	 * Directory name where custom templates for this plugin should be found in the theme.
	 *
	 * @since 1.0.0
	 * @type string
	 */
	protected $theme_template_directory = 'templates/partials/complex-titles';

	/**
	 * Reference to the root directory path of this plugin.
	 *
	 * @since 1.0.0
	 * @type string
	 */
	protected $plugin_directory = ACFCT_PLUGIN_DIR;

}
