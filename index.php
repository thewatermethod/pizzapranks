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

	<div id="primary" class="content-area grid">
		
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php the_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post(); 				
			
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile; ?>
		<?php endif; ?>
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