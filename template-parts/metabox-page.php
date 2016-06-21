<?php

/**
 * Displays a metabox
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    TCB_Landing
 */

wp_nonce_field( $this->theme_name, 'nonce_yosb_page' );

$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= '';
$atts['id'] 			= 'headline';
$atts['label'] 			= __( 'Headline', 'tcb-landing' );
$atts['name'] 			= 'headline';
$atts['placeholder'] 	= __( 'Enter the headline', 'tcb-landing' );
$atts['type'] 			= 'text';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( $this->theme_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( get_template_directory() . '/fields/field-text.php' );

?></p><?php



/*$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= '';
$atts['id'] 			= 'subheading';
$atts['label'] 			= __( 'Subheading', 'tcb-landing' );
$atts['name'] 			= 'subheading';
$atts['placeholder'] 	= __( 'Enter the subheading', 'tcb-landing' );
$atts['type'] 			= 'text';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts 			= apply_filters( $this->theme_name . '-field-' . $atts['id'], $atts );
$this->fields[] = array( $atts['name'], $atts['type'], $atts['label'] );

?><p><?php

include( get_template_directory() . '/fields/field-text.php' );

?></p><?php*/



$atts 					= array();
$atts['aria'] 			= esc_html__( 'Select main menu', 'tcb-landing' );
$atts['blank'] 			= esc_html__( 'Select main menu', 'tcb-landing' );
$atts['class'] 			= 'widefat';
$atts['description'] 	= 'Select the main menu to display on this page.';
$atts['id'] 			= 'main-menu';
$atts['label'] 			= 'Main Menu';
$atts['name'] 			= 'main-menu';
$atts['value'] 			= '';

$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

foreach ( $menus as $menu ) {

	$atts['selections'][] = array( 'value' => $menu->slug, 'label' => $menu->name );

}

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts 			= apply_filters( $this->theme_name . '-field-' . $atts['id'], $atts );
$this->fields[] = array( $atts['name'], 'select', $atts['label'] );

?><p><?php

include( get_template_directory() . '/fields/field-select.php' );

?></p><?php



$atts 					= array();
$atts['aria'] 			= esc_html__( 'Select side menu', 'tcb-landing' );
$atts['blank'] 			= esc_html__( 'Select side menu', 'tcb-landing' );
$atts['class'] 			= 'widefat';
$atts['description'] 	= 'Select the side menu to display on this page.';
$atts['id'] 			= 'side-menu';
$atts['label'] 			= 'Side Menu';
$atts['name'] 			= 'side-menu';
$atts['value'] 			= '';

$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

foreach ( $menus as $menu ) {

	$atts['selections'][] = array( 'value' => $menu->slug, 'label' => $menu->name );

}

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts 			= apply_filters( $this->theme_name . '-field-' . $atts['id'], $atts );
$this->fields[] = array( $atts['name'], 'select', $atts['label'] );

?><p><?php

include( get_template_directory() . '/fields/field-select.php' );

?></p>