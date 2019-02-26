<?php
// General theme options
function wpex_customizer_image_sizes( $wp_customize ) {

	$desc = esc_html__( 'By default this theme does not crop any images so you can customize your settings first and prevent unnecessary image cropping. Below you will find all the settings needed to crop the images on your site. Be sure to install a regenerate plugin so you can regenerate your thumbnails whenever you alter these values.', 'portafolio' );

	// Add Panel
	$wp_customize->add_panel( 'wpex_image_sizes', array(
		'title'		  => __( 'Image Sizes', 'portafolio' ),
		'priority'	  => 300,
		'capability'  => 'edit_theme_options',
		'description' => $desc,
	) );

	$image_sizes             = array();
	$get_image_sizes         = wpex_get_image_sizes();
	$crop_locations          = wpex_get_image_crop_locations();
	$crop_locations['false'] = esc_html__( 'False', 'portafolio' );
	$desc = esc_html__( 'If you alter any image sizes you will have to regenerate your thumbnails via a 3rd party plugin.', 'portafolio' );
	foreach ( $get_image_sizes as $id => $label ) {

		// Add prefix to ID
		$id = 'wpex_'. $id;

		// Add Section
		$section = $id .'_image_sizes';
		$wp_customize->add_section( $section, array(
			'title'       => $label,
			'priority'    => 300,
			'description' => $desc,
			'panel'       => 'wpex_image_sizes',
		) );

		// Add Width
		$wp_customize->add_setting( $id .'_thumb_width', array(
			'type'              => 'theme_mod',
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( $id .'_thumb_width', array(
			'label'		=> __( 'Width', 'portafolio' ),
			'section'	=> $section,
			'settings'	=> $id .'_thumb_width',
			'type'		=> 'text',
		) );

		// Add Height
		$wp_customize->add_setting( $id .'_thumb_height', array(
			'type'		        => 'theme_mod',
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( $id .'_thumb_height', array(
			'label'		=> __( 'Height', 'portafolio' ),
			'section'	=> $section,
			'settings'	=> $id .'_thumb_height',
			'type'		=> 'text',
		) );

		// Add Crop
		$wp_customize->add_setting( $id .'_thumb_crop', array(
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_html',
			'default'           => 'center-center',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( $id .'_thumb_crop', array(
			'label'    => __( 'Crop', 'portafolio' ),
			'section'  => $section,
			'settings' => $id .'_thumb_crop',
			'type'     => 'select',
			'choices'  => $crop_locations,
		) );

	}

}
add_action( 'customize_register', 'wpex_customizer_image_sizes' );