<?php
/**
 * The default template for displaying features content.
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>
	
<?php global $wpex_count; ?>

<?php $wpex_post_url = get_post_meta( get_the_ID(), 'wpex_post_url', true ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'features-entry clr span_1_of_3 col col-'. $wpex_count . '' ); ?>>
	
	<?php if ( $wpex_post_url ) { ?>
    	<a href="<?php echo esc_url( $wpex_post_url ); ?>" target="_<?php echo get_post_meta( get_the_ID(), 'wpex_post_url_target', true ); ?>" class="features-entry-thumbnail-link">
    <?php } ?>

		<?php if ( has_post_thumbnail() ) { ?>
            <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" class="features-entry-thumbnail" />
        <?php } ?>

    <?php if ( $wpex_post_url ) echo '</a>'; ?>

	<header class="post-heading">
		<h3><?php the_title(); ?></h3>
	</header>

	<div class="features-entry-content clr"><?php the_content(); ?></div>

</article>