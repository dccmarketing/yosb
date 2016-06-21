<?php
/**
 * TCB Landing Pages functions and definitions
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Year_of_Small_Business
 */

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Load Slushman Themekit
 */
require get_template_directory() . '/inc/themekit.php';

/**
 * Load Main Menu Walker
 */
require get_template_directory() . '/inc/main-menu-walker.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/control.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
call_user_func( array( new yosb_Control(), 'run' ) );
