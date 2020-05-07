<?php
/**
 * Template part for displaying page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php
		
		if ( is_singular() && !is_front_page() && !is_home()) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		elseif( !is_front_page() && !is_home() ):
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; ?>

			
	</header><!-- .entry-header -->

   <!-- <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
    <?php endif; ?> -->

	<div class="entry-content">
		<?php
		    the_content();
		?>
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->
