
<?php get_header(); ?>


<main>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 
<div class="single-book">
		<h1 class="book-title"><?php the_title(); ?></h1>
		<?php the_post_thumbnail(); ?>
		<?php the_content(); ?>

</div>

<?php endwhile; else: ?>
 
<p>Sorry, no posts matched your criteria.</p>
 
<?php endif; ?> 

</main>
<div class="comments row">
	<div class="col-md-12">
		<?php comments_template(); ?>
	</div>
</div>


<div class="row bio">
	<div class="author-bio col-md-6 col-sm-12">
		<?php if ( ! dynamic_sidebar('book-info') ) : ?>
		<h2>Check Out My Tumblr</h2>
		<p><a href="http://thewatermethod.tumblr.com">The Watermethod</a></p>
		<?php endif; ?>
	</div>
	<div class="author-bio col-md-6 col-sm-12">
		<?php if ( ! dynamic_sidebar('matt-bio') ) : ?>
		<h2>About the Author</h2>
		<p>Matt likes to read, write, and make webpages. If you need a webpage or just want to talk, you can contact him on twitter <a href="http://www.twitter.com/thewatermethod">@thewatermethod</a>. Or e-mail him at <a href="mailto:matt@twilitgrotto.com">matt@twilitgrotto.com.</a></p>
		<?php endif; ?>
	</div>
</div>

</div>
<?php get_footer(); ?>
