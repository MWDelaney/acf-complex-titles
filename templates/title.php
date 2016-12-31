<?php if( have_rows('build_title') ): ?>
	<span class="complex-title">
		<?php while ( have_rows('build_title') ) : the_row(); ?>
			<?php \MWD\ComplexTitles\template( 'group', get_post_type() ); ?>
		<?php endwhile; ?>
	</span>
<?php endif; ?>
