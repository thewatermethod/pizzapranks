<?php get_header();?>

	<div id="apple-and-kiwi">

		<div id="primary" class="content-area"><!--<?php echo get_post_type(); ?> -->
			
			<main id="main" class="site-main">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


				<article class="single-comic">

					<section>
						<h1 class="h2 centered-text">
							<a href="<?php echo home_url('/comic'); ?>">Apple & Kiwi Comics</a> > 
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'>"<?php the_title(); ?>"</a></h1>
						<?php the_content(); ?>
						<?php the_post_thumbnail('medium_large'); ?>
					</section>			
						
					
					<aside class="comics-navigation">

						<ul>
							<?php the_previous_comic(); ?>
							<li><a href="<?php the_oldest_comic(); ?>">Read from the beginning</a></li>		
							<li><a href="<?php the_random_comic(); ?>">Read a random comic</a></li>					
							<li><a href="<?php the_newest_comic(); ?>">Newest Comic</a></li>				
							<?php the_next_comic(); ?>				
							
						</ul>

						<a href="<?php the_post_thumbnail_url(); ?>">See the Full Size Comic</a>

					</aside>


				</article>


				<?php endwhile; else: ?>
				
					<p>Sorry, no posts matched your criteria.</p>
				
				<?php endif; ?> 

			</main>

			</div>
	
		</div><!-- #primary-->
	
		<div class="comments">
			<?php comments_template(); ?>
		</div>

		


<?php get_footer(); ?>
