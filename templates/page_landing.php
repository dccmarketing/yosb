<?php
/**
 * Template Name: Landing Page
 *
 * Description: A full-width template with no sidebar
 *
 * @package Year_of_Small_Business
 */

$meta = get_post_custom( get_the_ID() );

get_header();

	?><div id="primary" class="content-area full-width">
		<main id="main" role="main"><?php

		/**
		 * The yosb_page_content action hook
		 *
		 * @hooked 		headline 		15
		 * @hooked 		get_menu_side 	20
		 */
		do_action( 'yosb_page_content', get_the_ID(), $meta );

		?></main><!-- #main -->
	</div><!-- #primary --><?php

get_footer();