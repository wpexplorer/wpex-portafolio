<?php
/**
 * Template Name: Portfolio
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */

get_header(); ?>

	<div id="primary" class="content-area clr">

		<div id="content" class="site-content" role="main">
			
			<div id="page-header-wrap">

				<header id="page-header" class="container clr">
					<h1 class="page-header-title"><?php the_title(); ?></h1>
				</header><!-- #page-header -->

			</div><!-- #page-header-wrap -->
			
			<?php
			// Make sure $paged var is correct
			global $post, $paged, $more;
			$more = 0;
			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' );
			} else if ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' );
			} else {
				$paged = 1;
			}

			// Posts Per page
			$ppp      = get_theme_mod( 'wpex_portfolio_posts_per_page' );
			$ppp_meta = get_post_meta( get_the_ID(), 'wpex_posts_per_page', true );
			$ppp      = $ppp_meta ? $ppp_meta : $ppp;
			$ppp      = $ppp ? $ppp : 12;

			// Query posts
			$wpex_query = new WP_Query( array(
				'post_type'      => 'portfolio',
				'posts_per_page' => $ppp,
				'paged'          => $paged,
			) );
			if ( $wpex_query->posts ) : ?>

				<div class="portfolio-entries container clr">

					<?php
					$wpex_count=0;
					// Loop through posts
					foreach( $wpex_query->posts as $post ) : setup_postdata( $post );
						$wpex_count++;
						get_template_part( 'content', 'portfolio' );
						if ( $wpex_count == '4' ) {
							$wpex_count=0;
						}
					endforeach; ?>

				</div><!-- .portfolio-entries -->

				<?php wpex_pagination( $wpex_query ); ?>

			<?php endif; ?>

		</div><!-- #content -->

	</div><!-- #primary -->
	
<?php get_footer(); ?>