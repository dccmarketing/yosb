<?php
/**
 * TCB Landing Pages Customizer
 *
 * Contains methods for customizing the theme customization screen.
 *
 * @link 		https://codex.wordpress.org/Theme_Customization_API
 * @since 		1.0.0
 * @package  	DocBlock
 */
class yosb_Customizer {

	/**
	 * Registers custom panels for the Customizer
	 *
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 *
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_panels( $wp_customize ) {

		// Theme Options Panel
		$wp_customize->add_panel( 'theme_options',
			array(
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( 'Options for TCB Landing Pages', 'yosb' ),
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Theme Options', 'yosb' ),
			)
		);

		/*
		// Theme Options Panel
		$wp_customize->add_panel( 'theme_options',
			array(
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( 'Options for TCB Landing Pages', 'yosb' ),
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Theme Options', 'yosb' ),
			)
		);
		*/

	} // register_panels()

	/**
	 * Registers custom sections for the Customizer
	 *
	 * Existing sections:
	 *
	 * Slug 				Priority 		Title
	 *
	 * title_tagline 		20 				Site Identity
	 * colors 				40				Colors
	 * header_image 		60				Header Image
	 * background_image 	80				Background Image
	 * nav 					100 			Navigation
	 * widgets 				110 			Widgets
	 * static_front_page 	120 			Static Front Page
	 * default 				160 			all others
	 *
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 *
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_sections( $wp_customize ) {

		/*
		// New Section
		$wp_customize->add_section( 'new_section',
			array(
				'capability' 	=> 'edit_theme_options',
				'description' 	=> esc_html__( 'New Customizer Section', 'yosb' ),
				'panel' 		=> 'theme_options',
				'priority' 		=> 10,
				'title' 		=> esc_html__( 'New Section', 'yosb' )
			)
		);
		*/

	} // register_sections()

	/**
	 * Registers controls/fields for the Customizer
	 *
	 * Note: To enable instant preview, we have to actually write a bit of custom
	 * javascript. See live_preview() for more.
	 *
	 * Note: To use active_callbacks, don't add these to the selecting control, it apepars these conflict:
	 * 		'transport' => 'postMessage'
	 * 		$wp_customize->get_setting( 'field_name' )->transport = 'postMessage';
	 *
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 *
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_fields( $wp_customize ) {

		// Enable live preview JS for default fields
		$wp_customize->get_setting( 'blogname' )->transport 		= 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport 	= 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';



		// Site Identity Section Fields

		// Google Tag Manager Field
		$wp_customize->add_setting(
			'tag_manager',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'tag_manager',
			array(
				'description' 		=> esc_html__( 'Paste in the Google Tag Manager code here. Do not include the comment tags!', 'yosb' ),
				'label' 			=> esc_html__( 'Google Tag Manager', 'yosb' ),
				'priority' 			=> 90,
				'section' 			=> 'title_tagline',
				'settings' 			=> 'tag_manager',
				'type' 				=> 'textarea'
			)
		);
		$wp_customize->get_setting( 'tag_manager' )->transport = 'postMessage';




		/*
		// Fields & Controls

		// Text Field
		$wp_customize->add_setting(
			'text_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'text_field',
			array(
				'description' 		=> esc_html__( '', 'yosb' ),
				'label'  			=> esc_html__( 'Text Field', 'yosb' ),
				'priority' 			=> 10,
				'section'  			=> 'new_section',
				'settings' 			=> 'text_field',
				'type' 				=> 'text'
			)
		);
		$wp_customize->get_setting( 'text_field' )->transport = 'postMessage';



		// URL Field
		$wp_customize->add_setting(
			'url_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => 'esc_url_raw'
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'url_field',
			array(
				'description' 		=> esc_html__( '', 'yosb' ),
				'label' 			=> esc_html__( 'URL Field', 'yosb' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'url_field',
				'type' 				=> 'url'
			)
		);
		$wp_customize->get_setting( 'url_field' )->transport = 'postMessage';



		// Email Field
		$wp_customize->add_setting(
			'email_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_email',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'email_field',
			array(
				'description' 		=> esc_html__( '', 'yosb' ),
				'label' 			=> esc_html__( 'Email Field', 'yosb' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'email_field',
				'type' 				=> 'email'
			)
		);
		$wp_customize->get_setting( 'email_field' )->transport = 'postMessage';

		// Date Field
		$wp_customize->add_setting(
			'date_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'date_field',
			array(
				'description' 		=> esc_html__( '', 'yosb' ),
				'label' 			=> esc_html__( 'Date Field', 'yosb' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'date_field',
				'type' 				=> 'date'
			)
		);
		$wp_customize->get_setting( 'date_field' )->transport = 'postMessage';


		// Checkbox Field
		$wp_customize->add_setting(
			'checkbox_field',
			array(
				'default'  			=> 'true',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'checkbox_field',
			array(
				'description' 		=> esc_html__( '', 'yosb' ),
				'label' 			=> esc_html__( 'Checkbox Field', 'yosb' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'checkbox_field',
				'type' 				=> 'checkbox'
			)
		);
		$wp_customize->get_setting( 'checkbox_field' )->transport = 'postMessage';




		// Password Field
		$wp_customize->add_setting(
			'password_field',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'password_field',
			array(
				'description' 		=> esc_html__( '', 'yosb' ),
				'label' 			=> esc_html__( 'Password Field', 'yosb' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'password_field',
				'type' 				=> 'password'
			)
		);
		$wp_customize->get_setting( 'password_field' )->transport = 'postMessage';



		// Radio Field
		$wp_customize->add_setting(
			'radio_field',
			array(
				'default'  			=> 'choice1',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'radio_field',
			array(
				'choices' 			=> array(
					'choice1' 		=> esc_html__( 'Choice 1', 'yosb' ),
					'choice2' 		=> esc_html__( 'Choice 2', 'yosb' ),
					'choice3' 		=> esc_html__( 'Choice 3', 'yosb' )
				),
				'description' 		=> esc_html__( '', 'yosb' ),
				'label' 			=> esc_html__( 'Radio Field', 'yosb' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'radio_field',
				'type' 				=> 'radio'
			)
		);
		$wp_customize->get_setting( 'radio_field' )->transport = 'postMessage';



		// Select Field
		$wp_customize->add_setting(
			'select_field',
			array(
				'default'  			=> 'choice1',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'select_field',
			array(
				'choices' 			=> array(
					'choice1' 		=> esc_html__( 'Choice 1', 'yosb' ),
					'choice2' 		=> esc_html__( 'Choice 2', 'yosb' ),
					'choice3' 		=> esc_html__( 'Choice 3', 'yosb' )
				),
				'description' 		=> esc_html__( '', 'yosb' ),
				'label' 			=> esc_html__( 'Select Field', 'yosb' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'select_field',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'select_field' )->transport = 'postMessage';



		// Textarea Field
		$wp_customize->add_setting(
			'textarea_field',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'textarea_field',
			array(
				'description' 		=> esc_html__( '', 'yosb' ),
				'label' 			=> esc_html__( 'Textarea Field', 'yosb' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'textarea_field',
				'type'				=> 'textarea'
			)
		);
		$wp_customize->get_setting( 'textarea_field' )->transport = 'postMessage';



		// Range Field
		$wp_customize->add_setting(
			'range_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_hex_color'
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'range_field',
			array(
				'description' 		=> esc_html__( '', 'yosb' ),
				'input_attrs' 		=> array(
					'class' 		=> 'range-field',
					'max' 			=> 100,
					'min' 			=> 0,
					'step' 			=> 1,
					'style' 		=> 'color: #020202'
				),
				'label' 			=> esc_html__( 'Range Field', 'yosb' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'range_field',
				'type' 				=> 'range'
			)
		);
		$wp_customize->get_setting( 'range_field' )->transport = 'postMessage';



		// Page Select Field
		$wp_customize->add_setting(
			'select_page_field',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'select_page_field',
			array(
				'description' 		=> esc_html__( '', 'yosb' ),
				'label' 			=> esc_html__( 'Select Page', 'yosb' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'select_page_field',
				'type' 				=> 'dropdown-pages'
			)
		);
		$wp_customize->get_setting( 'dropdown-pages' )->transport = 'postMessage';



		// Color Chooser Field
		$wp_customize->add_setting(
			'color_field',
			array(
				'default'  			=> '#ffffff',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'color_field',
				array(
					'description' 	=> esc_html__( '', 'yosb' ),
					'label' 		=> esc_html__( 'Color Field', 'yosb' ),
					'priority' 		=> 10,
					'section' 		=> 'new_section',
					'settings' 		=> 'color_field'
				),
			)
		);
		$wp_customize->get_setting( 'color_field' )->transport = 'postMessage';



		// File Upload Field
		$wp_customize->add_setting( 'file_upload' );
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'file_upload',
				array(
					'description' 	=> esc_html__( '', 'yosb' ),
					'label' 		=> esc_html__( 'File Upload', 'yosb' ),
					'priority' 		=> 10,
					'section' 		=> 'new_section',
					'settings' 		=> 'file_upload'
				),
			)
		);



		// Image Upload Field
		$wp_customize->add_setting(
			'image_upload',
			array(
				'default' 			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'image_upload',
				array(
					'description' 	=> esc_html__( '', 'yosb' ),
					'label' 		=> esc_html__( 'Image Field', 'yosb' ),
					'priority' 		=> 10,
					'section' 		=> 'new_section',
					'settings' 		=> 'image_upload'
				)
			)
		);
		$wp_customize->get_setting( 'image_upload' )->transport = 'postMessage';



		// Media Upload Field
		// Can be used for images
		// Returns the image ID, not a URL
		$wp_customize->add_setting(
			'media_upload',
			array(
				'default' 			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				'media_upload',
				array(
					'description' 	=> esc_html__( '', 'yosb' ),
					'label' 		=> esc_html__( 'Media Field', 'yosb' ),
					'mime_type' 	=> '',
					'priority' 		=> 10,
					'section'		=> 'new_section',
					'settings' 		=> 'media_upload'
				)
			)
		);
		$wp_customize->get_setting( 'media_upload' )->transport = 'postMessage';




		// Cropped Image Field
		$wp_customize->add_setting(
			'cropped_image',
			array(
				'default' 			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'cropped_image',
				array(
					'description' 	=> esc_html__( '', 'yosb' ),
					'flex_height' 	=> '',
					'flex_width' 	=> '',
					'height' 		=> '1080',
					'priority' 		=> 10,
					'section' 		=> 'new_section',
					'settings' 		=> 'cropped_image',
					width' 			=> '1920'
				)
			)
		);
		$wp_customize->get_setting( 'cropped_image' )->transport = 'postMessage';


		// Country Select Field
		$wp_customize->add_setting(
			'country',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'country',
			array(
				'choices' 			=> yosb_country_list(),
				'description' 		=> esc_html__( '', 'yosb' ),
				'label' 			=> esc_html__( 'Country', 'yosb' ),
				'priority' 			=> 250,
				'section' 			=> 'contact_info',
				'settings' 			=> 'country',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'country' )->transport = 'postMessage';


		// US States Select Field
		$wp_customize->add_setting(
			'us_state',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'us_state',
			array(
				'choices' => array(
					'AL' => esc_html__( 'Alabama', 'yosb' ),
					'AK' => esc_html__( 'Alaska', 'yosb' ),
					'AZ' => esc_html__( 'Arizona', 'yosb' ),
					'AR' => esc_html__( 'Arkansas', 'yosb' ),
					'CA' => esc_html__( 'California', 'yosb' ),
					'CO' => esc_html__( 'Colorado', 'yosb' ),
					'CT' => esc_html__( 'Connecticut', 'yosb' ),
					'DE' => esc_html__( 'Delaware', 'yosb' ),
					'DC' => esc_html__( 'District of Columbia', 'yosb' ),
					'FL' => esc_html__( 'Florida', 'yosb' ),
					'GA' => esc_html__( 'Georgia', 'yosb' ),
					'HI' => esc_html__( 'Hawaii', 'yosb' ),
					'ID' => esc_html__( 'Idaho', 'yosb' ),
					'IL' => esc_html__( 'Illinois', 'yosb' ),
					'IN' => esc_html__( 'Indiana', 'yosb' ),
					'IA' => esc_html__( 'Iowa', 'yosb' ),
					'KS' => esc_html__( 'Kansas', 'yosb' ),
					'KY' => esc_html__( 'Kentucky', 'yosb' ),
					'LA' => esc_html__( 'Louisiana', 'yosb' ),
					'ME' => esc_html__( 'Maine', 'yosb' ),
					'MD' => esc_html__( 'Maryland', 'yosb' ),
					'MA' => esc_html__( 'Massachusetts', 'yosb' ),
					'MI' => esc_html__( 'Michigan', 'yosb' ),
					'MN' => esc_html__( 'Minnesota', 'yosb' ),
					'MS' => esc_html__( 'Mississippi', 'yosb' ),
					'MO' => esc_html__( 'Missouri', 'yosb' ),
					'MT' => esc_html__( 'Montana', 'yosb' ),
					'NE' => esc_html__( 'Nebraska', 'yosb' ),
					'NV' => esc_html__( 'Nevada', 'yosb' ),
					'NH' => esc_html__( 'New Hampshire', 'yosb' ),
					'NJ' => esc_html__( 'New Jersey', 'yosb' ),
					'NM' => esc_html__( 'New Mexico', 'yosb' ),
					'NY' => esc_html__( 'New York', 'yosb' ),
					'NC' => esc_html__( 'North Carolina', 'yosb' ),
					'ND' => esc_html__( 'North Dakota', 'yosb' ),
					'OH' => esc_html__( 'Ohio', 'yosb' ),
					'OK' => esc_html__( 'Oklahoma', 'yosb' ),
					'OR' => esc_html__( 'Oregon', 'yosb' ),
					'PA' => esc_html__( 'Pennsylvania', 'yosb' ),
					'RI' => esc_html__( 'Rhode Island', 'yosb' ),
					'SC' => esc_html__( 'South Carolina', 'yosb' ),
					'SD' => esc_html__( 'South Dakota', 'yosb' ),
					'TN' => esc_html__( 'Tennessee', 'yosb' ),
					'TX' => esc_html__( 'Texas', 'yosb' ),
					'UT' => esc_html__( 'Utah', 'yosb' ),
					'VT' => esc_html__( 'Vermont', 'yosb' ),
					'VA' => esc_html__( 'Virginia', 'yosb' ),
					'WA' => esc_html__( 'Washington', 'yosb' ),
					'WV' => esc_html__( 'West Virginia', 'yosb' ),
					'WI' => esc_html__( 'Wisconsin', 'yosb' ),
					'WY' => esc_html__( 'Wyoming', 'yosb' ),
					'AS' => esc_html__( 'American Samoa', 'yosb' ),
					'AA' => esc_html__( 'Armed Forces America (except Canada)', 'yosb' ),
					'AE' => esc_html__( 'Armed Forces Africa/Canada/Europe/Middle East', 'yosb' ),
					'AP' => esc_html__( 'Armed Forces Pacific', 'yosb' ),
					'FM' => esc_html__( 'Federated States of Micronesia', 'yosb' ),
					'GU' => esc_html__( 'Guam', 'yosb' ),
					'MH' => esc_html__( 'Marshall Islands', 'yosb' ),
					'MP' => esc_html__( 'Northern Mariana Islands', 'yosb' ),
					'PR' => esc_html__( 'Puerto Rico', 'yosb' ),
					'PW' => esc_html__( 'Palau', 'yosb' ),
					'VI' => esc_html__( 'Virgin Islands', 'yosb' )
				),
				'description' 		=> esc_html__( '', 'yosb' ),
				'label' 			=> esc_html__( 'State', 'yosb' ),
				'priority' 			=> 230,
				'section' 			=> 'contact_info',
				'settings' 			=> 'us_state',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'us_state' )->transport = 'postMessage';


		// Canadian States Select Field
		$wp_customize->add_setting(
			'canada_state',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'canada_state',
			array(
				'choices' => array(
					'AB' => esc_html__( 'Alberta', 'yosb' ),
					'BC' => esc_html__( 'British Columbia', 'yosb' ),
					'MB' => esc_html__( 'Manitoba', 'yosb' ),
					'NB' => esc_html__( 'New Brunswick', 'yosb' ),
					'NL' => esc_html__( 'Newfoundland and Labrador', 'yosb' ),
					'NT' => esc_html__( 'Northwest Territories', 'yosb' ),
					'NS' => esc_html__( 'Nova Scotia', 'yosb' ),
					'NU' => esc_html__( 'Nunavut', 'yosb' ),
					'ON' => esc_html__( 'Ontario', 'yosb' ),
					'PE' => esc_html__( 'Prince Edward Island', 'yosb' ),
					'QC' => esc_html__( 'Quebec', 'yosb' ),
					'SK' => esc_html__( 'Saskatchewan', 'yosb' ),
					'YT' => esc_html__( 'Yukon', 'yosb' )
				),
				'description' 		=> esc_html__( '', 'yosb' ),
				'label' 			=> esc_html__( 'State', 'yosb' ),
				'priority' 			=> 230,
				'section' 			=> 'contact_info',
				'settings' 			=> 'canada_state',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'canada_state' )->transport = 'postMessage';


		// Australian States Select Field
		$wp_customize->add_setting(
			'australia_state',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'australia_state',
			array(
				'choices' => array(
					'ACT' 	=> esc_html__( 'Australian Capital Territory', 'yosb' ),
					'NSW' 	=> esc_html__( 'New South Wales', 'yosb' ),
					'NT' 	=> esc_html__( 'Northern Territory', 'yosb' ),
					'QLD' 	=> esc_html__( 'Queensland', 'yosb' ),
					'SA' 	=> esc_html__( 'South Australia', 'yosb' ),
					'TAS' 	=> esc_html__( 'Tasmania', 'yosb' ),
					'VIC' 	=> esc_html__( 'Victoria', 'yosb' ),
					'WA' 	=> esc_html__( 'Western Australia', 'yosb' )
				),
				'description' 		=> esc_html__( '', 'yosb' ),
				'label' 			=> esc_html__( 'State', 'yosb' ),
				'priority' 			=> 230,
				'section' 			=> 'contact_info',
				'settings' 			=> 'australia_state',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'australia_state' )->transport = 'postMessage';


		*/

	} // register_fields()

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @access 		public
	 * @since 		1.0.0
	 *
	 * @param 		string 		$selector 		CSS selector
	 * @param 		string 		$style 			The name of the CSS *property* to modify
	 * @param 		string 		$mod_name 		The name of the 'theme_mod' option to fetch
	 * @param 		string 		$prefix 		Optional. Anything that needs to be output before the CSS property
	 * @param 		string 		$postfix 		Optional. Anything that needs to be output after the CSS property
	 * @param 		bool 		$echo 			Optional. Whether to print directly to the page (default: true).
	 *
	 * @return 		string 						Returns a single line of CSS with selectors and a property.
	 */
	public function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {

		$return = '';
		$mod 	= get_theme_mod( $mod_name );

		if ( ! empty( $mod ) ) {

			$return = sprintf('%s { %s:%s; }',
				$selector,
				$style,
				$prefix . $mod . $postfix
			);

			if ( $echo ) {

				echo $return;

			}

		}

		return $return;

	} // generate_css()

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 *
	 * Used by hook: 'wp_head'
	 *
	 * @access 		public
	 * @see 		add_action( 'wp_head', $func )
	 * @since 		1.0.0
	 */
	public function header_output() {

		?><!-- Customizer CSS -->
		<style type="text/css"><?php

			// pattern:
			// yosb_generate_css( 'selector', 'style', 'mod_name', 'prefix', 'postfix', true );
			//
			// background-image example:
			// yosb_generate_css( '.class', 'background-image', 'background_image_example', 'url(', ')' );


		?></style><!-- Customizer CSS --><?php

		/**
		 * Hides all but the first Soliloquy slide while using Customizer previewer.
		 */
		if ( is_customize_preview() ) {

			?><style type="text/css">

				li.soliloquy-item:not(:first-child) {
					display: none !important;
				}

			</style><!-- Customizer CSS --><?php

		}

	} // header_output()

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * Used by hook: 'customize_preview_init'
	 *
	 * @access 		public
	 * @see 		add_action( 'customize_preview_init', $func )
	 * @since 		1.0.0
	 */
	public function live_preview() {

		wp_enqueue_script( 'yosb_customizer', get_template_directory_uri() . '/js/customizer.min.js', array( 'jquery', 'customize-preview' ), '', true );

	} // live_preview()

	/**
	 * Used by customizer controls, mostly for active callbacks.
	 *
	 * @hook		customize_controls_enqueue_scripts
	 *
	 * @access 		public
	 * @see 		add_action( 'customize_preview_init', $func )
	 * @since 		1.0.0
	 */
	public function control_scripts() {

		wp_enqueue_script( 'yosb_customizer_controls', get_template_directory_uri() . '/js/customizer-controls.min.js', array( 'jquery', 'customize-controls' ), false, true );

	} // control_scripts()

	/**
	 * Returns TRUE based on which link type is selected, otherwise FALSE
	 *
	 * @param 	object 		$control 			The control object
	 * @return 	bool 							TRUE if conditions are met, otherwise FALSE
	 */
	public function states_of_country_callback( $control ) {

		$country_setting = $control->manager->get_setting('country')->value();

		//wp_die( print_r( $radio_setting ) );
		//wp_die( print_r( $control->id ) );

		if ( 'us_state' === $control->id && 'US' === $country_setting ) { return true; }
		if ( 'canada_state' === $control->id && 'CA' === $country_setting ) { return true; }
		if ( 'australia_state' === $control->id && 'AU' === $country_setting ) { return true; }
		if ( 'default_state' === $control->id && ! yosb_custom_countries( $country_setting ) ) { return true; }

		return false;

	} // states_of_country_callback()

	/**
	 * Returns true if a country has a custom select menu
	 *
	 * @param 		string 		$country 			The country code to check
	 *
	 * @return 		bool 							TRUE if the code is in the array, FALSE otherwise
	 */
	public function custom_countries( $country ) {

		$countries = array( 'US', 'CA', 'AU' );

		return in_array( $country, $countries );

	} // custom_countries()

	/**
	 * Returns an array of countries or a country name.
	 *
	 * @param 		string 		$country 		Country code to return (optional)
	 *
	 * @return 		array|string 				Array of countries or a single country name
	 */
	public function country_list( $country = '' ) {

		$countries = array();

		$countries['AF'] = esc_html__( 'Afghanistan (‫افغانستان‬‎)', 'yosb' );
		$countries['AX'] = esc_html__( 'Åland Islands (Åland)', 'yosb' );
		$countries['AL'] = esc_html__( 'Albania (Shqipëri)', 'yosb' );
		$countries['DZ'] = esc_html__( 'Algeria (‫الجزائر‬‎)', 'yosb' );
		$countries['AS'] = esc_html__( 'American Samoa', 'yosb' );
		$countries['AD'] = esc_html__( 'Andorra', 'yosb' );
		$countries['AO'] = esc_html__( 'Angola', 'yosb' );
		$countries['AI'] = esc_html__( 'Anguilla', 'yosb' );
		$countries['AQ'] = esc_html__( 'Antarctica', 'yosb' );
		$countries['AG'] = esc_html__( 'Antigua and Barbuda', 'yosb' );
		$countries['AR'] = esc_html__( 'Argentina', 'yosb' );
		$countries['AM'] = esc_html__( 'Armenia (Հայաստան)', 'yosb' );
		$countries['AW'] = esc_html__( 'Aruba', 'yosb' );
		$countries['AC'] = esc_html__( 'Ascension Island', 'yosb' );
		$countries['AU'] = esc_html__( 'Australia', 'yosb' );
		$countries['AT'] = esc_html__( 'Austria (Österreich)', 'yosb' );
		$countries['AZ'] = esc_html__( 'Azerbaijan (Azərbaycan)', 'yosb' );
		$countries['BS'] = esc_html__( 'Bahamas', 'yosb' );
		$countries['BH'] = esc_html__( 'Bahrain (‫البحرين‬‎)', 'yosb' );
		$countries['BD'] = esc_html__( 'Bangladesh (বাংলাদেশ)', 'yosb' );
		$countries['BB'] = esc_html__( 'Barbados', 'yosb' );
		$countries['BY'] = esc_html__( 'Belarus (Беларусь)', 'yosb' );
		$countries['BE'] = esc_html__( 'Belgium (België)', 'yosb' );
		$countries['BZ'] = esc_html__( 'Belize', 'yosb' );
		$countries['BJ'] = esc_html__( 'Benin (Bénin)', 'yosb' );
		$countries['BM'] = esc_html__( 'Bermuda', 'yosb' );
		$countries['BT'] = esc_html__( 'Bhutan (འབྲུག)', 'yosb' );
		$countries['BO'] = esc_html__( 'Bolivia', 'yosb' );
		$countries['BA'] = esc_html__( 'Bosnia and Herzegovina (Босна и Херцеговина)', 'yosb' );
		$countries['BW'] = esc_html__( 'Botswana', 'yosb' );
		$countries['BV'] = esc_html__( 'Bouvet Island', 'yosb' );
		$countries['BR'] = esc_html__( 'Brazil (Brasil)', 'yosb' );
		$countries['IO'] = esc_html__( 'British Indian Ocean Territory', 'yosb' );
		$countries['VG'] = esc_html__( 'British Virgin Islands', 'yosb' );
		$countries['BN'] = esc_html__( 'Brunei', 'yosb' );
		$countries['BG'] = esc_html__( 'Bulgaria (България)', 'yosb' );
		$countries['BF'] = esc_html__( 'Burkina Faso', 'yosb' );
		$countries['BI'] = esc_html__( 'Burundi (Uburundi)', 'yosb' );
		$countries['KH'] = esc_html__( 'Cambodia (កម្ពុជា)', 'yosb' );
		$countries['CM'] = esc_html__( 'Cameroon (Cameroun)', 'yosb' );
		$countries['CA'] = esc_html__( 'Canada', 'yosb' );
		$countries['IC'] = esc_html__( 'Canary Islands (islas Canarias)', 'yosb' );
		$countries['CV'] = esc_html__( 'Cape Verde (Kabu Verdi)', 'yosb' );
		$countries['BQ'] = esc_html__( 'Caribbean Netherlands', 'yosb' );
		$countries['KY'] = esc_html__( 'Cayman Islands', 'yosb' );
		$countries['CF'] = esc_html__( 'Central African Republic (République centrafricaine)', 'yosb' );
		$countries['EA'] = esc_html__( 'Ceuta and Melilla (Ceuta y Melilla)', 'yosb' );
		$countries['TD'] = esc_html__( 'Chad (Tchad)', 'yosb' );
		$countries['CL'] = esc_html__( 'Chile', 'yosb' );
		$countries['CN'] = esc_html__( 'China (中国)', 'yosb' );
		$countries['CX'] = esc_html__( 'Christmas Island', 'yosb' );
		$countries['CP'] = esc_html__( 'Clipperton Island', 'yosb' );
		$countries['CC'] = esc_html__( 'Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))', 'yosb' );
		$countries['CO'] = esc_html__( 'Colombia', 'yosb' );
		$countries['KM'] = esc_html__( 'Comoros (‫جزر القمر‬‎)', 'yosb' );
		$countries['CD'] = esc_html__( 'Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)', 'yosb' );
		$countries['CG'] = esc_html__( 'Congo (Republic) (Congo-Brazzaville)', 'yosb' );
		$countries['CK'] = esc_html__( 'Cook Islands', 'yosb' );
		$countries['CR'] = esc_html__( 'Costa Rica', 'yosb' );
		$countries['CI'] = esc_html__( 'Côte d’Ivoire', 'yosb' );
		$countries['HR'] = esc_html__( 'Croatia (Hrvatska)', 'yosb' );
		$countries['CU'] = esc_html__( 'Cuba', 'yosb' );
		$countries['CW'] = esc_html__( 'Curaçao', 'yosb' );
		$countries['CY'] = esc_html__( 'Cyprus (Κύπρος)', 'yosb' );
		$countries['CZ'] = esc_html__( 'Czech Republic (Česká republika)', 'yosb' );
		$countries['DK'] = esc_html__( 'Denmark (Danmark)', 'yosb' );
		$countries['DG'] = esc_html__( 'Diego Garcia', 'yosb' );
		$countries['DJ'] = esc_html__( 'Djibouti', 'yosb' );
		$countries['DM'] = esc_html__( 'Dominica', 'yosb' );
		$countries['DO'] = esc_html__( 'Dominican Republic (República Dominicana)', 'yosb' );
		$countries['EC'] = esc_html__( 'Ecuador', 'yosb' );
		$countries['EG'] = esc_html__( 'Egypt (‫مصر‬‎)', 'yosb' );
		$countries['SV'] = esc_html__( 'El Salvador', 'yosb' );
		$countries['GQ'] = esc_html__( 'Equatorial Guinea (Guinea Ecuatorial)', 'yosb' );
		$countries['ER'] = esc_html__( 'Eritrea', 'yosb' );
		$countries['EE'] = esc_html__( 'Estonia (Eesti)', 'yosb' );
		$countries['ET'] = esc_html__( 'Ethiopia', 'yosb' );
		$countries['FK'] = esc_html__( 'Falkland Islands (Islas Malvinas)', 'yosb' );
		$countries['FO'] = esc_html__( 'Faroe Islands (Føroyar)', 'yosb' );
		$countries['FJ'] = esc_html__( 'Fiji', 'yosb' );
		$countries['FI'] = esc_html__( 'Finland (Suomi)', 'yosb' );
		$countries['FR'] = esc_html__( 'France', 'yosb' );
		$countries['GF'] = esc_html__( 'French Guiana (Guyane française)', 'yosb' );
		$countries['PF'] = esc_html__( 'French Polynesia (Polynésie française)', 'yosb' );
		$countries['TF'] = esc_html__( 'French Southern Territories (Terres australes françaises)', 'yosb' );
		$countries['GA'] = esc_html__( 'Gabon', 'yosb' );
		$countries['GM'] = esc_html__( 'Gambia', 'yosb' );
		$countries['GE'] = esc_html__( 'Georgia (საქართველო)', 'yosb' );
		$countries['DE'] = esc_html__( 'Germany (Deutschland)', 'yosb' );
		$countries['GH'] = esc_html__( 'Ghana (Gaana)', 'yosb' );
		$countries['GI'] = esc_html__( 'Gibraltar', 'yosb' );
		$countries['GR'] = esc_html__( 'Greece (Ελλάδα)', 'yosb' );
		$countries['GL'] = esc_html__( 'Greenland (Kalaallit Nunaat)', 'yosb' );
		$countries['GD'] = esc_html__( 'Grenada', 'yosb' );
		$countries['GP'] = esc_html__( 'Guadeloupe', 'yosb' );
		$countries['GU'] = esc_html__( 'Guam', 'yosb' );
		$countries['GT'] = esc_html__( 'Guatemala', 'yosb' );
		$countries['GG'] = esc_html__( 'Guernsey', 'yosb' );
		$countries['GN'] = esc_html__( 'Guinea (Guinée)', 'yosb' );
		$countries['GW'] = esc_html__( 'Guinea-Bissau (Guiné Bissau)', 'yosb' );
		$countries['GY'] = esc_html__( 'Guyana', 'yosb' );
		$countries['HT'] = esc_html__( 'Haiti', 'yosb' );
		$countries['HM'] = esc_html__( 'Heard & McDonald Islands', 'yosb' );
		$countries['HN'] = esc_html__( 'Honduras', 'yosb' );
		$countries['HK'] = esc_html__( 'Hong Kong (香港)', 'yosb' );
		$countries['HU'] = esc_html__( 'Hungary (Magyarország)', 'yosb' );
		$countries['IS'] = esc_html__( 'Iceland (Ísland)', 'yosb' );
		$countries['IN'] = esc_html__( 'India (भारत)', 'yosb' );
		$countries['ID'] = esc_html__( 'Indonesia', 'yosb' );
		$countries['IR'] = esc_html__( 'Iran (‫ایران‬‎)', 'yosb' );
		$countries['IQ'] = esc_html__( 'Iraq (‫العراق‬‎)', 'yosb' );
		$countries['IE'] = esc_html__( 'Ireland', 'yosb' );
		$countries['IM'] = esc_html__( 'Isle of Man', 'yosb' );
		$countries['IL'] = esc_html__( 'Israel (‫ישראל‬‎)', 'yosb' );
		$countries['IT'] = esc_html__( 'Italy (Italia)', 'yosb' );
		$countries['JM'] = esc_html__( 'Jamaica', 'yosb' );
		$countries['JP'] = esc_html__( 'Japan (日本)', 'yosb' );
		$countries['JE'] = esc_html__( 'Jersey', 'yosb' );
		$countries['JO'] = esc_html__( 'Jordan (‫الأردن‬‎)', 'yosb' );
		$countries['KZ'] = esc_html__( 'Kazakhstan (Казахстан)', 'yosb' );
		$countries['KE'] = esc_html__( 'Kenya', 'yosb' );
		$countries['KI'] = esc_html__( 'Kiribati', 'yosb' );
		$countries['XK'] = esc_html__( 'Kosovo (Kosovë)', 'yosb' );
		$countries['KW'] = esc_html__( 'Kuwait (‫الكويت‬‎)', 'yosb' );
		$countries['KG'] = esc_html__( 'Kyrgyzstan (Кыргызстан)', 'yosb' );
		$countries['LA'] = esc_html__( 'Laos (ລາວ)', 'yosb' );
		$countries['LV'] = esc_html__( 'Latvia (Latvija)', 'yosb' );
		$countries['LB'] = esc_html__( 'Lebanon (‫لبنان‬‎)', 'yosb' );
		$countries['LS'] = esc_html__( 'Lesotho', 'yosb' );
		$countries['LR'] = esc_html__( 'Liberia', 'yosb' );
		$countries['LY'] = esc_html__( 'Libya (‫ليبيا‬‎)', 'yosb' );
		$countries['LI'] = esc_html__( 'Liechtenstein', 'yosb' );
		$countries['LT'] = esc_html__( 'Lithuania (Lietuva)', 'yosb' );
		$countries['LU'] = esc_html__( 'Luxembourg', 'yosb' );
		$countries['MO'] = esc_html__( 'Macau (澳門)', 'yosb' );
		$countries['MK'] = esc_html__( 'Macedonia (FYROM) (Македонија)', 'yosb' );
		$countries['MG'] = esc_html__( 'Madagascar (Madagasikara)', 'yosb' );
		$countries['MW'] = esc_html__( 'Malawi', 'yosb' );
		$countries['MY'] = esc_html__( 'Malaysia', 'yosb' );
		$countries['MV'] = esc_html__( 'Maldives', 'yosb' );
		$countries['ML'] = esc_html__( 'Mali', 'yosb' );
		$countries['MT'] = esc_html__( 'Malta', 'yosb' );
		$countries['MH'] = esc_html__( 'Marshall Islands', 'yosb' );
		$countries['MQ'] = esc_html__( 'Martinique', 'yosb' );
		$countries['MR'] = esc_html__( 'Mauritania (‫موريتانيا‬‎)', 'yosb' );
		$countries['MU'] = esc_html__( 'Mauritius (Moris)', 'yosb' );
		$countries['YT'] = esc_html__( 'Mayotte', 'yosb' );
		$countries['MX'] = esc_html__( 'Mexico (México)', 'yosb' );
		$countries['FM'] = esc_html__( 'Micronesia', 'yosb' );
		$countries['MD'] = esc_html__( 'Moldova (Republica Moldova)', 'yosb' );
		$countries['MC'] = esc_html__( 'Monaco', 'yosb' );
		$countries['MN'] = esc_html__( 'Mongolia (Монгол)', 'yosb' );
		$countries['ME'] = esc_html__( 'Montenegro (Crna Gora)', 'yosb' );
		$countries['MS'] = esc_html__( 'Montserrat', 'yosb' );
		$countries['MA'] = esc_html__( 'Morocco (‫المغرب‬‎)', 'yosb' );
		$countries['MZ'] = esc_html__( 'Mozambique (Moçambique)', 'yosb' );
		$countries['MM'] = esc_html__( 'Myanmar (Burma) (မြန်မာ)', 'yosb' );
		$countries['NA'] = esc_html__( 'Namibia (Namibië)', 'yosb' );
		$countries['NR'] = esc_html__( 'Nauru', 'yosb' );
		$countries['NP'] = esc_html__( 'Nepal (नेपाल)', 'yosb' );
		$countries['NL'] = esc_html__( 'Netherlands (Nederland)', 'yosb' );
		$countries['NC'] = esc_html__( 'New Caledonia (Nouvelle-Calédonie)', 'yosb' );
		$countries['NZ'] = esc_html__( 'New Zealand', 'yosb' );
		$countries['NI'] = esc_html__( 'Nicaragua', 'yosb' );
		$countries['NE'] = esc_html__( 'Niger (Nijar)', 'yosb' );
		$countries['NG'] = esc_html__( 'Nigeria', 'yosb' );
		$countries['NU'] = esc_html__( 'Niue', 'yosb' );
		$countries['NF'] = esc_html__( 'Norfolk Island', 'yosb' );
		$countries['MP'] = esc_html__( 'Northern Mariana Islands', 'yosb' );
		$countries['KP'] = esc_html__( 'North Korea (조선 민주주의 인민 공화국)', 'yosb' );
		$countries['NO'] = esc_html__( 'Norway (Norge)', 'yosb' );
		$countries['OM'] = esc_html__( 'Oman (‫عُمان‬‎)', 'yosb' );
		$countries['PK'] = esc_html__( 'Pakistan (‫پاکستان‬‎)', 'yosb' );
		$countries['PW'] = esc_html__( 'Palau', 'yosb' );
		$countries['PS'] = esc_html__( 'Palestine (‫فلسطين‬‎)', 'yosb' );
		$countries['PA'] = esc_html__( 'Panama (Panamá)', 'yosb' );
		$countries['PG'] = esc_html__( 'Papua New Guinea', 'yosb' );
		$countries['PY'] = esc_html__( 'Paraguay', 'yosb' );
		$countries['PE'] = esc_html__( 'Peru (Perú)', 'yosb' );
		$countries['PH'] = esc_html__( 'Philippines', 'yosb' );
		$countries['PN'] = esc_html__( 'Pitcairn Islands', 'yosb' );
		$countries['PL'] = esc_html__( 'Poland (Polska)', 'yosb' );
		$countries['PT'] = esc_html__( 'Portugal', 'yosb' );
		$countries['PR'] = esc_html__( 'Puerto Rico', 'yosb' );
		$countries['QA'] = esc_html__( 'Qatar (‫قطر‬‎)', 'yosb' );
		$countries['RE'] = esc_html__( 'Réunion (La Réunion)', 'yosb' );
		$countries['RO'] = esc_html__( 'Romania (România)', 'yosb' );
		$countries['RU'] = esc_html__( 'Russia (Россия)', 'yosb' );
		$countries['RW'] = esc_html__( 'Rwanda', 'yosb' );
		$countries['BL'] = esc_html__( 'Saint Barthélemy (Saint-Barthélemy)', 'yosb' );
		$countries['SH'] = esc_html__( 'Saint Helena', 'yosb' );
		$countries['KN'] = esc_html__( 'Saint Kitts and Nevis', 'yosb' );
		$countries['LC'] = esc_html__( 'Saint Lucia', 'yosb' );
		$countries['MF'] = esc_html__( 'Saint Martin (Saint-Martin (partie française))', 'yosb' );
		$countries['PM'] = esc_html__( 'Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)', 'yosb' );
		$countries['WS'] = esc_html__( 'Samoa', 'yosb' );
		$countries['SM'] = esc_html__( 'San Marino', 'yosb' );
		$countries['ST'] = esc_html__( 'São Tomé and Príncipe (São Tomé e Príncipe)', 'yosb' );
		$countries['SA'] = esc_html__( 'Saudi Arabia (‫المملكة العربية السعودية‬‎)', 'yosb' );
		$countries['SN'] = esc_html__( 'Senegal (Sénégal)', 'yosb' );
		$countries['RS'] = esc_html__( 'Serbia (Србија)', 'yosb' );
		$countries['SC'] = esc_html__( 'Seychelles', 'yosb' );
		$countries['SL'] = esc_html__( 'Sierra Leone', 'yosb' );
		$countries['SG'] = esc_html__( 'Singapore', 'yosb' );
		$countries['SX'] = esc_html__( 'Sint Maarten', 'yosb' );
		$countries['SK'] = esc_html__( 'Slovakia (Slovensko)', 'yosb' );
		$countries['SI'] = esc_html__( 'Slovenia (Slovenija)', 'yosb' );
		$countries['SB'] = esc_html__( 'Solomon Islands', 'yosb' );
		$countries['SO'] = esc_html__( 'Somalia (Soomaaliya)', 'yosb' );
		$countries['ZA'] = esc_html__( 'South Africa', 'yosb' );
		$countries['GS'] = esc_html__( 'South Georgia & South Sandwich Islands', 'yosb' );
		$countries['KR'] = esc_html__( 'South Korea (대한민국)', 'yosb' );
		$countries['SS'] = esc_html__( 'South Sudan (‫جنوب السودان‬‎)', 'yosb' );
		$countries['ES'] = esc_html__( 'Spain (España)', 'yosb' );
		$countries['LK'] = esc_html__( 'Sri Lanka (ශ්‍රී ලංකාව)', 'yosb' );
		$countries['VC'] = esc_html__( 'St. Vincent & Grenadines', 'yosb' );
		$countries['SD'] = esc_html__( 'Sudan (‫السودان‬‎)', 'yosb' );
		$countries['SR'] = esc_html__( 'Suriname', 'yosb' );
		$countries['SJ'] = esc_html__( 'Svalbard and Jan Mayen (Svalbard og Jan Mayen)', 'yosb' );
		$countries['SZ'] = esc_html__( 'Swaziland', 'yosb' );
		$countries['SE'] = esc_html__( 'Sweden (Sverige)', 'yosb' );
		$countries['CH'] = esc_html__( 'Switzerland (Schweiz)', 'yosb' );
		$countries['SY'] = esc_html__( 'Syria (‫سوريا‬‎)', 'yosb' );
		$countries['TW'] = esc_html__( 'Taiwan (台灣)', 'yosb' );
		$countries['TJ'] = esc_html__( 'Tajikistan', 'yosb' );
		$countries['TZ'] = esc_html__( 'Tanzania', 'yosb' );
		$countries['TH'] = esc_html__( 'Thailand (ไทย)', 'yosb' );
		$countries['TL'] = esc_html__( 'Timor-Leste', 'yosb' );
		$countries['TG'] = esc_html__( 'Togo', 'yosb' );
		$countries['TK'] = esc_html__( 'Tokelau', 'yosb' );
		$countries['TO'] = esc_html__( 'Tonga', 'yosb' );
		$countries['TT'] = esc_html__( 'Trinidad and Tobago', 'yosb' );
		$countries['TA'] = esc_html__( 'Tristan da Cunha', 'yosb' );
		$countries['TN'] = esc_html__( 'Tunisia (‫تونس‬‎)', 'yosb' );
		$countries['TR'] = esc_html__( 'Turkey (Türkiye)', 'yosb' );
		$countries['TM'] = esc_html__( 'Turkmenistan', 'yosb' );
		$countries['TC'] = esc_html__( 'Turks and Caicos Islands', 'yosb' );
		$countries['TV'] = esc_html__( 'Tuvalu', 'yosb' );
		$countries['UM'] = esc_html__( 'U.S. Outlying Islands', 'yosb' );
		$countries['VI'] = esc_html__( 'U.S. Virgin Islands', 'yosb' );
		$countries['UG'] = esc_html__( 'Uganda', 'yosb' );
		$countries['UA'] = esc_html__( 'Ukraine (Україна)', 'yosb' );
		$countries['AE'] = esc_html__( 'United Arab Emirates (‫الإمارات العربية المتحدة‬‎)', 'yosb' );
		$countries['GB'] = esc_html__( 'United Kingdom', 'yosb' );
		$countries['US'] = esc_html__( 'United States', 'yosb' );
		$countries['UY'] = esc_html__( 'Uruguay', 'yosb' );
		$countries['UZ'] = esc_html__( 'Uzbekistan (Oʻzbekiston)', 'yosb' );
		$countries['VU'] = esc_html__( 'Vanuatu', 'yosb' );
		$countries['VA'] = esc_html__( 'Vatican City (Città del Vaticano)', 'yosb' );
		$countries['VE'] = esc_html__( 'Venezuela', 'yosb' );
		$countries['VN'] = esc_html__( 'Vietnam (Việt Nam)', 'yosb' );
		$countries['WF'] = esc_html__( 'Wallis and Futuna', 'yosb' );
		$countries['EH'] = esc_html__( 'Western Sahara (‫الصحراء الغربية‬‎)', 'yosb' );
		$countries['YE'] = esc_html__( 'Yemen (‫اليمن‬‎)', 'yosb' );
		$countries['ZM'] = esc_html__( 'Zambia', 'yosb' );
		$countries['ZW'] = esc_html__( 'Zimbabwe', 'yosb' );

		if ( ! empty( $country ) ) {

			return $countries[$country];

		}

		return $countries;

	} // country_list()

} // class
