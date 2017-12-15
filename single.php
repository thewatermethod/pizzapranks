<?php get_header(); ?>	

<main>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 
<div class="row"> 

<div class="single-post col-md-8 col-md-offset-2">
	<h1><?php the_title(); ?></h1>
	<?php the_content(); ?>

</div>

<?php endwhile; else: ?>
 
<p>Sorry, no posts matched your criteria.</p>
 
<?php endif; ?> 
</div>
</main>
<div class="comments">
	<?php comments_template(); ?>
</div>

</div>
<?php get_footer(); ?>
