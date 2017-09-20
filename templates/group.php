
<span class="<?=$context->classes?>">
  <?php if( have_rows('title', $context->id) ): ?>
  <?php while ( have_rows('title', $context->id) ) : the_row(); ?>
    <?php

      do_action('acf-complex-titles-before-element', $context->id);
      $context->template->get_template_part( 'element', get_post_type() );
      do_action('acf-complex-titles-before-element', $context->id);

    ?>
  <?php endwhile; endif;?>
</span>
