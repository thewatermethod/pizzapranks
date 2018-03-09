<?php
	get_header();
?>	



<?php
$count = 0;
$args = array( 'post_type' => 'comic', 'posts_per_page' => -1 );
$loop = new WP_Query( $args );
?>
<main>

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
		<div class="row">
	<?php else: ?>
			<article class="buried col-md-4">
			<h2><a href = '<?php the_permalink(); ?>' title='<?php the_title();?>'><?php the_title(); ?></a></h2>
			</article>
		
	<?php endif; ?>
		
<?php endwhile; ?>
		</div>
</main>
<div class="row bio">
	<div class="about-this">
		<?php if ( ! dynamic_sidebar('about-comics') ) : ?>
		<h2>About Apple and Kiwi Comics</h2>
		<p>Apple and Kiwi Comics is a long-form comic series mainly about the sex life of fruit, or fruit like beings. Sometimes, our heroes battle monsters and psychic detritus, other times they battle the vagaries of real life.</p>
		<?php endif; ?>
	</div>
	<div class="author-bio">
		<h2>About the Author</h2>
		<?php if ( ! dynamic_sidebar('gino-bio') ) : ?>
		<p>Gino is a webcomic artist and malcontent. He enjoys wearing wildly inappropriate outfits, semi-obscure cell-phone games, and leveling up in general.</p>
		<?php endif; ?>
	</div>
</div>

</div>
<?php
	get_footer();
?>	