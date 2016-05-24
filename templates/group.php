<?php if( have_rows('build_title') ): ?>
    <span class="complex-title">
        <?php
            while ( have_rows('build_title') ) : the_row(); ?>
                <span class="<?php ct_group_classes(); ?>">
                    <?php ct_template('element', get_post_type()); ?>    
                </span>

        <?php endwhile; ?>
    </span>
<?php endif; ?>