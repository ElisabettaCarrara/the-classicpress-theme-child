<?php
/**
 * Template Name: Full-width Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package The_ClassicPress_Theme_Child
 */

get_header();
?>

	<div id="primary" class="full-width-primary">
		<main id="main" class="page-main page-full-width">

		<?php
		susty_wp_post_thumbnail();

		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
