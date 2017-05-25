<?php
/**
 * The Template for displaying all single posts.
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
				<?php while ( have_posts() ) : the_post(); ?>
					<div id="post" class="col col-1 span_3_of_4 clr">
						<?php get_template_part( 'content', get_post_format() ); ?>
					</div>
				<?php endwhile; ?>
				<?php get_sidebar(); ?>
			</div>
			
		</div>
	</div>
	
<?php get_footer(); ?>