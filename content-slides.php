<?php
/**
 * This file is used for your homepage slides
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

// Start Query
$query_slides = new WP_Query( array(
	'post_type'      => 'slides',
	'posts_per_page' => '-1',
	'no_found_rows'  => true,
) );

// If Slides exist display them
if ( $query_slides->posts ) :

	// Load slider script
	wp_enqueue_script( 'flexslider', WPEX_JS_DIR_URI .'/flexslider.js', array( 'jquery' ), '2', true ); ?>
	
	<div id="home-slider-wrap">
		<div id="home-slider" class="flexslider clr loading">
			<ul class="slides">

				<?php
				// Loop throught slides
				foreach( $query_slides->posts as $post ) : setup_postdata( $post );

				// Display slide
				if ( has_post_thumbnail() || get_post_meta( get_the_ID(), 'wpex_slides_video', true ) ) : ?>
					
					<li>
						<div class="slide-inner fitvids">
							<?php
							// Display video
							if ( $video = get_post_meta( get_the_ID(), 'wpex_slides_video', true ) ) {
								echo wp_oembed_get( $video );
							}
							// Display Image
							else {
								// Image with link
								if ( $url = get_post_meta( get_the_ID(), 'wpex_slides_url', true ) ) { ?>
									<a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" target="_<?php echo get_post_meta( get_the_ID(), 'wpex_slides_url_target', true ); ?>">
										<?php the_post_thumbnail( 'wpex_home_slider' ); ?>
									</a>
								<?php
								// Just image
								} else {
									the_post_thumbnail( 'wpex_home_slider' );
								} ?>
							<?php } ?>
						</div>
					</li>

				<?php endif; ?>

				<?php
				// End loop
				endforeach;

				// Reset postdata
				wp_reset_postdata(); ?>

			</ul>
		</div>
	</div>

<?php endif; ?>