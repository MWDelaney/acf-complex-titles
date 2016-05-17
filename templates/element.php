<?php
if( have_rows('title') ): ?>

    <?php
    // loop through the rows of data
    while ( have_rows('title') ) : the_row(); ?>
        <?php
            $class_basename = 'complex-title-element';
            $classes = $class_basename;
            $classes .= (get_sub_field('alignment'))        ? ' ' . $class_basename . '-alignment-' . get_sub_field('alignment')   : '';
            $classes .= (get_sub_field('emphasize'))        ? ' ' . $class_basename . '-emphasize' : '';
            $classes .= (get_sub_field('size'))             ? ' ' . $class_basename . '-size-' . get_sub_field('size')   : '';
        ?>
        <span class="<?=$classes?>">
            <?php the_sub_field('word_or_phrase'); ?>
        </span>

<?php
    endwhile;
endif;
?>