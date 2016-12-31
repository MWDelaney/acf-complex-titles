
<span class="<?=$context->classes?>">
	<?php if( have_rows('title') ): ?>
	<?php while ( have_rows('title') ) : the_row(); ?>
		<?php \MWD\ComplexTitles\template( 'element', get_post_type() ); ?>
	<?php endwhile; endif;?>
</span>
