<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Year_of_Small_Business
 */

get_header();

	?><div id="primary" class="content-area">
		<main id="main" role="main"><?php

		/**
		 * The tha_content_while_before action hook
		 */
		do_action( 'tha_content_while_before' );

		while ( have_posts() ) : the_post();

			/**
			 * The tha_entry_before action hook
			 */
			do_action( 'tha_entry_before' );

			get_template_part( 'template-parts/content', get_post_format() );

			/**
			 * The tha_entry_after action hook
			 *
			 * @hooked 		comments 		10
			 */
			do_action( 'tha_entry_after' );

		endwhile; // End of the loop.

		/**
		 * The tha_content_while_after action hook
		 */
		do_action( 'tha_content_while_after' );

		?></main><!-- #main -->
	</div><!-- #primary --><?php

get_sidebar();
get_footer();