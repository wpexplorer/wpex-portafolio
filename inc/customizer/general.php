<?php
// General theme options
function wpex_customizer_general( $wp_customize ) {

	// Theme Settings Section
	$wp_customize->add_section( 'wpex_general' , array(
		'title'		=> esc_html__( 'Theme Settings', 'portafolio' ),
		'priority'	=> 240,
	) );

	// Logo Image
	$wp_customize->add_setting( 'wpex_logo', array(
		'type'	=> 'theme_mod',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpex_logo', array(
		'label'		=> esc_html__( 'Image Logo', 'portafolio' ),
		'section'	=> 'wpex_general',
		'settings'	=> 'wpex_logo',
	) ) );

	// Slides
	$wp_customize->add_setting( 'wpex_slides', array(
		'type'		=> 'theme_mod',
		'default'	=> '1',
	) );

	$wp_customize->add_control( 'wpex_slides', array(
		'label'		=> esc_html__( 'Slides Post Type', 'portafolio' ),
		'section'	=> 'wpex_general',
		'settings'	=> 'wpex_slides',
		'type'		=> 'checkbox',
	) );

	// Features
	$wp_customize->add_setting( 'wpex_features', array(
		'type'		=> 'theme_mod',
		'default'	=> '1',
	) );

	$wp_customize->add_control( 'wpex_features', array(
		'label'		=> esc_html__( 'Features Post Type', 'portafolio' ),
		'section'	=> 'wpex_general',
		'settings'	=> 'wpex_features',
		'type'		=> 'checkbox',
	) );

	// Portfolio
	$wp_customize->add_setting( 'wpex_portfolio', array(
		'type'		=> 'theme_mod',
		'default'	=> '1',
	) );

	$wp_customize->add_control( 'wpex_portfolio', array(
		'label'		=> esc_html__( 'Portfolio Post Type', 'portafolio' ),
		'section'	=> 'wpex_general',
		'settings'	=> 'wpex_portfolio',
		'type'		=> 'checkbox',
	) );

	$wp_customize->add_setting( 'wpex_portfolio_page', array(
		'type'    => 'theme_mod',
		'default' => '1',
	) );

	$wp_customize->add_control( 'wpex_portfolio_page', array(
		'label'		  => esc_html__( 'Portfolio Page', 'portafolio' ),
		'section'	  => 'wpex_general',
		'settings'	  => 'wpex_portfolio_page',
		'type'		  => 'dropdown-pages',
		'description' =>  esc_html__( 'Used for the homepage browse all link.', 'portafolio' ),
	) );

	// Homepage Portfolio Title
	$wp_customize->add_setting( 'wpex_home_portfolio_title', array(
		'type'		=> 'theme_mod',
		'default'	=> esc_html__( 'Recent Work', 'portafolio' ),
	) );

	$wp_customize->add_control( 'wpex_home_portfolio_title', array(
		'label'		=> esc_html__( 'Homepage Portfolio Title', 'portafolio' ),
		'section'	=> 'wpex_general',
		'settings'	=> 'wpex_home_portfolio_title',
		'type'		=> 'text',
	) );

	// Homepage Portfolio Count
	$wp_customize->add_setting( 'wpex_home_portfolio_count', array(
		'type'		=> 'theme_mod',
		'default'	=> '8',
	) );

	$wp_customize->add_control( 'wpex_home_portfolio_count', array(
		'label'		=> esc_html__( 'Homepage Portfolio Count', 'portafolio' ),
		'section'	=> 'wpex_general',
		'settings'	=> 'wpex_home_portfolio_count',
		'type'		=> 'number',
	) );

	// Portfolio Archive Posts Per Page
	$wp_customize->add_setting( 'wpex_portfolio_posts_per_page', array(
		'type'		=> 'theme_mod',
		'default'	=> '12',
	) );

	$wp_customize->add_control( 'wpex_portfolio_posts_per_page', array(
		'label'		=> esc_html__( 'Portfolio Archive Posts Per Page', 'portafolio' ),
		'section'	=> 'wpex_general',
		'settings'	=> 'wpex_portfolio_posts_per_page',
		'type'		=> 'number',
	) );

	// Related Portfolio Count
	$wp_customize->add_setting( 'wpex_related_portfolio_count', array(
		'type'		=> 'theme_mod',
		'default'	=> '4',
	) );

	$wp_customize->add_control( 'wpex_related_portfolio_count', array(
		'label'		=> esc_html__( 'Related Portfolio Count', 'portafolio' ),
		'section'	=> 'wpex_general',
		'settings'	=> 'wpex_related_portfolio_count',
		'type'		=> 'number',
	) );

	// Blog Auto Excerpts
	$wp_customize->add_setting( 'wpex_blog_excerpt', array(
		'type'		=> 'theme_mod',
		'default'	=> '1',
	) );

	$wp_customize->add_control( 'wpex_blog_excerpt', array(
		'label'		=> esc_html__( 'Auto Blog Entry Excerpt', 'portafolio' ),
		'section'	=> 'wpex_general',
		'settings'	=> 'wpex_blog_excerpt',
		'type'		=> 'checkbox',
	) );

	// Copyright
	$wp_customize->add_setting( 'wpex_copyright', array(
		'type'		=> 'theme_mod',
		'default'	=> 'Portafolio <a href="http://www.wpexplorer.com/" title="WordPress Theme" target="_blank">WordPress Theme</a> Designed &amp; Developed by <a href="http://themeforest.net/user/WPExplorer?ref=WPExplorer" target="_blank" title="WPExplorer">WPExplorer</a>',
	) );

	$wp_customize->add_control( 'wpex_copyright', array(
		'label'		=> esc_html__( 'Custom Copyright', 'portafolio' ),
		'section'	=> 'wpex_general',
		'settings'	=> 'wpex_copyright',
		'type'		=> 'textarea',
	) );
	
}
add_action( 'customize_register', 'wpex_customizer_general' );