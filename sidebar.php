<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */
?>

<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
    
    <aside id="secondary" class="sidebar-container col span_1_of_4" role="complementary">
        <div class="sidebar-inner">
			<div class="widget-area"><?php dynamic_sidebar( 'sidebar' ); ?></div>
		</div>
    </aside>

<?php endif; ?>