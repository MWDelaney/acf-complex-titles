/**
 * ---- Advanced Custom Fields Complex Titles ----
 *
 * Create complex, custom styled headlines with per-word or per-phrase styling
 * This code assumes you're using Roots/Sage as your starter theme.
 *
 *  Documentation:
 *  This script assumes you have the following ACF fields set up in the following heierarchy:
 *  -- Title Groups (Repeater field)
 *  -- -- Headline Elements (Repeater field)
 *  -- -- -- Word or Phrase (Text field)
 *  -- -- -- [Additional fields per style you wish to apply to the headline element]
*/

/**
 * Get the closest matching descendents of an element
 * @return object
 */
(function($) {
    $.fn.closest_descendents = function(filter) {
        var $found = $(),
            $currentSet = this.children(); // Current place
        while ($currentSet.length) {
            $found = $currentSet.filter(filter);
            if ($found.length) { break; }  // At least one match: break loop
            // Get all children of the current set
            $currentSet = $currentSet.children();
        }
        return $found; // Return first match of the collection
    };
})(jQuery);


jQuery(document).ready(function($) {

    /**
     * Script configuration
     */

            // Configure the ACF field names you used when setting up fields
            var groups              = "build_title";            // Field id of the groups repeater field
            var groups_layout       = "acfct-layoutfield-alignment";    // Groups layout options must be in an ACF tab. Field id of the layout tab.
            var repeater            = "title";                  // Field id of the repeater field containing headline elements
            var layout              = "title_layout";           // Field id layout select field for the overall headline style
            var word                = "word_or_phrase";         // Field id containing the word to be styled in the preview area
            var draggable           = false;                    // Should elements be draggable, and thus positioned absolutely?

            // Configure HTML to be used in the preview area (this should marginally match the HTML used on the front-end)
            var header_tag                  = "h1";
            var layout_tag                  = "header";
            var layout_class                = "complex-title";
            var preview_area_placeholder    = ".acf-field-acfct-placeholder";   // Class or ID of ACF "Message" field placeholder to be replaced with preview area.
            var preview_area                = "div";
            var preview_area_class          = "acf-complex-titles-preview-area";

            var layout_basename         = "complex-title-layout complex-layout-";

            var group_basename          = "complex-title-group";
            var group_class             = group_basename;

            var class_basename          = "complex-title-element";
            var element_class           = class_basename;

            // Dont change anything below this line
            var preview_element_path    = '.' + preview_area_class + ' ' + header_tag;
            var fields_to_watch         = 'input, select, input[type=checkbox], input[type=radio]';



    /**
     * Update layout classes
     */
    function updateLayout( theClass ) {
        // Remove all the front-end classes so we can re-apply them all correctly
        $('.' + preview_area_class + ' ' + layout_tag).removeClass().addClass( layout_class + ' ' + layout_basename + theClass );
    }



    /**
     * Function to update elements in the preview area when the appropriate title field is changed
     */
    function updateElement(group, $el) {
        $el.each( function() {
            var index       = $el.index();
            var element     = $( preview_element_path + ' [data-group=' + group + ']' + ' span[data-index=' + index + ']');
            var text        = ' ' + $(this).find('[data-name=' + word + ']').find('input').val();

            // Remove all the front-end classes so we can re-apply them all correctly
            $(element).attr('class',
               function(i, c){
                  return c.replace(/(^|\s)complex-title-\S+/g, '');
               });

            // Update the actual text
            $(element).html(text);

            $(this).find(fields_to_watch).each( function() {
                var thisclass       = '';
                var thisvalue       = '';
                var thisstyle       = '';

                if($(this).closest('.acf-field').data('type') === 'true_false') {
                    if($(this).is(':checked')) {
                        thisclass       = $(this).closest('.acf-field').data('name');
                    }
                }
                else if($(this).closest('.acf-field').data('type') === 'select') {
                    thisclass           = $(this).closest('.acf-field').data('name') + '-' + $(this).val();
                }
                else if($(this).closest('.acf-field').data('type') === 'input') {
                    thisvalue           = $(this).closest('.acf-field').data('name');
                    thisstyle           = $(this).val();
                }
                else if($(this).closest('.acf-field').data('type') === 'color_picker') {
                    thisstyle             = $(this).closest('.acf-field').data('name');
                    thisvalue             = $(this).val();
                    if( !thisvalue ) {
                        thisvalue = '';
                    }

                }

                // Apply style or class
                $(element).addClass(class_basename);
                if( thisclass !== word && thisclass.length > 0 ) {
                    //console.log(thisclass);
                    $(element).addClass(class_basename + '-' + thisclass);
                }
                if( thisstyle !== '' ) {
                    $(element).css(thisstyle, thisvalue);
                }
            });
        });
    }



    /**
     * Function to update groups in the preview area when the appropriate title field is changed
     */
    function updateGroup($el) {
        $el.each( function() {
            var index       = $el.index();
            var element     = $( preview_element_path + ' [data-group=' + index + ']');

            // Remove all the front-end classes so we can re-apply them all correctly
            $(element).attr('class',
               function(i, c){
                  return c.replace(/(^|\s)complex-title-\S+/g, '');
               });

            $(this).find('[data-key=' + groups_layout + ']').find(fields_to_watch).each( function() {
                var thisclass       = '';
                var thisvalue       = '';
                var thisstyle       = '';

                if($(this).closest('.acf-field').data('type') === 'true_false') {
                    if($(this).is(':checked')) {
                        thisclass       = $(this).closest('.acf-field').data('name');
                    }
                }
                else if($(this).closest('.acf-field').data('type') === 'select') {
                    thisclass           = $(this).closest('.acf-field').data('name') + '-' + $(this).val();
                }
                else if($(this).closest('.acf-field').data('type') === 'input') {
                    thisvalue           = $(this).closest('.acf-field').data('name');
                    thisstyle           = $(this).val();
                }
                else if($(this).closest('.acf-field').data('type') === 'color_picker') {
                    thisstyle             = $(this).closest('.acf-field').data('name');
                    thisvalue             = $(this).val();
                    if( !thisvalue ) {
                        thisvalue = '';
                    }

                }

                // Apply style or class
                $(element).addClass(group_basename);
                if( thisclass !== word && thisclass.length > 0 ) {
                    //console.log(thisclass);
                    $(element).addClass(group_basename + '-' + thisclass);
                }
                if( thisstyle !== '' ) {
                    $(element).css(thisstyle, thisvalue);
                }
            });
        });
    }



    /**
     * Function to append headline preview
     */
    function appendPreview( $el ) {
        if(! $el.closest('.acf-clone').length ) {
            $el.find('.' + preview_area_class).remove();
            $el.prepend( '<' + preview_area + ' class="' + preview_area_class + '"><' + layout_tag + ' class="' + layout_class + '"><' + header_tag + '></' + header_tag + '></' + layout_tag + '></' + preview_area + '>' );
            $el.find('.acf-label, .acf-input').hide();
            updateLayout( $el.closest('.acf-fields').find('[data-name="' + layout + '"] select').val() );
        }
    }



    /**
     * Function to add elements to the preview area
     */
    function appendElements( group, $el, skipIndex ) {
        index           = parseInt($el.index());
        skipIndex       = parseInt(skipIndex);
        if(index >= 0) {
            // console.log(group);
            // Remove the element if it already exists
            $( preview_element_path + ' [data-group=' + group + ']' + ' [data-index=' + index + ']').remove();
            //Check whether we just removed this element from the repeating field. If we did, then adjust the element index
            if(index !== skipIndex) {
                if(index >= skipIndex) {
                    index = index-1;
                }
                // Then create the element in the preview area
                var element_number          = index;
                var classes                 = element_class + " " + element_class + "-" + element_number;
                //console.log(classes);
                // Add all elements with their current settings.
                $el.each( function() {
                    $( preview_element_path + ' [data-group=' + group + ']').append('<span data-index="' + index + '" class="' + classes + '"></span>');
                    updateElement(group, $(this));
                });

            }
        }
    }


    /**
     * Function to add groups in the preview area
     */
    function appendGroups( $el, skipIndex ) {
        index           = parseInt($el.index());
        skipIndex       = parseInt(skipIndex);
        if(index >= 0) {
            // Remove the element if it already exists
            $( preview_element_path + ' [data-group=' + index + ']').remove();

            //Check whether we just removed this element from the repeating field. If we did, then adjust the element index
            if(index !== skipIndex) {
                if(index >= skipIndex) {
                    index = index-1;
                }
                // Then create the element in the preview area
                var group_number            = index;
                var classes                 = group_basename;
                //console.log(classes);
                // Add all elements with their current settings.
                $el.each( function() {
                    $( preview_element_path ).append('<span data-group="' + index + '" class="' + classes + '"></span>');
                    updateGroup($el);
                    $(this).find('[data-name="' + repeater + '"]').each( function() {
                        $(this).find('.acf-row').each( function( index ) {
                            if(!$(this).hasClass('acf-clone')) {
                                appendElements( group_number, $(this) );
                            }
                        });
                    });
                });
            }
        }
    }



    /**
     * Watch for changes to ACF fields fields in repeaters and update the the preview area
     */
    function watchElements() {
        $('[data-name="' + repeater + '"]').on( 'input change', fields_to_watch, function() {
            updateElement( $(this).parents('.acf-row').last().index(), $(this).closest('.acf-row') );
        });
    }

    function watchGroups() {
        $('[data-key="' + groups_layout + '"]').on( 'input change', fields_to_watch, function() {
            updateGroup( $(this).parents('.acf-row').last() );
        });
    }



    /**
     * Watch for changes to the layout fields and update the the preview area
     */
    function watchLayout() {
        $('[data-name="' + layout + '"]').on( 'change', fields_to_watch, function() {
            updateLayout( $(this).val() );
        });
    }



    /**
     * Initialize title groups in preview area
     */
    function groupsInit() {
        $('[data-name="' + groups + '"]').each( function() {
            $(this).closest_descendents('.acf-row').each( function() {
                if(!$(this).hasClass('acf-clone')) {
                    appendGroups( $(this) );
                }
            });
        });
    }

    /**
     * Initialize title elements in preview area
     */
    function headlinesInit() {
        $(preview_area_placeholder).each( function() {
            appendPreview($(this));
        });
        groupsInit();
        watchElements();
        watchGroups();
        watchLayout();
    }

    /**
     * Initialize all groups and elements when the page loads
     */
    headlinesInit();



    /**
     * Update all elements and groups
     */
    function updateAllElements() {
        groupsInit();
    }



    /**
     * Function to remove an element from the preview area when the ACF repeater row is removed
     */
    function removeElements(group, $el) {
        skipIndex = $el.index();
        if(skipIndex >= 0) {
            appendElements( group, $el, skipIndex );
            setTimeout(updateAllElements, 1000);
        }
    }

    /**
     * Function to remove a group from the preview area when the ACF repeater row is removed
     */
    function removeGroups($el) {
        skipIndex = $el.index();
        if(skipIndex >= 0) {
            appendGroups( $el, skipIndex );
        }
    }



    /**
     * Listen for the creation of new repeater rows and create new elements in
     * preview area when new rows are added
     */
    if(typeof acf !== 'undefined') {
        acf.add_action('append', function( $el ){
            headlinesInit();
        });
    }



    /**
     * Listen for drag-and-drop events and re-initialize the preview when one
     * occurs.
     */
    if(typeof acf !== 'undefined') {
        acf.add_action('sortstop', function( $el ){
            headlinesInit();
        });
    }


    /**
     * Listen for rows being removed, remove and re-index preview area elements accordingly
     */
    if(typeof acf !== 'undefined') {
        acf.add_action('remove', function( $el ){
            console.log($el);
            var group   = $el.parents('.acf-row').last().index();
            if ( $el.parents('.acf-field-repeater').data('name') == groups) {
                removeGroups($el)
            } else {
                removeElements(group, $el);
            }
        });
    }

});
