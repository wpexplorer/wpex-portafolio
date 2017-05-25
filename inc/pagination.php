<?php
/**
 * Custom pagination functions
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */
 
if ( ! function_exists( 'wpex_pagination' ) ) {
	
	function wpex_pagination( $query = '' ) {
		
		$prev_arrow = is_rtl() ? 'fa fa-angle-right' : 'fa fa-angle-left';
		$next_arrow = is_rtl() ? 'fa fa-angle-left' : 'fa fa-angle-right';
		
		global $wp_query;
		$wp_query = $query ? $query : $wp_query;
		$total = $wp_query->max_num_pages;
		$big = 999999999; // need an unlikely integer

		if ( $total > 1 )  {

			 if ( ! $current_page = get_query_var( 'paged' ) ) {
				 $current_page = 1;
			}
			if ( get_option('permalink_structure') ) {
				$format = 'page/%#%/';
			} else {
				$format = '&paged=%#%';
			}

			echo paginate_links( array(
				'base'		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'	=> $format,
				'current'	=> max( 1, get_query_var('paged') ),
				'total' 	=> $total,
				'mid_size'	=> 3,
				'type' 		=> 'list',
				'prev_text' => '<i class="'. $prev_arrow .'"></i>',
				'next_text' => '<i class="'. $next_arrow .'"></i>',
			) );

		}
	}
	
}