<?php
/**
 * Template Name: Wide Headline
 *
 * Description: Landing page with wider headline area.
 *
 * @package TCB_Landing
 */

$meta = get_post_custom( get_the_ID() );

get_header();

	?><div id="primary" class="content-area full-width wide-head">
		<main id="main" role="main"><?php

		/**
		 * The tcb_landing_page_content action hook
		 *
		 * @hooked 		headline 		15
		 * @hooked 		get_menu_side 	20
		 */
		do_action( 'tcb_landing_page_content', get_the_ID(), $meta );

		?></main><!-- #main -->
	</div><!-- #primary --><?php

get_footer();