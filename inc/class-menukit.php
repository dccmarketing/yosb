<?php

/**
 * A class of helpful menu-related functions
 *
 * @package Year_of_Small_Business
 * @author Slushman <chris@slushman.com>
 */
class yosb_Menukit {

	/**
	 * Constructor
	 */
	public function __construct() {} // __construct()

	/**
	 * Adds the Menu Item Title as a class on the menu item
	 *
	 * @param 	object 		$menu_item 			A menu item object
	 */
	public function add_menu_title_as_class( $menu_item ) {

		$title = sanitize_title( $menu_item->title );

		if ( ! in_array( $title, $menu_item->classes ) ) {

			$menu_item->classes[] = $title;

		}

		return $menu_item;

	} // add_menu_title_as_class()

	/**
	 * Adds more allowed tags for WP menu containers.
	 *
	 * @param 		array 			$tags 			The current allowed tags
	 *
	 * @return 		array 							The modified allowed tags
	 */
	public function allow_section_tags_as_containers( $tags ) {

		$tags[] = 'section';

		return $tags;

	} // allow_section_tags_as_containers()

	/**
	 * Adds an Dashicon icon before the menu item text
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function dashicon_before_menu_item( $item_output, $item, $depth, $args ) {

		if ( 'footer' !== $args->theme_location ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$class 	= $item->classes[0];

		if ( empty( $class ) ) { return $item_output; }

		$output = '';

		$output .= '<a href="' . $item->url . '" class="icon-menu" ' . $atts . '>';
		$output .= '<span class="dashicons dashicons-' . $class . '"></span>';
		$output .= '<span class="menu-label">';
		$output .= $item->title;
		$output .= '</span>';
		$output .= '</a>';

		return $output;

	} // dashicon_before_menu_item()

	/**
	 * Adds a Dashicon after the menu item text
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function dashicon_after_menu_item( $item_output, $item, $depth, $args ) {

		if ( '' !== $args->theme_location || '' !== $args->theme_location ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$class 	= $item->classes[0];

		if ( empty( $class ) ) { return $item_output; }

		$output = '';

		$output .= '<a href="' . $item->url . '" class="icon-menu" ' . $atts . '>';
		$output .= '<span class="menu-label">';
		$output .= $item->title;
		$output .= '</span>';
		$output .= '<span class="dashicons dashicons-' . $class . '"></span>';
		$output .= '</a>';

		return $output;

	} // dashicon_after_menu_item()

	/**
	 * Replaces menu item text with an Dashicon
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function dashicon_only_menu_item( $item_output, $item, $depth, $args ) {

		if ( '' !== $args->theme_location ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$class 	= $item->classes[0];

		if ( empty( $class ) ) { return $item_output; }

		$output = '';

		$output .= '<a href="' . $item->url . '" class="icon-menu" ' . $atts . '>';
		$output .= '<span class="screen-reader-text">' . $item->title . '</span>';
		$output .= '<span class="dashicons dashicons-' . $class . '"></span>';
		$output .= '</a>';

		return $output;

	} // dashicon_only_menu_item()

	/**
	 * Add Down Caret to Menus with Children
	 *
	 * @global 		 			$yosb_themekit 			Themekit class
	 *
	 * @param 		string 		$item_output		//
	 * @param 		object 		$item				//
	 * @param 		int 		$depth 				//
	 * @param 		array 		$args 				//
	 *
	 * @return 		string 							modified menu
	 */
	public function menu_caret( $item_output, $item, $depth, $args ) {

		if ( ! in_array( 'menu-item-has-children', $item->classes ) ) { return $item_output; }

		global $yosb_themekit;

		$atts 	= $this->get_attributes( $item );
		$output = '';

		$output .= '<a href="' . $item->url . '">';
		$output .= $item->title;
		$output .= '<span class="children">' . $yosb_themekit->get_svg( 'caret-down' ) . '</span>';
		$output .= '</a>';

		return $output;

	} // menu_caret()

