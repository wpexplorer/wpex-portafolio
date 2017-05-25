<?php
/**
 * Registers the "Slides" custom post type
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */

if ( ! class_exists( 'WPEX_Slides_Post_Type' ) ) {

	class WPEX_Slides_Post_Type {

		/**
		 * Class Constructor
		 *
		 * @since   2.0.0
		 * @access  public
		 */
		public function __construct() {

			// Adds the slides post type and taxonomies
			add_action( 'init', array( 'WPEX_Slides_Post_Type', 'register' ), 0 );

			// Thumbnail support for slides posts
			add_theme_support( 'post-thumbnails', array( 'slides' ) );

			// Adds columns in the admin view for thumbnail and taxonomies
			add_filter( 'manage_edit-slides_columns', array( 'WPEX_Slides_Post_Type', 'edit_cols' ) );
			add_action( 'manage_posts_custom_column', array( 'WPEX_Slides_Post_Type', 'cols_display' ), 10, 2 );
			
		}
		

		/**
		 * Register the post type
		 *
		 * @since   2.0.0
		 * @access  public
		 *
		 * @link	http://codex.wordpress.org/Function_Reference/register_post_type
		 */
		public static function register() {

			// Define post type labels
			$labels = array(
				'name'					=> esc_html__( 'Slides', 'portafolio' ),
				'menu_name'				=> esc_html__( 'Home Slides', 'portafolio' ),
				'singular_name'			=> esc_html__( 'Slides Item', 'portafolio' ),
				'add_new'				=> esc_html__( 'Add New Item', 'portafolio' ),
				'add_new_item'			=> esc_html__( 'Add New Slides Item', 'portafolio' ),
				'edit_item'				=> esc_html__( 'Edit Slides Item', 'portafolio' ),
				'new_item'				=> esc_html__( 'Add New Slides Item', 'portafolio' ),
				'view_item'				=> esc_html__( 'View Item', 'portafolio' ),
				'search_items'			=> esc_html__( 'Search Slides', 'portafolio' ),
				'not_found'				=> esc_html__( 'No slides items found', 'portafolio' ),
				'not_found_in_trash'	=> esc_html__( 'No slides items found in trash', 'portafolio' )
			);
			
			// Define post type args
			$args = array(
				'labels'			=> $labels,
				'public'			=> true,
				'supports'			=> array( 'title', 'thumbnail', 'custom-fields' ),
				'capability_type'	=> 'post',
				'rewrite'			=> array("slug" => "slides"), // Permalinks format
				'has_archive'		=> false,
				'menu_icon'			=> 'dashicons-images-alt2',
			); 
			
			// Apply filters for child theming
			$args = apply_filters( 'wpex_slides_args', $args);
			
			// Register the post type
			register_post_type( 'slides', $args );

		}

		/**
		 * Adds columns in the admin view for thumbnail and taxonomies
		 *
		 * @since   2.0.0
		 * @access  public
		 *
		 */
		public static function edit_cols( $columns ) {
			$slides_columns = array(
				"cb"				=> "<input type=\"checkbox\" />",
				"title"				=> esc_html__( 'Title', 'portafolio' ),
				"slides_thumbnail"	=> esc_html__( 'Thumbnail', 'portafolio' )
			);
			return $slides_columns;
		}

		/**
		 * Adds columns in the admin view for thumbnail and taxonomies
		 *
		 * @since   2.0.0
		 * @access  public
		 */
		public static function cols_display( $slides_columns, $post_id ) {

			switch ( $slides_columns ) {

				// Display the thumbnail in the column view
				case "slides_thumbnail":

					// Get post thumbnail ID
					$thumbnail_id = get_post_thumbnail_id();

					// Display the featured image in the column view if possible
					if ( $thumbnail_id ) {
						$thumb = wp_get_attachment_image( $thumbnail_id, array( '80', '80' ), true );
					}
					if ( isset( $thumb ) ) {
						echo $thumb;
					} else {
						echo '&mdash;';
					}
				
			}

		}

	}

}
new WPEX_Slides_Post_Type;