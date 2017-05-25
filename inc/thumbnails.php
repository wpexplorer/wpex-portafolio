<?php
// Define image sizes
function wpex_get_image_sizes() {
	return apply_filters( 'wpex_get_image_sizes', array(
		'home_slider'     => esc_html__( 'Slider', 'portafolio' ),
		'entry'           => esc_html__( 'Entry', 'portafolio' ),
		'post'            => esc_html__( 'Post', 'portafolio' ),
		'portfolio_entry' => esc_html__( 'Portfolio Entry', 'portafolio' ),
		'portfolio_post'  => esc_html__( 'Portfolio Post', 'portafolio' ),
	) );
}

// Crop locations
function wpex_get_image_crop_locations() {
	return array(
		'left-top'      => esc_html__( 'Top Left', 'portafolio' ),
		'right-top'     => esc_html__( 'Top Right', 'portafolio' ),
		'center-top'    => esc_html__( 'Top Center', 'portafolio' ),
		'left-center'   => esc_html__( 'Center Left', 'portafolio' ),
		'right-center'  => esc_html__( 'Center Right', 'portafolio' ),
		'center-center' => esc_html__( 'Center Center', 'portafolio' ),
		'left-bottom'   => esc_html__( 'Bottom Left', 'portafolio' ),
		'right-bottom'  => esc_html__( 'Bottom Right', 'portafolio' ),
		'center-bottom' => esc_html__( 'Bottom Center', 'portafolio' ),
	);
}

// Parse crop locations
function wpex_parse_image_crop( $crop = 'true' ) {
	$return = true;
	if ( 'false' == $crop ) {
		return false;
	}
	if ( $crop && is_string( $crop ) && array_key_exists( $crop, wpex_get_image_crop_locations() ) ) {
		$return = explode( '-', $crop );
	}
	$return = $return ? $return : false; // default is false
	return $return;
}

// Register image sizes
function wpex_add_image_sizes() {
	$get_image_sizes = wpex_get_image_sizes();
	if ( ! empty( $get_image_sizes ) ) {
		foreach ( $get_image_sizes as $size => $label ) {
			$size = 'wpex_'. $size;
			add_image_size(
				$size,
				get_theme_mod( $size .'_thumb_width', '9999' ),
				get_theme_mod( $size .'_thumb_height', '9999' ),
				wpex_parse_image_crop( get_theme_mod( $size .'_thumb_crop', 'center-center' ) )
			);
		}
	}
}
add_action( 'after_setup_theme', 'wpex_add_image_sizes' );