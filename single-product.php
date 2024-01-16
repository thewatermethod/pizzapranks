<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

get_header(); ?>
	<style>
		/* todo: fix this */
		/** the product info is duplicated, so that's a bug to be tracked down */
		/** this css hides the extra product until we can figure that out */
		.single-product .woocommerce {
			display: none;
		}
	</style>		

	<div id="primary" class="content-area grid">
		
		<main id="main" class="site-main">

		<?php woocommerce_content(); ?>

		</main><!-- #main -->
		<?php get_sidebar('left');?>
		<?php get_sidebar('right'); ?>
	</div><!-- #primary -->

	<?php if( is_single() ):?>
		<div class="comments">
			<?php comments_template(); ?>
		</div>
	<?php endif;?>

<?php


get_footer();