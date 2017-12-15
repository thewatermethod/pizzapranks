
<?php 
	get_header(); 
?>	


<main>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 


<div class="row">
	<section class="col-md-offset-2 col-md-8">
		<h1><a href = '<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h1>
		<?php the_content(); ?>
	</section>
</div>

 <div class="row">
 		<section class="col-md-offset-4 col-md-4">
		<div class="comics-navigation btn-group" role="group">	
			<button type="button" class="btn btn-default"><?php echo previous_post_link('%link', 'Previous', false); ?></button>
			<button type="button" class="btn btn-default"><a href="<?php echo the_oldest_comic(); ?>">First</a></button>
			<button type="button" class="btn btn-default"><a href="<?php echo random_comic(); ?>">Random</a></button>
			<button type="button" class="btn btn-default"><a href="<?php echo the_newest_comic(); ?>">Last</a></button>
			<button type="button" class="btn btn-default"><?php echo next_post_link('%link', 'Next', false); ?></button>
		</div>
		</section>	
</div>



<div class="row">
	<section class="col-md-offset-2 col-md-8">
		<?php the_post_thumbnail(); ?>
	</section>
</div>




 <div class="row">
 		<section class="col-md-offset-4 col-md-4">
		<div class="comics-navigation btn-group" role="group">	
			<button type="button" class="btn btn-default"><?php echo previous_post_link('%link', 'Previous', false); ?></button>
			<button type="button" class="btn btn-default"><a href="<?php echo the_oldest_comic(); ?>">First</a></button>
			<button type="button" class="btn btn-default"><a href="<?php echo random_comic(); ?>">Random</a></button>
			<button type="button" class="btn btn-default"><a href="<?php echo the_newest_comic(); ?>">Last</a></button>
			<button type="button" class="btn btn-default"><?php echo next_post_link('%link', 'Next', false); ?></button>
		</div>
		</section>	
</div>

<?php endwhile; else: ?>
 
<p>Sorry, no posts matched your criteria.</p>
 
<?php endif; ?> 

</main>
<div class="comments">
	<?php comments_template(); ?>
</div>

</div>
<?php get_footer(); ?>
