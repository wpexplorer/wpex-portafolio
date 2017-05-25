<?php
/**
 * This file is used for your portfolio entries.
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

// Get related query
global $related_query;

/* Single Posts
-------------------------------------------------------------------------------*/
if ( is_singular( 'portfolio' ) && ! $related_query ) {
	
	// Get gallery images
	$attachments = wpex_get_gallery_ids();
	
	// Display slider if there are images saved in the DB
	if ( $attachments ) :
		
		// Check if lightbox is enabled
		$has_lightbox = wpex_gallery_is_lightbox_enabled();
		
		// Load slider scripts
		wp_deregister_script( 'flexslider' ); // prevent conflicts
		wp_enqueue_script( 'flexslider', WPEX_JS_DIR_URI .'flexslider.js', array( 'jquery' ), '2', true ); ?>
		
		<div class="portfolio-post-slider-wrap clr">
			<div id="portfolio-post-slider" class="flexslider-container">
				<div class="flexslider loading">
					<ul class="slides <?php if ( $has_lightbox == 'on' ) echo 'wpex-gallery-lightbox'; ?>">
						<?php
						// Loop through each attachment ID
						foreach ( $attachments as $attachment ) :
							// Get image alt tag
							if ( get_post( $attachment ) ) : ?>
								<li class="slide">
									<?php
									// Display image with lightbox
									if ( 'on' == $has_lightbox ) { ?>
										<a href="<?php echo wp_get_attachment_url( $attachment ); ?>"><?php echo wp_get_attachment_image( $attachment, 'wpex_portfolio_post' ); ?></a>
									<?php }
									// Lightbox is disabled, only show image
									else {
										echo wp_get_attachment_image( $attachment, 'wpex_portfolio_post' );
								   } ?>
							</li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>

	<?php endif;

/* Entries
-------------------------------------------------------------------------------*/
} else {

	// Get counter
	global $wpex_count; ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-entry clr span_1_of_4 col col-'. $wpex_count . ''); ?>>
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" class="portfolio-entry-link">
				<?php the_post_thumbnail( 'wpex_portfolio_entry' ); ?>
			</a>
		<?php endif; ?>
	</article>

<?php }