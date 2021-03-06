<?php
/**
 * The metabox-specific functionality of the theme.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	Year_of_Small_Business
 */
class yosb_Admin_Metaboxes {

	/**
	 * The post meta data
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$meta    			The post meta data.
	 */
	private $meta;

	/**
	 * The ID of this theme.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$theme_name 		The ID of this theme.
	 */
	private $theme_name;

	/**
	 * The version of this theme.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$version 			The current version of this theme.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string 			$plugin_name 		The name of this theme.
	 * @param 		string 			$version 			The version of this theme.
	 */
	public function __construct( $theme_name, $version ) {

		$this->theme_name 	= $theme_name;
		$this->version 		= $version;

	} // __construct()

	/**
	 * Registers metaboxes with WordPress
	 *
	 * @since 	1.0.0
	 * @access 	public
	 */
	public function add_metaboxes() {

		//remove_meta_box( 'postimagediv', 'employee', 'side' );

		// add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );

		add_meta_box(
			'yosb_page',
			apply_filters( $this->theme_name . '-metabox-name-title', esc_html__( 'Landing Page', 'yosb' ) ),
			array( $this, 'metabox' ),
			'page',
			'normal',
			'high',
			array(
				'file' => 'page'
			)
		);

	} // add_metaboxes()

	/**
	 * Changes strings referencing Featured Images
	 *
	 * @see 		https://developer.wordpress.org/reference/hooks/post_type_labels_post_type/
	 *
	 * @param 		object 		$labels 		Current post type labels
	 * @return 		object 						Modified post type labels
	 */
	public function change_featured_image_labels( $labels ) {

		$labels->featured_image 		= esc_html__( 'Featured Image', 'yosb' );
		$labels->set_featured_image 	= esc_html__( 'Set featured image', 'yosb' );
		$labels->remove_featured_image 	= esc_html__( 'Remove featured image', 'yosb' );
		$labels->use_featured_image 	= esc_html__( 'Use as featured image', 'yosb' );

		return $labels;

	} // change_featured_image_labels()

	/**
	 * Check each nonce. If any don't verify, $nonce_check is increased.
	 * If all nonces verify, returns 0.
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		int 		The value of $nonce_check
	 */
	private function check_nonces( $posted ) {

		$nonces 		= array();
		$nonce_check 	= 0;

		$nonces[] 	= 'nonce_yosb_page';

		foreach ( $nonces as $nonce ) {

			if ( ! isset( $posted[$nonce] ) ) { $nonce_check++; }
			if ( isset( $posted[$nonce] ) && ! wp_verify_nonce( $posted[$nonce], $this->theme_name ) ) { $nonce_check++; }

		}

		return $nonce_check;

	} // check_nonces()

	/**
	 * Returns an array of the all the metabox fields and their respective types
	 *
	 * $fields[] 	= array( 'field-name', 'field-type', 'Field Label' );
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		array 		Metabox fields and types
	 */
	private function get_metabox_fields() {

		$fields = array();

		$fields[] 	= array( 'headline', 'text', 'Headline' );
		//$fields[] 	= array( 'subheading', 'text', 'Subheading' );
		$fields[] 	= array( 'main-menu', 'select', 'Main Menu' );
		$fields[] 	= array( 'side-menu', 'select', 'Side Menu' );

		return $fields;

	} // get_metabox_fields()

	/**
	 * Calls a metabox file specified in the add_meta_box args.
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @return 	void
	 */
	public function metabox( $post, $params ) {

		if ( ! is_admin() ) { return; }
		if ( 'page' != $post->post_type ) { return; }

		include( get_template_directory() . '/template-parts/metabox-' . $params['args']['file'] . '.php' );

	} // metabox()

	/**
	 * Add subtitle field to post editor
	 */
	public function metabox_subtitle( $post ) {

		if ( ! is_admin() ) { return; }
		if ( 'posttypename' !== $post->post_type ) { return; }

		include( get_template_directory() . '/template-parts/metabox-subtitle.php' );

	} // metabox_subtitle()

	/**
	 * Sets the class variable $options
	 */
	public function set_meta() {

		global $post;

		if ( empty( $post ) ) { return; }
		if ( 'page' != $post->post_type ) { return; }

		$this->meta = get_post_custom( $post->ID );

	} // set_meta()

	/**
	 * Saves metabox data
	 *
	 * @since 		1.0.0
	 * @access 		public
	 *
	 * @param 		int 		$post_id 		The post ID
	 * @param 		object 		$post 			The post object
	 */
	public function validate_meta( $post_id, $post ) {

		//wp_die( 'valdaite' );

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
		if ( ! current_user_can( 'edit_post', $post_id ) ) { return $post_id; }
		if ( 'page' != $post->post_type ) { return $post_id; }

		$nonce_check = $this->check_nonces( $_POST );

		if ( 0 < $nonce_check ) { return $post_id; }

		$metas = $this->get_metabox_fields();

		foreach ( $metas as $meta ) {

			$value 		= ( empty( $this->meta[$meta[0]][0] ) ? '' : $this->meta[$meta[0]][0] );
			$sanitizer 	= new yosb_Sanitize();
			$new_value 	= $sanitizer->clean( $_POST[$meta[0]], $meta[1] );

			update_post_meta( $post_id, $meta[0], $new_value );

			unset( $sanitizer );

		} // foreach

	} // validate_meta()

} // class
