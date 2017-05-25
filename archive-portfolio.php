<?php
/**
 * The template for displaying the Portfolio custom post type archive.
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

			<div id="page-header-wrap">
                <header id="page-header" class="container clr">
                    <h1 class="page-header-title"><?php post_type_archive_title(); ?></h1>
                </header>
            </div>

            <?php if ( have_posts() ) : ?>

                <div class="portfolio-entries container clr">
					<?php $wpex_count=0; ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php $wpex_count++; ?>
                            <?php get_template_part( 'content', 'portfolio' ); ?>
                        <?php if ( $wpex_count == '4' ) { ?>
                            <?php $wpex_count=0; ?>
                        <?php } ?>
                    <?php endwhile; ?>
                </div>
                
                <?php wpex_pagination(); ?>

			<?php endif; ?>

    	</div>
	</div>
    
<?php get_footer(); ?>