<?php  /* Template Name: Pixel Dailies Calendar */ ?>
<?php
/**
*
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :         
                
            

			/* Start the Loop */
			while ( have_posts() ) : the_post(); ?>
				<?php
                get_template_part( 'template-parts/content', get_post_format() );
				?>
				<div id="calendar" class="pixel-calendar"></div><?php
			endwhile; ?>
		<?php endif; ?>
		</main><!-- #main -->
		<?php get_sidebar('left');?>
		<?php get_sidebar('right'); ?>
	</div><!-- #primary -->

<?php


get_footer();