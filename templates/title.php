
<?php if( have_rows('build_title', $context->id) ): ?>
  <span class="complex-title">
    <?php while ( have_rows('build_title', $context->id) ) : the_row(); ?>
      <?php
        do_action('acf-complex-titles-before-group', $context->id);
        $context->template->get_template_part( 'group', get_post_type() );
        do_action('acf-complex-titles-after-group', $context->id);
      ?>
    <?php endwhile; ?>
  </span>
<?php endif; ?>
