<?php
/**
 * The template for displaying all blog posts
 *
 *Template Name: Blog Template
 *Template Post Type: blog
 *
 * @package roads
 */

get_header();
?>

	<main id="primary" class="site-main">


	<?php get_template_part( 'template-parts/flexible-content' ); ?>

	</main><!-- #main -->

<?php
get_footer();
