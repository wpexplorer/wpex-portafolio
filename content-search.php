<?php
/**
 * This file is used for your search and archive entries.
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'search-entry clr' ); ?>>

    <?php if ( has_post_thumbnail() ) {  ?>
        <div class="search-entry-thumbnail">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
        </div>
    <?php } ?>

    <div class="search-entry-content">
        <header class="post-heading">
            <h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
        </header>
        <div class="search-entry-excerpt entry"><?php wpex_excerpt( '50', false ); ?></div>
    </div>
    
</article>