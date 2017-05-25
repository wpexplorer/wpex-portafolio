<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */

get_header(); ?>

	<div id="primary" class="content-area clr">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>
			   
				<div id="page-header-wrap">
					<header id="page-header" class="container clr">
						<h1 id="archive-title"><?php _e( 'Search Results For', 'portafolio' ); ?>: <?php the_search_query(); ?></h1>
					</header>
				</div>

				<article id="post" class="col col-1 span_3_of_4 clr">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'search' ); ?>
					<?php endwhile;	 ?>
					<?php wpex_pagination(); ?>
				</div>

			<?php else : ?>

				<div id="page-header-wrap">
					<header id="page-header" class="container clr">
						<h1 id="archive-title"><?php _e( 'Search Results For', 'portafolio' ); ?>: <?php the_search_query(); ?></h1>
					</header>
				</div>

				<article id="post" class="col col-1 span_3_of_4 clr">
					<?php _e( 'No results found for that query.', 'portafolio' ); ?>
				</div>

			<?php endif; ?>

			<?php get_sidebar(); ?>

		</div>
	</div>
	
<?php get_footer(); ?>