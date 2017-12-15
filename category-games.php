<?php
	$home = false;
	get_header();
?>	

<?php $count = 0; ?>
<?php if ( have_posts() ) :?>

<div class="articles">

<?php while ( have_posts() ) : the_post(); ?>

	<?php if($count === 0): ?>
	<div class="row first-row">
		<article class="col-md-6 col-sm-12">
			<a href="<?php the_permalink(); ?>">
			<div class="imgwrapper">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			} else {
			    echo '<img src="img/stub1.png" />';			
			}
			?>
			</a>
			</div>
			<h2><a href = '<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2>
			<p><?php the_excerpt(); ?></p>
			<p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read more...</a></p>
			<?php $count ++; ?>
		</article>
	<?php elseif ($count === 1): ?>
		<article class="col-md-6 col-sm-12">
			<a href="<?php the_permalink(); ?>">
			<div class="imgwrapper">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			} else {
			    echo '<img src="img/stub1.png" />';			
			}
			?>
			</a>
			</div>
			<h2> <a href = '<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2>
			<p><?php the_excerpt(); ?></p>
			<p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read more...</a></p>
		</article>
		</div>
		<?php $count ++; ?>
		<h1 style="text-decoration: underline;">The Archives</h1>
	<?php else: ?>

		<div class="row">
			<article class="buried col-md-12">
			<h2><a href = '<?php the_permalink(); ?>' title='<?php the_title();?>'><?php the_title(); ?></a></h2>
			<p><?php the_excerpt(); ?></p>
			</article>
		</div>
	<?php endif; ?>
		
<?php endwhile; ?>
<?php endif; ?>

<?php the_posts_navigation(); ?>

</div>

<div class="row bio">
	<h1>More Information</h1>
	<div class="about-this col-md-6 col-sm-12">
		<?php if ( !dynamic_sidebar('about-games') ) : ?>
		<h2>About Andrew's Games</h2>
		<p>They're games, made by Andrew. A variety of sizes, colours, genres, and formats. </p>
		<?php endif; ?>
	</div>
	<div class="author-bio col-md-6 col-sm-12">
		<h2>About the Author</h2>
		<p>Andrew is the proprietor of PizzaPranks (formerly Perspicacity1.com). He likes to make games and play games. His favourite system is the TurboGrafx but his favourite game is BattleChess. He likes everything, except the things he does not.</p>
	</div>
</div>

</div>

<?php
// Reset Query
	wp_reset_query();
	get_footer();		 
?>