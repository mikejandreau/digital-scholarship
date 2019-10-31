<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Digital Scholarship
 */

?>

<header id="masthead" class="site-header">
	<div class="site-navbar <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) { echo 'has-logo'; } ?>">

		<div class="site-branding">
			<?php /* gets custom logo if selected, otherwise displays site title */ ?>
			<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?> 
				<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
			<?php endif; ?>
		</div>

		<button class="menu-toggle" tabindex="0" aria-label="Menu" aria-controls="primary-menu"><?php esc_html_e( 'Menu', 'digitalscholarship' ); ?><span>toggle menu</span></button>

		<nav id="site-navigation" class="main-navigation">
			<h3 class="screen-reader-text">Main Menu</h3>

			<?php // button for dismissing off-canvas mobile nav, delete if not needed ?>
			<button class="menu-dismiss" tabindex="0" aria-label="Menu" aria-controls="primary-menu"><span>dismiss menu</span></button>

			<?php 
				wp_nav_menu( array(
				'theme_location'	=> 'menu-1',
				'echo'				=> true,
				'depth'				=> 10, 
				'container'			=> 'ul',
				'menu_class'		=> 'nav-menu', 
				'menu_id'			=> 'primary-menu',
				'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'walker'			=> new digitalscholarship_walker_nav_menu
				) ); 
			?>
		</nav><!-- #site-navigation -->
	</div>
</header><!-- #masthead -->
