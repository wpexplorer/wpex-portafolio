<?php
/**
 * Custom excerpts based on wp_trim_words
 * Created for child-theming purposes
 * 
 * Learn more at http://codex.wordpress.org/Function_Reference/wp_trim_words
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */

// Custom excerpt function
if ( ! function_exists( 'wpex_excerpt' ) ) :
	function wpex_excerpt($length=30, $readmore=false ) {
		global $post;
		$id = $post->ID;
		$meta_excerpt = get_post_meta( $id, 'wpex_excerpt_length', true );
		$length = $meta_excerpt ? $meta_excerpt : $length;	
		if ( has_excerpt( $id ) ) {
			$output = apply_filters( 'the_content', $post->post_excerpt );
		} else {
			$output = '<p>'. wp_trim_words( strip_shortcodes( get_the_content( $id ) ), $length ) .'</p>';
			if ( $readmore == true ) {
				$readmore_link = '<a href="'. get_permalink( $id ) .'" title="'. __('continue reading', 'portafolio' ) .'" rel="bookmark" class="readmore-link">'. __('continue reading', 'portafolio' ) .' &rarr;</a>';
				$output .= apply_filters( 'wpex_readmore_link', $readmore_link );
			}
		}
		echo $output;
	}
endif;

// Change default read more style
if ( ! function_exists( 'wpex_excerpt_more' ) ) :
	function wpex_excerpt_more($more) {
		global $post;
		return '...';
	}
	add_filter('excerpt_more', 'wpex_excerpt_more');
endif;