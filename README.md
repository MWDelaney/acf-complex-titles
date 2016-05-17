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

1. Emphasize
2. Size (small, medium, large)
3. Alignment (left, right, center)

### Change post type Complex Titles
By default content blocks are enabled for Pages, to define which post types blocks should be available on, declare theme support:

````
add_theme_support( 'complex-titles-location', array( 'page', 'post' ) );
````

## Templates
Basic templates and styles are included. These templates are designed to be simple for styling via your theme. To override the included templates, copy the template(s) you wish to override from `templates` to your theme in a sub-directory called `ct-templates`