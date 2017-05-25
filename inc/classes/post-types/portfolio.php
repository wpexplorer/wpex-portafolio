<?php
/**
 * Registers the "Portfolio" custom post type
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */

if ( ! class_exists( 'WPEX_Portfolio_Post_Type' ) ) {

	class WPEX_Portfolio_Post_Type {

		/**
		 * Class Constructor
		 *
		 * @since   2.0.0
		 * @access  public
		 */
		public function __construct() {

			// Adds image sizes for portfolio items
			add_action( 'after_setup_theme', array( 'WPEX_Portfolio_Post_Type', 'image_sizes' ) );

			// Adds the portfolio post type and taxonomies
			add_action( 'init', array( 'WPEX_Portfolio_Post_Type', 'register' ), 0 );

			// Thumbnail support for portfolio posts
			add_theme_support( 'post-thumbnails', array( 'portfolio' ) );

			// Adds columns in the admin view for thumbnail and taxonomies
			add_filter( 'manage_edit-portfolio_columns', array( 'WPEX_Portfolio_Post_Type', 'edit_cols' ) );
			add_action( 'manage_posts_custom_column', array( 'WPEX_Portfolio_Post_Type', 'cols_display' ), 10, 2 );

			// Allows filtering of posts by taxonomy in the admin view
			add_action( 'restrict_manage_posts', array( 'WPEX_Portfolio_Post_Type', 'tax_filters' ) );

			// Enable the gallery metabox for portfolio items
			add_filter( 'wpex_gallery_metabox_post_types', array( 'WPEX_Portfolio_Post_Type', 'gallery_metabox' ) );

		}

		/**
		 * Adds image sizes for portfolio items
		 *
		 * @since   2.0.0
		 * @access  public
		 *
		 * @link	http://codex.wordpress.org/Function_Reference/add_image_size
		 */
		public static function image_sizes() {
			add_image_size( 'wpex-portfolio-entry', 400, 340, true );
			add_image_size( 'wpex-portfolio-post', 9999, 9999, false );
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
				'name'                  => esc_html__( 'Portfolio', 'portafolio' ),
				'singular_name'         => esc_html__( 'Portfolio Item', 'portafolio' ),
				'add_new'               => esc_html__( 'Add New', 'portafolio' ),
				'add_new_item'          => esc_html__( 'Add New Item', 'portafolio' ),
				'edit_item'             => esc_html__( 'Edit Item', 'portafolio' ),
				'new_item'              => esc_html__( 'Add New Item', 'portafolio' ),
				'view_item'             => esc_html__( 'View Item', 'portafolio' ),
				'search_items'          => esc_html__( 'Search Items', 'portafolio' ),
				'not_found'             => esc_html__( 'No Items Found', 'portafolio' ),
				'not_found_in_trash'    => esc_html__( 'No Items Found In Trash', 'portafolio' )
			);
			
			// Define post type args
			$args = array(
				'labels'			=> $labels,
				'public'			=> true,
				'supports'			=> array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields', 'revisions', 'post-formats' ),
				'capability_type'	=> 'post',
				'rewrite'			=> array(
					'slug' => 'portfolio-item',
				),
				'has_archive'		=> false,
				'menu_icon'			=> 'dashicons-portfolio',
			);
			
			// Apply filters for child theming
			$args = apply_filters( 'wpex_portfolio_args', $args);
			
			// Register the post type
			register_post_type( 'portfolio', $args );

			// Define portfolio category taxonomy labels
			$labels = array(
				'name'                       => esc_html__( 'Categories', 'portafolio' ),
				'singular_name'              => esc_html__( 'Category', 'portafolio' ),
				'menu_name'                  => esc_html__( 'Categories', 'portafolio' ),
				'search_items'               => esc_html__( 'Search','portafolio' ),
				'popular_items'              => esc_html__( 'Popular', 'portafolio' ),
				'all_items'                  => esc_html__( 'All', 'portafolio' ),
				'parent_item'                => esc_html__( 'Parent', 'portafolio' ),
				'parent_item_colon'          => esc_html__( 'Parent', 'portafolio' ),
				'edit_item'                  => esc_html__( 'Edit', 'portafolio' ),
				'update_item'                => esc_html__( 'Update', 'portafolio' ),
				'add_new_item'               => esc_html__( 'Add New', 'portafolio' ),
				'new_item_name'              => esc_html__( 'New', 'portafolio' ),
				'separate_items_with_commas' => esc_html__( 'Separate with commas', 'portafolio' ),
				'add_or_remove_items'        => esc_html__( 'Add or remove', 'portafolio' ),
				'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'portafolio' ),
			);

			// Define portfolio category taxonomy args
			$args = array(
				'labels'			=> $labels,
				'public'			=> true,
				'show_in_nav_menus'	=> true,
				'show_ui'			=> true,
				'show_tagcloud'		=> true,
				'hierarchical'		=> true,
				'rewrite'			=> array( 'slug' => 'portfolio-category' ),
				'query_var'			=> true
			);

			// Apply filters for child theming
			$args = apply_filters( 'wpex_portfolio_category_args', $args );
			
			// Register the portfolio_category taxonomy
			register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );

		}

		/**
		 * Adds columns in the admin view for thumbnail and taxonomies
		 *
		 * @since   2.0.0
		 * @access  public
		 *
		 */
		public static function edit_cols( $columns ) {
			$columns['portfolio_thumbnail']	= esc_html__( 'Thumbnail', 'portafolio' );
			$columns['portfolio_category']	= esc_html__( 'Category', 'portafolio' );
			return $columns;
		}

		/**
		 * Adds columns in the admin view for thumbnail and taxonomies
		 *
		 * @since   2.0.0
		 * @access  public
		 */
		public static function cols_display( $portfolio_columns, $post_id ) {

			switch ( $portfolio_columns ) {

				// Display the thumbnail in the column view
				case "portfolio_thumbnail":

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

				break;	

				// Display the portfolio tags in the column view
				case "portfolio_category":

					if ( $category_list = get_the_term_list( $post_id, 'portfolio_category', '', ', ', '' ) ) {
						echo $category_list;
					} else {
						echo '&mdash;';
					}

				break;	
		
			}
		}

		/**
		 * Adds taxonomy filters to the portfolio admin page
		 *
		 * @since   2.0.0
		 * @access  public
		 */
		public static function tax_filters() {
			
			global $typenow;

			// An array of all the taxonomyies you want to display. Use the taxonomy name or slug
			$taxonomies = array( 'portfolio_category' );

			// must set this to the post type you want the filter(s) displayed on
			if ( $typenow == 'portfolio' ) {

				foreach ( $taxonomies as $tax_slug ) {
					$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
					$tax_obj = get_taxonomy( $tax_slug );
					$tax_name = $tax_obj->labels->name;
					$terms = get_terms($tax_slug);
					if ( count( $terms ) > 0) {
						echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
						echo "<option value=''>$tax_name</option>";
						foreach ( $terms as $term ) {
							echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' ( ' . $term->count .')</option>';
						}
						echo "</select>";
					}
				}
			}
		}

		/**
		 * Enable the gallery metabox for portfolio items
		 *
		 * @since   2.0.0
		 * @access  public
		 *
		 */
		public static function gallery_metabox( $types ) {

			// Enable for portfolio
			$types[] = 'portfolio';

			// Return types
			return $types;

		}

	}
}
new WPEX_Portfolio_Post_Type;