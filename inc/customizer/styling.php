<?php
// Styling options
if ( ! class_exists( 'WPEX_Theme_Customizer_Styling' ) ) {
	class WPEX_Theme_Customizer_Styling {

		/**
		* This hooks into 'customize_register' (available as of WP 3.4) and allows
		* you to add new sections and controls to the Theme Customize screen.
		*
		* @see		add_action('register',$func)
		* @param	\WP_Customize_Manager $wp_customize
		* @since	1.0.0
		*/
		public static function register ( $wp_customize ) {

				// Theme Design Section
				$wp_customize->add_section( 'wpex_styling' , array(
					'title'		=> __( 'Theme Styling', 'portafolio' ),
					'priority'	=> 999,
				) );

				// Get Color Options
				$color_options = self::wpex_color_options();

				// Loop through color options and add a theme customizer setting for it
				$count='2';
				foreach( $color_options as $option ) {
					$count++;
					$default = isset($option['default']) ? $option['default'] : '';
					$type = isset($option['type']) ? $option['type'] : '';
					$wp_customize->add_setting( 'wpex_'. $option['id'] .'', array(
						'type'		=> 'theme_mod',
						'default'	=> $default,
						'transport'	=> 'refresh',
					) );
					if ( 'text' == $type ) {
						$wp_customize->add_control( 'wpex_'. $option['id'] .'', array(
							'label'		=> $option['label'],
							'section'	=> 'wpex_styling',
							'settings'	=> 'wpex_'. $option['id'] .'',
							'priority'	=> $count,
							'type'		=> 'text',
						) );
					} else {
						$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpex_'. $option['id'] .'', array(
							'label'		=> $option['label'],
							'section'	=> 'wpex_styling',
							'settings'	=> 'wpex_'. $option['id'] .'',
							'priority'	=> $count,
						) ) );
					}
				} // End foreach

		} // End register

		/**
		* This will output the custom styling settings to the live theme's WP head.
		* Used by hook: 'wp_head'
		* 
		* @see	add_action('wp_head',$func)
		* @since	1.0.0
		*/
		public static function header_output() {
			$color_options = self::wpex_color_options();
			$css ='';
			foreach( $color_options as $option ) {
				$theme_mod = get_theme_mod('wpex_'. $option['id'] .'');
				if ( '' != $theme_mod ) {
					if ( !empty( $option['media_query'] ) ) {
						$css .= $option['media_query'] .'{'. $option['element'] .'{ '. $option['style'] .':'. $theme_mod.' !important; } }';
					} else {
						$css .= $option['element'] .'{ '. $option['style'] .':'. $theme_mod.' !important; }';
					}
				}
			}
			if ( ! empty( $css ) ) {
				$css =  preg_replace( '/\s+/', ' ', $css );
				$css = "<!-- Theme Customizer Styling Options -->\n<style type=\"text/css\">\n" . $css . "\n</style>";
				echo $css;
			}
		} // End header_output function

		/**
		* Array of styling options
		* 
		* @since	1.0.0
		*/
		public static function wpex_color_options() {

			$array = array();

			$array[] = array(
				'label'		=> __( 'Header Top Padding (Default: 30px)', 'portafolio' ),
				'id'		=> 'header_top_pad',
				'element'	=> '#masthead',
				'style'		=> 'padding-top',
				'type'		=> 'text',
				'default'	=> '',
			);

			$array[] = array(
				'label'		=> __( 'Header Bottom Padding (Default: 30px)', 'portafolio' ),
				'id'		=> 'header_bottom_pad',
				'element'	=> '#masthead',
				'style'		=> 'padding-bottom',
				'type'		=> 'text',
				'default'	=> '',
			);

			$array[] = array(
				'label'		=> __( 'Header Background Color', 'portafolio' ),
				'id'		=> 'header_bg',
				'element'	=> '#masthead-wrap',
				'style'		=> 'background',
				'default'	=> '',
			);

			$array[] = array(
				'label'		=> __( 'Logo Text Color', 'portafolio' ),
				'id'		=> 'logo_color',
				'element'	=> '#logo h2 a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Menu Link Color', 'portafolio' ),
				'id'		=> 'nav_link_color',
				'element'	=> '#navigation .dropdown-menu > li > a, .mobile-menu-toggle, .wpex-mobile-nav a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Menu Link Hover Color', 'portafolio' ),
				'id'		=> 'nav_link_hover_color',
				'element'	=> '#navigation .dropdown-menu > li > a:hover, .mobile-menu-toggle:hover, .wpex-mobile-nav a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Active Menu Link Color', 'portafolio' ),
				'id'		=> 'nav_link_active_color',
				'element'	=> '#navigation .dropdown-menu > li > a:hover,#navigation .dropdown-menu > li.sfHover > a,#navigation .dropdown-menu > .current-menu-item > a,#navigation .dropdown-menu > .current-menu-item > a:hover ',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Sub-Menu Background', 'portafolio' ),
				'id'		=> 'nav_drop_bg',
				'element'	=> '#navigation .dropdown-menu ul',
				'style'		=> 'background',
			);

			$array[] = array(
				'label'		=> __( 'Sub-Menu Link Color', 'portafolio' ),
				'id'		=> 'nav_drop_link_color',
				'element'	=> '#navigation .dropdown-menu ul > li > a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Sub-Menu Link Hover Color', 'portafolio' ),
				'id'		=> 'nav_drop_link_hover_color',
				'element'	=> '#navigation .dropdown-menu ul > li > a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Mobile Menu Border Color', 'portafolio' ),
				'id'		=> 'mobile_menu_border_color',
				'element'	=> '.wpex-mobile-nav-ul',
				'style'		=> 'border-top-color',
			);

			$array[] = array(
				'label'		=> __( 'Footer Widgets Background', 'portafolio' ),
				'id'		=> 'footer_widgets_bg',
				'element'	=> '#footer-wrap',
				'style'		=> 'background',
			);

			$array[] = array(
				'label'		=> __( 'Footer Widgets Text', 'portafolio' ),
				'id'		=> 'footer_widgets_color',
				'element'	=> 'footer, #footer p',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Footer Widgets Heading', 'portafolio' ),
				'id'		=> 'footer_widgets_headings',
				'element'	=> '#footer h2, #footer h3, #footer h4, #footer h5,  #footer h6, #footer-widgets .widget-title',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Footer Widgets Links', 'portafolio' ),
				'id'		=> 'footer_widgets_links_color',
				'element'	=> '#footer a, #footer-widgets .widget_nav_menu ul > li li a:before',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Footer Widgets Links Hover', 'portafolio' ),
				'id'		=> 'footer_widgets_links_hover_color',
				'element'	=> '#footer a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Footer Widgets Borders', 'portafolio' ),
				'id'		=> 'footer_widgets_borders',
				'element'	=> '.widget_recent_entries li, .widget_categories li, .widget_archive li, widget_meta li, .wpex-taxonomies-widget li, .wpex-recent-post-types-widget li, .widget_pages li, .widget_links li, .widget_twitter li, .widget_nav_menu li, .widget_recent_comments li,#footer .widget_recent_entries ul, #footer .widget_categories ul, #footer .widget_archive ul, .widget_meta ul, #footer .wpex-taxonomies-widget ul, #footer .wpex-recent-post-types-widget ul, #footer .widget_pages ul, #footer .widget_links ul, #footer .widget_twitter ul, #footer .widget_nav_menu ul, #footer .widget_recent_comments ul',
				'style'		=> 'border-color',
			);

			$array[] = array(
				'label'		=> __( 'Copyright Backgorund', 'portafolio' ),
				'id'		=> 'copyright_bg',
				'element'	=> '#copyright-wrap',
				'style'		=> 'background-color',
			);

			$array[] = array(
				'label'		=> __( 'Copyright Top Border', 'portafolio' ),
				'id'		=> 'copyright_top_border',
				'element'	=> '#copyright-wrap',
				'style'		=> 'border-top-color',
			);

			$array[] = array(
				'label'		=> __( 'Copyright Color', 'portafolio' ),
				'id'		=> 'copyright_color',
				'element'	=> '#copyright-wrap, #copyright-wrap p',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Copyright Link Color', 'portafolio' ),
				'id'		=> 'copyright_link_color',
				'element'	=> '#copyright-wrap a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Heading Title Hover Color', 'portafolio' ),
				'id'		=> 'heading_title_hover_color',
				'element'	=> 'h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Link Color', 'portafolio' ),
				'id'		=> 'link_color',
				'element'	=> '.single .entry a, #sidebar a, .comment-meta a.url, .logged-in-as a, .meta a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Link Hover Color', 'portafolio' ),
				'id'		=> 'link_hover_color',
				'element'	=> '.single .entry a:hover, #sidebar a:hover, .comment-meta a.url:hover, .logged-in-as a:hover, .meta a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Sidebar Link Color', 'portafolio' ),
				'id'		=> 'sidebar_link_color',
				'element'	=> '.sidebar-container a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Sidebar Link Hover Color', 'portafolio' ),
				'id'		=> 'sidebar_link_hover_color',
				'element'	=> '.sidebar-container a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Theme Button Color', 'portafolio' ),
				'id'		=> 'theme_button_color',
				'element'	=> '.theme-button, input[type="button"], input[type="submit"], .page-numbers a:hover, .page-numbers.current, .page-links span, .page-links a:hover span, .sidebar-container .tagcloud a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Theme Button Background', 'portafolio' ),
				'id'		=> 'theme_button_bg',
				'element'	=> '.theme-button, input[type="button"], input[type="submit"], .page-numbers a:hover, .page-numbers.current, .page-links span, .page-links a:hover span, .sidebar-container .tagcloud a',
				'style'		=> 'background',
			);

			$array[] = array(
				'label'		=> __( 'Theme Button Hover Color', 'portafolio' ),
				'id'		=> 'theme_button_hover_color',
				'element'	=> '.theme-button:hover, input[type="button"]:hover, input[type="submit"]:hover, .sidebar-container .tagcloud a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Theme Button Hover Background', 'portafolio' ),
				'id'		=> 'theme_button_hover_bg',
				'element'	=> '.theme-button:hover, input[type="button"]:hover, input[type="submit"]:hover, .sidebar-container .tagcloud a:hover',
				'style'		=> 'background-color',
			);

			// Apply filters for child theming magic
			$array = apply_filters( 'wpex_color_options_array', $array );

			// Return array
			return $array;
		}

	} // End Theme_Customizer_Styling Class
}


// Setup the Theme Customizer settings and controls
add_action( 'customize_register' , array( 'WPEX_Theme_Customizer_Styling' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'WPEX_Theme_Customizer_Styling' , 'header_output' ) );