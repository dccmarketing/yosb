<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Year_of_Small_Business
 */

?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php

	do_action( 'tha_entry_top' );

	?><header class="page-header contentsearch"><?php

		/**
		 * @hooked 		title_search 		10
		 * @hooked 		posted_on 			20
		 */
		do_action( 'entry_header_content' );

	?></header><!-- .entry-header --><?php

	do_action( 'tha_entry_content_before' );

	?><div class="entry-summary"><?php

		the_excerpt();

	?></div><!-- .entry-summary --><?php

	do_action( 'tha_entry_content_after' );

	?><footer class="entry-footer"><?php

		yosb_entry_footer();

	?></footer><!-- .entry-footer --><?php

	do_action( 'tha_entry_bottom' );

?></article><!-- #post-## -->