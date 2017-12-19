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

	<div id="primary" class="content-area">
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
			while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('bg-light'); ?>>
					<header class="entry-header">
						<?php
						if ( is_singular() ) :
							the_title( '<h1 class="entry-title">', '</h1>' );
						else :
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						endif; ?>
					</header><!-- .entry-header -->

					<?php// if( has_post_thumbnail() ) : the_post_thumbnail(); endif; ?>

					<div class="entry-content">
						<?php the_excerpt(); ?>
					</div><!-- .entry-content -->

					
					<a class="btn btn-dark" href="<?php the_permalink(); ?>">Find out more</a>
					
				</article><!-- #post-<?php the_ID(); ?> -->

			<?php endwhile; ?>
		<?php endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

	</div><!-- .container -->
<?php
get_footer();