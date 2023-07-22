<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package roads
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> style='opacity:0;'>
<head>
	 

	<!-- Google tag (gtag.js) --> <script async src=https://www.googletagmanager.com/gtag/js?id=G-CFP0W3QK7Q></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-CFP0W3QK7Q'); </script>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&family=Kalam&family=Open+Sans:wght@400;700;800&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<style>
			.site-header .menu-main-container .content-container .menu{
				transform:translate3d(0, -200px, 0);
			}
		</style>

		<nav id="site-navigation">
			
			<div class="menu-main-container">
				<div class="backgroundfade"></div>
				<div class="background"></div>

				<div class="content-container">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-main',
							'menu_id'        => 'primary-menu',
							'container'		 => false
						)
					);
					?>
					
					<a href="/" class="logo">
						<div class="logo-full" style="background:url(/wp-content/uploads/2023/06/logo-white.png)no-repeat center; background-size:contain;transform:translate3d(0, -200%, 0);"></div>
						<div class="logo-compressed" style="background:url(/wp-content/uploads/2023/06/logo-compressed.png)no-repeat center; background-size:contain;transform:translate3d(0, -200%, 0);"></div>
					</a>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-secondary',
							'menu_id'        => 'secondary-menu',
							'container'		 => false
						)
					);
					?>

				</div>

			</div>
			<div class="menu-mobile-container">
				<a href="/" class="logo" style="background:url(/wp-content/uploads/2023/06/logo-white.png)no-repeat center; background-size:contain;"></a>
				<div class="menu-toggle">
					<div id="top" class="bar"></div>
					<div id="middle" class="bar"></div>
					<div id="bottom" class="bar"></div>
				</div>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="mobile-nav" style="transform:translate3d(100%, 0, 0);">
		<div class="header">
		<div class="logo" style="background:url(/wp-content/uploads/2023/06/logo-white.png)no-repeat center; background-size:contain;"></div>
			<div class="close-btn"></div>
		</div>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-main',
				'menu_id'        => 'primary-menu',
			)
		);
		wp_nav_menu(
			array(
				'theme_location' => 'menu-secondary',
				'menu_id'        => 'secondary-menu',
				'container'		 => false
			)
		);
		?>	
	</div>
