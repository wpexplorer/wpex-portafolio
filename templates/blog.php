<?php
/**
 * Template Name: Blog
 *
 *
 * Custom template used to display your recent blog posts
 *
 * @package WordPress
 * @subpackage WPExplorer.com
 * @since 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area clr">
		<div id="content" class="site-content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
            <div id="page-header-wrap">
                <header id="page-header" class="container clr">
					<h1 class="page-header-title"><?php the_title(); ?></h1>
                </header><!-- #page-header -->
            </div><!-- #page-header-wrap -->
            <div class="container clr">
                <div id="post" class="col col-1 span_3_of_4 clr">
                    <?php query_posts(
                        array(
                            'post_type'	=> 'post',
                            'paged'		=> $paged
                        )
                    ); ?>       
                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'content', get_post_format() );   ?> 
                        <?php endwhile;	?>
                    <?php wpex_pagination(); ?>
                    <?php endif; ?>        
                    <?php wp_reset_query(); ?>
                </div><!-- #post -->
                <?php endwhile; ?>
                <?php get_sidebar(); ?>
            </div><!-- .container -->
    	</div><!-- #content -->
	</div><!-- #primary -->
    
<?php get_footer(); ?>