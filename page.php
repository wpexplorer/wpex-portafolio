<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */

get_header(); ?>

	<div id="primary" class="content-area clr">
		<div id="content" class="site-content" role="main">
		
			<?php while ( have_posts() )  : the_post(); ?>

				<div id="page-header-wrap">
					<header id="page-header" class="container clr">
						<h1 class="page-header-title"><?php the_title(); ?></h1>
					</header>
				</div>

				<?php if ( has_post_thumbnail() ) { ?>
					<div id="page-featured-img"><?php the_post_thumbnail( 'full' ); ?></div>
				<?php } ?>

				<article id="post" class="col col-1 span_3_of_4 clr">
					<div class="entry clr">	<?php the_content(); ?></div>
					<?php comments_template(); ?>
				</article>

			<?php endwhile; ?>
			<?php get_sidebar(); ?>

		</div>
	</div>
	
<?php get_footer(); ?>