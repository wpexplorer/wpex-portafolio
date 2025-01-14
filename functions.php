<?php
/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Theme info
function wpex_get_theme_info() {
	return array(
		'name'      => 'Portafolio',
		'dir'       => get_template_directory_uri() .'/inc/',
		'url'       => 'http://www.wpexplorer.com/portafolio-wordpress-theme/',
		'changelog' => 'https://wpexplorer-updates.com/changelog/portafolio/ ',
	);
}

// Main theme class
class WPEX_Portafolio_Theme {

	/**
	 * Main Theme Class Constructor
	 *
	 * @since   1.4.0
	 * @access  public
	 */
	public function __construct() {

		// Updates
		if ( is_admin() ) {
			require_once( get_template_directory() .'/inc/updates.php' );
		}

		// Define Contstants
		self::constants();

		// Include files (functions & classes )
		self::includes();

		// Theme setup: Adds theme-support, image sizes, menus, etc.
		add_action( 'after_setup_theme', array( 'WPEX_Portafolio_Theme', 'setup' ) );

		// Flush rewrite rules on theme switch
		add_action( 'after_switch_theme', array( 'WPEX_Portafolio_Theme', 'flush_rewrite_rules' ) );

		// Load front-end scripts
		add_action( 'wp_enqueue_scripts', array( 'WPEX_Portafolio_Theme', 'enqueue_scripts' ) );

		// Register sidebar widget areas
		add_action( 'widgets_init', array( 'WPEX_Portafolio_Theme', 'register_sidebars' ) );

		// Alters posts per page for specific archives
		add_filter( 'pre_get_posts', array( 'WPEX_Portafolio_Theme', 'posts_per_page' ) );

		// Set default gallery metabox post types
		add_filter( 'wpex_gallery_metabox_post_types', array( 'WPEX_Portafolio_Theme', 'gallery_metabox' ), 1 );

		// Filter the archive title
		add_filter( 'get_the_archive_title', array( 'WPEX_Portafolio_Theme', 'get_the_archive_title' ) );

	}

	/**
	 * Define Constants
	 *
	 * @since   1.4.0
	 * @access  public
	 */
	public static function constants() {
		define( 'WPEX_INCLUDES_DIR', get_template_directory() .'/inc/' );
		define( 'WPEX_CLASSES_DIR', WPEX_INCLUDES_DIR .'/classes/' );
		define( 'WPEX_JS_DIR_URI', get_template_directory_uri(). '/js/' );
		define( 'WPEX_CSS_DIR_URI', get_template_directory_uri(). '/css/' );
	}

	/**
	 * Returns current theme version
	 *
	 * @since   1.4.0
	 * @access  public
	 */
	public static function theme_version() {

		// Get theme data
		$theme = wp_get_theme();

		// Return theme version
		return $theme->get( 'Version' );

	}

	/**
	 * Load required theme functions
	 *
	 * @since   1.4.0
	 * @access  public
	 */
	public static function includes() {

		/** Main Functions **/

			// Image default sizes
			require_once( WPEX_INCLUDES_DIR .'thumbnails.php' );

			// Include Customizer functions
			require_once( WPEX_INCLUDES_DIR .'customizer/general.php');

			// Styling options
			require_once( WPEX_INCLUDES_DIR .'customizer/styling.php');

			// Image size options
			require_once( WPEX_INCLUDES_DIR .'customizer/image-sizes.php' );

			// Comments callback
			require_once( WPEX_INCLUDES_DIR .'comments-callback.php' );

			// Pagination
			require_once( WPEX_INCLUDES_DIR .'pagination.php' );

			// Excerpts
			require_once( WPEX_INCLUDES_DIR .'excerpts.php' );


		/** Classes **/

			// Gallery metabox
			require_once( WPEX_CLASSES_DIR .'gallery-metabox/gallery-metabox.php' );

			// Post Types
			if ( get_theme_mod ( 'wpex_features', true ) ) {
				require_once( WPEX_CLASSES_DIR .'post-types/features.php' );
				require_once( WPEX_INCLUDES_DIR .'meta/meta-features.php' );
			}

			if ( get_theme_mod ( 'wpex_slides', true ) ) {
				require_once( WPEX_CLASSES_DIR .'post-types/slides.php' );
				require_once( WPEX_INCLUDES_DIR .'meta/meta-slides.php' );
			}

			if ( get_theme_mod( 'wpex_portfolio', true ) ) {
				require_once( WPEX_CLASSES_DIR .'post-types/portfolio.php' );
			}

			// Menu walker
			require_once ( WPEX_CLASSES_DIR .'menu-walker.php' );

	}

	/**
	 * Theme Setup
	 *
	 * @since   1.4.0
	 * @access  public
	 */
	public static function setup() {

		// Set content width variable
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 650;
		}

		// Localization support
		load_theme_textdomain( 'portafolio', get_template_directory() .'/languages' );

