<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package whitelist
 */

get_header();
?>

	<main id="primary" class="site-main">
    	<div class="wp-page-inner px-4 py-5 min-vh-100">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/template-single-page', 'brand' );

		endwhile; // End of the loop.
		?>
        </div>
	</main><!-- #main -->

<?php
get_footer();
