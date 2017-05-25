<?php
/**
 * The Template for displaying your single portfolio posts
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */
 
get_header(); ?>

	<div id="primary" class="content-area clr">
		<div id="content" class="site-content" role="main">
			<div class="container clr">
				
				<article id="single-portfolio-post" class="clr"> 
					
					<?php if ( have_posts() ) :
						
						while ( have_posts() ) : the_post(); ?>
							
							<div id="single-portfolio-info" class="entry clr <?php if ( wpex_get_gallery_ids() ) echo 'span_1_of_3 col col-1'; ?>">
								<header id="single-portfolio-title" class="clr"><h1><?php the_title(); ?></h1></header>
								<?php the_content(); ?>
							</div>
							
							<div id="single-portfolio-media" class="clr col span_2_of_3">
								<?php get_template_part( 'content', 'portfolio' ); ?>
							</div>

						<?php endwhile; ?>

						<div class="clr"></div>
						
						<div id="single-portfolio-comments" class="clr"><?php comments_template(); ?></div>

					<?php endif; ?>

					<?php
					// Related Posts
					$related_query = new WP_Query( array(
						'orderby'        => 'rand',
						'post_type'      => 'portfolio',
						'posts_per_page' => get_theme_mod( 'wpex_related_portfolio_count', '4' ),
						'no_found_rows'  => true,
					) );
					if ( $related_query->posts ) : ?>

						<div class="clear"></div>

						<div id="single-portfolio-related" class="clr">
							<h3 class="heading"><span><?php _e( 'Similar Work', 'portafolio' ); ?></span></h3>
							<div class="grid-container">
								<?php $wpex_count=0; ?>
								<?php foreach( $related_query->posts as $post ) : setup_postdata($post); ?>
									<?php $wpex_count++; ?>
										<?php get_template_part( 'content', 'portfolio' ); ?>
									<?php if ( $wpex_count == '4' ) $wpex_count=0; ?>
								<?php endforeach; ?>
							</div>
						</div>

					<?php endif; ?>

					<?php wp_reset_postdata(); ?>

				</article>

			</div>

		</div>

	</div>
	
<?php get_footer(); ?>