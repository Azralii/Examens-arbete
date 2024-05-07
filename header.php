<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Marka_Cadey_WordPress_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'marka-cadey'); ?></a>

		<header class="header">
			<div class="container">
				<nav class="navbar navbar-expand-lg">
					<div class="container">

						<div class="site-branding">
							<?php
							the_custom_logo();
							if (is_front_page() && is_home()) :
							?>
								<!-- <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1> -->
							<?php
							else :
							?>
								<!-- <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p> -->
							<?php
							endif;
							$marka_cadey_description = get_bloginfo('description', 'display');
							if ($marka_cadey_description || is_customize_preview()) :
							?>
								<!-- <p class="site-description"><?php echo $marka_cadey_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
															?></p> -->
							<?php endif; ?>
						</div><!-- .site-branding -->


						<!-- <a class="navbar-brand" href="#">
							<img src="images/logo.png" alt="Your Logo" height="60">
						</a> -->
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
							<i class="fa-solid fa-bars"></i>
						</button>
						<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
							<?php
							wp_nav_menu(array(
								'theme_location'  => 'menu-1',
								'container'       => false,
								'menu_id'        => 'primary-menu',
								'menu_class'      => 'navbar-nav',
								'fallback_cb'     => '__return_false',
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth'           => 2,
								'walker'          => new Custom_Header_Navwalker(),
							));
							?>
						</div>



					</div>
				</nav>
			</div>
		</header>