<?php
/**
 * This file is used for your blog and archive entries.
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 
/* Post
-------------------------------------------------------------------------------*/
if ( is_singular() && is_main_query() ) { ?>
	
	<header id="post-header">
		<h1><?php the_title(); ?></h1>
		<ul class="meta clr">
			<li><?php _e( 'On', 'portafolio' ); ?><span> <?php echo get_the_date(); ?></span> &middot; </li> 
			<li><?php _e( 'By', 'portafolio' ); ?> <?php the_author_posts_link(); ?> &middot; </li>   
			<?php if ( comments_open() ) { ?>
				<li><?php _e( 'With', 'portafolio' ); ?> <?php comments_popup_link(__( '0 Comments', 'portafolio' ), __( '1 Comment', 'portafolio' ), __( '% Comments', 'portafolio' ), 'comments-link' ); ?></li>
			<?php } ?>
		</ul>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>

		<div id="post-thumbnail"><?php the_post_thumbnail( 'wpex_post' ); ?></div>

	<?php endif; ?>

	<article class="entry clr"><?php the_content(); ?></article>

	<?php wp_link_pages(); ?>

	<?php comments_template(); ?>
	
<?php
/* Entry
-------------------------------------------------------------------------------*/
} else { ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-entry clr' ); ?>>  
		
		<header class="post-heading">
			<h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
		</header>
		
		<ul class="meta clr">
			 <li><?php _e( 'On', 'portafolio' ); ?><span> <?php echo get_the_date(); ?></span> &middot; </li> 
			 <li><?php _e( 'By', 'portafolio' ); ?> <?php the_author_posts_link(); ?> &middot; </li>   
			 <?php if ( comments_open() ) { ?>
				<li><?php _e( 'With', 'portafolio' ); ?> <?php comments_popup_link(__( '0 Comments', 'portafolio' ), __( '1 Comment', 'portafolio' ), __( '% Comments', 'portafolio' ), 'comments-link' ); ?></li>
			 <?php } ?>
		</ul>
		
		<?php if ( has_post_thumbnail() ) {  ?>
			<div class="blog-entry-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_post_thumbnail( 'wpex_entry' ); ?></a>
			</div>
		<?php } ?>
		
		<div class="entry-content">

			<div class="entry-text entry">
				<?php if ( get_theme_mod( 'wpex_blog_excerpt', true ) ) { ?>
					<?php the_excerpt(); ?>
					 <a class="theme-button" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php _e( 'Continue Reading', 'portafolio' ); ?></a>
				<?php } else { ?>
					<?php the_content(); ?>
				<?php } ?>
			</div>
		
		</div>

	</article>

<?php } ?>