	/**
	 * Add Plus ("+") expander to menus with children
	 *
	 * @param 		string 		$item_output		//
	 * @param 		object 		$item				//
	 * @param 		int 		$depth 				//
	 * @param 		array 		$args 				//
	 *
	 * @return 		string 							modified menu
	 */
	public function menu_show_hide( $item_output, $item, $depth, $args ) {

		if ( 'primary' !== $args->theme_location ) { return $item_output; }
		if ( ! in_array( 'menu-item-has-children', $item->classes ) ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$output = '';

		$output .= '<a href="' . $item->url . '">';
		$output .= $item->title;
		$output .= '<span class="children"></span>';
		$output .= '</a>';
		$output .= '<span class="show-hide flex-center">+</span>';

		return $output;

	} // menu_show_hide()

	/**
	 * Adds an SVG icon before the menu item text
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function svg_before_menu_item( $item_output, $item, $depth, $args ) {

		if ( 'services' !== $args->theme_location && 'subheader' !== $args->theme_location ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$class 	= $this->get_svg_by_class( $item->classes );

		if ( empty( $class ) ) { return $item_output; }

		$output = '';

		$output .= '<a href="' . $item->url . '" class="icon-menu" ' . $atts . '>';
		$output .= $class;
		$output .= '<span class="menu-label">';
		$output .= $item->title;
		$output .= '</span>';
		$output .= '</a>';

		return $output;

	} // svg_before_menu_item()

	/**
	 * Adds an SVG icon after the menu item text
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function svg_after_menu_item( $item_output, $item, $depth, $args ) {

		if ( '' !== $args->theme_location || 'subheader' !== $args->theme_location ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$class 	= $this->get_svg_by_class( $item->classes );

		if ( empty( $class ) ) { return $item_output; }

		$output = '';

		$output .= '<a href="' . $item->url . '" class="icon-menu" ' . $atts . '>';
		$output .= '<span class="menu-label">';
		$output .= $item->title;
		$output .= '</span>';
		$output .= $class;
		$output .= '</a>';

		return $output;

	} // svg_after_menu_item()

	/**
	 * Replaces menu item text with an SVG icon
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function svg_only_menu_item( $item_output, $item, $depth, $args ) {

		if ( 'social' !== $args->theme_location ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$class 	= $this->get_svg_by_class( $item->classes );

		if ( empty( $class ) ) { return $item_output; }

		$output = '';

		$output .= '<a aria-label="' . $item->title . '" href="' . $item->url . '" class="icon-menu" ' . $atts . '>';
		$output .= '<span class="screen-reader-text">' . $item->title . '</span>';
		$output .= $class;
		$output .= '</a>';

		return $output;

	} // svg_only_menu_item()

	/**
	 * Returns a string of HTML attributes for the menu item
	 *
	 * @param 	object 		$item 			The menu item object
	 * @return 	string 						A string of attributes
	 */
	public function get_attributes( $item ) {

		if ( empty( $item ) ) { return; }

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$attributes = '';

		foreach ( $atts as $attr => $value ) {

			if ( ! empty( $value ) ) {

				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';

			}

		}

		return $attributes;

	} // get_attributes()

	/**
	 * Gets the appropriate SVG based on a menu item class
	 *
	 * @global 		 			$yosb_themekit 			Themekit class
	 * @param 		array 		$classes 					Array of classes to check
	 * @param 		string 		$link 						Optional to add to the SVG
	 * @return 		mixed 									SVG icon
	 */
	public function get_svg_by_class( $classes ) {

		global $yosb_themekit;

		$output = '';

		foreach ( $classes as $class ) {

			$check = $yosb_themekit->get_svg( $class );

			if ( ! is_null( $check ) ) { $output .= $check; break; }

		} // foreach

		return $output;

	} // get_svg_by_class()

	/**
	 * Returns a WordPress menu for a shortcode
	 *
	 * @param 	array 		$atts 			Shortcode attributes
	 * @param 	mixed 		$content 		The page content
	 * @return 	mixed 						A WordPress menu
	 */
	public function list_menu( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'menu'            => '',
			'container'       => 'div',
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'depth'           => 0,
			'walker'          => '',
			'theme_location'  => ''),
			$atts )
		);

		return wp_nav_menu( array(
			'menu'            => $menu,
			'container'       => $container,
			'container_class' => $container_class,
			'container_id'    => $container_id,
			'menu_class'      => $menu_class,
			'menu_id'         => $menu_id,
			'echo'            => false,
			'fallback_cb'     => $fallback_cb,
			'before'          => $before,
			'after'           => $after,
			'link_before'     => $link_before,
			'link_after'      => $link_after,
			'depth'           => $depth,
			'walker'          => $walker,
			'theme_location'  => $theme_location )
		);

	} // list_menu()

	/**
	 * Replaces only the search menu item with an icon
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function search_icon_only( $item_output, $item, $depth, $args ) {

		if ( '' !== $args->theme_location ) { return $item_output; }
		if ( 'Search' !== $item->post_title ) { return $item_output; }

		//showme( $item );

		$atts 	= $this->get_attributes( $item );
		$output = '';
		$output .= '<a class="btn-search dashicons dashicons-search" ' . $atts . '>';
		$output .= '<span class="screen-reader-text">' . $item->title . '</span>';
		$output .= '</a>';

		return $output;

	} // icons_only_menu_item()

} // class
