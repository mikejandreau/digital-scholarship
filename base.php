<?php
/**
 * The base template file.
 *
 * This is the theme wrapper template file
 * The entire site structure is included here: header, hero, strapline, content, sidebar, and footer
 * If you don't want/need the hero or strapline sections, delete the calls to get_template_part('template-parts/hero') and delete hero.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Digital Scholarship
 */
?>

<!DOCTYPE html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class('site-wrap'); ?>>
		<div id="page" class="site">
			<h2 class="screen-reader-text"><?php bloginfo( 'name' ); ?></h2>
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'digitalscholarship' ); ?></a>

			<?php get_header( digitalscholarship_template_base() ); ?>

			<div id="content-wrap" class="site-content-wrap">

				<?php get_template_part('template-parts/hero'); // hero section ?>

				<div id="content"><?php // open #content ?>
				
					<?php if ( is_home() && is_front_page() ) : // if front page is set to show latest posts, show this content ?>
						<div class="site-content">
							<div id="primary" class="content-area">
								<main id="main" class="site-main">
									<?php include digitalscholarship_template_path(); ?>
								</main>
							</div>
							<?php get_sidebar( digitalscholarship_template_base() ); ?>
						</div>

					<?php elseif ( is_front_page() ) : // if front page is set to show static page, get front-page.php markup ?>
						<div class="site-content">
							<div id="primary" class="content-area">
								<main id="main" class="site-main">
									<?php include digitalscholarship_template_path(); ?>
								</main>
							</div>
							<?php get_sidebar( digitalscholarship_template_base() ); ?>
						</div>
						<?php // get_template_part('template-parts/strapline'); // strapline section ?>
						<?php // include digitalscholarship_template_path(); ?>

					<?php elseif ( is_page_template( 'full-width.php' ) ) : ?>
						<?php include digitalscholarship_template_path(); ?>

					<?php else : // all other pages ?>
						<div class="site-content">
							<div id="primary" class="content-area">
								<main id="main" class="site-main">
									<?php include digitalscholarship_template_path(); ?>
								</main>
							</div>
							<?php get_sidebar( digitalscholarship_template_base() ); ?>
						</div>
					<?php endif; ?>
				</div><?php // close #content ?>
			</div><?php // close #content-wrap ?>

			<?php get_footer( digitalscholarship_template_base() ); ?>
			
		</div><?php // close #page ?>
		<?php wp_footer(); ?>

	</body>
</html>

