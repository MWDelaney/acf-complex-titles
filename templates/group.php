
<span class="<?=$context->classes?>">
	<?php if( have_rows('title') ): ?>
	<?php while ( have_rows('title') ) : the_row(); ?>
		<?php
			do_action('acf-complex-titles-before-element');
			$context->template->get_template_part( 'element', get_post_type() );
			do_action('acf-complex-titles-before-element');

		?>
	<?php endwhile; endif;?>
</span>
