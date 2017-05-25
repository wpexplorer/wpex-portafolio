<?php
/**
 * The Template for displaying your image attachments
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
					<h1><?php the_title(); ?></h1>
				</header>
			</div>
			
			<div id="img-attch-page" class="container clr">
				<a href="<?php echo wp_get_attachment_url($post->ID, 'full-size' ); ?>" class="prettyphoto-link"><?php $portimg = wp_get_attachment_image( $post->ID, 'full' ); echo preg_replace( '#(width|height)="\d+"#','',$portimg);?></a>
				<div id="img-attach-page-content">
					<?php the_content(); ?>
				</div>
			</div>

		</div>
	</div>
	
<?php get_footer(); ?>