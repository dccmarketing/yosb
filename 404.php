<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Pagex
 *
 * @package Year_of_Small_Business
 */

get_header();

	?><div id="primary" class="content-area">
		<main id="main" role="main">
			<section class="error-404 not-found"><?php

				/**
				 * The yosb_404_content action hook
				 *
				 * @hooked 		title_404 		10
				 */
				do_action( 'yosb_404_before' );

				?><div class="page-content"><?php

					/**
					 * The yosb_404_content action hook
					 *
					 * @hooked 		add_search 					10
					 * @hooked 		four_04_posts_widget 		15
					 * @hooked 		four_04_categories 			20
					 * @hooked 		four_04_archives 			25
					 * @hooked 		four_04_tag_cloud 			30
					 */
					do_action( 'yosb_404_content' );

				?></div><!-- .page-content --><?php

				/**
				 * The yosb_404_after action hook
				 */
				do_action( 'yosb_404_after' );

			?></section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary --><?php

get_footer();