<?php
/**
 * Template Name: Homepage
 *
 *
 * Custom template used for this theme's homepage display
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */

get_header(); ?>

	<div id="primary" class="content-area clr">
		<div id="content" class="site-content" role="main">
			<div id="home-wrap" class="clr">
				
				<?php
				/**************************
				* Slider
				****************************/
				get_template_part( 'content','slides' );  ?>
				
				<?php
				/**************************
				* Features
				****************************/ ?>
				<?php $wpex_query = new WP_Query(
					array(
						'post_type'      => 'features',
						'posts_per_page' => -1,
						'no_found_rows'  => true,
					)
				);
				if ( $wpex_query->posts ) { ?>
					<div id="home-features">
						<div id="features-wrap" class="clr row clr">
							<?php $wpex_count=0; ?>
							<?php foreach( $wpex_query->posts as $post ) : setup_postdata($post); ?>
								<?php $wpex_count++; ?>
									<?php get_template_part( 'content','features' ); ?>
								<?php if ( $wpex_count == 3 ) { ?>
									<?php $wpex_count=0; ?>
								<?php } ?>
							<?php endforeach; ?>
						</div><!-- #features-wrap -->
					</div><!-- #home-features -->
				<?php } ?>
				<?php wp_reset_postdata(); ?>
				
				<?php
				/**************************
				* Portfolio
				****************************/ ?>
				<?php
				$portfolio_count = get_theme_mod( 'wpex_home_portfolio_count', '8' );
				if ( $portfolio_count && $portfolio_count > 0 ) :
					$wpex_query = new WP_Query( array(
						'post_type'      => 'portfolio',
						'posts_per_page' => $portfolio_count,
						'no_found_rows'  => true,
					) );
					if ( $wpex_query->posts ) { ?>
						<div id="home-portfolio" class="clr">
							<?php if( get_theme_mod( 'wpex_home_portfolio_title', 'portafolio' ) ) { ?>
								<h2 class="heading"><?php echo get_theme_mod( 'wpex_home_portfolio_title', __( 'Recent Work', 'portafolio' ) ); ?></h2>
							<?php } ?>
							<div id="home-portfolio-entries" class="clr">
								<?php $wpex_count=0; ?>
								<?php foreach( $wpex_query->posts as $post ) : setup_postdata($post); ?>
									<?php $wpex_count++; ?>
										<?php get_template_part( 'content', 'portfolio' ); ?>
									<?php if ( $wpex_count == '4' ) { ?>
										<?php $wpex_count=0; ?>
									<?php } ?>
								<?php endforeach; ?>
							</div><!-- #home-portfolio-entries -->
							<?php
							// Check for portfolio page
							$portfolio_page = get_theme_mod( 'wpex_portfolio_page' );
							if ( $portfolio_page ) : ?>
								<div id="home-portfolio-view-all" class="clr">
									<a href="<?php echo get_permalink( $portfolio_page ); ?>" title="<?php _e( 'Browse all', 'portafolio'); ?>"><?php _e( 'Browse all', 'portafolio'); ?></a>
								</div><!-- #home-portfolio-view-all -->
							<?php endif; ?>
						</div><!-- #home-portfolio -->
					<?php } ?>
					<?php wp_reset_postdata();
					endif; ?>
			</div><!-- /home-wrap -->
		</div><!-- #content -->
	</div><!-- #primary -->
	
<?php get_footer(); ?>