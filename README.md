# Advanced Custom Fields Complex Titles
**NOTE:** This plugin is very much a work in progress.

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

### Change post type Complex Titles
By default content blocks are enabled for Pages, to define which post types blocks should be available on, declare theme support:

````{r, engine='php', count_lines}
add_theme_support( 'complex-titles-location', array( array('post_type', '==', 'page'), array('post_type', '==', 'post') ) );
````

## Templates
Basic templates and styles are included. These templates are designed to be simple for styling via your theme. To override the included templates, copy the template(s) you wish to override from `templates` to your theme in a sub-directory called `ct-templates`
