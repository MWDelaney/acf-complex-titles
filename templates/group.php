<?php if( have_rows('build_title') ): ?>
    <span class="complex-title">
        <?php
            while ( have_rows('build_title') ) : the_row(); ?>
                <?php
                    $class_basename = 'complex-title-group';
                    $classes = $class_basename;
                    $classes .= (get_sub_field('alignment'))        ? ' ' . $class_basename . '-alignment-' . get_sub_field('alignment')   : '';
                ?>
                <span class="<?=$classes?>">
                    <?php ct_template('element', get_post_type()); ?>    
                </span>

        <?php endwhile; ?>
    </span>
<?php endif; ?>