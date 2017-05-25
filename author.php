<?php
/**
 * The template for displaying Author archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */

get_header(); ?>

	<div id="primary" class="content-area clr">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : the_post(); ?>
				<div id="page-header-wrap">
					<header id="page-header" class="container clr">
						<h1 class="page-header-title"><?php _e( 'Articles Written By', 'portafolio' ); ?>: <?php echo get_the_author() ?></h1>
					</header>
            	</div>

                 <div id="post" class="col col-1 span_3_of_4 clr">
                    <?php rewind_posts(); ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', get_post_format() ); ?>
                    <?php endwhile; ?>        
                    <?php wpex_pagination(); ?>
            	</div>
                
                <?php endif; ?>

            <?php get_sidebar(); ?>

    	</div>
	</div>
    
<?php get_footer(); ?>