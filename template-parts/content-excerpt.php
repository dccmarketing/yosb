<?php
/**
 * Template part for displaying post excerpts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Year_of_Small_Business
 */

?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php

	do_action( 'tha_entry_top' );

	?><header class="entry-header justcontent"><?php

		/**
		 * @hooked 		title_entry 		10
		 * @hooked 		posted_on 			20
		 */
		do_action( 'entry_header_content' );

	?></header><!-- .entry-header --><?php

	do_action( 'tha_entry_content_before' );

	?><div class="entry-content"><?php

			the_excerpt();

	?></div><!-- .entry-content --><?php

	do_action( 'tha_entry_content_after' );

	?><footer class="entry-footer"><?php

		yosb_entry_footer();

	?></footer><!-- .entry-footer --><?php

	do_action( 'tha_entry_bottom' );

?></article><!-- #post-## -->