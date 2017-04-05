
<?php if( have_rows('build_title') ): ?>
	<span class="complex-title">
		<?php while ( have_rows('build_title') ) : the_row(); ?>
			<?php
				do_action('acf-complex-titles-before-group');
				$context->template->get_template_part( 'group', get_post_type() );
				do_action('acf-complex-titles-after-group');
			?>
		<?php endwhile; ?>
	</span>
<?php endif; ?>
