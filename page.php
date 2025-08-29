<?php
/**
 * The template for displaying single page content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 */
get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/content/content', 'page' );

	// If comments are open or there is at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
endwhile;

get_footer();