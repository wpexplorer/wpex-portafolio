<?php
/**
 * The Header for our theme.
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="masthead-wrap">

		<header id="masthead" class="site-header container clr" role="banner">

			<div id="logo">
				<?php
				// Display Custom Logo
				if ( $custom_logo = get_theme_mod( 'wpex_logo' ) ) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>/" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><img src="<?php echo esc_url( $custom_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a>
				<?php }
				// Display text logo
				else { ?>
					 <h2><a href="<?php echo esc_url( home_url( '/' ) ); ?>/" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></h2>
				<?php } ?>
			</div>

			<nav id="navigation" class="clr">
				<?php
				// Display main menu
				wp_nav_menu( array(
					'theme_location' => 'main_menu',
					'sort_column'    => 'menu_order',
					'menu_class'     => 'dropdown-menu main-nav',
					'fallback_cb'    => false,
				) ); ?>
			</nav>

			<a href="#" class="mobile-menu-toggle"><span class="fa fa-bars"></span></a>

		</header>

	</div>
	
	<div id="wrap" class="clr">
	
		<div id="main-content" class="container clr">