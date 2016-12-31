# Advanced Custom Fields Complex Titles

A WordPress plugin that adds custom fields to create a formatted title

This plugin creates custom fields below the title Pages and automatically replaces `the_title()` when called from inside the loop.

![Screenshot](/../gh-pages/screenshot.png?raw=true "Advanced Custom Fields Complex Titles")

## Requirements

1. WordPress 4.5+
2. Advanced Custom Fields Pro 5

## Usage
The following formatting options are included at this time:

1. Word or Phrase (the actual content, don't remove this one)
1. Emphasize
2. Size (small, medium, large)
3. Alignment (left, right, center)

The following layouts are also included for headline groups:

1. Alignment

### Add fields
To add fields to the title(s), extend the Fields class as follows:
````{r, engine='php', count_lines}
	 add_filter ('acfct_set_fields_class',  function() { return 'myFields'; });

	 class myFields extends MWD\ACF\ComplexTitles\Fields {
		 /**
 		 * Field: Underline
 		 *
 		 * Checkbox
 		 */
 		public $underline = array (
 			'order' => '10',
 			'field' => array (
 				'key' => 'acfct_underline',
 				'label' => 'Underline',
 				'name' => 'underline',
 				'type' => 'true_false',
 			)
 		);
	 }
````

### Enable only some fields
To remove fields from the available list, declare theme support for only the fields you wish to use:
````{r, engine='php', count_lines}
add_theme_support( 'complex-titles-fields', array( 'word-or-phrase', 'size' ) );
````

### Enable only some layouts
To remove layouts from the available list, declare theme support for only the layouts you wish to use:
````{r, engine='php', count_lines}
add_theme_support( 'complex-titles-layout', array( 'alignment' ) );
````

### Change which post types get Complex Titles
By default complex titles are enabled for Pages, to define which post types complex titles should be available on, declare theme support:

````{r, engine='php', count_lines}
 $landing_page_templates = array(
   array (
     array (
       'param' => 'post_type',
       'operator' => '==',
       'value' => 'page',
     ),
     array (
       'param' => 'page_template',
       'operator' => '!=',
       'value' => 'template-no-header-image.php',
     ),
   ),
 );
 add_theme_support( 'complex-titles-location', $landing_page_templates );
````

## Templates
Basic templates and styles are included. These templates are designed to be simple for styling via your theme. To override the included templates, copy the template(s) you wish to override from `templates` to your theme in a sub-directory called `ct-templates`

## Styles
This plugin ships with basic styling for the default fields. These styles are enqueued on the front-end and in the WordPress admin so that the Complex Title preview area matches the front-end as closely as possible.
To dequeue these styles and replace them with your own, add the following to `functions.php`
````{r, engine='php', count_lines}
remove_action('wp_enqueue_style', array( $acf_complex_titles, 'front_end_styles' ) );
remove_action('admin_enqueue_scripts', array( $acf_complex_titles, 'admin_styles' ) );
````

