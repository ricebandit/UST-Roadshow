<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package roads
 */

?>

	<footer>
		<div class="top">
			<div class="content-container">
				<div class="logos">
					<div class="logo travelworks" style="background:url(/wp-content/uploads/2023/06/logo-travelworks-blue.png)no-repeat center; background-size:contain;aspect-ratio:430 / 170;"></div>
					<div class="logo ustravel" style="background:url(/wp-content/uploads/2023/06/logo-ustravel-blue.png)no-repeat center; background-size:contain;aspect-ratio:374 / 92;"></div>
				</div>
				<div class="links">
				<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-links',
								'menu_id'        => 'links',
								'container'		 => false
							)
						);
						?>
				</div>
			</div>
		</div>
		<div class="bottom">
			<div class="content-container">
				<div class="social-links">
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
				<div class="legal"><p><small>©2023 Travel Works. All rights reserved.</small></p></div>

			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
