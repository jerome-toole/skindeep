<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>

		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->

		<?php edit_post_link( __( 'Edit'), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

	</article><!-- #post-## -->