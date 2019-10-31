<?php
/**
 * Template Name: Full Width Page
 *
 * This is the template that displays special collections filter
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Digital Scholarship
 */
?>


<div class="section">
	<div class="container">
		<div class="row">

			<div class="column sm-12">
				<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
				?>
			</div>
			
		</div>
	</div>
</div>


