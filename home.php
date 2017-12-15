<?php
	$home == true;
	get_header();
	
?>	

<main>


<?php $count = 0; ?>

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
			   	
			}
			?>
			</a>
			</div>
			<h2><span class="post-type"><?php echo get_post_type(); ?></span>: <a href = '<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2>
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
			<h2><span class="post-type"><?php echo get_post_type(); ?></span>: <a href = '<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2>
			<p><?php the_excerpt(); ?></p>
			<p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read more...</a></p>
		</article>
		</div>
		<?php $count ++; ?>
	<?php else: ?>

		<div class="row">
			<article class="buried col-md-12">
			<h2><span class="post-type"><?php echo get_post_type(); ?></span>: <a href = '<?php the_permalink(); ?>' title='<?php the_title();?>'><?php the_title(); ?></a></h2>
			<p><?php the_excerpt(); ?></p>
			<p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read more...</a></p>
		</article>
		</div>
	<?php endif; ?>
		
<?php endwhile; ?>

</div>
</main>
</div>

<div class="container-fluid smallPromo">

		<div class="row">
			<section class="col-md-12">
				<h1>Support PizzaPranks and buy some merch!</h1>
			</section>
		</div>
		
		<div class="row">
			<div class="on-sale col-md-3 col-md-offset-3 col-sm-12">
				<a href="http://appleandkiwi.bigcartel.com/product/bros-4-lyfe-shirt">
					<div class="img-wrpr"><img src="<?php echo get_template_directory_uri(); ?>/img/bros.jpg"></div>
				</a>
			</div>
			<div class="on-sale col-md-3 col-sm-12">
				<a href="http://www.lulu.com/shop/gino-vasconcelos/apple-and-kiwi-1/paperback/product-18173574.html">
					<div class="img-wrpr"><img src="<?php echo get_template_directory_uri(); ?>/img/book.jpg"></div>
				</a>
			</div>
	

	</div>	
	
	<div class="row twitter-row">
		<div class="tweets col-md-4 col-sm-12">
			<?php if ( ! dynamic_sidebar("above-footer-left") ) : ?>
			
			<?php endif; ?>
		</div>			
		<div class="tweets col-md-4 col-sm-12">
			<?php if ( ! dynamic_sidebar("above-footer-middle") ) : ?>
				
			<?php endif; ?>
		</div>
		<div class="tweets col-md-4 col-sm-12">
			<?php if ( ! dynamic_sidebar("above-footer-right") ) : ?>
			
			<?php endif; ?></div>
		</div>


</div>
<?php
	get_footer();		 
?>

