<?php get_header(); ?>	

 <main class="site-main">
	<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post(); 				
				get_template_part( 'template-parts/content', get_post_format() );
			endwhile; 
		endif; 
	?>

</div>
</main>
<div class="comments">
	<?php comments_template(); ?>
</div>

</div>
<?php get_footer(); ?>
