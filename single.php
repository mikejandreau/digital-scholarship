<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Digital Scholarship
 */
?>

<?php
	while ( have_posts() ) : the_post();
	get_template_part( 'template-parts/content', get_post_type() );
	// the_post_navigation(); // default wp post nav
?>

<?php 
	/*
	* Custom post navigation (optional)
	*/

	echo '<div class="post-navigation"><div class="row">';
	$prevPost = get_previous_post(true);
	// $prevThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $prevPost->ID ), 'single-post-thumbnail' );
	if($prevPost) {
		$args = array(
			'posts_per_page' => 1,
			'include' => $prevPost->ID
		);
		$prevPost = get_posts($args);
		foreach ($prevPost as $post) {
			setup_postdata($post);
		?>
			<div class="sm-6 column">
				<h5>Previous Post:</h5>
				<a class="previous" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
		<?php
			wp_reset_postdata();
		} //end foreach
	} // end if

	$nextPost = get_next_post(true);
	$nextThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $nextPost->ID ), 'single-post-thumbnail' );
	if($nextPost) {
		$args = array(
			'posts_per_page' => 1,
			'include' => $nextPost->ID
		);
		$nextPost = get_posts($args);
		foreach ($nextPost as $post) {
			setup_postdata($post);
		?>
			<div class="sm-6 column">
				<h5>Next Post:</h5>
				<a class="next" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
		<?php
			wp_reset_postdata();
		} //end foreach
	} // end if
	echo '</div></div>';



	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	endwhile; // End of the loop.
?>
			