		// Register navigation menus
		register_nav_menus (
			array(
				'main_menu' => esc_html__( 'Main', 'portafolio' ),
			)
		);
			
		// Add theme support
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'post-thumbnails' );
	}

	/**
	 * Flush rewrite rules on theme switch to prevent 404 errors on built-in post types
	 *
	 * @since   1.4.0
	 * @access  public
	 */
	public static function flush_rewrite_rules() {
		if ( function_exists( 'flush_rewrite_rules' ) ) {
			flush_rewrite_rules();
		}
	}

	/**
	 * Load front-end scripts
	 *
	 * @since   1.4.0
	 * @access  public
	 *
	 * @link	https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
	 */
	public static function enqueue_scripts() {

		wp_enqueue_style( 'style', get_stylesheet_uri() );

		wp_enqueue_style(
			'droid-serif',
			'http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic'
		);

		wp_enqueue_style(
			'font-awesome',
			get_template_directory_uri() .'/css/font-awesome.min.css'
		);
		
		if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
			wp_dequeue_style( 'contact-form-7' );
		}

		/* jQuery */
		wp_enqueue_script(
			'fitvids',
			WPEX_JS_DIR_URI .'fitvids.js',
			array( 'jquery' ),
			false,
			true
		);

		wp_enqueue_script(
			'wpex-magnific-popup',
			WPEX_JS_DIR_URI .'jquery.magnific-popup.min.js',
			array( 'jquery' ),
			false,
			true
		);

		wp_enqueue_script(
			'wpex-global',
			WPEX_JS_DIR_URI .'global.js',
			array( 'jquery', 'wpex-magnific-popup' ),
			false,
			true
		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		wp_localize_script( 'wpex-global', 'wpexParams', array(
			'responsiveMenu' => esc_html__( 'Navigation', 'portafolio' ),
		) );

	}

	/**
	 * Registers sidebars
	 *
	 * @since   1.4.0
	 * @access  public
	 */
	public static function register_sidebars() {

		//sidebar
		register_sidebar( array(
			'name'			=> esc_html__( 'Sidebar', 'portafolio' ),
			'id'			=> 'sidebar',
			'description'	=> esc_html__( 'Widgets in this area are used on the main sidebar region.', 'portafolio' ),
			'before_widget'	=> '<div id="%1$s" class="sidebar-widget %2$s clr">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="heading"><span>',
			'after_title'	=> '</span></h4>',
		) );

		//footer 1
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer 1', 'portafolio' ),
			'id'			=> 'footer-one',
			'description'	=> esc_html__( 'Widgets in this area are used in the footer region.', 'portafolio' ),
			'before_widget'	=> '<div id="%1$s" class="footer-widget widget %2$s clr>',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="heading"><span>',
			'after_title'	=> '</span></h4>',
		) );

		//footer 2
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer 2', 'portafolio' ),
			'id'			=> 'footer-two',
			'description'	=> esc_html__( 'Widgets in this area are used in the footer region.', 'portafolio' ),
			'before_widget'	=> '<div id="%1$s" class="footer-widget widget %2$s clr>',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="heading"><span>',
			'after_title'	=> '</span></h4>',
		) );

		//footer 3
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer 3', 'portafolio' ),
			'id'			=> 'footer-three',
			'description'	=> esc_html__( 'Widgets in this area are used in the footer region.', 'portafolio' ),
			'before_widget'	=> '<div id="%1$s" class="footer-widget widget %2$s clr>',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="heading"><span>',
			'after_title'	=> '</span></h4>',
		) );

		//footer 4
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer 4', 'portafolio' ),
			'id'			=> 'footer-four',
			'description'	=> esc_html__( 'Widgets in this area are used in the footer region.', 'portafolio' ),
			'before_widget'	=> '<div id="%1$s" class="footer-widget widget %2$s clr>',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="heading"><span>',
			'after_title'	=> '</span></h4>',
		) );

	}

	/**
	 * Alters posts per page for specific archives
	 *
	 * @since   1.4.0
	 * @access  public
	 */
	public static function posts_per_page( $query ) {

		// Return if wrong query
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		// Set posts per page for portfolio categories
		if ( is_tax( 'portfolio_category' ) || is_tax( 'portfolio_tag' ) ) {
			$posts_per_page = apply_filters( 'wpex_portfolio_posts_per_page', get_theme_mod( 'wpex_portfolio_posts_per_page', '12' ) );
			$query->set( 'posts_per_page', $posts_per_page );
			return;
		}

	}

	/**
	 * Set default gallery metabox post types
	 *
	 * @since   1.4.0
	 * @access  public
	 */
	public static function gallery_metabox( $types ) {
		$types = array( 'portfolio' );
		return $types;
	}

	/**
	 * Filter the archive title
	 *
	 * @since   1.4.0
	 * @access  public
	 */
	public static function get_the_archive_title( $title ) {
		if ( is_tax() || is_category() ) {
			$title = single_term_title();
		}
		return $title;
	}

}
new WPEX_Portafolio_Theme;
