<?php
/**
 * Footer.php outputs the code for footer hooks and closing body/html tags
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */ ?>

			<div class="clear"></div>
		</div>
	</div>
	
	<div id="footer-wrap">
		<footer id="footer">
			<div id="footer-widgets" class="site-footer container clr">
				<div class="footer-box span_1_of_4 col col-1"><?php dynamic_sidebar( 'footer-one' ); ?></div>
				<div class="footer-box span_1_of_4 col"><?php dynamic_sidebar( 'footer-two' ); ?></div>
				<div class="footer-box span_1_of_4 col"><?php dynamic_sidebar( 'footer-three' ); ?></div>
				<div class="footer-box span_1_of_4 col"><?php dynamic_sidebar( 'footer-four' ); ?></div>
			</div>
		</footer>
	</div>
	
	<?php
	// Copyright
	$copyright = get_theme_mod( 'wpex_copyright', 'Portafolio <a href="http://www.wpexplorer.com/" title="WordPress Theme" target="_blank">WordPress Theme</a> Designed &amp; Developed by <a href="http://themeforest.net/user/WPExplorer?ref=WPExplorer" target="_blank" title="WPExplorer">WPExplorer</a>' );
	
	if ( $copyright ) : ?>

		<div id="copyright-wrap">
			<div id="copyright" class="container clr" role="contentinfo"><?php echo wp_kses_post( $copyright ); ?></div>
		</div>

	<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>