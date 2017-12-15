<?php
	$home = false;
	get_header();
?>	



<?php
$count = 0;
$args = array( 'post_type' => 'podcast', 'posts_per_page' => -1 );
$loop = new WP_Query( $args );
?>
<main>

<div class="row">

</div>


<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

	<?php if($count === 0): ?>
	<div class="row first-row">
		<article class="col-md-6 col-sm-12">
			<a href="<?php the_permalink(); ?>">
			<div class="imgwrapper">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			} else {
			   
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

</main>
<div class="row bio">
	<div class="about-this">
		<?php if ( ! dynamic_sidebar('about-podcast') ) : ?>
		<h2>About The Conundrum of Workshops Podcast</h2>
		<p>Apple and Kiwi Comics is a long-form comic series mainly about the sex life of fruit, or fruit like beings. Sometimes, our heroes battle monsters and psychic detritus, other times they battle the vagaries of real life.</p>
		<?php endif; ?>
	</div>
	<div class="author-bio">
		<?php if ( ! dynamic_sidebar('podcast-second') ) : ?>
		<p>Gino is a webcomic artist and malcontent. He enjoys wearing wildly inappropriate outfits, semi-obscure cell-phone games, and leveling up in general.</p>
		<?php endif; ?>
	</div>
</div>

</div>
<?php
	get_footer();
?>	