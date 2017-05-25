<?php
/**
 * The template for displaying 404 pages (Not Found).
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
                    <h1><?php _e( '404: Page Not Found', 'portafolio' ); ?></h1>
                </header>
            </div>

            <div class="container clr">
                <div class="entry clr">			
                    <p id="error-page-text">
                        <?php _e( 'Unfortunately, the page you tried accessing could not be retrieved. Please visit the', 'portafolio' ); ?> <a href="<?php echo home_url() ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php _e( 'homepage', 'portafolio' ); ?> &rarr;</a>
                    </p>
                </div>
            </div>

    	</div>
	</div>
    
<?php get_footer(); ?>