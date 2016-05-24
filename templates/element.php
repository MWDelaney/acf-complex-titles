<?php
if( have_rows('title') ): ?>

    <?php
    // loop through the rows of data
    while ( have_rows('title') ) : the_row(); ?>
        <span class="<?php ct_element_classes(); ?>">
            <?php the_sub_field('word_or_phrase'); ?>
        </span>

<?php
    endwhile;
endif;
?>